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
require_once "../lang/lang_$lang.php";
require_once "../admin/Model/Product.php";
require_once "../admin/Model/Cate.php";
require_once "../admin/Model/Article.php";
require_once "../admin/Model/Block.php";
require_once "../admin/Model/Home.php";
require_once "../admin/Model/Congty.php";
$modelProduct = new Product;
$modelCate = new Cate;
$modelArticle = new Article;
$modelBlock = new Block;
$modelHome = new Home;
$modelCongTy = new Congty;
require_once("blocks/seo.php");

$idUser = $_SESSION["idUser"];
 //echo $com;
if($com==''){
   $tieude_id = $tmp_uri[2]; 
    $arr = explode("-", $tieude_id);      
   $congty_id = (int) end($arr);   
} 
else if($com=='ctsp'){
    $tieude_id = $tmp_uri[4]; 
    $arr = explode("-", $tieude_id);      
    $congty_id = (int) end($arr);     
}
else if($com=='dmsp'){
    $tieude_id = $tmp_uri[4]; 
    $arr = explode("-", $tieude_id);      
    $congty_id = (int) end($arr);     
}
else {
    $tieude_id = $tmp_uri[3]; 
    $arr = explode("-", $tieude_id);      
   $congty_id = (int) end($arr);   
}


//if (!isset($congty_id)) {
  //  header("location: http://asiatiger.org/dang-nhap.html");
//} else {
    //$congty_id = $_SESSION["congty_id"];

    $congty = $modelCongTy->getDetailCongTy($congty_id);
    $row_cty = mysql_fetch_assoc($congty);
    $url =  str_replace('httt://', '', $row_cty['Website']);
    $url1 =  str_replace('www.', '', $url);
    $website =  str_replace('http://www.', '', $url1);
    
   // $sanpham=$modelProduct->getProductByCTy($congty_id);
    $arr_product = $modelProduct->getProductByCTy($congty_id);
    $sql = "SELECT * FROM product Where congty_id=$congty_id";
    $rs = mysql_query($sql) or die(mysql_error());
    $soluong=mysql_num_rows($rs);
    
    
