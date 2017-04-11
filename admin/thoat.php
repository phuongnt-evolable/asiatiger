<?php
	session_start();
	unset($_SESSION['kt_login_id']);
	unset($_SESSION['kt_login_user']);
	unset($_SESSION['kt_login_level']);
	unset($_SESSION['kt_HoTen']);
	unset($_SESSION['kt_GioiTinh']);
	header("location: dangnhap.php");
?>