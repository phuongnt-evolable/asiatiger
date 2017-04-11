<?php
$link = "index.php?com=trang_add";
if (isset($_GET['idMLs']) && $_GET['idMLs'] > 0) {
    $idMLs = $_GET['idMLs'];
    settype($idMLs, "int");
    $link.="&idMLs=$idMLs";
} else {
    $idMLs = -1;
}
if (isset($_GET['idSachs']) && $_GET['idSachs'] > 0) {
    $idSachs = $_GET['idSachs'];
    settype($idSachs, "int");
    $link.="&idSachs=$idSachs";
} else {
    $idSachs = -1;
}
if (isset($_GET['idDMs']) && $_GET['idDMs'] > 0) {
    $idDMs = $_GET['idDMs'];
    settype($idDMs, "int");
    $link.="&idDMs=$idDMs";
} else {
    $idDMs = -1;
}

$page_show = 5;

$limit = 10;

$trangs = $trang->Trang_List($idMLs, $idSachs, $idDMs, -1, -1);

$total_record = mysql_num_rows($trangs);

$total_page = ceil($total_record / $limit);

if (isset($_GET['page']) == false) {
    $page = 1;
} else {
    $page = $_GET['page'];
    settype($page, "int");
}

$offset = $limit * ($page - 1);

$list_trang = $trang->Trang_List($idMLs, $idSachs, $idDMs, $limit, $offset);

if (isset($_GET['idTrang'])) {
    $idTrang = $_GET['idTrang'];
    settype($idTrang, "int");
    $chitiet = $trang->Trang_ChiTiet($idTrang);
    $row_ct = mysql_fetch_assoc($chitiet);
}


if (isset($_POST[btnSumit])) {

    if (isset($_GET[idTrang])) {
        $thanhcong = $trang->Trang_Sua($idTrang, $loi);
    } else {
        $thanhcong = $trang->Trang_Them($loi);
    }
    if ($thanhcong == true) {
        header("location:?com=trang_add");
    }
}
?>
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
        if($('#idMLs').val()>0){
            $.get('blocks/ajax_laysach.php',{idML:$('#idMLs').val()},function(data){
                $('#idSach').html(data);
            });                   
        }
        
    })
</script>
<script type="text/javascript">
    function validate(){
        var flg = true;
        if($('#idML').val()==0){
            alert('Chưa chọn thư mục !');
            flg = false;
        }else{
            if($('#idSach').val()==0){
                alert('Chưa chọn sách !');
                flg = false;
            }else{
                if($('#idDM').val()==0){
                    alert('Chưa chọn danh muc !');
                    flg = false;
                }
            }
        }	
		
        return flg;
    }	
    $(document).ready(function(){
<?php if (isset($_GET[idDMs])) { ?>
                            $('#idDMs').val(<?php echo $_GET['idDMs'] ?>);
<?php } ?>
<?php if (isset($_GET[idSachs])) { ?>
                            $('#idSach').val(<?php echo $_GET['idSachs'] ?>);
<?php } ?>
<?php if (isset($_GET[idMLs])) { ?>
                            $('#idMLs').val(<?php echo $_GET['idMLs'] ?> );
<?php } ?>		
                        $("#idSach").change(function(){			
                            var idSach = $(this).val();
                            $('#idDM').load('blocks/ajax_laydanhmuctrang.php?idSach=' + idSach);
                        })
                        $("#idML").change(function(){				
                            $("select[name=idSach]").load("blocks/ajax_laysach.php?idML="+ $(this).val());
                        })
                        $("select[name=idSachs]").change(function(){			
                            var idSach = $(this).val();
                            $('select[name=idDMs]').load('blocks/ajax_laydanhmuctrang.php?idSach=' + idSach);
                        })
                        $("select[name=idMLs]").change(function(){				
                            $("select[name=idSachs]").load("blocks/ajax_laysach.php?idML="+ $(this).val());
                        })
		
                    });

