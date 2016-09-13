<?php
//session_start();

$url = $_SERVER['REQUEST_URI'];

$_SESSION["url"] = $url;

if (isset($_POST['btnSave'])) {

    $path = "../upload/images/Hinh-san-pham/"; // file sẽ lưu vào thư mục data

    $tmp_name = $_FILES['url_images']['tmp_name'];

    $name = $_FILES['url_images']['name'];

    // Upload file

    move_uploaded_file($tmp_name, $path . $name);



    $category_id = (int) $_POST['category_id'];

    $a = $modelProduct->getIDTL($category_id);

    $row = mysql_fetch_assoc($a);

    $idTL = $row['idTL'];

    $congty_id = (int) $_POST['dscty'];

    $product_name_cn = $_POST['product_name_cn'];

    $product_name_vi = $_POST['product_name_vi'];

    $product_name_en = $_POST['product_name_en'];

    $price = $_POST['price'];

    $url_images = $path . $name;

    $mota_cn = $_POST['mota_cn'];

    $mota_vi = $_POST['mota_vi'];

    $mota_en = $_POST['mota_en'];

    $content_cn = $_POST['content_cn'];

    $content_vi = $_POST['content_vi'];

    $content_en = $_POST['content_en'];

    $loai_hinh = $_POST['loai_hinh'];
    $product_name_alias = $d->changeTitle($product_name_vi);

    $sql = "INSERT INTO product	VALUES(NULL,'$product_name_cn','$product_name_vi','$product_name_en','$product_name_alias','$price','$url_images','$mota_cn','$mota_vi','$mota_en','$content_cn','$content_vi','$content_en','$congty_id','$category_id','$idTL','$loai_hinh')";

    mysql_query($sql) or die(mysql_error() . $sql);

    header("location:http://asiatiger.org/khach-hang/danh-sach-san-pham.html");
}
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

<script type="text/javascript">

    $(document).ready(function() {

        $(".linkxoa").live('click', function() {

            var flag = confirm("Bạn có chắc chắn xóa");

            if (flag == true) {

                var product_id = $(this).attr("product_id");

                $.get('../admin/xoa.php', {loai: "product", product_id: product_id}, function(data) {

                    window.location.reload();

                });

            }

        });

        $('#category_id').change(function() {

            //var id=$(this).val();

            //alert (id);

            $.post('../admin/ajax/getloai.php', {idTL: $(this).val()}, function(data) {

                $('#dscty').html(data);

                // $('#IDKhach').html(data);

            })

        })



    });

</script>

<script type="text/javascript">

    function validate() {

        var flg = true;

        if ($('#category_id').val() == 0) {

            alert('Chưa chọn danh mục!');

            flg = false;

            return flg;

        }

        if ($('#product_name_vi' || '#product_name_cn' || '#product_name_en' || '#mota_en' || '#mota_cn' || '#mota_vi').val() == '') {



            if ($('#lang').val() == 'vi') {

                alert("Bạn chưa nhập đầy đủ thông tin !");

            }
            if ($('#lang').val() == 'cn') {

                alert("您 沒 有 輸 入 足 夠 的 信 息！");

            }
            if ($('#lang').val() == 'en') {

                alert("You have not entered enough information !");

            }



            flg = false;

            return flg;

        }

        var editorText = CKEDITOR.instances.content_bv.getData();

        if (editorText == '') {

            alert('Chưa nhập nội dung!');

            flg = false;

            return flg;

        }

        return flg;

    }

</script>

<div id="right">

    <h1>{themsp} </h1>

  
    <div class="wrap-canban">
        <form  method="post" name="form_add_dm_ks" enctype="multipart/form-data" action="" onsubmit="return validate();">  
        
            <table style="font-size: 12px;" border="0" align="center" cellpadding="0" cellspacing="0" class="form_table">

                <tr>
                    <td class="left">{loaihinh}</td>
                    <td>
                        <label>
                            <input type="radio" name="loai_hinh" value="1" id="loai_hinh_1"  checked="checked"/>
                            {canban}</label>
                        <label>
                            <input style="margin-left: 30px" type="radio" name="loai_hinh" value="0" id="loai_hinh_0"  />
                            {canmua}</label>

                    </td>                        
                </tr>
                <tr class="left">

                    <td width="100px">{danhmuc}</td>

                    <td>

                        <select name='category_id' id="category_id">

                            <option value='0'>----{chon}----</option>

<?php
$rs_cha = $modelCate->getAllTL();

