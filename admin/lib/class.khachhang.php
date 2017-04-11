<?php 
require_once "../Model/Db.php";
class khachhang extends db{
	
	function Email_List($offset=-1,$limit=-1){
		$sql = "SELECT * FROM email ORDER BY idEmail DESC ";
		if($limit > 0 && $offset >=0 ) $sql.= " LIMIT $offset,$limit";	
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function Email_List_ChuaGoi($offset=-1,$limit=-1){
		$sql = "SELECT * FROM email WHERE status = 0 ORDER BY idEmail DESC ";
		if($limit > 0 && $offset >=0 ) $sql.= " LIMIT $offset,$limit";	
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function Email_DaGui($offset=-1,$limit=-1){
		$sql = "SELECT * FROM email WHERE status = 1 ORDER BY idEmail DESC ";
		if($limit > 0 && $offset >=0 ) $sql.= " LIMIT $offset,$limit";	
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function UpdateStatus($email){		
		$sql = "UPDATE email SET status = 1 WHERE Email = '$email'";
		mysql_query($sql) or die(mysql_error());
	}
	function smtpmailers($to, $from, $from_name, $subject, $body) { 
        global $error;
        $mail = new PHPMailer(); 
        $mail->IsSMTP(); 
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true; 
        $mail->SMTPSecure = 'ssl'; 
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465; 
		$mail->Username =GUSER;
		$mail->Password= GPWD;
        //$mail->Username = $this->Lay_TK_Gmail($_SESSION[idUser]);  
        //$mail->Password = $this->Lay_PW_Gmail($_SESSION[idUser]);           
        $mail->SetFrom($from, $from_name);
		//$mail->AddAttachment("email.xls","email.xls");
        $mail->Subject = $subject;
        $mail->Body = $body;
		$mail->CharSet="utf-8";
        $mail->IsHTML(true);
        $mail->AddAddress($to);
        if(!$mail->Send()) {
            $error = 'Gởi mail bị lỗi : '.$mail->ErrorInfo; 
            return false;
        } else {
            $error = 'Thư của bạn đã được gởi đi !';
            return true;
        }
    }
	function List_TinTuc_DuLich($offset=-1,$limit=-1){
		$sql = "SELECT * FROM dvt_kh_baiviet WHERE idLoai = 1 ORDER BY idBV DESC ";
		if($limit > 0 && $offset >=0 ) $sql.= " LIMIT $offset,$limit";	
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function List_TuVan_DuLich($offset=-1,$limit=-1){
		$sql = "SELECT * FROM dvt_kh_baiviet WHERE idLoai = 0  ORDER BY idBV DESC ";
		if($limit > 0 && $offset >=0 ) $sql.= " LIMIT $offset,$limit";	
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
    function TinTuc_List($idLoai,$offset=-1,$limit=-1){
        $sql = "SELECT * FROM dvt_kh_baiviet WHERE idLoai = $idLoai ORDER BY idBV DESC ";
		if($limit > 0 && $offset >=0 ) $sql.= " LIMIT $offset,$limit";	
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
    }
	
	function ChiTiet_TinTuc($idBV)
	{
		$sql = "SELECT * FROM dvt_kh_baiviet WHERE idBV = $idBV";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function NoiDungTrangDon($idTrangDon){
		$sql = "SELECT * FROM dvt_trangdon WHERE idTrangDon = $idTrangDon";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function ListTrangDon(){
		$sql = "SELECT * FROM dvt_trangdon";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	
	
	/* BAI VIET VISA*/
	function BaiViet_KH_Them(&$loi){	
	
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
			$sql = "INSERT INTO dvt_kh_baiviet
					VALUES(NULL,$idLoai,'$TieuDe','$TieuDe_KD','$MoTa','$NoiDung','$UrlHinh'
					,'$Title','$MetaD','$MetaK')";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
	}
    function BaiViet_KH_Sua($idBV,&$loi){	
	
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
			$sql = "UDPATE dvt_kh_baiviet
					SET idLoai = $idLoai,TieuDe = '$TieuDe',TieuDe_KD = '$TieuDe_KD',
                    MoTa = '$MoTa',NoiDung = '$NoiDung',UrlHinh = '$UrlHinh'
					,Title = '$Title',MetaD = '$MetaD',MetaK = '$MetaK' WHERE idBV = $idBV";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
	}
	
}

?>