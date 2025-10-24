<?php 
    require_once 'core/data_manager.php';

    const MAX_VOTES_PER_REQUEST = 1000;

    $votes = read_votes();
    $ip = $_SERVER['REMOTE_ADDR'];
    $session = session_id();
    $time = time();

    /**
     * Verifica se um usuário pode votar baseado no IP e sessão
     * 
     * @param string $ip Endereço IP do usuário
     * @param string $session ID da sessão do usuário
     * @param array $votes Array de votos existentes
     * @return mixed true se pode votar, 'ip' ou 'session' se já votou
     */
    function can_vote($ip, $session, $votes) {
        if (!is_array($votes)) {
            $votes = [];
        }

        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            $ip_normalized = @inet_ntop(@inet_pton($ip)) ?: $ip;
        } else {
            $ip_normalized = $ip;
        }
            
        foreach ($votes as $vote) {
            if (!isset($vote['ip']) || !isset($vote['session'])) {
                continue;
            }

            if ($vote['ip'] === $ip_normalized) {
                return 'ip'; // já votou por IP
            }

            if ($vote['session'] === $session) {
                return 'session'; // já votou por sessão
            }
        }
        return true;
    }

    /**
     * Remove votos antigos do registro
     * 
     * @param array $votes Array de votos
     * @param int $maxAge Idade máxima dos votos em segundos (padrão: 24 horas)
     * @return array Array de votos filtrado
     */
    function clean_old_votes($votes, $maxAge = 86400) {
        $currentTime = time();
        return array_filter($votes, function($vote) use ($currentTime, $maxAge) {
            return isset($vote['time']) && ($currentTime - $vote['time'] <= $maxAge);
        });
    }

    /**
     * Verifica a taxa de votos em um intervalo de tempo
     * 
     * @param array $votes Array de votos
     * @param int $timeWindow Janela de tempo em segundos para verificar (padrão: 1 hora)
     * @param int $maxVotes Número máximo de votos permitidos na janela de tempo (padrão: 10000)
     * @return array Array com 'valid' (booleano) e 'message' (string)
     */
    function votes_time($votes, $timeWindow = 3600, $maxVotes = 10000) {
        $currentTime = time();
        $recentVotes = array_filter($votes, function($vote) use ($currentTime, $timeWindow) {
            return isset($vote['time']) && ($currentTime - $vote['time'] <= $timeWindow);
        });

        $voteCount = count($recentVotes);
        
        if ($voteCount >= $maxVotes) {
            return [
                'valid' => false,
                'message' => "Limite de $maxVotes votos por " . ($timeWindow / 3600) . " hora(s) atingido"
            ];
        }

        return [
            'valid' => true,
            'message' => 'Taxa de votos dentro do limite permitido',
            'remaining' => $maxVotes - $voteCount
        ];
    }

    /**
     * Verifica se o número de votos em uma requisição excede o limite permitido
     * 
     * @param array $votes Array contendo os votos a serem verificados
     * @return array Array com 'valid' (booleano) e 'message' (string)
     */
    function check_vote_limit($votes) {
        if (count($votes) > MAX_VOTES_PER_REQUEST) {
            return [
                'valid' => false,
                'message' => 'Número de votos excede o limite de ' . MAX_VOTES_PER_REQUEST . ' por requisição'
            ];
        }
        
        return [
            'valid' => true,
            'message' => 'Número de votos dentro do limite permitido'
        ];
    }

    /**
     * Divide um grande conjunto de votos em lotes menores para processamento
     * 
     * @param array $votes Array com todos os votos
     * @return array Array de lotes de votos, cada um com no máximo MAX_VOTES_PER_REQUEST itens
     */
    function batch_votes($votes) {
        return array_chunk($votes, MAX_VOTES_PER_REQUEST);
    }
?>