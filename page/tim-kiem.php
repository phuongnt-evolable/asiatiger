<?php
    session_start();
   $url = $_SERVER['REQUEST_URI'];   
    $_SESSION["url"]=$url;
    
     $link1 = $_SERVER['REQUEST_URI'];
     $arr = explode("/", $link1);
     $link=$arr[1];
    
    $cate_tim=$_GET['category_id'];  
    $tukhoa=$_GET['SearchText'];
    
    

    $page_show = 5;

    $limit = 10;
    //echo $cate_id;
    if($cate_tim==2){
        $trangs = $modelCongTy->getListCongTyByTheLoai_TuKhoa($tukhoa,$lang,-1, -1);
    }  else {
        $trangs = $modelProduct->getProductByTuKhoa($tukhoa,$lang,-1, -1);
        
    }
    //$trangs = $modelCongTy->getListCongTyByTheLoai( $cate_id,-1, -1);
    
    $total_record_1 = mysql_num_rows($trangs);
    //$total_record_2 = mysql_num_rows($trangs1);
    
   $total_record = $total_record_1 + $total_record_2;

    $total_page = ceil($total_record / $limit);
    
    //echo $page1=$tmp_uri[2]; 
    $page=$_GET[page];
    if ($page > 1) {
        $page = $page;
    } else {
        $page = 1;
    }

    $offset = $limit * ($page - 1);
    
    if($cate_tim == 2){  
        $list_trang = $modelCongTy->getListCongTyByTheLoai_TuKhoa( $tukhoa,$lang,$offset, $limit);
    }else{
        $list_trang = $modelProduct->getProductByTuKhoa( $tukhoa,$lang,$offset, $limit);
        
    }
    
//echo $lang;
?>
<style>
    .lienhe a {
        background-color: #F29101;
        padding: 4px 10px;
        border-radius: 2px;
        cursor: pointer;
        color: #fff;
        display: inline-block;
        -webkit-box-shadow: 0 1px 2px 0 rgba(0,0,0,.1);
        -moz-box-shadow: 0 1px 2px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 2px 0 rgba(0,0,0,.1);
        text-shadow: 1px 1px 0 rgba(0,0,0,.1);
    }
    .lienhe a:hover{
        text-decoration: none;
        background-color: #FFA200;
    }
    .lienhe .ico-csb {
        vertical-align: middle;
        margin-right: 5px;
        position: relative;
        top: 0;
        display: inline-block;
        width: 16px;
        height: 14px;
        background-position: -238px -7px;
        background-image: url(static/ls-sprites-v7.png);
    }
</style>





<link href="css/search.css" rel="stylesheet" type="text/css" />
<link href="css/common.css" rel="stylesheet" type="text/css" />

