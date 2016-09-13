<?php
$block_id = (int) $_GET['block_id'];
$rs_chitiet = $modelBlock->getDetailBlock($block_id);
$row = mysql_fetch_assoc($rs_chitiet);
if (isset($_POST['btnSave'])) {    
    $modelBlock->updateBlock($block_id);    
    header("location:?com=block_list");
}
?>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
<script type="text/javascript">
function BrowseServer( startupPath, functionData ){
	var finder = new CKFinder();
	finder.basePath = 'ckfinder/'; //Đường path nơi đặt ckfinder
	finder.startupPath = startupPath; //Đường path hiện sẵn cho user chọn file
	finder.selectActionFunction = SetFileField; // hàm sẽ được gọi khi 1 file được chọn
	finder.selectActionData = functionData; //id của text field cần hiện địa chỉ hình
	//finder.selectThumbnailActionFunction = ShowThumbnails; //hàm sẽ được gọi khi 1 file thumnail được chọn	
	finder.popup(); // Bật cửa sổ CKFinder
} //BrowseServer

function SetFileField( fileUrl, data ){
	document.getElementById( data["selectActionData"] ).value = fileUrl;
}
</script>

<form action="" method="post" name="form_add_dm_ks">
  <div>
    <div>
      <h3>Quản lý block : <?php echo (isset($_GET['block_id']) ? "Cập nhật" : "Thêm mới") ?></h3>
    </div>
    <div class="clr"></div>
  </div>
  <div id="main_admin">
  <div id="main_left">
    <table>      
      <tr class="left">
        <td>Tên block</td>
        <td><strong style="font-style: italic"><?php echo $row['block_name'];?></strong></td>
      </tr>
      
      <tr class="left">
        <td>{nddailoan}</td>
        <td><div style="width:800px;overflow: hidden">
            <textarea class="meta" name="block_content_cn" id="block_content_cn">
            <?php echo $row['block_content_cn']; ?>
            </textarea>
            <script type="text/javascript">
    var editor = CKEDITOR.replace('block_content_cn', {
        uiColor: '#9AB8F3',
        language: 'vi',
        skin: 'v2',
        filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?Type=Flash',
        filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
        toolbar: [
            ['Source', '-', 'Bold', 'Italic', 'Underline', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'Link', 'Unlink', 'Image', 'Styles', 'Format', 'TextColor', 'BGColor'],
        ]
    });
                                </script> 
          </div></td>
      </tr>
      <tr class="left">
        <td>{ndvietnam}</td>
        <td><div style="width:800px;overflow: hidden">
            <textarea class="meta" name="block_content_vi" id="block_content_vi">
            <?php echo $row['block_content_vi']; ?>
            </textarea>
            <script type="text/javascript">
    var editor = CKEDITOR.replace('block_content_vi', {
        uiColor: '#9AB8F3',
        language: 'vi',
        skin: 'v2',
        filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?Type=Flash',
        filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
        toolbar: [
            ['Source', '-', 'Bold', 'Italic', 'Underline', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'Link', 'Unlink', 'Image', 'Styles', 'Format', 'TextColor', 'BGColor'],
        ]
    });
                                </script> 
          </div></td>
      </tr>
      <tr class="left">
        <td>{ndtienganh}</td>
        <td><div style="width:800px;overflow: hidden">
            <textarea class="meta" name="block_content_en" id="block_content_en">
            <?php echo $row['block_content_en']; ?>
            </textarea>
            <script type="text/javascript">
    var editor = CKEDITOR.replace('block_content_en', {
        uiColor: '#9AB8F3',
        language: 'vi',
        skin: 'v2',
        filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?Type=Flash',
        filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
        toolbar: [
            ['Source', '-', 'Bold', 'Italic', 'Underline', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'Link', 'Unlink', 'Image', 'Styles', 'Format', 'TextColor', 'BGColor'],
        ]
    });
                                </script> 
          </div></td>
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

