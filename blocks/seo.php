<?php
//session_start();
require_once "admin/Model/Db.php";
$d = new db;
function checkCat($uri) {
    $pattern_detailnews = '#tintuc/[a-z0-9\-]+\-\d+.html#';
    $pattern_cat = '#cat1/[a-z0-9\-]+\-\d+.html#';
     $pattern_theloai = '#cat/[a-z0-9\-]+\-\d+.html#';
    $pattern_danhmuc = '#danhmuc/[a-z0-9\-]+\-\d+.html#';
    $pattern_loai = '#loai/[a-z0-9\-]+\-\d+.html#';
    $pattern_ctsp= '#[a-z0-9\-]+\-\d+.html#';
    $pattern_about = '#gioi-thieu+.html#';
    $pattern_tuyendung = '#tuyen-dung+.html#';
    $pattern_bvtk = '#bao-ve-tai-khoan+.html#';
    $pattern_dangky = '#dang-ky+.html#';
    $pattern_dangkybuoc2 = '#dang-ky-buoc-2+.html#';
    $pattern_dangnhap = '#dang-nhap+.html#';
    $pattern_qmk = '#quen-mat-khau+.html#';
    $pattern_dkquangcao = '#dang-ky-quang-cao+.html#';
    $pattern_ttmuaban = '#thong-tin-mua-ban+.html#';
    $pattern_dichvu = '#dich-vu+.html#';
    $pattern_duan = '#du-an+.html#';
    $pattern_sachniengiam = '#sach-nien-giam+.html#';
    $pattern_danhmucduan = '#dmduan/[a-z0-9\-]+\-\d+.html#';
    $pattern_ctduan = '#ctduan/[a-z0-9\-]+\-\d+.html#';
    $pattern_news = '#tin-tuc+.html#';
    $pattern_catenews = '#loaitin/[a-z0-9\-]+\-\d+.html#';
     $pattern_timkiem= '#tim-kiem+.html#';
    $pattern_sp = '#san-pham+.html#'; 
    $pattern_allcate = '#tat-ca-nghanh+.html#';
    $pattern_contact = '#lien-he+.html#';
    $pattern_weblk = '#web-lien-ket+.html#';
    $pattern_trangmau = '#trang-mau+.html#';
    

    $mod = "";
    if (preg_match($pattern_detailnews, $uri)) {
        $mod = "detail_news";
    }
    if (preg_match($pattern_news, $uri)) {
        $mod = "news";
    }
    if (preg_match($pattern_catenews, $uri)) {
        $mod = "cate-news";
    }
    if (preg_match($pattern_about, $uri)) {
        $mod = "gioi-thieu";
    }
    if (preg_match($pattern_tuyendung, $uri)) {
        $mod = "tuyen-dung";
    }
    if (preg_match($pattern_bvtk, $uri)) {
        $mod = "bvtk";
    }
    if (preg_match($pattern_dangky, $uri)) {
        $mod = "dang-ky";
    }
    if (preg_match($pattern_dangkybuoc2, $uri)) {
        $mod = "dang-ky-buoc-2";
    }
    if (preg_match($pattern_dangnhap, $uri)) {
        $mod = "dang-nhap";
    }
    if (preg_match($pattern_qmk, $uri)) {
        $mod = "quen-mat-khau";
    }
    if (preg_match($pattern_dkquangcao, $uri)) {
        $mod = "dang-ky-quang-cao";
    }
    if (preg_match($pattern_ttmuaban, $uri)) {
        $mod = "thong-tin-mua-ban";
    }
    if (preg_match($pattern_timkiem, $uri)) {
        $mod = "tim-kiem";
    }
    if (preg_match($pattern_dichvu, $uri)) {
        $mod = "dich-vu";
    }
    if (preg_match($pattern_duan, $uri)) {
        $mod = "du-an";
    }
    if (preg_match($pattern_sachniengiam, $uri)) {
        $mod = "sach-nien-giam";
    }
    if (preg_match($pattern_ctduan, $uri)) {
        $mod = "ctduan";
    }
    if (preg_match($pattern_danhmuc, $uri)) {
        $mod = "danhmuc";
    }
    
   
    if (preg_match($pattern_sp, $uri)) {
        $mod = "sp";
    }
    if (preg_match($pattern_contact, $uri)) {
        $mod = "contact";
    }    
    if (preg_match($pattern_cat, $uri)) {
        $mod = "cat";
    } 
    if (preg_match($pattern_theloai, $uri)) {
        $mod = "theloai";
    } 
    if (preg_match($pattern_ctsp, $uri)) {
        $mod = "ctsp";
    }
    if (preg_match($pattern_loai, $uri)) {
        $mod = "loai";
    }
    if (preg_match($pattern_weblk, $uri)) {
        $mod = "weblk";
    }
    if (preg_match($pattern_trangmau, $uri)) {
        $mod = "trangmau";
    }
  
    return $mod;
}

 $uri = str_replace("Robin/", "", $_SERVER['REQUEST_URI']);
 $com = checkCat($uri);
$uri = str_replace(".html", "", $uri);

