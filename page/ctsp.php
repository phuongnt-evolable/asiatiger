<?php
    //session_start();
   $url = $_SERVER['REQUEST_URI'];   
    $_SESSION["url"]=$url;
    
    $congty_id=$row_1['congty_id'];
    $congty=$modelCongTy->getDetailCongTy($congty_id);
    $row_cty=  mysql_fetch_assoc($congty);
?>
<div id="content" class="container container-detail util-clearfix" >
    <!-- breadcrumb -->
     <?php /*<div class="breadcrumbs util-clearfix">
      <div class="breadcrumbs-item" itemtype="http://data-vocabulary.org/Breadcrumb">
      <a itemprop="url" href="asiatiger.org"><span itemprop="title">{trangchu}</span></a>
      </div>
      <div itemtype="#" class="breadcrumbs-item">
      <a itemprop="url" href="#"><span itemprop="title">Tất cả danh mục</span></a>
      </div>

      <div itemtype="#" class="breadcrumbs-item hasSub">
      <a class="title" itemprop="url"  title="Du lịch - Khách sạn" href="/u23/du-lich-khach-san.html"><span itemprop="title">Du lịch - Khách sạn</span></a>
      <ul>

      <li><a href="/u916/du-lich-nuoc-ngoai.html">Du lịch nước ngoài</a></li>

     
      </ul>
      </div>

      <div itemtype="http://data-vocabulary.org/Breadcrumb" class="breadcrumbs-item hasSub">
      <a class="title" itemprop="url"  title="Khách sạn" href="/u937/khach-san.html"><span itemprop="title">Khách sạn</span></a>
      <ul>

      <li><a href="/u940/khach-san-1-sao.html">Khách sạn 1 sao</a></li>

      </ul>
      </div>
      <div class="breadcrumbs-item active" itemtype="http://data-vocabulary.org/Breadcrumb" >
      <a title="Khách sạn 3 sao" itemprop="url" href="/u942/khach-san-3-sao.html"><span itemprop="title">Khách sạn 3 sao</span></a>
      </div>

      <div class="breadcrumbs-item lastItem" itemtype="http://data-vocabulary.org/Breadcrumb" >
      <a href="/1696928/1751894/khuyen-mai-khach-san-gia-re-chat-luong-cao.html">
      <strong class="item-filter">KHUYẾN MÃI KHÁCH SẠN GIÁ RẺ - CHẤT LƯỢNG CAO</strong>
      </a>
      </div>

      </div> */?>

    <!--Block content left -->
    <div class="container-left container-lf-detail main-detail" style="margin-bottom: 30px;">  
        <!--box-img-detail-->
        <div id="base" class="box-img-detail info-box" style="min-height: 200px;" itemscope="">
            <div class="box-img-lf pic-info">
                <div id="inf" class="clearfix" style="height:0"></div>
                <div id="img" style="position:relative;z-index:120;">
                    <div class="pic-info-inside">
                        <div class="image-item img" itemprop="image" >
                            <a class="fancybox" title="<?php echo $row_1['product_name_'.$lang]; ?>" href="<?php echo $row_1['url_images']; ?>"><img width="225"  src="<?php echo $row_1['url_images']; ?>"></a>
                        </div>
                        
                    </div>
                    <div class="social-block" style="margin-top: 10px;">
                    <div class="clearfix">
                        <div class="fb-share-button" style="float:left; margin-right: 10px;" data-href="#" data-type="button_count"></div>
                        <!-- Place this tag where you want the +1 button to render. -->
                        <div  style="float:left; margin-right: 10px; width: 60px !important;">
                            <div class="g-plusone" data-size="medium" ></div>
                        </div>
                        <div>
                            <a style="float:left; margin-right: 10px;" href="#" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" /></a>
                        </div>	
                    </div>
                    <!-- Place this tag after the last +1 button tag. -->
                    <script type="text/javascript">
                        (function() {
                            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                            po.src = 'https://apis.google.com/js/platform.js';
                            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                        })();
                    </script>
                    <!-- Please call pinit.js only once per page -->
                    <script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>
                    <!-- end detail -->					</div>
                    <!--<div class="img-gallery" style="width:300px">
                        <ul id="img-gallerySlider" class="image-nav clearfix" style="display:block">
                            <li id="change_price_10516" class ='image-nav-item' rel="0">
                                <span id="http://s2-media.123mua.vn/2014/c/a/cafe1fd1925da88328b25c8876f0b83e.jpg"><span class="arrow-img-gallery">arrow</span>	
                                    <img id="image_0" src="http://s2-media.123mua.vn/2014/c/a/cafe1fd1925da88328b25c8876f0b83e_200x200.jpg" alt = "" title="http://s2-media.123mua.vn/2014/c/a/cafe1fd1925da88328b25c8876f0b83e.jpg"/>
                                </span>
                            </li>								
                        </ul>
                    </div>-->
                    
                </div>						
            </div>      
                
            <div class="box-des-rg">
                <!--<p class="pre-inf">
                    <span class="numb-view">Lượt xem: <b>332</b></span>
                    <span class="date-update">Cập nhật: cách đây 7 tháng</span>
                </p>-->
                <span class="name-product" itemprop="name">
                    <?php echo $row_1['product_name_'.$lang]; ?>					</span>
                <input type="hidden" value="1751894" id="product_comment">
                
                <div class="des-detail-block">
                    <p class="prod-des">
                        <?php echo $row_1['MoTa_'.$lang]; ?>						</p>
                </div>  
                <div id="addtocart_view" style="display:none"></div>
                <div class="row-inf bd-bt">
                    <label class="lbl">{gia}:</label>
                    <div class="info">
                        <span class="price">
                            <div class="price" itemprop="offers" >
                                <span id="sub_price" itemprop="offers" ><?php if($row_1['price']==0){echo "{lienhe}";}else {echo number_format($row_1['price']);} ?></span>
                                
                            </div>                            
                        </span>
                        
                    </div>					
                </div>
                <div class="box-buyer-inf">
            <!--<span class="ic-shop-xacthuc"></span>-->
                    <a class="shopname" href="cong-ty/<?php echo $row_cty['ten_khong_dau'].'-'.$row_cty['congty_id'].'.html'; ?>" title="<?php echo $row_cty['TenCT_'.$lang]; ?>"><?php echo $row_cty['TenCT_'.$lang]; ?></a>

                    <p class="address-shop"><?php echo $row_cty['DiaChi_'.$lang]; ?></p>
                    
                    <ul class="add-inf">
                        <li class="phone"><?php echo $row_cty['DienThoai']; ?></li>
                        <?php
                            if($row_cty['Email']!=""){
                        ?>
                        <li class="email"><span class="ctn ctnemail"><a href="mailto:<?php echo $row_cty['Email']; ?>" ><?php echo $row_cty['Email']; ?></a></span></li>
                        <?php } ?>
                        <?php
                            if($row_cty['Website']!=""){
                        ?>
                        <li class="shop-link"><span class="ctn ctnwebsite"><a target="_blank" href="<?php echo $row_cty['Website']; ?>"><?php echo $row_cty['Website']; ?></a></span></li>	                
                        <?php } ?>
                        <?php
                            if($row_cty['NguoiLienHe']!=""){
                        ?>
                        <li class="sms"><?php echo $row_cty['NguoiLienHe']; ?></li>
                        <?php }?>
                    </ul>            	
                </div> 
                <div class="lienhe" style="width: 130px;float: left;">
                    <a href="mailto:<?php echo $row_cty['Email']; ?>">
                        <span class="ico-csb"></span>
                        {lienhe}
                    </a>
                </div>
                <?php
                    if($row_cty['DiDong']!=""){
                ?>
                <div style="width: 300px;float: left;">
                    <span class="hotline">{hotline}: <b><span id="hot_line"><?php echo $row_cty['DiDong']; ?></span></b></span>
                </div>
                <?php } ?>
                        
                <!--<div class="row-inf">
                    <label class="lbl">Phạm vi:</label>
                    <div class="info">
                        <span>Toàn quốc</span>
                    </div>
                </div>
                <div class="bt-block">
                    <a href="javascript:void(0)" id="productMul_addcart_payment" class="buy-now bt">Mua ngay</a>
                    <a href="javascript:void(0)" id="productMul_addcart" class="add-to-cart bt">Thêm vào giỏ hàng</a>

                </div>-->

                
            </div>
        </div>
        <div class="cls" style="clear:both;">&nbsp;</div>
        <!--tabs-detail-inf-block-->
        <div class="tabs-detail-inf-block">
            <ul class="tabs-block">
                <li><a href="javascript:void(0)" class="current">{ctsanpham}</a></li>	               
                
            </ul>
            <div class="cont-tabs-inf-detail">
                <div id="tab1" class="detail-info-box item-detail-inf show">

                    <div class="basic-inf-box">	                 
                        <?php echo $row_1['content_'.$lang]; ?>	
                    </div>
                </div>                
                
            </div>
        </div>
        <?php
            $congty_id=$row_1['congty_id'];
            $product_id=$row_1['product_id'];
            $sql="SELECT * From product WHERE congty_id=$congty_id AND product_id <> $product_id ";            
            $dem=  mysql_num_rows($sql);
            $rs = mysql_query($sql) or die(mysql_error());
            if($dem > 0){
        ?>
        <div class="tabs-detail-inf-block">
            <ul class="tabs-block">
                <li><a href="javascript:void(0)" class="current">{xemthemspcungcty}</a></li>	               
                
            </ul>
            <div class="cont-tabs-inf-detail">
                <div class="flexslider-weblk" style="margin-top: 20px;margin-left: 20px; width: 600px;">
                    <ul class="slides">
                        <?php 
                            
                            while ($row_sp=  mysql_fetch_assoc($rs)){
                                
                        ?>
                      <li>
                          <a  href="<?php echo $row_sp['product_alias'].'-'.$row_sp['product_id'].'.html'; ?>" title="<?php echo $row_sp['product_name_'.$lang]; ?>"><img class="hinh-weblt" src="<?php echo $row_sp['url_images']; ?>" /></a>
                      </li> 
                            <?php } ?>
                    </ul>
                  </div>              
                
            </div>
        </div>
            <?php } ?>
        
    </div>

    <!--Block content right -->
    
        <?php include 'blocks/right-content.php'; ?>
    <!-- container-right -->
    <div class="cls">&nbsp;</div>
    <div id="box-slider-bt-detail-interested"></div>
    <div id="box-slider-bt-detail-promotion"></div>
</div>