<?php
        session_start();
	require("../../admin/Model/Db.php"); 
        $d = new db;
	$passcu=md5($_GET["passcu"]);
        //echo $idUser=$_SESSION["idUser"];
	$sql="SELECT Pass FROM user WHERE Pass='$passcu'";
	$rows=mysql_query($sql) or die(mysql_error());
	$Sodong=mysql_num_rows($rows);
	echo $Sodong;	
?>