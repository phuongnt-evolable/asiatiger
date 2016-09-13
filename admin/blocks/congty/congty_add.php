<?php
if (isset($_POST['btnSave'])) {
    //$modelCongTy->insertCongTy();
   // header("location:?com=congty_list&category_id=".$_POST['category_id']);
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
            alert('Chưa chọn danh mục!');
            flg = false;
             return flg;
        }
		if($('#product_name').val()==''){
			alert('Chưa nhập tiêu đề!');
			flg = false;
             return flg;
		}
		var editorText = CKEDITOR.instances.content_bv.getData();
		if(editorText==''){
			alert('Chưa nhập nội dung!');
			flg = false;
             return flg;
		}
        return flg;
    }
</script>

<form action="" method="post" name="form_add_dm_ks">
  <div>
    <div>
      <h3>{cty}: <?php echo (isset($_GET['article_id']) ? "Cập nhật" : " {themmoi}") ?></h3>
    </div>
    <div class="clr"></div>
  </div>
  <div id="main_admin">
  <div id="main_left">
    <table>
      <tr class="left">
        <td width="100px">{danhmuc}</td>
        <?php /*<td>
            <select name='category_id' id="category_id">
            <option value='0'>----Chọn----</option>
            <?php
            $rs_cha = $modelCate->getAllTL();
            while($row_cha = mysql_fetch_assoc($rs_cha)){
               // $idTL=$row_cha['idTL'];
            ?>
            
            <optgroup value="<?php echo $row_cha['idTL']?>" label="<?php echo $row_cha['TenTL_'.$lang]?>">
                <?php
            $rs_con = $modelCate->getListCate($row_cha['idTL']);
            if(mysql_num_rows($rs_con) > 0) {while($row_con = mysql_fetch_assoc($rs_con)){
            ?>
                <option value="<?php echo $row_con['cate_id']?>"><?php echo $row_con['cate_name_'.$lang]?></option>
            <?php }}else{ ?>
                <option value="<?php echo $row_cha['cate_id']?>"><?php echo $row_cha['cate_name_'.$lang]?></option>
            <?php } ?>
              </optgroup>
             
            <?php  } ?>
          </select>
            
        </td>*/?>
        <td> 
            <div style="float:left;">
                <?php 
                    $menu=$modelCate->getAllTL();
                    while ($row_menu=  mysql_fetch_assoc($menu)){
                ?>
                <div  style="margin-bottom: 5px;">
                     <a class="TenTL" style="font-size: 13px;font-weight: bold;"><?php echo $row_menu['TenTL_'.$lang] ?></a>
                     <input type="hidden" name="idTL" id="idTL" value="<?php echo $row_menu['idTL'] ?>" />
                    <?php 

                            $idTL=$row_menu['idTL'];
                            $menu_con=$modelCate->getListCate($idTL);
                            while($row_menu_con=  mysql_fetch_assoc($menu_con)){
                     ?>
                    <div class="TenCate" >
                        <p style="padding: 5px;"><input style="margin-right:5px;" type="checkbox" class="Category" id="Category" name="Category[]" value="<?php echo $row_menu_con['cate_id'] ?>" onclick="chkcontrol();" > <?php echo $row_menu_con['cate_name_'.$lang] ?></p>
                    </div> 
                    <?php } ?>
                </div>
                    <?php }  ?>
             </div>
            <div id="error" style="float:left;"></div>
        </td>
      </tr>
      <tr>
          <td class="left">Lên đầu nghành</td>
          <td>
              <label>
              <input type="radio" name="top" value="0" id="top_0"  checked="checked"/>
             Không</label>
              <label>
              <input type="radio" name="top" value="1" id="top_1"  />
              Có</label>

          </td>                        
      </tr>
      <tr>
          <td class="left">Shop Vip</td>
          <td>
              <label>
              <input type="radio" name="shopvip" value="0" id="shopvip_0"  checked="checked"/>
             Không</label>
              <label>
              <input type="radio" name="shopvip" value="1" id="shopvip_1"  />
              Có</label>

          </td>                        
      </tr>
      <tr class="left">
        <td>{tendailoan}</td>
        <td><input type="text" name="ten_cty_cn" id="ten_cty_cn" style="width:500px;height:25px" /></td>
      </tr>
      <tr class="left">
        <td>{tenvietnam}</td>
        <td><input type="text" name="ten_cty_vi" id="ten_cty_vi" style="width:500px;height:25px" /></td>
      </tr>
      <tr class="left">
        <td>{tentienganh}</td>
        <td><input type="text" name="ten_cty_en" id="ten_cty_en" style="width:500px;height:25px" /></td>
      </tr>
      <tr class="left">
        <td>{hinhanh}</td>
        <td><input type="text" name="url_images" id="url_images" class="tf" value="" style="width:300px;height:25px"/>
          <input type="button" name="btnChonFile" value="Chọn" onclick="BrowseServer('Images:/','url_images')"  /></td>
      </tr>
      <tr class="left">
        <td width="100px">Quốc gia</td>
        <td><select name='quocgia' id="quocgia">
            <option value='0'>----Chọn----</option>
            <?php
               // $quocgia = $modelQuocgia->getAllQuocGia();
                $sql="SELECT * FROM quocgia   ORDER BY idQuocGia DESC";
                $quocgia= mysql_query($sql) or die(mysql_error());
                while($row_qg = mysql_fetch_assoc($quocgia)){
                   // $idTL=$row_cha['idTL'];
            ?>
                <option value="<?php echo $row_qg['idQuocGia']?>"><?php echo $row_qg['TenQuocGia_'.$lang]?></option>
            
            <?php  } ?>
          </select></td>
      </tr>
      <tr class="left">
        <td>Nhà đầu tư cn</td>
        <td><input type="text" name="nha_dau_tu_cn" id="nha_dau_tu_cn" style="width:500px;height:25px" /></td>
      </tr>
        <tr class="left">
            <td>Nhà đầu tư vi </td>
            <td><input type="text" name="nha_dau_tu_vi" id="nha_dau_tu_vi" style="width:500px;height:25px" /></td>
        </tr>
        <tr class="left">
            <td>Nhà đầu tư en</td>
            <td><input type="text" name="nha_dau_tu_en" id="nha_dau_tu_en" style="width:500px;height:25px" /></td>
        </tr>
      <tr class="left">
        <td>{diachi}_cn</td>
        <td><input type="text" name="diachi_cn" id="diachi_cn" style="width:500px;height:25px" /></td>
      </tr>
      <tr class="left">
        <td>{diachi}_vi</td>
        <td><input type="text" name="diachi_vi" id="diachi_vi" style="width:500px;height:25px" /></td>
      </tr>
      <tr class="left">
        <td>{diachi}_en</td>
        <td><input type="text" name="diachi_en" id="diachi_en" style="width:500px;height:25px" /></td>
      </tr>
      
      <tr class="left">
        <td>{dienthoai}</td>
        <td><input type="text" name="dienthoai" id="dienthoai" style="width:500px;height:25px" value="<?php if($lang=='vi') {echo '+84';} if($lang=='cn') {echo '+86';} ?>" /></td>
      </tr> 
      <tr class="left">
        <td>{fax}</td>
        <td><input type="text" name="fax" id="fax" style="width:500px;height:25px" /></td>
      </tr> 
      <tr class="left">
        <td>{email}</td>
        <td><input type="text" name="email" id="email" style="width:500px;height:25px" /></td>
      </tr> 
      <tr class="left">
        <td>Người liên hệ</td>
        <td><input type="text" name="nguoilienhe" id="nguoilienhe" style="width:500px;height:25px" /></td>
      </tr>
      <tr class="left">
        <td>Skype</td>
        <td><input type="text" name="skype" id="skype" style="width:500px;height:25px" /></td>
      </tr>
      <tr class="left">
        <td>QQ</td>
        <td><input type="text" name="qq" id="qq" style="width:500px;height:25px" /></td>
      </tr>
      <tr class="left">
        <td>Di động</td>
        <td><input type="text" name="didong" id="didong" style="width:500px;height:25px" /></td>
      </tr>
       <tr class="left">
        <td>{website}</td>
        <td><input type="text" name="website" id="website" style="width:500px;height:25px" /></td>
      </tr>    
      <tr class="left">
        <td>Sản phẩm chính vi</td>
        <td><input type="text" name="spchinh_vi" id="spchinh_vi" style="width:500px;height:25px" /></td>
      </tr>
      <tr class="left">
        <td>Sản phẩm chính cn</td>
        <td><input type="text" name="spchinh_cn" id="spchinh_cn" style="width:500px;height:25px" /></td>
      </tr>
      <tr class="left">
        <td>Sản phẩm chính en</td>
        <td><input type="text" name="spchinh_en" id="spchinh_en" style="width:500px;height:25px" /></td>
      </tr>
      
      <tr class="left">
        <td>{gioithieucn}</td>
        <td><div style="width:800px;overflow: hidden">
            <textarea class="meta" name="gioithieu_cn" id="gioithieu_cn">            
            </textarea>
            <script type="text/javascript">
    var editor = CKEDITOR.replace('gioithieu_cn', {
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
        <td>{gioithieuvi}</td>
        <td><div style="width:800px;overflow: hidden">
            <textarea class="meta" name="gioithieu_vi" id="gioithieu_vi">            
            </textarea>
            <script type="text/javascript">
    var editor = CKEDITOR.replace('gioithieu_vi', {
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
        <td>{gioithieuen}</td>
        <td><div style="width:800px;overflow: hidden">
            <textarea class="meta" name="gioithieu_en" id="gioithieu_en">            
            </textarea>
            <script type="text/javascript">
    var editor = CKEDITOR.replace('gioithieu_en', {
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
            <input type="button" name="btnSave" id="btnSave" value="  Save  "  />
        	<input type="reset" name="btnReset" value="  Reset  "/>
                <span  id="thongbao"></span>
        </td>
      </tr>
    </table>
  </div>
</form>
</div>

