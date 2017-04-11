<?php 
session_start();
require_once('../Model/Db.php'); 
$d = new db;

$arr_cate_id=json_decode(stripslashes($_POST['cate_id']));
$ten_cty = $d->processData($_POST['ten_cty']);
$url_images = $d->processData($_POST['url_images']);
$href = $d->processData($_POST['href']);
$id_loai_hinh = $d->processData($_POST['id_loai_hinh']);
$id_hinh = $d->processData($_POST['id_hinh']);
$show_home = $d->processData($_POST['show_home']);

$ten_cty_alias = $d->changeTitle($ten_cty);

        echo $sql = "UPDATE hinhanh_home
                SET TenCT = '$ten_cty',ten_alias='$ten_cty_alias',Url = '$url_images',Href = '$href',idLoaiHinh = $id_loai_hinh, show_home = '$show_home'
                WHERE idHinh = $id_hinh";
        mysql_query($sql) or die(mysql_error() . $sql); 
        
       $sql1 = "DELETE FROM hinhanh_cate WHERE id_hinh = $id_hinh ";
        mysql_query($sql1) or die(mysql_error() . $sql1);
        
        foreach ($arr_cate_id as $cate_id) {
            $sql="SELECT idTL from category WHERE cate_id=$cate_id";
            $row=  mysql_query($sql);
            $row_tl=  mysql_fetch_assoc($row);
            $idTL=$row_tl['idTL'];

               $sql3="INSERT INTO hinhanh_cate VALUES('',$id_hinh,$cate_id,$idTL)";
                mysql_query($sql3) or die(mysql_error() . $sql3);                               
            }        
?>