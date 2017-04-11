<?php
$duan_id = (int) $_GET['duan_id'];
$rs_chitiet = $modelArticle->getDetailDuAn($duan_id) ;
$row_chitiet = mysql_fetch_assoc($rs_chitiet);

if (isset($_POST['btnSave'])) {    
    $modelArticle->updateDuAn($duan_id) ;    
    //header("location:?com=duan_list&category_id=".$row['category_id']);
}

$cate    = $modelArticle->getListCate($duan_id);
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
      <h3>{duandalam} : <?php echo (isset($_GET['$duan_id']) ? "Cập nhật" : "Thêm mới") ?></h3>
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
                        <option <?php echo ($row_chitiet['cate_id']==$row_cate['cate_id'])? "selected=selected": ""; ?> value="<?php echo $row_cate['cate_id']; ?>"><?php echo $row_cate['cate_name_'.$lang]; ?></option>
                    <?php } ?>
                </select>

            </td>   
          </tr>
        <?php /*<tr>
            <td style="width: 150px">{quocgia}</td>
            <td colspan="3">
                <select name="idTL" id="idTL" style="width: 200px">                    
                    <?php                    
                    while ($row_quocgia = mysql_fetch_assoc($quocgia)) {
                        ?>                    
                        <option value="<?php echo $row_quocgia['idQuocGia']; ?>" <?php echo ($row_chitiet['idQuocGia']==$row_quocgia['idQuocGia'])? "selected=selected": "";?>><?php echo $row_quocgia['TenQuocGia_'.$lang]; ?></option>
                    <?php } ?>
                </select>
            </td>   
          </tr>
          <tr>
            <td>{khuvuc}</td>
            <td colspan="3">
                <select name="loai_id" id="loai_id" style="width: 200px">
                <?php                     
                    while($row_khuvuc = mysql_fetch_assoc($khuvuc)){                         
                ?>
                <option value="<?php echo $row_khuvuc['idKhuVuc']; ?>" <?php echo ($row_chitiet['idKhuVuc']==$row_khuvuc['idKhuVuc'])? "selected=selected": "";?>><?php echo $row_khuvuc['TenKhuVuc_'.$lang];?></option>
                <?php } ?>
              </select></td>
          </tr>*/?>
      <tr class="left">
        <td>{hinhanh}</td>
        <td><input type="text" name="url_images" id="url_images" class="tf" style="width:300px;height:25px" value="<?php echo $row_chitiet['HinhDaiDien']; ?>"/>

          <input type="button" name="btnChonFile" value="{chonhinh}" onclick="BrowseServer('Images:/','url_images')"  /></td>
      </tr> 
      <tr class="left">
        <td>{tieudedailoan}</td>
        <td><input type="text" name="title_cn" id="title_cn" style="width:800px;height:25px" value="<?php echo $row_chitiet['TenDuAn_cn']; ?>"/></td>
      </tr>      
      <tr class="left">
        <td>{nddailoan}</td>
        <td><div style="width:800px;overflow: hidden">
            <textarea class="meta" name="NoiDung_cn" id="NoiDung_cn">
            <?php echo $row_chitiet['NoiDung_cn']; ?>
            </textarea>
            <script type="text/javascript">
    var editor = CKEDITOR.replace('NoiDung_cn', {
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
        <td>{tieudevietnam}</td>
        <td><input type="text" name="title_vi" id="title_vi" style="width:800px;height:25px" value="<?php echo $row_chitiet['TenDuAn_vi']; ?>"/></td>
      </tr>      
      <tr class="left">
        <td>{ndvietnam}</td>
        <td><div style="width:800px;overflow: hidden">
            <textarea class="meta" name="NoiDung_vi" id="NoiDung_vi">
            <?php echo $row_chitiet['NoiDung_vi']; ?>
            </textarea>
            <script type="text/javascript">
    var editor = CKEDITOR.replace('NoiDung_vi', {
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
        <td><input type="text" name="title_en" id="title_en" style="width:800px;height:25px" value="<?php echo $row_chitiet['TenDuAn_en']; ?>"/></td>
      </tr>      
      <tr class="left">
        <td>{ndtienganh}</td>
        <td><div style="width:800px;overflow: hidden">
            <textarea class="meta" name="NoiDung_en" id="NoiDung_en">
            <?php echo $row_chitiet['NoiDung_en']; ?>
            </textarea>
            <script type="text/javascript">
    var editor = CKEDITOR.replace('NoiDung_en', {
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

