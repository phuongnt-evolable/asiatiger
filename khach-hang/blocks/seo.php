<?php
//session_start();
require_once "../admin/Model/Db.php";
$d = new db;
function checkCat($uri) {
    $pattern_doimk = '#doi-mat-khau+.html#';
    $pattern_uplogo = '#up-logo+.html#';
    $pattern_xoalogo = '#xoa-logo+.html#';
    $pattern_uphinhcty = '#up-hinh-cong-ty+.html#';
    $pattern_dssp = '#danh-sach-san-pham+.html#';
    $pattern_themsp = '#them-san-pham+.html#';
    $pattern_suasp = '#sua-san-pham+.html#';

    $mod = "";
    if (preg_match($pattern_doimk, $uri)) {
        $mod = "doimk";
    }
    if (preg_match($pattern_uplogo, $uri)) {
        $mod = "uplogo";
    } 
    if (preg_match($pattern_xoalogo, $uri)) {
        $mod = "xoalogo";
    } 
    if (preg_match($pattern_uphinhcty, $uri)) {
        $mod = "uphinhcty";
    }
    if (preg_match($pattern_dssp, $uri)) {
        $mod = "dssp";
    } 
    if (preg_match($pattern_themsp, $uri)) {
        $mod = "themsp";
    }
    if (preg_match($pattern_suasp, $uri)) {
        $mod = "suasp";
    }
    return $mod;
}

 $uri = str_replace("Robin/", "", $_SERVER['REQUEST_URI']);
 $com = checkCat($uri);
$uri = str_replace(".html", "", $uri);

$tmp_uri = explode("/", $uri);
//var_dump($tmp_uri);
if ($tmp_uri[2] == 'doi-mat-khau') {
    $com = "doimk";
}
if ($tmp_uri[2] == 'up-logo') {
    $com = "up-logo";
}
if ($tmp_uri[2] == 'xoa-logo') {
    $com = "xoa-logo";
}
if ($tmp_uri[2] == 'up-hinh-cong-ty') {
    $com = "up-hinhcty";
}
if ($tmp_uri[2] == 'danh-sach-san-pham') {
    $com = "dssp";
}
if ($tmp_uri[2] == 'them-san-pham') {
    $com = "them-sp";
}
if ($tmp_uri[2] == 'sua-san-pham') {
    $com = "sua-sp";
}

//echo $com;
switch ($com) {
    case "doimk":
        $title = "Đổi mật khẩu";
        $metaD = "Đổi mật khẩu";
        $metaK = "Đổi mật khẩu";
        break;
    case "up-logo":
        $title = "Upload Logo";
        $metaD = "Upload Logo";
        $metaK = "Upload Logo";
        break;
    case "xoa-logo":
        $title = "Xoá Logo";
        $metaD = "Xoá Logo";
        $metaK = "Xoá Logo";
        break;
    case "up-hinhcty":
        $title = "Upload Hình công ty";
        $metaD = "Upload Hình công ty";
        $metaK = "Upload Hình công ty";
        break;
    case "dssp":
        $title = "Danh sách sản phẩm";
        $metaD = "Danh sách sản phẩm";
        $metaK = "Danh sách sản phẩm";
        break;
    case "them-sp":
        $title = "Thêm sản phẩm";
        $metaD = "Thêm sản phẩm";
        $metaK = "Thêm sản phẩm";
        break;
    case "sua-sp":
        $title = "Sửa sản phẩm";
        $metaD = "Sửa sản phẩm";
        $metaK = "Sửa sản phẩm";
        break;
    default :
        $title = "CTY TNHH QUẢNG CÁO THIẾT KẾ VINH SANG";
        $metaD = "CTY TNHH QUẢNG CÁO THIẾT KẾ VINH SANG   ";
        $metaK = "CTY TNHH QUẢNG CÁO THIẾT KẾ VINH SANG";
        break;
}
?>