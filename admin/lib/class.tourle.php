<?php 
require_once "../Model/Db.php";
class tourle extends db{	
	/* TOUR */
	function Tour_Le_Them(&$loi){
       
        $thanhcong=true;
	
		$quocgia = $_POST[quocgia];settype($quocgia,"int");
		$idDM_Tour = $_POST[idDM_Tour];settype($idDM_Tour,"int");
		($quocgia==1) ? $idMien = $_POST[idMien]:$idMien = $_POST[idKV];
        settype($idMien,"int");
        $idTC = $_POST[idTC];settype($idTC,"int");
		
		$idDXP = $_POST[idDXP];settype($idDXP,"int");
		$idDD = $_POST[idDD];settype($idDD,"int");
		$PhuongTien = $this->processData($_POST[PhuongTien]);
		$SoNgay = $this->processData($_POST[SoNgay]);settype($SoNgay,"int");
        
		$GiaTien = $this->processData($_POST[GiaTien]);
		
        $NgayDi = $this->processData($_POST[NgayDi]);	
       
        $GioDi = $this->processData($_POST[GioDi]);
        $GioDen = $this->processData($_POST[GioDen]);
		
		$TieuDeTour = $this->processData($_POST[TieuDeTour]);
		$TieuDeTour_KD = $this->processData($_POST[TieuDeTour_KD]);
		$Title = $this->processData($_POST[Title]);
		$MetaD = $this->processData($_POST[MetaD]);
		$MetaK = $this->processData($_POST[MetaK]);
		      
        $HinhMH = $this->processData($_POST[HinhMH]);
      
		
		$CT_TourLe = $_POST[CT_TourLe];		
		$GiaTourLe = $_POST[GiaTourLe];
								
		if($Title=="") $Title=$TieuDeTour;
		if($MetaD=="") $MetaD=$TieuDeTour;
		if($MetaK=="") $MetaK=$TieuDeTour;
		if($TieuDeTour_KD=="") $TieuDeTour_KD = $this->changeTitle($TieuDeTour);
		
		if($idDM_Tour==0)
		{
			$thanhcong= false;
			$loi[idDM_Tour]= "Chọn danh mục";
		}
        if($idTC==0)
		{
			$thanhcong= false;
			$loi[idTC]= "Chọn tiêu chuẩn";
		}
		if($TieuDeTour=="")
		{
			$thanhcong= false;
			$loi[TieuDeTour]= "Chưa nhập tiêu đề";
		}
		    
        if($HinhMH=="")
		{
			$thanhcong= false;
			$loi[HinhMH]= "Chưa nhập hình đại diện";
		}
		
		
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "INSERT INTO dvt_tour_le
					VALUES(NULL,$quocgia,$idMien,$idDM_Tour,$idDXP,
					$idDD,$idTC,'$TieuDeTour','$TieuDeTour_KD','$GiaTien',
                    '$HinhMH','$SoNgay','$NgayDi','$PhuongTien','$GioDi','$GioDen',
					'$CT_TourLe','$GiaTourLe','$Title','$MetaD','$MetaK')";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
    }
    
