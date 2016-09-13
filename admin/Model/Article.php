<?php

require_once "Db.php";

class Article extends Db {

    function getDetailArticle($id_tin) {
        $sql = "SELECT * FROM article WHERE article_id = $id_tin";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
     function getDetailDuAn($duan_id) {
        $sql = "SELECT * FROM duan WHERE idDuAn = $duan_id";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
    function getDetailLoaiArticle($idLoaiTin) {
        $sql = "SELECT * FROM loaiarticle WHERE id = $idLoaiTin";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    

    function menu_list() {
        $sql = "SELECT * FROM menu ORDER BY menu_id DESC";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
    function QuocGia_List() {
        $sql = "SELECT * FROM quocgia ";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function KhuVuc_List() {
        $sql = "SELECT * FROM khuvucduan ";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function ListKhuVuc_ByidQuocGia($idQuocGia) {
        $sql = "SELECT * FROM khuvucduan WHERE idQuocGia= $idQuocGia";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }

    function getListArticleByCategory($HinhDaiDien = -1, $offset = -1, $limit = -1) {
        $sql = "SELECT * FROM article WHERE HinhDaiDien = $HinhDaiDien OR $HinhDaiDien = -1";
        if ($limit > 0 && $offset >= 0)
            $sql .= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
    function getListArticle($offset = -1, $limit = -1) {
        $sql = "SELECT * FROM article ORDER BY article_id DESC"; 
        if ($limit > 0 && $offset >= 0)
            $sql .= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        while($row = mysql_fetch_assoc($rs)){
            
            $arrReturn[]= $row;
        }
       return $arrReturn; 
    }
    
    function getLoaiArticle() {
        $sql = "SELECT * FROM loaiarticle";       
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
    function getListArticleByLoai($id_loai= -1, $offset = -1, $limit = -1) {
     $sql = "SELECT * FROM article WHERE id_loai =$id_loai ORDER BY  article_id DESC";       
        if ($limit > 0 && $offset >= 0)
            $sql .= " LIMIT $offset,$limit";
       $rs= mysql_query($sql)or die(mysql_error());
       while($row = mysql_fetch_assoc($rs)){
            
            $arrReturn[]= $row;
        }
       return $arrReturn;        
    }
     function getListArticleLeft() {
        $sql = "SELECT * FROM article ORDER BY article_id DESC  Limit 0,3";       
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function getListDuAn() {
        $sql = "SELECT * FROM duan";       
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function getListDuAnByCateID($cate_id) {
        $sql = "SELECT * FROM duan WHERE cate_id=$cate_id";       
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function getListCate() {
        $sql = "SELECT * FROM category";       
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function getListArticleLienQuan($id_tin) {
        $sql = "SELECT * FROM article where article_id <> $id_tin";       
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
    function addArticleToMenu($menu_id, $article_id) {
        $sql = "UPDATE menu SET article_id = $article_id WHERE menu_id = $menu_id";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }

    function insertArticle() {
        
        $HinhDaiDien=$_POST['url_images'];
        $title_cn = $this->processData($_POST['title_cn']);
        $title_vi = $this->processData($_POST['title_vi']);
        $title_en = $this->processData($_POST['title_en']);
        $mota_cn = $this->processData($_POST['mota_cn']);
        $mota_vi = $this->processData($_POST['mota_vi']); 
        $mota_en = $this->processData($_POST['mota_en']);
        $content_cn = $_POST['content_cn'];
        $content_vi = $_POST['content_vi']; 
        $content_en = $_POST['content_en'];
        $title_alias = $this->changeTitle($title_vi);
        $idloai = $_POST['idloai'];

        $sql = "INSERT INTO article	VALUES(NULL,'$idloai','$title_cn','$title_vi','$title_en','$title_alias','$mota_cn','$mota_vi','$mota_en','$content_cn','$content_vi','$content_en',
								
								'$HinhDaiDien')";
        mysql_query($sql) or die(mysql_error() . $sql);
    }
    function updateArticle($article_id) {
        $title_cn = $this->processData($_POST['title_cn']);
        $title_vi = $this->processData($_POST['title_vi']);
        $title_en = $this->processData($_POST['title_en']);
        $mota_cn = $this->processData($_POST['mota_cn']);
        $mota_vi = $this->processData($_POST['mota_vi']); 
        $mota_en = $this->processData($_POST['mota_en']);
        $content_cn = $_POST['content_cn'];
        $content_vi = $_POST['content_vi']; 
        $content_en = $_POST['content_en'];
        $title_alias = $this->changeTitle($title_vi);
        $HinhDaiDien=$_POST['url_images'];
        $idloai = $_POST['idloai'];

        $sql = "UPDATE article
					SET id_loai='$idloai',title_cn = '$title_cn',title_vi = '$title_vi',title_en = '$title_en',title_alias = '$title_alias',
					MoTa_cn='$mota_cn',MoTa_vi='$mota_vi',MoTa_en='$mota_en',content_cn = '$content_cn',content_vi = '$content_vi',content_en = '$content_en',HinhDaiDien = '$HinhDaiDien'					
					WHERE article_id = $article_id ";
        mysql_query($sql) or die(mysql_error() . $sql);
    }
    function insertDuAn() {
        $idKhuVuc=$_POST['loai_id'];
        $idQuocGia=$_POST['idTL'];
        $cate_id=$_POST['cate_id'];
        $HinhDaiDien=$_POST['url_images'];
        $title_cn = $this->processData($_POST['title_cn']);
        $title_vi = $this->processData($_POST['title_vi']);
        $title_en = $this->processData($_POST['title_en']); 
         $content_cn = $_POST['content_cn'];
        $content_vi = $_POST['content_vi']; 
        $content_en = $_POST['content_en']; 
        $title_alias = $this->changeTitle($title_vi);

        $sql = "INSERT INTO duan VALUES(NULL,'$cate_id','$title_cn','$title_vi','$title_en','$title_alias','$HinhDaiDien','$content_cn','$content_vi','$content_en','$idQuocGia','$idKhuVuc'
								
								)";
        mysql_query($sql) or die(mysql_error() . $sql);
    }
    function updateDuAn($duan_id) {
        $idKhuVuc=$_POST['loai_id'];
        $idQuocGia=$_POST['idTL'];
        $cate_id=$_POST['cate_id'];
        $HinhDaiDien=$_POST['url_images'];
        $title_cn = $this->processData($_POST['title_cn']);
        $title_vi = $this->processData($_POST['title_vi']);
        $title_en = $this->processData($_POST['title_en']); 
        $content_cn = $_POST['NoiDung_cn'];
        $content_vi = $_POST['NoiDung_vi']; 
        $content_en = $_POST['NoiDung_en']; 
        $title_alias = $this->changeTitle($title_vi);

        echo $sql = "UPDATE duan
					SET cate_id='$cate_id', TenDuAn_cn = '$title_cn',TenDuAn_vi = '$title_vi',TenDuAn_en = '$title_en',title_alias = '$title_alias',
					NoiDung_cn = '$content_cn',NoiDung_vi = '$content_vi',NoiDung_en = '$content_en',HinhDaiDien = '$HinhDaiDien',idQuocGia='$idQuocGia',idKhuVuc='$idKhuVuc'					
					WHERE idDuAn = $duan_id ";
        mysql_query($sql) or die(mysql_error() . $sql);
    }
    

}

?>