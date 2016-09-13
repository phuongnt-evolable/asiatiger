<?php
session_start();

$lang_arr = array("vi", "cn", "en");
if (isset($_GET['lang']) == true) {
    if (in_array($_GET['lang'], $lang_arr) == true)
        $lang = $_GET['lang'];
}
elseif (isset($_SESSION['lang']) == true) {
    if (in_array($_SESSION['lang'], $lang_arr) == true)
        $lang = $_SESSION['lang'];
} else
    $lang = 'cn';
$_SESSION['lang'] = $lang;
setcookie('lang', $lang, time() + 60 * 60 * 24 * 30);
ob_start();
//echo $lang; die;
require_once "lang/lang_$lang.php";
require_once "admin/Model/Product.php";
require_once "admin/Model/Cate.php";
require_once "admin/Model/Article.php";
require_once "admin/Model/Block.php";
require_once "admin/Model/Home.php";
require_once "admin/Model/Congty.php";
$modelProduct = new Product;
$modelCate = new Cate;
$modelArticle = new Article;
$modelBlock = new Block;
$modelHome = new Home;
$modelCongTy = new Congty;
require_once("blocks/seo.php");
//echo $_SERVER['SERVER_NAME'];
?>
<html>
    <head>
        <base href="http://asiatiger.org/" />
        <title>Sách Niên Giám 2014</title>
        <!-- Meta -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="keywords" content="flip book, book, page, flip, effect, jquery, html5, magazine, pageflip, flipbook, pagefliper, newspaper, ipad, iphone, android, ios, mpc, massivePixelCreation">
        <meta name="description" content="HTML Flip Book is a jQuery powered magazine components which lets you easily create: books, magazines and newspapers.">

        <!-- Stylesheet -->
        <link href="static/saved_resource.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="static/saved_resource(1).css"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/page-styles.css">


        <style type="text/css">

            #flipbook-1 {
                margin-top: 20px;
                margin-bottom: 0px;
                margin-left: 0px;
                margin-right: 0px;

                width: 712px; 
                height: 510px; 
            }

            #flipbook-1 div.fb-page div.page-content {
                margin: 10px 0px; 
            }

            #flipbook-1 .turn-page {
                width: 356px;		
                height: 510px;
                background: #ECECEC;
                border-top-right-radius: 10px;
                border-bottom-right-radius: 10px;
                box-shadow: inset -1px 0px 1px 0px #BFBFBF; 

            }

            #flipbook-1 .last .turn-page,
            #flipbook-1 .even .turn-page {
                border-radius: 0px;
                border-top-left-radius: 10px;
                border-bottom-left-radius: 10px;	
                box-shadow: inset 1px 0px 1px 0px #BFBFBF;
            }

            #flipbook-1 .fpage .turn-page {
                border-radius: 0px;
                border-top-left-radius: 10px;
                border-bottom-left-radius: 10px;
                box-shadow: inset 1px 0px 1px 0px  #BFBFBF;
            }

            #flipbook-1 .last .fpage .turn-page,
            #flipbook-1 .even .fpage .turn-page {
                border-radius: 0px;
                border-top-right-radius: 10px;
                border-bottom-right-radius: 10px;
                box-shadow: inset -1px 0px 1px 0px #BFBFBF;
            }

            #flipbook-container-1 div.page-content div.container img.bg-img {
                margin-top: 0px;
                margin-left: 0px;
            }

            #flipbook-container-1 div.page-content.first div.container img.bg-img {
                margin-top: 10px;
            }

            #flipbook-container-1 div.page-content.even div.container img.bg-img {
                left: 0px;
            }

            #flipbook-container-1 div.page-content.last div.container img.bg-img {
                left: 10px;
                margin-top: 10px;
            }

            #flipbook-1 div.page-transition.last div.page-content,
            #flipbook-1 div.page-transition.even div.page-content,
            #flipbook-1 div.turn-page-wrapper.odd div.page-content {
                margin-left: 0px;
                margin-right: 10px; 
            }

            #flipbook-1 div.turn-page-wrapper.first div.page-content {
                margin-right: 10px;
                margin-left: 0px; 
            }

            #flipbook-1 div.page-transition.first div.page-content,
            #flipbook-1 div.page-transition.odd div.page-content,
            #flipbook-1 div.turn-page-wrapper.even div.page-content,
            #flipbook-1 div.turn-page-wrapper.last div.page-content {
                margin-left: 10px;
            }

            #flipbook-1 div.fb-page-edge-shadow-left,
            #flipbook-1 div.fb-page-edge-shadow-right,
            #flipbook-1 div.fb-inside-shadow-left,
            #flipbook-1 div.fb-inside-shadow-right {
                top: 10px;
                height: 490px;
            }

            #flipbook-1 div.fb-page-edge-shadow-left {
                left: 10px;
            }

            #flipbook-1 div.fb-page-edge-shadow-right {
                right: 10px;
            }

            /* Zoom */

            #flipbook-container-1 div.zoomed-shadow {
                opacity: 0.2;
            }

            #flipbook-container-1 div.zoomed {
                border: 10px solid #ECECEC;
                border-radius: 10px;
                box-shadow: 0px 0px 0px 1px #D0D0D0;	

            }	

            /* Show All Pages */
            #flipbook-container-1 div.show-all div.show-all-thumb {
                margin-bottom: 12px;
                height: 180px;
                width: 125px;
                border: 1px solid #878787;
            }

            #flipbook-container-1 div.show-all div.show-all-thumb.odd {
                margin-right: 10px;
                border-left: none;
            }

            #flipbook-container-1 div.show-all div.show-all-thumb.odd img.bg-img {
                padding-left: 250px;
            }

            #flipbook-container-1 div.show-all div.show-all-thumb.odd.first img.bg-img {
                padding-left: 0px;
            }

            #flipbook-container-1 div.show-all div.show-all-thumb.even {
                border-right: none;
            }

            #flipbook-container-1 div.show-all div.show-all-thumb.last-thumb {
                margin-right: 0px;
            }

            #flipbook-container-1 div.show-all {
                background: #F6F6F6;
                border-radius: 10px;
                border: 1px solid #D6D6D6;
            }

            #flipbook-container-1 div.show-all div.content {
                top: 10px;
                left: 10px;
            }


            /* Inner Pages Shadows */

            #flipbook-1 div.fb-page-edge-shadow-left,
            #flipbook-1 div.fb-page-edge-shadow-right {
                display: none;
            }

        </style>

        <!-- Scripts -->
        <script type="text/javascript" src="js/swfobject2.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="js/turn.js"></script>
        <script type="text/javascript" src="js/flipbook.js"></script>
        <script type="text/javascript" src="js/jquery.doubletap.js"></script>



    </head>
    <body>
        
        <script type="text/javascript" src="static/beacon_en.js"></script>
            <script type="text/javascript">var dmtrack_c='{ali_resin_trace=nuser=Y}'; var dmtrack_pageid='734d46017f0000011414460248'; sk_dmtracking();</script> 
            
				
				<script>
			seajs.use('http://style.aliunicorn.com/js/6v/lib/icbu/gdata/??gdata.js?t=66132cea_d3949ad8', function(gdata){
				gdata.define('sc-header-config', {
					'mod' : {
						'sundry' : [],
						'searchbar' : null
					}
				});
			});
		</script>
        
