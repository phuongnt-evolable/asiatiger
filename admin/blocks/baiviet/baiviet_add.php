<?php
if (isset($_POST['btnSave'])) {    
    $modelArticle->insertArticle();    
    header("location:?com=baiviet_list");
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
        if($('#category_id').val()==0){
            alert('Chưa chọn category!');
            flg = false;
        }
		if($('#tile').val()==''){
			alert('Chưa nhập tiêu đề!');
			flg = false;
		}
		var editorText = CKEDITOR.instances.content_bv.getData();
		if($('#editorText').val()==''){
			alert('Chưa nhập nội dung!');
			flg = false;
		}
        return flg;
    }	
</script>

<form action="" method="post" name="form_add_dm_ks">
  <div>
    <div>
      <h3>{baiviet} : <?php echo (isset($_GET['article_id']) ? "Cập nhật" : "{themmoi}") ?></h3>
    </div>
    <div class="clr"></div>
  </div>
  <div id="main_admin">
  <div id="main_left">
    <table>
        
       <tr class="left">
        <td>Loại tin :</td>
        <td>
            <select name='idloai' id="idloai">
                <option value='0'>---Chọn----</option>
                <?php
                    //$idTL=$row['idTL'];
                    $rs_cha = $modelArticle->getLoaiArticle();
                    while($row_cha = mysql_fetch_assoc($rs_cha)){
                ?>
                <option value='<?php echo $row_cha['id']?>'><?php echo $row_cha['TenLoaiTin'];?></option>

                <?php } ?>    
              </select>
        </td>
      </tr>
      <tr class="left">
        <td>{hinhanh}</td>
        <td><input type="text" name="url_images" id="url_images" class="tf" style="width:300px;height:25px" value="<?php echo $row['HinhDaiDien']; ?>"/>

          <input type="button" name="btnChonFile" value="{chonhinh}" onclick="BrowseServer('Images:/','url_images')"  /></td>
      </tr>
      <tr class="left">
        <td>{tieudedailoan}</td>
        <td><input type="text" name="title_cn" id="title_cn" style="width:500px;height:25px" /></td>
      </tr>
      <tr class="left">
        <td>{tieudevietnam}</td>
        <td><input type="text" name="title_vi" id="title_vi" style="width:500px;height:25px" /></td>
      </tr>
      <tr class="left">
        <td>{tentienganh}</td>
        <td><input type="text" name="title_en" id="title_en" style="width:500px;height:25px" /></td>
      </tr>
      <tr class="left">
        <td>Mô tả cn</td>
        <td><input type="text" name="mota_cn" id="mota_cn" style="width:500px;height:25px" /></td>
      </tr>
      <tr class="left">
        <td>Mô tả vi </td>
        <td><input type="text" name="mota_vi" id="mota_vi" style="width:500px;height:25px" /></td>
      </tr>
      <tr class="left">
        <td>Mô tả en</td>
        <td><input type="text" name="mota_en" id="mota_en" style="width:500px;height:25px" /></td>
      </tr>
      <tr class="left">
        <td>{nddailoan}</td>
        <td><div style="width:800px;overflow: hidden">
            <textarea class="meta" name="content_cn" id="content_cn"></textarea>
            <script type="text/javascript">
    var editor = CKEDITOR.replace('content_cn', {
        uiColor: '#9AB8F3',
        language: 'vi',
        skin: 'office2003',
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
            <textarea class="meta" name="content_vi" id="content_vi"></textarea>
            <script type="text/javascript">
    var editor = CKEDITOR.replace('content_vi', {
        uiColor: '#9AB8F3',
        language: 'vi',
        skin: 'office2003',
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
            <textarea class="meta" name="content_en" id="content_en"></textarea>
            <script type="text/javascript">
    var editor = CKEDITOR.replace('content_en', {
        uiColor: '#9AB8F3',
        language: 'vi',
        skin: 'office2003',
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