$tmp_uri = explode("/", $uri);
//var_dump($tmp_uri);
if ($tmp_uri[1] == 'gioi-thieu') {
    $com = "about-us";
}
if ($tmp_uri[1] == 'tuyen-dung') {
    $com = "tuyen-dung";
}
if ($tmp_uri[1] == 'bao-ve-tai-khoan') {
    $com = "bvtk";
}
/*if ($tmp_uri[2] == 'dich-vu') {
    $com = "dich-vu";
}*/
if ($tmp_uri[1] == 'dang-ky') {
    $com = "dang-ky";
}
if ($tmp_uri[1] == 'dang-ky-buoc-2') {
    $com = "dang-ky-b2";
}
if ($tmp_uri[1] == 'dang-nhap') {
    $com = "dang-nhap";
}
if ($tmp_uri[1] == 'quen-mat-khau') {
    $com = "quen-mk";
}
if ($tmp_uri[1] == 'dang-ky-quang-cao') {
    $com = "dkqc";
}
if ($tmp_uri[1] == 'thong-tin-mua-ban') {
    $com = "ttmb";
}
if ($tmp_uri[1] == 'du-an') {
    $com = "du-an";
}
if ($tmp_uri[1] == 'sach-nien-giam') {
    $com = "sach-nien-giam";
}
if ($tmp_uri[1] == 'tim-kiem') {
    $com = "tim-kiem";
}
if ($tmp_uri[1] == 'ctduan') {
    $com = "ctduan";
}
if ($tmp_uri[1] == 'danhmuc') {
    $com = "danhmuc";
}

if ($tmp_uri[0] == 'lien-he') {
    $com = "contact";
}

if ($tmp_uri[1] == 'san-pham') {
    $com = "product";
}
if ($tmp_uri[1] == 'tat-ca-nghanh') {
    $com = "all-cate";
}

if ($tmp_uri[1] == 'tin-tuc') {
    $com = "news";
}

if ($tmp_uri[1] == 'cat1') {
    $com = "cat";
}
if ($tmp_uri[1] == 'cat') {
    $com = "theloai";
}
if ($tmp_uri[1] == 'loai') {
    $com = "loai";
}
if ($tmp_uri[1] == 'tintuc') {
    $com = "detail_news";
}
if ($tmp_uri[1] == 'loaitin') {
    $com = "cate_news";
}
if ($tmp_uri[1] == 'web-lien-ket') {
    $com = "weblk";
}
if ($tmp_uri[1] == 'trang-mau') {
    $com = "trangmau";
}

