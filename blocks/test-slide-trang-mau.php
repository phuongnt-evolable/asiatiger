
    
<div  style="position: relative; top: 0px; left: 0px;  ">
    <!-- Slides Container -->
    <div  style="cursor: move; position: absolute; left: 0px; top: 0px; min-height: 920px; ">
        <?php 
                $category_id=3;
                $hinh=$modelHome->getImageByCateRightHome($category_id,0,8);
                foreach ($hinh as $val => $row_hinh){
                    
            ?>
        <div style="margin-bottom:10px;">
            <a data-fancybox-group="qc" target="_blank" class="fancybox"  href="
                        <?php  echo $row_hinh['Url']; ?>" title="<?php echo $row_hinh['Href']; ?>"><img class="qc"  width="220" height="105" src="<?php echo $row_hinh['Url']; ?>"/></a>
        </div>
        <?php } ?>
        
    </div>    
    
</div>