<?php
    $user_list = $modelUser->user_list();
?>
<script type="text/javascript">
    $(document).ready(function(){		
        $(".linkxoa").live('click',function(){			
            var flag = confirm("Bạn có chắc chắn xóa");
            if(flag == true){
                var id = $(this).attr("id");
                $.get('xoa.php',{loai:"users",id:id},function(data){
                    window.location.reload();			
                });	
            }
        })
        
    })
</script>

<div>
    <div>
        <h3>User list</h3>
    </div>   
    <div class="clr"></div>
</div>
<div id="main_admin">

    <div>                     
        <table>
            <thead>              

                <tr>
                    <th width="1%"></th>       
                    <th width="1%">User ID</th>                    
                    <th align="left"> Username </th>                                 
                    <th width="150px">Action</th>
                </tr>
            </thead>

            <tbody>

                <?php
                $i = 0;
                while ($row = mysql_fetch_assoc($user_list)) {
                    $i++;
                    ?>	
                    <tr <?php if ($i % 2 == 0) echo "bgcolor='#CCC'"; ?>>
                        <td><input type="checkbox" name="chon" id=<?php echo $row['id'] ?>></td>
                        <td align="left"><?php echo $row['id'] ?></td>                         
                        <td align="left"><?php echo $row['User'] ?></td>                                                                                                            
                        <td style="white-space: nowrap" align="center">                              
                            <a href="index.php?com=user_edit&amp;id=<?php echo $row['id'] ?>">
                                <img src="img/icons/user_edit.png" alt="Chỉnh sửa" title="Chỉnh sửa" border="0">
                            </a>&nbsp;&nbsp;
                            <img class="linkxoa" id="<?php echo $row['id'] ?>" src="img/icons/trash.png" alt="Xóa user" title="Xóa user" border="0">
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>




    <div class="clr"></div>
</div>