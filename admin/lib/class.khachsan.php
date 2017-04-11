<?php 
require_once "../Model/Db.php";
class khachsan extends db{
	
    function LayIdMienCuaDanhMucKS($idDM_KS){
        $sql = "SELECT idMien FROM dvt_ks_danhmuc WHERE idDM_KS = $idDM_KS";
        $rs = mysql_query($sql);
        $row = mysql_fetch_assoc($rs);
        return $row[idMien];
    }
	function LayDM_KS($idDM_KS){
        $sql = "SELECT TenDM_KS FROM dvt_ks_danhmuc WHERE idDM_KS = $idDM_KS";
        $rs = mysql_query($sql);
        $row = mysql_fetch_assoc($rs);
        return $row[TenDM_KS];
    }
    function LayIdDM_KS($TenDM_KS_KD){
	$sql = "SELECT idDM_KS FROM dvt_ks_danhmuc WHERE TenDM_KS_KD = '$TenDM_KS_KD'";
        $rs = mysql_query($sql);
        $row = mysql_fetch_assoc($rs);
        return $row[idDM_KS];
    }    
	/* VUNG MIEN */
	
	function VungMien_List(){
		$sql = "SELECT * FROM dvt_vungmien ORDER BY idMien";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function VungMien_ChiTiet($idMien){
		$sql = "SELECT * FROM dvt_vungmien WHERE idMien = $idMien";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function VungMien_Sua($idMien){
		
	}
	function VungMien_Xoa($idMien){
		$sql= "DELETE FROM dvt_vungmien WHERE idMien = $idMien";
		mysql_query($sql) or die(mysql_error());
	}
	
	/* TIEU CHUAN KHACH SAN */
	
	function TieuChuan_List(){
		$sql = "SELECT * FROM dvt_ks_tieuchuan ORDER BY idTC";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function TieuChuan_ChiTiet($idTC){
		$sql = "SELECT * FROM dvt_ks_tieuchuan WHERE idTC = $idTC";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function TieuChuan_Sua($idTC){
		
	}
	function TieuChuan_Xoa($idTC){
		$sql= "DELETE FROM dvt_ks_tieuchuan WHERE idTC = $idTC";
		mysql_query($sql) or die(mysql_error());
	}
	
	/* DANH MUC KHACH SAN */
	function DanhMuc_Them(&$loi){	
	
		$thanhcong=true;
		
		$quocgia = $_POST[quocgia];settype($quocgia,"int");
		$idMien = $_POST[idMien];settype($idMien,"int");
		$TenDM_KS = $this->processData($_POST[TenDM_KS]);
		$TenDM_KS_KD = $this->processData($_POST[TenDM_KS_KD]);
		$Title = $this->processData($_POST[Title]);
		$MetaD = $this->processData($_POST[MetaD]);
		$MetaK = $this->processData($_POST[MetaK]);
		
		$ThuTu = $this->ThuTuMax('dvt_ks_danhmuc') + 1;
		
		$AnHien = $_POST[AnHien];settype($AnHien,"int");
		
		if($Title=="") $Title=$TenDM_KS;
		if($MetaD=="") $MetaD=$TenDM_KS;
		if($MetaK=="") $MetaK=$TenDM_KS;
		if($TenDM_KS_KD=="") $TenDM_KS_KD = $this->changeTitle($TenDM_KS);
		
		if($idMien==0 && $quocgia==0)
		{
			$thanhcong= false;
			$loi[idMien]= "Chọn miền";
		}
		if($TenDM_KS=="")
		{
			$thanhcong= false;
			$loi[TenDM_KS]= "Chưa nhập tên danh mục";
		}
	
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "INSERT INTO dvt_ks_danhmuc 
					VALUES(NULL,$quocgia,$idMien,'$TenDM_KS','$TenDM_KS_KD','$Title','$MetaD','$MetaK',$ThuTu,$AnHien)";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
	}
	function DanhMuc_KS_Sua($idDM_KS,&$loi){
		settype($idDM_KS,"int");
		$thanhcong=true;
		
		$quocgia = $_POST[quocgia];settype($quocgia,"int");
		$idMien = $_POST[idMien];settype($idMien,"int");
		$TenDM_KS = $this->processData($_POST[TenDM_KS]);
		$TenDM_KS_KD = $this->processData($_POST[TenDM_KS_KD]);
		$Title = $this->processData($_POST[Title]);
		$MetaD = $this->processData($_POST[MetaD]);
		$MetaK = $this->processData($_POST[MetaK]);
		
		$AnHien = $_POST[AnHien];settype($AnHien,"int");
		
		if($Title=="") $Title=$TenDM_KS;
		if($MetaD=="") $MetaD=$TenDM_KS;
		if($MetaK=="") $MetaK=$TenDM_KS;
		if($TenDM_KS_KD=="") $TenDM_KS_KD = $this->changeTitle($TenDM_KS);
		
		if($idMien==0 && $quocgia==0)
		{
			$thanhcong= false;
			$loi[idMien]= "Chọn miền";
		}
		if($TenDM_KS=="")
		{
			$thanhcong= false;
			$loi[TenDM_KS]= "Chưa nhập tên danh mục";
		}
	
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "UPDATE  dvt_ks_danhmuc 
					SET quocgia = $quocgia ,idMien = $idMien,TenDM_KS='$TenDM_KS',
					TenDM_KS_KD = '$TenDM_KS_KD',Title = '$Title',MetaD = '$MetaD',
					MetaK = '$MetaK',AnHien = $AnHien WHERE idDM_KS = $idDM_KS";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
    }
    function DanhMuc_KS_List($quocgia){
        $sql = "SELECT * FROM dvt_ks_danhmuc WHERE quocgia = $quocgia ORDER BY ThuTu";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function DanhMuc_KS_TrongNuoc(){
        $sql = "SELECT * FROM dvt_ks_danhmuc WHERE quocgia = 1 AND AnHien = 1";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function DanhMuc_KS_NgoaiNuoc(){
        $sql = "SELECT * FROM dvt_ks_danhmuc WHERE quocgia = 2 AND AnHien = 1 ";
        return mysql_query($sql);
    }
    
    function KhachSan_Them(&$loi){
        $thanhcong=true;
		
		$quocgia = $_POST[quocgia];settype($quocgia,"int");
		$idDM_KS = $_POST[idDM_KS];settype($idDM_KS,"int");
        $idTC = $_POST[idTC];settype($idTC,"int");
		$TieuDeKS = $this->processData($_POST[TieuDeKS]);
		$TieuDeKS_KD = $this->processData($_POST[TieuDeKS_KD]);
		$Title = $this->processData($_POST[Title]);
		$MetaD = $this->processData($_POST[MetaD]);
		$TongQuan = $_POST[TongQuan];
		$GiaPhong = $_POST[GiaPhong];
		$MetaK = $this->processData($_POST[MetaK]);
		
		$AnHien = $_POST[AnHien];settype($AnHien,"int");
        
        $DiaChi = $this->processData($_POST[DiaChi]);
        $HinhMH = $this->processData($_POST[HinhMH]);
        
        $HinhAnh = $this->LayThuVienAnh($HinhMH);
        $idMien = $this->LayIdMienCuaDanhMucKS($idDM_KS);
      
		if($Title=="") $Title=$TieuDeKS;
		if($MetaD=="") $MetaD=$TieuDeKS;
		if($MetaK=="") $MetaK=$TieuDeKS;
		if($TieuDeKS_KD=="") $TieuDeKS_KD = $this->changeTitle($TieuDeKS);
		
		if($idDM_KS==0)
		{
			$thanhcong= false;
			$loi[idDM_KS]= "Chọn danh mục";
		}
        if($idTC==0)
		{
			$thanhcong= false;
			$loi[idTC]= "Chọn tiêu chuẩn";
		}
		if($TieuDeKS=="")
		{
			$thanhcong= false;
			$loi[TieuDeKS]= "Chưa nhập tiêu đề";
		}
	    
        if($HinhMH=="")
		{
			$thanhcong= false;
			$loi[HinhMH]= "Chưa nhập hình đại diện";
		}
		
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "INSERT INTO dvt_ks 
					VALUES(NULL,$quocgia,$idDM_KS,$idTC,$idMien,'$TieuDeKS','$TieuDeKS_KD','$DiaChi','$HinhMH'
                    ,'$HinhAnh','$TongQuan','$GiaPhong','$Title','$MetaD','$MetaK',$AnHien)";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
    }
	function KhachSan_Sua($idKS,&$loi){
        $thanhcong=true;
		
		$quocgia = $_POST[quocgia];settype($quocgia,"int");
		$idDM_KS = $_POST[idDM_KS];settype($idDM_KS,"int");
        $idTC = $_POST[idTC];settype($idTC,"int");
		$TieuDeKS = $this->processData($_POST[TieuDeKS]);
		$TieuDeKS_KD = $this->processData($_POST[TieuDeKS_KD]);
		$Title = $this->processData($_POST[Title]);
		$MetaD = $this->processData($_POST[MetaD]);
		$TongQuan = $_POST[TongQuan];
		$GiaPhong = $_POST[GiaPhong];
		$MetaK = $this->processData($_POST[MetaK]);
		
		$AnHien = $_POST[AnHien];settype($AnHien,"int");
        
        $DiaChi = $this->processData($_POST[DiaChi]);
        $HinhMH = $this->processData($_POST[HinhMH]);
        
        $HinhAnh = $this->LayThuVienAnh($HinhMH);
        $idMien = $this->LayIdMienCuaDanhMucKS($idDM_KS);
      
		if($Title=="") $Title=$TieuDeKS;
		if($MetaD=="") $MetaD=$TieuDeKS;
		if($MetaK=="") $MetaK=$TieuDeKS;
		if($TieuDeKS_KD=="") $TieuDeKS_KD = $this->changeTitle($TieuDeKS);
		
		if($idDM_KS==0)
		{
			$thanhcong= false;
			$loi[idDM_KS]= "Chọn danh mục";
		}
        if($idTC==0)
		{
			$thanhcong= false;
			$loi[idTC]= "Chọn tiêu chuẩn";
		}
		if($TieuDeKS=="")
		{
			$thanhcong= false;
			$loi[TieuDeKS]= "Chưa nhập tiêu đề";
		}
	    
        if($HinhMH=="")
		{
			$thanhcong= false;
			$loi[HinhMH]= "Chưa nhập hình đại diện";
		}
		
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "UPDATE dvt_ks 
					SET quocgia = $quocgia,idDM_KS = $idDM_KS,idTC = $idTC,
					idMien = $idMien,TieuDeKS = '$TieuDeKS',TieuDeKS_KD = '$TieuDeKS_KD',
					DiaChi = '$DiaChi',HinhMH = '$HinhMH',HinhAnh = '$HinhAnh',
					TongQuan = '$TongQuan',GiaPhong = '$GiaPhong',
					Title ='$Title',MetaD = '$MetaD',MetaK = '$MetaK',AnHien = $AnHien WHERE idKS = $idKS ";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
    }
    
	function DanhMuc_KS_ChiTiet($idDM_KS){
		$sql = "SELECT * FROM dvt_ks_danhmuc WHERE idDM_KS = $idDM_KS";
        $rs = mysql_query($sql);
        return $rs;
	}
    /* LIST KS */
    function ListKS_TheoDM($idDM_KS=-1,$offset=-1,$limit=-1){
        $sql = "SELECT * FROM dvt_ks WHERE (idDM_KS = $idDM_KS OR $idDM_KS=-1)  ORDER BY idKS DESC ";
		if($limit > 0 && $offset >=0 ) $sql.= " LIMIT $offset,$limit";	
        $rs = mysql_query($sql);
        return $rs;
    }
    function KhachSan_ChiTiet($idKS){
        $sql = "SELECT * FROM dvt_ks WHERE idKS = $idKS";
        $rs = mysql_query($sql);
        return $rs;
    }
	function LayIdKS($TieuDeKS_KD){
        $sql = "SELECT idKS FROM dvt_ks WHERE TieuDeKS_KD = '$TieuDeKS_KD'";
        $rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
        return $row['idKS'];
    }
    function ListKS_TheoQuocGia($quocgia=-1,$offset=-1,$limit=-1){

        $sql = "SELECT * FROM dvt_ks ";
				if($quocgia>0) $sql.=" WHERE quocgia = $quocgia ORDER BY idKS DESC ";
		if($limit > 0 && $offset >=0 ) $sql.= " LIMIT $offset,$limit";	
					
        $rs = mysql_query($sql);
        return $rs;
    }
    function ListKS_TheoMien($idMien,$offset=-1,$limit=-1){
        $sql = "SELECT * FROM dvt_ks WHERE idMien = $idMien ORDER BY idKS DESC";
		if($limit > 0 && $offset >=0 ) $sql.= " LIMIT $offset,$limit";	
        $rs = mysql_query($sql);
        return $rs;
    }
    function ListKS_TheoTC($idTC,$offset=-1,$limit=-1){
        $sql = "SELECT * FROM dvt_ks WHERE idTC = $idTC ORDER BY idKS DESC ";
		if($limit > 0 && $offset >=0 ) $sql.= " LIMIT $offset,$limit";	
        $rs = mysql_query($sql);
        return $rs;
    }
    function TimKiem_KS($quocgia,$idDM_KS=-1,$idTC=-1,$offset=-1,$limit=-1){
        $sql = "SELECT * FROM dvt_ks WHERE quocgia = $quocgia ";
        if($idDM_KS > 0) $sql.=" AND (idDM_KS = $idDM_KS OR $idDM_KS=-1) ";
        if($idTC > 0) $sql .= " AND (idTC = $idTC OR $idTC=-1)";
		$sql.=" ORDER BY idKS DESC ";
		if($limit > 0 && $offset >=0 ) $sql.= " LIMIT $offset,$limit";		
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    } 
}

?>