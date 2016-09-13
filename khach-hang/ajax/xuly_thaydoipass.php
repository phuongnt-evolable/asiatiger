<?php
        
	session_start();
	//ob_start();
	require_once('../../admin/Model/Db.php'); 
	$d = new db;
	
        
        $idUser =$_POST['idUser'];
        $newpw = md5($_POST['newpw']);
        

       echo $sql = "UPDATE user
					SET Pass = '$newpw'
					WHERE id = $idUser ";
        mysql_query($sql) or die(mysql_error() . $sql);
        
?>