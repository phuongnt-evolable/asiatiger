<?php
session_start();
date_default_timezone_set('Asia/Saigon');
require_once "class/class.db.php";
class trangchu extends db{
	
	/* LUU TIN NHAN */
	
	function ListTinDaGui($idUser){
		$sql = "SELECT 0o0_tinnhangui.*,ten_dang_nhap FROM 0o0_tinnhangui,0o0_users
			 WHERE 0o0_tinnhangui.idUser = 0o0_users.idUser AND 0o0_tinnhangui.idUser = $idUser";
		return mysql_query($sql);
	}
    
	function ListTinDaGui_Super(){
		$sql = "SELECT 0o0_tinnhangui.*,ten_dang_nhap FROM 0o0_tinnhangui,0o0_users WHERE 0o0_tinnhangui.idUser = 0o0_users.idUser";
		return mysql_query($sql);
	}
	function ListTinDaGui_TroLy($idQuan){
		$sql = "SELECT 0o0_tinnhangui.*,ten_dang_nhap FROM 0o0_tinnhangui,0o0_users WHERE 0o0_tinnhangui.idUser = 0o0_users.idUser
		AND  0o0_tinnhangui.idRole > 2 and 0o0_users.idQuan = $idQuan";
		return mysql_query($sql);
	}
	function ListTinDaGui_Admin(){
		$idTruong = $_SESSION[idTruong];
		$sql = "SELECT 0o0_tinnhangui.*,ten_dang_nhap 
				FROM 0o0_tinnhangui,0o0_users 
				WHERE 0o0_tinnhangui.idUser = 0o0_users.idUser 
				AND 0o0_tinnhangui.idTruong = $idTruong";
		return mysql_query($sql);
	}
	
	/* KIEM TRA QUYEN */
	function isSuper($idUser){
		$sql = "SELECT idRole FROM 0o0_users WHERE idUser = $idUser";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		if($row[idRole]==1) return true;
		else return false;
	}
	function isTroLy($idUser){
		$sql = "SELECT idRole FROM 0o0_users WHERE idUser = $idUser";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		if($row[idRole]==2) return true;
		else return false;
	}
	function isAdmin($idUser){
		$sql = "SELECT idRole FROM 0o0_users WHERE idUser = $idUser";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		if($row[idRole]==3) return true;
		else return false;
	}
	function isNhanVan($idUser){
		$sql = "SELECT idRole FROM 0o0_users WHERE idUser = $idUser";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		if($row[idRole]==4) return true;
		else return false;
	}
	