//}
?>
<html>
    <head>
        <base href="http://asiatiger.org/cong-ty/" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="shortcut icon" href="images/favicon.ico" >
        <link href="../static/saved_resource.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/showhall.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/thranduil.css" rel="stylesheet" type="text/css" media="all">        

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/thranduil.js"></script>
        <script type="text/javascript" src="js/top.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/showhall_<?php echo $lang; ?>.js"></script>
              
        <script type="text/javascript" src="js/gotop.js"></script>
        
        
        <script type="text/javascript">
            $(document).ready(function() {
                ///$('.fancybox').fancybox();
                //---------------------------------------
                //alert('sad');

            });
        </script>

    </head>

    <body>


        <?php include'blocks/header.php'; ?>

        <!-------------------------- header end -------------------------->
        <header class="container1010" id="showhall-header">
            <div class="span1010">
                <div class="logo">
                    <div class="thumbnails8060">
                        <div class="md-hnvalign">
                            <div class="md-hnvalign-mid">
                                <div class="md-hnvalign-mid-inner">
                                    <img width="60" height="60" src="<?php echo $row_cty['HinhDaiDien']; ?>" alt="<?php echo $row_cty['TenCT_' . $lang]; ?>" title="<?php echo $row_cty['TenCT_' . $lang]; ?>" id="comLogoImg"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="name">
                    <div class="md-hvalign">
                        <div class="md-hvalign-mid">
                            <div class="md-hvalign-mid-inner">
                                <h2 class="companyName"><?php echo $row_cty['TenCT_' . $lang]; ?> </h2>                    </div>
                        </div>
                    </div>
                </div>
                <!--<div class="royal">  
                    <div class="royalYear"><strong>7th</strong></div>
                </div>-->
            </div>
        </header>


        <menu class="container1010" id="showhall-menu">
            <div class="span1010">
                <ul class="ui-nav-hor">
                    <li  class="<?php if($com=='') echo 'current';?>" >
                        <a href="http://asiatiger.org/cong-ty/<?php echo $row_cty['ten_khong_dau'].'-'.$row_cty['congty_id'].'.html'; ?>">{trangchu}</a>
                    </li>
                    <li class="<?php if($com=='about-us') echo 'current';?>">
                        <a href="gioi-thieu/<?php echo $row_cty['ten_khong_dau'].'-'.$row_cty['congty_id'].'.html'; ?>">{gioithieucty}</a>
                    </li>
                    <li class="<?php if($com=='product' || $com=='ctsp' ) echo 'current';?>">
                        <a href="san-pham/<?php echo $row_cty['ten_khong_dau'].'-'.$row_cty['congty_id'].'.html'; ?>">{sanpham}</a>
                    </li>
                    <li class="<?php if($com=='contact') echo 'current';?>">
                        <a href="lien-he/<?php echo $row_cty['ten_khong_dau'].'-'.$row_cty['congty_id'].'.html'; ?>">{lienhe}</a>
                    </li>
                    
                </ul>
            </div>
        </menu>
        <!-------------------------- content -------------------------->
        <div class="container1010" id="showhall">
            <div class="span1010 showhall-inner">
                <div class="span220"><?php include'blocks/left.php'; ?></div>
                <div class="span780">
                    <?php //echo $com;die;
                        switch($com){                
                                case "about-us" : include "blocks/gioi-thieu.php";break;
                                case "contact" : include "blocks/lien-he.php";break;
                                case "product" : include "blocks/san-pham.php";break; 
                                case "ctsp" : include "blocks/ctsp.php";break; 
                                case "dmsp" : include "blocks/dmsp.php";break;
                                default : include "blocks/right.php";break;        
                        }    
                    ?>
                </div>
            </div>
        </div>
        <div class="back-top" id="back-top" style="display:none;">
            <a href="javascript:void(0);" title="返回顶部" class="gotop">返回顶部</a>
        </div>
        <!-------------------------- content end-------------------------->
        <p>&nbsp;</p>
        <!-------------------------- footer -------------------------->
        <div class="skin-default" data-name="mm-sc-new-footer" data-skin="default" data-guid="1409634827621" id="guid-1409634827621" data-version="41" data-type="3">
            <div class="module" data-spm="a271py">
                <div class="mm-sc-new-footer">
                    <?php include '../blocks/footer.php'; ?>
                </div>
            </div>
        </div>

        <!-------------------------- footer end-------------------------->


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
        
        
        $str = str_replace("{didong}", didong, $str);
        $
        $str = str_replace("{capnhat}", capnhat, $str);
        $str = str_replace("{xoa}", xoa, $str);
        $str = str_replace("{dssanpham}", dssanpham, $str);
        $str = str_replace("{themsp}", themsp, $str);
        $str = str_replace("{danhmuc}", danhmuc, $str);
        $str = str_replace("{tendailoan}", tendailoan, $str);
        $str = str_replace("{tenvietnam}", tenvietnam, $str);
        $str = str_replace("{tentienganh}", tentienganh, $str);
        $str = str_replace("{hinhanh}", hinhanh, $str);
        $str = str_replace("{mota}", mota, $str);
        

        $str = str_replace("{tintucmuaban}", tintucmuaban, $str);
        $str = str_replace("{dkquangcao}", dkquangcao, $str);
        $str = str_replace("{tttrienlam}", tttrienlam, $str);
        $str = str_replace("{weblk}", weblk, $str);
        $str = str_replace("{bangquangcao}", bangquangcao, $str);

        $str = str_replace("{thongbao}", thongbao, $str);
        $str = str_replace("{danhmucnghanhnghe}", danhmucnghanhnghe, $str);       
        
        $str = str_replace("{dangnhap}", dangnhap, $str);
        $str = str_replace("{dangky}", dangky, $str);
        $str = str_replace("{trangmau}", trangmau, $str);
        $str = str_replace("{theosp}", theosp, $str);
        $str = str_replace("{theonhacungcap}", theonhacungcap, $str);
        
        $str = str_replace("{tinmoinhat}", tinmoinhat, $str);
        
        $str = str_replace("{qcniengiam}", qcniengiam, $str);
        
        $str = str_replace("{chonhinh}", chonhinh, $str);
        $str = str_replace("{gia}", gia, $str);

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
        $str = str_replace("{sanphamchinh}", sanphamchinh, $str);
        $str = str_replace("{tinlienquan}", tinlienquan, $str);
        $str = str_replace("{trove}", trove, $str);
        $str = str_replace("{them}", them, $str);
        $str = str_replace("{search}", search, $str);
        $str = str_replace("{timgi}", timgi, $str);

        
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
        $str = str_replace("{phainhapmkcu}", phainhapmkcu, $str);

        $str = str_replace("{fax}", fax, $str);
        $str = str_replace("{nguoilienhe}", nguoilienhe, $str);
        $str = str_replace("{tttk}", tttk, $str);
        $str = str_replace("{ttct}", ttct, $str);
        $str = str_replace("{spchinh}", spchinh, $str);        
        $str = str_replace("{hoac}", hoac, $str);
        $str = str_replace("{batbuocnhap}", batbuocnhap, $str);
        $str = str_replace("{hangmuckd}", hangmuckd, $str);
        $str = str_replace("{website}", website, $str);
        $str = str_replace("{nhaplai}", nhaplai, $str);

        $str = str_replace("{ttkhachhang}", ttkhachhang, $str);
        $str = str_replace("{tensp}", tensp, $str);
        $str = str_replace("{soluong}", soluong, $str);        
        $str = str_replace("{xacnhantt}", xacnhantt, $str);
        $str = str_replace("{hoantat}", hoantat, $str);
        $str = str_replace("{vetrangchu}", vetrangchu, $str);        
        $str = str_replace("{vuilongdoi}", vuilongdoi, $str);        
        $str = str_replace("{xulythanhcong}", xulythanhcong, $str);
        $str = str_replace("{xemtatca}" , xemtatca , $str);
        $str = str_replace("{gdcanhan}" , gdcanhan , $str);

        //echo $lang;
        echo $str;
        ?>
        <script type="text/javascript">
            //对公司视频截图进行压缩处理
            DrawImage($("#videoImg")[0], 198, 148);
        </script>

        <script type="text/javascript">
            if ($("#comBannerImg") && $("#comBannerImg").size() > 0) {
                DrawImage($("#comBannerImg")[0], 1010, 150);
            }
            if ($("#comLogoImg") && $("#comLogoImg").size() > 0) {
                DrawImage($("#comLogoImg")[0], 80, 60);
            }
        </script>
    </body>
</html>
