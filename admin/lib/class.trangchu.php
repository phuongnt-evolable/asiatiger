<?php 
require_once "../Model/Db.php";
class trangchu extends db{
    public function chitiet_trang($idTrang){
        $rs = mysql_query("SELECT * FROM trang WHERE idTrang = $idTrang") or die(mysql_error());
        return $rs;
    }
    function getIdTrangMin($idDM){
        $sql="SELECT idTrang FROM danhmuc WHERE idDM = $idDM";
        $rs = mysql_query($sql);
        $row = mysql_fetch_assoc($rs);       
        return $row['idTrang'];       
    }
    function getIdTrang_theothutu($thutu,$idDM) {
        $sql = "SELECT idTrang FROM trang WHERE ThuTu = $thutu AND idDM = $idDM";
        $rs = mysql_query($sql) or die($sql);
        $row = mysql_fetch_assoc($rs);
        return $row['idTrang'];
    }
    function List_Sach($idML){
        $sql = "SELECT * FROM sach WHERE idML = $idML AND status = 1 ORDER BY thutu ASC";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function trang_next($idTrang,$thutu,$idDM){               
        $sql = "SELECT idTrang FROM trang WHERE ThuTu > $thutu AND idDM = $idDM ORDER BY ThuTu ASC LIMIT 0,1";
        $rs = mysql_query($sql) or die($sql);
        if(mysql_num_rows($rs)==1){
            $row = mysql_fetch_assoc($rs);
            return $row['idTrang'];
        }else{
            return $idTrang;
        }

    }
    function getidMLMin_sach($idSach){
        $rs = mysql_query("SELECT idDM FROM danhmuc WHERE idSach = $idSach AND thutu = 1");
        $row = mysql_fetch_assoc($rs);
        $rs2 = "SELECT * FROM danhmuc WHERE idDM =" .$row['idDM'];
        $rs2 = mysql_query($rs2);
        return $rs2;
    }
    function MucLuc_List($idML = -1){		
        $sql = "SELECT * FROM mucluc WHERE idML = $idML or $idML = - 1 ORDER BY  idML DESC ";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }
    function trang_pre($idTrang,$thutu,$idDM){             
        $sql = "SELECT idTrang FROM trang WHERE ThuTu < $thutu AND idDM = $idDM ORDER BY ThuTu DESC LIMIT 0,1";
        $rs = mysql_query($sql) or die($sql);
        if(mysql_num_rows($rs)==1){
            $row = mysql_fetch_assoc($rs);
            return $row['idTrang'];
        }else{
            return $idTrang;
        }
    }
    function chitiet_mucluc($idML){
        $rs = mysql_query("SELECT * FROM danhmuc WHERE idDM = $idML") or die(mysql_error());
        return $rs;
    }
    function TongSoTrangTrongMucLuc($idML){
		$sql = "SELECT count(*) as tong FROM trang WHERE idDM = $idML";
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		return $row['tong'];
	}    
    function mucluc_next($idDM,$thutu,$idSach){       
        $sql = "SELECT idDM FROm danhmuc WHERE thutu > $thutu AND idSach = $idSach ORDER BY thutu ASC LIMIT 0,1";
        $rs = mysql_query($sql);
        if(mysql_num_rows($rs)==1){
            $row = mysql_fetch_assoc($rs);
            return $row['idDM'];
        }else{
            return $idDM;
        }

    }    
    function mucluc_pre($idDM,$thutu,$idSach){       
        $sql = "SELECT idDM FROm danhmuc WHERE thutu < $thutu AND idSach = $idSach ORDER BY thutu DESC LIMIT 0,1";
        $rs = mysql_query($sql);
        if(mysql_num_rows($rs)==1){
            $row = mysql_fetch_assoc($rs);
            return $row['idDM'];
        }else{
            return $idDM;
        }
    }
    function Sach_ChiTiet($idSach){
        $sql = "SELECT * FROM sach WHERE idSach = $idSach";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }    
    function getTenTacGia($idTG){
        $sql = "SELECT TacGia FROM tacgia WHERE idTG = $idTG ";
        $rs = mysql_query($sql) or die(mysql_error());
        $row = mysql_fetch_assoc($rs);
        return $row['TacGia'];
    }
    function getTenMucLuc($idDM){
        $sql = "SELECT DanhMuc FROM danhmuc WHERE idDM = $idDM ";
        $rs = mysql_query($sql) or die(mysql_error());
        $row = mysql_fetch_assoc($rs);
        return $row['DanhMuc'];
    }
    function thutu_trang_max($idDM) {
        $sql = "SELECT max(ThuTu) as thutumax FROM trang WHERE idDM = $idDM";
        $rs = mysql_query($sql)  or die($sql);

        $row = mysql_fetch_assoc($rs);
        return $row['thutumax'];
    }   
    function thutu_trang_min($idDM) {
        $sql = "SELECT min(ThuTu) as thutumin FROM trang WHERE idDM = $idDM";
        $rs = mysql_query($sql)  or die($sql);

        $row = mysql_fetch_assoc($rs);
        return $row['thutumin'];
    }  
	
}

?>