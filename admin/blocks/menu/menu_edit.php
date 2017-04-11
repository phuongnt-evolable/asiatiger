<?php
$menu_id = (int) $_GET['menu_id'];
$rs= $modelMenu->getDetailMenu($menu_id);
$rowdetail = mysql_fetch_assoc($rs);
if (isset($_POST['btnSave'])) {    
    $modelMenu->updateMenu($menu_id);    
    header("location:?com=menu_list");
}
?>

<script type="text/javascript">
    $(document).ready(function(){		
        $(".linkxoa").live('click',function(){			
            var flag = confirm("Bạn có chắc chắn xóa");
            if(flag == true){
                var idTrang = $(this).attr("idTrang");
                $.get('xoa.php',{loai:"trang",id:idTrang},function(data){
                    window.location.reload();			
                });	
            }
        });               
    });
</script>
<script type="text/javascript">
    function validate(){
        var flg = true;
        if($('#type').val()==-1){
            alert('Chưa chọn loại menu!');
            flg = false;
        }
        if($('#menu').val()==''){
                alert('Chưa nhập tên menu!');
                flg = false;
        }
        return flg;
    }	
</script>

<form action="" method="post" name="form_add_dm_ks">
  <div>
    <div>
      <h3>Quản lý Menu : <?php echo (isset($_GET['menu_id']) ? "Cập nhật" : "Thêm mới") ?></h3>
    </div>
    <div class="clr"></div>
  </div>
  <div id="main_admin">
  <div id="main_left">
    <table>
      <tr class="left">
        <td width="100px">Loại menu</td>
        <td><select name='type' id="type">
            <option value='-1'>Chọn loại</option>
            <option value='0' <?php echo ($rowdetail['type']==0) ? "selected" : "";?>>Menu trái</option>
            <option value='1' <?php echo ($rowdetail['type']==1) ? "selected" : "";?>>Menu chính</option>
          </select></td>
      </tr>
      <tr class="left">
        <td>Menu</td>
        <td><input type="text" name="menu" id="menu" style="width:500px;height:25px" value="<?php echo $rowdetail['menu'];?>" /></td>
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

