<?php
    $tl = $modelQuocgia->getAllQuocGia();
?>
<script type="text/javascript">
    $(document).ready(function(){		
        $(".linkxoa").live('click',function(){			
            var flag = confirm("Bạn có chắc chắn xóa");
            if(flag == true){
                var idQuocGia = $(this).attr("idQuocGia");
                $.get('xoa.php',{loai:"quocgia",id:idQuocGia},function(data){
                    window.location.reload();			
                });	
            }
        });      
    });
</script>

<div>
    <div>
        <div style="width: 48%;float: left"><h3>{danhmuc} : {xemds}</h3></div>
        <div style="width: 48%;float: left;text-align: right;padding-top: 20px;text-transform: uppercase;font-size: 15px;font-weight: bold"><a href="index.php?com=quocgia_add">Thêm quốc gia</a></div>
    </div>

    <div class="clr" style="clear: both"></div>
</div>
<div id="main_admin">

    <div>

        <div style="text-align: center">                
            <input type="hidden" id="str_order" value="">
            <table id="drag">
                <thead>
                    <tr>
                        <th width="1%"></th>       
                        <th width="1%"> STT</th>
                        <th align="left">{tendailoan}</th>
                        <th align="left">{tenvietnam}</th>
                        <th align="left">{tentienganh}</th>
                        <th width="1%">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    $i = 0;
                    while ($row = mysql_fetch_assoc($tl)) {	                        
                        $i++;                       
                        ?>	
                        <tr id="rows_<?php echo $row['idQuocGia'];?>">
                            <td><input type="checkbox" name="chon" idDM="<?php echo $row['idTL'] ?>"></td>                                
                            <td align="center"><?php echo $i; ?></td>                                
                            <td align="left" style="font-size: larger; font-weight: bold;"><?php echo $row['TenQuocGia_cn'] ?></td>
                            <td align="left" style="font-size: larger; font-weight: bold;"><?php echo $row['TenQuocGia_vi'] ?></td>
                            <td align="left" style="font-size: larger; font-weight: bold;"><?php echo $row['TenQuocGia_en'] ?></td>
                            <td class="action">                                  	
                                <!--<a href="index.php?com=danhmuc_edit&amp;idTL=<?php //echo $row['idTL'] ?>">-->
                                <a href="index.php?com=quocgia_edit&amp;idQuocGia=<?php echo $row['idQuocGia'] ?>">
                                    <img src="img/icons/user_edit.png" alt="Chỉnh sửa" title="Chỉnh sửa" border="0">
                                </a>&nbsp;&nbsp;
                                <img class="linkxoa" idQuocGia="<?php echo $row['idQuocGia'] ?>" src="img/icons/trash.png" alt="Xóa" title="Xóa" border="0">
                            </td>
                        </tr>                        
                        <?php } ?>
                </tbody>
            </table>
        </div>

    </div>


    <div class="clr"></div>
</div>
<div id="article_list">


</div>
<script type="text/javascript">
    $(function(){     
        $('.change_article').click(function(){
            var article_id = $(this).attr('article_id');	
			var menu_id = $(this).attr('menu_id');	
			if(menu_id > 0){		
				choose_article(menu_id, article_id);
			}
        });
        
		$('.duyet_mucluc').click(function(){
                    if(confirm('DUYỆT mục lục này ?')){
			var idML = $(this).attr('idML');
			var sotrang = $('#sotrang_' + idML).val();
			var idSach = $('#idSach_' + idML).val();
			if(sotrang==0){
				alert('Mục lục này chưa có trang nào ! Vui lòng nhập trang hoặc kiểm tra lại.');
				return false;
			}else{
				$.ajax({
					url: "check_mucluc_truoc.php",
					type: "POST",
					async: false,
					data: {"idML":idML,'idSach' :idSach},
					success: function(data){    
                                            alert(data);
                                            window.location.reload();
					}
				});
			}
                    }else{
                        return false;
                    }
		});
                $('.boduyet_mucluc').click(function(){
                    if(confirm('BỎ DUYỆT mục lục này ?')){
			var idML = $(this).attr('idML');			
                        $.ajax({
                                url: "boduyet_mucluc.php",
                                type: "POST",
                                async: false,
                                data: {"idML":idML},
                                success: function(data){                                    
                                     window.location.reload();
                                }
                        });
                    }else{
                        return false;
                    }     
		});
    });
    function choose_article(menu_id, article_id){        
        $.ajax({
            url: "ajax/choose_article.php",
            type: "POST",
            async: false,
            data: {"article_id":article_id,"menu_id" : menu_id},
            success: function(data){
                $("#article_list").html(data);
            }
        });
		
        $("#article_list").dialog({
            modal:true,
            title:'Danh sách bài viết',
            width:800,
            draggable:false,
            resizable:false,
            close:function(){$("#article_list").html('')}
        });

        return false;
    }
</script>