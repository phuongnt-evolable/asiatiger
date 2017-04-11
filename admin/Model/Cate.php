<?php

require_once "Db.php";

class Cate extends Db {

    function getListCate($idTL) {
        $sql = "SELECT * FROM category WHERE idTL = $idTL  ORDER BY cate_id";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }

    public function getIdtlByCateId($cate_id){
        $sql = "SELECT idTL FROM category WHERE cate_id = $cate_id";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
    function getAllCate() {
        $sql = "SELECT * FROM category where cate_id <> 68 AND cate_id <> 69  ORDER BY cate_id";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
    function getAllTL() {
        $sql = "SELECT * FROM theloai   ORDER BY idTL ";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }

    function insertCate() {
       $parent_id = (int) $_POST['parent_id'];

        $cate_name_cn = $this->processData($_POST['cate_name_cn']);
        $cate_name_vi = $this->processData($_POST['cate_name_vi']);
        $cate_name_en = $this->processData($_POST['cate_name_en']);

        $update_time = time();         
        
        $cate_alias = $this->changeTitle($cate_name_vi);

        $sql = "INSERT INTO category VALUES(NULL,'$cate_name_cn','$cate_name_vi','$cate_name_en','$cate_alias',$parent_id,'$cate_name_en','$cate_name_en','$cate_name_en',$update_time)";								
        mysql_query($sql) or die(mysql_error() . $sql);
    }
    function updateCate($cate_id) {
        $parent_id = (int) $_POST['parent_id'];

        $cate_name_cn = $this->processData($_POST['cate_name_cn']);
        $cate_name_vi = $this->processData($_POST['cate_name_vi']);
        $cate_name_en = $this->processData($_POST['cate_name_en']);

        $update_time = time();         
        
        $cate_alias = $this->changeTitle($cate_name_vi);

         $sql = "UPDATE category
                SET cate_name_cn = '$cate_name_cn',cate_name_vi = '$cate_name_vi',cate_name_en = '$cate_name_en',cate_alias = '$cate_alias',
                idTL = $parent_id,update_time = $update_time,					
                seo_title = '$cate_name_cn',seo_description = '$cate_name_cn',seo_keyword = '$cate_name_cn'					
                WHERE cate_id = $cate_id ";
        mysql_query($sql) or die(mysql_error() . $sql);
    }
    function updateTheLoai($idTL) {
        $parent_id = 0;

        $TenTL_cn = $this->processData($_POST['tl_name_cn']);
        $TenTL_en = $this->processData($_POST['tl_name_en']);
        $TenTL_vi = $this->processData($_POST['tl_name_vi']);

        $update_time = time();         
        
        $TenTL_KhongDau = $this->changeTitle($TenTL_en);

         $sql = "UPDATE theloai
                SET TenTL_cn = '$TenTL_cn',TenTL_vi = '$TenTL_vi',TenTL_en = '$TenTL_en',TenTL_KhongDau = '$TenTL_KhongDau' 
                WHERE idTL = $idTL ";
        mysql_query($sql) or die(mysql_error() . $sql);
    }
    function getDetailCate($cate_id){
        $sql = "SELECT * FROM category WHERE cate_id = $cate_id";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function getDetailTheLoai($idTL){
        $sql = "SELECT * FROM theloai WHERE idTL = $idTL";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function insertDanhMucCha() {       
        
        //$parent_id = 0;
        $tl_name_cn = $this->processData($_POST['tl_name_cn']);
        $tl_name_en = $this->processData($_POST['tl_name_en']);
        $tl_name_vi = $this->processData($_POST['tl_name_vi']);
        $tl_alias = $this->changeTitle($tl_name_en);

          $sql = "INSERT INTO theloai VALUES(NULL,'$tl_name_cn','$tl_name_vi','$tl_name_en','$tl_alias')";								
        mysql_query($sql) or die(mysql_error() . $sql);
    }
}

?>