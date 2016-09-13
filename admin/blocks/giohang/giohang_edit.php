<?php
	$idDH = $_GET["idDH"];
		settype($idDH, "int");
	$idChiTiet = $_GET["idChiTiet"];
		settype($idChiTiet, "int");
	
	$CTDonHang = $modelDonHang -> CTDonHang($idDH);
	$row = mysql_fetch_array($CTDonHang);
	
	if (isset ($_POST["btn_change"])){
		$modelDonHang -> SuaDonHang ($idDH);
		header ("location: index.php?com=giohang_list&idDH=$idDH");
	}
	else if (isset ($_POST["btn_cancel"])){ 
		header ("location:index.php?com=giohang_detail&idDH=$idDH");
	}
	
	
	// End Kiem tra Admin
	
?>
<form method="post">
<table width="985" height="217" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr bgcolor="#CCCCCC" align="center">
    <td height="61"><strong><a href="index.php?p=donhang_detail&idDH=<?= $idDH;?>" style="text-decoration:none" title="Quay lại">&lt;&lt;&lt;&lt; <br />
Quay lại</a></strong></td>
    <td><strong>{capnhattrangthai}</strong></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td width="138" height="61" align="center"><strong>{trangthai}</strong></td>
    <td width="840"> {choxuly}
          <input name="TinhTrang" type="radio" id="TinhTrang" value="0" <?php if($row["status"] == 0) echo "checked=checked"; ?> />
         
           {dathanhtoan}
          <input type="radio" name="TinhTrang" id="TinhTrang" value="1" <?php if($row["status"] == 1) echo "checked=checked"; ?>/>   </td>
  </tr>
  <tr bgcolor="#999999">
    <td height="48" colspan="2" align="center">
        <input type="submit" name="btn_change" id="btn_change" value="Save" style="height:30px"/>
        <input type="submit" name="btn_cancel" id="btn_cancel" value="Reset" style="height:30px"/>      
    </td>
    </tr>
</table>
</form>