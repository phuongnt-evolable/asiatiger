<?php
    $sql="SELECT * FROM product WHERE congty_id=$congty_id";
    $sp=mysql_query($sql) or die(mysql_error());
    $Sodong=mysql_num_rows($sp);
   
?>
<div id="right">
    <h1>{dssanpham}</h1>
    <p>&nbsp;</p>
    <p class="sort">
     <?php 
        if ($congty_id==1113){
     ?>
         <?php if($lang=='en'){ ?>
            <span class="bold red"><?php echo $Sodong; ?></span> product added, you can still display up to <span class="bold red"><?php echo $con=50-$Sodong; ?></span> more products.
        <?php } ?>
        <?php if($lang=='cn'){ ?>
             已添加 <span class="bold red"><?php echo $Sodong; ?></span> 項產品，您還可以添加  <span class="bold red"><?php echo $con=50-$Sodong; ?></span></span> 項產品 .
        <?php } ?>
        <?php if($lang=='vi'){ ?>
            <span class="bold red"><?php echo $Sodong; ?></span> sản phẫm được thêm, bạn có thể thêm  <span class="bold red"><?php echo $con=50-$Sodong; ?></span> sản phẩm.
        <?php }  ?>            
            <a href="them-san-pham.html" style="margin-left: 20px; font-weight: bold;">{themsp}</a>
            
    <?php } else { ?>      
        
        <?php if($lang=='en'){ ?>
            <span class="bold red"><?php echo $Sodong; ?></span> product added, you can still display up to <span class="bold red"><?php echo $con=20-$Sodong; ?></span> more products.
        <?php } ?>
        <?php if($lang=='cn'){ ?>
             已添加 <span class="bold red"><?php echo $Sodong; ?></span> 項產品，您還可以添加  <span class="bold red"><?php echo $con=20-$Sodong; ?></span></span> 項產品 .
        <?php } ?>
        <?php if($lang=='vi'){ ?>
            <span class="bold red"><?php echo $Sodong; ?></span> sản phẫm được thêm, bạn có thể thêm  <span class="bold red"><?php echo $con=20-$Sodong; ?></span> sản phẩm.
        <?php }  ?>
        <?php
            if($Sodong <= 20){
        ?>
            <a href="them-san-pham.html" style="margin-left: 20px; font-weight: bold;">{themsp}</a>
        <?php }  ?>    
    <?php } ?>       
    </p>
    <p>&nbsp;</p>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="display_table">
        <tbody><tr>
                <th width="1%" align="center" nowrap=""><p>{hinhanh}</p></th>
        <th align="left">{tensp}</th>
        <th align="left">{mota}</th>
        <th width="1%" align="center" nowrap=""></th>
        </tr>
        <?php
            if($Sodong==0){
        ?>
        <tr>
            <?php if($lang=='en'){ ?>
                <td colspan="4" height="50" align="center"><p>No Products Added, <a href="them-san-pham.html">click here to add new product</a></p></td>
            <?php } ?>
            <?php if($lang=='cn'){ ?>
                 <td colspan="4" height="50" align="center"><p>暫  無 產 品, <a href="them-san-pham.html">請 按 這 裡 來 新 增 產 品</a></p></td>
            <?php } ?>
            <?php if($lang=='vi'){ ?>
                <td colspan="4" height="50" align="center"><p>Hiện chưa có sản phẩm nào, <a href="them-san-pham.html">nhấn vào đây để thêm sản phẩm.</a></p></td>
            <?php } ?>
            
        </tr>
        <?php } else {
            while($row_sp=  mysql_fetch_assoc($sp)){
        ?>
        <tr>
            <td align="center"><a href="#" title="Upload"><img src="../<?php echo $row_sp['url_images']; ?>" width="60" height="80"></a></td>
            <td align="left"><?php echo $row_sp['product_name_'.$lang]; ?></td>
            <td align="left"><?php echo $row_sp['MoTa_'.$lang]; ?></td>
            <td align="center">                
                <p style="margin-bottom: 10px;"><a href="sua-san-pham/<?php echo $row_sp['product_name_'.$lang].'-'.$row_sp['product_id'].'.html' ?>"><img src="../admin/img/icons/user_edit.png" alt="" title="" border="0"></a></p>
                <p><img class="linkxoa-sp" product_id="<?php echo $row_sp['product_id'] ?>" src="../admin/img/icons/trash.png" alt="Xóa" title="Xóa" border="0"></p>
            </td>
        </tr>
            <?php } }?>
        

        </tbody></table>
    <p>&nbsp;</p>
    <!-------------------------- 分頁-------------------------->

    <!-------------------------- 分頁 end-------------------------->
</div>