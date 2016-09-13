<?php 
require_once "../Model/Db.php";
class danhmuc extends db{	
	
	function DanhMuc_ChiTiet($idDM){
		$sql = "SELECT * FROM danhmuc WHERE idDM = $idDM";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function LayTenDanhMuc($idDM){
		$sql = "SELECT DanhMuc FROM danhmuc WHERE idDM = $idDM";
		$rs = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($rs);
		return $row['DanhMuc'];
	}
	function isSach($idML){
		$sql = "SELECT idTG FROM sach WHERE idML = $idML LIMIT 0,1";
		$rs = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($rs);
		$idTG =  $row['idTG'];
		if($idTG > 0) return true;
		else return false;
	}
	function DanhMuc_List_Sach($idSach){
		$sql = "SELECT * FROM danhmuc WHERE idSach = $idSach ORDER BY thutu ASC";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function DanhMuc_Them(&$loi){		
		$thanhcong=true;
			
		$idSach = (int) $_POST['idSach'];
		$idML = (int) $_POST['idML'];
		if($idSach == 0) $thanhcong=false;
		$DanhMuc= $this->processData($_POST['DanhMuc']);
		$thutu = $this->countMucLuc($idSach);
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "INSERT INTO danhmuc
					VALUES(NULL,'$DanhMuc',$idSach,$idML,$thutu,0,0)";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
	}
        function countMucLuc($idSach){
            $sql = "SELECT idDM FROM danhmuc WHERE idSach = $idSach";
            $rs = mysql_query($sql);
            $row = mysql_num_rows($rs);
            if($row==0) return 1;
            else{
                $query = "SELECT MAX(thutu) as thutumax FROM danhmuc WHERE idSach = $idSach";
                $result = mysql_query($query);
                $row = mysql_fetch_assoc($result);
                return $row['thutumax']+1;
            }
        }
	function DanhMuc_Sua($idDM,&$loi){			
		$thanhcong=true;		
		$idSach = (int) $_POST['idSach'];
		$idML = (int) $_POST['idML'];
		if($idSach == 0) $thanhcong=false;
		$DanhMuc= $this->processData($_POST['DanhMuc']);
		
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "UPDATE danhmuc
					SET DanhMuc = '$DanhMuc',idSach = $idSach ,idML = $idML WHERE idDM = $idDM";
			mysql_query($sql) or die(mysql_error().$sql);			
		}
		return $thanhcong;
	}
	
	function DanhMuc_List($idML=-1,$idSach=-1, $limit = -1 ,$offset=-1){		
		$sql = "SELECT * FROM danhmuc WHERE idDM > 0 ";
		if($idML > 0 ) $sql.=" AND idML = $idML "; 		
		if($idSach > 0 ) $sql .= " AND idSach = $idSach ";
		$sql.="ORDER BY thutu ASC ";
		if($limit > 0 && $offset >=0) $sql .= "LIMIT $offset,$limit";

		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}	
        function danhmuc_next($idDM,$idSach){
            $chitiet_dm = $this->DanhMuc_ChiTiet($idDM);
            $row_chitiet_dm = mysql_fetch_assoc($chitiet_dm);
            $thutu_dm_hientai = $row_chitiet_dm['thutu'];
            $sql = "SELECT idDM FROm danhmuc WHERE thutu > $thutu_dm_hientai AND idSach = $idSach ORDER BY thutu ASC LIMIT 0,1";
            $rs = mysql_query($sql);
            if(mysql_num_rows($rs)==1){
                $row = mysql_fetch_assoc($rs);
                return $row['idDM'];
            }else{
                return $idDM;
            }
            
        }
        function thutu_mucluc_hientai($idDM) {
        $sql = "SELECT thutu FROM danhmuc WHERE idDM = $idDM";
        $rs = mysql_query($sql);
        $row = mysql_fetch_assoc($rs);
        return $row['thutu'];
    }
        
        function danhmuc_pre($idDM,$idSach){
            $chitiet_dm = $this->DanhMuc_ChiTiet($idDM);
            $row_chitiet_dm = mysql_fetch_assoc($chitiet_dm);
            $thutu_dm_hientai = $row_chitiet_dm['thutu'];
            $sql = "SELECT idDM FROm danhmuc WHERE thutu < $thutu_dm_hientai AND idSach = $idSach ORDER BY thutu DESC LIMIT 0,1";
            $rs = mysql_query($sql);
            if(mysql_num_rows($rs)==1){
                $row = mysql_fetch_assoc($rs);
                return $row['idDM'];
            }else{
                return $idDM;
            }
            
        }
        
}

?>