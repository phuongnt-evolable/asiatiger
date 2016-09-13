<?php

require_once('PHPMailer/class.phpmailer.php');
define('GUSER', 'asiatiger.info@gmail.com');
define('GPWD', 'ofniregitaisa');
class db {

    private $host = "localhost";
    //private $host = "localhost";
    //private $user = "root";
    //private $pass = "root";
    private $user = "ho107d1_userdb";
    private $pass = "^N_8X(V_*b+&";
    private $db = "ho107d1_vinhsang";
   //private $db = "alibaba";

    function __construct() {
        mysql_connect($this->host, $this->user, $this->pass) or die("Can't connect to server");
        mysql_select_db($this->db) or die("Can't connect database");
        mysql_query("SET NAMES 'utf8'") or die(mysql_error());
    }
    function processData($str) {
        $str = trim(strip_tags($str));
        if (get_magic_quotes_gpc() == false) {
            $str = mysql_real_escape_string($str);
        }
        return $str;
    }
    function changeTitle($str) {
        $str = $this->stripUnicode($str);
        $str = str_replace("?", "", $str);
        $str = str_replace("&", "", $str);
        $str = str_replace("'", "", $str);
        $str = str_replace("  ", " ", $str);
        $str = trim($str);
        $str = mb_convert_case($str, MB_CASE_LOWER, 'utf-8'); // MB_CASE_UPPER/MB_CASE_TITLE/MB_CASE_LOWER
        $str = str_replace(" ", "-", $str);
        $str = str_replace("---", "-", $str);
        $str = str_replace("--", "-", $str);
        $str = str_replace('"', '', $str);
        $str = str_replace('"', "", $str);
        $str = str_replace(":", "", $str);
        $str = str_replace("(", "", $str);
        $str = str_replace(")", "", $str);
        $str = str_replace(",", "", $str);
        $str = str_replace(".", "", $str);
        $str = str_replace("%", "", $str);
        return $str;
    }

