<?php
	if(!isset($_SESSION["page_dh"])) $_SESSION["page_dh"]=1;
	else $_SESSION["page_dh"] = $_SESSION["page_dh"];
	
	//$idChiTiet = $_GET["idChiTiet"];
	 $idDH = $_GET["idDH"];
	$dsdonhangchitiet = $modelDonHang -> dsdonhangchitiet ($idDH);
	$row = mysql_fetch_array($dsdonhangchitiet);
	
	$donhangchitiet = $modelDonHang -> donhangct ($idDH);
	$tong=mysql_num_rows($donhangchitiet);
	
	
	
	// Kiem tra Admin & tao SESSION quay ve trang da chon
	$url =  $_SERVER['REQUEST_URI'];
	$url =  substr($url,7);
	$_SESSION["url"] = $url;	
	
	if(!isset($_SESSION["back_dh"])) $_SESSION["back_dh"] = "giohang_list";
	else $_SESSION["back_dh"] = $_SESSION["back_dh"];
?>
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {font-weight: bold}
-->
</style>

<table width="985" height="350" border="0" cellpadding="1" cellspacing="1" >
  
  <tr>
    <td width="130" align="center" bgcolor="#CCCCCC"><strong><a href="index.php?com=<?=$_SESSION["back_dh"]?>&page=<?=$_SESSION["page_dh"]?>" style="text-decoration:none" title="Quay lại">&lt;&lt;&lt;&lt; <br />
Back</a></strong></td>
    <td height="70" colspan="4" align="center" bgcolor="#CCCCCC"><strong><b>{donhangchitiet}</b></strong></td>
    
  </tr>
  <tr>
    <td  align="left" bgcolor="#EBE9ED"><strong><b>ID Đơn hàng: </b></strong></td>
    <td colspan="1" align="center" bgcolor="#EBE9ED"><?= $idDH;?></td>
    
  </tr>
  <tr>
    
    <td  width="102" align="left" bgcolor="#EBE9ED"><strong>{ten} :</strong></td>
    <td width="200" height="49" align="center" bgcolor="#EBE9ED"><a style="text-decoration:none" target="_blank" href="index.php?com=user_detail&idUser=<?= $row["idUser"];?>"><?= $row["hoten"];?></a></td>
    
    
  </tr>
  <tr>
      <td width="150"  align="left" bgcolor="#EBE9ED"><strong>{dienthoai} :</strong></td>
      <td width="204" colspan="1" align="center" bgcolor="#EBE9ED"><?php echo $row["dienthoai"];?></td>
    
  </tr>
  <tr>
      <td width="150"  align="left" bgcolor="#EBE9ED"><strong>{diachi} :</strong></td>
      <td width="204" colspan="1" align="center" bgcolor="#EBE9ED"><?php echo $row["diachi"];?></td>
  </tr>
  <tr>
      <td width="150"  align="left" bgcolor="#EBE9ED"><strong>{email} :</strong></td>
      <td width="204" colspan="1" align="center" bgcolor="#EBE9ED"><?php echo $row["email"];?></td>
  </tr>
  <tr>
      <td width="150"  align="left" bgcolor="#EBE9ED"><strong>{ngaydathang} : </strong></td>
      <td width="204" colspan="1" align="center" bgcolor="#EBE9ED"><?php echo  date('d-m-Y', $row["ngaymua"]);?></td>
  </tr>
  <tr>
      <td align="left" bgcolor="#EBE9ED"><strong>{trangthai} :</strong></td>
    <td width="250" height="52" align="center" style="text-align:center; line-height:50px;" bgcolor="#EBE9ED"><?php 
	if($row["status"] == 0) echo '{choxuly} --- <img width="50" height="50" src="../img/TrangThai_0.png" />';
	 if($row["status"] == 1) echo '{dathanhtoan} --- <img width="50" height="50" src="../img/TrangThai_1.png" />';
	
	?></td>
    <td bgcolor="#CCCCCC" style="padding:5px" align="center"><strong><strong><a href="index.php?com=giohang_edit&idDH=<?= $idDH;?>"><img src="img/icons/user_edit.png" title="Chỉnh sửa"/></a></strong></strong></td>
  </tr>
  
   
  
  
  <tr style="padding:10px">
    <td height="42" colspan="2" bgcolor="#FFFFFF"><strong><span class="style1" style="padding:10px">{tongtien} <b>:</b><span class="style1"> (</span></span>
        <span class="style1">
<?= number_format($row["tongtiendh"])." VNĐ";?>
)&nbsp;</span>&nbsp;</strong></td>
	<td height="42" colspan="3" bgcolor="#FFFFFF"><strong><span class="style1" style="padding:10px">{tongsldathang}<b>:</b><span class="style1"> (</span></span>
        <span class="style1">
<?= $tong.' sản phẫm';?>
)&nbsp;</span>&nbsp;</strong></td>
  </tr>
  
</table>

<?php	

	
	
	while ($row_ct = mysql_fetch_array($donhangchitiet)){	
	
?>

<table style="text-align: center;">
          
        <thead>
          <tr>
            <td class="image">{hinhanh}</td>
            <td class="name">{tensanpham}</td>            
            <td class="quantity">{soluong}</td>
            <td class="price">{dongia}</td>
            <td class="total">{thanhtien}</td>
          </tr>
        </thead>       
        
        <tbody style="vertical-align: top;" align="center">
                                <tr align="center">
            <td class="image" width="200px">              <a href=""><img width="100px" src="../<?php echo $row_ct["url_images"]; ?>"  title=""></a>
              </td>
            <td class="name"  width="200px"><?php echo $row_ct["product_name_".$lang]; ?>                           
              </td>
            
            <td class="name" width="200px"><?php echo $row_ct["soluong"]; ?>                 
                            
              </td>
            <td class="price" width="200px"><?php echo number_format($row_ct['price_small'])." "?> VNĐ </td>
            <td class="total" width="200px"><?php echo number_format($row_ct['soluong']*$row_ct['price_small'])." VNĐ"; ?></td>
          </tr>                            </tbody>
         
        
      </table>
<?php } ?>
