<?php

require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/classes/Tache.php';
require_once __DIR__ . '/classes/TacheManager.php';

$db = new Database();
$tacheManager = new TacheManager($db);

?>

