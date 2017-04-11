<?php 
require_once "../Model/Db.php";
class album extends db{
	
	
	function Album_ChiTiet($idAlbum){
		$sql = "SELECT * FROM album WHERE idAlbum = $idAlbum";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function LayTenAlbum($idAlbum){
		$sql = "SELECT TenAlbum FROM album WHERE idAlbum = $idAlbum";
		$rs = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($rs);
		return $row['TenAlbum'];
	}
	function Album_List_Sach($idSach){
		$sql = "SELECT * FROM album WHERE idSach = $idSach";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function Album_Them(&$loi){		
		$thanhcong=true;
			
		$idSach = $_POST[idSach];settype($idSach,'int');
		$idML = $_POST[idML];settype($idML,'int');
		if($idSach == 0) $thanhcong=false;
		$TenAlbum= $this->processData($_POST[TenAlbum]);
		$UrlHinh= $this->processData($_POST[UrlHinh]);
		
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "INSERT INTO album
					VALUES(NULL,'$TenAlbum','$UrlHinh',$idSach,$idML)";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
	}
	function Album_Sua($idAlbum,&$loi){	
		settype($idAlbum,"int");
		$thanhcong=true;		
		$idSach = $_POST[idSach];settype($idSach,'int');
		$idML = $_POST[idML];settype($idML,'int');
		if($idSach == 0) $thanhcong=false;
		$TenAlbum= $this->processData($_POST[TenAlbum]);
		$UrlHinh= $this->processData($_POST[UrlHinh]);
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "UPDATE album
					SET TenAlbum = '$TenAlbum',UrlHinh = '$UrlHinh',idSach = $idSach ,idML = $idML WHERE idAlbum = $idAlbum";
			mysql_query($sql) or die(mysql_error().$sql);			
		}
		return $thanhcong;
	}
	
	function Album_List($idML=-1,$idSach=-1, $limit = -1 ,$offset=-1){		
		$sql = "SELECT * FROM album WHERE idAlbum > 0 ";
		if($idML > 0 ) $sql.=" AND idML = $idML "; 		
		if($idSach > 0 ) $sql .= " AND idSach = $idSach ";
		$sql.="ORDER BY idAlbum DESC ";
		if($limit > 0 && $offset >=0) $sql .= "LIMIT $offset,$limit";

		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}		
}

?>