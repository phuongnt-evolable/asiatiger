<?php
	session_start();
	unset($_SESSION['idUser']);
	
	header("location: http://asiatiger.org/");
?>