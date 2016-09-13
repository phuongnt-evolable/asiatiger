<?php 
session_start();
require_once('../admin/Model/Db.php'); 
$d = new db;

$email=$d->processData($_POST['us']);
$pass= $d->processData($_POST['pass']);
$lang=$d->processData($_POST['lang']);
    
        $d -> updateMatKhau($email,$pass);
        $emailnhan=$email;
        //$emailnhan = "emailkhachmoidangky@gmail.com";
        if($lang=='vi'){
            $tieudethu="Thư cung cấp lại mật khẩu";       
            $noidungthu = 'Cảm ơn quý khách đã sử dụng trang web Asiatiger , mật khẩu đăng nhập của quý khách là : <strong>'.$pass.'</strong> , xin vui lòng thay đổi mật khẩu sau khi đăng nhập , để tránh trường hợp bị người khác đánh cắp mật khẩu <br/> '
                    .'Xin vui lòng điền đầy đủ thông tin của quý công ty , nếu có đăng tải hình công ty hoặc thông tin xin làm theo chỉ dẫn của trang web <br/>'
                    .'Xin cảm ơn !';
                    
                    
            $noidungthu.='<div>
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
';
          
            $d->smtpmailer($emailnhan, "asiatiger.org2015@gmail.com", 'ADMIN VINH SANG',$tieudethu,$noidungthu);
        }elseif ($lang=='cn') {
            $tieudethu="郵件提供的密碼";       
            $noidungthu = '尊敬的 " '.$user.'"  您好:</trong> <br/>'
                    . '感謝您使用 Asiatiger 專業入口網站, 您的登錄密碼為: <strong> '.$pass.'</strong> , 煩請立即登錄會員, 並更改密碼, 以免招人盜用 <br/> '
                    .'並仔細填妥   貴公司資料,  如須登錄照片及資訊 請按我司說明處理 <br/>'
                    .'謝謝 !';
                    
                    
            $noidungthu.='<div>
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
';                
            $d->smtpmailer($emailnhan, "asiatiger.org2015@gmail.com", 'ADMIN VINH SANG',$tieudethu,$noidungthu);
        }  else {
            $tieudethu="Mail provides password";       
            $noidungthu = 'Xin kính chào quý khách <strong>'.$user.'</trong> <br/>'
                    . 'Cảm ơn quý khách đã sử dụng trang web Asiatiger , mật khẩu đăng nhập của quý khách là : <strong>'.$pass.'</strong> , xin vui lòng thay đổi mật khẩu sau khi đăng nhập , để tránh trường hợp bị người khác đánh cắp mật khẩu <br/> '
                    .'Xin vui lòng điền đầy đủ thông tin của quý công ty , nếu có đăng tải hình công ty hoặc thông tin xin làm theo chỉ dẫn của trang web <br/>'
                    .'Xin cảm ơn !';
                    
                    
            $noidungthu.='<div>
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
';
                          
            $d->smtpmailer($emailnhan, "asiatiger.org2015@gmail.com", 'ADMIN VINH SANG',$tieudethu,$noidungthu);
        }

?>