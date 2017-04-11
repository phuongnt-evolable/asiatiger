<?php
        session_start();
	require("../../admin/Model/Db.php"); 
        $d = new db;
	$skypename=$_POST["skypename"];
        $congty_id=$_POST['congty_id'];
        //echo $idUser=$_SESSION["idUser"];
	$sql="SELECT Skype FROM congty WHERE congty_id= $congty_id";
	$rows=mysql_query($sql) or die(mysql_error());
	$Sodong=mysql_num_rows($rows);
	echo $Sodong;	
?>