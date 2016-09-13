<?php
$link = "index.php?com=menu_list";
$sach = $modelMenu->menu_list();
?>
<script type="text/javascript">
    $(document).ready(function(){		
        $(".linkxoa").live('click',function(){			
            var flag = confirm("Bạn có chắc chắn xóa");
            if(flag == true){
                var menu_id = $(this).attr("menu_id");
                $.get('xoa.php',{loai:"menu",id:menu_id},function(data){
                    window.location.reload();			
                });	
            }
        });      
    });
</script>

<div>
    <div >
        <h3>Quản lý menu : Xem danh sách</h3>
    </div>

    <div class="clr"></div>
</div>
<div id="main_admin">

    <div>

        <div style="text-align: center">                
            <input type="hidden" id="str_order" value="">
            <table id="drag">
                <thead>
                    <tr>
                        <th width="1%"></th>       
                        <th width="1%"> Menu ID</th>
                        <th align="left">Menu</th> 
                        <th align="left">Bài viết</th>                        
                        <th width="1%">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    $i = 0;
                    while ($row = mysql_fetch_assoc($sach)) {
						$article_id = $row['article_id'];
						$rs_article = $modelArticle->getDetailArticle($article_id);
						$arrDetailArticle = mysql_fetch_assoc($rs_article);
                        $i++;                       
                        ?>	
                        <tr id="rows_<?php echo $row['menu_id'];?>">
                            <td><input type="checkbox" name="chon" idDM="<?php echo $row['menu_id'] ?>"></td>                                
                            <td align="center"><?php echo $row['menu_id'] ?></td>                                
                            <td align="left"><?php echo $row['menu'] ?></td>
                            <td align="left"><?php echo $arrDetailArticle['title'] ?></td>
                            <td class="action">      
                            	<img class="change_article" article_id="<?php echo $row['article_id']; ?>" src="img/icons/detail.png" alt="Chọn bài viết" title="Chọn bài viết" border="0" menu_id="<?php echo $row['menu_id']; ?>">&nbsp;&nbsp;                   
                                <a href="index.php?com=menu_edit&amp;menu_id=<?php echo $row['menu_id'] ?>">
                                    <img src="img/icons/user_edit.png" alt="Chỉnh sửa" title="Chỉnh sửa" border="0">
                                </a>&nbsp;&nbsp;
                                <img class="linkxoa" menu_id="<?php echo $row['menu_id'] ?>" src="img/icons/trash.png" alt="Xóa" title="Xóa" border="0">
                            </td>
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