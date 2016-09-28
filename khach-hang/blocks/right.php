<?php
//session_start();
if (!isset($_SESSION["congty_id"])) {
    header("location:http://asiatiger.org/dang-nhap.html");
}
$congty_id = $_SESSION['congty_id'];
$sql = "SELECT * from cty_cate WHERE congty_id=$congty_id";
//$row_cty_cate =  mysql_fetch_assoc($sql);
?>
<script type="text/javascript" src="../admin/ckeditor/ckeditor.js"></script>

<script type="text/javascript" src="ckfinder/ckfinder.js"></script>

<script type="text/javascript">

    function BrowseServer(startupPath, functionData) {

        var finder = new CKFinder();

        finder.basePath = 'ckfinder/'; //Đường path nơi đặt ckfinder

        finder.startupPath = startupPath; //Đường path hiện sẵn cho user chọn file

        finder.selectActionFunction = SetFileField; // hàm sẽ được gọi khi 1 file được chọn

        finder.selectActionData = functionData; //id của text field cần hiện địa chỉ hình

        //finder.selectThumbnailActionFunction = ShowThumbnails; //hàm sẽ được gọi khi 1 file thumnail được chọn

        finder.popup(); // Bật cửa sổ CKFinder

    } //BrowseServer



    function SetFileField(fileUrl, data) {

        document.getElementById(data["selectActionData"]).value = fileUrl;

    }

