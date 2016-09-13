<?php /*
    $tieude_cty=$tmp_uri[4];
    $arr1 = explode("-", $tieude_cty);      
    $congty_id = (int) end($arr1);
    
    $tieude_id = $tmp_uri[3]; 
    $arr = explode("-", $tieude_id);      
    $product_id = (int) end($arr);
    */
    $cate_id=$row_1['category_id'];
    $sql="SELECT cate_name_vi,cate_name_cn,cate_name_en FROM category WHERE cate_id=$cate_id ";
    $rs = mysql_query($sql) or die(mysql_error());
    $row_cate= mysql_fetch_assoc($rs);
?>
<div class="span780-heading"></div>
<div class="span780-content">
    
    <div id="rbox-prdDetail" class="ly-clearFix">
        <input type="hidden" name="encodedId" value="pyvgn3u1jmvga2l" id="encodedId">

        <div class="ly-clearFix">
            <div class="span646">
                <h4 class="prdName"><?php echo $row_1['product_name_'.$lang]; ?></h4>

                <div class="show-prodetail ly-clearFix">
                    <div class="prdImages">
                        <div class="thumbnails280210">
                            <div class="md-hnvalign">
                                <div class="md-hnvalign-mid">
                                    <div class="md-hnvalign-mid-inner">                                    
                                        
                                        <img style="height: 250px; max-width: 250px" src="../<?php echo $row_1['url_images']; ?>" id="bigImg" alt="<?php echo $row_1['product_name_'.$lang]; ?>" title="<?php echo $row_1['product_name_'.$lang]; ?>">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="thumbs ui-nav-hor ly-clearFix">
                        </ul>

                        
                    </div>

                    <div class="prdFormat">
                        <table cellspacing="0" cellpadding="0" class="">
                            <tbody>
                                <tr>
                                    <th>{danhmucsp}</th>
                                    <td><?php echo $row_cate['cate_name_'.$lang]; ?></td>
                                </tr>
                                <tr>
                                    
                                    <td colspan="2"><?php echo $row_1['MoTa_'.$lang]; ?></td>
                                </tr>
                                <tr>
                                    <th>{gia}</th>
                                    <td>
                                            <?php if($row_1['price']==0){echo "{lienhe}";}else {echo number_format($row_1['price']);} ?>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        

                        
                    </div>
                </div>
            </div>

            <?php /*<div class="prdCarousel js-image-scroll">
                <div class="js-image-scroll-visible">
                    <div class=" jcarousel-skin-tango"><div class="jcarousel-container jcarousel-container-vertical" style="position: relative; display: block;"><div class="jcarousel-clip jcarousel-clip-vertical" style="position: relative;"><ul class="jcarousel-list jcarousel-list-vertical" id="imgscroll" style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: 0px; height: 1810px;">
                                    <li class="jcarousel-item jcarousel-item-vertical jcarousel-item-1 jcarousel-item-1-vertical" jcarouselindex="1" style="float: left; list-style: none;">
                                        <div class="thumbnails10075">
                                            <div class="md-hnvalign">
                                                <div class="md-hnvalign-mid">
                                                    <div class="md-hnvalign-mid-inner">
                                                        <a href="gotoprd/AP435/999/0/35251303030383530303.htm" title="Acrylic Diamond Square Sharp Back" alt="Acrylic Diamond Square Sharp Back">
                                                            <img src="./Round Acrylic Stone With 1 Hole - Taiwan buckles,  jewerl accessories,  beads in Clothing Rhinestone Materials on ttnet.net_files/NP110008500-54b.jpg" title="Acrylic Diamond Square Sharp Back" alt="Acrylic Diamond Square Sharp Back">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                </ul></div><div class="jcarousel-prev jcarousel-prev-vertical" disabled="false" style="display: block;"></div><div class="jcarousel-next jcarousel-next-vertical" disabled="false" style="display: block;"></div></div></div>
                </div>



            </div> */?>

        </div>



        <div class="prdSpeci">
            <div class="title">
                <h4 class="titleH">{ctsanpham}</h4>
            </div>
            <?php echo $row_1['content_'.$lang]; ?>

            <div class="clear"></div>


        </div>

        
        <?php
            $product_id=$row_1['product_id'];
            $sql_sp=$modelProduct->getProductByCongTyAndCungLoai($congty_id,$product_id,$cate_id);
            $dem=  mysql_num_rows($sql_sp);
            if($dem > 0){
        ?>

        <div class="HotPrdCon-box">
            <div class="title">
                <h4 class="titleH">{spcungloai}</h4>
            </div>
            <div class="content image-scroll-visible">
                <ul class="ui-nav-hor" id="">
                    <?php                        
                        while($row_sp1=  mysql_fetch_assoc($sql_sp)){
                    ?>
                    <li class="size100146">
                        <div class="thumbnails10075">
                            <div class="md-hnvalign">
                                <div class="md-hnvalign-mid">
                                    <div class="md-hnvalign-mid-inner">
                                        <a href="ctsp/<?php echo $row_sp1['product_alias'].'-'.$row_sp1['product_id'].'/'.'-'.$congty_id.'.html'; ?>" title="<?php echo $row_sp1['product_name_'.$lang]; ?>" alt="<?php echo $row_sp1['product_name_'.$lang]; ?>">
                                            <!--  <a href="/showProductImg/jx6gj2wbj7uwhquw" title="Triangle Acrylic Diamond" alt="Triangle Acrylic Diamond">-->
                                            <img width="100" height="100" src="../<?php echo $row_sp1['url_images']; ?>" title="<?php echo $row_sp1['product_name_'.$lang]; ?>" alt="<?php echo $row_sp1['product_name_'.$lang]; ?>">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="ctsp/<?php echo $row_sp1['product_alias'].'-'.$row_sp1['product_id'].'/'.'-'.$congty_id.'.html'; ?>" title="<?php echo $row_sp1['product_name_'.$lang]; ?>" alt="<?php echo $row_sp1['product_name_'.$lang]; ?>">
                            <span> <?php echo $row_sp1['product_name_'.$lang]; ?> </span>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <?php } ?>

        

    </div>


</div>
<div class="span780-footer"></div>