if ($com == 'cat' && $tmp_uri[1] == 'tag') {
    $com = 'tag';
}
//echo $com;
switch ($com) {
    case "contact":
        if($lang=="vi" ){
            $title = "Liên hệ";
        }elseif ($lang=="en") {
            $title = "Contact";
        }  else  {
            $title = "聯 繫 我 們 ";
        }
        
        $metaD = "Liên hệ";
        $metaK = "Liên hệ";
        break;
    case "about":
        if($lang=="vi" ){
            $title = "Giới thiệu";
        }elseif ($lang=="en") {
            $title = "About us";
        }  else  {
            $title = "關 於 永 盛 ";
        }
        $metaD = "Giới thiệu";
        $metaK = "Giới thiệu";
        break;
    case "tuyen-dung":
        if($lang=="vi" ){
            $title = "Tuyển dụng";
        }elseif ($lang=="en") {
            $title = "Recruitment";
        }  else  {
            $title = "招聘";
        }
        $metaD = "Tuyển dụng";
        $metaK = "Tuyển dụng";
        break;
    case "bvtk":
        if($lang=="vi" ){
            $title = "Bảo vệ tài khoản";
        }elseif ($lang=="en") {
            $title = "Protect accout";
        }  else  {
            $title = "隱私保護 ";
        }
        $metaD = "Giới thiệu";
        $metaK = "Giới thiệu";
        break;
    case "dich-vu":
        if($lang=="vi" ){
            $title = "Dịch vụ";
        }elseif ($lang=="en") {
            $title = "Service";
        }  else  {
            $title = "關 於 永 盛 ";
        }
        $metaD = "Dịch vụ";
        $metaK = "Dịch vụ";
        break;
    case "du-an":
        if($lang=="vi" ){
            $title = "Giới thiệu";
        }elseif ($lang=="en") {
            $title = "About us";
        }  else  {
            $title = "關 於 永 盛 ";
        }
        $metaD = "Dự án";
        $metaK = "Dự án";
        break;
    case "sach-nien-giam":
        if($lang=="vi" ){
            $title = "Sách Niên Giám";
        }elseif ($lang=="en") {
            $title = "Advertise yearbook ";
        }  else  {
            $title = "廣告年鑑 ";
        }
        $metaD = "Sách Niên Giám";
        $metaK = "Sách Niên Giám";
        break;
    case "ttmb":
        if($lang=="vi" ){
            $title = "Thông tin mua bán";
        }elseif ($lang=="en") {
            $title = "News Sales";
        }  else  {
            $title = "求 購 訊 息 ";
        }
        $metaD = "Thông tin mua bán";
        $metaK = "Thông tin mua bán";
        break;
    case "dkqc":
        if($lang=="vi" ){
            $title = "Đăng ký quảng cáo";
        }elseif ($lang=="en") {
            $title = "Subscribe Advertising";
        }  else  {
            $title = "廣 告 刊 登 ";
        }
        $metaD = "Đăng ký quảng cáo";
        $metaK = "Đăng ký quảng cáo";
        break;
      case "all-cate":
        $title = "All category";
        $metaD = "All category";
        $metaK = "All category";
        break;
    case "dang-ky":
        if($lang=="vi" ){
            $title = "Đăng ký";
        }elseif ($lang=="en") {
            $title = "Register";
        }  else  {
            $title = "加入會員 ";
        }
        $metaD = "Đăng ký";
        $metaK = "Đăng ký";
        break;
    case "dang-ky-b2":
        $title = "Hoàn tất đăng ký";
        $metaD = "Hoàn tất đăng ký";
        $metaK = "Hoàn tất đăng ký";
        break;
    case "dang-nhap":
        if($lang=="vi" ){
            $title = "Đăng nhập";
        }elseif ($lang=="en") {
            $title = "Login";
        }  else  {
            $title = "會員登彔 ";
        }
        $metaD = "Đăng nhập";
        $metaK = "Đăng nhập";
        break;
     case "quen-mk":
        if($lang=="vi" ){
            $title = "Quên mật khẩu";
        }elseif ($lang=="en") {
            $title = "Forgot password";
        }  else  {
            $title = "忘 記 密 碼 ";
        }        
        break;
    case "about-us":
         if($lang=="vi" ){
            $title = "Giới thiệu";
        }elseif ($lang=="en") {
            $title = "About";
        }  else  {
            $title = "關 於 永 盛 ";
        }
        $metaD = "關 於 永 盛";
        $metaK = "Giới thiệu";
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
    case "news":
        if($lang=="vi" ){
            $title = "Tin tức";
        }elseif ($lang=="en") {
            $title = "News";
        }  else  {
            $title = "最新消息 ";
        }
        $metaD = "Tin tức";
        $metaK = "Tin tức";
        break;    
    case "product":
        $title = "Menu";
        $metaD = "Menu";
        $metaK = "Menu";
        break;
    case "cat":  
        $title = "Danh sách công ty"; 
        $metaD = "Danh sách công ty";
        $metaK = "Danh sách công ty";
        break; 
    case "danhmuc":
        if($lang=="vi" ){
            $title = "Danh mục công ty";
        }elseif ($lang=="en") {
            $title = "Danh mục công ty";
        }  else  {
            $title = "Danh mục công ty ";
        }
        $metaD = "Tin tức";
        $metaK = "Tin tức";
        break; 
  
     case "loai":  
        $title = "Loại";
        $metaD = "loai";
        $metaK = "產 品 介 紹";
        break; 
    case "ctsp":
        $tieude_id = $tmp_uri[1]; 
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
    case "detail_news":
        $tieude_id = $tmp_uri[2];
        $arr = explode("-", $tieude_id);      
        $id_tin = (int) end($arr);
        $data = $modelArticle->getDetailArticle($id_tin);
        $row_1=  mysql_fetch_assoc($data);
        //echo $row_1['title'];
        $title = $data[0];
        $metaD = $data[1];
        $metaK = $data[2];
        break;
    case "cate_news":
        $tieude_id = $tmp_uri[2];
        $arr = explode("-", $tieude_id);      
        $idLoaiTin = (int) end($arr);
        $data = $modelArticle->getDetailLoaiArticle($idLoaiTin);
        $row_1=  mysql_fetch_assoc($data);
        //echo $row_1['title'];
        $title = $data[0];
        $metaD = $data[1];
        $metaK = $data[2];
        break;
    case "ctduan":
        $tieude_id = $tmp_uri[3];
        $arr = explode("-", $tieude_id);      
        $duan_id = (int) end($arr);
        $data = $modelArticle->getDetailDuAn($duan_id);
        $row_1=  mysql_fetch_assoc($data);
        //echo $row_1['TenDuAn_'.$lang];
        $title = $data[0];
        $metaD = $data[1];
        $metaK = $data[2];
        break;
    case "weblk":
        if($lang=="vi" ){
            $title = "Website liên kết";
        }elseif ($lang=="en") {
            $title = "WEBSITE LINKS";
        }  else  {
            $title = "友 情 網 站 ";
        }
        $metaD = "Tin tức";
        $metaK = "Tin tức";
        break; 
    case "trangmau":
        if($lang=="vi" ){
            $title = "Trang màu";
        }elseif ($lang=="en") {
            $title = "Color Page";
        }  else  {
            $title = "彩色廣告及網站連結";
        }
        $metaD = "Tin tức";
        $metaK = "Tin tức";
        break;
    default :
        
         $title = "ASIATIGER";          
        $metaD = "CTY TNHH QUẢNG CÁO THIẾT KẾ VINH SANG   ";
        $metaK = "CTY TNHH QUẢNG CÁO THIẾT KẾ VINH SANG";
        break;
}
?>