<?php
if (isset($_POST['btnSave'])) {
    $modelQuocgia->insertQuocGia();
    header("location:?com=quocgia_list");
}
?>
<script type="text/javascript">
    function validate(){
        var flg = true;
        
        if($('#qg_name_cn').val()==''){
            alert('Chưa nhập tên quốc gia!');
            flg = false;
        }
        if($('#qg_name_vi').val()==''){
            alert('Chưa nhập tên quốc gia!');
            flg = false;
        }
        if($('#qg_name_en').val()==''){
            alert('Chưa nhập tên quốc gia!');
            flg = false;
        }
        return flg;
    }
</script>

<form action="" method="post" name="form_add_dm_ks">
  <div>
    <div>
      <h3>{danhmuc}: <?php echo (isset($_GET['cate_id']) ? "Cập nhật" : "{themmoi}") ?></h3>
    </div>
    <div class="clr"></div>
  </div>
  <div id="main_admin">
  <div id="main_left">
    <table>
      
      <tr class="left">
        <td>{tendailoan}</td>
        <td><input type="text" name="qg_name_cn" id="qg_name_cn" style="width:500px;height:25px" /></td>
      </tr>
      <tr class="left">
        <td>{tenvietnam}</td>
        <td><input type="text" name="qg_name_vi" id="qg_name_vi" style="width:500px;height:25px" /></td>
      </tr>
      <tr class="left">
        <td>{tentienganh}</td>
        <td><input type="text" name="qg_name_en" id="qg_name_en" style="width:500px;height:25px" /></td>
      </tr>
      <tr class="left">
        <td>Mã vùng</td>
        <td><input type="text" name="ma_vung" id="ma_vung" style="width:500px;height:25px" /></td>
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

