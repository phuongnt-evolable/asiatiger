<?php 
session_start();
require_once('../Model/Db.php'); 
$d = new db;

$top=$_POST['top'];
$shopvip=$_POST['shopvip'];
$arr_cate_id=$_POST['cate_id'];
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
//$nhanthongbao=
//$congty_name_alias = $d->changeTitle($ten_cty_vi);

$congty_name_alias = $d->changeTitle($ten_cty_vi);

       echo $sql = "INSERT INTO congty	VALUES(NULL,$top,'$shopvip','','$ten_cty_cn','$ten_cty_vi','$ten_cty_en','$congty_name_alias','$nha_dau_tu_vi','$nha_dau_tu_cn','$nha_dau_tu_en','$nguoilienhe','$skype','$qq','$category_id','$quocgia','$diachi_cn','$diachi_vi','$diachi_en','$dienthoai','$didong','$fax','$email','$website','$mota_cn','$mota_vi','$mota_en','$gioithieu_cn','$gioithieu_vi','$gioithieu_en','$url_images','$spchinh_vi','$spchinh_cn','$spchinh_en')";
        mysql_query($sql) or die(mysql_error() . $sql);
        
	$congty_id = mysql_insert_id();
        foreach ($arr_cate_id as $cateid) {
                $sql="SELECT idTL from category WHERE cate_id=$cateid";
                $row=  mysql_query($sql);
                $row_tl=  mysql_fetch_assoc($row);
                $idTL=$row_tl['idTL'];
                mysql_query("INSERT INTO cty_cate VALUES('',$congty_id,$cateid,'$idTL')");
            }
?>