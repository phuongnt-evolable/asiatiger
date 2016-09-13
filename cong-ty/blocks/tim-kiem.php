
<?php
    session_start();
   $url = $_SERVER['REQUEST_URI'];   
    $_SESSION["url"]=$url;
    
     $link1 = $_SERVER['REQUEST_URI'];
     $arr = explode("/", $link1);
     $link=$arr[1];    
    $cty_id=$_GET['cty_id'];  
    $tukhoa=$_GET['SearchText'];    

    $page_show = 5;

    $limit = 10;
    //echo $cate_id;    
    $trangs = $modelProduct->getProductByTuKhoaAndCty_id($tukhoa,$cty_id,-1,-1);
    
    //$trangs = $modelCongTy->getListCongTyByTheLoai( $cate_id,-1, -1);

    $total_record = mysql_num_rows($trangs);

    $total_page = ceil($total_record / $limit);
    
    //echo $page1=$tmp_uri[2]; 
    $page=$_GET[page];
    if ($page > 1) {
        $page = $page;
    } else {
        $page = 1;
    }

   $offset = $limit * ($page - 1);    
    
   $list_trang = $modelProduct->getProductByTuKhoaAndCty_id( $tukhoa,$cty_id,$offset, $limit);
    
    
//echo $lang;
?>
<style>
    .spa{
        color: red;
    } 
</style>
<div class="span780-heading"></div>
<div class="span780-content">

    <div class="showhall-box-blank" id="rbox-aboutUs">
        
        <div class="showhall-box-blank" id="rbox-hotPrd">
            <div class="title">
                <h4 class="titleH">
                    <div style="float: left"></div> 
                    <div class="searchTit" style="float: left; width: 400px;">
                        <?php if($lang=='vi'){ ?>
                            Tìm được <span class="spa"><?php echo $total_record ?></span>  sản phẫm  
                        <?php } ?>
                        <?php if($lang=='cn'){ ?>
                            在 目 錄 里 找 到 <span class="spa"><?php echo $total_record ?></span> 產品
                        <?php } ?> 
                        <?php if($lang=='en'){ ?>
                            Found <span class="spa"><?php echo $total_record ?></span> product
                        <?php } ?>
                    </div> 
                </h4>
               
            </div>
            <div class="content">
                <ul class="ui-nav-hor">
                    <?php
                       // if(!empty($arr_product)){ // kiem tra xem co san pham nao hay ko ?
                        //foreach($arr_product as $product){
                         //$congty_id=$product['congty_id'];
                         
                                                      
                        while ($row = mysql_fetch_assoc($list_trang)) { 
                                
                    ?>
                    <li>
                        <div class="thumbnails180135">
                            <div class="md-hnvalign">
                                <div class="md-hnvalign-mid">
                                    <div class="md-hnvalign-mid-inner">
                                        <a   href="ctsp/<?php echo $row['product_alias'].'-'.$row['product_id'].'/'.'-'.$congty_id.'.html'; ?>"   title="<?php echo $row['product_name_'.$lang]; ?>">
                                            <img style="height: 170px;max-width: 170px;" src="../<?php echo $row['url_images']; ?>" alt="<?php echo $row['product_name_'.$lang]; ?>" title="<?php echo $row['product_name_'.$lang]; ?>" />
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
                                <a   href="ctsp/<?php echo $row['product_alias'].'-'.$row['product_id'].'/'.'-'.$congty_id.'.html'; ?>"   title="<?php echo $row['product_name_'.$lang]; ?>">
                                    <?php echo $row['product_name_'.$lang]; ?>
                                </a>
                            </p> 
                            <p class="ProTitle"><b>{gia}:</b>
                                <a style="width: 120px;" href="lien-he/<?php echo $row_cty['ten_khong_dau'].'-'.$row_cty['congty_id'].'.html'; ?>"><?php if($row['price']==0){echo "{lienhe}";}else {echo number_format($row['price']);} ?></a>
                            </p>
                        </div>
                    </li>
                        <?php }  ?>
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
