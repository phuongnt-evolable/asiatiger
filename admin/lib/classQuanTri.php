<?php
require_once "Model/Db.php";
class quantri extends db{

	function xoabaiviet($id){
		$sql ="DELETE FROM article WHERE article_id= $id";
		mysql_query($sql) or die(mysql_error());
	}
	function XoaMucLuc($id){
		$sql ="DELETE FROM mucluc WHERE idML= $id";
		mysql_query($sql) or die(mysql_error());
	}
	function XoaSach($id){
		$sql ="DELETE FROM sach WHERE idSach= $id";
		mysql_query($sql) or die(mysql_error());
                mysql_query("DELETE FROM danhmuc WHERE idSach = $id");
                mysql_query("DELETE FROM trang WHERE idSach = $id");                
	}
    function XoaDanhMuc($id){
		$sql ="DELETE FROM danhmuc WHERE idDM= $id";
		mysql_query($sql) or die(mysql_error());
                mysql_query("DELETE FROM trang WHERE idDM = $id");
	}
	function XoaTrang($id){
                $sql1 = "SELECT * FROM trang WHERE idTrang= $id";
                $rs = mysql_query($sql1);
                $row = mysql_fetch_assoc($rs);
                $idDM = $row['idDM'];
                
                $sql2 = "SELECT * FROM danhmuc WHERE idDM= $idDM";
                $rs2 = mysql_query($sql2);
                $row2 = mysql_fetch_assoc($rs2);
                $thutu = $row2['thutu'];
                
                $idSach = $row2['idSach'];
                
                mysql_query("UPDATE danhmuc SET status = 0 WHERE thutu >= $thutu AND idSach = $idSach") or die(mysql_error());
		$sql ="DELETE FROM trang WHERE idTrang= $id";
               
		mysql_query($sql) or die(mysql_error());
	}
	function XoaTacGia($id){
		$sql ="DELETE FROM tacgia WHERE idTG= $id";
		mysql_query($sql) or die(mysql_error());
	}
	
	
} //class quantri
?>