	/* NHOM DANH BA */
	function ListNhomDanhBa($idUser){
		$sql = "SELECT * FROM 0o0_nhomdanhba WHERE idUser = $idUser";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function ListNhomDanhBa_TK_Ten($idUser,$ten){
		$sql = "SELECT * FROM 0o0_nhomdanhba WHERE idUser = $idUser AND ten_nhom REGEXP '$ten' ";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function ListNhomDanhBa_TK($idUser,$ten,$ma){
		$sql = "SELECT * FROM 0o0_nhomdanhba WHERE idUser = $idUser AND ten_nhom REGEXP '$ten' AND ma_nhom REGEXP '$ma'";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function ListNhomDanhBa_TK_Ma($idUser,$ma){
		$sql = "SELECT * FROM 0o0_nhomdanhba WHERE idUser = $idUser AND ma_nhom REGEXP '$ma'";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function ThemNhomDanhBa(){		
		$ma = $this->processData($_POST[ma_danh_ba]);
		$ten = $this->processData($_POST[ten_danh_ba]);
		$idUser=  $_SESSION[idUser];
		$sql = "INSERT INTO 0o0_nhomdanhba VALUES (NULL,'$ma','$ten',$idUser)";
		mysql_query($sql);
	}
	function ChiTietNhomDanhBa($idNhom){		
		$sql = "SELECT * FROM 0o0_nhomdanhba WHERE idNhom = $idNhom";
		$rs = mysql_query($sql);
		return $rs;
	}
	function SuaNhomDanhBa($idNhom){		
		$ma = $this->processData($_POST[ma_danh_ba]);
		$ten = $this->processData($_POST[ten_danh_ba]);
		$idUser=  $_SESSION[idUser];
		$sql = "UPDATE 0o0_nhomdanhba SET ma_nhom = '$ma',ten_nhom = '$ten' WHERE idNhom=$idNhom AND idUser =$idUser";
		mysql_query($sql);
	}
	function XoaNhomDanhBa($idNhom){
		$idUser =  $_SESSION[idUser];
		$sql = "DELETE FROM 0o0_nhomdanhba WHERE idNhom=$idNhom AND idUser =$idUser";
		mysql_query($sql);
	}
	
	/* DANH BẠ */
	
	function ListDanhBa($idUser){
		$sql = "SELECT 0o0_danhba.*,ten_nhom FROM 0o0_danhba,0o0_nhomdanhba 
					WHERE 0o0_danhba.idUser = $idUser and 0o0_danhba.idNhom = 0o0_nhomdanhba.idNhom
					ORDER BY idNhom ASC";
		$rs = mysql_query($sql);
		return $rs;		
	}
	function ListDanhBaTheoNhom($idNhom){
		$sql = "SELECT 0o0_danhba.*,ten_nhom FROM 0o0_danhba,0o0_nhomdanhba 
					WHERE 0o0_danhba.idNhom = $idNhom and 0o0_danhba.idNhom = 0o0_nhomdanhba.idNhom
					ORDER BY idNhom ASC";
		$rs = mysql_query($sql);
		return $rs;		
	}
	function ThemDanhBa(){		
		$hoten = $this->processData($_POST[hoten]);
		$dienthoai = $this->processData($_POST[dien_thoai]);
		$nhom = $_POST[nhom_danh_ba];settype($nhom,"int");
		$idUser=  $_SESSION[idUser];
		$sql = "INSERT INTO 0o0_danhba VALUES (NULL,$idUser,$nhom,'$hoten','$dienthoai')";
		mysql_query($sql);
	}
	function SuaDanhBa($idDB){		
		$hoten = $this->processData($_POST[hoten]);
		$dienthoai = $this->processData($_POST[dien_thoai]);
		$nhom = $_POST[nhom_danh_ba];settype($nhom,"int");
		$idUser=  $_SESSION[idUser];
		$sql = "UPDATE 0o0_danhba SET idNhom = $nhom ,hoten = '$hoten',dienthoai = '$dienthoai' WHERE idDB = $idDB";
		mysql_query($sql);
	}
	function ChiTietDanhBa($idDB){		
		$sql = "SELECT * FROM 0o0_danhba WHERE idDB = $idDB";
		$rs = mysql_query($sql);
		return $rs;
	}
	function XoaDanhBa($idDB){		
		$sql = "DELETE FROM 0o0_danhba WHERE idDB =$idDB";
		mysql_query($sql);
	}
	
	/* TRƯỜNG */
	function ListLoaiTruong(){
		$sql = "SELECT * FROM 0o0_loaitruong";
		$rs = mysql_query($sql);
		return $rs;
	}
	function ListTruong(){
		$sql = "SELECT * FROM 0o0_truong WHERE idTruong<>7 ";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	
	function ThemTruong(){
		$ten_truong = $this->processData($_POST[ten_truong]);		
		$nguoi_lien_he = $this->processData($_POST[nguoi_lien_he]);
		$dia_chi = $this->processData($_POST[dia_chi]);		
		$chuc_vu = $this->processData($_POST[chuc_vu]);
		$dien_thoai = $this->processData($_POST[dien_thoai]);		
		$idLT = $this->processData($_POST[idLT]); 
		$idQuan = $_POST[idQuan];
		$sql = "INSERT INTO 0o0_truong VALUES 
				(NULL,'$ten_truong','$idLT','$dia_chi',
				'$idQuan','$nguoi_lien_he','$chuc_vu','$dien_thoai')";
		mysql_query($sql) or die(mysql_error());
	}
	function SuaTruong($idTruong){
		$ten_truong = $this->processData($_POST[ten_truong]);		
		$nguoi_lien_he = $this->processData($_POST[nguoi_lien_he]);
		$dia_chi = $this->processData($_POST[dia_chi]);		
		$chuc_vu = $this->processData($_POST[chuc_vu]);
		$dien_thoai = $this->processData($_POST[dien_thoai]);		
			$idLT = $this->processData($_POST[idLT]); 
		$idQuan = $this->processData($_POST[idQuan]);	
		
		$sql = "UPDATE 0o0_truong SET ten_truong = '$ten_truong',nguoi_lien_he = '$nguoi_lien_he',dia_chi = '$dia_chi',
				chuc_vu = '$chuc_vu',dien_thoai = '$dien_thoai',idQuan = '$idQuan',idLT = '$idLT' 
				WHERE idTruong = $idTruong";
		mysql_query($sql);
	}
	function ChiTietTruong($idTruong){		
		$sql = "SELECT 0o0_truong.* FROM 0o0_truong		
		 WHERE idTruong = $idTruong";
		$rs = mysql_query($sql);
		return $rs;
	}
	function XoaTruong($idTruong){		
		$sql = "DELETE FROM 0o0_truong WHERE idTruong =$idTruong";
		mysql_query($sql);
	}
	/*  ROLE */
	function ListRole(){
		$sql = "SELECT * FROM 0o0_role WHERE idRole<>1";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function ListRole_TroLy(){
		$sql = "SELECT * FROM 0o0_role WHERE idRole>2";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	
	/* USER */
	
	function ListUser($idUser){
		$sql = "SELECT 0o0_users.*,ten_role,ten_truong,ten_quan 
					FROM 0o0_users,0o0_role,0o0_quan,0o0_truong
		 			WHERE 0o0_users.idRole<>1
		 			AND 0o0_users.idRole = 0o0_role.idRole		
					AND 0o0_users.idQuan = 0o0_quan.idQuan
					AND 0o0_users.idTruong = 0o0_truong.idTruong		
		 ";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function CoAdminDN($idTruong){	
		$sql = "SELECT idUser FROM 0o0_users WHERE idRole = 3 AND idTruong = $idTruong";
		$rs = mysql_query($sql);
		$num = mysql_num_rows($rs);
		if($num>0) return true;
		else return false;
	}
	function ListUser_xemdanhsach($idUser){
		$sql = "SELECT 0o0_users.*,ten_role,ten_truong,ten_quan 
					FROM 0o0_users,0o0_role,0o0_quan,0o0_truong
		 			WHERE 0o0_users.idRole > 2 
		 			AND 0o0_users.idRole = 0o0_role.idRole		
					AND 0o0_users.idQuan = 0o0_quan.idQuan
					AND 0o0_users.idTruong = 0o0_truong.idTruong		
		 ";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function Admin_ListUser($idTruong){
		$sql = "SELECT 0o0_users.*,ten_role,ten_truong,ten_quan 
					FROM 0o0_users,0o0_role,0o0_quan,0o0_truong
		 			WHERE 0o0_users.idRole=4 
					AND 0o0_users.idTruong = $idTruong
		 			AND 0o0_users.idRole = 0o0_role.idRole		
					AND 0o0_users.idQuan = 0o0_quan.idQuan
					AND 0o0_users.idTruong = 0o0_truong.idTruong		
		 ";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	
	function ListUserTheoRole($idRole){
		$sql = "SELECT 0o0_users.*,ten_role,ten_truong,ten_quan FROM  0o0_users,0o0_role,0o0_quan,0o0_truong
				WHERE 0o0_users.idRole = $idRole 
				AND 0o0_users.idRole = 0o0_role.idRole		
				AND 0o0_users.idQuan = 0o0_quan.idQuan
				AND 0o0_users.idTruong = 0o0_truong.idTruong";
		$rs = mysql_query($sql);
		return $rs;		
	}
	
	function ThemUser(&$loi){	
	
		$thanhcong=true;
		
		$menu = "";
		$nguoi_tao = $_SESSION[idUser];	
	
		$tendangnhap = $this->processData($_POST[tendangnhap]);	
			
		if ($tendangnhap == NULL){$thanhcong = false;$loi['tendangnhap']= "<br>&nbsp&nbsp&nbsp Bạn chưa nhập username"; }
		elseif (strlen($tendangnhap)<3 ){
			$thanhcong = false; 
			$loi['tendangnhap']="<br>&nbsp&nbsp&nbsp Tên đăng nhập >=3 ký tự";							
		}
		elseif ($this->KiemTraTenDangNhapTonTai($tendangnhap)==true){ 
			$thanhcong = false;  
			$loi['tendangnhap'] = "<br>&nbsp&nbsp&nbsp Tên đăng nhập đã tồn tại";
		}
		
		$matkhau = $this->processData($_POST[matkhau]);
		
		
		$matkhau= $this -> processData( $_POST[matkhau]);
		if($matkhau=="")
		{
			$thanhcong= false;
			$loi[matkhau]= "Bạn chưa nhập password";
		}
		
		$re_matkhau =$this -> processData( $_POST[re_matkhau]);
		if($re_matkhau=="")
		{
			$thanhcong= false;
			$loi[nhaplaimatkhau]= "Bạn chưa nhập lại mật khẩu";
		}elseif($matkhau != $re_matkhau){
			$thanhcong= false;
			$loi[nhaplaimatkhau]= "Mật khẩu nhập 2 lần không giống nhau";
		}
		
		
		
		
		$ten = $this->processData($_POST[ten]);		
		$tentat = $this->processData($_POST[tentat]);
		$nvquanly = $this->processData($_POST[nvquanly]);		
		$dienthoai = $this->processData($_POST[dienthoai]);
		if($this->isTroLy($_SESSION[idUser])==true){
			$idTruong = $this->processData($_POST[idTruong]);settype($idTruong,"int");
			if($idTruong ==7){
			$thanhcong=false;
			$loi[truong] = "Chọn trường.";
		}	
		}
		else $idTruong = 7;
		$idRole= $this->processData($_POST[idRole]);settype($idRole,"int");	
		if($idRole ==0){
			$thanhcong=false;
			$loi[role] = "Chọn Role.";
		}	
	
		
		$sms_nguoi_cho = $this->SmsNguoiCho($_SESSION[idUser]);		
		$tong_sms = $this->processData($_POST[tong_sms]);settype($tong_sms,"int");				
		if($sms_nguoi_cho < $tong_sms )
		{
			$loi[sms] = "Số SMS tối đa là $sms_nguoi_cho";
			$thanhcong = false;
		}		
		
		
		$gioi_han_theo = $_POST[gioihan];		
		$sms_gioi_han = $this->processData($_POST[sms_gioihan]);settype($sms_gioi_han,"int");
		
		
		
		
		$nguoilienhe = $this->processData($_POST[nguoilienhe]);
		$chucvu = $this->processData($_POST[chucvu]);		
		$dtnguoilienhe= $this->processData($_POST[dtnguoilienhe]);
		$enable = $this->processData($_POST[enable]);
		
		/* MENU */
		$menu_chuyencan = $_POST[menu_chuyencan]; if($menu_chuyencan=="on") $menu=$menu."chuyencan|";
		$menu_diem = $_POST[menu_diem]; if($menu_diem=="on") $menu=$menu."diem|";
		$menu_thongbao = $_POST[menu_diem]; if($menu_thongbao=="on") $menu=$menu."thongbao|";
		$menu_nhom = $_POST[menu_nhom]; if($menu_nhom=="on") $menu=$menu."nhom|";
		$menu_danhba = $_POST[menu_danhba]; if($menu_danhba=="on") $menu=$menu."danhba|";
		$menu_thongke = $_POST[menu_thongke]; if($menu_thongke=="on") $menu=$menu."thongke|";
		$menu_import = $_POST[menu_import]; if($menu_import=="on") $menu=$menu."import";
		
		$codinh = $_POST[codinh]; if($codinh=="on") $menu="thongbao|codinh|danhba";
		$menu_import = $_POST[menu_import]; if($menu_import=="on") $menu=$menu."|import";
		
		if($enable=="on") $enable=1;else $enable=0;
		
		$ngaytao =date('Y-m-d G:i:s');
		
		
		$idQuan = $this->processData($_POST[idQuan]);settype($idQuan,"int");			
		if($idQuan==25){
			$thanhcong=false;
			$loi[quan] = "Chọn quận.";
		}	
		$matkhau=md5($matkhau);
		
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "INSERT INTO 0o0_users VALUES 
					(NULL,'$tendangnhap','$matkhau','$ten',
					'$tentat','$nvquanly','$dienthoai',$idTruong,$idRole,$gioi_han_theo,		$tong_sms,$sms_gioi_han,$idQuan,'$nguoilienhe','$chucvu','$dtnguoilienhe','$menu',
					'$enable','$ngaytao',$nguoi_tao)";
								mysql_query($sql) or die(mysql_error());		
			$this->CapNhat_SMS($_SESSION[idUser],$tong_sms);
		}
		return $thanhcong;
	}

	function SuaUser(&$loi){
		$thanhcong= true;
		$idUser = $_POST[idUser_sua];
		settype($idUser,"int");
		date_default_timezone_set('Asia/Saigon');
		$tendangnhap = $this->processData($_POST[tendangnhap]);		
		
		
		$ten = $this->processData($_POST[ten]);		
		$tentat = $this->processData($_POST[tentat]);
		$nvquanly = $this->processData($_POST[nvquanly]);		
		$dienthoai = $this->processData($_POST[dienthoai]);
		if($this->isTroLy($_SESSION[idUser])==true){
			$idTruong = $this->processData($_POST[idTruong]);settype($idTruong,"int");	
		}
		else $idTruong = 7;
		$idRole= $this->processData($_POST[idRole]);settype($idRole,"int");	
		$gioi_han_theo = $_POST[gioihan];		
		$sms_gioi_han = $this->processData($_POST[sms_gioihan]);settype($sms_gioi_han,"int");	
				
		
		$nguoilienhe = $this->processData($_POST[nguoilienhe]);
		$chucvu = $this->processData($_POST[chucvu]);		
		$dtnguoilienhe= $this->processData($_POST[dtnguoilienhe]);
		
		/* MENU */
		$menu_chuyencan = $_POST[menu_chuyencan]; if($menu_chuyencan=="on") $menu=$menu."chuyencan|";
		$menu_diem = $_POST[menu_diem]; if($menu_diem=="on") $menu=$menu."diem|";
		$menu_thongbao = $_POST[menu_diem]; if($menu_thongbao=="on") $menu=$menu."thongbao|";
		$menu_nhom = $_POST[menu_nhom]; if($menu_nhom=="on") $menu=$menu."nhom|";
		$menu_danhba = $_POST[menu_danhba]; if($menu_danhba=="on") $menu=$menu."danhba|";
		$menu_thongke = $_POST[menu_thongke]; if($menu_thongke=="on") $menu=$menu."thongke|";
		$menu_import = $_POST[menu_import]; if($menu_import=="on") $menu=$menu."import";
		
		$codinh = $_POST[codinh]; if($codinh=="on") $menu="codinh";
		$menu_import = $_POST[menu_import]; if($menu_import=="on") $menu=$menu."|import";
		
		$enable = $this->processData($_POST[enable]);
		if($enable=="on") $enable=1;
		else $enable=0;
		$ngaytao =date('Y-m-d G:i:s');
		
			
		
		
		$tong_sms = $this->processData($_POST[tong_sms]);settype($tong_sms,"int");
		$sms_nguoi_cho = $this->SmsNguoiCho($_SESSION[idUser]);	
		
		$sms_chua_sua =$this->SmsNguoiCho($idUser);			
					
		
		if($sms_chua_sua < $tong_sms )
		{
			$sms_capnhat = $tong_sms - $sms_chua_sua ;
			if($sms_capnhat > $sms_nguoi_cho){
				$thanhcong= false;
				$loi[sms] = "Số SMS được tăng tối đa là $sms_nguoi_cho";
			}else{
				
				$sql = "UPDATE 0o0_users SET tong_sms = tong_sms - $sms_capnhat WHERE idUser = ".$_SESSION[idUser];
				mysql_query($sql);
			}
		}
		if($sms_chua_sua >= $tong_sms){
		
			$sms_capnhat = $tong_sms;			
			$sms_tra_lai = $sms_chua_sua - $tong_sms;
			$sql = "UPDATE 0o0_users SET tong_sms = tong_sms + $sms_tra_lai WHERE idUser = ".$_SESSION[idUser];
			mysql_query($sql);			
		}		
		
		
			
		if($thanhcong==false)
				return $thanhcong;
		else {
			$sql = "UPDATE 0o0_users SET 
				ten_dang_nhap = '$tendangnhap',ten = '$ten',tong_sms= $tong_sms,gioi_han_theo = $gioi_han_theo,
				sms_gioihan = $sms_gioi_han,menu='$menu',
				ten_tat = '$tentat',nv_quanly = '$nvquanly',dien_thoai = '$dienthoai',
				idTruong = $idTruong,idRole = $idRole,
				nguoi_lien_he = '$nguoilienhe',
				chuc_vu = '$chucvu',dt_nguoi_lien_he = '$dtnguoilienhe',active = '$enable' WHERE idUser = $idUser";
			mysql_query($sql);
		
		}
		return $thanhcong;
		
	}
	function CapNhat_SMS($idUser,$tong_sms){
		$sql = "UPDATE 0o0_users SET tong_sms = tong_sms - '$tong_sms'
				WHERE idUser = $idUser";
		mysql_query($sql);
	}
	function GetIdRole($idUser){
		$sql = "SELECT idRole FROM 0o0_users WHERE idUser = $idUser";
		$rs = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($rs);
		$sdt = $row['idRole'];
		return $sdt;
	}
	function CapNhat_Tang_SMS($idUser,$tong_sms){
		$sql = "UPDATE 0o0_users SET tong_sms = tong_sms + '$tong_sms'
				WHERE idUser = $idUser";
		mysql_query($sql);
	}
	function LayNguoiTao($idUser){
		$sql = "SELECT nguoi_tao FROM 0o0_users WHERE idUser = $idUser";
		$rs = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($rs);
		return $row[nguoi_tao];
	}
	function CoTroLyCuaQuan($idQuan){	
		$sql = "SELECT idUser FROM 0o0_users WHERE idRole = 2 AND idQuan = $idQuan";
		$rs = mysql_query($sql);
		$num = mysql_num_rows($rs);
		if($num>0) return true;
		else return false;
	}
	function SmsNguoiCho($idUser){
		$sql = "SELECT tong_sms FROM 0o0_users WHERE idUser = $idUser";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		return $row[tong_sms];
	}
	
	function XoaUser($idUser){		
		$sql = "DELETE FROM 0o0_users WHERE idUser =$idUser";
		mysql_query($sql);
	}
	
	function ChiTietUser($idUser){		
	
		$sql = "SELECT 0o0_users.*,ten_truong,ten_role FROM 0o0_users,0o0_truong,0o0_role WHERE 		0o0_users.idUser = $idUser
				AND 0o0_users.idRole = 0o0_role.idRole		
				
				AND 0o0_users.idTruong = 0o0_truong.idTruong	
		";
		$rs = mysql_query($sql);
		return $rs;
	}
	/* NHAN VIEN */
	function ThemNhanVien(&$loi){
	
		$thanhcong = true;
		
		$nguoi_tao = $_SESSION[idUser];		
		$idRole=4;
		$gioi_han_theo = 0;
		$sms_gioi_han=0;
		$idTruong = $_SESSION[idTruong];
		$nvquanly = "";
		$nguoilienhe ="";
		$chucvu="";
		$dtnguoilienhe="";
		$menu = "diem|thongke|chuyencan|danhba|nhom|thongbao";
		$enable = $this->processData($_POST[enable]);
		if($enable=="on") $enable=1;
		else $enable=1;
		$ngaytao =date('Y-m-d G:i:s');
		$idQuan = $_SESSION[idQuan];
		
		
		$tendangnhap = $this->processData($_POST[tendangnhap]);	
			
		if ($tendangnhap == NULL){$thanhcong = false;$loi['tendangnhap']= "<br>&nbsp&nbsp&nbsp Bạn chưa nhập username"; }
		elseif (strlen($tendangnhap)<3 ){
			$thanhcong = false; 
			$loi['tendangnhap']="<br>&nbsp&nbsp&nbsp Tên đăng nhập >=3 ký tự";							
		}
		elseif ($this->KiemTraTenDangNhapTonTai($tendangnhap)==true){ 
			$thanhcong = false;  
			$loi['tendangnhap'] = "<br>&nbsp&nbsp&nbsp Tên đăng nhập đã tồn tại";
		}
		
		$matkhau = $this->processData($_POST[matkhau]);
		$matkhau=md5($matkhau);
		
		$ten = $this->processData($_POST[ten]);		
		$tentat = $this->processData($_POST[tentat]);			
		$dienthoai = $this->processData($_POST[dienthoai]);	
		
		$sms_nguoi_cho = $this->SmsNguoiCho($_SESSION[idUser]);		
		$tong_sms = $this->processData($_POST[sms]);settype($sms,"int");			
		if($sms_nguoi_cho < $tong_sms )
		{
			$loi[sms] = "Số SMS tối đa là $sms_nguoi_cho";
			$thanhcong = false;
		}		
		
				
		if($thanhcong==false)
				return $thanhcong;
		else {
			$sql = "INSERT INTO 0o0_users VALUES 
				(NULL,'$tendangnhap','$matkhau','$ten',
				'$tentat','$nvquanly','$dienthoai',$idTruong,$idRole,$gioi_han_theo,		$tong_sms,$sms_gioi_han,$idQuan,'$nguoilienhe','$chucvu','$dtnguoilienhe','$menu',
				'$enable','$ngaytao',$nguoi_tao)";		
			mysql_query($sql) or die(mysql_error());
			$this->CapNhat_SMS($_SESSION[idUser],$tong_sms);
		}
		return $thanhcong;
	
		
	}
	function SuaNhanVien(&$loi){
	
		$thanhcong = true;
		
		$idNV = $_POST[idUser_sua];
		$nguoi_tao = $_SESSION[idUser];		
		$idRole=4;
		$gioi_han_theo = 0;
		$sms_gioi_han=0;
		$idTruong = $_SESSION[idTruong];
		$nvquanly = "";
		$nguoilienhe ="";
		$chucvu="";
		$dtnguoilienhe="";
		$menu = "diem|thongke|chuyencan|danhba|nhom|thongbao";
		$enable = $this->processData($_POST[enable]);
		if($enable=="on") $enable=1;
		else $enable=1;
		$ngaytao =date('Y-m-d G:i:s');
		$idQuan = $_SESSION[idQuan];
		
		
		$tendangnhap = $this->processData($_POST[tendangnhap]);	
		
		
		$matkhau = $this->processData($_POST[matkhau]);
		$matkhau=md5($matkhau);
		
		$ten = $this->processData($_POST[ten]);	
		$tentat =$this->processData($_POST[tentat]);		
					
		$dienthoai = $this->processData($_POST[dienthoai]);	
		
		$sms_nguoi_cho = $this->SmsNguoiCho($_SESSION[idUser]);	
		
		$sms_chua_sua =$this->SmsNguoiCho($idNV);			
		$tong_sms = $this->processData($_POST[sms]);settype($sms,"int");			
		
		if($sms_chua_sua < $tong_sms )
		{
			$sms_update = $tong_sms;
			$sms_capnhat = $tong_sms - $sms_chua_sua ;
			if($sms_capnhat > $sms_nguoi_cho){
				$thanhcong= false;
				$loi[sms] = "Số SMS được tăng tối đa là $sms_nguoi_cho";
			}else{
				
				$sql = "UPDATE 0o0_users SET tong_sms = tong_sms - $sms_capnhat WHERE idUser = ".$_SESSION[idUser];
				mysql_query($sql);
			}
		}
		if($sms_chua_sua >= $tong_sms){
		
			$sms_update=$tong_sms;			
			$sms_tra_lai = $sms_chua_sua - $tong_sms;			
			$sql = "UPDATE 0o0_users SET tong_sms = tong_sms + $sms_tra_lai WHERE idUser = ".$_SESSION[idUser];
			mysql_query($sql);			
		}		
		echo "sms cap nhat:".$sms_capnhat;	
		if($thanhcong==false)
				return $thanhcong;
		else {
			$sql = "UPDATE 0o0_users SET 
				ten_dang_nhap = '$tendangnhap',ten = '$ten',tong_sms= $sms_update,gioi_han_theo = $gioi_han_theo,
				sms_gioihan = $sms_gioi_han,menu='$menu',
				ten_tat = '$tentat',nv_quanly = '$nvquanly',dien_thoai = '$dienthoai',
				idTruong = $idTruong,idRole = $idRole,
				
				idQuan = $idQuan,nguoi_lien_he = '$nguoilienhe',
				chuc_vu = '$chucvu',dt_nguoi_lien_he = '$dtnguoilienhe',active = '$enable' WHERE idUser = $idNV";
			mysql_query($sql);
		
		}
		
		return $thanhcong;	
		
		
	}
	function ListNhanVien($idTruong){
		$sql = "SELECT * FROM 0o0_users WHERE idRole = 4 AND idTruong=$idTruong";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	/* QUAN */
	function ListQuan(){
		$sql = "SELECT * FROM 0o0_quan WHERE idQuan<>25";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function LayIdTruong($idNV){
		$sql = "SELECT idTruong FROM 0o0_users WHERE idUser = $idNV";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		$sdt = $row['idTruong'];
		return $sdt;
	}
	
	/* USER TRO LY */
	function TroLy_ListUser_xemdanhsach(){
		$sql = "SELECT 0o0_users.*,ten_role,ten_truong,ten_quan 
					FROM 0o0_users,0o0_role,0o0_quan,0o0_truong
		 			WHERE 0o0_users.idRole > 2 
					AND 0o0_users.nguoi_tao = $_SESSION[idUser]
		 			AND 0o0_users.idRole = 0o0_role.idRole		
					AND 0o0_users.idQuan = 0o0_quan.idQuan
					AND 0o0_users.idTruong = 0o0_truong.idTruong";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function TroLy_ListUser(){
		$iduser_tllus = $_SESSION[idUser];
		$sql = "SELECT 0o0_users.*,ten_role,ten_truong,ten_quan 
					FROM 0o0_users,0o0_role,0o0_truong,0o0_quan
		 			WHERE 0o0_users.idRole > 2 
					AND 0o0_users.nguoi_tao = $iduser_tllus
		 			AND 0o0_users.idRole = 0o0_role.idRole
					AND 0o0_users.idQuan = 0o0_quan.idQuan					
					AND 0o0_users.idTruong = 0o0_truong.idTruong";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function TroLy_ListUserTheoRole($idRole){
		
		$sql = "SELECT * FROM 0o0_users WHERE idRole = $idRole AND idRole<>1 AND nguoi_tao = ".$_SESSION[idUser];;
		$rs = mysql_query($sql);
		return $rs;		
	}
	
	
	function CapNhat_Admin($idUser){
		settype($idUser,"int");
		date_default_timezone_set('Asia/Saigon');
		
		$ten = $this->processData($_POST[ten]);		
		$tentat = $this->processData($_POST[tentat]);
		$nvquanly = $this->processData($_POST[nvquanly]);		
		$dienthoai = $this->processData($_POST[dienthoai]);		
		$nguoilienhe = $this->processData($_POST[nguoilienhe]);
		$chucvu = $this->processData($_POST[chucvu]);		
		$dtnguoilienhe= $this->processData($_POST[dtnguoilienhe]);
	
		
		$sql = "UPDATE 0o0_users SET ten = '$ten',
				ten_tat = '$tentat',nv_quanly = '$nvquanly',dien_thoai = '$dienthoai',nguoi_lien_he = '$nguoilienhe',
				chuc_vu = '$chucvu',dt_nguoi_lien_he = '$dtnguoilienhe' WHERE idUser = $idUser";
		mysql_query($sql);
		
	}
	
	function DoiMatKhau(){
		$mk = $_POST[matkhau_moi];
		$mk = md5($mk);
		$idUser_up = $_SESSION[idUser];
		
		$sql = "UPDATE 0o0_users SET mat_khau = '$mk' WHERE idUser =$idUser_up";
		mysql_query($sql);
	}
	
	
	/* SMS */
	
	function So_SMS_Mot_Ngay($idUser){
		$sql = "SELECT sms_gioihan FROM  0o0_users  WHERE idUser =$idUser";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		return $row[sms_gioihan];
	}
	function So_SMS_Da_Gui_Trong_Ngay($idUser){
		$sql = "SELECT sms_da_gui FROM  0o0_sms_ngay  WHERE idUser =$idUser";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		return $row[sms_da_gui];
	}
	function ConTinNhan($idUser){
		$sql = "SELECT tong_sms FROM  0o0_users  WHERE idUser =$idUser";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		if($row[tong_sms]>0) return true;
		else return false;
	}
	function Con_SMS_Trong_Ngay($idUser){
		$so_sms_mot_ngay = $this->So_SMS_Mot_Ngay($idUser);
		$so_sms_da_gui_trong_ngay = $this->So_SMS_Da_Gui_Trong_Ngay($idUser);
		if($so_sms_mot_ngay-$so_sms_da_gui_trong_ngay >0) return true;
		else return false;
	}
	
    
    
    function ThemDanhBa_Excel($idNhom,$hoten,$phone){
        $idUser_t = $_SESSION[idUser];
        $hoten = $this->processData($hoten);
        $sql = "INSERT INTO 0o0_danhba VALUES(NULL,$idUser_t,$idNhom,'$hoten','$phone')";
        mysql_query($sql) or die(mysql_error());        
    }
    function Check_DanhBa($idNhom,$phone){
        $idUser_t = $_SESSION[idUser];
        
        $sql = "SELECT idDB FROM 0o0_danhba WHERE 
        idUser = $idU$idUser_t AND idNhom = $idNhom AND dienthoai ='$phone'";
        $rs = mysql_query($sql) or die(mysql_error());
        $num = mysql_num_rows($rs);
        if($num>0){
            return false;
        }else return true;        
    }
	
	function HienMenu($abc,$i_d_menu){			
		$i_d_menu = $_SESSION[idUser];
		$sql = "SELECT menu FROM 0o0_users WHERE idUser = $i_d_menu";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		$arr_menu = $row[menu];
		$tmp = explode("|",$arr_menu);		
		if(in_array($abc,$tmp)) return true;
		else return false;
	}
	function GioiHanTheoNgay($idUser){			
		$sql = "SELECT gioi_han_theo FROM 0o0_users WHERE idUser = $idUser";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		$ght = $row['gioi_han_theo'];
		if($ght==1) return true;
		else return false;				
	}
	function LayTenNguoiGui($idUser){
		$sql = "SELECT ten_dang_nhap FROM 0o0_users WHERE idUser = $idUser";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		$ten_dang_nhap = $row['ten_dang_nhap'];
		return $ten_dang_nhap;
	}
	function LayTenNhomDB($idNhom){
		$sql = "SELECT ten_nhom FROM 0o0_nhomdanhba WHERE idNhom = $idNhom";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		$ten_nhom = $row['ten_nhom'];
		return $ten_nhom;
	}
	function LaySoDT($idDB){
		$sql = "SELECT dienthoai FROM 0o0_danhba WHERE idDB = $idDB";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		$sdt = $row['dienthoai'];
		return $sdt;
	}
	function LaySoDT_GV($idGV){
		$sql = "SELECT dien_thoai FROM 0o0_giaovien WHERE idGV = $idGV";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		$sdt = $row['dien_thoai'];
		return $sdt;
	}
    
    function GetIdLT($ten_loai_truong){
        $ten_loai_truong=strtoupper($ten_loai_truong);
        $sql = "SELECT idLT FROM 0o0_loaitruong WHERE ten_loai_truong = '$ten_loai_truong'";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		$sdt = $row['idLT'];
		return $sdt;
    }
    function GetIdQuan($ten_quan){
        $ten_quan=strtoupper($ten_quan);
        $sql = "SELECT idQuan FROM 0o0_quan WHERE ten_quan = '$ten_quan'";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		$sdt = $row['idQuan'];
		return $sdt;
    }
    function ThemDS_Truong($ten_truong,$idLT,$dia_chi,$idQuan,$nguoi_lien_he,$chuc_vu,$dien_thoai){
      $sql = "INSERT INTO 0o0_truong(ten_truong,idLT,dia_chi,idQuan,nguoi_lien_he,chuc_vu,dien_thoai)        
            VALUES ('$ten_truong','$idLT','$dia_chi','$idQuan','$nguoi_lien_he','$chuc_vu','$dien_thoai')";
       mysql_query($sql) or die(mysql_error()); 
    }
	function ThemGiaoVien_Excel($bo_mon,$ma_gv,$ho_ten,$gioi_tinh,$ngay_sinh,$so_cmnd,$dia_chi,$dien_thoai,$idUser){
		$sql = "INSERT INTO 0o0_giaovien   
            VALUES (NULL,'$bo_mon','$ma_gv','$ho_ten','$gioi_tinh','$dia_chi','$dien_thoai',$idUser)";
       mysql_query($sql) or die(mysql_error()); 
	}
	function ThemGiaoVien_tay(){
		$bo_mon= $this->processData($_POST[bo_mon]);
		$ma_gv= $this->processData($_POST[ma_gv]);
		$ho_ten= $this->processData($_POST[ho_ten]);
		$gioi_tinh= $_POST[gioi_tinh];
		$dia_chi= $this->processData($_POST[dia_chi]);
		$dien_thoai= $this->processData($_POST[dien_thoai]);
		$idUser = $_POST[idUser_import_gv];
		$sql = "INSERT INTO 0o0_giaovien   
            VALUES (NULL,'$bo_mon','$ma_gv','$ho_ten','$gioi_tinh','$dia_chi','$dien_thoai',$idUser)";
       mysql_query($sql) or die(mysql_error()); 
	}
	function SuaGiaoVien($idGV){
		$bo_mon= $this->processData($_POST[bo_mon]);
		$ma_gv= $this->processData($_POST[ma_gv]);
		$ho_ten= $this->processData($_POST[ho_ten]);
		$gioi_tinh= $_POST[gioi_tinh];
		$dia_chi= $this->processData($_POST[dia_chi]);
		$dien_thoai= $this->processData($_POST[dien_thoai]);
		$idUser = $_POST[idUser_import_gv];
		$sql = "UPDATE 0o0_giaovien   
            SET bo_mon = '$bo_mon',ma_gv = '$ma_gv',ho_ten = '$ho_ten',gioi_tinh = '$gioi_tinh',dia_chi = '$dia_chi',dien_thoai ='$dien_thoai' WHERE idGV = $idGV";
       mysql_query($sql) or die(mysql_error()); 
	}
	function XoaGiaoVien($idGV){
		$sql = "DELETE FROM 0o0_giaovien WHERE idGV =$idGV";
		mysql_query($sql);
	}
	function ChiTietGiaoVien($idGV){
		$sql = "SELECT * FROM 0o0_giaovien WHERE idGV = $idGV";
		$rs = mysql_query($sql);
		return $rs;
	}
	function ThemHocSinh_Excel($ma_hs,$ho_ten,$lop,$dien_thoai,$idUser_import_hs){	
		$sql = "INSERT INTO 0o0_hocsinh  
            VALUES (NULL,'$ma_hs','$ho_ten','$lop','$dien_thoai',$idUser_import_hs)";
       mysql_query($sql) or die(mysql_error());
	}
	function ThemHocSinh_tay(){
		$lop= $this->processData($_POST[lop]);
		$ma_hs= $this->processData($_POST[ma_hs]);
		$ho_ten= $this->processData($_POST[ho_ten]);		
		$dien_thoai= $this->processData($_POST[dien_thoai]);
		$idUser = $_POST[idUser_import_gv];
		$sql = "INSERT INTO 0o0_hocsinh
            VALUES (NULL,'$ma_hs','$ho_ten','$lop','$dien_thoai',$idUser)";
       mysql_query($sql) or die(mysql_error()); 
	}
	function SuaHocSinh($idHS){
		$lop= $this->processData($_POST[lop]);
		$ma_hs= $this->processData($_POST[ma_hs]);
		$ho_ten= $this->processData($_POST[ho_ten]);		
		$dien_thoai= $this->processData($_POST[dien_thoai]);
		$idUser = $_POST[idUser_import_gv];
		$sql = "UPDATE 0o0_hocsinh   
            SET lop = '$lop',ma_hs = '$ma_hs',ho_ten = '$ho_ten',dien_thoai ='$dien_thoai' WHERE idHS = $idHS";
       mysql_query($sql) or die(mysql_error()); 
	}
	function XoaHocSinh($idHS){
		$sql = "DELETE FROM 0o0_hocsinh WHERE idHS =$idHS";
		mysql_query($sql);
	}
	function ChiTietHocSinh($idHS){
		$sql = "SELECT * FROM 0o0_hocsinh WHERE idHS = $idHS";
		$rs = mysql_query($sql);
		return $rs;
	}
	function ListGiaoVien($idUser){
		$sql = "SELECT * FROM 0o0_giaovien WHERE idUser = $idUser";
		$rs = mysql_query($sql);
		return $rs;
	}

	function ListHocSinh($idUser){
		$sql = "SELECT * FROM 0o0_hocsinh WHERE idUser = $idUser";
		$rs = mysql_query($sql);
		return $rs;
	}
	function TuNguCam($noidung){
		$arr = array("che do","cach mang","da dao","bieu tinh","phe phai","dan chu","phan dong","dai bao",
					"tong lanh su quan","diet vong","luu vong","ha guc","bom dan","dan duoc","quan khu",
					"hoi dong","quoc hoi","nha bao","dua tin","sup do","to chuc chinh tri","quoc ky","dieu le",
					"hoi lo","tham o","tham nhung","nhung doan","do be","tu ban","vu khi","quan chu","cong bang",
					"van minh","tieu diet","huy hoai","vat chat","chu nghia","dit me","dit bo","du me","du ma",
					"me kiep","dam tac","lang loan","lam nhuc","hiep dam","so soang","thu dam","hoi lo","dam o",
					"loi dung","vu loi","ngu dan","ban thui");
		foreach($arr as $key => $value){			
			if( stripos($noidung, $value,0)==false){
				$hople = true;
			}else{
				echo "<font color=red>Không thể gởi tin.Từ '".$value."' nằm trong danh sách cấm.</font>";
				$hople=false;
				exit();
			}
		}
		return $hople;
	}
	
	function KiemTraMaSoTonTai($maso,$idUser_kt_tt){
		$sql = "SELECT idHS FROM 0o0_hocsinh WHERE ma_hs = '$maso' AND idUser = $idUser_kt_tt ";
		$rs = mysql_query($sql);
		$num = mysql_num_rows($rs);
		if($num == 1) return true;
		else return false;
	}
	function LaySoDTCha($maso){
		$id_user_sodtcha = $_SESSION[idUser];
        $sql = "SELECT dien_thoai FROM 0o0_hocsinh WHERE ma_hs = '$maso' AND idUser = $id_user_sodtcha";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		$sdt = $row['dien_thoai'];
		return $sdt;
	}
	
	function KiemTraConUserAdminCon($idUser){
		$sql1= "SELECT idQuan FROM 0o0_users WHERE idUser = $idUser";
		$rs1 = mysql_query($sql1);
		$row1= mysql_fetch_assoc($rs1);
		$idQuan = $row1[idQuan];
		$sql = "SELECT idUser FROM 0o0_users WHERE idRole = 3 AND idQuan = $idQuan";
		$rs2= mysql_query($sql);
		$num = mysql_num_rows($rs2);
		if($num > 0) return true;
		else return false;
	}
	
	
	
	function XoaTroLy($idUser){
		if($this->KiemTraConUserAdminCon($idUser)==false){		
			$sql_1 = "SELECT tong_sms FROM 0o0_users WHERE idUser = $idUser ";
			$rs = mysql_query($sql_1) or die(mysql_error());
			$row = mysql_fetch_assoc($rs);
			$tong_sms = $row[tong_sms];
			
			$sql_2 = "UPDATE 0o0_users SET tong_sms = tong_sms + $tong_sms WHERE idRole = 1";
			mysql_query($sql_2);
			$sql = "DELETE FROM 0o0_users WHERE idUser =$idUser";
			mysql_query($sql);
		}else {
		
			$_SESSION[loixoa]="<font color='red'>Xóa các user cấp dưới trước !</font>";
			
		}
		
	}
	
	function KiemTraConUserNhanVien($idUser){
		$sql1= "SELECT idQuan FROM 0o0_users WHERE idUser = $idUser";
		$rs1 = mysql_query($sql1);
		$row1= mysql_fetch_assoc($rs1);
		$idQuan = $row1[idQuan];
		$sql = "SELECT idUser FROM 0o0_users WHERE idRole = 4 AND idQuan = $idQuan";
		$rs2= mysql_query($sql);
		$num = mysql_num_rows($rs2);
		if($num > 0) return true;
		else return false;
	}
	function XoaAdmin($idUser){
		if($this->KiemTraConUserNhanVien($idUser)==false){
			
			mysql_query("DELECT FROM 0o0_giaovien WHERE idUser= $idUser");
			mysql_query("DELECT FROM 0o0_hocsinh WHERE idUser= $idUser");			
					
			$sql_1 = "SELECT idQuan,tong_sms FROM 0o0_users WHERE idUser = $idUser ";
			$rs = mysql_query($sql_1) or die(mysql_error());
			$row = mysql_fetch_assoc($rs);
			$tong_sms = $row[tong_sms];
			$idq = $row[idQuan];
			$sql_2 = "UPDATE 0o0_users SET tong_sms = tong_sms + $tong_sms WHERE idRole = 2 AND idQuan = $idq";
			mysql_query($sql_2);
			$sql = "DELETE FROM 0o0_users WHERE idUser =$idUser";
			mysql_query($sql);
		}else {		
			$_SESSION[loixoa]="<font color='red'>Xóa các user cấp dưới trước !</font>";			
		}
		
	}
	
	function XoaNhanVien($idUser){
			
			mysql_query("DELECT FROM 0o0_giaovien WHERE idUser= $idUser");
			mysql_query("DELECT FROM 0o0_hocsinh WHERE idUser= $idUser");		
			
			$sql_1 = "SELECT idQuan,tong_sms FROM 0o0_users WHERE idUser = $idUser ";
			$rs = mysql_query($sql_1) or die(mysql_error());
			$row = mysql_fetch_assoc($rs);
			$tong_sms = $row[tong_sms];
			$idq = $row[idQuan];
			
			$sql_2 = "UPDATE 0o0_users SET tong_sms = tong_sms + $tong_sms WHERE idRole = 3 AND idQuan = $idq";
			mysql_query($sql_2);
			
			$sql = "DELETE FROM 0o0_users WHERE idUser =$idUser";
			mysql_query($sql);
		
		
	}
	
	
}
?>