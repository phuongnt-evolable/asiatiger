<?php
require "lib/class.user.php";
$u =  new user;
$password= $_POST['password'];
$idUser = (int) $_POST['idUser'];
if($u->user_checkpass($idUser,$password)==true) echo 'ok';
else echo 'error';
?>