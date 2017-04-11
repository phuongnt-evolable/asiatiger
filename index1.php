<?php
    session_start();
    
    
    $lang_arr=array("vi","cn","en");
    if (isset($_GET['lang']) == true){
      if (in_array($_GET['lang'], $lang_arr)==true) $lang = $_GET['lang'];
    }
    elseif (isset($_SESSION['lang']) == true){ 
     if (in_array($_SESSION['lang'],$lang_arr) == true) $lang = $_SESSION['lang'];
    }else $lang= 'cn';
    $_SESSION['lang'] = $lang;
    setcookie('lang' , $lang , time()+60*60*24*30);
     ob_start();
      // echo $lang; die;
        require_once "lang/lang_$lang.php";       
      require_once "admin/Model/Product.php";
      require_once("admin/Model/QuocGia.php");
      require_once "admin/Model/Cate.php";
      require_once "admin/Model/Article.php";
      require_once "admin/Model/Block.php";
      require_once "admin/Model/Home.php";
      require_once "admin/Model/Congty.php";
    $modelProduct = new Product;
    $modelQuocgia = new Quocgia;
    $modelCate = new Cate;
    $modelArticle = new Article;
    $modelBlock = new Block;
    $modelHome = new Home;
    $modelCongTy = new Congty;
    require_once("blocks/seo.php");
    //echo $_SERVER['SERVER_NAME'];
    
    
?>
<html class="rwd rwd-l"><head>
      
            
           <!-- <script type="text/javascript">
            window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
            d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
            _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
            $.src='//v2.zopim.com/?2aNiQ7peKpGvZpAdmdI8x9Vb3NKVGMv8';z.t=+new Date;$.
            type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
            </script>
            <!--End of Zopim Live Chat Script-->
        
        
        <base href="http://asiatiger.org/" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
					 
<title><?php echo $title; ?></title>
<meta name="keywords" content="Manufacturers, Suppliers, Exporters, Importers, Products, Trade Leads, Supplier, Manufacturer, Exporter, Importer">

				
		<link rel="shortcut icon" href="img/favicon (1).ico" type="image/x-icon">

		
		

                
	<link href="static/saved_resource.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/tim-kiem.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/layout.2.0.1.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/mystyle.css" type="text/css" rel="stylesheet"/>

        <script type="text/javascript" src="static/saved_resource(1).css"></script>

        <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script defer src="js/jquery.flexslider.js"></script>
        <script defer src="js/new.js"></script>
        
        <script defer src="js/slide-quang-cao/jquery.newsTicker.js"></script>
        
        
        <script type="text/javascript" src="cong-ty/js/gotop.js"></script>
        
        <script language="JavaScript" src="js/gen_validatorv31.js" type="text/javascript"></script>	

        <script type="text/javascript" src="js/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css" media="screen" />
        
        
        
        <link rel="stylesheet" href="css/support.css" type="text/css" media="all" />         
        <script type="text/javascript" src="js/footer_slide.js"></script> 
       
         <script src="js/sweet-alert.min.js"></script>
        <link rel="stylesheet" href="css/sweet-alert.css">
        
        <?php include 'blocks/ajax-file.php'; ?>
        
