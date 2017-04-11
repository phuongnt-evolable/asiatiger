<?php 
require_once "../Model/Db.php";
class yahoo extends db{
	
	function Yahoo_List($vitri='',$loai='',$offset=-1,$limit=-1,$anhien = -1 ){
		$sql = "SELECT * FROM dvt_yahoo WHERE (vitri = '$vitri' OR '$vitri' = '') AND (loai = '$loai' OR '$loai' = '') AND (anhien = '$anhien' OR '$anhien' = -1) ORDER BY idYahoo ASC ";
		if($limit > 0 && $offset >=0 ) $sql.= " LIMIT $offset,$limit";	
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function NoiDung_List(){
		$sql = "SELECT * FROM dvt_noidung";		
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function Yahoo_ChiTiet($idYahoo){
		$sql = "SELECT * FROM dvt_yahoo WHERE idYahoo = $idYahoo";
		$rs = mysql_query($sql);
		return $rs;
	}
	function QuangCao_ChiTiet($idQC){
		$sql = "SELECT * FROM dvt_quangcao WHERE idQC = $idQC";
		$rs = mysql_query($sql);
		return $rs;
	}
	function Yahoo_Sua($idYahoo){
		
		$Ten = $this->processData($_POST[Ten]);
		$Nick = $this->processData($_POST[Nick]);
		$dienthoai = $this->processData($_POST[dienthoai]);
		
		$sql = "UPDATE dvt_yahoo SET Ten = '$Ten',Nick='$Nick',dienthoai = '$dienthoai' WHERE  idYahoo = $idYahoo";
		mysql_query($sql);
	}
	function Yahoo_Them(){
		$loai = $this->processData($_POST[loai]);
		$vitri = $this->processData($_POST[vitri]);
		$Ten = $this->processData($_POST[Ten]);
		$Nick = $this->processData($_POST[Nick]);
		$dienthoai = $this->processData($_POST[dienthoai]);
		
		$sql = "INSERT INTO dvt_yahoo VALUES(NULL,'$Ten','$Nick','$dienthoai','$loai','$vitri',1)";
		mysql_query($sql);
	}
	function QuangCao_Sua($idQC){
		
		$link = $this->processData($_POST[link]);
		$UrlHinh = $this->processData($_POST[UrlHinh]);
	
		$sql = "UPDATE dvt_quangcao SET link = '$link',UrlHinh='$UrlHinh' WHERE  idQC = $idQC";
		mysql_query($sql);
	}
	function NoiDung_Sua($ten){
		
		$NoiDung = $_POST[NoiDung];		
		
		$sql = "UPDATE dvt_noidung SET NoiDung = '$NoiDung' WHERE Ten = '$ten'";
		mysql_query($sql);
	}
	function NoiDung_ChiTiet($ten){
		$sql = "SELECT * FROM dvt_noidung WHERE Ten = '$ten'";
		$rs = mysql_query($sql);
		return $rs;
	}
 
		
}

?>