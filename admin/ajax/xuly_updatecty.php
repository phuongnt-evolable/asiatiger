<?php 
session_start();
require_once('../Model/Db.php'); 
$d = new db;

$congty_id=$_POST['congty_id'];

$top=$_POST['top'];
$shopvip=$_POST['shopvip'];
//$arr_cate_id=$_POST['cate_id'];
$arr_cate_id=json_decode(stripslashes($_POST['cate_id']));
$idTL1=$_POST['idTL'];
$ten_cty_cn = $d->processData($_POST['ten_cty_cn']);
$ten_cty_vi = $d->processData($_POST['ten_cty_vi']);
$ten_cty_en = $d->processData($_POST['ten_cty_en']);
$nha_dau_tu_en = $d->processData($_POST['nha_dau_tu_en']);
$nha_dau_tu_vi = $d->processData($_POST['nha_dau_tu_vi']);
$nha_dau_tu_cn = $d->processData($_POST['nha_dau_tu_cn']);
$quocgia = $d->processData($_POST['quocgia']);
$diachi_cn = $d->processData($_POST['diachi_cn']);
$diachi_vi = $d->processData($_POST['diachi_vi']);
$diachi_en = $d->processData($_POST['diachi_en']);
$nguoilienhe = $d->processData($_POST['nguoilienhe']); 
$skype = $d->processData($_POST['skype']); 
$qq = $d->processData($_POST['qq']); 
$didong = $d->processData($_POST['didong']); 
$dienthoai = $d->processData($_POST['dienthoai']); 
$fax = $d->processData($_POST['fax']); 
$email = $d->processData($_POST['email']); 
$website = $d->processData($_POST['website']); 
$url_images = $d->processData($_POST['url_images']);
$mota_cn = $d->processData($_POST['gioithieu_cn']);
$mota_vi = $d->processData($_POST['gioithieu_vi']);
$mota_en= $d->processData($_POST['gioithieu_en']);        
$gioithieu_cn = $_POST['gioithieu_cn'];
$gioithieu_vi = $_POST['gioithieu_vi'];
$gioithieu_en= $_POST['gioithieu_en'];
$spchinh_vi=$_POST['spchinh_vi'];
$spchinh_cn=$_POST['spchinh_cn'];
$spchinh_en=$_POST['spchinh_en'];
//$congty_name_alias = $d->changeTitle($ten_cty_vi);

$congty_name_alias = $d->changeTitle($ten_cty_vi);

        echo $sql = "UPDATE congty
                SET top='$top',ShopVip='$shopvip', TenCT_cn = '$ten_cty_cn',TenCT_vi = '$ten_cty_vi',TenCT_en = '$ten_cty_en',ten_khong_dau='$congty_name_alias',NhaDauTu_vi = '$nha_dau_tu_vi',NhaDauTu_cn = '$nha_dau_tu_cn',NhaDauTu_en = '$nha_dau_tu_en',NguoiLienHe='$nguoilienhe',Skype='$skype',QQ='$qq',idQuocGia='$quocgia',DiaChi_cn = '$diachi_cn',DiaChi_vi = '$diachi_vi',DiaChi_en = '$diachi_en',DiDong='$didong',DienThoai = '$dienthoai',Fax = '$fax',Email = '$email',Website = '$website',MoTa_cn = '$mota_cn',MoTa_vi = '$mota_vi',MoTa_en = '$mota_en',GioiThieu_cn = '$gioithieu_cn',GioiThieu_vi = '$gioithieu_vi',GioiThieu_en = '$gioithieu_en',HinhDaiDien = '$url_images',cate_id = '$category_id',SanPhamChinh_vi='$spchinh_vi',SanPhamChinh_cn='$spchinh_cn',SanPhamChinh_en='$spchinh_en'
                WHERE congty_id = $congty_id";
        mysql_query($sql) or die(mysql_error() . $sql); 
        
       $sql1 = "DELETE FROM cty_cate WHERE congty_id = $congty_id ";
        mysql_query($sql1) or die(mysql_error() . $sql1);
        
        foreach ($arr_cate_id as $cateid) {
           // var_dump($cateid);
                //echo "adsasd";die;
                $sql2="SELECT idTL from category WHERE cate_id=$cateid"; 
                $row=  mysql_query($sql2);
                $row_tl=  mysql_fetch_assoc($row);
                $idTL=$row_tl['idTL'];
               $sql3="INSERT INTO cty_cate VALUES('',$congty_id,$cateid,'$idTL')";
                mysql_query($sql3) or die(mysql_error() . $sql3);                               
            }        
?>