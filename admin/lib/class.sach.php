<?php 
require_once "../Model/Db.php";
class sach extends db{	
	
	function LayTenSach($idSach){
		$sql = "SELECT * FROM sach WHERE idSach = $idSach";
		$rs = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($rs);
		return $row[TenSach];
	}
	function List_Sach($idML){
		$sql = "SELECT * FROM sach WHERE idML = $idML AND status = 1 ORDER BY thutu ASC";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
        function List_Sach_All($idML){
		$sql = "SELECT * FROM sach WHERE idML = $idML ORDER BY thutu DESC";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function getTenTacGia($idTG){
		$sql = "SELECT * FROM tacgia WHERE idTG = $idTG ";
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
        function getIdTrangMin($idDM){
            $sql="SELECT MIN(ThuTu) as thutumin FROM trang WHERE idDM = $idDM";
            $rs = mysql_query($sql);
            $row = mysql_fetch_assoc($rs);
            $thutumin = $row['thutumin'];
            if($thutumin>0){
            $sql1="SELECT idTrang FROM trang WHERE idDM = $idDM AND ThuTu = $thutumin";
            $rs1 = mysql_query($sql1);
            $row1 = mysql_fetch_assoc($rs1);
            return $row1['idTrang'];
            }
            
        }
	function List_Trang($idDM){
		$sql = "SELECT * FROM trang WHERE idDM = $idDM ORDER BY ThuTu ";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function List_DanhMuc($idSach,$status=-1){
		$sql = "SELECT * FROM danhmuc WHERE idSach = $idSach AND (status = $status OR $status = -1) ORDER BY thutu ASC";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function Sach_ChiTiet($idSach){
		$sql = "SELECT * FROM sach WHERE idSach = $idSach";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function ChiTiet_Trang($idML,$idTrang){
		$sql = "SELECT * FROM trang WHERE idDM = $idML AND ThuTu = $idTrang";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	
	function Sach_Them(&$loi){	
	
		$thanhcong=true;
		$idML = (int) $_POST['idML'];
		if($idML == 0) $thanhcong=false;
		
		$TenSach= $this->processData($_POST['TenSach']);
		$idTG= (int) $_POST['idTG'];
		$NhaXB= $this->processData($_POST['NhaXB']);
		$NamXB= $this->processData($_POST['NamXB']);
		
		$ThoiGian = strtotime("now");
		$user_id = $_SESSION['user_id'];
                
                $thutu = $this->getThuTuSachMax($idML) + 1;
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "INSERT INTO sach
					VALUES(NULL,'$TenSach',$idML,$idTG,'$NhaXB','$NamXB','$ThoiGian',$user_id,$thutu,0)";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
	}
        function getThuTuSachMax($idML){
            $query = "SELECT MAX(thutu) as thutumax FROM sach WHERE idML = $idML";
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);
            return $row['thutumax'];
        }
	function Sach_Sua($idSach,&$loi){			
		$thanhcong=true;		
		$idML = $_POST[idML];settype($idML,'int');
		if($idML == 0) $thanhcong=false;
		
		$TenSach= $this->processData($_POST[TenSach]);
		$idTG= $_POST[idTG];settype($idTG,"int");
		$NhaXB= $this->processData($_POST[NhaXB]);
		$NamXB= $this->processData($_POST[NamXB]);
		
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "UPDATE sach
					SET TenSach = '$TenSach',idML = $idML,
					NhaXB = '$NhaXB',idTG = $idTG,
					NamXB = '$NamXB'
					WHERE idSach = $idSach";
			mysql_query($sql) or die(mysql_error().$sql);			
		}
		return $thanhcong;
	}
	
	
	function Sach_List($idML = -1 , $idTG=-1,$idUsers = -1,$tukhoa= "" , $limit = -1 ,$offset=-1){	            
		$sql = "SELECT sach.*,TenMucLuc,TacGia FROM sach,mucluc,tacgia WHERE 
				sach.idML = mucluc.idML AND tacgia.idTG = sach.idTG ";
		if($idML > 0 ) $sql.=" AND sach.idML = $idML "; 		
		if($idTG > 0 ) $sql .= " AND sach.idTG = $idTG ";
                if($_SESSION['group']==2){
                    if($idUsers > 0 ) $sql .= " AND idUsers = $idUsers ";
                }else{
                    $sql .= " AND idUsers = ".$_SESSION['user_id']. " ";
                }
		if($tukhoa != '') $sql .= " AND (TenSach LIKE '%$tukhoa%' OR idSach LIKE '%$tukhoa%') ";
		
		$sql.="ORDER BY thutu ASC ";				
		if($limit > 0 && $offset >=0) $sql .= "LIMIT $offset,$limit"; 
		
		$rs = mysql_query($sql);
		return $rs;
	}		
	
}

?>