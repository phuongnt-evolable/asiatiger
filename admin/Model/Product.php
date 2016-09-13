<?php

require_once "Db.php";
class Product extends Db {

    function getDetailProduct($product_id) {
        $sql = "SELECT * FROM product WHERE product_id = $product_id";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function getProduct($offset = -1, $limit = -1) {
        
         $sql = "SELECT * FROM product Order by product_id DESC";
        if ($limit > 0 && $offset >= 0)
            $sql .= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
     function getProductByTuKhoa($tukhoa,$lang,$offset = -1, $limit = -1) {
        
         $sql = "SELECT * FROM product WHERE product_name_en LIKE '%$tukhoa%' OR product_name_vi LIKE '%$tukhoa%' OR product_name_cn LIKE '%$tukhoa%' Order by product_id DESC";
        /*if($lang=='vi'){
            $sql .= " OR MoTa_vi LIKE '%$tukhoa%' ";             
        }elseif ($lang=='cn') {
            $sql .= " OR MoTa_cn LIKE '%$tukhoa%' "; 
        }  else {
            $sql .= " OR MoTa_en LIKE '%$tukhoa%' "; 
        }*/
        
        if ($limit > 0 && $offset >= 0)
            $sql .= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function getProductByTuKhoaAndCty_id($tukhoa,$cty_id,$offset = -1, $limit = -1) {
        
       $sql = "SELECT * FROM product WHERE (product_name_en LIKE '%$tukhoa%' OR product_name_vi LIKE '%$tukhoa%' OR product_name_cn LIKE '%$tukhoa%') AND congty_id = $cty_id Order by product_id DESC";
        if ($limit > 0 && $offset >= 0)
            $sql .= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function getProductHome_right() {
        
         $sql = "SELECT * FROM product p,congty ct WHERE p.congty_id = ct.congty_id AND ct.ShopVip=1 Order by p.product_id DESC LIMIT 0,8";        
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function getProductHome_left() {
        
         $sql = "SELECT * FROM product p,congty ct WHERE p.congty_id = ct.congty_id AND ct.ShopVip=0 Order by p.product_id DESC LIMIT 0,8";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }

    function getProductHome() {

        $sql = "SELECT * FROM product  ORDER BY RAND()   LIMIT 0,8";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
    function getProductByCongTyAndCate($congty_id,$cate_id) {
        
         $sql = "SELECT * FROM product WHERE congty_id=$congty_id AND category_id=$cate_id";        
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function getProductByCongTyAndCungLoai($congty_id,$product_id,$cate_id) {
        
          $sql = "SELECT * FROM product WHERE product_id <>$product_id AND category_id=$cate_id AND congty_id=$congty_id";        
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
    function getProductByCTy($congty_id) {
        $arrResult = array();    
        $sql = "SELECT * FROM product Where congty_id=$congty_id Order by product_id DESC ";        
         $rs = mysql_query($sql) or die(mysql_error());
        while($row = mysql_fetch_assoc($rs)){
         $arrResult[] = $row;
        }
         //var_dump("<pre>",$arrResult);die;
        return $arrResult;
    }
    
     function getProductNews( $offset = -1, $limit = -1) {
        $sql = "SELECT * FROM product Order by product_id DESC";
        if ($limit > 0 && $offset >= 0)
            $sql .= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
    function getListProductByCategory( $offset = -1, $limit = -1) {
        $sql = "SELECT * FROM product ORDER BY product_id DESC";
        if ($limit > 0 && $offset >= 0)
            $sql .= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function getListProductByTheLoai($idTL = -1, $offset = -1, $limit = -1) {
        $sql = "SELECT * FROM product WHERE category_id = $idTL   OR idTL = -1 ";  
        if ($limit > 0 && $offset >= 0)
            $sql .= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
    function SanPham_List_TheoLoai($idLoai = -1 , $tukhoa = '') {
        $sql = "SELECT product_id,product_name_cn,product_name_vi,product_alias,price,url_images FROM product 
					WHERE category_id = $idLoai";        

        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
    function SanPham_List_TheoTheLoai($idTL = -1 ,$tukhoa = '') {
       $sql = "SELECT product_id,product_name_cn,product_name_vi,product_alias,url_images,price FROM product 
					WHERE idTL = $idTL ORDER BY rand( )";        

        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
    function SanPham_List_TheoTheLoai_IDSP($idTL = -1 , $idsp, $tukhoa = '') {
       $sql = "SELECT product_id,product_name_cn,product_name_vi,product_alias,url_images FROM product 
					WHERE idTL = $idTL AND product_id <> $idsp ORDER BY rand( )";        

        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
    function getIDProductByTenKD($Ten_KD) {
        $sql = "SELECT cate_id FROM category WHERE cate_alias='$Ten_KD'";       
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }

    function getDetailCate($cate_id){
        $sql = "SELECT * FROM category WHERE cate_id = $cate_id";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function getIDTL($category_id){
        $sql1="SELECT idTL from category Where cate_id=$category_id";
        $rs = mysql_query($sql1) or die(mysql_error());
        return $rs;
    }
    function insertProduct() {
        $category_id = (int) $_POST['category_id'];
        $a=  $this->getIDTL($category_id);
        $row=  mysql_fetch_assoc($a);
        $idTL=$row['idTL'];
        $congty_id=(int) $_POST['dscty'];
        $product_name_cn = $this->processData($_POST['product_name_cn']);
        $product_name_vi = $this->processData($_POST['product_name_vi']);
        $product_name_en = $this->processData($_POST['product_name_en']);
        $price = $_POST['price'];        
        $url_images = $this->processData($_POST['url_images']);
        $mota_cn = $this->processData($_POST['mota_cn']);
        $mota_vi = $this->processData($_POST['mota_vi']);
        $mota_en = $this->processData($_POST['mota_en']);
        $content_cn = $_POST['content_cn'];
        $content_vi = $_POST['content_vi'];
        $content_en = $_POST['content_en'];
        $loai_hinh = $_POST['loai_hinh'];
        $product_name_alias = $this->changeTitle($product_name_vi);
       

      $sql = "INSERT INTO product	VALUES(NULL,'$product_name_cn','$product_name_vi','$product_name_en','$product_name_alias','$price','$url_images','$mota_cn','$mota_vi','$mota_en','$content_cn','$content_vi','$content_en','$congty_id','$category_id','$idTL','$loai_hinh')";
        mysql_query($sql) or die(mysql_error() . $sql);
    }

    function updateProduct($product_id) {
        $category_id = (int) $_POST['category_id'];
        $a=  $this->getIDTL($category_id);
        $row=  mysql_fetch_assoc($a);
        $idTL=$row['idTL'];
        $congty_id=(int) $_POST['dscty'];
       $product_name_cn = $this->processData($_POST['product_name_cn']);
        $product_name_vi = $this->processData($_POST['product_name_vi']);
        $product_name_en = $this->processData($_POST['product_name_en']);
        $price = $_POST['price'];       
        $url_images = $this->processData($_POST['url_images']);
        $mota_cn = $this->processData($_POST['mota_cn']);
        $mota_vi = $this->processData($_POST['mota_vi']);
        $mota_en = $this->processData($_POST['mota_en']);
        $content_cn = $_POST['content_cn'];
        $content_vi = $_POST['content_vi'];
        $content_en = $_POST['content_en'];
         $loai_hinh = $_POST['loai_hinh'];
        $product_name_alias = $this->changeTitle($product_name_vi);

        $sql = "UPDATE product
					SET product_name_cn = '$product_name_cn',product_name_vi = '$product_name_vi',product_name_en = '$product_name_en',product_alias = '$product_name_alias',
                                            price = '$price',MoTa_cn = '$mota_cn',MoTa_vi = '$mota_vi',MoTa_en = '$mota_en',content_cn = '$content_cn',content_vi = '$content_vi',content_en = '$content_en',
					category_id = '$category_id',idTL='$idTL',congty_id='$congty_id',LoaiHinh='$loai_hinh'";
					if($url_images!=''){
						$sql.=" ,url_images = '$url_images' ";
					}
					$sql.="WHERE product_id = $product_id ";
        mysql_query($sql) or die(mysql_error() . $sql);
    }

}

?>