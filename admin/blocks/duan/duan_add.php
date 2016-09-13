<?php
    if (isset($_POST['btnSave'])) {    
        $modelArticle->insertDuAn();    
        header("location:?com=duan_list");
    }
    
    $cate    = $modelArticle->getListCate();
    $quocgia = $modelArticle->QuocGia_List();
    $khuvuc  = $modelArticle->KhuVuc_List();
    
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
        //alert('s');
        $(".linkxoa").live('click',function(){			
            var flag = confirm("Bạn có chắc chắn xóa");
            if(flag == true){
                var idTrang = $(this).attr("idTrang");
                $.get('xoa.php',{loai:"trang",id:idTrang},function(data){
                    window.location.reload();			
                });	
            }
        });   
        
        $('#idTL').change(function() {
            $.post('ajax/getloai.php', {idTL: $(this).val()}, function(data) {                
                $('#loai_id').html(data);
               // $('#IDKhach').html(data);
            })
        })
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
        <tr>
            <td style="width: 150px">{danhmuc}</td>
            <td colspan="3">

                <select name="cate_id" id="cate_id">
                    <option value="0">-- Chọn --</option>
                    <?php
                    
                    while ($row_cate = mysql_fetch_assoc($cate)) {
                        ?>
                        <option value="<?php echo $row_cate['cate_id']; ?>"><?php echo $row_cate['cate_name_'.$lang]; ?></option>
                    <?php } ?>
                </select>

            </td>   
          </tr>
        <?php /*<tr>
            <td style="width: 150px">{quocgia}</td>
            <td colspan="3">
                <select name="idTL" id="idTL">
                    <option value="0">-- Chọn --</option>
                    <?php                    
                    while ($row = mysql_fetch_assoc($quocgia)) {
                        ?>
                        <option value="<?php echo $row['idQuocGia']; ?>"><?php echo $row['TenQuocGia_'.$lang]; ?></option>
                    <?php } ?>
                </select>
            </td>   
          </tr>
          <tr>
            <td>{khuvuc}</td>
            <td colspan="3"><select name="loai_id" id="loai_id" style="width: 200px">
                    <option value="0">-- Chọn --</option>
                <?php                     
                    while($row_khuvuc = mysql_fetch_assoc($khuvuc)){                         
                ?>
                <option value="<?php echo $row_khuvuc['idKhuVuc'];?>"><?php echo $row_khuvuc['TenKhuVuc_'.$lang];?></option>
                <?php } ?>
              </select></td>
          </tr>*/?>
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
        <td>{nddailoan}</td>
        <td><div style="width:800px;overflow: hidden">
            <textarea class="meta" name="content_cn" id="content_cn"></textarea>
            <script type="text/javascript">
    var editor = CKEDITOR.replace('content_cn', {
        uiColor: '#9AB8F3',
        language: 'cn',
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
        <td>{tieudevietnam}</td>
        <td><input type="text" name="title_vi" id="title_vi" style="width:500px;height:25px" /></td>
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
        <td>{tentienganh}</td>
        <td><input type="text" name="title_en" id="title_en" style="width:500px;height:25px" /></td>
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

