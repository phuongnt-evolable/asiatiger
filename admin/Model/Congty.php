<?php

require_once "Db.php";
class Congty extends Db {

    function getListCate($idTL) {
        $sql = "SELECT * FROM category WHERE idTL = $idTL  ORDER BY cate_id";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function getDetailCongTy($congty_id) {
        $sql = "SELECT * FROM congty WHERE congty_id = $congty_id";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function getCongTy($offset = -1, $limit = -1) {
        
         $sql = "SELECT * FROM congty Order by congty_id DESC";
        if ($limit > 0 && $offset >= 0)
             $sql .= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function getCongTyHome() {
        
         $sql = "SELECT * FROM congty Order by congty_id DESC LIMIT 0,3";        
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
     function getCongTyNews() {
        $sql = "SELECT * FROM congty Order by congty_id DESC Limit 0,20";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
    function getListCongTyByCategory( $offset = -1, $limit = -1) {
        $sql = "SELECT * FROM congty ORDER BY congty_id DESC";
        if ($limit > 0 && $offset >= 0)
            $sql .= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function getListCongTyByCategoryAdmin( $offset = -1, $limit = -1) {
        $sql = "SELECT congty_id,TenCT_vi,TenCT_cn,DiaChi_cn,DiaChi_vi,HinhDaiDien FROM congty ORDER BY congty_id DESC";
        if ($limit > 0 && $offset >= 0)
            $sql .= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function getListCongTyChuaNghanh( $offset = -1, $limit = -1) {
        $arrReturn = array();
        
       $sql = "SELECT * FROM cty_cate WHERE cate_id = 0 AND idTL = 0 ORDER BY congty_id DESC   ";  
        if ($limit > 0 && $offset >= 0)
            $sql .= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        while($row = mysql_fetch_assoc($rs)){
            
            $congty_id = $row['congty_id'];
            
            $sql = "SELECT * FROM congty WHERE congty_id = $congty_id" ;
            $rs1 = mysql_query($sql);
            $row1 = mysql_fetch_assoc($rs1);
            $arrReturn[$congty_id]= $row1;
        }
        
        return $arrReturn;
    }
    
    function getListCongTyByTheLoai($cate_id = -1, $offset = -1, $limit = -1) {
       $sql="SELECT * FROM congty,cty_cate WHERE congty.congty_id=cty_cate.congty_id AND cty_cate.cate_id = $cate_id ORDER BY top DESC, HinhDaiDien DESC";
       if ($limit > 0 && $offset >= 0)
           $sql .= " LIMIT $offset,$limit";
       $rs= mysql_query($sql)or die(mysql_error());
       while($row = mysql_fetch_assoc($rs)){
            
            $arrReturn[]= $row;
        }
       return $arrReturn;
    }
    function getListCongTyByTheLoaiAdmin($cate_id = -1, $offset = -1, $limit = -1) {
       $sql="SELECT * FROM congty,cty_cate WHERE congty.congty_id=cty_cate.congty_id AND cty_cate.cate_id = $cate_id ORDER BY top DESC, HinhDaiDien DESC";
       if ($limit > 0 && $offset >= 0)
           $sql .= " LIMIT $offset,$limit";
       $rs= mysql_query($sql)or die(mysql_error());      
       return $rs;
    }
    
    function getListCongTyByTheLoai1($str_cate_id = -1, $offset = -1, $limit = -1) {
        $arrReturn = array();
        
       $sql = "SELECT * FROM cty_cate A,congty B WHERE A.cate_id IN(".$str_cate_id.") AND A.congty_id = B.congty_id  ORDER BY top DESC, HinhDaiDien DESC   "; 
        if ($limit > 0 && $offset >= 0)
            $sql .= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        while($row = mysql_fetch_assoc($rs)){
            
            $congty_id = $row['congty_id'];
            
            $sql = "SELECT * FROM congty WHERE congty_id = $congty_id" ;
            $rs1 = mysql_query($sql);
            $row1 = mysql_fetch_assoc($rs1);
            $arrReturn[$congty_id]= $row1;
        }
        
        return $arrReturn;
    }
    function getListCongTyByQuocGia1($str_cate_id = -1,$idQuocGia = -1, $offset = -1, $limit = -1) {
        $arrReturn = array();
        
        $sql = "SELECT * FROM cty_cate A,congty B WHERE A.cate_id IN(".$str_cate_id.") AND B.idQuocGia = $idQuocGia AND A.congty_id = B.congty_id ORDER BY top DESC, HinhDaiDien DESC   ";  
        if ($limit > 0 && $offset >= 0)
            $sql .= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        while($row = mysql_fetch_assoc($rs)){            
            $congty_id = $row['congty_id'];            
            $sql = "SELECT * FROM congty WHERE congty_id = $congty_id" ;
            $rs1 = mysql_query($sql);
            $row1 = mysql_fetch_assoc($rs1);
            $arrReturn[$congty_id]= $row1;
        }        
        return $arrReturn;
    }
   
    function getCountSumaryCongTyByCondition($tukhoa,$lang,$offset = -1, $limit = -1){
	$sql = "SELECT  COUNT(*) as record_count 
                FROM  congty 
                WHERE  GioiThieu_cn LIKE '%$tukhoa%' or GioiThieu_vi LIKE '%$tukhoa%' or GioiThieu_en LIKE '%$tukhoa%' or TenCT_cn LIKE '%$tukhoa%' or TenCT_vi LIKE '%$tukhoa%' or TenCT_en LIKE '%$tukhoa%' ORDER BY top DESC, HinhDaiDien DESC
		";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
    function getListCongTyByTheLoai_TuKhoa($tukhoa,$lang, $offset = -1, $limit = -1) {
        $sql = "SELECT * FROM congty WHERE  GioiThieu_cn LIKE '%$tukhoa%' or GioiThieu_vi LIKE '%$tukhoa%' or GioiThieu_en LIKE '%$tukhoa%' or TenCT_cn LIKE '%$tukhoa%' or TenCT_vi LIKE '%$tukhoa%' or TenCT_en LIKE '%$tukhoa%' ORDER BY top DESC, HinhDaiDien DESC   ";
        
        if ($limit > 0 && $offset >= 0)
        $sql .= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function getListCongTyByTheLoaiCoImg($cate_id = -1, $offset = -1, $limit = -1) {
        $arrReturn = array();        
         $sql = "SELECT * FROM congty,cty_cate WHERE congty.congty_id=cty_cate.congty_id AND congty.HinhDaiDien!= '' AND cty_cate.cate_id = $cate_id   ORDER BY congty.congty_id DESC ";  
        if ($limit > 0 && $offset >= 0)
           $sql .= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        while($row = mysql_fetch_assoc($rs)){
         $arrResult[] = $row;
        }
         //var_dump("<pre>",$arrResult);die;
        return $arrResult;
    }
    
    
    function getListCongTyByTheLoaiNoImg($cate_id = -1, $offset = -1, $limit = -1) {
         $arrReturn = array();        
         //$sql = "SELECT * FROM cty_cate WHERE cate_id = $cate_id   ORDER BY congty_id DESC   ";
          $sql = "SELECT * FROM congty,cty_cate WHERE congty.congty_id=cty_cate.congty_id AND congty.HinhDaiDien = '' AND cty_cate.cate_id = $cate_id   ";
        if ($limit > 0 && $offset >= 0)
             $sql .= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        while($row = mysql_fetch_assoc($rs)){           
            
            $arrReturn[]= $row;
        }        
        return $arrReturn;
    }    
    
    function getListCongTyByQuocGia($cate_id = -1, $idQuocGia=-1, $offset = -1, $limit = -1) {
        
        
        $arrReturn = array();        
         $sql = "SELECT * 
                 FROM congty,cty_cate 
                 WHERE congty.congty_id=cty_cate.congty_id  AND congty.idQuocGia=$idQuocGia AND cty_cate.cate_id = $cate_id
                 ORDER BY top DESC, HinhDaiDien DESC   ";  
        if ($limit > 0 && $offset >= 0)
            $sql .= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        while($row = mysql_fetch_assoc($rs)){
         $arrResult[] = $row;
        }
         //var_dump("<pre>",$arrResult);die;
        return $arrResult;
        
    }
    
    
    function SanPham_List_TheoLoai($idLoai = -1 , $tukhoa = '') {
        $sql = "SELECT congty_id,congty_name_cn,congty_name_vi,congty_alias,price,url_images FROM congty 
					WHERE category_id = $idLoai";        

        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
    function SanPham_List_TheoTheLoai($idTL = -1 ,$tukhoa = '') {
       $sql = "SELECT congty_id,congty_name_cn,congty_name_vi,congty_alias,url_images,price FROM congty 
					WHERE idTL = $idTL ORDER BY rand( )";        

        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
    function SanPham_List_TheoTheLoai_IDSP($idTL = -1 , $idsp, $tukhoa = '') {
       $sql = "SELECT congty_id,congty_name_cn,congty_name_vi,congty_alias,url_images FROM congty 
					WHERE idTL = $idTL AND congty_id <> $idsp ORDER BY rand( )";        

        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
    function getIDCongTyByTenKD($Ten_KD) {
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
    function insertCongTy() {
        $category_id = (int) $_POST['category_id'];
       // $vip=$this->processData($_POST['vip']);
        $top=$this->processData($_POST['top']);
        $ten_cty_cn = $this->processData($_POST['ten_cty_cn']);
        $ten_cty_vi = $this->processData($_POST['ten_cty_vi']);
        $ten_cty_en = $this->processData($_POST['ten_cty_en']);
        $quocgia = $this->processData($_POST['quocgia']);
        $diachi_cn = $this->processData($_POST['diachi_cn']);
        $diachi_vi = $this->processData($_POST['diachi_vi']);
        $diachi_en = $this->processData($_POST['diachi_en']);
        $nguoilienhe = $this->processData($_POST['nguoilienhe']); 
        $didong = $this->processData($_POST['didong']); 
        $dienthoai = $this->processData($_POST['dienthoai']); 
        $fax = $this->processData($_POST['fax']); 
        $email = $this->processData($_POST['email']); 
        $website = $this->processData($_POST['website']); 
        $url_images = $this->processData($_POST['url_images']);
        $mota_cn = $this->processData($_POST['gioithieu_cn']);
        $mota_vi = $this->processData($_POST['gioithieu_vi']);
        $mota_en= $this->processData($_POST['gioithieu_en']);        
        $gioithieu_cn = $_POST['gioithieu_cn'];
        $gioithieu_vi = $_POST['gioithieu_vi'];
        $gioithieu_en= $_POST['gioithieu_en'];
        $spchinh=$_POST['spchinh'];
        $congty_name_alias = $this->changeTitle($ten_cty_vi);
       

        $sql = "INSERT INTO congty	VALUES(NULL,$top,'$ten_cty_cn','$ten_cty_vi','$ten_cty_en','$congty_name_alias','$nguoilienhe','$category_id','$quocgia','$diachi_cn','$diachi_vi','$diachi_en','$dienthoai','$didong','$fax','$email','$website','$mota_cn','$mota_vi','$mota_en','$gioithieu_cn','$gioithieu_vi','$gioithieu_en','$url_images','$spchinh')";
        mysql_query($sql) or die(mysql_error() . $sql);
    }

    function updateCongTy($congty_id) {
        $category_id = (int) $_POST['category_id'];
        //$vip=$this->processData($_POST['vip']);
        $top=$this->processData($_POST['top']);
        $ten_cty_cn = $this->processData($_POST['ten_cty_cn']);
        $ten_cty_vi = $this->processData($_POST['ten_cty_vi']);
        $ten_cty_en = $this->processData($_POST['ten_cty_en']);
        $quocgia = $this->processData($_POST['quocgia']);
        $diachi_cn = $this->processData($_POST['diachi_cn']);
        $diachi_vi = $this->processData($_POST['diachi_vi']);
        $diachi_en = $this->processData($_POST['diachi_en']);
        $nguoilienhe = $this->processData($_POST['nguoilienhe']); 
        $didong = $this->processData($_POST['didong']); 
        $dienthoai = $this->processData($_POST['dienthoai']); 
        $fax = $this->processData($_POST['fax']); 
        $email = $this->processData($_POST['email']); 
        $website = $this->processData($_POST['website']);
        $url_images = $this->processData($_POST['url_images']); 
        $mota_cn = $this->processData($_POST['gioithieu_cn']);
        $mota_vi = $this->processData($_POST['gioithieu_vi']);
        $mota_en= $this->processData($_POST['gioithieu_en']);  
        $gioithieu_cn = $_POST['gioithieu_cn'];
        $gioithieu_vi = $_POST['gioithieu_vi'];
        $gioithieu_en= $_POST['gioithieu_en'];
         $spchinh=$_POST['spchinh'];
        $congty_name_alias = $this->changeTitle($ten_cty_vi);

        $sql = "UPDATE congty
					SET  top='$top', TenCT_cn = '$ten_cty_cn',TenCT_vi = '$ten_cty_vi',TenCT_en = '$ten_cty_en',ten_khong_dau='$congty_name_alias',NguoiLienHe='$nguoilienhe',idQuocGia='$quocgia',DiaChi_cn = '$diachi_cn',DiaChi_vi = '$diachi_vi',DiaChi_en = '$diachi_en',DiDong='$didong',DienThoai = '$dienthoai',Fax = '$fax',Email = '$email',Website = '$website',MoTa_cn = '$mota_cn',MoTa_vi = '$mota_vi',MoTa_en = '$mota_en',GioiThieu_cn = '$gioithieu_cn',GioiThieu_vi = '$gioithieu_vi',GioiThieu_en = '$gioithieu_en',HinhDaiDien = '$url_images',cate_id = '$category_id',SanPhamChinh='$spchinh'
					WHERE congty_id = $congty_id ";
        mysql_query($sql) or die(mysql_error() . $sql);
    }

    function khachhang_list() {
        $sql = "SELECT * FROM user WHERE id_Group = 2  ";       
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function khachhang_chitiet($id) {
        $sql = "SELECT * FROM khachhang WHERE idKH= $id";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function khachhang_edit($id) {
       
        $fullname = $this->processData($_POST['hoten']); 
        $email = $this->processData($_POST['email']); 
        $dienthoai = $this->processData($_POST['dienthoai']); 
        $diachi = $this->processData($_POST['diachi']); 
        $day = $this->processData($_POST['day']); 
        $month = $this->processData($_POST['month']); 
         $year = $this->processData($_POST['year']); 
        $ngaysinh = $day . "/" . $month . "/" . $year;

        $sql = "UPDATE khachhang SET hoten = '$fullname', email  = '$email', dienthoai = '$dienthoai', diachi = '$diachi',ngaysinh='$ngaysinh' WHERE idKH = $id";
        mysql_query($sql) or die(mysql_error() . $sql);
    }
     function khachhang_them() {

        $fullname = $this->processData($_POST['hoten']); 
        $email = $this->processData($_POST['email']); 
        $dienthoai = $this->processData($_POST['dienthoai']); 
        $diachi = $this->processData($_POST['diachi']); 
        $ngaysinh = $this->processData($_POST['ngaysinh']); 
        $pass = md5($this->processData($_POST['pass'])); 

        $sql = "INSERT INTO khachhang
                    VALUES(NULL,'$fullname','$email','$pass','$dienthoai','$diachi','$ngaysinh','','','','')";
        mysql_query($sql) or die(mysql_error() . $sql);
    }

}

?>
