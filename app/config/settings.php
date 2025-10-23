<?php 
define('ROOT_PATH', __DIR__ . '/../');
define('DATA_PATH', ROOT_PATH . 'data/');

define('VOTE_FILE', DATA_PATH . 'votos.json');
define('POOLS_FILE', DATA_PATH . 'polls.json');
define('CHECK_FRAUDE_BY_IP', true);
define('CHECK_FRAUDE_BY_SESSION', true);
define('MAX_VOTOS_ARQUIVO', 10000);
?>