    function stripUnicode($str) {
        if (!$str)
            return false;
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd' => 'đ',
            'D' => 'Đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            '' => '?',
            '-' => '/'
        );
        foreach ($unicode as $khongdau => $codau) {
            $arr = explode("|", $codau);
            $str = str_replace($arr, $khongdau, $str);
        }
        return $str;
    }

    function phantrang($page, $page_show, $total_page, $link) {
        $dau = 1;
        $cuoi = 0;
        $dau = $page - floor($page_show / 2);
        if ($dau < 1)
            $dau = 1;
        $cuoi = $dau + $page_show;
        if ($cuoi > $total_page) {

            $cuoi = $total_page + 1;
            $dau = $cuoi - $page_show;
            if ($dau < 1)
                $dau = 1;
        }
        echo "<div id='thanhphantrang'>";
        if ($page > 1) {
            ($page == 1) ? $class = " class='selected'" : $class = "";
            echo "<a" . $class . " href=" . $link . "&page=1>Đầu</a>";
        }
        for ($i = $dau; $i < $cuoi; $i++) {
            ($page == $i) ? $class = " class='selected'" : $class = "";
            echo "<a" . $class . " href=" . $link . "&page=$i>$i</a>";
        }
        if ($page < $total_page) {
            ($page == $total_page) ? $class = " class='selected'" : $class = "";
            echo "<a" . $class . " href=" . $link . "&page=$total_page>Cuối</a>";
        }
        echo "</div>";
    }
    
    function phantrangHome($page, $page_show, $total_page, $link) {
        $dau = 1;
        $cuoi = 0;
        $dau = $page - floor($page_show / 2);
        if ($dau < 1)
            $dau = 1;
        $cuoi = $dau + $page_show;
        if ($cuoi > $total_page) {

            $cuoi = $total_page + 1;
            $dau = $cuoi - $page_show;
            if ($dau < 1)
                $dau = 1;
        }
        echo "<div id='thanhphantrang'>";
        if ($page > 1) {
            ($page == 1) ? $class = " class='selected'" : $class = "";
            echo "<a" . $class . " href=" . $link . "/1>{dau}</a>";
        }
        for ($i = $dau; $i < $cuoi; $i++) {
            ($page == $i) ? $class = " class='selected'" : $class = "";
            echo "<a" . $class . " href=" . $link . "/$i>$i</a>";
        }
        if ($page < $total_page) {
            ($page == $total_page) ? $class = " class='selected'" : $class = "";
            echo "<a" . $class . " href=" . $link . "/$total_page>{cuoi}</a>";
        }        
        echo "</div>";
        echo " <div style='margin-top: 10px;font-weight: bold; float:left;'><p style='font-weight: bold;'>{tong} <a style='color:#DB2E66'>".$total_page."</a> {trang}</p></div>";
    }
    
    function phantrangSearch($page, $page_show, $total_page, $link) {
        $dau = 1;
        $cuoi = 0;
        $dau = $page - floor($page_show / 2);
        if ($dau < 1)
            $dau = 1;
        $cuoi = $dau + $page_show;
        if ($cuoi > $total_page) {

            $cuoi = $total_page + 1;
            $dau = $cuoi - $page_show;
            if ($dau < 1)
                $dau = 1;
        }
        echo "<div id='thanhphantrang'>";
        if ($page > 1) {
            ($page == 1) ? $class = " class='selected'" : $class = "";
            echo "<a" . $class . " href=" . $link . "&page=1>{dau}</a>";
        }
        for ($i = $dau; $i < $cuoi; $i++) {
            ($page == $i) ? $class = " class='selected'" : $class = "";
            echo "<a" . $class . " href=" . $link . "&page=$i>$i</a>";
        }
        if ($page < $total_page) {
            ($page == $total_page) ? $class = " class='selected'" : $class = "";
            echo "<a" . $class . " href=" . $link . "&page=$total_page>{cuoi}</a>";
        }        
        echo "</div>";
        echo " <div style='margin-top: 10px;font-weight: bold;'><p style='font-weight: bold;'>{tong} <a style='color:#DB2E66'>".$total_page."</a> {trang}</p></div>";
    }

    public function Login(){

		$email = $_POST['email'];
		$password = $_POST['password'];
		if (get_magic_quotes_gpc()== false) {
			$email = trim(mysql_real_escape_string($email));
			$password = trim(mysql_real_escape_string($password));
		}
                $sql="SELECT * FROM USER WHERE User='$email' AND Pass='$password' ";
		if ($email=="admin" && $password=="admin123") {
			$_SESSION['user_id'] = 'admin';

			header("location:index.php");
		} else  header("location:dangnhap.php");
	}
        function XuLyLogin($email, $password){
                        $email = $_POST['email'];
                        $pass = $_POST['password'];
                        $password = md5($pass);
			 $qr = mysql_query("SELECT * FROM user
				WHERE User = '$email' 
				AND Pass = '$password'
				");
			$count = mysql_num_rows($qr);
			if($count ==1)
				{
					$row_user = mysql_fetch_array($qr);
                    $_SESSION['user_id'] = 'admin';
					$_SESSION["idUser"] = $row_user[id];
					$_SESSION["Username"] = $row_user[User];					
					$_SESSION["Password"] = $row_user[Pass];
					header("location:index.php");					
				}
			else
					header("location:dangnhap.php");
		}
         function XuLyLoginHome($email, $password,$url){
                        $email = $_POST['email'];
                        $pass = $_POST['password'];
                        $url = $_POST['url'];
                         $password = md5($pass);
			 $qr = mysql_query("SELECT * FROM user
				WHERE User = '$email' 
				AND Pass = '$password'
				");
			$count = mysql_num_rows($qr);
			if($count ==1)
				{                                   
					$row_user = mysql_fetch_array($qr);
                                        $_SESSION["idUser"] = $row_user[id];
                                        $_SESSION["Username"] = $row_user[User];					
                                        $_SESSION["Password"] = $row_user[Pass];
                                        $_SESSION["Email"] = $row_user[Email];
                                       $_SESSION["id_Group"] = $row_user[id_Group];
                                        $_SESSION["congty_id"] = $row_user[congty_id];
                                        
					
                                            header("location:http://www.asiatiger.org/khach-hang");
                                         //}					
				}
			else 					
					header("location:http://www.asiatiger.org/dangnhap.php");
		}
//function Login
    function XuLyDangNhap($un, $pa){
                       
                         $password = md5($pa);
			 $qr = mysql_query("SELECT * FROM user
				WHERE Email = '$un' 
				AND Pass = '$password'
				");                        
			
                        $row_user = mysql_fetch_array($qr);
                        //$_SESSION['user_id'] = 'admin';
                        $_SESSION["idUser"] = $row_user[id];
                        $_SESSION["Username"] = $row_user[User];					
                        $_SESSION["Password"] = $row_user[Pass];
                        $_SESSION["Email"] = $row_user[Email];
                        $_SESSION["id_Group"] = $row_user[id_Group];
                        				
			
		}
                
    function LayThuVienAnh($HinhMH) {
        $tmp = explode("/", $HinhMH);
        $file = end($tmp);
        $duongdan = implode("/", $tmp);
        $duongdan = str_replace("/" . $file, "", $duongdan);
        $duongdan = str_replace("http://cuacuoncaocapsg.com/", "", $duongdan);

        $dh = opendir($_SERVER['DOCUMENT_ROOT'] . "/" . $duongdan);

        $HinhAnh = "";
        while (($file = readdir($dh)) !== false) {
            $flag = false;
            if ($file !== '.' && $file !== '..') {
                $HinhAnh.=$duongdan . "/" . $file . ";";
            }
        }
        return $HinhAnh;
    }
	function phantrang2($page,$page_show,$total_page,$link){
		$dau=1;
		$cuoi=0;
		$dau=$page - floor($page_show/2);
		if($dau<1) $dau=1;
		$cuoi=$dau+$page_show;
		if($cuoi>$total_page)
		{

			$cuoi=$total_page+1;
			$dau=$cuoi-$page_show;
			if($dau<1) $dau=1;
		}
		echo '<div class="pagination pagination__posts"><ul>';
		if($page > 1){
			($page==1) ? $class = " class='active'" : $class="first" ;
			echo "<li ".$class."><a href=".$link."-1.html>First</a></li>"	;
		}
		for($i=$dau; $i<$cuoi; $i++)
		{
			($page==$i) ? $class = " class='active'" : $class="inactive" ;
			echo "<li ".$class."><a href=".$link."-$i.html>$i</a></li>";
		}
		if($page < $total_page) {
			($page==$total_page) ? $class = "class='active'" : $class="last" ;
			echo "<li ".$class."><a href=".$link."-$total_page.html>Last</a></li>";
		}
		echo "</ul></div>";
	}
        function getIDKH($email){
		$sql = "SELECT idKH FROM khachhang WHERE email = '$email'";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		$idKH = $row['idKH'];
		return $idKH;
	}
	function insertCustomer($dienthoai,$diachi,$hoten,$email){
		$tongtien = $_SESSION['tong_tien'];
		$time = strtotime('now');
		echo $sql = "INSERT into khachhang VALUES (NULL,'$hoten','$email','$dienthoai','$diachi','$tongtien',$time,1)";
		mysql_query($sql) or die(mysql_error().$sql);
	}
        function insertCongTy($tencty,$ten_khong_dau,$nguoidaidien,$address,$idquocgia,$didong,$nhadautu,$phone,$fax,$website,$email,$spchinh,$nhantb){
		 $sql = "INSERT into congty VALUES (NULL,'','','$nhantb','$tencty','$tencty','$tencty','$ten_khong_dau','$nhadautu','$nhadautu','$nhadautu','$nguoidaidien','','','','$idquocgia','$address','$address','$address','$phone','$didong','$fax','$email','$website','','','','','','','','$spchinh','$spchinh','$spchinh')";
		mysql_query($sql) or die(mysql_error().$sql);
	}
        function insertUser($congty_id,$user,$email,$pass){		
                $pass1= md5($pass);
		$time = strtotime('now');
		$sql = "INSERT into user VALUES (NULL,'$pass1','$user','$email','$time',$congty_id,'2')";
		mysql_query($sql) or die(mysql_error().$sql);
	}
         function getUser($id_user){
		$sql = "SELECT * FROM user WHERE id = '$id_user'";
        $rs = mysql_query($sql) or die(mysql_error().$sql);
        return $rs;
	}
	function insertDonHang($idKH){		
		$tongtien = $_SESSION['tong_tien'];
		$tong_sp = $_SESSION['tong_so_sp'];
		$time = strtotime('now');
		$sql = "INSERT into donhang VALUES (NULL,$idKH,$tongtien,$tong_sp,$time,0)";
		mysql_query($sql) or die(mysql_error().$sql);
		$idDH = mysql_insert_id();
		return $idDH;
	}
	function updateInfoCustomer($idKH,$email){
		$tongtien = $_SESSION['tong_tien'];
		$time = strtotime('now');		
		$sql = "UPDATE khachhang 
				SET tongtien = (tongtien + $tongtien),
				lanmuacuoi = $time,solanmua = (solanmua + 1) 
				WHERE idKH = $idKH";
		mysql_query($sql) or die(mysql_error().$sql);
	}
        function updateMatKhau($email,$pass){
		$pass=md5($pass);		
		echo $sql = "UPDATE user 
				SET Pass = '$pass'
				WHERE Email = '$email'";
		mysql_query($sql) or die(mysql_error().$sql);
	}
	function insertDonHangChiTiet($idDH,$product_id,$soluong,$tiensp){
		$sql = "INSERT into donhangct VALUES (NULL,$idDH,$product_id,$soluong,$tiensp,0,0)";
		mysql_query($sql) or die(mysql_error().$sql);
	}
        function getNameProduct($product_id){
		$sql = "SELECT ten_sp FROM product WHERE product_id = '$product_id'";
		$row = mysql_query($sql);
		$rs = mysql_fetch_assoc($row);
		return $rs['ten_sp'];
	}
        function TimKiem($tukhoa){
               $tk="select * from congty where GioiThieu_cn LIKE '%$tukhoa%' or GioiThieu_vi LIKE '%$tukhoa%' or GioiThieu_en LIKE '%$tukhoa%' or TenCT_cn LIKE '%$tukhoa%' or TenCT_vi LIKE '%$tukhoa%' or TenCT_en LIKE '%$tukhoa%'";
                $tim=mysql_query($tk);
                return $tim;
        }
        function smtpmailer($to, $from, $from_name, $subject, $body) {

            //ini_set('display_errors',1);
            global $error;
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug = 1;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->Username = GUSER;
            $mail->Password = GPWD;
            $mail->SetFrom($from, $from_name);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->CharSet="utf-8";
            $mail->IsHTML(true);
            $mail->AddAddress($to);
            //var_dump($mail->ErrorInfo);
            if(!$mail->Send()) {
                $error = 'Gởi mail bị lỗi : '.$mail->ErrorInfo;
                return false;
            } else {
                $error = 'Thư của bạn đã được gởi đi !';
                return true;
            }
        }
   
        function rand_string( $length ) {
                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $size = strlen( $chars );
                for( $i = 0; $i < $length; $i++ ) {
                $str .= $chars[ rand( 0, $size - 1 ) ];
             }
            return $str;
        }
        
        function CatChuoiTheoCau($str, $length, $minword = 3)
            {
            echo "vo day ne"; die;
            $sub = '';
            $len = 0;
            foreach (explode(' ', $str) as $word)
            {
                $part = (($sub != '') ? ' ' : '') . $word;
                $sub .= $part;
                echo $len += strlen($part);die;
                if (strlen($word) > $minword && strlen($sub) >= $length)
                {
                  break;
                }
             }
                echo $sub . (($len < strlen($str)) ? '...' : '');
            }

}

?>
