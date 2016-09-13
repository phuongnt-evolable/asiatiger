<?php 
require_once "../Model/Db.php";
class visa extends db{
	
	function ListThongTinVisa(){
		$sql = "SELECT * FROM dvt_visa_thongtin";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function ListDichVuVisa(){
		$sql = "SELECT * FROM dvt_visa_dichvu";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function LayIdTT($TenTT_KD){
		$sql = "SELECT idTT FROM dvt_visa_thongtin WHERE TenTT_KD = '$TenTT_KD'";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		return $row[idTT];
	}
	function LayIdDV($TenDV_KD){
		$sql = "SELECT idDV FROM dvt_visa_dichvu WHERE TenDV_KD = '$TenDV_KD'";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		return $row[idDV];
	}
	
	/* BAI VIET VISA*/
	function BaiViet_Visa_Them(&$loi){	
	
		$thanhcong=true;
		$idCL = $_POST[idCL];settype($idCL,"int");
		$idLoai = $_POST[idLoai];settype($idLoai,"int");
		
		$TieuDe= $this->processData($_POST[TieuDe]);
		$TieuDe_KD = $this->processData($_POST[TieuDe_KD]);
		
		$MoTa = nl2br($this->processData($_POST[MoTa]));
		
		$NoiDung = $_POST[NoiDung];
		   
                $UrlHinh = $this->processData($_POST[UrlHinh]);
		$Title = $this->processData($_POST[Title]);
		$MetaD = $this->processData($_POST[MetaD]);
		$MetaK = $this->processData($_POST[MetaK]);

		
		if($Title=="") $Title=$TieuDe;
		if($MetaD=="") $MetaD=$TieuDe;
		if($MetaK=="") $MetaK=$TieuDe;
		if($TieuDe_KD=="") $TieuDe_KD = $this->changeTitle($TieuDe);
	
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "INSERT INTO dvt_visa_baiviet
					VALUES(NULL,'$TieuDe','$TieuDe_KD','$UrlHinh','$MoTa','$NoiDung'
					,$idCL,$idLoai,'$Title','$MetaD','$MetaK')";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
	}
        function BaiViet_Visa_Sua($idBV,&$loi){
                settype($idBV,"int");
                $thanhcong=true;
                
		$idCL = $_POST[idCL];settype($idCL,"int");
		$idLoai = $_POST[idLoai];settype($idLoai,"int");
		
		$TieuDe= $this->processData($_POST[TieuDe]);
		$TieuDe_KD = $this->processData($_POST[TieuDe_KD]);
		
		$MoTa = nl2br($this->processData($_POST[MoTa]));
		
		$NoiDung = $_POST[NoiDung];
		   
                $UrlHinh = $this->processData($_POST[UrlHinh]);
		$Title = $this->processData($_POST[Title]);
		$MetaD = $this->processData($_POST[MetaD]);
		$MetaK = $this->processData($_POST[MetaK]);

		
		if($Title=="") $Title=$TieuDe;
		if($MetaD=="") $MetaD=$TieuDe;
		if($MetaK=="") $MetaK=$TieuDe;
		if($TieuDe_KD=="") $TieuDe_KD = $this->changeTitle($TieuDe);
	
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "UPDATE dvt_visa_baiviet
					SET TieuDe = '$TieuDe',TieuDe_KD = '$TieuDe_KD',UrlHinh ='$UrlHinh',
                                        MoTa='$MoTa',NoiDung = '$NoiDung',idCL = $idCL,
                                        idLoai = $idLoai,Title = '$Title',MetaD = '$MetaD',MetaK = '$MetaK' 
                                        WHERE idBV = $idBV";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
        }
	
	
	
	function BaiViet_Visa_List($idCL=-1,$idLoai=-1,$offset=-1,$limit=-1)
	{		
		$sql = "SELECT * FROM dvt_visa_baiviet WHERE Title!='' ";
		if($idCL >= 0 && $idLoai > 0) $sql = $sql." AND idCL = $idCL AND idLoai = $idLoai ";
		$sql.=" ORDER BY idBV DESC ";	
		if($limit > 0 && $offset >=0 ) $sql.= " LIMIT $offset,$limit";	
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
        function BaiViet_Visa($idCL,$offset=-1,$limit=-1)
	{		
		$sql = "SELECT * FROM dvt_visa_baiviet WHERE idCL=$idCL ORDER BY idBV DESC ";	
		if($limit > 0 && $offset >=0 ) $sql.= " LIMIT $offset,$limit";		
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function ChiTiet_BaiViet_Visa($idBV)
	{
		$sql = "SELECT * FROM dvt_visa_baiviet WHERE idBV = $idBV";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
    
	
}

?>