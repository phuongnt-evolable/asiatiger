<?php 
$link = "index.php?com=error_list";

$page_show=5;

$limit = 10;

$trangs = $trang->Error_List(-1,-1);

$total_record = mysql_num_rows($trangs);

$total_page = ceil($total_record/$limit);

if(isset($_GET[page])==false){
	$page = 1;
}
else{ 
	$page=$_GET[page];
	settype($page,"int");
}

$offset = $limit * ($page - 1);
$list_trang = $trang->Error_List($limit,$offset);

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
		})
        
	})
</script>
<script type="text/javascript">
	$(document).ready(function(){		
		//$('#idDMs').load('blocks/ajax_laydanhmuctrang.php?idSach=' + $("#idSach").val());
		//$("#idSach").load("blocks/ajax_laysach.php?idML="+ $("#idMLs").val());
		<?php if(isset($_GET[idDMs])){?>
			$('#idDMs').val(<?php echo $_GET[idDMs]?>);
		<?php } ?>
		<?php if(isset($_GET[idSachs])){?>
			$('#idSach').val(<?php echo $_GET[idSachs]?>);
		<?php } ?>
		<?php if(isset($_GET[idMLs])){?>
			$('#idMLs').val(<?php echo $_GET[idMLs]?> );
		<?php } ?>
		
		$("#idSach").change(function(){						
			$('#idDMs').load('blocks/ajax_laydanhmuctrang.php?idSach=' + $(this).val());
		})
		$("#idMLs").change(function(){
			$("#idSach").load("blocks/ajax_laysach.php?idML="+ $(this).val());
		})
	});

</script>

<div id="admin_navigation">
	<div style="float:left;width:80%">
		<h3>Quản lý trang : Xem danh sách</h3>
    </div>
    <div style="float:left;width:5%;padding-top:5px">
        <a href="index.php?com=trang_add"><input type="button" class="new" name="btnNew" value=""/></a><br />		
        <span>New</span>
    </div>
	<div style="float:left;width:5%;padding-top:5px">
    	<input type="submit" class="save" name="btnSumit" value=""/><br />		
        <span>Save</span>
    </div>
    <div style="float:left;width:5%;padding-top:5px">
    	<input type="reset" class="cancel" name="btnCancel" value=""/><br />		
        <span>Reset</span>
    </div>
    <div class="clr"></div>
</div>
<div id="main_admin">
	
	<div>
    	<fieldset>
        	<legend>++ Danh sách ++</legend>
            	<div style="text-align: center">                     
                    <table id="rounded-corner" summary="2007 Major IT Companies&#39; Profit">
                        <thead>
                        	<tr>
                                <td colspan="5">
                            <form method="get" action="" name="formTim" id="formTim">
                                Thư mục 
                                <select name='idMLs' id="idMLs">
                                    <option value='0'>Chọn thư mục</option>
                                    <?php $MucLuc1 = $ml->MucLuc_List();
                                    while($row1 =  mysql_fetch_assoc($MucLuc1)){
                                    ?>
                                    <option <?php if($_GET[idMLs]==$row1[idML]) echo "selected"; ?> value='<?php echo $row1[idML]?>'><?php echo $row1['TenMucLuc']; ?></option>
                                    <?php } ?>
                                </select>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Sách 
                                <select name='idSachs' id="idSach">
                                    <option value='0'>Chọn sách</option>
                                    <?php $sach1 = $s->Sach_List();
                                    while($row2 =  mysql_fetch_assoc($sach1)){
                                    ?>
                                    <option <?php if($_GET['idSachs']==$row2[idSach]) echo "selected=selected"; ?> value='<?php echo $row2[idSach]?>'><?php echo $row2['TenSach']; ?></option>
                                    <?php } ?>
								</select>
                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     
                                 Mục Lục 
                                 <select name='idDMs' id="idDMs">
                                    <option value='0'>Chọn mục lục</option>
                                    <?php $danhmuc1 = $dm->DanhMuc_List();
                                    while($row3 =  mysql_fetch_assoc($danhmuc1)){
                                    ?>
                                    <option <?php if($_GET['idDMs']==$row3[idDM]) echo "selected=selected"; ?> value='<?php echo $row3[idDM]?>'><?php echo $row3['DanhMuc']; ?></option>
                                    <?php } ?>
                                </select> 
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                         
                                 <input type="submit" name="btnSubmit" id="btnSubmit" value="  Xem " />
                                                                  <br /><br />
                                    <input type="hidden" name="com" value="trang_list"  />
                                 </form>                                 
                                </td>
                        </tr>
                        <tr>
                                <td colspan="5"><?php echo $ml->phantrang($page,$page_show,$total_page,$link);?></td>
                            </tr>
                            <tr style="color:white;background-color:#06F;height:30px">
                                <th scope="col" class="rounded-company"></th>
								<th scope="col" class="rounded">Tên sách </th>
                                <th scope="col" class="rounded">Mục lục </th>  
                                <th scope="col" class="rounded">Thứ tự trang  </th>                              
                                <th scope="col" class="rounded">Sửa</th>
                              
                            </tr>
                        </thead>

                        <tbody>
                        <?php 
						$i = 0 ;
                        while($row_trang=mysql_fetch_assoc($list_trang)) {   
						$TenSach = $s -> LayTenSach($row_trang['idSach']);
						$TenMucLuc = $dm->LayTenDanhMuc($row_trang['idDM']);              
						$i++;
                        ?>	
                            <tr <?php if($i%2==0) echo "bgcolor='#CCC'" ; ?>>
                                <td><input type="checkbox" name="chon" idDM=<?php echo $row_trang[idTrang]?>></td>                                    
                                <td align="left"><?php echo $TenSach; ?></td> 
                                <td align="left"><?php echo $TenMucLuc; ?></td>  
								<td align="left"><?php echo $row_trang[ThuTu]?></td>  
                               
                                <td><a href="index.php?com=trang_edit&amp;idTrang=<?php echo $row_trang[idTrang]?>"><img src="../img/icons/user_edit.png" alt="" title="" border="0"></a></td>
                                
      <?php } ?>
      <tr>
                                <td colspan="6"><?php echo $ml->phantrang($page,$page_show,$total_page,$link);?></td>
                            </tr>
                        </tbody>
                        
                    </table>
                    </div>
        </fieldset>
    </div>

   
    <div class="clr"></div>
</div>
