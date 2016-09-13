<?php
    session_start();
   $url = $_SERVER['REQUEST_URI'];   
    $_SESSION["url"]=$url;
?>
<style>
.true{background-color: #66FFFF;}
.false{background-color: #FFFFCC;}
#kq1{ width: 300px; margin-left: 300px}
#kq3{ margin-left:300px;}
#kq5{ margin-left:300px;}
#kq_captcha{ margin-left:200px;}


</style>

<div class="container">
    
    <div class="container-left">
        <div id="c_centMain" class="span11">
			<div class="centMainL" style="display: block;width: 550px;">				
				<?php if($lang=='vi'){ ?>
                                <div style="float:left;width: 500px;margin-left: 20px; min-height: 400px; ">
                                    <div>
                                        <h3 class="reg_title">
                                            <img style="width:100px" src="img/loi-ich.jpg"/>
                                            <span style="font-size: 16px;color: #F60;font-weight: bold;">Lời nhắn từ hệ thống ASIATIGER.ORG</span>
                                        </h3>  
                                    </div>
                                    <div style="font-size: 13px;">
                                        Cám ơn bạn đã đăng ký,...Tuy nhiên vì sự an toàn của bạn và hệ thống. Chúng tôi đã gữi mật khẫu đăng nhập vào email của bạn.<br><br>
                                        
                                        Nếu bạn gặp khó khăn trong việc kích hoạt. Bạn có thể gửi mail đến địa chỉ: <strong>asiatiger.org@gmail.com</strong><br><br>
                                        
                                        Trân trọng ! 
                                    </div>
                                    <div style="margin-top:20px">
                                        <img style="width: 300px" src="img/bg-dk.jpg">
                                    </div>
                                </div>
                                <?php } elseif ($lang=='cn') {?>
                                <div style="float:left;width: 500px;margin-left: 20px; min-height: 400px; ">
                                    <div>
                                        <h3 class="reg_title">
                                            <img style="width:100px" src="img/loi-ich.jpg"/>
                                            <span style="font-size: 16px;color: #F60;font-weight: bold;">ASIATIGER.ORG自動回復</span>
                                        </h3>  
                                    </div>
                                    <div style="font-size: 13px;">
                                        謝謝您的加入,為了保障您的用戶安全,我們已經把登錄的密碼發到您的郵箱,請查收。<br><br>
                                        
                                        如有任何問題，您可以直接發EMAIL給我們： <strong>asiatiger.org@gmail.com</strong><br><br>
                                        
                                        謝謝! 
                                    </div>
                                    <div style="margin-top:20px">
                                        <img style="width: 300px" src="img/bg-dk.jpg">
                                    </div>
                                </div>    
                               <?php } else {?>
                                 <div style="float:left;width: 500px;margin-left: 20px; min-height: 400px; ">
                                    <div>
                                        <h3 class="reg_title">
                                            <img style="width:100px" src="img/loi-ich.jpg"/>
                                            <span style="font-size: 16px;color: #F60;font-weight: bold;">Message from system ASIATIGER.ORG</span>
                                        </h3>  
                                    </div>
                                    <div style="font-size: 13px;">
                                        Thank you for registering, ... But for the safety of you and your system. We have sent the login password on your email.<br><br>
                                        
                                        If you have difficulty activating. You can send mail to the following address: <strong>asiatiger.org@gmail.com</strong><br><br>
                                        
                                        Sincerely ! 
                                    </div>
                                    <div style="margin-top:20px">
                                        <img style="width: 300px" src="img/bg-dk.jpg">
                                    </div>
                                </div>   
                               <?php }?>
			</div>
						
		<div class="centMainR span7">
                    <div style="font-weight: bold;font-size: 18px;margin-left: 20px;color: #A81027;">{dangnhap}</div>
			<form action="#" method="post" id="form">				

				<input type="hidden" value="" name="nextUrl">
				<div class="signInput">
					<label class="loginFormLabel ">{tendn} {hoac} {email}</label>
					<input class="loginInput " id="tendn" name="logUserName" maxlength="100">
				</div>
				<div class="signInput">
					<label class="loginFormLabel">{pass}</label>
					<input class="loginInput " id="pass"  type="password" name="logPassword" maxlength="20">
				</div>

												<div class="paddingDiv4 grayColor">
					<input type="checkbox" id="rememberMyMemberId" name="rememberMyMemberId">&nbsp;{rememberme}
					<a id="forgetPwd" href="#" rel="nofollow">{quenpass}</a>
				</div>

				<div class="stepSubMail" style="text-align:left; margin:5px 0 10px">
                                    <button class="loginLogin btn-login" id="btnDangNhap" type="button">{dangnhap}</button>
					<a id="userAdd" href="dang-ky.html" >{dangky}</a>
				</div>
                                <span id="thongbao"></span>
				<div>
					<div class="c">
					</div>
				</div>
				<!-- <div class="marginT" align="right"></div>-->
			</form>
	</div>
    </div>
    <?php //include 'blocks/right.php'; ?>
</div>