</head>
	<body data-spm="7224109" class="sw-layout-w1180">
            
            <script type="text/javascript" src="static/beacon_en.js"></script>
            <script type="text/javascript">var dmtrack_c='{ali_resin_trace=nuser=Y}'; var dmtrack_pageid='734d46017f0000011414460248'; sk_dmtracking();</script> 
            <script>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                ga('create', 'UA-60143366-1', 'auto');
                ga('send', 'pageview');

              </script>
				
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
			<div class="row l-fs">
				<?php if($com ==''){
                                    include 'blocks/menu-slide.php'; 
                                }
                                 ?>
			</div>
			<div class="row l-main">
                                <?php //echo $com;die;
                                   // echo $com;
                                    //echo $_SESSION['url'];
                                    switch($com){                
                                            case "cat" : include "page/danh-sach-cong-ty.php";break;
                                            case "theloai" : include "page/danh-sach-cong-ty_theloai.php";break;
                                            case "loai" : include "page/loai-sp.php";break;
                                            case "danhmuc" : include "page/danh-muc-nghanh-nghe.php";break;
                                            case "ctsp" : include "page/ctsp.php";break;
                                            case "contact" : include "page/lien-he.php";break; 
                                            case "tim-kiem" : include "page/tim-kiem.php";break;
                                            case "all-cate" : include "page/all-cate.php";break;
                                            case "product" : include "page/danh-muc-sp.php";break;
                                            case "dich-vu" : include "page/dich-vu.php";break; 
                                            case "sach-nien-giam" : include "page/sach-nien-giam.php";break; 
                                            case "dang-ky" : include "page/dang-ky.php";break;
                                            case "dang-ky-b2" : include "page/dang-ky-buoc-2.php";break;
                                            case "dang-nhap" : include "page/dang-nhap.php";break;
                                            case "quen-mk" : include "page/quen-mat-khau.php";break;
                                            case "dkqc" : include "page/dang-ky-quang-cao.php";break; 
                                            case "ttmb" : include "page/thong-tin-mua-ban.php";break;
                                            case "du-an" : include "page/danh-sach-cong-ty.php";break; 
                                            case "dmduan" : include "page/du-an.php";break;
                                            case "ctduan" : include "page/chi-tiet-du-an.php";break; 
                                            case "news" : include "page/tin-tuc.php";break;
                                            case "cate_news" : include "page/tin-tuc.php";break;
                                            case "detail_news" : include "page/chi-tiet-tin.php";break;
                                            case "about-us" : include "page/gioi-thieu.php";break;
                                            case "tuyen-dung" : include "page/tuyen-dung.php";break;
                                            case "bvtk" : include "page/bao-ve-tai-khoan.php";break;  
                                            case "cart" : include "page/gio-hang.php";break; 
                                            case "oder" : include "page/dat-hang.php";break; 
                                            case "checkout" : include "blocks/check-out.php";break; 
                                            case "thanhcong" : include "page/thanh-cong.php";break;
                                            case "weblk" : include "page/web-lien-ket.php";break;
                                            case "trangmau" : include "page/trang-mau.php";break;
                                            default : include "blocks/product-home.php";break;
                                            //default : 
                                                //if(isset($_SESSION["url"])){
                                                    
                                                      //  header("location:http://asiatiger.org".$_SESSION["url"]);                                                                                                                                                    
                                               // } 
                                               // else {                                                    
                                                //    include "blocks/product-home.php";break;
                                               // }      
                                    }
                                            //default : include "page/danh-sach-cong-ty.php";break;            }
                                ?>
				
			</div>
		</div>

                <div class="back-top" id="back-top" style="display:none; float: right;">
                    <a href="javascript:void(0);" title="返回顶部" class="gotop">返回顶部</a>
                </div>
                
<div class="skin-default" data-name="mm-sc-new-footer" data-skin="default" data-guid="1409634827621" id="guid-1409634827621" data-version="41" data-type="3"><div class="module" data-spm="a271py"><div class="mm-sc-new-footer">

	<?php include 'blocks/footer.php'; ?>

			
</div>


</div></div>

