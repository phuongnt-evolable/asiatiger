<?php 
require_once "../Model/Db.php";
class tacgia extends db{
	
	
	function TacGia_ChiTiet($idTG){
		$sql = "SELECT * FROM tacgia WHERE idTG = $idTG";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	
	function TacGia_Them(&$loi){	
	
		$thanhcong=true;
		
		$TacGia= $this->processData($_POST[TacGia]);
		$UrlDetail= $this->processData($_POST[UrlDetail]);
		
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "INSERT INTO tacgia
					VALUES(NULL,'$TacGia','$UrlDetail')";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
	}
	function TacGia_Sua($idTG,&$loi){	
		settype($idTG,"int");
		$thanhcong=true;		
		
		$TacGia= $this->processData($_POST[TacGia]);
		$UrlDetail= $this->processData($_POST[UrlDetail]);
		
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "UPDATE tacgia
					SET TacGia = '$TacGia',UrlDetail='$UrlDetail' 
					WHERE idTG = $idTG";
			mysql_query($sql) or die(mysql_error().$sql);			
		}
		return $thanhcong;
	}
	
	
	function TacGia_List(){		
		$sql = "SELECT * FROM tacgia ORDER BY idTG DESC ";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
}

?>