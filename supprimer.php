<?php
require "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task_id'])) {
    $task_id = intval($_POST['task_id']);
    $tacheManager->delete($task_id);
}

header('Location: index.php');
exit();
?>