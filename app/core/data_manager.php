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
    function write_polls($polls) {
        $path = __DIR__ . '/polls.json';
        $content = json_encode($polls, JSON_PRETTY_PRINT);
        file_put_contents($path, $content);
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

    function write_votes($votes) {
        $path = __DIR__ . '/votes.json';
        $content = json_encode($votes, JSON_PRETTY_PRINT);
        file_put_contents($path, $content);
    }
?>