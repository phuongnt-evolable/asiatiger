<?php
$product_id = (int) $_GET['product_id'];
$rs_chitiet = $modelProduct->getDetailProduct($product_id);
$row = mysql_fetch_assoc($rs_chitiet);
if (isset($_POST['btnSave'])) {
    $modelProduct->updateProduct($product_id);
    header("location:?com=product_list");
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
        $('#category_id').change(function() {
            //var id=$(this).val();
            //alert (id);
            $.post('ajax/getloai.php', {idTL: $(this).val()}, function(data) {
                $('#dscty').html(data);
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
            return false;
        }
		if($('#product_name').val()==''){
			alert('Chưa nhập tiêu đề!');
			return false;
		}
    }
</script>


<form action="" method="post" name="form_add_dm_ks">
  <div>
    <div>
      <h3>{sanpham}: <?php echo (isset($_GET['article_id']) ? "Cập nhật" : " {themmoi}") ?></h3>
    </div>
    <div class="clr"></div>
  </div>
  <div id="main_admin">
  <div id="main_left">
    <table>
      <tr class="left">
        <td width="100px">{danhmuc}</td>
        <td><select name='category_id' id="category_id">
            
            <?php
            $rs_cha = $modelCate->getAllTL();
            while($row_cha = mysql_fetch_assoc($rs_cha)){
            ?>
            <optgroup id="idTL" name="idTL" value="<?php echo $row_cha['idTL']?>" label="<?php echo $row_cha['TenTL_'.$lang]?>">
                <?php
            $rs_con = $modelCate->getListCate($row_cha['idTL']);           
                if(mysql_num_rows($rs_con) > 0) {while($row_con = mysql_fetch_assoc($rs_con)){
            ?>
                <option  <?php echo ($row['category_id']==$row_con['cate_id']) ? "selected" : ""; ?> value="<?php echo $row_con['cate_id']?>"><?php echo $row_con['cate_name_'.$lang]?></option>
            <?php }}else{ ?>
                <option  <?php echo ($row['category_id']==$row_cha['cate_id']) ? "selected" : ""; ?> value="<?php echo $row_cha['cate_id']?>"><?php echo $row_cha['cate_name_'.$lang]?></option>
            <?php } ?>
              </optgroup>
            <?php } ?>
          </select></td>
      </tr>
      <tr>
        <td>{dscty}</td>
        <td colspan="3"><input type="text" name="product_name_cn" id="product_name_cn" style="width:500px;height:25px" value="<?php echo $row['TenCT_'.$lang]; ?>" /></td>
      </tr>
      
      <tr class="left">
        <td>{tendailoan}</td>
        <td><input type="text" name="product_name_cn" id="product_name_cn" style="width:500px;height:25px" value="<?php echo $row['product_name_cn']; ?>" /></td>
      </tr>
      <tr class="left">
        <td>{tenvietnam}</td>
        <td><input type="text" name="product_name_vi" id="product_name_vi" style="width:500px;height:25px" value="<?php echo $row['product_name_vi']; ?>" /></td>
      </tr>
      <tr class="left">
        <td>{tentienganh}</td>
        <td><input type="text" name="product_name_en" id="product_name_en" style="width:500px;height:25px" value="<?php echo $row['product_name_en']; ?>" /></td>
      </tr>      
      <tr class="left">
        <td>{gia}</td>
        <td><input type="text" name="price" id="price" style="width:200px;height:25px" value="<?php echo $row['price']; ?>" /></td>
      </tr>      
      <tr class="left">
        <td>{hinhanh}</td>
        <td><input type="text" name="url_images" id="url_images" class="tf"  style="width:300px;height:25px" value="<?php echo $row['url_images']; ?>"/>
          <input type="button" name="btnChonFile" value="Chọn" onclick="BrowseServer('Images:/','url_images')"  /></td>
      </tr>
      <tr class="left">
        <td>{motacn}</td>
        <td><input type="text" name="mota_cn" id="mota_cn" style="width:500px;height:25px" value="<?php echo $row['MoTa_cn']; ?>" /></td>
      </tr>
      <tr class="left">
        <td>{motavi}</td>
        <td><input type="text" name="mota_vi" id="mota_vi" style="width:500px;height:25px" value="<?php echo $row['MoTa_vi']; ?>" /></td>
      </tr>
      <tr class="left">
        <td>{motaen}</td>
        <td><input type="text" name="mota_en" id="mota_en" style="width:500px;height:25px" value="<?php echo $row['MoTa_en']; ?>" /></td>
      </tr>
      <tr class="left">
        <td>{nddailoan}</td>
        <td><div style="width:800px;overflow: hidden">
            <textarea class="meta" name="content_cn" id="content_cn">
            <?php echo $row['content_cn']; ?>                
            </textarea>
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
            <textarea class="meta" name="content_vi" id="content_vi">
            <?php echo $row['content_vi']; ?>
            </textarea>
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
            <textarea class="meta" name="content_en" id="content_en">
            <?php echo $row['content_en']; ?>
            </textarea>
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

