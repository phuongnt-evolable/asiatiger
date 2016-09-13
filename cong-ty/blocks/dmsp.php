
<div class="span780-heading"></div>
<div class="span780-content">

    <div class="showhall-box-blank" id="rbox-aboutUs">
        
        <div class="showhall-box-blank" id="rbox-hotPrd">
            <div class="title">
                <h4 class="titleH">{danhmucsp}  </h4>
            </div>
            <div class="content">
                <ul class="ui-nav-hor">
                    <?php
                        $tieude_id = $tmp_uri[3]; 
                        $arr = explode("-", $tieude_id);      
                        $cate_id = (int) end($arr);
                        $tieude_id1 = $tmp_uri[4]; 
                        $arr1 = explode("-", $tieude_id1);      
                        $congty_id = (int) end($arr1);
                        $data = $modelProduct->getProductByCongTyAndCate($congty_id,$cate_id) ;
                        while($row_cate=  mysql_fetch_assoc($data)){
                         //$congty_id=$row_cate['congty_id'];
                         
                    ?>
                    <li>
                        <div class="thumbnails180135">
                            <div class="md-hnvalign">
                                <div class="md-hnvalign-mid">
                                    <div class="md-hnvalign-mid-inner">
                                        <a   href="ctsp/<?php echo $row_cate['product_alias'].'-'.$row_cate['product_id'].'/'.'-'.$congty_id.'.html'; ?>"   title="<?php echo $row_cate['product_name_'.$lang]; ?>">
                                            <img style="height: 170px;max-width: 170px;" src="../<?php echo $row_cate['url_images']; ?>" alt="<?php echo $row_cate['product_name_'.$lang]; ?>" title="<?php echo $row_cate['product_name_'.$lang]; ?>" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="thumbnails2lines">
                            <a   href="ttnet/gotoprd/AP435/999/0/051303030383530303.htm"   title="Round Acrylic Stone With 1 Hole">
                                Round Acrylic Stone With 1 Hole
                            </a>
                        </div>-->
                        <div class="thumbnailsHot">
                            <p>
                                <a   href="ctsp/<?php echo $row_cate['product_alias'].'-'.$row_cate['product_id'].'/'.'-'.$congty_id.'.html'; ?>"   title="<?php echo $row_cate['product_name_'.$lang]; ?>">
                                    <?php echo $row_cate['product_name_'.$lang]; ?>
                                </a>
                            </p> 
                            <p class="ProTitle"><b>{gia}:</b>
                                <a style="width: 120px;" href="lien-he/<?php echo $row_cty['ten_khong_dau'].'-'.$row_cty['congty_id'].'.html'; ?>"><?php if($row_cate['price']==0){echo "{lienhe}";}else {echo number_format($row_cate['price']);} ?></a>
                            </p>
                        </div>
                    </li>
                        <?php  } ?>
                </ul>
                <?php if($soluong > 8){ ?>
                    <div class="more">
                        <a href="san-pham/<?php echo $row_cty['ten_khong_dau'].'-'.$row_cty['congty_id'].'.html'; ?>">{xemtatca}</a>
                    </div>
                <?php } ?>
            </div>

        </div>
        
        
    </div>


</div>
<div class="span780-footer"></div>
