<?php
	session_start();
	ob_start();
	require_once('../admin/Model/Db.php'); 
	$d = new db;
	$un = $_POST["us"];
	$pa = $_POST["pass"];
        $password = md5($pa);
        
        //if()
        $qr ="SELECT * FROM user
               WHERE (Email = '$un' OR User = '$un' )
               AND Pass = '$password'
               ";                        
        $rows=mysql_query($qr) or die(mysql_error());
	$Sodong=mysql_num_rows($rows);
	echo $Sodong;
        $row_user = mysql_fetch_array($rows);
        //$_SESSION['user_id'] = 'admin';
        $_SESSION["idUser"] = $row_user['id'];
        $_SESSION["Username"] = $row_user['User'];					
        $_SESSION["Password"] = $row_user['Pass'];
        $_SESSION["Email"] = $row_user['Email'];
       $_SESSION["id_Group"] = $row_user['id_Group'];
        $_SESSION["congty_id"] = $row_user['congty_id'];
        //return true;
		
	/*if($tc->XuLyLoginAdmin($un,$pa)==true)
	{
		 if(isset($_SESSION["url"]))
		header("location:".$_SESSION["url"]);
		else
		header("location:../admin/index.php"); 
	}
	else
		header("location:dangnhap.php");*/
?>