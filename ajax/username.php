<?php
	require("../admin/Model/Db.php");
        $d = new db;
	$User=$_GET["user"];
	$sql="SELECT * FROM user WHERE User='$User'";
	$rows=mysql_query($sql) or die(mysql_error());
	$Sodong=mysql_num_rows($rows);
	echo $Sodong;	
?>