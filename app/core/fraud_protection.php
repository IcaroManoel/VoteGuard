<?php 
    require_once 'core/data_manager.php';

    $votes = read_votes();
    $ip = $_SERVER['REMOTE_ADDR'];
    $session = session_id();

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
?>