<?php 
$idTL = (int) $_GET['idTL'];
$chitiet = $modelCate->getDetailTheLoai($idTL);
$row = mysql_fetch_assoc($chitiet);

if (isset($_POST['btnSave'])) {    
    $modelCate->updateTheLoai($idTL);    
    header("location:?com=danhmuc_list");
}
?>
<script type="text/javascript">
    function validate(){
        var flg = true;        
        if($('#cate_name').val()==''){
                alert('Chưa nhập tên menu!');
                flg = false;
        }
        return flg;
    }	
</script>

<form action="" method="post" name="form_add_dm_ks">
  <div>
    <div>
      <h3>Quản lý danh mục cha: <?php echo (isset($_GET['idTL']) ? "Cập nhật" : "Thêm mới") ?></h3>
    </div>
    <div class="clr"></div>
  </div>
  <div id="main_admin">
  <div id="main_left">
    <table>
      
      
      <tr class="left">
        <td>{tendailoan}</td>
        <td><input type="text" name="tl_name_cn" id="tl_name_cn" style="width:500px;height:25px" value="<?php echo $row['TenTL_cn']; ?>"  /></td>
      </tr>
      <tr class="left">
        <td>{tenvietnam}</td>
        <td><input type="text" name="tl_name_vi" id="tl_name_vi" style="width:500px;height:25px" value="<?php echo $row['TenTL_vi']; ?>"  /></td>
      </tr>
      <tr class="left">
        <td>{tentienganh}</td>
        <td><input type="text" name="tl_name_en" id="tl_name_en" style="width:500px;height:25px" value="<?php echo $row['TenTL_en']; ?>"  /></td>
      </tr>
      <tr class="left">
        <td>&nbsp;</td>
        <td>
        	<input type="submit" name="btnSave" value="  Save  " onclick="return validate();" />
        	<input type="reset" name="btnReset" value="  Reset  "/>
        </td>
      </tr>
    </table>
  </div>
</form>
</div>

