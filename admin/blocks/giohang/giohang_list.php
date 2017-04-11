<?php
	// Lay ngay thang nam Hien tai
	$now = getdate();
	$currentDate = $now["mon"] . "-" . $now["year"];
	$ngay = $now["year"] . "-" . $now["mon"] . "-" . $now["mday"];
	
	if (!isset($_POST["month"])) $month = $now["mon"];
	else $month = $_POST["month"];
	//$month = $_POST["month"];
	
	if(!isset($_POST["year"])) $year = $now["year"];
	else $year = $_POST["year"];
	//echo $_POST["month"]; echo $year;
	// End Ngay Thang Nam
	 
	$_SESSION["back_dh"] = "giohang_list";
	
	$DanhSachDonHang = $modelDonHang -> DanhSachDonHang ();
	
	// Kiem tra Admin & tao SESSION quay ve trang da chon
	$url =  $_SERVER['REQUEST_URI'];
	$url =  substr($url,7);
	$_SESSION["url"] = $url;
	
	if (isset($_GET['status']) && $_GET['status'] > -1) {
            $status = (int) $_GET['status'];
            $link.="&status=$status";
        } else {
            $status = -1;
        }
        
	// Phan trang
	$mot_trang=10;
	if (isset($_GET["page"])) $page=$_GET["page"];
	else $page=1;
	$_SESSION["page_dh"] = $page;
	setcookie('page',$page);	
	$from=($page-1)*$mot_trang;	
        $kq = $DanhSachDonHang;	
	$limit=5;
	$tongsotin=mysql_num_rows($kq);
	$sotrang=ceil($tongsotin/$mot_trang);
	$select = "donhang.*,khachhang.*";
	$table = "donhang,khachhang";	
	
	
        if($status > -1){
            //echo "123";die(113);
            $where = "donhang.idKH = khachhang.idKH AND donhang.status=$status  ";
            $trang_hientai = $modelDonHang->PhanTrang2($select,$table,$where,$from,$mot_trang); // ham nay xai cho tat ca cac bang cung dc.
        }else{
            $where = "donhang.idKH = khachhang.idKH   ";
            $trang_hientai = $modelDonHang->PhanTrang2($select,$table,$where,$from,$mot_trang); // ham nay xai cho tat ca cac bang cung dc.
        }
		
	 	
?>
<script type="text/javascript">
     $(document).ready(function(){
        $(".linkxoa").live('click',function(){
            var flag = confirm("Bạn có chắc chắn xóa");
            if(flag == true){
                var idDH = $(this).attr("idDH");
                //alert (idDH);
                $.get('xoa.php',{loai:"donhang",id:idDH},function(data){
                    window.location.reload();
                });
            }
        });
    });
</script>

<table width="985" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr bgcolor="#CCCCCC">
    <td height="59" colspan="6" align="center"><b><font color="#0066CC">( {tong} : <?=mysql_num_rows($trang_hientai);?> )</font> {dsgiohang}  <font color="#993300" style=" font-size:20px">[ <?=$month." / ".$year;?>
     ] 
     <form method="get" action="" name="formTim" id="formTim">
         </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#0066CC" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold">{xemdathang}: </font> 
        <select name="status" id="status">
          <option value="0" >{choxuly}</option>
          <option value="1" >{dathanhtoan}</option>
          <input name="btn_xem2" type="submit" id="btn_xem2" style="height:25px;border: 1px solid red;border-radius: 5px; color:red;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:16px;font-weight:bold; cursor:pointer;" value="{xem}"/>
        </select>
     </form> 
        
    </b></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td width="106" height="61" align="center"><b>STT</b></td>
    <td width="177" align="center"><b>{ten}</b></td>
    <td width="136" align="center"><b>{dienthoai}</b></td>
    <td width="134" align="center"><b> {trangthai}</b></td>
    <td width="176" align="center"><b><font color="#993333">{ngaydathang}</font></b></td>
    <td align="center"><b>{tongtien}</b></td>
    <td align="center"><b>Action</b></td>
  </tr>
<?php
	$i=0;
	while ($row_donhang = mysql_fetch_array ($trang_hientai)){
	$i++;
	ob_start ();
?>
  <tr bgcolor="<?php if($i%2==0) echo '#EBE9ED'; else echo '#E0E0E0';?>">
    <td height="48" align="center"><b>{idDH}</b></br><a href="index.php?com=giohang_detail&idDH={idDH}"><img src="../img/ChiTiet_icon.PNG" width="75" height="25" border="1"/></a></td>
    <td align="center">{Username}</td>
    <td align="center">{SoDienThoai}</td>
    <td align="center">{TinhTrang}</td>
    <td align="center"><font color="#0066FF"><b><?php echo  date('d-m-Y', $row_donhang["ngaymua"]);?></b></font></td>
    <td align="center"><?php echo number_format( $row_donhang["tongtiendh"]); ?> VNĐ</td>
    <td align="center" style="white-space:nowrap">
            
            <img class="linkxoa" idDH="<?php echo $row_donhang['idDH'] ?>" src="img/icons/trash.png" alt="Xóa" title="Xóa" border="0">
    </td>
    </tr>
<?php
	$s = ob_get_clean ();
	$s = str_replace ("{idDH}",$row_donhang["idDH"],$s);
	$s = str_replace ("{TinhTrang}","<img width='32' height='32' src='../img/TrangThai_".$row_donhang["status"].".png'/>",$s);
	$s = str_replace ("{SoDienThoai}",$row_donhang["dienthoai"],$s);
	$s = str_replace ("{TongCong}",$row_donhang["tongtiendh"],$s);
	//$s = str_replace ("{ThoiDiemDatHang}", date('d-m-Y', $row["ngaymua"]),$s);
	$s = str_replace ("{Username}",$row_donhang["hoten"],$s);
	$s = str_replace ("{idChiTiet}",$row_donhang["idChiTiet"],$s);
	echo $s;
}?>
</table>
<div id="phantrang" style="margin-left:30px;margin-top:10px">
<?php   
	$dau=1;
	$cuoi=0;
	$dau=$page - floor($limit/2);
	$cuoi=$dau+$limit;
	
	if($cuoi>$sotrang)
	{	
		$cuoi=$sotrang+1;
		$dau=$cuoi-$limit;	
	}
	if($dau<1) $dau=1;
	?> 
    
    
    <?php if($page >1) { ?>
      <a  style="text-decoration:none" href="index.php?com=giohang_list&page=1">Đầu</a>
    <a  style="text-decoration:none" href="index.php?com=giohang_list&page=<?php if($page > 1)echo($page - 1);?> ">Trước</a>
    
    <?php } ?>
	<?
	for($i=$dau; $i<$cuoi; $i++)
	{
		?>
		<a href="index.php?com=giohang_list&page=<?php echo $i;?>"  <?php if($page==$i) echo"style='background-color:orange'";?>>
		<?
			echo $i."  ";
		?>
		</a>
<?
	}
?>
<?php if($page < $sotrang) {?>
 <a  style="text-decoration:none" href="index.php?com=giohang_list&page=<?php echo($page + 1)?>">Kế</a>
<a  style="text-decoration:none" href="index.php?com=giohang_list&page=<?php echo $sotrang;?>">Cuối</a>
<?php } ?>
</div>
