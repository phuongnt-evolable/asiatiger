<?php
   // session_start();
   //$url = $_SERVER['REQUEST_URI'];   
    //$_SESSION["url"]=$url;
    /*require "admin/Model/Db.php";
    $d =  new db;*/
    /*if (isset($_POST['btnDangNhap'])==true){	
	$d->XuLyLoginHome($email, $password,$url);
	
    }*/
?>
<style>
.true{background-color: #66FFFF;}
.false{background-color: #FFFFCC;}
#kq1{ width: 300px; margin-left: 300px}
#kq3{ margin-left:300px;}
#kq5{ margin-left:300px;}
#kq_captcha{ margin-left:200px;}


</style>

<div class="container" >
    
    <div class="container-left" style="margin-bottom: 50px;">
        <div id="c_centMain" class="span11">
			<div class="centMainL" style="display: block;">
				<?php
                                    $sql="SELECT * FROM blocks where block_id=13";
                                    $block=mysql_query($sql) or die(mysql_error());                                               
                                    $row_block =  mysql_fetch_assoc($block); 

                                    echo $row_block['block_content_'.$lang];
                                 ?>
				
			</div>
           				
		<div class="centMainR span7">
                    <div style="font-weight: bold;font-size: 18px;margin-left: 20px;color: #A81027;">{dangnhap}</div>
			<form  method="post" id="form">				

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
					<a id="forgetPwd" href="quen-mat-khau.html" rel="nofollow">{quenpass}</a>
				</div>

				<div class="stepSubMail" style="text-align:left; margin:5px 0 10px">
                                    <button class="loginLogin btn-login" id="btnDangNhap" type="button">{dangnhap}</button>
					<a id="userAdd" href="dang-ky.html" >{dangky}</a>
                                        <input type="hidden" name="lang" id="lang" value="<?php echo $lang; ?>" />
                                        <input type="hidden" name="url" id="url" value="<?php echo $_SESSION["url"]; ?>" />
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