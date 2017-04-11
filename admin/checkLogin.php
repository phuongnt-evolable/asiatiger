<?php 
	if(!isset($_SESSION)) 
	{ 
		session_start(); 
	}  
	if(isset($_SESSION['user_id'])== FALSE) { 
		$_SESSION['back']= $_SERVER['REQUEST_URI'];
		$_SESSION['error']= "Bạn chưa đăng nhập";
		header("location: dangnhap.php");
	}
?>