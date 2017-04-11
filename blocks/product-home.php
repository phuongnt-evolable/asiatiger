
    
<div class="container">
    <!--  -
    <!-- 	 -->

    <div class="container util-clearfix">
    <div class="col-fixed-m-36 col-xs-60 l-fs-main">
      
      <div class="container-left-inside">
         
          
        <div class="home-cate-block women" id="homepage_women" style="width:100%">
          <div class="ttl-cate-block util-clearfix"><a class="ttl" title="" href="thong-tin-mua-ban.html" >{sanpham}</a>
            
          </div>
          <div class="cont-cate">
            
            <div class="small-items-list jsPrdFloor owl-carousel owl-theme" style="opacity: 1; display: block;">
              <div class="owl-wrapper-outer">
                <div class="owl-wrapper" style="width: 880px; left: 0px; display: block;">
                   <?php 
                        $sp=$modelProduct->getProductHome();
                        while ($row_sp=  mysql_fetch_assoc($sp)){
                            $price=$row_sp['price'];
                            $cty_id=$row_sp['congty_id'];
                    ?>
                    <div class="owl-item" style="width: 220px;">
                        <div class="small-item "><span class="img-item"><a <?php if($cty_id==1113){echo "target='_blank'";}?> title="<?php echo $row_sp['product_name_'.$lang]; ?>" href="
                                <?php if($cty_id==1113){
                                    echo "http://jpcvienphu.com/san-pham.html";
                                }else{
                                    echo $row_sp['product_alias'].'-'.$row_sp['product_id'].'.html'; 
                                }?>" ><img class="lazyOwl lazy" src="<?php echo $row_sp['url_images']; ?>" width="100" height="100"  alt=""></a><?php /*<i class="discount-tag">-10%</i>*/?></span>
                            <p class="price"><span class="curr-price"><?php if($price==0){echo "{lienhe}";}else {echo number_format($row_sp['price'].' đ');} ?></span><?php /*<span class="old-price">650.000đ</span>*/?></p>
                            <a href="
                                <?php if($cty_id==1113){
                                    echo "http://jpcvienphu.com/san-pham.html";
                                }else{
                                    echo $row_sp['product_alias'].'-'.$row_sp['product_id'].'.html'; 
                                }?>
                               "><span class="prd-name"><?php echo $row_sp['product_name_'.$lang]; ?></span></a>
                        </div>
                  </div>
                  <?php } ?>                    
                </div>
              </div>
              
            </div>
                
            
          </div>
        </div>
          
        
        <div class="home-cate-block-left cosmetic" id="homepage_cosmetic">
          <div class="ttl-cate-block util-clearfix"><a class="ttl" title="#" href="loaitin/tin-trien-lam-2.html">{tttrienlam}</a>
            
          </div>
          <div class="cont-cate">
            
            <div class="small-items-list jsPrdFloor owl-carousel owl-theme" style="opacity: 1; display: block;">
                <div style="width:95%; margin: 10px;" class="owl-wrapper-outer" >
                <div id="newsticker-container" style="  "> 
                    <ul id="newsticker1" >
                        <?php 
                            $tin=$modelArticle->getListArticleByLoai(2,-1,-1);
                            //$row=  mysql_fetch_assoc($tin);
                            foreach ($tin as $key => $row_tin) {
                        ?>
                        <li><a style="font-size: 14px;" title="<?php echo $row_tin['title_'.$lang]; ?>" href="tintuc/<?php echo $row_tin['title_alias'].'-'.$row_tin['article_id'].'.html'; ?>" >- <?php echo $row_tin['title_'.$lang]; ?></a> </li>                       
                            <?php  } ?>
                    </ul>
                </div>
                <a style="margin-top: 20px" class="view-all" rel="nofollow" href="loaitin/tin-trien-lam-2.html" title=""><span>{xemtatca}</span></a>
              </div>
              
            </div>
          </div>
        </div>
          <div class="home-cate-block-left cosmetic" id="homepage_cosmetic" style="margin-left: 30px;">
          <div class="ttl-cate-block util-clearfix"><a class="ttl" title="#" href="loaitin/tin-trien-lam-3.html">{ttcongnghiep}</a>
            
          </div>
          <div class="cont-cate">
            
            <div class="small-items-list jsPrdFloor owl-carousel owl-theme" style="opacity: 1; display: block;">
                <div style="width:95%; margin: 10px;" class="owl-wrapper-outer" >
                <div id="newsticker-container" style="text-align: left;"> 
                    <ul id="newsticker3" >
                        <?php 
                            $tin=$modelArticle->getListArticleByLoai(3,-1,-1);
                            //$row=  mysql_fetch_assoc($tin);
                            foreach ($tin as $key => $row_tin) {
                        ?>
                        <li style="margin-bottom: 10px;"><a style="font-size: 14px;" title="<?php echo $row_tin['title_'.$lang]; ?>" href="tintuc/<?php echo $row_tin['title_alias'].'-'.$row_tin['article_id'].'.html'; ?>" >- <?php echo $row_tin['title_'.$lang]; ?></a> </li>                       
                            <?php  } ?>
                    </ul>
                </div>
                <a style="margin-top: 20px" class="view-all" rel="nofollow" href="loaitin/tin-trien-lam-3.html" title=""><span>{xemtatca}</span></a>
              </div>
              
            </div>
          </div>
        </div>
          <div class="home-cate-block-right men" id="homepage_men">
          <div class="ttl-cate-block util-clearfix"><a class="ttl" title="Website Links" href="web-lien-ket.html" >{weblk}</a>
            
          </div>
          <div class="cont-cate">
            
            <div class="small-items-list jsPrdFloor owl-carousel owl-theme" style="opacity: 1; display: block;height: 160;">
              <div class="owl-wrapper-outer">
                  <div class="flexslider-weblk" style="margin-top: 20px;margin-left: 20px;">
                    <ul class="slides">
                       <?php 
                            $category_id=2;
                            $lienket=$modelHome->getImageByCate($category_id,-1,-1);
                            foreach ($lienket as $val => $row_lk){
                       ?> 
                      <li>
                          <a target="_blank" href="<?php echo $row_lk['Href']; ?>" title="<?php echo $row_lk['TenCT']; ?>"><img class="hinh-weblt" src="<?php echo $row_lk['Url']; ?>" /></a>
                      </li>
                      <?php } ?>
                      <!-- items mirrored twice, total of 12 -->
                    </ul>
                  </div>
              </div>
              
            </div>
          </div>
        </div>
         
           <!-- Module sản phẫm -->
           <!--  <div class="home-cate-block mombaby slider1_container1" id="homepage_mombaby">
                     <div class="ttl-cate-block util-clearfix"><a class="ttl" title="Mẹ và bé" href="u735/me-va-be.html" tracking_category="homepage" tracking="homepage_cat_block_mevabe">{vietnam}</a>
           <ul class="nav-cate slides">
             <li><a href="u737/thoi-trang-bau.html" class="_trackLink" tracking_category="homepage" tracking="homepage_block_mevabe">Thời trang bầu</a></li>
             <li><a href="u736/thoi-trang-tre-em.html" class="_trackLink" tracking_category="homepage" tracking="homepage_block_mevabe">Thời trang trẻ em</a></li>
             <li><a href="u738/do-dung-tre-em.html" class="_trackLink" tracking_category="homepage" tracking="homepage_block_mevabe">Đồ dùng trẻ em</a></li>
             <li><a href="u739/do-dung-cho-me.html" class="_trackLink" tracking_category="homepage" tracking="homepage_block_mevabe">Đồ dùng cho mẹ</a></li>
             <li class="view-more"><a title="Xem tất cả" href="u735/me-va-be.html" class="_trackLink" tracking_category="homepage" tracking="homepage_block_mevabe">Xem tất cả</a></li>
           </ul>
                     </div>
                     <div class="cont-cate">
           <div class="large-item"><a href="u754/do-choi-cho-tre.html?product_id=584229" title="Robot năng lượng mặt trời 3 trong 1" class="_trackLink" tracking_category="homepage" tracking="homepage_block_mevabe_banner"><img class="lazyImg" src="img/no-img.gif" width="200" height="262" alt=""></a></div>
           <div class="small-items-list jsPrdFloor owl-carousel owl-theme" style="opacity: 1; display: block;">
             <div class="owl-wrapper-outer">
               <div class="owl-wrapper" style="width: 5280px; left: 0px; display: block;">
                 <div class="owl-item" style="width: 220px;">
                   <div class="small-item "><a title="Bộ khăn nón len ngôi sao" href="2068566/2252979/bo-khan-non-len-ngoi-sao.html?page=c-0&box=bp-735" class="_trackLink" tracking_category="homepage" tracking="homepage_block_mevabe_sub"><span class="img-item"><img class="lazyOwl" src="img/no-img.gif" width="200" height="200" alt=""></span>
                     <p class="price"> <span class="curr-price">129.000đ</span></p>
                     <span class="prd-name">Bộ khăn nón len ngôi sao</span></a></div>
                 </div>
                 <div class="owl-item" style="width: 220px;">
                   <div class="small-item "><a title="Tổng hợp Bộ Nón Bé Sơ Sinh từ 3tháng tới 3 tuổi" href="2068566/2253839/tong-hop-bo-non-be-so-sinh-tu-3thang-toi-3-tuoi.html?page=c-0&box=bp-735" class="_trackLink" tracking_category="homepage" tracking="homepage_block_mevabe_sub"><span class="img-item"><img class="lazyOwl" src="img/no-img.gif" width="200" height="200" alt=""></span>
                     <p class="price"> <span class="curr-price">45.000đ</span></p>
                     <span class="prd-name">Tổng hợp Bộ Nón Bé Sơ Sinh từ 3tháng tới 3 tuổi</span></a></div>
                 </div>
                 <div class="owl-item" style="width: 220px;">
                   <div class="small-item "><a title="SET 3 món áo ghi lê và quần áo dài tay cực xinh cho bé" href="2000686/2249664/set-3-mon-ao-ghi-le-va-quan-ao-dai-tay-cuc-xinh-cho-be.html?page=c-0&box=bp-735" class="_trackLink" tracking_category="homepage" tracking="homepage_block_mevabe_sub"><span class="img-item"><img class="lazyOwl" src="img/no-img.gif" width="200" height="200" alt=""></span>
                     <p class="price"> <span class="curr-price">175.000đ</span></p>
                     <span class="prd-name">SET 3 món áo ghi lê và quần áo dài tay cực xinh cho bé</span></a></div>
                 </div>
                 <div class="owl-item" style="width: 220px;">
                   <div class="small-item "><a title="Bộ nón len Panda dễ thương" href="2068566/2253319/bo-non-len-panda-de-thuong.html?page=c-0&box=bp-735" class="_trackLink" tracking_category="homepage" tracking="homepage_block_mevabe_sub"><span class="img-item"><img class="lazyOwl" src="img/no-img.gif" width="200" height="200" alt=""></span>
                     <p class="price"> <span class="curr-price">69.000đ</span></p>
                     <span class="prd-name">Bộ nón len Panda dễ thương</span></a></div>
                 </div>
                 
               </div>
             </div>
             
           </div>
                     </div>
                   </div>
                   <div class="home-cate-block men" id="homepage_men">
                     <div class="ttl-cate-block util-clearfix"><a class="ttl" title="Thời trang &amp; phụ kiện nam" href="p/thoi-trang-nam.html" tracking_category="homepage" tracking="homepage_cat_block_thoitrangphukiennam">{hongkong}</a>
           
                     </div>
                     <div class="cont-cate">
           <div class="large-item"><a href="http://shopsanna.com/" title="Áo thun 4 chiều" class="_trackLink" tracking_category="homepage" tracking="homepage_block_thoitrangphukiennam_banner"><img class="lazyImg" src="img/sp/ac84728829887c2b8ad255df912a16f7.jpg" width="200" height="262" alt=""></a></div>
           <div class="small-items-list jsPrdFloor owl-carousel owl-theme" style="opacity: 1; display: block;">
             <div class="owl-wrapper-outer">
               <div class="owl-wrapper" style="width: 5280px; left: 0px; display: block;">
                 <div class="owl-item" style="width: 220px;">
                   <div class="small-item "><a title="Áo tay raglan tay dài Trắng tay Tím" href="2078533/2255790/ao-tay-raglan-tay-dai-trang-tay-tim.html?page=c-0&box=bp-970" class="_trackLink" tracking_category="homepage" tracking="homepage_block_thoitrangphukiennam_sub"><span class="img-item"><img class="lazyOwl" src="img/no-img.gif" width="200" height="200" alt=""></span>
                     <p class="price"> <span class="curr-price">100.000đ</span></p>
                     <span class="prd-name">Áo tay raglan tay dài Trắng tay Tím</span></a></div>
                 </div>
                 <div class="owl-item" style="width: 220px;">
                   <div class="small-item "><a title="Áo khoác da Lamborghini KRAKDL01" href="1389813/1529475/ao-khoac-da-lamborghini-krakdl01.html?page=c-0&box=bp-970" class="_trackLink" tracking_category="homepage" tracking="homepage_block_thoitrangphukiennam_sub"><span class="img-item"><img class="lazyOwl" src="img/no-img.gif" width="200" height="200" alt=""></span>
                     <p class="price"> <span class="curr-price">400.000đ</span></p>
                     <span class="prd-name">Áo khoác da Lamborghini KRAKDL01</span></a></div>
                 </div>
                 <div class="owl-item" style="width: 220px;">
                   <div class="small-item "><a title="Đồng hồ Casio Edifice EFR-539D-1AVDF" href="1860183/2243205/dong-ho-casio-edifice-efr-539d-1avdf.html?page=c-0&box=bp-970" class="_trackLink" tracking_category="homepage" tracking="homepage_block_thoitrangphukiennam_sub"><span class="img-item"><img class="lazyOwl" src="img/no-img.gif" width="200" height="200" alt=""><i class="discount-tag">-47%</i></span>
                     <p class="price"><span class="curr-price">1.600.000đ</span><span class="old-price">3.000.000đ</span></p>
                     <span class="prd-name">Đồng hồ Casio Edifice EFR-539D-1AVDF</span></a></div>
                 </div>
                 <div class="owl-item" style="width: 220px;">
                   <div class="small-item "><a title="[CHUYÊN SỈ-] ÁO THUN NAM POLO,NIKE,GUCCI,BURBERRY,..." href="1814029/2111213/ao-thun-nam-burberry.html?page=c-0&box=bp-970" class="_trackLink" tracking_category="homepage" tracking="homepage_block_thoitrangphukiennam_sub"><span class="img-item"><img class="lazyOwl" src="img/no-img.gif" width="200" height="200" alt=""></span>
                     <p class="price"> <span class="curr-price">75.000đ</span></p>
                     <span class="prd-name">[CHUYÊN SỈ-] ÁO THUN NAM POLO,NIKE,GUCCI,BURBERRY,...</span></a></div>
                 </div>
                 
               </div>
             </div>
             
           </div>
                     </div>
                   </div> -->
        
      </div>
    </div>
    <?php include 'blocks/right-home.php'; ?>
    <div class="cls">&nbsp;</div>
   
  </div>
  


    <!--  -->

    <!--  -->
    <!-- 	 -->



   <!--  <div class=" m-ts" data-spm="1997230269">
        <div class="title">{dichvuthuongmai}</div>
        <div class="list">
            <div class="col-xs-30 col-m-15 item prime">
                <a rel="nofollow" href="#">
                    <div class="sub-title">The Service You Deserve</div>
                    <div class="description">
                        Personalized Services
                        <br>
                        Exclusive networking opportunities
                        <br>
                        Tailored sourcing events
                    </div>
                </a>
            </div>
            <div class="col-xs-30 col-m-15 item escrow">
                <a rel="nofollow" href="escrow/buyer.html?tracelog=edu_newschp_es">
                    <div class="sub-title">Protect Your Payment</div>
                    <div class="description">
                        Safe payments
                        <br>
                        Quick and easy transactions
                        <br>
                        Low service charges
                    </div>
                </a>
            </div>
            <div class="col-xs-30 col-m-15 item e-credit">
                <a rel="nofollow" href="#">
                    <div class="sub-title">Boost Your Purchasing Power</div>
                    <div class="description">
                        Up to $2,000,000 credit limit
                        <br>
                        High quality suppliers
                        <br>
                        Pay up to 120 days later
                    </div>
                </a>
            </div>
            <div class="col-xs-30 col-m-15 item inspection">
                <a rel="nofollow" href="#">
                    <div class="sub-title">Have Your Order Inspected</div>
                    <div class="description">
                        Independent inspectors
                        <br>
                        Proven cost efficiency
                        <br>
                        Simple, transparent process
                    </div>
                </a>
            </div>
        </div>
    </div>-->


     

</div>