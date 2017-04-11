<?php

require_once "Db.php";
class DonHang extends Db {

    
    //------------------------------------------- DON HANG -----------------------------------------
		function DanhSachDonHang () {
			 $qr = "	SELECT donhangct.*, donhang.*,khachhang.*
					FROM donhangct,donhang,khachhang 
					WHERE donhang.idKH = khachhang.idKH
					AND donhangct.idDH = donhang.idDH
					
					";
			return mysql_query ($qr);
		}
		function DanhSachDonHangDX () {
			$qr = "	SELECT donhangct.*, donhang.*,
					FROM donhangct,donhang,khachhang 
					WHERE donhang.idKH = khachhang.idKH
					AND donhangct.idDH = donhang.idDH
					AND donhang.AnHien = 0
					ORDER BY ThoiDiemDatHang DESC
					";
			return mysql_query ($qr);
		}
		function DanhSachDonHangCTT () {
			 $qr = "	SELECT  donhang.*,
					FROM donhang,khachhang 
					WHERE donhang.idKH = khachhang.idKH
					
					AND donhang.TinhTrang = 0
					AND donhang.AnHien = 1
					ORDER BY ThoiDiemDatHang DESC
					";
			return mysql_query ($qr);
		}
		function DanhSachDonHangDTT () {
			$qr = "	SELECT donhangct.*, donhang.*
					FROM donhangct,donhang,khachhang 
					WHERE donhang.idKH = khachhang.idKH
					AND donhangct.idDH = donhang.idDH
					AND donhang.TinhTrang = 1
					AND donhang.AnHien = 1
					ORDER BY ThoiDiemDatHang DESC
					";
			return mysql_query ($qr);
		}
		function CTDonHang ($idDH) {
			$qr = "	SELECT donhang.*, hoten
					FROM donhang,khachhang
					WHERE idDH = $idDH
					AND donhang.idKH = khachhang.idKH
					
					
					";
			return mysql_query ($qr);
		}
		
		
		function donhangct ($idDH){
			 $qr = "	SELECT donhang.*, donhangct.*,product.*
					FROM donhang, donhangct,product
					WHERE 
					 donhangct.idDH = donhang.idDH	
					 AND donhang.idDH=$idDH			
					AND donhangct.sp_id=product.product_id
					
				";
			return mysql_query($qr);
		}
				
		function SuaDonHang($idDH){
			echo $TinhTrang = $_POST["TinhTrang"];
				settype($TinhTrang, "int");			
			$qr = "UPDATE donhang SET status = $TinhTrang WHERE idDH = $idDH";
			mysql_query ($qr);
		}
		
		function XoaDonHang ($idDH) {
			$qr = "UPDATE donhang SET AnHien = 0 WHERE idDH = $idDH";
			mysql_query ($qr);
		}
                function dsdonhangchitiet ($idDH){
			  $qr = "	SELECT donhang.*, donhangct.*,khachhang.*,product.*
					FROM donhang, donhangct, khachhang,product
					WHERE 
					  donhang.idDH=$idDH
					AND donhang.idKH=khachhang.idKH					
					AND donhangct.sp_id=product.product_id
				"; 
			return mysql_query($qr);
		}
               
		
	//--------------------------------------- END DON HANG ---------------------------------------
    
        //---------------------------------------- PHAN TRANG ------------------------------------
	function PhanTrang($table,$order,$from,$mot_trang){
			$qr = "SELECT * FROM $table ORDER BY $order ASC LIMIT $from ,$mot_trang";
			return mysql_query($qr);	
	}
	/*function PhanTrang2 ($select,$table,$where,$from,$mot_trang) {
			  $qr = "SELECT $select 
					FROM $table
					WHERE $where
					
					LIMIT $from,$mot_trang";
			return mysql_query ($qr);
	}*/
}

?>