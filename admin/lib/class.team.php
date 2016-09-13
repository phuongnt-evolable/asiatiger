<?php 
require_once "../Model/Db.php";
class team extends db{
	
	
	function List_DanhMuc_Team(){
		$sql = "SELECT * FROM dvt_team_loai ORDER BY idLoai ASC";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}	
    function Team_TinTuc_List($idLoai=-1,$offset=-1,$limit=-1){
        $sql = "SELECT * FROM dvt_team_baiviet WHERE idLoai = $idLoai OR $idLoai = -1 ORDER BY idBV DESC ";
		if($limit > 0 && $offset >=0 ) $sql.= " LIMIT $offset,$limit";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
    }
	 function Team_TinTuc($idLoai=-1,$limit=-1,$offset=-1){
        $sql = "SELECT dvt_team_baiviet.*,TenLoai FROM dvt_team_baiviet,dvt_team_loai WHERE (dvt_team_baiviet.idLoai = $idLoai OR $idLoai = -1) AND dvt_team_baiviet.idLoai = dvt_team_loai.idLoai ORDER BY idBV DESC";
		if($limit > 0 && $offset >=0) $sql .= " LIMIT $offset,$limit";  
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
    }
	function Chuong_Trinh_Team(){
		$sql = "SELECT * FROM dvt_team_baiviet WHERE idLoai = 2 ORDER BY idBV DESC LIMIT 0,5";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	
	function Team_ChiTiet_TinTuc($idBV)
	{
		$sql = "SELECT * FROM dvt_team_baiviet WHERE idBV = $idBV";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	
	
	/* BAI VIET TEAM*/
	function BaiViet_Team_Them(&$loi){	
	
		$thanhcong=true;
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
	/*	
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
		if($ThuTu=="")
		{
			$thanhcong= false;
			$loi[ThuTu]= "Chưa nhập thứ tự";
		}
		*/
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "INSERT INTO dvt_team_baiviet
					VALUES(NULL,$idLoai,'$TieuDe','$TieuDe_KD','$MoTa','$NoiDung','$UrlHinh'
					,'$Title','$MetaD','$MetaK')";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
	}
    function BaiViet_Team_Edit($idBV,&$loi){	
	
		$thanhcong=true;
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
	/*	
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
		if($ThuTu=="")
		{
			$thanhcong= false;
			$loi[ThuTu]= "Chưa nhập thứ tự";
		}
		*/
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "UPDATE dvt_team_baiviet
					SET idLoai = $idLoai,TieuDe = '$TieuDe',TieuDe_KD = '$TieuDe_KD',
                    MoTa = '$MoTa',NoiDung = '$NoiDung',UrlHinh = '$UrlHinh'
					,Title = '$Title',MetaD = '$MetaD',MetaK = '$MetaK' WHERE idBV = $idBV";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
	}
	
	    
	
}

?>