<?php
include_once('connect.php');
$redis->flushAll();
header('Location: study10.php');
?>
