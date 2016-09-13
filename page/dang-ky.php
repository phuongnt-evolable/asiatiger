<?php
//session_start();
   $url = $_SERVER['REQUEST_URI'];   
    $_SESSION["url"]=$url;
    
    $quocgia = $modelQuocgia->getAllQuocGia();
    
    if(isset($_POST['btnOK']))
{
	
	if(empty($_SESSION['6_letters_code'] ) ||
	  strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
	{
	//Note: the captcha code is compared case insensitively.
	//if you want case sensitive match, update the check above to
	// strcmp()
		echo "\n Mã bão vệ không đúng !";
	}
	
	
}
?>

<div class="container">
    
    
        
        <form method="post" id="register" name="register" action="">
            <input type="hidden" name="url" value=""/>
            <div class="block_content1">
                    <h3 class="reg_title"><img src="img/register_icon.png"/><span>{dangky}</span></h3>
                    {batbuocnhap}
                    <div class="block_field">
                            <h1>{tttk}</h1>
                            <ul>
                                    <li>
                                        <span><font style="color:red;margin-right: 10px;">(*)</font>{tendn}:</span>
                                      <input class="input_text" type="text" size="45" name="username" id="username" value="" placeholder="{tendn}"/>
                                      <span id="kq1"></span>  
                                    </li>
                                              
                                    <li>
                                        <span><font style="color:red;margin-right: 10px;">(*)</font>{email}:</span>
                                        <input class="input_text" type="text" size="45" name="email" id="email" value="" placeholder="asiatiger@gmail.com" />
                                        <?php
                                            if($lang=='vi'){
                                        ?>
                                        <div style="float: left;" class="best-weekend">
                                            <div class="head-box">                          
                                              <div class="ico">
                                                <div class="tooltip-help-01">
                                                    <h2 class="top-title"><span class="general-icon note"></span><a style="color:#1079e2">Tài khoản email</a></h2>
                                                  <div class="tt-content">
                                                      <p> Bạn vui lòng điền chính xác địa chỉ email của bạn vì nó được dùng để đăng nhập vào hệ thống.</p>
                                                      <p> Và đặc biệt mật khẫu cũa bạn cũng sẽ được gữi thông qua email này.</p>
                                                   </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                            <?php } elseif ($lang=='cn') {?>
                                        <div style="float: left;" class="best-weekend">
                                            <div class="head-box">                          
                                              <div class="ico">
                                                <div class="tooltip-help-01">
                                                    <h2 class="top-title"><span class="general-icon note"></span><a style="color:#1079e2">郵箱賬戶</a></h2>
                                                  <div class="tt-content">
                                                      <p> 請輸入正確的郵箱地址以便於登陸用。</p>
                                                      <p> 而且系統將會發給您原始密碼到此郵箱。</p>
                                                   </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                            <?php } else {?>
                                        <div style="float: left;" class="best-weekend">
                                            <div class="head-box">                          
                                              <div class="ico">
                                                <div class="tooltip-help-01">
                                                    <h2 class="top-title"><span class="general-icon note"></span><a style="color:#1079e2">Email Account</a></h2>
                                                  <div class="tt-content">
                                                      <p> Please fill out the exact address of your email because it is used to log into the system.</p>
                                                      <p> And especially your password will be sent via email.</p>
                                                   </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <span id="kq3"></span>                                    
                                    </li>

                                <li><span><font style="color:red;margin-right: 10px;">(*)</font>{pass}:</span><input class="input_text" type="password" size="45" name="password" id="pass" value="" ></li>
                                <span id="kq4"></span>
                                <li><span><font style="color:red;margin-right: 10px;">(*)</font>{nhaplaipass}:</span><input class="input_text" type="password" size="45" name="repassword" id="repassword" value="" ></li>
                                    <span id="kq5"></span>			
                            </ul>
                    </div>

                    <div class="block_field">
                            <h1>{ttct}</h1>
              <ul id="company_info">
                  <li><span><font style="color:red;margin-right: 10px;">(*)</font>{tencty}:</span><input id="tencty" class="input_text" type="text" size="45" name="company" value="" placeholder="CTY TNHH QC TK Vinh Sang "></li>
                  <li><span><font style="color:red;margin-right: 10px;">(*)</font>{diachi}:</span><input  id="diachi" class="input_text" type="text" size="45" name="company_address" value="" placeholder="{diachi}"></li>
                  <li>
                      <span>{dienthoai}:</span>
                      <select name="dienthoai1" id="dienthoai1"  style="margin-right: 10px" >
                          <option value="" ></option>
                      </select>
                      <?php /*<input id="dienthoai1" style="margin-right: 10px" class="input_text" type="text" size="5"  value="<?php $row_qg['MaVung']; ?>" >  */?>
                      <input id="dienthoai2" style="margin-right: 10px" class="input_text" type="text" size="5"  placeholder="Area" onKeyUp="value = value.replace(/[^0-9]/g, '')">
                      <input id="dienthoai3" style="margin-right: 10px" class="input_text" type="text" size="25" placeholder="Number" onKeyUp="value = value.replace(/[^0-9]/g, '')">
                  </li>
                  <li>
                      <span>{fax}:</span>
                      <select name="fax1" id="fax1" style="margin-right: 10px" >
                          <option value=""></option>
                      </select>
                      <?php /*<input id="fax1" style="margin-right: 10px" class="input_text" type="text" size="5"  value="<?php //if($lang=='vi') {echo '+84';} if($lang=='cn') {echo '+886';} if($lang=='en') {echo '+44';} ?>" >*/?>
                      <input id="fax2" style="margin-right: 10px" class="input_text" type="text" size="5"  value="" onKeyUp="value = value.replace(/[^0-9]/g, '')">
                      <input id="fax3" style="margin-right: 10px" class="input_text" type="text" size="25"  value="" onKeyUp="value = value.replace(/[^0-9]/g, '')">

                  </li>
                  <li><span>{website}:</span><p style="float:left;">http://</p><input id="website" class="input_text" type="text" size="45" name="website" value="" placeholder="asiatiger.org"></li>
                  <li><span><font style="color:red;margin-right: 10px;">(*)</font>{nguoilienhe}:</span><input id="nguoidaidien" class="input_text" type="text" size="45" name="nguoidaidien" value="" placeholder="{nguoilienhe}"></li>
                  <li><span>{didong}:</span><input id="didong" class="input_text" type="text" size="45" name="didong" value="" placeholder=""></li>
                  <li>
                      <span><font style="color:red;margin-right: 10px;">(*)</font>{quocgia}:</span>
                      <select name='quocgia' id="quocgia">
                            <option value='0'>----{chon}----</option>
                            <?php
                               // $quocgia = $modelQuocgia->getAllQuocGia();
                                while($row_qg = mysql_fetch_assoc($quocgia)){
                                   // $idTL=$row_cha['idTL'];
                            ?>
                                <option value="<?php echo $row_qg['idQuocGia']?>"><?php echo $row_qg['TenQuocGia_'.$lang]?></option>

                            <?php  } ?>
                      </select>
                  </li>
                  <li><span>{nhadautu}:</span><input id="nhadautu" class="input_text" type="text" size="45" name="nhadautu" value="" placeholder=""></li>


                <li><span><font style="color:red;margin-right: 10px;">(*)</font>{spchinh}:</span><input id="spchinh" class="input_text" type="text" size="45" name="spchinh" value="" etype="number"></li>
                <li><span><font style="color:red;margin-right: 10px;">(*)</font>{hangmuckd}:</span>
                    <div style="float:left;">
                        <?php 
                            $menu=$modelCate->getAllTL();
                            while ($row_menu=  mysql_fetch_assoc($menu)){
                        ?>
                        <div  style="margin-bottom: 5px;">
                             <a class="TenTL" style="font-size: 13px;font-weight: bold;"><?php echo $row_menu['TenTL_'.$lang] ?></a>
                             <input type="hidden" name="idTL" id="idTL" value="<?php echo $row_menu['idTL'] ?>" />
                            <?php 

                                    $idTL=$row_menu['idTL'];
                                    $menu_con=$modelCate->getListCate($idTL);
                                    while($row_menu_con=  mysql_fetch_assoc($menu_con)){
                             ?>
                            <div class="TenCate" >
                                <p style="padding: 5px;"><input style="margin-right:5px;" type="checkbox" class="Category" id="Category" name="Category[]" value="<?php echo $row_menu_con['cate_id'] ?>" onclick="chkcontrol();" > <?php echo $row_menu_con['cate_name_'.$lang] ?></p>
                            </div> 
                            <?php } ?>
                        </div>
                            <?php }  ?>
                     </div> 
                </li>
                <li style="clear:both;">
                    <span></span>
                    <img  style="margin-left: 160px;margin-top: 20px;" src="blocks/captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' >
                    <a href='javascript: refreshCaptcha();'><img style="width: 30px;margin-left: 20px;margin-top: 25px;" src="img/refresh.png"></a>
                </li>
                <li style="clear: both;margin-top: 50px;">
                    <span><font style="color:red;margin-right: 10px;">(*)</font>{mabaove}:</span>
                    <input id="6_letters_code" name="6_letters_code" type="text"><br>
                    
                </li>
                <li  >
                    <span  ><input style="margin-right:5px; float: right; margin-top: 20px;" type="checkbox" class="NhanThongBao" id="NhanThongBao" name="NhanThongBao" value="1" onclick="chkcontrol();" ></span>
                    <p style="padding: 15px; float: left">{nhanttqc}</p>
                    <?php if($lang=='vi'){?>
                        <div style="float: left;margin-top: 12px;" class="best-weekend">
                            <div class="head-box">                          
                              <div class="ico">
                                <div class="tooltip-help-01">
                                    <h2 class="top-title"><span class="general-icon note"></span><a style="color:#1079e2">Nhận thông tin qua mail</a></h2>
                                  <div class="tt-content">
                                      <p><strong>1.</strong> Khi bạn đăng bán sãn phẫm mới lên hệ thống, chúng tôi sẽ gửi thông tin sản phẩm bạn cho những khách hàng có nhu cầu về sản phẩm của bạn hoặc những khách hàng tiềm năng khác.</p>
                                    <p><strong>2.</strong> Khi bạn cần mua 1 sản phẩm bất kỳ mà lúc hiện tại hệ thống chưa có sản phẫm đó thì khi có thông tin chúng tôi sẽ gữi đến bạn trong thời gian nhanh nhất.</p>
                                   </div>
                                </div>
                              </div>
                            </div>
                          </div>
                     <?php } elseif ($lang=='cn') {?>
                    <div style="float: left;margin-top: 12px;" class="best-weekend">
                        <div class="head-box">                          
                          <div class="ico">
                            <div class="tooltip-help-01">
                                <h2 class="top-title"><span class="general-icon note"></span><a style="color:#1079e2">通過郵箱接受更多信息</a></h2>
                              <div class="tt-content">
                                  <p> <strong>1.</strong> 當您上載新的產品到系統時，我們將把您所上載的產品之資訊發送到有該需求的用戶上。</p>
                                  <p><strong>2.</strong> 當您想求購產品而系統暫時沒有該產品之資訊時，系統將為您及時更新并通過郵箱發送該產品的最新資訊。</p>
                               </div>
                            </div>
                          </div>
                        </div>
                    </div>
                        <?php } else {?>
                    <div style="float: left;margin-top: 12px;" class="best-weekend">
                        <div class="head-box">                          
                          <div class="ico">
                            <div class="tooltip-help-01">
                                <h2 class="top-title"><span class="general-icon note"></span><a style="color:#1079e2">Get information by mail</a></h2>
                              <div class="tt-content">
                                  <p> <strong>1.</strong> When you sign up to sell the new product system, we will send the product to your customer demand for your product or other potential customers.</p>
                                  <p> <strong>2.</strong> When you need to buy one product any system that at present there is no product that is when we will have the information sent to you in the shortest possible time.</p>
                               </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <?php } ?>
                </li> 
                <input type="hidden" name="ngaydangky" id="ngaydangky" value="<?php echo "20". date("y/m/d");?>" />
                <!--<input type="hidden" name="pass" id="pass" value="<?php /*echo $my_string=  $d-> rand_string( 5 ); */?>" />-->
                <input type="hidden" name="ten_khong_dau" id="ten_khong_dau" value="" />
                <input type="hidden" name="lang" id="lang" value="<?php echo $lang; ?>" />
              </ul>

              </div>



                    

                    <div class="block_submit">
                        <input class="input_submit loginLogin" type="button" name="btnOK" value="{dangky}" id="btnOK" />
                            &nbsp; <input class="input_submit loginLogin" type="reset" name="reset" value="{nhaplai}" />
                            <span id="thongbao"></span>
                    </div>
            </div>
        </form>
        
    
    <div style="float:left;width: 330px;margin-left: 20px; min-height: 400px; ">
        <div class="footer">
            <?php
               $sql="SELECT * FROM blocks where block_id=13";
               $block=mysql_query($sql) or die(mysql_error());                                               
               $row_block =  mysql_fetch_assoc($block); 

               echo $row_block['block_content_'.$lang];
            ?>
       </div>
    </div>
    <?php //include 'blocks/right.php'; ?>
</div>

<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>