<div class="container-right"><!--- top deal sendo -->
      
      <div class="best-weekend">        
        <div  style="cursor: move;  min-height: 600px; ">
        <?php
            $tieude_id = $tmp_uri[2];
            $arr = explode("-", $tieude_id);
            if($com == 'cat'){
                $cate_id = (int) end($arr);
                $arr_id_hinh = $modelHome->getIdHinhByCateId($cate_id);
                if(empty($arr_id_hinh)){
                    $idTL = mysql_fetch_assoc($modelCate->getIdtlByCateId($cate_id));
                    $arr_id_hinh = $modelHome->getIdHinhByIdTheLoai($idTL['idTL']);
                }
            }
            if($com == 'theloai'){
                $idTL = (int) end($arr);
                $arr_id_hinh = $modelHome->getIdHinhByIdTheLoai($idTL);
            }
                foreach($arr_id_hinh as $id_hinh){
                    $row_hinh = $modelHome->getDetailImageHomeByIdHinh($id_hinh);

                    
            ?>
        <div style="margin-bottom:10px;">
            <a data-fancybox-group="qc" target="_blank" class="fancybox"  href="
                        <?php  echo $row_hinh['Url']; ?>" title="<?php echo $row_hinh['Href']; ?>"><img class="qc"  width="220" height="105" src="<?php echo $row_hinh['Url']; ?>"/></a>
        </div>
        <?php } ?>
        
    </div> 
      </div>
      <!--best hot weekend-
      <div class="best-weekend">        
        <div class="box-in " style="position:relative;overflow:hidden;height:1000px;">
          
            <ul id="newsticker2">
                  <?php 
                        $sp=$modelProduct->getProduct($offset, $limit);
                        while ($row_sp=  mysql_fetch_assoc($sp)){
                            $price=$row_sp['price'];
                    ?>
                  <li style="padding: 10px" class="sticky item-box">
                      <a href="<?php if($row_sp['congty_id']==1113){
                                    echo "http://jpcvienphu.com/san-pham.html";
                                }else{
                                    echo $row_sp['product_alias'].'-'.$row_sp['product_id'].'.html'; 
                                }?>" class="pic _trackLink" title="<?php echo $row_sp['product_name_'.$lang]; ?>" >
                          <img src="<?php echo $row_sp['url_images']; ?>" width="120" height="120" alt="<?php echo $row_sp['product_name_'.$lang]; ?>">
                          <span class="curr-price"><?php if($price==0){echo "{lienhe}";}else {echo number_format($row_sp['price'].' đ');} ?></span>
                          <span class="pr-name"><?php echo $row_sp['product_name_'.$lang]; ?></span>
                      </a>
                  </li>
                 <?php } ?>
            </ul>
          
        </div>
      </div>->
      <div id="123Mua_Home_right_230x180_vitri1_R1" style="text-align: center; margin-top: 25px"></div>
      <!--top promotion sendo-->
      
    </div>