<?php

require_once "Db.php";

class Quocgia extends Db {

    function getListQuocGia($idTL) {
        $sql = "SELECT * FROM quocgia WHERE idTL = $idTL  ORDER BY idQuocGia";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
        
    
    function getAllQuocGia() {
        $sql = "SELECT * FROM quocgia   ORDER BY idQuocGia DESC ";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    
    function getAllTL() {
        $sql = "SELECT * FROM theloai   ORDER BY idTL ";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }

    function insertQuocGia() {
        //$parent_id = (int) $_POST['parent_id'];
        $qg_name_cn = $this->processData($_POST['qg_name_cn']);
        $qg_name_vi = $this->processData($_POST['qg_name_vi']);
        $qg_name_en = $this->processData($_POST['qg_name_en']);
        $ma_vung = $this->processData($_POST['ma_vung']);
        //$update_time = time(); 
        $ten_alias = $this->changeTitle($qg_name_vi);

        $sql = "INSERT INTO quocgia VALUES(NULL,'$qg_name_cn','$qg_name_vi','$qg_name_en','$ten_alias','$ma_vung')";								
        mysql_query($sql) or die(mysql_error() . $sql);
    }
    function updateQuocGia($idQuocGia) {
       // $parent_id = (int) $_POST['parent_id'];

        $qg_name_cn = $this->processData($_POST['qg_name_cn']);
        $qg_name_vi = $this->processData($_POST['qg_name_vi']);
        $qg_name_en = $this->processData($_POST['qg_name_en']);
        $ma_vung = $this->processData($_POST['ma_vung']);

        //$update_time = time();         
        
        $ten_alias = $this->changeTitle($qg_name_vi);

        echo $sql = "UPDATE quocgia
                SET TenQuocGia_cn = '$qg_name_cn',TenQuocGia_vi = '$qg_name_vi',TenQuocGia_en = '$qg_name_en',ten_alias = '$ten_alias',MaVung='$ma_vung'
                					
                WHERE idQuocGia = $idQuocGia ";
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
    function getDetailQuocGia($idQuocGia){
        $sql = "SELECT * FROM quocgia WHERE idQuocGia = $idQuocGia";
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

    /**
     * @param array $condition
     * @return resource
     */
    public function getListQuocGiaByCondition(array $condition){
        $sql = "SELECT COUNT( b.idQuocGia ) as total , b . *
                FROM congty a, quocgia b, cty_cate c
                WHERE a.idQuocGia = b.idQuocGia
                AND a.congty_id = c.congty_id";
        if (!empty($condition['idTL'])){
            $sql .= " AND c.idTL =".$condition['idTL'];
        }

        // Position this condition should put last, because it can cause error data
        if (!empty($condition['nha_dau_tu']) && $condition['nha_dau_tu'] == 1){
            $sql .= " AND a.NhaDauTu = b.idQuocGia";
        }
        $sql .= " GROUP BY a.idQuocGia";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
}

?>