<?php 
require_once "../Model/Db.php";
class mucluc extends db{
	
	
	function MucLuc_ChiTiet($idML){
		$sql = "SELECT * FROM mucluc WHERE idML = $idML";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function LayTenThuMuc($idML){
		$sql = "SELECT * FROM mucluc WHERE idML = $idML";
		$rs = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($rs);
		return $row[TenMucLuc];
	}
	function TongSoTrangTrongMucLuc($idML){
		$sql = "SELECT count(*) as tong FROM trang WHERE idDM = $idML";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		return $row['tong'];
	}
	function GetIdTrangMin($idML){
		$sql = "SELECT MIN(ThuTu) as idMin FROM trang WHERE idDM = $idML";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		return $row['idMin'];
	}
	function GetIdTrangMax($idML){
		$sql = "SELECT MAX(ThuTu) as idMax FROM trang WHERE idDM = $idML";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		return $row['idMax'];
	}
	
	function MucLuc_Them(&$loi){	
	
		$thanhcong=true;
		
		$TenMucLuc= $this->processData($_POST[TenMucLuc]);
		$idUser=1;
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "INSERT INTO mucluc
					VALUES(NULL,'$TenMucLuc',$idUser)";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
	}
	function MucLuc_Sua($idML,&$loi){	
		settype($idML,"int");
		$thanhcong=true;		
		
		$TenMucLuc= $this->processData($_POST[TenMucLuc]);
		
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "UPDATE mucluc
					SET TenMucLuc = '$TenMucLuc' WHERE idML = $idML";
			mysql_query($sql) or die(mysql_error().$sql);			
		}
		return $thanhcong;
	}
	
	
	function MucLuc_List($idML = -1){		
		$sql = "SELECT * FROM mucluc WHERE idML = $idML or $idML = - 1 ORDER BY  idML DESC ";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
}

?>