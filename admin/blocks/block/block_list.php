<?php

    $list_block = $modelBlock->getListBlock();

?>
<script type="text/javascript">
     $(document).ready(function(){		
        $(".linkxoa").live('click',function(){			
            var flag = confirm("Bạn có chắc chắn xóa");
            if(flag == true){
                var article_id = $(this).attr("article_id");
                $.get('xoa.php',{loai:"baiviet",id:article_id},function(data){
                    window.location.reload();			
                });	
            }
        });               
    });
</script>
<div>
    <div>
        <div style="width: 48%;float: left"><h3>Quản lý block : Xem danh sách</h3></div>        
    </div>

    <div class="clr" style="clear: both"></div>
</div>
<div id="main_admin">

    <div>

        <div>
            <table>
                <thead>                    
                    <tr>
                        <th width="1%"></th>
                        <th align="center" width="1%">STT</th>
                        <th align="left">Tên block</th>                        
                        <th width="1%">Action</th>

                    </tr>
                </thead>

                <tbody>
                    <?php
                   $i=0;
                    while ($row = mysql_fetch_assoc($list_block)) {                       
                        $i++;
                        ?>
                        <tr <?php if ($i % 2 == 0) echo "bgcolor='#CCC'"; ?>>
                            <td><input type="checkbox" name="chon"></td>
                            <td align="center"><?php echo $i; ?></td>
                            <td align="left"><?php echo $row['block_name']; ?></td>
                                                        <td style="white-space:nowrap">
                                <a href="index.php?com=block_edit&amp;block_id=<?php echo $row['block_id'] ?>">
                                    <img src="img/icons/user_edit.png" alt="" title="" border="0">
                                </a>
                            </td>
                            </tr>
<?php } ?>
                  
                </tbody>

            </table>
        </div>
    </div>


    <div class="clr"></div>
</div>