<?php include 'blocks/header.php'; ?>


        <div id="J-main-container">

            <div class="row l-main">
                <div id="flipbook-container-1" class="flipbook-container">

                    <!-- Flip book -->
                    <div id="flipbook-1" class="flipbook">
                        <!-- Start Flip Book Pages -->

                        <!-- Cover -->
                        <div class="fb-page">
                            <div class="page-content">
                                <div class="container">
                                    <img src="img/pages/1.jpg" class="bg-img" />
                                    <img src="img/pages/1-large.jpg" class="bg-img zoom-large"/>
                                </div>
                            </div>
                        </div>
                        <!-- Pages 6 & 7 Device Support -->
                        
                        <?php
                            for ($i = 2; $i <= 106; $i++){
                                //echo $i . ' - ';
                           ?>
                            <div class="fb-page double">
                                <div class="page-content">
                                    <div class="container">
                                        <div style="padding-top: 5%;" class="preview-content toc left">
                                            <img src="img/pages/<?php echo $i; ?>.jpg" class="bg-img"/>
                                            <img src="img/pages/<?php echo $i; ?>-large.jpg" class="bg-img zoom-large"/>
                                        </div>
                                        <div style="padding-top: 5%;" class="preview-content toc left">
                                            <img src="img/pages/<?php echo $i+1; ?>.jpg" class="bg-img"/>
                                            <img src="img/pages/<?php echo $i+1; ?>-large.jpg" class="bg-img zoom-large"/>
                                        </div>
                        <?php    
                             if($i=$i+2) echo'    
                                            </div>
                                        </div>
                                    </div>';  

                            } 
                         ?> 
                                
                       
                        <!-- Back Cover -->
                        <div class="fb-page">
                            <div class="page-content">
                                <div class="container">
                                    <img src="img/pages/hang-loi-trang-bia-cuoi.jpg" class="bg-img"/>
                                    <img src="img/pages/hang-loi-trang-bia-cuoi-large.jpg" class="bg-img zoom-large"/>
                                </div>
                            </div>
                        </div>

                        <!-- end Flip Book Pages -->

                    </div> <!-- end Flip Book -->

                    <!-- Flip Book Navigation -->
                    <div style="width: 300px;position: absolute;margin-top: 25px;left: 430px;">
                        <div style="float: left;margin-right: 20px;"><a href="sach-nien-giam.php#1">{biadau}</a></div>
                        
                    </div>
                    <div id="fb-nav-1" class="fb-nav mobile stacked">                         
                        <ul>
                            <li class="toc left">Table Of Content</li>
                            <li class="zoom center">Zoom</li>
                            <li class="slideshow center">Slide Show</li>
                            <li class="show-all right">Show All Pages</li>
                        </ul>
                    </div> <!-- end FLip Book Nav -->
                    <div style="width: 200px;position: absolute;left: 890px;top: 535px;">                        
                        <div style="float: left;"> <a href="sach-nien-giam.php#72">{biacuoi}</a></div>
                    </div>
                </div> <!-- end Flip Book Container -->
            </div>
        </div>




        <div class="skin-default" data-name="mm-sc-new-footer" data-skin="default" data-guid="1409634827621" id="guid-1409634827621" data-version="41" data-type="3"><div class="module" data-spm="a271py"><div class="mm-sc-new-footer">

