<?php 
require_once "../Model/Db.php";
class tour extends db{
	
	/* DANH MUC TOUR */
	function DanhMuc_Them(&$loi){	
	
		$thanhcong=true;
				
		$quocgia = $_POST[quocgia];settype($quocgia,"int");				
		$TenDM_Tour = $this->processData($_POST[TenDM_Tour]);
		$TenDM_Tour_KD = $this->processData($_POST[TenDM_Tour_KD]);
		$Title = $this->processData($_POST[Title]);
		$MetaD = $this->processData($_POST[MetaD]);
		$MetaK = $this->processData($_POST[MetaK]);
		
		$ThuTu = $this->ThuTuMax('dvt_tour_danhmuc') + 1;
		$AnHien = $_POST[AnHien];settype($AnHien,"int");	
		
		if($Title=="") $Title=$TenDM_Tour;
		if($MetaD=="") $MetaD=$TenDM_Tour;
		if($MetaK=="") $MetaK=$TenDM_Tour;
		if($TenDM_Tour_KD=="") $TenDM_Tour_KD = $this->changeTitle($TenDM_Tour);
		
		
		if($TenDM_Tour=="")
		{
			$thanhcong= false;
			$loi[TenDM_Tour]= "Chưa nhập tên danh mục";
		}

		
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "INSERT INTO dvt_tour_danhmuc 
					VALUES(NULL,$quocgia,'$TenDM_Tour',
					'$TenDM_Tour_KD','$Title','$MetaD','$MetaK',$ThuTu,$AnHien)";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
	}
    function DanhMuc_Sua($idDM_Tour,&$loi){	
	
        settype($idDM_Tour,"int");
		$thanhcong=true;
				
		$quocgia = $_POST[quocgia];settype($quocgia,"int");		
		$TenDM_Tour = $this->processData($_POST[TenDM_Tour]);
		$TenDM_Tour_KD = $this->processData($_POST[TenDM_Tour_KD]);
		$Title = $this->processData($_POST[Title]);
		$MetaD = $this->processData($_POST[MetaD]);
		$MetaK = $this->processData($_POST[MetaK]);
		
		$AnHien = $_POST[AnHien];settype($AnHien,"int");	
		
		if($Title=="") $Title=$TenDM_Tour;
		if($MetaD=="") $MetaD=$TenDM_Tour;
		if($MetaK=="") $MetaK=$TenDM_Tour;
		if($TenDM_Tour_KD=="") $TenDM_Tour_KD = $this->changeTitle($TenDM_Tour);
		
		
		if($TenDM_Tour=="")
		{
			$thanhcong= false;
			$loi[TenDM_Tour]= "Chưa nhập tên danh mục";
		}
		
		
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "UPDATE dvt_tour_danhmuc 
					SET TenDM_Tour = '$TenDM_Tour',
					quocgia = $quocgia,TenDM_Tour_KD = '$TenDM_Tour_KD',
                    Title = '$Title',MetaD = '$MetaD',MetaK = '$MetaK',AnHien = $AnHien WHERE idDM_Tour = $idDM_Tour";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
	}
	function DanhMuc_List_QuocGia($quocgia){
			$sql = "SELECT * FROM dvt_tour_danhmuc WHERE quocgia = $quocgia";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function DanhMuc_List($quocgia){
		$sql = "SELECT * FROM dvt_tour_danhmuc WHERE quocgia=$quocgia ORDER BY ThuTu ASC ";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function DanhMuc_Menu_TrongNuoc($limit){
		$sql = "SELECT * FROM dvt_tour_danhmuc WHERE quocgia = 1 ORDER BY ThuTu LIMIT 0,$limit";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function DanhMuc_Menu_NgoaiNuoc($limit){
		$sql = "SELECT * FROM dvt_tour_danhmuc WHERE quocgia = 2 ORDER BY ThuTu  LIMIT 0,$limit";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
    function DanhMuc_ChiTiet($idDM_Tour){
		$sql = "SELECT * FROM dvt_tour_danhmuc WHERE idDM_Tour = $idDM_Tour";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	/* DIEM XUAT PHAT */
	function DiemXuatPhat_List(){
		$sql = "SELECT * FROM dvt_tour_dxp";
		$rs = mysql_query($sql);
		return $rs;
	}
	
	/* DIEM DEN */
	function DiemDen_List_QuocGia($quocgia){
		$sql = "SELECT * FROM dvt_tour_diemden WHERE quocgia= $quocgia";
		$rs = mysql_query($sql);
		return $rs;
	}
	
	/* PHUONG TIEN */
	function PhuongTien_List(){
		$sql = "SELECT * FROM dvt_tour_pt";
		$rs = mysql_query($sql);
		return $rs;
	}
	
	/* TOUR */
	function Tour_Them(&$loi){
        $thanhcong=true;
		
		$quocgia = $_POST[quocgia];settype($quocgia,"int");
		$idDM_Tour = $_POST[idDM_Tour];settype($idDM_Tour,"int");
		$idMien = $_POST[idMien];settype($idMien,"int");
        $idTC = $_POST[idTC];settype($idTC,"int");
		
		$idDXP = $_POST[idDXP];settype($idDXP,"int");
		$idDD = $_POST[idDD];settype($idDD,"int");
		$idPT = $_POST[idPT];settype($idPT,"int");
		$idTG = $_POST[idTG];settype($idTG,"int");
        
		$GiaTien = $this->processData($_POST[GiaTien]);
		$ApDung = $this->processData($_POST[ApDung]);
		$KhoiHanh = $this->processData($_POST[KhoiHanh]);
		
		$TieuDeTour = $this->processData($_POST[TieuDeTour]);
		$TieuDeTour_KD = $this->processData($_POST[TieuDeTour_KD]);
		$Title = $this->processData($_POST[Title]);
		$MetaD = $this->processData($_POST[MetaD]);
		$MetaK = $this->processData($_POST[MetaK]);
		
        
        $ThuTu = $this->ThuTuMax('dvt_tour') + 1;
		
        
        $AnHien = $_POST[AnHien];settype($AnHien,"int");        
        $Moi = $_POST[Moi];settype($Moi,"int");
	    $Hot = $_POST[Hot];settype($Hot,"int");
	   
        $HinhMH = $this->processData($_POST[HinhMH]);
        $AnhNen = $this->processData($_POST[AnhNen]);
      	
		$CT_TourDoan = $_POST[CT_TourDoan];
		$CT_TourLe = $_POST[CT_TourLe];
		$GiaTourDoan = $_POST[GiaTourDoan];
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
			$sql = "INSERT INTO dvt_tour
					VALUES(NULL,$quocgia,$idMien,$idDM_Tour,$idDXP,
					$idDD,$idPT,$idTC,$idTG,'$TieuDeTour','$TieuDeTour_KD','$GiaTien','$ApDung',
					'$KhoiHanh','$HinhMH','$AnhNen',$ThuTu,$AnHien,$Moi,$Hot,'$CT_TourDoan','$GiaTourDoan',
					'$CT_TourLe','$GiaTourLe','$Title','$MetaD','$MetaK')";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
    }
    
    function Tour_Sua($idTour,&$loi){
    // echo $idTour;die;
        settype($idTour,"int");
        $thanhcong=true;
	
		$quocgia = $_POST[quocgia];settype($quocgia,"int");
		$idDM_Tour = $_POST[idDM_Tour];settype($idDM_Tour,"int");
		$idMien = $_POST[idMien];settype($idMien,"int");
        $idTC = $_POST[idTC];settype($idTC,"int");
		
		$idDXP = $_POST[idDXP];settype($idDXP,"int");
		$idDD = $_POST[idDD];settype($idDD,"int");
		$idPT = $_POST[idPT];settype($idPT,"int");
		$idTG = $_POST[idTG];settype($idTG,"int");
        
		$GiaTien = $this->processData($_POST[GiaTien]);
		$ApDung = $this->processData($_POST[ApDung]);
		$KhoiHanh = $this->processData($_POST[KhoiHanh]);
		
		$TieuDeTour = $this->processData($_POST[TieuDeTour]);
		$TieuDeTour_KD = $this->processData($_POST[TieuDeTour_KD]);
		$Title = $this->processData($_POST[Title]);
		$MetaD = $this->processData($_POST[MetaD]);
		$MetaK = $this->processData($_POST[MetaK]);
		
		$AnHien = $_POST[AnHien];settype($AnHien,"int");        
        $Moi = $_POST[Moi];settype($Moi,"int");
	    $Hot = $_POST[Hot];settype($Hot,"int");
      
        $HinhMH = $this->processData($_POST[HinhMH]);
        $AnhNen = $this->processData($_POST[AnhNen]);
      	
		$CT_TourDoan = $_POST[CT_TourDoan];
		$CT_TourLe = $_POST[CT_TourLe];
		$GiaTourDoan = $_POST[GiaTourDoan];
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
			$sql_update = "UPDATE dvt_tour
					SET quocgia = $quocgia,idMien = $idMien,idDM_Tour = $idDM_Tour,idDXP = $idDXP,
					idDD = $idDD,idPT = $idPT,idTC = $idTC,idTG = $idTG,TieuDeTour = '$TieuDeTour',
                    TieuDeTour_KD = '$TieuDeTour_KD',GiaTien = '$GiaTien',ApDung = '$ApDung',
					KhoiHanh = '$KhoiHanh',HinhMH = '$HinhMH',AnhNen = '$AnhNen',
                    AnHien = $AnHien,New = $Moi,Hot = $Hot,CT_TourDoan = '$CT_TourDoan',GiaTourDoan = '$GiaTourDoan',
					CT_TourLe = '$CT_TourLe',GiaTourLe = '$GiaTourLe',Title = '$Title',MetaD = '$MetaD',MetaK = '$MetaK'
                    WHERE idTour = $idTour";
			mysql_query($sql_update) or die(mysql_error().$sql);		
		}
		return $thanhcong;
    }
	
	
	function List_Tour_TrangChu($quocgia,$vungmien = -1,$offset=-1){
		
		$sql = "SELECT idTour,TieuDeTour,TieuDeTour_KD,GiaTien,HinhMH,TenPT,ThoiGian ,idTC
				FROM dvt_tour,dvt_tour_pt,dvt_tour_thoigian 
				WHERE dvt_tour.idTG = dvt_tour_thoigian.idTG
				AND dvt_tour.idPT = dvt_tour_pt.idPT
				AND quocgia=$quocgia AND New = 1 ";
		if($vungmien > 0 ) $sql .=" AND idMien = $vungmien ";
		$sql .=" ORDER BY idTour DESC ";
		if($offset >= 0 ) $sql .= "LIMIT $offset,4";		
		$rs = mysql_query($sql);
		return $rs;
	}
        function ListTourTheoDanhMuc($idDM_Tour){
            $sql= "SELECT TieuDeTour,TieuDeTour_KD,GiaTien,HinhMH,TenPT,ThoiGian ,idTC
				FROM dvt_tour,dvt_tour_pt,dvt_tour_thoigian 
				WHERE dvt_tour.idTG = dvt_tour_thoigian.idTG
				AND dvt_tour.idPT = dvt_tour_pt.idPT
				AND idDM_Tour=$idDM_Tour AND dvt_tour.AnHien = 1 ORDER BY idTour DESC";
            $rs= mysql_query($sql) or die(mysql_error());
            return $rs;
        }
        function ListTourTheoThoiGian($idTG){
            $sql= "SELECT TieuDeTour,TieuDeTour_KD,GiaTien,HinhMH,TenPT,ThoiGian ,idTC
				FROM dvt_tour,dvt_tour_pt,dvt_tour_thoigian 
				WHERE dvt_tour.idTG = dvt_tour_thoigian.idTG
				AND dvt_tour.idPT = dvt_tour_pt.idPT
				AND dvt_tour.idTG=$idTG AND dvt_tour.AnHien = 1 ORDER BY idTour DESC";
            $rs= mysql_query($sql) or die(mysql_error());
            return $rs;
        }
		function ChiTietTour($idTour){
			$sql= "SELECT dvt_tour.*,TieuDeTour,TieuDeTour_KD,GiaTien,HinhMH,TenPT,ThoiGian ,idTC,ApDung
				FROM dvt_tour,dvt_tour_pt,dvt_tour_thoigian 
				WHERE dvt_tour.idTG = dvt_tour_thoigian.idTG
				AND dvt_tour.idPT = dvt_tour_pt.idPT
				AND dvt_tour.idTour = $idTour";
            $rs= mysql_query($sql) or die(mysql_error());
            return $rs;
		}
		function LayTieuDeTour($idTour){
			$sql= "SELECT TieuDeTour FROM dvt_tour_le
				WHERE idTour = $idTour";
            $rs= mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($rs);
			$tieude = $row['TieuDeTour'];
			return $tieude;
		}
        function Lay_TenDM_Tour($idDM_Tour){
            $sql = "SELECT TenDM_Tour FROM dvt_tour_danhmuc WHERE idDM_Tour = $idDM_Tour ";
            $rs = mysql_query($sql) or die(mysql_error());
            $row = mysql_fetch_assoc($rs);
            return $row[TenDM_Tour];
        }
		 function ListTour_Admin($quocgia= -1,$idDM_Tour=-1,$idMien=-1,$idDD = -1,$limit=-1,$offset=-1){
                $sql= "SELECT *
                        FROM dvt_tour WHERE idTour > 0 ";
				if($quocgia > 0 ) $sql.=" AND quocgia = $quocgia "; 		
				if($idDM_Tour > 0 ) $sql .= " AND idDM_Tour = $idDM_Tour ";
				if($idMien > 0 ) $sql .= " AND idMien = $idMien ";
				if($idDD > 0 ) $sql .= " AND idDD = $idDD ";
				$sql.= " ORDER BY idTour DESC ";
				if($limit > 0 && $offset >=0) $sql .= "LIMIT $offset,$limit";  
                $rs = mysql_query($sql);
                return $rs;
		}
			
		
		
        function ListTour($qg=-1,$idDM_Tour=-1,$idDXP=-1,$idTG=-1,$offset=-1,$limit=-1){
                $sql= "SELECT idTour,TieuDeTour,TieuDeTour_KD,GiaTien,HinhMH,TenPT,ThoiGian ,idTC
                        FROM dvt_tour,dvt_tour_pt,dvt_tour_thoigian 
                        WHERE dvt_tour.idTG = dvt_tour_thoigian.idTG
                        AND dvt_tour.idPT = dvt_tour_pt.idPT ";

                if($qg > 0 && $idDM_Tour > 0 && $idDXP > 0){
                        $sql.="AND dvt_tour.quocgia=$qg AND dvt_tour.idDM_Tour = $idDM_Tour AND dvt_tour.idDXP = $idDXP";
                        if($qg==1) $caption = "tour trong nước XP Từ ";
                        else $caption = "tour nước ngoài XP từ ";
                        if($idDXP==1) $caption.="Hồ Chí Minh";
                        if($idDXP==2) $caption.="Hà Nội";	
                        if($idDXP==3) $caption.="Đà Nẵng";			
                }
                if($qg == 0 && $idDM_Tour ==0 && $idDXP == 0 && $idTG >0 ){
                        $sql.="AND dvt_tour.idTG = $idTG";
                        $caption = "TOUR ".$this->Lay_ThoiGian($idTG);
                }
                if($qg == 0 && $idDM_Tour > 0 && $idDXP == 0 && $idTG == 0 ){
                            $sql.="AND dvt_tour.idDM_Tour = $idDM_Tour";
                            $caption = $this->Lay_TenDM_Tour($idDM_Tour);
                }
                if($qg > 0 && $idDM_Tour == 0 && $idDXP == 0 && $idTG == 0 ) {
                        $sql.=" AND dvt_tour.quocgia = $qg";
                        if($qg ==1) $caption = "Tour DU Lịch trong nước";
                        if($qg ==2) $caption = "Tour DU Lịch nước ngoài";
                }
            $sql.= " ORDER BY idTour DESC ";
			if($limit > 0 && $offset >=0 ) $sql.= " LIMIT $offset,$limit";
			
            $rs = mysql_query($sql);	
            while($row = mysql_fetch_assoc($rs)){
                    $data[] =$row;
            }
            $result = array("data"=>$data,"caption"=>$caption);		
            return $result;
        }
		function ListTour_DD($qg=-1,$idDXP=-1,$idDD=-1,$idTG=-1,$offset=-1,$limit=-1){           
			  if($qg>0){
			    $sql= "SELECT dvt_tour.*,idTour,TieuDeTour,TieuDeTour_KD,GiaTien,HinhMH,TenPT,ThoiGian ,idTC
                        FROM dvt_tour,dvt_tour_pt,dvt_tour_thoigian 
                        WHERE dvt_tour.idTG = dvt_tour_thoigian.idTG
                        AND dvt_tour.idPT = dvt_tour_pt.idPT 
						AND dvt_tour.quocgia=$qg 			
						";
			  }
			  if($idDD>0) $sql.=" AND dvt_tour.idDD = $idDD ";
			  if($idTG > 0 ) $sql.= " AND dvt_tour.idTG = $idTG ";
			  if($idDXP > 0 )$sql.= " AND dvt_tour.idDXP = $idDXP ";
			  $caption = "Tour tìm kiếm ";
             /*   if($qg > 0 && $idDD > 0 && $idDXP > 0){
                        $sql.="";
                        if($qg==1) $caption = "tour trong nước XP Từ ";
                        else $caption = "tour nước ngoài XP từ ";
                        if($idDXP==1) $caption.="Hồ Chí Minh";
                        if($idDXP==2) $caption.="Hà Nội";	
                        if($idDXP==3) $caption.="Đà Nẵng";			
                }
                if($qg == 0 && $idDM_Tour ==0 && $idDXP == 0 && $idTG >0 ){
                        $sql.="AND dvt_tour.idTG = $idTG";
                        $caption = "TOUR ".$this->Lay_ThoiGian($idTG);
                }
                if($qg == 0 && $idDM_Tour > 0 && $idDXP == 0 && $idTG == 0 ){
                            $sql.="AND dvt_tour.idDM_Tour = $idDM_Tour";
                            $caption = $this->Lay_TenDM_Tour($idDM_Tour);
                }
                if($qg > 0 && $idDM_Tour == 0 && $idDXP == 0 && $idTG == 0 ) {
                        $sql.=" AND dvt_tour.quocgia = $qg";
                        if($qg ==1) $caption = "Tour DU Lịch trong nước";
                        if($qg ==2) $caption = "Tour DU Lịch nước ngoài";
                }*/
            $sql.= " ORDER BY idTour DESC ";
			
			if($limit > 0 && $offset >=0 ) $sql.= " LIMIT $offset,$limit";			
            $rs = mysql_query($sql);	
            while($row = mysql_fetch_assoc($rs)){
                    $data[] =$row;
            }
            $result = array("data"=>$data,"caption"=>$caption);		
            return $result;
        }
	
	/* THOI GIAN */
	
	function ThoiGian_List($limit=-1)
	{
		$sql ="SELECT * FROM dvt_tour_thoigian";
		if($limit>0) $sql.=" LIMIT 0,$limit";
		$rs = mysql_query($sql);
		return $rs;
	}
	function Lay_ThoiGian($idTG){
		$sql = "SELECT ThoiGian FROM dvt_tour_thoigian WHERE idTG = $idTG ";
		$rs = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($rs);
		return $row[ThoiGian];
	}
	function GetIdDM_Tour($TenDM_Tour_KD){
		$sql = "SELECT idDM_Tour FROM dvt_tour_danhmuc WHERE TenDM_Tour_KD = '$TenDM_Tour_KD' ";
		$rs = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($rs);
		return $row[idDM_Tour];
	}
	function GetIdTour($TieuDeTour_KD){
		$sql = "SELECT idTour FROM dvt_tour WHERE TieuDeTour_KD = '$TieuDeTour_KD' ";
		$rs = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($rs);
		return $row[idTour];
	}
	
	
	
	
	
}

?>