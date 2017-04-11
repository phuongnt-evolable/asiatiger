<?php 
require_once "../Model/Db.php";
class slide extends db{
	
	function Slide_List($idS,$offset=-1,$limit=-1){
		$sql = "SELECT * FROM dvt_slide WHERE idS = $idS ORDER BY idSlide DESC ";
		if($limit > 0 && $offset >=0 ) $sql.= " LIMIT $offset,$limit";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}	
	function Slide_Them(&$loi){	
	
		$thanhcong=true;
		
	    $UrlHinh = $this->processData($_POST[UrlHinh]);
        $idS = $_POST[idS];settype($idS, "int");
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "INSERT INTO dvt_slide
					VALUES(NULL,'$idS','$UrlHinh')";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
	}
    function Slide_Sua($idSlide,&$loi){	
	
		$thanhcong=true;
		
	    $UrlHinh = $this->processData($_POST[UrlHinh]);
        $idS = $_POST[idS];settype($idS, "int");
		if($thanhcong==false){
			return $thanhcong;
		}else{
			$sql = "UPDATE dvt_slide
					SET idS = '$idS',UrlHinh = '$UrlHinh'
                    WHERE idSlide = $idSlide";
			mysql_query($sql) or die(mysql_error().$sql);		
		}
		return $thanhcong;
	}
	function Slide_ChiTiet($idSlide)
	{
		$sql = "SELECT * FROM dvt_slide WHERE idSlide = $idSlide";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
    
	
}

?>