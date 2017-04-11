<?php 
	require("../admin/Model/Db.php");
        $d = new db;
	$Email=$_POST["email"];
	$rows=mysql_query("select * from user where Email='$Email'");
	$sodong=mysql_num_rows($rows);
	if($sodong==0){
		if(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
			$sodong=2;
		}else { $sodong=0;}	
	}	
	echo $sodong;
?>