<?php 
require_once "../Model/Db.php";
class phapam extends db{
	
	
	function PhapAm_ChiTiet($idPA){
		$sql = "SELECT * FROM phapam WHERE idPA = $idPA";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	
	function PhapAm_Them(&$loi){		
		$thanhcong=true;
			
		$File= $this->processData($_POST[File]);		
		$TieuDe= $this->processData($_POST[TieuDe]);
		$HinhMH= $this->processData($_POST[HinhMH]);
		
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "INSERT INTO phapam
					VALUES(NULL,'$TieuDe','$HinhMH','$File')";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
	}
	function PhapAm_Sua($idPA,&$loi){	
		settype($idPA,"int");
		$thanhcong=true;		
		$File= $this->processData($_POST[File]);
		$TieuDe= $this->processData($_POST[TieuDe]);
		$HinhMH= $this->processData($_POST[HinhMH]);
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "UPDATE phapam
					SET TieuDe = '$TieuDe',HinhMH = '$HinhMH',File = '$File' WHERE idPA = $idPA";
			mysql_query($sql) or die(mysql_error().$sql);			
		}
		return $thanhcong;
	}
	
	function PhapAm_List($limit = -1 ,$offset=-1){		
		$sql = "SELECT * FROM phapam WHERE idPA > 0 ";	
		$sql.="ORDER BY idPA DESC ";
		if($limit > 0 && $offset >=0) $sql .= "LIMIT $offset,$limit";

		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}		
}

?>