</script>
<form action="" method="post" name="form_add_dm_ks">
    <div>
        <div>
            <h3>Quản lý trang : <?php echo (isset($_GET['idTrang']) ? "Cập nhật" : "Thêm mới") ?></h3>
        </div>    
        <div class="clr"></div>
    </div>
    <div id="main_admin">

        <div id="main_left">

            <table>
                <tr class="left">
                    <td>Thư mục</td>
                    <td>
                            <?php if ($row_ct['idML']) { ?>
                            <select name='idML' id="idML">
                                <option value='0'>Thư mục</option>
                                    <?php
                                    $MucLuc = $ml->MucLuc_List();
                                    while ($row_muc = mysql_fetch_assoc($MucLuc)) {
                                        ?>
                                    <option 								
                                    <?php if ($row_ct['idML'] == $row_muc['idML']) echo "selected"; ?> value='<?php echo $row_muc['idML'] ?>'><?php echo $row_muc['TenMucLuc']; ?></option>
                                <?php } ?>
                            </select>
                                <?php } else { ?>
                            <select name='idML' id="idML">
                                <option value='0'>Thư mục</option>
    <?php
    $MucLuc = $ml->MucLuc_List();
    while ($row_muc = mysql_fetch_assoc($MucLuc)) {
        ?>
                                    <option 								
        <?php if ($_SESSION['idML'] == $row_muc['idML']) echo "selected"; ?> value='<?php echo $row_muc['idML'] ?>'><?php echo $row_muc['TenMucLuc']; ?></option>
    <?php } ?>
                            </select>

<?php } ?>    
                    </td>                        
                </tr> 
                <tr class="left">
                    <td>Tên sách</td>
                    <td>
<?php if ($row_ct['idSach']) { ?>
                            <select name='idSach' id="idSach" style="width:400px">
                                <option value='0'>Chọn sách</option>

                            </select>
<?php } else { ?>
                            <select name='idSach' id="idSach" style="width:400px">
                                <option value='0'>Chọn sách</option>

                            </select>
<?php } ?>    
                    </td>                        
                </tr>     
                <tr class="left">
                    <td>Mục lục</td>
                    <td>
<?php if ($row_ct['idDML']) { ?>
                            <select name='idDM' id="idDM" style="width:400px">
                                <option value='0'>Chọn mục lục</option>

                            </select>
<?php } else { ?>
                            <select name='idDM' id="idDM" style="width:400px">
                                <option value='0'>Chọn mục lục</option>

                            </select>
<?php } ?>   
                    </td>                             
                </tr>                       
                <tr class="left">
                    <td>Ghi chú</td>
                    <td><textarea id="GhiChu" name="GhiChu" style="width:400px;height: 70px">
<?php echo (isset($row_ct['GhiChu']) ? $row_ct['GhiChu'] : $_SESSION['GhiChu']); ?>
                        </textarea>
                    </td>                        
                </tr>



                <tr>
                    <td>Nội dung</td>
                    <td><div style="width:900px;overflow: hidden">
                            <textarea class="meta" name="NoiDung" id="NoiDung"><?php echo (isset($row_ct['NoiDung']) ? $row_ct['NoiDung'] : $_SESSION['NoiDung']); ?></textarea>
                            <script type="text/javascript">
                                var editor = CKEDITOR.replace( 'NoiDung',{
                                    uiColor : '#9AB8F3',
                                    language:'vi',
                                    skin:'office2003',
                                    height:300,
                                    toolbar:[
                                        ['Source','-','Save','NewPage','Preview','-','Templates'],
                                        ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print'],
                                        ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],                                        
                                        ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                                        ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
                                        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],                                       
                                        ['Image','Table','HorizontalRule','SpecialChar','PageBreak'],
                                        ['Styles','Format','Font','FontSize','TextColor','BGColor'],
                                       
                                        ['Maximize', 'ShowBlocks','-','About']
                                    ]
                                });		
                            </script>
                        </div>
                    </td>                        
                </tr>       
                <tr>
                    <td colspan="2" align="left">
                        <div style="padding-left:200px">                           
                                <input type="submit" class="save" name="btnSumit" value="Save" onclick="return validate();"/>		                               
                          
                                <input type="reset" class="cancel" name="btnCancel" value="Reset"/>                                                      
                           
                        </div>
                    </td>
                </tr>                            
            </table>


        </div>
</form>


</div>
