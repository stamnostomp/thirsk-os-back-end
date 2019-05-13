<?php
include_once 'include/class.user.php';
$sql = "SELECT Posts FROM Posts WHERE id = 1";
$result = $databaseObject->fetch($sql);

$example = json_decode($result['bar'], true);

var_dump($example);
?>
