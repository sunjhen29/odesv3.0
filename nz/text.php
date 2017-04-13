<?php
require_once('../_includes/initialize.php');
$user = New User();
$user->adduser();
echo "<pre>";
echo $user['id'];
echo "</pre>";
?>