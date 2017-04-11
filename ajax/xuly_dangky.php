<?php
//var_dump($_POST);die;
session_start();
require_once('../admin/Model/Db.php');
$d = new db;

$user = $d->processData($_POST['us']);
$email = $d->processData($_POST['email']);
$tencty = $d->processData($_POST['tencty']);
$address = $d->processData($_POST['address']);
$idquocgia = $d->processData($_POST['quocgia']);
$nhadautu = $d->processData($_POST['nhadautu']);
$didong = $d->processData($_POST['didong']);
$phone1 = $d->processData($_POST['phone1']);
$phone2 = $d->processData($_POST['phone2']);
$phone3 = $d->processData($_POST['phone3']);
$phone = $phone1 . '-' . $phone2 . '-' . $phone3;
$fax1 = $d->processData($_POST['fax1']);
$fax2 = $d->processData($_POST['fax2']);
$fax3 = $d->processData($_POST['fax3']);
$fax = $fax1 . '-' . $fax2 . '-' . $fax3;
$website = $d->processData($_POST['website']);
$pass = $d->processData($_POST['pass']);
$nguoidaidien = $d->processData($_POST['nguoidaidien']);
$spchinh = $d->processData($_POST['spchinh']);
$idTL = $d->processData($_POST['idTL']);
$lang = $d->processData($_POST['lang']);
$nhantb = $d->processData($_POST['nhantb']);
$arr_cate_id = $_POST['cate_id'];
$ten_khong_dau = $d->processData(($_POST['ten_khong_dau']));
if ($ten_khong_dau == "") {
    $ten_khong_dau = $d->changeTitle($tencty);
}

$d->insertCongTy($tencty, $ten_khong_dau, $nguoidaidien, $address, $idquocgia, $didong, $nhadautu, $phone, $fax,
    $website, $email, $spchinh, $nhantb);
$congty_id = mysql_insert_id();
foreach ($arr_cate_id as $cateid) {
    $sql = "SELECT idTL from category WHERE cate_id=$cateid";
    $row = mysql_query($sql);
    $row_tl = mysql_fetch_assoc($row);
    $idTL = $row_tl['idTL'];
    mysql_query("INSERT INTO cty_cate VALUES('',$congty_id,$cateid,'$idTL')");
}
$user1 = $d->insertUser($congty_id, $user, $email, $pass);
$id_user = mysql_insert_id();
$get_user = $d->getUser($id_user);
$row_user = mysql_fetch_assoc($get_user);
$_SESSION["idUser"] = $id_user;
$_SESSION["Username"] = $row_user['User'];
$_SESSION["Password"] = $row_user['Pass'];
$_SESSION["Email"] = $row_user['Email'];
$_SESSION["id_Group"] = $row_user['id_Group'];
$_SESSION["congty_id"] = $congty_id;