</script>
<div id="right">
    <h1>{thaydoithongtin} </h1>
    <p>&nbsp;</p>
    <p>{batbuocnhap}</p>
    <p>&nbsp;</p>
    <p class="sort tttk">{tttk} <span class="red"></span> </p>
    <p>&nbsp;</p>
    <form method="post" name="thisform" action="" >
        <table id="tttk" style="font-size: 12px;" border="0" align="center" cellpadding="0" cellspacing="0" class="form_table">
            <tr>
                <td align="right"> {tendn}:</td>
                <td colpan="2"><?php echo $_SESSION["Username"]; ?> <a style="margin-left: 30px;color: red;font-weight: bold;" href="doi-mat-khau.html" target="_blank">{doimatkhau}</a></td>
            </tr>
            <tr>
                <td align="right"><span class="red">*</span> {tencty}:</td>
                <td></td>
            </tr>
            <tr>                
                <td align="right"> </td>
                <td><p style="color: red;">+ {tenvietnam}:</p><input name="ten_cty_vi" type="text" class="mid_text" id="ten_cty_vi" value="<?php echo $row_cty['TenCT_vi']; ?>" maxlength="200"></td>
            </tr>
            <tr>                
                <td align="right"> </td>
                <td><p style="color: red;">+ {tendailoan}:</p><input name="ten_cty_cn" type="text" class="mid_text" id="ten_cty_cn" value="<?php echo $row_cty['TenCT_cn']; ?>" maxlength="200"></td>
            </tr>
            <tr>                
                <td align="right"> </td>
                <td><p style="color: red;">+ {tentienganh}:</p><input name="ten_cty_en" type="text" class="mid_text" id="ten_cty_en" value="<?php echo $row_cty['TenCT_en']; ?>" maxlength="200"></td>
            </tr>
            <tr>
                <td align="right"><span class="red">*</span> {diachi}:</td>
                <td></td>
            </tr>
            <tr>                
                <td align="right"> </td>
                <td><p style="color: red;">+ {tenvietnam}:</p><input name="diachi_vi" type="text" class="mid_text" id="diachi_vi" value="<?php echo $row_cty['DiaChi_vi']; ?>" maxlength="200"></td>
            </tr>
            <tr>                
                <td align="right"> </td>
                <td><p style="color: red;">+ {tendailoan}:</p><input name="diachi_cn" type="text" class="mid_text" id="diachi_cn" value="<?php echo $row_cty['DiaChi_cn']; ?>" maxlength="200"></td>
            </tr>
            <tr>                
                <td align="right"> </td>
                <td><p style="color: red;">+ {tentienganh}:</p><input name="diachi_en" type="text" class="mid_text" id="diachi_en" value="<?php echo $row_cty['DiaChi_en']; ?>" maxlength="200"></td>
            </tr>
            <tr>
                <td align="right"><span class="red">*</span> {quocgia}:</td>
                <td>
                    <select name='quocgia' id="quocgia">
                        <option value='0'>----{chon}----</option>
                        <?php
                        $quocgia = $modelQuocgia->getAllQuocGia();
                        while ($row_qg = mysql_fetch_assoc($quocgia)) {
                            // $idTL=$row_cha['idTL'];
                            ?>
                            <option <?php echo ($row_cty['idQuocGia'] == $row_qg['idQuocGia']) ? "selected" : ""; ?> value="<?php echo $row_qg['idQuocGia'] ?>"><?php echo $row_qg['TenQuocGia_' . $lang] ?></option>

                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">{nhadautu}:</td>
                <td>
                    <select name='nhadautu' id="nhadautu">
                        <option value='0'>----{chon}----</option>
                        <?php
                        $nha_dau_tu = $modelQuocgia->getAllQuocGia();
                        while ($row_nha_dau_tu = mysql_fetch_assoc($nha_dau_tu)) {
                            ?>
                            <option <?php echo ($row_cty['NhaDauTu_'.$lang] == $row_nha_dau_tu['TenQuocGia_' . $lang]) ? "selected" : ""; ?> value="<?php echo $row_nha_dau_tu['TenQuocGia_' . $lang] ?>"><?php echo $row_nha_dau_tu['TenQuocGia_' . $lang] ?></option>

                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"> {nguoilienhe}:</td>
                <td>
                    <p>
                        <input name="nguoilienhe" type="text" class="mid_text" id="nguoilienhe" value="<?php echo $row_cty['NguoiLienHe']; ?>" maxlength="20" >
                        <!--<span class="TipText">(Country Code-Area Number-Tel Number)</span>-->
                    </p>
                </td>
            </tr>
            <?php
                if($row_cty['ShopVip']==1){
            ?>
            <tr>
                <td align="right"> Skype:</td>
                <td width="80%">
                    <p>
                    <div class="sort">
                            <?php                               
                                $arr_skype=$row_cty['Skype'];                                
                                $arr=rtrim($arr_skype, ',' );                               
                                
                                $arr1 = explode(",", $arr);
                                $dem=  count($arr1);
                                //var_dump($arr);
                                for($i=0;$i<$dem;$i++){
                            ?>
                            <input style="width: 150px; margin-bottom: 5px;" name="skype[]" type="text" class="skype" id="skype" value="<?php echo $arr1[$i]; ?>" maxlength="20" >
                                <?php } ?>
                            <div id="wrapper_input_files">


                            </div>            
                            <div class="clear"></div>
                            <span><a><img class="add-skype" height="30" src="../../img/add-user.png"></a></span>
                        </div>
                    </p>                    
                </td>
                
            </tr>
            <tr>
                <td align="right"> QQ:</td>
                <td>
                    <p>
                        <input name="qq" type="text" class="mid_text" id="qq" value="<?php echo $row_cty['QQ']; ?>" maxlength="20" >
                        <!--<span class="TipText">(Country Code-Area Number-Tel Number)</span>-->
                    </p>
                </td>
            </tr>
                <?php } else{ ?>
            <tr>
                <td align="right"> Skype:</td>
                <td>
                    <p>
                        <input disabled="true" name="skype" type="text" class="mid_text" id="skype" value="<?php echo $row_cty['Skype']; ?>" maxlength="20" >
                        <!--<span class="TipText">(Country Code-Area Number-Tel Number)</span>-->
                    </p>
                </td>
                <td rowspan="2" width="40%"><p class="sort">{danhchovip}</p></td>
            </tr>
            <tr>
                <td align="right"> QQ:</td>
                <td>
                    <p>
                        <input disabled="true" name="qq" type="text" class="mid_text" id="qq" value="<?php echo $row_cty['QQ']; ?>" maxlength="20" >
                        <!--<span class="TipText">(Country Code-Area Number-Tel Number)</span>-->
                    </p>
                </td>
            </tr>
                <?php } ?>
            <tr>
                <td align="right"><span class="red">*</span> {didong}:</td>
                <td>
                    <p>
                        <input name="didong" type="text" class="mid_text" id="didong" value="<?php echo $row_cty['DiDong']; ?>" maxlength="20" >
                        <!--<span class="TipText">(Country Code-Area Number-Tel Number)</span>-->
                    </p>
                </td>
            </tr>
            <tr>
                <td align="right">{dienthoai}:</td>
                <td>
                    <input name="dienthoai" type="text" class="mid_text" id="dienthoai" value="<?php echo $row_cty['DienThoai']; ?>" maxlength="20" ></td>
            </tr>
            <tr>
                <td align="right">{fax}:</td>
                <td>
                    <p>
                        <input name="fax" type="text" class="mid_text" id="fax" value="<?php echo $row_cty['Fax']; ?>" maxlength="20">
                    </p>
                </td>
            </tr>
            <tr>
                <td align="right" valign="top"><span class="red">*</span> {email}:</td>
                <td><input name="email" type="text" class="mid_text" id="email" value="<?php echo $row_cty['Email']; ?>" maxlength="100" onKeyUp="value = value.replace(/[^a-zA-Z0-9@;._-]/g, '')"></td>
            </tr>
            <tr>
                <td align="right">Website:</td>
                <td>http://
                    <input name="website" type="text" class="mid_text" id="website" value="<?php echo $row_cty['Website']; ?>" maxlength="200"></td>
            </tr>


        </table>
        <p>&nbsp;</p>
        <p class="sort ttct">{ttct}<span class="red"> *</span> </p>
        <p>&nbsp;</p>
        <table id='ttct' width="80%" border="0" align="center" cellpadding="0" cellspacing="0" class="form_table">
            <tr>
                <td width="25%" align="right" nowrap><p style="color: red;">{gioithieu}:</p></td>
                <td></td>
            </tr>

            <tr class="left">

                <td>{ndvietnam}</td>

                <td><div style="width:500px;overflow: hidden">

                        <textarea class="meta" name="gioithieu_vi" id="gioithieu_vi">

                            <?php echo $row_cty['GioiThieu_vi']; ?>

                        </textarea>

                        <script type="text/javascript">

                            var editor = CKEDITOR.replace('gioithieu_vi', {
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

                <td>{nddailoan}</td>

                <td><div style="width:500px;overflow: hidden">

                        <textarea class="meta" name="gioithieu_cn" id="gioithieu_cn">

                            <?php echo $row_cty['GioiThieu_cn']; ?>

                        </textarea>

                        <script type="text/javascript">

                            var editor = CKEDITOR.replace('gioithieu_cn', {
                                uiColor: '#9AB8F3',
                                language: 'vi',
                                skin: 'kama',
                                filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?Type=Images',
                                filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?Type=Flash',
                                filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                toolbar: [
                                    ['Source', '-', 'Bold', 'Italic', 'Underline', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'Link', 'Unlink', 'Styles', 'Format', 'TextColor', 'BGColor'],
                                ]

                            });

                        </script> 

                    </div></td>

            </tr>

            <tr class="left">

                <td>{ndtienganh}</td>

                <td><div style="width:500px;overflow: hidden">

                        <textarea class="meta" name="gioithieu_en" id="gioithieu_en">

                            <?php echo $row_cty['GioiThieu_en']; ?>

                        </textarea>

                        <script type="text/javascript">

                            var editor = CKEDITOR.replace('gioithieu_en', {
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
            
            <tr>
                <td width="25%" align="right">{spchinh}:</td>
                <td><p>
                        <input name="spchinh" rows="6" class="mid_text" id="spchinh" value="<?php echo $row_cty['SanPhamChinh_cn']; ?>" >
                    </p>
                </td>
            </tr>
        </table>
        
        <p>&nbsp;</p>
        <p class="sort dmnn">{danhmucnghanhnghe}<span class="red"> * </span></p>
        <p>&nbsp;</p>
        <table id="dmnn" width="80%" border="0" align="center" cellpadding="0" cellspacing="0" class="form_table">
            <tr>
                <td width="25%" align="right" valign="top" nowrap><p>{danhmucsp}:</p>
                    <p>({max8})</p></td>
                <td>
                    <div style="float:left;">
                        <?php
                        $congty_id = $row_cty['congty_id'];
                        $sql = "SELECT * FROM cty_cate WHERE congty_id = $congty_id";
                        $rs = mysql_query($sql);
                        $arrCateChon = array();
                        while ($row = mysql_fetch_assoc($rs)) {
                            $arrCateChon[] = $row['cate_id'];
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
                                            <input style="margin-right:5px;" type="checkbox" class="Category" id="Category" name="Category[]" value="<?php echo $row_menu_con['cate_id'] ?>" onclick="chkcontrol();" <?php if (in_array($row_menu_con['cate_id'], $arrCateChon)) echo "checked=checked"; ?>> <?php echo $row_menu_con['cate_name_' . $lang] ?></p>
                                    </div> 
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div> 
                </td>
            </tr>
        </table>
        <p>&nbsp;</p>
        <p class="align_c">
            <input type="button" name="btnDoiThongTin" id="btnDoiThongTin" value="{capnhat}" class="btn_padding">           
            <input type="hidden" name="congty_id" id="congty_id" value="<?php echo $row_cty['congty_id']; ?>">
            <input type="hidden" name="lang" id="lang" value="<?php echo $lang; ?>">
            <span id="thongbao"></span>
        </p>
    </form>
</div>
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