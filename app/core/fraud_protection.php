<?php
require_once 'core/data_manager.php';

// Constantes de segurança
const MAX_VOTES_PER_REQUEST = 1000;
const MAX_VOTES_PER_HOUR = 10000;
const VOTE_EXPIRY_TIME = 86400; // 24 horas
const RATE_LIMIT_WINDOW = 3600; // 1 hora

// Inicialização básica
session_start();
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
        return 'invalid';
    }

    // Normaliza o IP para comparação consistente
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
 * @return array Array de votos filtrado
 */
function clean_old_votes($votes) {
    if (!is_array($votes)) return [];
    
    $currentTime = time();
    return array_filter($votes, function($vote) use ($currentTime) {
        return isset($vote['time']) && ($currentTime - $vote['time'] <= VOTE_EXPIRY_TIME);
    });
}

/**
 * Verifica a taxa de votos em um intervalo de tempo
 * 
 * @param array $votes Array de votos
 * @return array Array com 'valid' (booleano) e 'message' (string)
 */
function check_vote_rate($votes) {
    if (!is_array($votes)) {
        return ['valid' => false, 'message' => 'Dados inválidos'];
    }

    $currentTime = time();
    $recentVotes = array_filter($votes, function($vote) use ($currentTime) {
        return isset($vote['time']) && ($currentTime - $vote['time'] <= RATE_LIMIT_WINDOW);
    });

    $voteCount = count($recentVotes);
    
    if ($voteCount >= MAX_VOTES_PER_HOUR) {
        return [
            'valid' => false,
            'message' => "Limite de " . MAX_VOTES_PER_HOUR . " votos por hora atingido"
        ];
    }

    return [
        'valid' => true,
        'message' => 'Taxa de votos dentro do limite permitido',
        'remaining' => MAX_VOTES_PER_HOUR - $voteCount
    ];
}

/**
 * Verifica o limite de votos por requisição
 * 
 * @param array $votes Array de votos
 * @return array Array com 'valid' (booleano) e 'message' (string)
 */
function check_vote_limit($votes) {
    if (!is_array($votes)) {
        return ['valid' => false, 'message' => 'Dados inválidos'];
    }

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

?>