<script>
seajs.Module.define('mm-sc-new-footer', function(require, exports) {
	// 模块初始化函数
	exports.init = function(box, module) {
		// code here
	};
});
</script>
<script>(function(f){var e,d,c;e=f.replace(/#/ig,"").split(",");for(var b=0,a=e.length;b<a;b++){d=document.getElementById(e[b]);c=d.getAttribute("data-name");seajs.use(c,function(g){g.init(d,c)})}})('#guid-1409634827621');</script>
		
		
				
		
		<!-- dragoon check -->


		

                <script>
    seajs.use('http://style.aliunicorn.com/js/6v/biz/arcadia/dpm-log/??dpm-log.js?t=38206f82_42dbffc8', function(dmplog) {
        dmplog.run();
    });
</script>
        <script>
            seajs.use(['http://style.aliunicorn.com/js/6v/lib/arale/widget/??widget.js?t=b3ba6d9e_5bc1979a5'], function(Widget){
                Widget.autoRenderAll();
            });
        </script>
        
        <?php
            include 'blocks/chat_online.php';
            //include 'blocks/facebook.php';
        ?>
        
         <?php
            $str=ob_get_clean();
            $str = str_replace("{gioithieu}" , gioithieu , $str);
            $str = str_replace("{about}" , about , $str);
            $str = str_replace("{faqs}" , faqs , $str);
            
            $str = str_replace("{gioithieuvinhsang}" , gioithieuvinhsang , $str);
            $str = str_replace("{baoveriengtu}" , baoveriengtu , $str);
            $str = str_replace("{bandowebsite}" , bandowebsite , $str);
            
            $str = str_replace("{trangchu}" , trangchu , $str);
            $str = str_replace("{lienhe}" , lienhe , $str);	
            $str = str_replace("{danhmucsp}" , danhmucsp , $str);
            $str = str_replace("{sanpham}" , sanpham , $str);
             $str = str_replace("{ctsanpham}" , ctsanpham , $str); 
            $str = str_replace("{dathang}" , dathang , $str);
            $str = str_replace("{httt}" , httt , $str);
            $str = str_replace("{doitac}" , doitac , $str);
            $str = str_replace("{menu}" , menu , $str);
            $str = str_replace("{chinhanh}" , chinhanh , $str);
            $str = str_replace("{duandalam}" , duandalam , $str);
           
            $str = str_replace("{tintucmuaban}" , tintucmuaban , $str);
            $str = str_replace("{dkquangcao}" , dkquangcao , $str);
            $str = str_replace("{tttrienlam}" , tttrienlam , $str);
            $str = str_replace("{weblk}" , weblk , $str);
            $str = str_replace("{bangquangcao}" , bangquangcao , $str);  
            
             $str = str_replace("{thongbao}" , thongbao , $str);
            
           $str = str_replace("{danhmucnghanhnghe}" , danhmucnghanhnghe , $str);
            $str = str_replace("{danhchonguoimua}" , danhchonguoimua , $str);	
            $str = str_replace("{danhchonguoiban}" , danhchonguoiban , $str);
            $str = str_replace("{giupdo}" , giupdo , $str);
             $str = str_replace("{trangvang}" , trangvang , $str); 
            $str = str_replace("{ngonngu}" , ngonngu , $str);
            $str = str_replace("{vietnam}" , vietnam , $str);
            $str = str_replace("{dailoan}" , dailoan , $str);
            $str = str_replace("{trungquoc}" , trungquoc , $str);
            $str = str_replace("{hongkong}" , hongkong , $str);
           $str = str_replace("{dangnhap}" , dangnhap , $str);
           $str = str_replace("{dangky}" , dangky , $str); 
            $str = str_replace("{trangmau}" , trangmau , $str);
            $str = str_replace("{theosp}" , theosp , $str);
            $str = str_replace("{theonhacungcap}" , theonhacungcap , $str);
            $str = str_replace("{chamsockh}" , chamsockh , $str);
            $str = str_replace("{hoatdongmoinhat}" , hoatdongmoinhat , $str);
           $str = str_replace("{tinmoinhat}" , tinmoinhat , $str);
           $str = str_replace("{dichvuthuongmai}" , dichvuthuongmai , $str);
           $str = str_replace("{qcniengiam}" , qcniengiam , $str);
           $str = str_replace("{bandovn}" , bandovn , $str);
            
            $str = str_replace("{thongke}" , thongke , $str);
            $str = str_replace("{hoatdongcty}" , hoatdongcty , $str);
            $str = str_replace("{hinhanhsx}" , hinhanhsx , $str);
            $str = str_replace("{sanphammoi}" , sanphammoi , $str);
            $str = str_replace("{spcungloai}" , spcungloai , $str);
            $str = str_replace("{dichvu}" , dichvu , $str);
            $str = str_replace("{kinhdoanh}" , kinhdoanh , $str);
            $str = str_replace("{mota}" , mota , $str);
            
            $str = str_replace("{dau}" , dau , $str);	
            $str = str_replace("{cuoi}" , cuoi , $str);
            $str = str_replace("{hotline}" , hotline , $str);	
            $str = str_replace("{ttnguoiban}" , ttnguoiban , $str);
            $str = str_replace("{xemthemspcungcty}" , xemthemspcungcty , $str);
            
            $str = str_replace("{tintuc}" , tintuc , $str);	
            $str = str_replace("{tuyendung}" , tuyendung , $str);	
            $str = str_replace("{diachi}" , diachi , $str);
            $str = str_replace("{footer}" , footer , $str);

            $str = str_replace("{gioithieucty}" , gioithieucty , $str);
           
            
            $str = str_replace("{chitiet}" , chitiet , $str);
            $str = str_replace("{tintuctonghop}" , tintuctonghop , $str);	
            $str = str_replace("{tinchuyennganh}" , tinchuyennganh , $str);

            $str = str_replace("{coppyright}" , coppyright , $str);

            $str = str_replace("{thuvienanh}" , thuvienanh , $str);
            $str = str_replace("{sanphamchinh}" , sanphamchinh , $str);
            $str = str_replace("{tinlienquan}" , tinlienquan , $str);
            $str = str_replace("{trove}" , trove , $str);
            $str = str_replace("{them}" , them , $str);
            $str = str_replace("{search}" , search , $str);
            $str = str_replace("{timgi}" , timgi , $str);   
            
            $str = str_replace("{xembando}" , xembando , $str);
            $str = str_replace("{tencty}" , tencty , $str);
            $str = str_replace("{diachilienhe}" , diachilienhe , $str);
            $str = str_replace("{email}" , email , $str);
            $str = str_replace("{noidung}" , noidung , $str);
            $str = str_replace("{tieude}" , tieude , $str);
            $str = str_replace("{dienthoai}" , dienthoai , $str);
            $str = str_replace("{gui}" , gui , $str);
            $str = str_replace("{hoten}" , hoten , $str);
            $str = str_replace("{gia}" , gia , $str);
            $str = str_replace("{xoa}" , xoa , $str);
            $str = str_replace("{thaydoi}" , thaydoi , $str);
            
            $str = str_replace("{thaydoithongtin}" , thaydoithongtin , $str);
            $str = str_replace("{themsp}" , themsp , $str);
            
            $str = str_replace("{fax}" , fax , $str);
            $str = str_replace("{nguoilienhe}" , nguoilienhe , $str);
            $str = str_replace("{tttk}" , tttk , $str);
            $str = str_replace("{ttct}" , ttct , $str);
            $str = str_replace("{spchinh}" , spchinh , $str);
            $str = str_replace("{tendn}" , tendn , $str);
            $str = str_replace("{pass}" , pass , $str);
            $str = str_replace("{quenpass}" , quenpass , $str);
            $str = str_replace("{rememberme}" , rememberme , $str);
            $str = str_replace("{hoac}" , hoac , $str);
            $str = str_replace("{batbuocnhap}" , batbuocnhap , $str);
            $str = str_replace("{hangmuckd}" , hangmuckd , $str);
            $str = str_replace("{website}" , website , $str);
            $str = str_replace("{nhaplai}" , nhaplai , $str);
            
            $str = str_replace("{giohang}" , giohang , $str);
            $str = str_replace("{hinh}" , hinh , $str);
            
            $str = str_replace("{ttkhachhang}" , ttkhachhang , $str);
            $str = str_replace("{tensp}" , tensp , $str);
            $str = str_replace("{soluong}" , soluong , $str);
            $str = str_replace("{tong}" , tong , $str);
            $str = str_replace("{thanhtien}" , thanhtien , $str);
            $str = str_replace("{tieptucmua}" , tieptucmua , $str);
            $str = str_replace("{thanhtoan}" , thanhtoan , $str);
            $str = str_replace("{xacnhantt}" , xacnhantt , $str);
            $str = str_replace("{hoantat}" , hoantat , $str);
            $str = str_replace("{vetrangchu}" , vetrangchu , $str);
            
            $str = str_replace("{xemtatca}" , xemtatca , $str);
            $str = str_replace("{vuilongdoi}" , vuilongdoi , $str);
            $str = str_replace("{daconguoidk}" , daconguoidk , $str);
            $str = str_replace("{tendnkhongduocbotrong}" , tendnkhongduocbotrong , $str);
            $str = str_replace("{bancothesdtennay}" , bancothesdtennay , $str);
             $str = str_replace("{emailconguoidk}" , emailconguoidk , $str);
            $str = str_replace("{emailkohople}" , emailkohople , $str);
            $str = str_replace("{mabaove}" , mabaove , $str);
            $str = str_replace("{mkkogiongnhau}" , mkkogiongnhau , $str);
            $str = str_replace("{hienthitrangcty}" , hienthitrangcty , $str);
            $str = str_replace("{emailormkkodung}" , emailormkkodung , $str);
            $str = str_replace("{thoat}" , thoat , $str);
            $str = str_replace("{themtinmuaban}" , themtinmuaban , $str);
            $str = str_replace("{quocgia}" , quocgia , $str);
            $str = str_replace("{chon}" , chon , $str);
            $str = str_replace("{loaihinh}" , loaihinh , $str);
            $str = str_replace("{canban}" , canban , $str);
            $str = str_replace("{canmua}" , canmua , $str);
            $str = str_replace("{trang}" , trang , $str);
            $str = str_replace("{lichlamviec}" , lichlamviec , $str);
            $str = str_replace("{khongtimthay}" , khongtimthay , $str);
            $str = str_replace("{didong}" , didong , $str);
            $str = str_replace("{xemthemthongtin}" , xemthemthongtin , $str);
            //echo $lang;
            echo $str;
        ?>
        
	
        
        
</body></html>