while ($row_cha = mysql_fetch_assoc($rs_cha)) {

    // $idTL=$row_cha['idTL'];
    ?>



                                <optgroup label="<?php echo $row_cha['TenTL_' . $lang] ?>">

    <?php
    $rs_con = $modelCate->getListCate($row_cha['idTL']);

    if (mysql_num_rows($rs_con) > 0) {
        while ($row_con = mysql_fetch_assoc($rs_con)) {
            ?>

                                            <option value="<?php echo $row_con['cate_id'] ?>"><?php echo $row_con['cate_name_' . $lang] ?></option>

                                        <?php }
                                    } else { ?>

                                        <option value="<?php echo $row_cha['cate_id'] ?>"><?php echo $row_cha['cate_name_' . $lang] ?></option>

                                    <?php } ?>

                                </optgroup>



<?php } ?>

                        </select>





                    </td>



                </tr>


                <tr>
                <input type="hidden" id="dscty" name="dscty" value="<?php echo $row_cty['congty_id']; ?>" >

                </tr>

                <tr>
                <input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>" >

                </tr>

                <tr class="left">

                    <td>{tendailoan}</td>

                    <td><input class="large_text" type="text" name="product_name_cn" id="product_name_cn" style="width:300px;height:25px" /></td>

                </tr>

                <tr class="left">

                    <td>{tenvietnam}</td>

                    <td><input type="text" name="product_name_vi" id="product_name_vi" style="width:300px;height:25px" /></td>

                </tr>

                <tr class="left">

                    <td>{tentienganh}</td>

                    <td><input type="text" name="product_name_en" id="product_name_en" style="width:300px;height:25px" /></td>

                </tr>      

                <tr class="left">

                    <td>{gia}</td>

                    <td><input type="text" name="price" id="price" style="width:200px;height:25px" /></td>

                </tr>      



                <tr class="left">

                    <td>{hinhanh}</td>

                    <td><input type="file" name="url_images" class="mid_text"> <br><br> 

                        <p class="sort"> {chuysizehinhsp}</p>

                    </td>



                </tr>

                <tr class="left">

                    <td>{motacn}</td>

                    <td><input type="text" name="mota_cn" id="mota_cn" style="width:300px;height:25px" /></td>

                </tr>

                <tr class="left">

                    <td>{motavi}</td>

                    <td><input type="text" name="mota_vi" id="mota_vi" style="width:300px;height:25px"  /></td>

                </tr>

                <tr class="left">

                    <td>{motaen}</td>

                    <td><input type="text" name="mota_en" id="mota_en" style="width:300px;height:25px"  /></td>

                </tr>

                <tr class="left">

                    <td>{nddailoan}</td>

                    <td><div style="width:500px;overflow: hidden">

                            <textarea class="meta" name="content_cn" id="content_cn">

                            

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



                </tr>

      <!--<tr class="left">

        <td>{loaisp}</td>

        <td>

            <input  name="muaban" type="radio" value="0" />{canban}

            <input style="margin-left: 30px" name="muaban" type="radio" value="1" />{canmua}

        </td>

      </tr>-->





                <tr class="left">

                    <td>&nbsp;</td>

                    <td>

                        <input type="submit" name="btnSave" value="  {capnhat}  "  />

                        <input type="reset" name="btnReset" value="  {nhaplai}  "/>

                    </td>

                </tr>

            </table>



        </form>
    </div>
    <div class="wrap-canmua">
        <form  method="post" name="form_add_dm_ks" enctype="multipart/form-data" action="" onsubmit="return validate();">  

            <table style="font-size: 12px;width: 100%;" border="0" align="center" cellpadding="0" cellspacing="0" class="form_table">

                
                <tr class="left">

                    <td width="">{danhmuc}</td>

                    <td>

                        <select name='category_id' id="category_id">

                            <option value='0'>----{chon}----</option>

<?php
$rs_cha = $modelCate->getAllTL();

