<?php
$link='';
if (isset($_GET['category_id']) && $_GET['category_id'] > 0) {
         $category_id = (int) $_GET['category_id'];
        $link.="&category_id=$category_id";
    } else {
        $category_id = -1;
    }
$idHinh = (int) $_GET['idHinh'];
$rs_chitiet = $modelHome->getDetailImageHome($idHinh);
$row = mysql_fetch_assoc($rs_chitiet);

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
    function validate(){
        var flg = true;
        if($('#category_id').val()==0){
            alert('Chưa chọn category!');
            return false;
        }
		if($('#image_name').val()==''){
			alert('Chưa nhập tiêu đề!');
			return false;
		}
    }
</script>
<script>
    $(function() {
        $('div.wrapper_cate').each(function() {
            var a = $(this).find(':checkbox:checked').length;
            if (a > 0) {
                $(this).find('.TenCate').show();
            }
        });
    });
</script>
<form action="" method="post" name="form_add_dm_ks">
  <div>
    <div>
      <h3>圖片管理 : <?php echo (isset($_GET['idHinh']) ? "Cập nhật" : "Thêm mới") ?></h3>
    </div>
    <div class="clr"></div>
  </div>
  <div id="main_admin">
  <div id="main_left">
    <table>
        <tr class="left">
            <td width="100px">Thuộc nghành</td>
            <td>
                <div style="float:left;">
                    <?php
                    $sql = "SELECT * FROM hinhanh_cate WHERE id_hinh = $idHinh";
                    $rs = mysql_query($sql);
                    $arrCateChon = array();
                    while ($row1 = mysql_fetch_assoc($rs)) {
                        $arrCateChon[] = $row1['cate_id'];
                    }
                    $menu = $modelCate->getAllTL();
                    while ($row_menu = mysql_fetch_assoc($menu)) {
                        ?>
                        <div  style="margin-bottom: 5px;" class="wrapper_cate">
                            <a class="TenTL" style="font-size: 13px;font-weight: bold;"><?php echo $row_menu['TenTL_' . $lang] ?></a>
                            <input type="hidden" name="idTL" id="idTL" value="<?php echo $row_menu['idTL'] ?>" />
                            <?php
                            $idTL = $row_menu['idTL'];
                            $menu_con = $modelCate->getListCate($idTL);
                            while ($row_menu_con = mysql_fetch_assoc($menu_con)) {
                                ?>
                                <div class="TenCate" >
                                    <p style="padding: 5px;">
                                        <input style="margin-right:5px;" type="checkbox" class="Category" id="Category" name="Category[]" value="<?php echo $row_menu_con['cate_id'] ?>" onclick="chkcontrol();" <?php if (in_array($row_menu_con['cate_id'], $arrCateChon)) echo "checked=checked"; ?>																> <?php echo $row_menu_con['cate_name_' . $lang] ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </td>
        </tr>
        <tr>
            <td class="left">Hiện trang chủ</td>
            <td>
                <label>
                    <input type="radio" name="show_home" value="0" id="show_home_0"  <?php if ($row['show_home']==0)echo " checked='checked'"; ?>/>
                    Không</label>
                <label>
                    <input type="radio" name="show_home" value="1" id="show_home_1"  <?php if ($row['show_home']==1)echo " checked='checked'"; ?>/>
                    Có</label>

            </td>
        </tr>
       <tr class="left">
        <td width="100px">{danhmuc}</td>
        <td><select name='idLoaiHinh' id="idLoaiHinh">
            <option value='0'>----Chọn----</option>
            <?php
            $rs_cha = $modelHome->getLoaiHinh();
            while($row_cha = mysql_fetch_assoc($rs_cha)){
               // $idTL=$row_cha['idTL'];
            ?>
                <option <?php echo ($row['idLoaiHinh']==$row_cha['idLoaiHinh']) ? "selected" : ""; ?> value="<?php echo $row_cha['idLoaiHinh']?>"><?php echo $row_cha['TenLoaiHinh']?></option>
            
                
              </optgroup>
             
            <?php  } ?>
          </select></td>
      </tr> 
       <tr class="left">
        <td>Tên CTY</td>
        <td><input type="text" name="tencty" id="tencty" class="tf" value="<?php echo $row['TenCT']; ?>" style="width:300px;height:25px"/>
          </td>
      </tr>     
      <tr class="left">
        <td>{hinhanh}</td>
        <td><input type="text" name="url_images" id="url_images" class="tf" style="width:300px;height:25px" value="<?php echo $row['Url']; ?>"/>

          <input type="button" name="btnChonFile" value="{chonhinh}" onclick="BrowseServer('Images:/','url_images')"  /></td>
      </tr>
      <tr class="left">
        <td>Href</td>
        <td><input type="text" name="href" id="href" class="tf" value="<?php echo $row['Href']; ?>" style="width:300px;height:25px"/>
          </td>
      </tr>
      
      <tr class="left">
        <td>&nbsp;</td>
        <td>
        	<input type="button" name="btnSave" id="btnUpdateHinh" value="  Save  " onclick="return validate();" />
        	<input type="reset" name="btnReset" value="  Reset  "/>
            <input type="hidden" name="id_hinh" id="id_hinh" value="<?php echo $idHinh; ?>">
            <span id="thongbao"></span>
        </td>
      </tr>
    </table>
  </div>
</form>
</div>