<div class="container">

    <div class="container-left">
        <div class="w3" >
            
            <?php /*<div class="resultsCent">
         
                
                <div class="category">
                    <div class="link" id="catgoryDiv">
                        <h2 class=" strong">{danhmucsp}:</h2>
                        <!--产品显示分类 -->
                        <div style="clear: both;"></div>
                        <div >
                            <?php  
                                while($row_danhmuc=  mysql_fetch_assoc($danhmuc)){
                                   $cate=$row_danhmuc['cate_id'];
                                   $sql2="Select congty_id From congty Where cate_id=$cate";
                                   $soluong=mysql_query($sql2) or die(mysql_error());
                                   $dem =  mysql_num_rows($soluong);
                            ?>
                            <div style="width:215px;float: left;margin-bottom: 2px">
                                <a  href="cat1/<?php echo $row_danhmuc['cate_alias'].'-'.$row_danhmuc['cate_id'].'.html'?>" alt="<?php echo $row_danhmuc['cate_name_'.$lang]; ?>" title="<?php echo $row_danhmuc['cate_name_'.$lang]; ?>">
                                <?php echo $row_danhmuc['cate_name_'.$lang]; ?>
                                </a>
                                (<?php echo $dem; ?>)
                            </div>
                            <?php } ?> 
                        </div>  
                    </div>


                </div>


           
            </div>*/?>
            <div class="col-xs-60 m-searchbar" style="float:left;">

                <div class="col-offset-r-fixed-xs-11 col-offset-r-fixed-m-0">
                    <div id="home-searchbar" class="ui-searchbar ui-searchbar-size-large ui-searchbar-mod-type">
                        <div class="ui-searchbar-body">
                            <form method="get" action="tim-kiem.html">

                                <div class="ui-searchbar-type">
                                    <div data-widget-cid="widget-2">
                                        <div class="ui-searchbar-type-value">

                                            <select class="ui-searchbar-type-display" name='category_id' id="category_id">                                            
                                                 <option value='2' <?php if($_GET['category_id']==2) echo "selected" ?>>----{theonhacungcap}----</option>
                                                <option value='1' <?php if($_GET['category_id']==1) echo "selected" ?>>----{theosp}----</option>                                           
                                            </select>

                                        </div>

                                    </div>
                                </div>
                                <div class="ui-searchbar-main faqsearchinputbox" style="margin-left: 195px;">
                                    <input type="text" class="ui-searchbar-keyword" id="faq_search_input1" name="SearchText" placeholder="{timgi}">
                                    <input type="hidden" id="lang" value="<?php echo $lang; ?>">
                                </div>                               
                                <input type="submit" class="ui-searchbar-submit" value="{search}">

                            </form>
                        </div>
                    </div>


                </div>
                <div id="searchresultdata" > </div>
            </div>
            
            <div id="indexmain">
                <p class="title" id="pshowProduct">
                    <strong class="select" id="showProduct">{search}</strong>

                </p>
                <p style="display:none" id="pBackToProduct"><a id="backToProduct" href="javascipt:void(0)">&lt; Back to list items</a></p>
                <?php 
                    if($cate_tim==2){
                ?>
                    <div id="productDiv">
                        <div class="searchTit">
                            <?php if($lang=='vi'){ ?>
                                Tìm được <span class="spa"><?php echo $total_record ?></span>  công ty với từ khoá <span class="spa"> <?php echo $tukhoa; ?></span>
                            <?php } ?>
                            <?php if($lang=='cn'){ ?>
                                <span class="spa"><?php echo $tukhoa; ?></span> 在 目 錄 里 找 到 <span class="spa"><?php echo $total_record ?></span> 產品
                            <?php } ?> 
                                <?php if($lang=='en'){ ?>
                                Found <span class="spa"><?php echo $total_record ?></span>  company for <span class="spa"><?php echo $tukhoa; ?></span>
                            <?php } ?>
                        </div>

                        <form method="post" action="#">


                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="searchTable" id="searchProductTable">
                                <colgroup>

                                    <col style="width: 160px;"/>
                                    <col style="width: auto;"/>
                                    <col style="width: 160px;"/>
                                </colgroup>

                                <!-- Hien ds cty khong co Hinh Dai Dien -->
                                <?php  
                                    if($total_record >0){
                                    while ($row = mysql_fetch_assoc($list_trang)) { 
                                        $url1= str_replace("http://www.", "", $row['Website']);
                                        $url2= str_replace("http://", "", $url1);
                                        $url3= str_replace("/", "", $url2);
                                        $website= str_replace("www.", "", $url3);

                                        $idQuocGia=$row['idQuocGia'];
                                        $sql=$modelQuocgia->getDetailQuocGia($idQuocGia);

                                        $row_qg=  mysql_fetch_assoc($sql);
                                ?>
                                <tr  class="color" >

                                    <td class="center js-preview">
                                        <div class="photo100" data-np4Url= "<?php echo $row['HinhDaiDien']; ?>">
                                            <div class="thumbnails140105">
                                                <div class="md-hnvalign">
                                                    <div class="md-hnvalign-mid">
                                                        <div class="md-hnvalign-mid-inner">
                                                            <a href="#" title = "<?php echo $row['TenCT_'.$lang]; ?>" >
                                                                <img width="100" height="100"  src="
                                                                      <?php if($row['HinhDaiDien']==''){ echo 'img/no_image.jpg';} 
                                                                        else {
                                                                            echo $row['HinhDaiDien'];
                                                                        } 
                                                                      ?>
                                                                      "  alt="<?php echo $row['TenCT_'.$lang]; ?>" title="<?php echo $row['TenCT_'.$lang]; ?>" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h4><a class="high" target="_blank" href="cong-ty/<?php echo $row['ten_khong_dau'].'-'.$row['congty_id'].'.html' ?>" >
                                                <?php 
                                                    $str = $row['TenCT_'.$lang];
                                                    $keyword = "$tukhoa";
                                                    echo str_ireplace($keyword, '<span style="color: #A81027;font-weight: bold;">'.$keyword.'</span>', $str); 
                                                ?>
                                            </a></h4>
                                        <p class="high" title="">
                                            <?php 
                                                //$a="<a class='spa'>".$tukhoa."</a>";
                                                //$b=$row['MoTa_'.$lang];
                                                //$chuoi=  str_replace(, $row, $list_trang);
                                               // echo $row['MoTa_'.$lang];
                                                
                                                //$str = $row['MoTa_'.$lang];
                                                //$keyword = $tukhoa;
                                                //$str = preg_replace("/\b([a-z]*${keyword}[a-z]*)\b/i","<b>$1</b>",$str);
                                                //echo "$str";
                                            
                                                /*$str = $row['MoTa_'.$lang];
                                                $keyword = "$tukhoa";
                                                echo str_ireplace($keyword, '<span style="color: #A81027;font-weight: bold;">'.$keyword.'</span>', $str);*/

                                                
                                             ?>
                                        </p>
                                        <p><strong>{diachi}: </strong><?php echo $row['DiaChi_'.$lang]; ?></p>
                                        <?php if($row['DiDong']!=''){ ?>
                                        <p><strong>{didong}: </strong><?php echo $row['DiDong']; ?></p>
                                        <?php } ?>
                                        <p><strong>{dienthoai}: </strong> <?php echo $row['DienThoai'];?></p>
                                        <p><strong>{nguoilienhe}: </strong> <?php echo $row['NguoiLienHe'];?></p>
                                        <p><strong>{spchinh}: </strong> 
						<?php 
                                                //echo $row['MoTa' . $lang];
                                                $str = $row['MoTa_'.$lang];
                                                $keyword = "$tukhoa";
                                                echo str_ireplace($val, '<span style="color: #A81027;font-weight: bold;">'.$val.'</span>', $str);
                                                
                                                ?>						
						<?php //echo $row['SanPhamChinh'];?></p>
                                        <?php if($row['Website']!=''){ ?>
                                        <p><strong>{website}: </strong><a target="_blank" href="http://www.<?php  echo $website; ?>"><?php echo $website; ?></a></p>
                                        <?php } ?>
                                        <p><strong>{quocgia}: </strong> <?php  echo $row_qg['TenQuocGia_'.$lang];?></p>
                                        <!--<ul class="pro-ser-icon">
                                            <li class="st"  title="Royal Supplier" alt="Royal Supplier">13th&nbsp;</li>
                                        </ul>-->
                                    </td>
                                    <td class="center">

                                        <div class="lienhe">
                                            <a href="mailto:<?php echo $row['Email']; ?>">
                                                <span class="ico-csb"></span>
                                                {lienhe}
                                            </a>
                                        </div>
                                        <div style="margin-top: 110px;color: #e35b00;font-weight: bold;">
                                            <a target="_blank" href="cong-ty/<?php echo $row['ten_khong_dau'].'-'.$row['congty_id'].'.html' ?>">{xemthemthongtin}</a>
                                        </div>
                                        &nbsp;
                                    </td>
                                </tr>
                                    <?php } } else { ?>
                                <tr>
                                    <td colspan="3">
                                        <?php
                                            if($lang=='vi'){
                                                echo 'Xin lỗi,  chúng tôi tìm không thấy từ khóa <b>"'.$tukhoa.'"</b> bạn đã nhập , xin xác nhận lại từ khóa bận nhập không có sai hoặc cần thay đổi, hoặc quay về trang chủ tìm kiếm theo ngành nghề , gây bất tiện cho bạn, mong được thông cảm ... <a href="http://asiatiger.org/" ><b>[ Quay về trang chủ ]</b></a>';
                                            }elseif ($lang=='cn') {
                                                echo '很抱歉, 我們找不到您所鍵入的  <b>“'.$tukhoa.'“</b> 請確認您所查詢的關鍵字是否正確或需更換, 或回首頁按行業別搜尋‏, 造成不便, 請見諒‏  ... <a href="http://asiatiger.org/" ><b>[ 回首頁 ]</b></a>';    
                                            }  else {
                                                echo 'Sorry, we could not find the word <b>“'.$tukhoa.'“</b> you entered, please confirm the keywords you enter there is no wrong or need to change, or return to home search by industry, causing inconvenience to you, looking forward sympathy  ... <a href="http://asiatiger.org/" ><b>[ Back to Home ]</b></a>';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                    <?php  } ?>
                                
                                 
                                
                                <tr>
                                    <td colspan="3"><?php echo $modelCongTy->phantrangSearch($page, $page_show, $total_page, $link); ?></td>
                                </tr>
                            </table>
                            <input type="submit" style="display:none;" id="productContactUs">
                        </form>



                    </div>
            <?php } else {  
                    if($total_record > 0){
                ?>
                    <div id="productDiv">
                            <div class="searchTit">
                                
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
                            
                            <form method="post" action="#">


                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="searchTable" id="searchProductTable">
                                    <colgroup>

                                        <col style="width: 160px;"/>
                                        <col style="width: auto;"/>
                                        <col style="width: 160px;"/>
                                    </colgroup>

                                    <?php
                                    // $i = ($page-1)*$limit;
                                    while ($row = mysql_fetch_assoc($list_trang)) {
                                            $congty_id=$row['congty_id'];
                                            $congty=$modelCongTy->getDetailCongTy($congty_id);
                                            $row_cty=  mysql_fetch_assoc($congty);
                                        ?>
                                        <tr  class="color" >

                                            <td class="center js-preview">
                                                <div class="photo100" data-np4Url= "<?php echo $row['url_images']; ?>">
                                                    <div class="thumbnails140105">
                                                        <div class="md-hnvalign">
                                                            <div class="md-hnvalign-mid">
                                                                <div class="md-hnvalign-mid-inner">
                                                                    <a href="<?php echo $row['url_images']; ?>" class="fancybox" title = "<?php echo $row['product_name_' . $lang]; ?>" >
                                                                        <img width="100" height="100"  src="
                                                                        <?php
                                                                        if ($row['url_images'] == '') {
                                                                            echo 'img/no_image.jpg';
                                                                        } else {
                                                                            echo $row['url_images'];
                                                                        }
                                                                        ?>
                                                                             "  alt="<?php echo $row['product_name_' . $lang]; ?>" title="<?php echo $row['product_name_' . $lang]; ?>" />
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h4><a class="high"  href="
                                                    <?php if($congty_id==1113){
                                                        echo "http://jpcvienphu.com/san-pham.html";
                                                    }else{
                                                        echo $row['product_alias'].'-'.$row['product_id'].'.html'; 
                                                    }?>" >
                                                    <?php 
                                                        $str = $row['product_name_'.$lang];
                                                    $keyword = "$tukhoa";
                                                    echo str_ireplace($keyword, '<span style="color: #A81027;font-weight: bold;">'.$keyword.'</span>', $str); 
                                                    ?>
                                                    </a></h4>
                                                <p class="high" title="">
                                                <?php 
                                                //echo $row['MoTa' . $lang];
                                                $str = $row['MoTa_'.$lang];
                                                $keyword = "$tukhoa";
                                                echo str_ireplace($keyword, '<span style="color: #A81027;font-weight: bold;">'.$keyword.'</span>', $str);
                                                
                                                ?>
                                                </p>
                                                <p><strong>{mota}: </strong><?php echo $row['MoTa_' . $lang]; ?></p>
                                                <p><strong>{gia}: </strong> <?php echo $row['price']; ?></p>
                                                <p><strong>{tencty}: </strong> <a href="cong-ty/<?php echo $row['ten_khong_dau'].'-'.$row['congty_id'].'.html' ?>"><?php echo $row_cty['TenCT_'.$lang]; ?></a></p>
                                                <!--<ul class="pro-ser-icon">
                                                    <li class="st"  title="Royal Supplier" alt="Royal Supplier">13th&nbsp;</li>
                                                </ul>-->
                                            </td>
                                            <td class="center">

                                                <div class="lienhe">
                                                    <a href="mailto:<?php echo $row_cty['Email']; ?>">
                                                        <span class="ico-csb"></span>
                                                        {lienhe}
                                                    </a>
                                                </div>
                                                <p class="con">
                                                </p>
                                                &nbsp;
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        
                                        
                                        <?php
                                    // $i = ($page-1)*$limit;
                                         $arr_tu_khoa = explode(" ", $tukhoa);
                                        //var_dump($arr_tu_khoa);
                                        foreach($arr_tu_khoa as $val){
                                            //var_dump($val);
                                           // echo $val.'---';
                                            $list_trang1 = $modelProduct->getProductByTuKhoa($val,$lang,-1, -1);
                                        
                                        
                                    while ($row = mysql_fetch_assoc($list_trang1)) {
                                            $congty_id=$row['congty_id'];
                                            $congty=$modelCongTy->getDetailCongTy($congty_id);
                                            $row_cty=  mysql_fetch_assoc($congty);
                                        ?>
                                        <tr  class="color" >

                                            <td class="center js-preview">
                                                <div class="photo100" data-np4Url= "<?php echo $row['url_images']; ?>">
                                                    <div class="thumbnails140105">
                                                        <div class="md-hnvalign">
                                                            <div class="md-hnvalign-mid">
                                                                <div class="md-hnvalign-mid-inner">
                                                                    <a href="<?php echo $row['url_images']; ?>" class="fancybox" title = "<?php echo $row['product_name_' . $lang]; ?>" >
                                                                        <img width="100" height="100"  src="
                                                                        <?php
                                                                        if ($row['url_images'] == '') {
                                                                            echo 'img/no_image.jpg';
                                                                        } else {
                                                                            echo $row['url_images'];
                                                                        }
                                                                        ?>
                                                                             "  alt="<?php echo $row['product_name_' . $lang]; ?>" title="<?php echo $row['product_name_' . $lang]; ?>" />
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h4><a class="high"  href="
                                                    <?php if($congty_id==1113){
                                                        echo "http://jpcvienphu.com/san-pham.html";
                                                    }else{
                                                        echo $row['product_alias'].'-'.$row['product_id'].'.html'; 
                                                    }?>" >
                                                    <?php 
                                                        $str = $row['product_name_'.$lang];
                                                    $keyword = "$tukhoa";
                                                    echo str_ireplace($val, '<span style="color: #A81027;font-weight: bold;">'.$val.'</span>', $str); 
                                                    ?>
                                                    </a></h4>
                                                <p class="high" title="">
                                                <?php 
                                                //echo $row['MoTa' . $lang];
                                                $str = $row['MoTa_'.$lang];
                                                $keyword = "$tukhoa";
                                                echo str_ireplace($val, '<span style="color: #A81027;font-weight: bold;">'.$val.'</span>', $str);
                                                
                                                ?>
                                                </p>
                                                <p><strong>{mota}: </strong><?php echo $row['MoTa_' . $lang]; ?></p>
                                                <p><strong>{gia}: </strong> <?php echo $row['price']; ?></p>
                                                <p><strong>{tencty}: </strong> <a href="cong-ty/<?php echo $row['ten_khong_dau'].'-'.$row['congty_id'].'.html' ?>"><?php echo $row_cty['TenCT_'.$lang]; ?></a></p>
                                                <!--<ul class="pro-ser-icon">
                                                    <li class="st"  title="Royal Supplier" alt="Royal Supplier">13th&nbsp;</li>
                                                </ul>-->
                                            </td>
                                            <td class="center">

                                                <div class="lienhe">
                                                    <a href="mailto:<?php echo $row_cty['Email']; ?>">
                                                        <span class="ico-csb"></span>
                                                        {lienhe}
                                                    </a>
                                                </div>
                                                <p class="con">
                                                </p>
                                                &nbsp;
                                            </td>
                                        </tr>
                                        <?php } }?>
                                        
                                        
                                    <tr>
                                        <td colspan="3"><?php echo $modelCongTy->phantrangSearch($page, $page_show, $total_page, $link); ?></td>
                                    </tr>
                                </table>
                                <input type="submitsubmit" style="display:none;" id="productContactUs">
                            </form>



                        </div>
            <?php } else {
                        header('Location: http://asiatiger.org/tim-kiem.html?category_id=2&SearchText='.$tukhoa);
                  } } ?>
            </div>
        </div>

        



        
    </div>  		   
    <?php include 'blocks/right-content.php'; ?>
</div>    