<?php include 'blocks/footer.php'; ?>


                </div>


            </div></div>

        <?php
        $str = ob_get_clean();
        $str = str_replace("{gioithieu}", gioithieu, $str);
        $str = str_replace("{about}", about, $str);
        $str = str_replace("{faqs}", faqs, $str);

        $str = str_replace("{gioithieuvinhsang}", gioithieuvinhsang, $str);
        $str = str_replace("{baoveriengtu}", baoveriengtu, $str);
        $str = str_replace("{bandowebsite}", bandowebsite, $str);

        $str = str_replace("{trangchu}", trangchu, $str);
        $str = str_replace("{lienhe}", lienhe, $str);
        $str = str_replace("{danhmucsp}", danhmucsp, $str);
        $str = str_replace("{sanpham}", sanpham, $str);
        $str = str_replace("{ctsanpham}", ctsanpham, $str);
        $str = str_replace("{dathang}", dathang, $str);
        $str = str_replace("{httt}", httt, $str);
        $str = str_replace("{doitac}", doitac, $str);
        $str = str_replace("{menu}", menu, $str);
        $str = str_replace("{chinhanh}", chinhanh, $str);
        $str = str_replace("{duandalam}", duandalam, $str);

        $str = str_replace("{tintucmuaban}", tintucmuaban, $str);
        $str = str_replace("{dkquangcao}", dkquangcao, $str);
        $str = str_replace("{tttrienlam}", tttrienlam, $str);
        $str = str_replace("{weblk}", weblk, $str);
        $str = str_replace("{bangquangcao}", bangquangcao, $str);

        $str = str_replace("{thongbao}", thongbao, $str);

        $str = str_replace("{danhmucnghanhnghe}", danhmucnghanhnghe, $str);
        $str = str_replace("{danhchonguoimua}", danhchonguoimua, $str);
        $str = str_replace("{danhchonguoiban}", danhchonguoiban, $str);
        $str = str_replace("{giupdo}", giupdo, $str);
        $str = str_replace("{trangvang}", trangvang, $str);
        $str = str_replace("{ngonngu}", ngonngu, $str);
        $str = str_replace("{vietnam}", vietnam, $str);
        $str = str_replace("{dailoan}", dailoan, $str);
        $str = str_replace("{trungquoc}", trungquoc, $str);
        $str = str_replace("{hongkong}", hongkong, $str);
        $str = str_replace("{dangnhap}", dangnhap, $str);
        $str = str_replace("{dangky}", dangky, $str);
        $str = str_replace("{trangmau}", trangmau, $str);
        $str = str_replace("{theosp}", theosp, $str);
        $str = str_replace("{theonhacungcap}", theonhacungcap, $str);
        $str = str_replace("{chamsockh}", chamsockh, $str);
        $str = str_replace("{hoatdongmoinhat}", hoatdongmoinhat, $str);
        $str = str_replace("{tinmoinhat}", tinmoinhat, $str);
        $str = str_replace("{dichvuthuongmai}", dichvuthuongmai, $str);
        $str = str_replace("{qcniengiam}", qcniengiam, $str);
        $str = str_replace("{bandovn}", bandovn, $str);

        $str = str_replace("{thongke}", thongke, $str);
        $str = str_replace("{hoatdongcty}", hoatdongcty, $str);
        $str = str_replace("{hinhanhsx}", hinhanhsx, $str);
        $str = str_replace("{sanphammoi}", sanphammoi, $str);
        $str = str_replace("{spcungloai}", spcungloai, $str);
        $str = str_replace("{dichvu}", dichvu, $str);
        $str = str_replace("{kinhdoanh}", kinhdoanh, $str);

        $str = str_replace("{dau}", dau, $str);
        $str = str_replace("{cuoi}", cuoi, $str);
        $str = str_replace("{hotline}", hotline, $str);
        $str = str_replace("{ttnguoiban}", ttnguoiban, $str);
        $str = str_replace("{xemthemspcungcty}", xemthemspcungcty, $str);

        $str = str_replace("{tintuc}", tintuc, $str);
        $str = str_replace("{tuyendung}", tuyendung, $str);
        $str = str_replace("{diachi}", diachi, $str);
        $str = str_replace("{footer}", footer, $str);

        $str = str_replace("{gioithieucty}", gioithieucty, $str);


        $str = str_replace("{chitiet}", chitiet, $str);
        $str = str_replace("{tintuctonghop}", tintuctonghop, $str);
        $str = str_replace("{tinchuyennganh}", tinchuyennganh, $str);

        $str = str_replace("{coppyright}", coppyright, $str);

        $str = str_replace("{thuvienanh}", thuvienanh, $str);
        $str = str_replace("{sanphamchinh}", sanphamchinh, $str);
        $str = str_replace("{tinlienquan}", tinlienquan, $str);
        $str = str_replace("{trove}", trove, $str);
        $str = str_replace("{them}", them, $str);
        $str = str_replace("{search}", search, $str);
        $str = str_replace("{timgi}", timgi, $str);

        $str = str_replace("{xembando}", xembando, $str);
        $str = str_replace("{tencty}", tencty, $str);
        $str = str_replace("{diachilienhe}", diachilienhe, $str);
        $str = str_replace("{email}", email, $str);
        $str = str_replace("{noidung}", noidung, $str);
        $str = str_replace("{tieude}", tieude, $str);
        $str = str_replace("{dienthoai}", dienthoai, $str);
        $str = str_replace("{gui}", gui, $str);
        $str = str_replace("{hoten}", hoten, $str);
        $str = str_replace("{gia}", gia, $str);
        $str = str_replace("{xoa}", xoa, $str);
        $str = str_replace("{thaydoi}", thaydoi, $str);

        $str = str_replace("{fax}", fax, $str);
        $str = str_replace("{nguoilienhe}", nguoilienhe, $str);
        $str = str_replace("{tttk}", tttk, $str);
        $str = str_replace("{ttct}", ttct, $str);
        $str = str_replace("{spchinh}", spchinh, $str);
        $str = str_replace("{tendn}", tendn, $str);
        $str = str_replace("{pass}", pass, $str);
        $str = str_replace("{quenpass}", quenpass, $str);
        $str = str_replace("{rememberme}", rememberme, $str);
        $str = str_replace("{hoac}", hoac, $str);
        $str = str_replace("{batbuocnhap}", batbuocnhap, $str);
        $str = str_replace("{hangmuckd}", hangmuckd, $str);
        $str = str_replace("{website}", website, $str);
        $str = str_replace("{nhaplai}", nhaplai, $str);

        $str = str_replace("{giohang}", giohang, $str);
        $str = str_replace("{hinh}", hinh, $str);

        $str = str_replace("{ttkhachhang}", ttkhachhang, $str);
        $str = str_replace("{tensp}", tensp, $str);
        $str = str_replace("{soluong}", soluong, $str);
        $str = str_replace("{tong}", tong, $str);
        $str = str_replace("{thanhtien}", thanhtien, $str);
        $str = str_replace("{tieptucmua}", tieptucmua, $str);
        $str = str_replace("{thanhtoan}", thanhtoan, $str);
        $str = str_replace("{xacnhantt}", xacnhantt, $str);
        $str = str_replace("{hoantat}", hoantat, $str);
        $str = str_replace("{vetrangchu}", vetrangchu, $str);
        
        $str = str_replace("{biadau}", biadau, $str);
        $str = str_replace("{biacuoi}", biacuoi, $str);

        //echo $lang;
        echo $str;
        ?>

        <?php include 'blocks/back-to-top.php'; ?>
        <!-- end mpc-styles-switcher --></body>
</html>
