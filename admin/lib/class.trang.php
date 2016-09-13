<?php

require_once "../Model/Db.php";

class trang extends db {

    function Trang_List($idML = -1, $idSach = -1, $idDM = -1, $limit = -1, $offset = -1) {
        $sql = "SELECT * FROM trang WHERE idTrang > 0 ";
        if ($idML > 0)
            $sql.=" AND idML = $idML ";
        if ($idSach > 0)
            $sql .= " AND idSach = $idSach ";
        if ($idDM > 0)
            $sql .= " AND idDM = $idDM ";
        $sql.=" ORDER BY idTrang ASC ";
        if ($limit > 0 && $offset >= 0)
            $sql.= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function trang_list_theo_user($idML = -1, $idSach = -1, $idDM = -1, $limit = -1, $offset = -1) {
        if($_SESSION['email']!='hoangnh@vnbet.vn' ){
        $sql = "SELECT * FROM trang WHERE idTrang > 0 AND idUser = ".$_SESSION['user_id'] ." ";
        }else{
            $sql = "SELECT * FROM trang WHERE idTrang > 0 ";
        }
        if ($idML > 0)
            $sql.=" AND idML = $idML ";
        if ($idSach > 0)
            $sql .= " AND idSach = $idSach ";
        if ($idDM > 0)
            $sql .= " AND idDM = $idDM ";
        $sql.=" ORDER BY idSach DESC,ThuTu DESC ";
        if ($limit > 0 && $offset >= 0)
            $sql.= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }

    function Error_List($limit = -1, $offset = -1) {
        $sql = "SELECT * FROM trang WHERE idDM NOT IN (SELECT idDM FROM danhmuc) ";
        $sql.=" ORDER BY idTrang ASC ";
        if ($limit > 0 && $offset >= 0)
            $sql.= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }

    function DanhMuc_List($idML = -1, $idSach = -1, $limit = -1, $offset = -1) {
        $sql = "SELECT * FROM danhmuc WHERE idDM > 0 ";
        if ($idML > 0)
            $sql.=" AND idML = $idML ";
        if ($idSach > 0)
            $sql .= " AND idSach = $idSach ";
        $sql.="ORDER BY idDM DESC ";
        if ($limit > 0 && $offset >= 0)
            $sql .= "LIMIT $offset,$limit";

        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }

    function Trang_Them(&$loi) {

        $thanhcong = true;
        $idSach = (int) $_POST['idSach'];

        $idDM = (int) $_POST['idDM'];

        $idML = (int) $_POST['idML'];

        $GhiChu = $this->processData($_POST['GhiChu']);
        $NoiDung = $_POST['NoiDung'];
        $user_id = $_SESSION['user_id'];



        if ($thanhcong == false) {
            return $thanhcong;
        } else {
            $sql = "INSERT INTO trang
					VALUES(NULL,'$NoiDung',$idDM,$idSach,'$GhiChu','',$idML,$user_id)";
            mysql_query($sql) or die(mysql_error() . $sql);

            $sql2 = "SELECT * FROM danhmuc WHERE idDM= $idDM";
            $rs2 = mysql_query($sql2) or die(mysql_error());
            $row2 = mysql_fetch_assoc($rs2);
            $thutu = $row2['thutu'];

            $idSach = $row2['idSach'];

            mysql_query("UPDATE danhmuc SET status = 0 WHERE thutu >= $thutu AND idSach = $idSach") or die(mysql_error());
        }
        return $thanhcong;
    }

    function Trang_Sua($idTrang, &$loi) {

        $thanhcong = true;

        $idSach = (int) $_POST['idSach'];
        $idDM = (int) $_POST['idDM'];
        $idML = (int) $_POST['idML'];

        $GhiChu = $this->processData($_POST['GhiChu']);
        $NoiDung = $_POST['NoiDung'];

        if ($thanhcong == false) {
            return $thanhcong;
        } else {
            $sql = "UPDATE trang
					SET NoiDung = '$NoiDung',
					idDM = $idDM,
					idSach = $idSach,
					GhiChu = '$GhiChu',
                                        idML = $idML
					WHERE idTrang = $idTrang";
            mysql_query($sql) or die(mysql_error() . $sql);
        }
        return $thanhcong;
    }

    function Trang_ChiTiet($idTrang) {
        $sql = "SELECT * FROM trang WHERE idTrang = $idTrang";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function trang_pre($idTrang,$idDM){        
        $chitiet_trang = $this->Trang_ChiTiet($idTrang);
        $row_chitiet_trang = mysql_fetch_assoc($chitiet_trang);
        $thutu_trang_hientai = $row_chitiet_trang['ThuTu'];
        $sql = "SELECT idTrang FROM trang WHERE ThuTu < $thutu_trang_hientai AND idDM = $idDM ORDER BY ThuTu DESC LIMIT 0,1";
        $rs = mysql_query($sql) or die($sql);
        if(mysql_num_rows($rs)==1){
            $row = mysql_fetch_assoc($rs);
            return $row['idTrang'];
        }else{
            return $idTrang;
        }

    }
    function trang_next($idTrang,$idDM){        
        $chitiet_trang = $this->Trang_ChiTiet($idTrang);
        $row_chitiet_trang = mysql_fetch_assoc($chitiet_trang);
        $thutu_trang_hientai = $row_chitiet_trang['ThuTu'];
        $sql = "SELECT idTrang FROM trang WHERE ThuTu > $thutu_trang_hientai AND idDM = $idDM ORDER BY ThuTu ASC LIMIT 0,1";
        $rs = mysql_query($sql) or die($sql);
        if(mysql_num_rows($rs)==1){
            $row = mysql_fetch_assoc($rs);
            return $row['idTrang'];
        }else{
            return $idTrang;
        }

    }
    function thutu_trang_hientai($idTrang) {
        $sql = "SELECT ThuTu FROM trang WHERE idTrang = $idTrang";
        $rs = mysql_query($sql)  or die($sql);
        $row = mysql_fetch_assoc($rs);
        return $row['ThuTu'];
    }
    function getIdTrang_theothutu($thutu,$idDM) {
        $sql = "SELECT idTrang FROM trang WHERE ThuTu = $thutu AND idDM = $idDM";
        $rs = mysql_query($sql) or die($sql);
        $row = mysql_fetch_assoc($rs);
        return $row['idTrang'];
    }
    function thutu_trang_max($idDM) {
        $sql = "SELECT max(ThuTu) as thutumax FROM trang WHERE idDM = $idDM";
        $rs = mysql_query($sql)  or die($sql);

        $row = mysql_fetch_assoc($rs);
        return $row['thutumax'];
    }   
    function thutu_trang_min($idDM) {
        $sql = "SELECT max(ThuTu) as thutumin FROM trang WHERE idDM = $idDM";
        $rs = mysql_query($sql)  or die($sql);

        $row = mysql_fetch_assoc($rs);
        return $row['thutumin'];
    }   
    
    function getIdMin($idDM){
        $sql = "SELECT MIN(idTrang) as minid FROM trang WHERE idDM = $idDM ";
        $result = mysql_query($sql) or die($sql.mysql_error());
        $row = mysql_fetch_assoc($result);
        return $row['minid'];
    }
     function getIdMax($idDM){
        $sql = "SELECT MAX(idTrang) as maxid FROM trang WHERE idDM = $idDM ";
        $result = mysql_query($sql) or die($sql.mysql_error());
        $row = mysql_fetch_assoc($result);
        return $row['maxid'];
    }
    function getIdNext($idDM,$idTrang){
        $sql = "SELECT idTrang FROM trang WHERE idDM = $idDM AND idTrang > $idTrang  ORDER BY idTrang ASC LIMIT 0,1 ";
        $result = mysql_query($sql) or die($sql.mysql_error());
        $row = mysql_fetch_assoc($result);
        return $row['idTrang'];
    }
    function getIdPre($idDM,$idTrang){
        $sql = "SELECT idTrang FROM trang WHERE idDM = $idDM AND idTrang < $idTrang ORDER BY idTrang DESC LIMIT 0,1 ";
        $result = mysql_query($sql) or die($sql.mysql_error());
        $row = mysql_fetch_assoc($result);
        return $row['idTrang'];
    }

}

?>