$emailnhan = $email;
if ($lang == 'vi') {
    $tieudethu = "Xác nhận đăng ký thành công !";
    $noidungthu = 'Xin kính chào quý khách <strong>' . $user . '</strong>  <br/>'
        . 'Cám ơn bạn đã sử dụng trang web thông tin Châu Á Asiatiger, vui lòng đăng nhập ngay, đồng thời nhớ kỹ mật khẩu, để tránh bị mất<br/> '
        . 'Vui lòng điền đầy đủ thông tin cty, nếu cần úp hình và thông tin, xin xử lý theo hướng dẫn của chúng tôi  <br/>'
        . 'Xin cảm ơn !';


    /*$noidungthu.='<div>
<h3 class="reg_title">
<img src="http://asiatiger.org/img/loi-ich.jpg" style="width:100px;float: left;" /> <span style="font-size: 16px;color: #F60;font-weight: bold;line-height: 33px;">Quyền lợi th&agrave;nh vi&ecirc;n của Asiatiger </span></h3>
</div>

<div style="margin-left: 20px;margin-top: 30px;">
<p>
<span class="span-dk"><span class="span-dk"><img class="img-dk" src="http://asiatiger.org/img/icon-yes.png" /> Miễn ph&iacute; đăng th&ocirc;ng tin , 20 h&igrave;nh ảnh li&ecirc;n quan l&ecirc;n tr&ecirc;n trang c&aacute; nh&acirc;n. </span><br />
<br />
<span class="span-dk"><span class="span-dk"><img class="img-dk" src="http://asiatiger.org/img/icon-yes.png" /> Hệ thống tự động giới thiếu đến những việc đ&atilde; y&ecirc;u cầu . </span><br />
<br />
<span class="span-dk"><img class="img-dk" src="http://asiatiger.org/img/icon-yes.png" /> Hỏi gi&aacute; , b&aacute;o gi&aacute; tr&ecirc;n mạng trực tiếp .</span><br />
<br />
<span class="span-dk"><img class="img-dk" src="http://asiatiger.org/img/icon-yes.png" /> Miễn ph&iacute; đăng k&yacute; th&ocirc;ng tin mua b&aacute;n .</span><br />
<br />
<span class="span-dk"><img class="img-dk" src="http://asiatiger.org/img/icon-yes.png" /> Trực tiếp sử dụng c&aacute;c chức năng của trang web đưa ra .</span></span></span></p>
</div>
<div style="margin-top:20px">
<img src="http://asiatiger.org/img/bg-dk.jpg" style="width: 300px" /></div>
';*/

    $d->smtpmailer($emailnhan, "asiatiger.info@gmail.com", 'ADMIN VINH SANG', $tieudethu, $noidungthu);
} elseif ($lang == 'cn') {
    $tieudethu = "郵件提供的密碼";
    $noidungthu = '尊敬的 " ' . $user . '"  您好:</trong> <br/>'
        . '感謝您使用 Asiatiger 亞洲虎資訊網, 煩請立即登錄會員, 並保存好密碼, 以免招人盜用 <br/> '
        . '並仔細填妥 貴公司資料, 如須登錄照片及資訊 請按我司說明處理 <br/>'
        . '謝謝 !';

    /*$noidungthu.='<div>
<h3 class="reg_title">
<img src="http://asiatiger.org/img/loi-ich.jpg" style="width:100px;float: left;" /> <span style="font-size: 16px;color: #F60;font-weight: bold;line-height: 33px;">AsiaTiger 會員權益 </span></h3>
</div>

<div style="margin-left: 20px;margin-top: 30px;">
<p>
<span class="span-dk"><span class="span-dk"><img class="img-dk" src="http://asiatiger.org/img/icon-yes.png" />免費試刊登專屬網頁及可上傳 20張圖片</span><br />
<br />
<span class="span-dk"><span class="span-dk"><img class="img-dk" src="http://asiatiger.org/img/icon-yes.png" /> 系統自動媒合你的需或求 </span><br />
<br />
<span class="span-dk"><img class="img-dk" src="http://asiatiger.org/img/icon-yes.png" /> 線上直接詢價,報價</span><br />
<br />
<span class="span-dk"><img class="img-dk" src="http://asiatiger.org/img/icon-yes.png" /> 免費刊登求購訊息</span><br />
<br />
<span class="span-dk"><img class="img-dk" src="http://asiatiger.org/img/icon-yes.png" /> 直接使用本網站提供的各項功能</span></span></span></p>
</div>
<div style="margin-top:20px">
<img src="http://asiatiger.org/img/bg-dk.jpg" style="width: 300px" /></div>
';  */
    $d->smtpmailer($emailnhan, "asiatiger.info@gmail.com", 'ADMIN VINH SANG', $tieudethu, $noidungthu);
} else {
    $tieudethu = "Mail provides password";
    $noidungthu = 'Hello to you <strong>' . $user . '</trong> <br/>'
        . ' Thank you for using Asiatiger information net, please immediately login,    and protect your password, so as to avoid be theft account '
        . 'And certainly fill in your company information, such as require to upload photos and relation information, Please according to our instructions <br/>'
        . 'Thank you very much!';


    /*$noidungthu.='<div>
<h3 class="reg_title">
<img src="http://asiatiger.org/img/loi-ich.jpg" style="width:100px;float: left;" /> <span style="font-size: 16px;color: #F60;font-weight: bold;line-height: 33px;">AsiaTiger Member Benefits </span></h3>
</div>

<div style="margin-left: 20px;margin-top: 30px;">
<p>
<span class="span-dk"><span class="span-dk"><img class="img-dk" src="http://asiatiger.org/img/icon-yes.png" />  Free try to publish exclusive web pages.</span><br />
<br />
<span class="span-dk"><span class="span-dk"><img class="img-dk" src="http://asiatiger.org/img/icon-yes.png" /> Our system active solvation your request. </span><br />
<br />
<span class="span-dk"><img class="img-dk" src="http://asiatiger.org/img/icon-yes.png" /> Inquiry and Quote online. </span><br />
<br />
<span class="span-dk"><img class="img-dk" src="http://asiatiger.org/img/icon-yes.png" /> Can use all functions of our system.</span><br />
<br />
<span class="span-dk"><img class="img-dk" src="http://asiatiger.org/img/icon-yes.png" /> Free registration information purchase. </span></span></span></p>
</div>
<div style="margin-top:20px">
<img src="http://asiatiger.org/img/bg-dk.jpg" style="width: 300px" /></div>
';*/

    $d->smtpmailer($emailnhan, "asiatiger.info@gmail.com", 'ADMIN VINH SANG', $tieudethu, $noidungthu);
}

?>