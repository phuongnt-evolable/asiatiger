<?php
//session_start();
require_once "../admin/Model/Db.php";
$d = new db;
function checkCat($uri) {
    $pattern_sp = '#san-pham+.html#';
    $pattern_ctsp = '#ctsp/[a-z0-9\-]+\-\d+.html#';
    $pattern_dmsp = '#dmsp/[a-z0-9\-]+\-\d+.html#';
    $pattern_contact = '#lien-he+.html#';
    $pattern_about = '#gioi-thieu+.html#';
    $pattern_timkiem= '#tim-kiem+.html#';
    

    $mod = "";
    if (preg_match($pattern_sp, $uri)) {
        $mod = "sp";
    }
    if (preg_match($pattern_ctsp, $uri)) {
        $mod = "ctsp";
    }
    if (preg_match($pattern_dmsp, $uri)) {
        $mod = "dmsp";
    }
    if (preg_match($pattern_about, $uri)) {
        $mod = "gioi-thieu";
    }
    if (preg_match($pattern_contact, $uri)) {
        $mod = "contact";
    }
   if (preg_match($pattern_timkiem, $uri)) {
        $mod = "tim-kiem";
    }
  
    return $mod;
}

 $uri = str_replace("Robin/", "", $_SERVER['REQUEST_URI']);
 $com = checkCat($uri);
$uri = str_replace(".html", "", $uri);

$tmp_uri = explode("/", $uri);
//var_dump($tmp_uri);
if ($tmp_uri[2] == 'gioi-thieu') {
    $com = "about-us";
}
if ($tmp_uri[2] == 'lien-he') {
    $com = "contact";
}
if ($tmp_uri[2] == 'san-pham') {
    $com = "product";
}
if ($tmp_uri[2] == 'ctsp') {
    $com = "ctsp";
}
if ($tmp_uri[2] == 'dmsp') {
    $com = "dmsp";
}
if ($tmp_uri[2] == 'tim-kiem') {
    $com = "tim-kiem";
}

//echo $com;
switch ($com) {
    case "contact":
        $title = "Liên hệ";
        $metaD = "Liên hệ";
        $metaK = "Liên hệ";
        break;
    case "about-us":
        $title = "Giới thiệu";
        $metaD = "Giới thiệu";
        $metaK = "Giới thiệu";
        break;
    case "product":
        $title = "Sản phẩm";
        $metaD = "Sản phẩm";
        $metaK = "Sản phẩm";
        break;
    case "ctsp":
        $tieude_id = $tmp_uri[3]; 
        $arr = explode("-", $tieude_id);      
        $product_id = (int) end($arr);
        $data = $modelProduct->getDetailProduct($product_id) ;
        $row_1=  mysql_fetch_assoc($data);
	 $tieude=$row_1['product_name_'.$lang];
        $url1=  str_replace("../", "",$row_1['url_images'] ) ;
        $title = "$tieude";
        $metaD = "";
        $metaK = "";
        break; 
    case "dmsp":
        
        //$row_cate=  mysql_fetch_assoc($data);
	//$tieude=$row_cate['cate_name_'.$lang];
        //$url1=  str_replace("../", "",$row_1['url_images'] ) ;
        $title = "Danh mục sãn phẩm";
        $metaD = "Danh mục sãn phẩm";
        $metaK = "Danh mục sãn phẩm";
        break; 
    case "tim-kiem":
        if($lang=="vi" ){
            $title = "Tìm kiếm";
        }elseif ($lang=="en") {
            $title = "Search";
        }  else  {
            $title = "搜索 ";
        }        
        $metaD = "Tìm kiếm";
        $metaK = "Tìm kiếm";
        break;
    
    default :
        $title = "CTY TNHH QUẢNG CÁO THIẾT KẾ VINH SANG";
        $metaD = "CTY TNHH QUẢNG CÁO THIẾT KẾ VINH SANG   ";
        $metaK = "CTY TNHH QUẢNG CÁO THIẾT KẾ VINH SANG";
        break;
}
?>