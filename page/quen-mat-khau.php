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
                                        <br><br>
                                        Vui lòng nhập địa chỉ e-mail đăng ký của bạn, chúng tôi sẽ giúp bạn lấy ID thành viên và thiết lập lại mật khẩu bằng e-mail.<br><br>
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
                                        請輸入您註冊的郵件地址，我們將幫助你找回會員ID，並通過e-mail重置密碼。<br><br>
                                        
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
                                        Please enter your registered e-mail address, we will help you to retrieve member ID and reset password by e-mail.<br><br>
                                        
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
                    <div style="font-weight: bold;font-size: 18px;margin-left: 20px;color: #A81027;">{quenpass}</div>
							

				<input type="hidden" value="" name="nextUrl">
				<div class="signInput">
                                    <div style="margin-top: 20px;font-size: 15px;font-weight: bold;">{email} :</div>
                                    <input style="margin-top: 10px;" class="loginInput " id="tendn" name="logUserName" maxlength="100">
				</div>				

                                <div class="stepSubMail" style="text-align:left; margin:5px 0 10px">
                                    <button class="loginLogin btn-login" id="btnLayMatKhau" type="button">{gui}</button>					
                                    <a id="userAdd" href="dang-ky.html" >{dangky}</a>
                                    <input type="hidden" name="lang" id="lang" value="<?php echo $lang; ?>" />
                                    <input type="hidden" name="pass" id="pass" value="<?php echo $my_string=  $d-> rand_string( 5 ); ?>" />
				</div>

				
                                <span id="thongbao"></span>
				<div>
					<div class="c">
					</div>
				</div>
				<!-- <div class="marginT" align="right"></div>-->
			
	</div>
    </div>
    <?php //include 'blocks/right.php'; ?>
</div>