while ($row_cha = mysql_fetch_assoc($rs_cha)) {

    // $idTL=$row_cha['idTL'];
    ?>



                                <optgroup label="<?php echo $row_cha['TenTL_' . $lang] ?>">

    <?php
    $rs_con = $modelCate->getListCate($row_cha['idTL']);

    if (mysql_num_rows($rs_con) > 0) {
        while ($row_con = mysql_fetch_assoc($rs_con)) {
            ?>

                                            <option value="<?php echo $row_con['cate_id'] ?>"><?php echo $row_con['cate_name_' . $lang] ?></option>

                                        <?php }
                                    } else { ?>

                                        <option value="<?php echo $row_cha['cate_id'] ?>"><?php echo $row_cha['cate_name_' . $lang] ?></option>

                                    <?php } ?>

                                </optgroup>



<?php } ?>

                        </select>

                    </td>



                </tr>


                <tr>
                <input type="hidden" id="dscty" name="dscty" value="<?php echo $row_cty['congty_id']; ?>" >

                </tr>

                <tr>
                <input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>" >

                </tr>

                <tr class="left">

                    <td>{tendailoan}</td>

                    <td>
                        <div class="tabs-7">
                                <ul class="tabs">
                                <li><a href="#tab25">General</a></li>
                                <li><a href="#tab26">Social Media</a></li>
                                <li><a href="#tab27">Copyright</a></li>
                                <li><a href="#tab28">Contact</a></li>
                            </ul>
                                <section class="tab_content_wrapper">
                                <article class="tab_content" id="tab25">
                                    <p>General calidis mundum caligine coeperunt. Descenderat regat prima dissaepserat humanas tonitrua orbem bracchia. Principio galeae sole. Margine postquam evolvit eodem auroram uno omni ille secrevit regat.<a href="#tab3">General</a> coeptis undae traxit certis secrevit campoque liquidum margine gravitate. Animus convexi origine terrae cesserunt. Tumescere natus proximus lacusque. Otia faecis tonitrua erat hominum aliis radiis moles.</p>
                                    <p>General conversa egens spectent tum sed diremit haec. Dei cinxit zephyro media congeriem septemque rudis. Terrae nubes utramque opifex diu magni reparabat meis nam. Turba habendum. Onus animal est pondere. Foret dedit obsistitur. Tenent homo caligine humanas sanctius dicere sive addidit. Ignea sibi. Aberant mundi iners dispositam altae orbis fronde iunctarum nubibus.</p>
                                </article>
                                <article class="tab_content" id="tab26">
                                    <p>Social Media conversa egens spectent tum sed diremit haec. Dei cinxit zephyro media congeriem septemque rudis. Terrae nubes utramque opifex diu magni reparabat meis nam. Turba habendum. Onus animal est pondere. Foret dedit obsistitur. Tenent homo caligine humanas sanctius dicere sive addidit. Ignea sibi. Aberant mundi iners dispositam altae orbis fronde iunctarum nubibus. Ante parte. Quisquis tractu diu. Iudicis dominari frigida origo surgere fabricator. <a href="#tab4">Social media</a>  piscibus figuras speciem evolvit ulla obstabatque cuncta. Omni grandia terrenae pugnabant pondus quisque orbis ultima.</p>
                                    <p>Social Media calidis mundum caligine coeperunt. Descenderat regat prima dissaepserat humanas tonitrua orbem bracchia. Principio galeae sole. Margine postquam evolvit eodem auroram uno omni ille secrevit regat.Coeptis undae traxit certis secrevit campoque liquidum margine gravitate. Animus convexi origine terrae cesserunt. Tumescere natus proximus lacusque. Otia faecis tonitrua erat hominum aliis radiis moles.</p>
                                </article>
                                <article class="tab_content" id="tab27">
                                    <p>Copyright eurus supplex undae fulgura congestaque locis. Gravitate ante nabataeaque sua naturae satus ad. <a href="#tab2">Copyright</a> madescit pugnabant effervescere abscidit altae. Parte norant principio vultus reparabat omni rapidisque.</p>
                                    <p>Copyright flamma erectos tempora sorbentur illas foret ambitae. Sata locavit triones. Terrarum tuti diversa formas diffundi prima quod regio premuntur. Ipsa pluviaque toto valles conversa quinta.</p>
                                </article>
                                <article class="tab_content" id="tab28">
                                    <p>Contact erat pugnabant diffundi pondere temperiemque. Sole liquidas emicuit mundo pro secant. <a href="#tab1">Contact</a> aer nuper habentem tum in. Secant origine inposuit diverso zonae nubes nulli mundum sectamque.</p>
                                    <p>Contact animalibus circumfluus ignea fert. Undas instabilis coercuit porrexerat. Uno legebantur plagae coeptis. Tanta opifex margine locis omnia obsistitur dispositam sublime erant. Fixo ubi mutatas tuba.</p>
                                </article>
                            </section>
                        </div>
                    </td>

                </tr>

                
                <tr class="left">

                    <td>{gia}</td>

                    <td><input type="text" name="price" id="price" style="width:200px;height:25px" /></td>

                </tr>      



                <tr class="left">

                    <td>{hinhanh}</td>

                    <td><input type="file" name="url_images" class="mid_text"> <br><br> 

                        <p class="sort"> {chuysizehinhsp}</p>

                    </td>



                </tr>

                <tr class="left">

                    <td>{motacn}</td>

                    <td><input type="text" name="mota_cn" id="mota_cn" style="width:300px;height:25px" /></td>

                </tr>

                <tr class="left">

                    <td>{motavi}</td>

                    <td><input type="text" name="mota_vi" id="mota_vi" style="width:300px;height:25px"  /></td>

                </tr>

                <tr class="left">

                    <td>{motaen}</td>

                    <td><input type="text" name="mota_en" id="mota_en" style="width:300px;height:25px"  /></td>

                </tr>

                

               


                <tr class="left">

                    <td>&nbsp;</td>

                    <td>

                        <input type="submit" name="btnSave" value="  {capnhat}  "  />

                        <input type="reset" name="btnReset" value="  {nhaplai}  "/>

                    </td>

                </tr>

            </table>



        </form>
    </div>
</div>