    function Tour_Le_Sua($idTour,&$loi){      
        
        settype($idTour,"int");
        $thanhcong=true;
	
		$quocgia = $_POST[quocgia];settype($quocgia,"int");
		$idDM_Tour = $_POST[idDM_Tour];settype($idDM_Tour,"int");
		($quocgia==1) ? $idMien = $_POST[idMien]:$idMien = $_POST[idKV];
        settype($idMien,"int");
        $idTC = $_POST[idTC];settype($idTC,"int");
		
		$idDXP = $_POST[idDXP];settype($idDXP,"int");
		$idDD = $_POST[idDD];settype($idDD,"int");
		$PhuongTien = $this->processData($_POST[PhuongTien]);
		$SoNgay = $this->processData($_POST[SoNgay]);settype($SoNgay,"int");
        
		$GiaTien = $this->processData($_POST[GiaTien]);
		
        $NgayDi = $this->processData($_POST[NgayDi]);	
       
        $GioDi = $this->processData($_POST[GioDi]);
        $GioDen = $this->processData($_POST[GioDen]);
		
		$TieuDeTour = $this->processData($_POST[TieuDeTour]);
		$TieuDeTour_KD = $this->processData($_POST[TieuDeTour_KD]);
		$Title = $this->processData($_POST[Title]);
		$MetaD = $this->processData($_POST[MetaD]);
		$MetaK = $this->processData($_POST[MetaK]);
		      
        $HinhMH = $this->processData($_POST[HinhMH]);
      
		
		$CT_TourLe = $_POST[CT_TourLe];		
		$GiaTourLe = $_POST[GiaTourLe];
								
		if($Title=="") $Title=$TieuDeTour;
		if($MetaD=="") $MetaD=$TieuDeTour;
		if($MetaK=="") $MetaK=$TieuDeTour;
		if($TieuDeTour_KD=="") $TieuDeTour_KD = $this->changeTitle($TieuDeTour);
		
		if($idDM_Tour==0)
		{
			$thanhcong= false;
			$loi[idDM_Tour]= "Chọn danh mục";
		}
        if($idTC==0)
		{
			$thanhcong= false;
			$loi[idTC]= "Chọn tiêu chuẩn";
		}
		if($TieuDeTour=="")
		{
			$thanhcong= false;
			$loi[TieuDeTour]= "Chưa nhập tiêu đề";
		}
		    
        if($HinhMH=="")
		{
			$thanhcong= false;
			$loi[HinhMH]= "Chưa nhập hình đại diện";
		}
		
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql_update = "UPDATE dvt_tour_le
					SET quocgia = $quocgia,idMien = $idMien,idDM_Tour = $idDM_Tour,idDXP = $idDXP,
					idDD = $idDD,PhuongTien= '$PhuongTien',idTC = $idTC,SoNgay = '$SoNgay',TieuDeTour = '$TieuDeTour',
                    TieuDeTour_KD = '$TieuDeTour_KD',GiaTien = '$GiaTien',NgayDi = '$NgayDi',
					GioDi = '$GioDi',GioDen = '$GioDen',CT_TourLe = '$CT_TourLe',HinhMH = '$HinhMH',
					GiaTourLe = '$GiaTourLe',Title = '$Title',MetaD = '$MetaD',MetaK = '$MetaK'
                    WHERE idTour = $idTour";
			mysql_query($sql_update) or die(mysql_error().$sql);		
		}
		return $thanhcong;
    }
	
		function ChiTietTour_Le($idTour){
			$sql= "SELECT * 
				FROM dvt_tour_le
				WHERE idTour = $idTour";
            $rs= mysql_query($sql) or die(mysql_error());
            return $rs;
		}
     
		
        function ListTour_Le($quocgia= -1,$idDM_Tour=-1,$idMien=-1,$idDD = -1,$limit=-1,$offset=-1){
                $sql= "SELECT *
                        FROM dvt_tour_le WHERE idTour > 0 ";
				if($quocgia > 0 ) $sql.=" AND quocgia = $quocgia "; 		
				if($idDM_Tour > 0 ) $sql.= " AND idDM_Tour = $idDM_Tour ";
				if($idMien > 0 ) $sql.= " AND idMien = $idMien ";
				if($idDD > 0 ) $sql.= " AND idDD = $idDD ";
				$sql.= " ORDER BY idTour DESC ";
				if($limit > 0 && $offset >=0) $sql .= " LIMIT $offset,$limit";  
				
                $rs = mysql_query($sql);
                return $rs;
        }
	

	function GetIdDM_Tour($TenDM_Tour_KD){
		$sql = "SELECT idDM_Tour FROM dvt_tour_danhmuc WHERE TenDM_Tour_KD = '$TenDM_Tour_KD' ";
		$rs = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($rs);
		return $row[idDM_Tour];
	}
	function GetIdTour_Le($TieuDeTour_KD){
		$sql = "SELECT idTour FROM dvt_tour_le WHERE TieuDeTour_KD = '$TieuDeTour_KD' ";
		$rs = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($rs);
		return $row[idTour];
	}
	
}

?>