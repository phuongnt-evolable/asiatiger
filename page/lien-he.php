<?php
   // session_start();
    $url = $_SERVER['REQUEST_URI'];   
    $_SESSION["url"]=$url;
?>
<div class="container">
    
    <div class="container-left">
        <form method="post" id="register" name="register" action="">
            <input type="hidden" name="url" value=""/>
            <div class="block_content">
                <h3 class="reg_title">
                    <img style="width: 80px;top: 100px;position: absolute;" src="img/contact_icon.png"/>
                    <span style="margin-left:95px">{lienhe}</span>
                </h3>
                    <div class="contentFrame">
                    <div class="content" style="margin-top: 30px;">


                    <link type="text/css" rel="stylesheet" href="css/Contact.css">

                    <div class="contact" >
                        <div class="contact-info">
                            <?php 
                                $sql="SELECT * FROM blocks where block_id=5";
                                $block=mysql_query($sql) or die(mysql_error());                                               
                                $row_block =  mysql_fetch_assoc($block); 

                                echo $row_block['block_content_'.$lang];
                             ?>                            
                        </div>
                        <div class="contactForm">

                            <div id="ctl00_cphMain_Contact1_ctl00_cphMain_Contact1_rapContactPanel">
                                <div id="ctl00_cphMain_Contact1_rapContact">

                                    <div class="labelsColumn">
                                        <label>
                                            {tieude}<span>*</span></label>
                                        <label>
                                            {noidung}<span>*</span></label>
                                        <label style="margin-top: 60px;">
                                            {nguoilienhe}<span>*</span></label>
                                        <label>
                                            {tencty}<span>*</span></label>
                                        <label>
                                            {diachi}<span>*</span></label>
                                        <label>
                                            {dienthoai}<span>*</span></label>
                                        <label>
                                            {fax}<span>*</span></label>
                                        <label>
                                            {email}<span>*</span></label>                                       
                                        

                                    </div>
                                    <div class="textBoxsColumn">
                                        <input name="tieude" type="text" id="tieude" class="RadInputMgr RadInputMgr_Default RadInput_Enabled_Default" >
                                        <textarea name="" rows="2" cols="20" id="noidung" class="textboxMultiline"></textarea>
                                        <input name="" type="text" id="nguoilienhe" class="textbox">
                                        <input name="" type="text" id="tencty" class="RadInputMgr RadInputMgr_Default RadInput_Enabled_Default" >
                                        <input name="" type="text" id="diachi" class="textbox">
                                        <input name="" type="text" id="dienthoai" class="textbox">
                                        <input name="" type="text" id="fax" class="textbox">
                                        <input name="" type="text" id="email" class="textbox">
                                    </div>
                                    <div class="btncontact">
                                        <input style="margin-top: 20px;" id="btnLienHe" class="loginLogin" type="button" value="{gui}" >
                                        <input type="hidden" name="lang" id="lang" value="<?php echo $lang; ?>" />
                                        <span id="thongbao"></span>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div style="clear: both;"></div>
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4140187068892!2d106.60327846189618!3d10.779568422030815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752c6cd6cc557f%3A0x9f13ead47f53ed5c!2zMTE4LzIyIE1p4bq_dSBHw7IgWG_DoGksIELDrG5oIEjGsG5nIEjDsmEgQSwgQsOsbmggVMOibiwgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1456452382411" width="810" height="450" frameborder="0" style="border:0"></iframe>

                    </div>



                    </div>
                    </div>
            </div>
        </form>
    </div>
    <?php include 'blocks/right-content.php'; ?>
</div>

