<?php 
    require_once 'settings.php';

    function read_polls() {
        $path = __DIR__ . '/polls.json';
        if (!is_readable($path)) {
            return [];
        }

        $content = file_get_contents($path);
        if ($content === false) {
            return [];
        }

        $polls = json_decode($content, true);
        if (!is_array($polls)) {
            return [];
        }

        return $polls;
    }
    /**
     * Escreve os dados das enquetes no arquivo polls.json.
     * Utiliza flock para garantir que apenas um processo possa escrever no arquivo ao mesmo tempo,
     * evitando a corrupção de dados. Isso é especialmente importante em ambientes onde múltiplos processos
     * podem tentar acessar o arquivo simultaneamente, como em aplicações web.
     *
     * O arquivo é aberto em modo de leitura e escrita, e o conteúdo é convertido para JSON com formatação
     * legível. O bloqueio exclusivo é adquirido antes de truncar o arquivo e escrever os novos dados.
     * Após a escrita, o bloqueio é liberado para permitir que outros processos acessem o arquivo.
     *
     * @param array $polls Os dados das enquetes a serem escritos.
     * @return void
     */
    function write_polls($polls) {
        $path = __DIR__ . '/polls.json';
        $content = json_encode($polls, JSON_PRETTY_PRINT);
        
        $file = fopen($path, 'c');
        if (flock($file, LOCK_EX)) { 
            ftruncate($file, 0); 
            fwrite($file, $content); 
            flock($file, LOCK_UN);
        }
        fclose($file);
    }

    function read_votes() {
        $path = __DIR__ . '/votes.json';
        if (!is_readable($path)) {
            return [];
        }

        $content = file_get_contents($path);
        if ($content === false) {
            return [];
        }

        $votes = json_decode($content, true);
        if (!is_array($votes)) {
            return [];
        }
        return $votes;
    }
    /**
     * Escreve os dados dos votos no arquivo votes.json.
     * Utiliza flock para garantir que apenas um processo possa escrever no arquivo ao mesmo tempo,
     * evitando a corrupção de dados. Isso é crucial para manter a integridade dos dados em situações
     * onde múltiplos usuários podem votar simultaneamente.
     *
     * O arquivo é aberto em modo de leitura e escrita, e o conteúdo é convertido para JSON com formatação
     * legível. O bloqueio exclusivo é adquirido antes de truncar o arquivo e escrever os novos dados.
     * Após a escrita, o bloqueio é liberado para permitir que outros processos acessem o arquivo.
     *
     * @param array $votes Os dados dos votos a serem escritos.
     * @return void
     */
    function write_votes($votes) {
        $path = __DIR__ . '/votes.json';
        $content = json_encode($votes, JSON_PRETTY_PRINT);
        
        $file = fopen($path, 'c');
        if (flock($file, LOCK_EX)) { 
            ftruncate($file, 0); 
            fwrite($file, $content);
            flock($file, LOCK_UN);
        }
        fclose($file);
    }

    
?>