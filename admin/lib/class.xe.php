<?php 
require_once "../Model/Db.php";
class Xe extends db{
	
	function ListCho(){
		$sql = "SELECT * FROM dvt_xe_cho";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function HangXe_List(){
		$sql = "SELECT * FROM dvt_xe_hang";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function LayIdHang($TieuDe_KD){
		$sql = "SELECT idHang FROM dvt_xe_hang WHERE TenHang_KD = '$TieuDe_KD'";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		return $row[idHang];
		
	}
	function LayIdCho($TieuDe_KD){
		$sql = "SELECT idCho FROM dvt_xe_cho WHERE SoCho_KD = '$TieuDe_KD'";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		return $row[idCho];
		
	}
	function LaySoCho($idCho){
		$sql = "SELECT SoCho FROM dvt_xe_cho WHERE idCho = '$idCho'";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		return $row[SoCho];
		
	}
	function List_Xe_Ajax($idCho,$offset = 0){
		$sql = "SELECT * FROM dvt_xe_baiviet WHERE Title!='' ";
		if($idCho == 3) $sql.= " AND idCho <= 3";
		if($idCho == 5) $sql .= " AND idCho >=4 AND idCho <=5 ";
		if($idCho == 7) $sql .= " AND idCho >=6 AND idCho <=7 ";
		$sql .= " ORDER BY idBV DESC ";
		if($offset >= 0 )$sql .= " LIMIT $offset,6";
		$rs = mysql_query($sql);
		return $rs;
	}
	
	/* BAI VIET THUE XE*/
	function BaiViet_Xe_Them(&$loi){	
	
		$thanhcong=true;
		
		$TieuDe= $this->processData($_POST[TieuDe]);
		$TieuDe_KD = $this->processData($_POST[TieuDe_KD]);
		
		$XeHienCo = $_POST[XeHienCo];
		
		$ChiTietXe = $_POST[ChiTietXe];
		$GiaThue = $_POST[GiaThue];
		
		$idHang = $_POST[idHang];settype($idHang,"int");
		$idCho = $_POST[idCho];settype($idCho,"int");
   
        $HinhMH = $this->processData($_POST[HinhMH]);
		$HinhAnh = $this->LayThuVienAnh($HinhMH);
		
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
			echo $sql = "INSERT INTO dvt_xe_baiviet
					VALUES(NULL,'$TieuDe','$TieuDe_KD','$HinhMH','$HinhAnh','$XeHienCo','$ChiTietXe','GiaThue'
					,$idHang,$idCho,'$Title','$MetaD','$MetaK')";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
	}
        function BaiViet_Xe_Sua($idBV,&$loi){	
	
		$thanhcong=true;
		
		$TieuDe= $this->processData($_POST[TieuDe]);
		$TieuDe_KD = $this->processData($_POST[TieuDe_KD]);
		
		$XeHienCo = $_POST[XeHienCo];
		
		$ChiTietXe = $_POST[ChiTietXe];
		$GiaThue = $_POST[GiaThue];
		
		$idHang = $_POST[idHang];settype($idHang,"int");
		$idCho = $_POST[idCho];settype($idCho,"int");
   
        $HinhMH = $this->processData($_POST[HinhMH]);
		$HinhAnh = $this->LayThuVienAnh($HinhMH);
		
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
			$sql = "UPDATE dvt_xe_baiviet
				SET TieuDe = '$TieuDe',TieuDe_KD = '$TieuDe_KD',HinhMH = '$HinhMH',HinhAnh = '$HinhAnh',
                                XeHienCo = '$XeHienCo',ChiTietXe = '$ChiTietXe',GiaThue= '$GiaThue'
                                ,idHang = $idHang,idCho = $idCho,
                                Title = '$Title',MetaD='$MetaD',MetaK = '$MetaK' 
                                WHERE idBV = $idBV";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
	}
        
	
	function BaiViet_List($idCho=-1,$idHang=-1,$offset=-1,$limit=-1)
	{		
		$sql = "SELECT * FROM dvt_xe_baiviet WHERE Title!='' ";
		if($idCho>0) $sql = $sql." AND idCho = $idCho";
		if($idHang>0) $sql = $sql." AND idHang = $idHang";	
		$sql.= " ORDER BY idBV DESC ";	
		if($limit > 0 && $offset >=0 ) $sql.= " LIMIT $offset,$limit";	
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function ChiTiet_BaiViet_ThueXe($idBV)
	{
		$sql = "SELECT * FROM dvt_xe_baiviet WHERE idBV = $idBV";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
    
	
}

?>