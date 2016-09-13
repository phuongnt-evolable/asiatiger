<?php
        $tieude_id = $tmp_uri[3]; 
        $arr = explode("-", $tieude_id);      
        $product_id = (int) end($arr);
//$product_id = (int) $_GET['product_id'];
$rs_chitiet = $modelProduct->getDetailProduct($product_id);
$row = mysql_fetch_assoc($rs_chitiet);
if (isset($_POST['btnSave'])) {
    $path = "../upload/images/Hinh-san-pham/"; // file sẽ lưu vào thư mục data
    $tmp_name = $_FILES['url_images']['tmp_name'];
    $name = $_FILES['url_images']['name'];        
    // Upload file
    move_uploaded_file($tmp_name,$path.$name);

    $category_id = (int) $_POST['category_id'];  
    $a=  $modelProduct->getIDTL($category_id);
    $row=  mysql_fetch_assoc($a);
    $idTL=$row['idTL'];
    $congty_id=(int) $_POST['dscty']; 
    $product_name_cn = $_POST['product_name_cn'];
    $product_name_vi = $_POST['product_name_vi'];
    $product_name_en = $_POST['product_name_en'];
    $price = $_POST['price'];        
    $url_images = $path.$name;           
    $mota_cn = $_POST['mota_cn'];
    $mota_vi = $_POST['mota_vi'];
    $mota_en = $_POST['mota_en'];
    $content_cn = $_POST['content_cn'];
    $content_vi = $_POST['content_vi'];
    $content_en = $_POST['content_en'];
    $loai_hinh = $_POST['loai_hinh'];
    $product_name_alias = $d->changeTitle($product_name_vi);
   

    $sql = "UPDATE product
			SET product_name_cn = '$product_name_cn',product_name_vi = '$product_name_vi',product_name_en = '$product_name_en',product_alias = '$product_name_alias',
                                    price = '$price',MoTa_cn = '$mota_cn',MoTa_vi = '$mota_vi',MoTa_en = '$mota_en',content_cn = '$content_cn',content_vi = '$content_vi',content_en = '$content_en',
			category_id = '$category_id',idTL='$idTL',congty_id='$congty_id',LoaiHinh='$loai_hinh'";
			if($name!=''){
				$sql.=" ,url_images = '$url_images' ";
			}
			$sql.="WHERE product_id = $product_id ";                   
    mysql_query($sql) or die(mysql_error() . $sql);         
    $rs_chitiet = $modelProduct->getDetailProduct($product_id);
    $row = mysql_fetch_assoc($rs_chitiet);
    header("location:http://asiatiger.org/khach-hang/danh-sach-san-pham.html");
}
?>
<script type="text/javascript" src="../admin/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../admin/ckfinder/ckfinder.js"></script>
<script type="text/javascript">
function BrowseServer( startupPath, functionData ){
	var finder = new CKFinder();
	finder.basePath = '../admin/ckfinder/'; //Đường path nơi đặt ckfinder
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
            $.post('../ajax/getloai.php', {idTL: $(this).val()}, function(data) {
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

<div id="right">
    <h1>{themsp} </h1>
<form action="" method="post" name="form_add_dm_ks" enctype="multipart/form-data">  

    <table style="font-size: 12px;" border="0" align="center" cellpadding="0" cellspacing="0" class="form_table">
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
            <td class="left">{loaihinh}</td>
          <td>
              <label>
              <input type="radio" name="loai_hinh" value="1" id="loai_hinh_1"  <?php if ($row['LoaiHinh']==1)echo " checked='checked'"; ?>/>
             {canban}</label>
              <label>
              <input type="radio" name="loai_hinh" value="0" id="loai_hinh_0"  <?php if ($row['LoaiHinh']==0)echo " checked='checked'"; ?>/>
              {canmua}</label>

          </td>                        
      </tr>
      <input type="hidden" id="dscty" name="dscty" value="<?php echo $row['congty_id']; ?>" >
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
        <td><img style="margin-right: 30px;" width="100" height="100" src="../<?php echo $row['url_images']; ?>">
        <input id="url_images" type="file" name="url_images" class="mid_text">
            <br><br> <p class="sort"> {chuysizehinhsp}</p>
        </td>
         
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
        <td><div style="width:500px;overflow: hidden">
            <textarea class="meta" name="content_cn" id="content_cn">
            <?php echo $row['content_cn']; ?>                
            </textarea>
            <script type="text/javascript">
    var editor = CKEDITOR.replace('content_cn', {
        uiColor: '#9AB8F3',
        language: 'vi',
        skin: 'kama',
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
        <td><div style="width:500px;overflow: hidden">
            <textarea class="meta" name="content_vi" id="content_vi">
            <?php echo $row['content_vi']; ?>
            </textarea>
            <script type="text/javascript">
    var editor = CKEDITOR.replace('content_vi', {
        uiColor: '#9AB8F3',
        language: 'vi',
        skin: 'kama',
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
        <td><div style="width:500px;overflow: hidden">
            <textarea class="meta" name="content_en" id="content_en">
            <?php echo $row['content_en']; ?>
            </textarea>
            <script type="text/javascript">
    var editor = CKEDITOR.replace('content_en', {
        uiColor: '#9AB8F3',
        language: 'vi',
        skin: 'kama',
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
  
</form>
</div>

