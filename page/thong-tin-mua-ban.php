<?php
//session_start();
$url = $_SERVER['REQUEST_URI'];   
    $_SESSION["url"]=$url;

$link1 = $_SERVER['REQUEST_URI'];
$arr = explode("/", $link1);
$link = $arr[0] . '/' . $arr[1];
//$url = substr($url, 31);
//$_SESSION["url"]=$url; 
// if (isset($_GET['cate_id']) && $_GET['cate_id'] > 0) {
//    $cate_id = (int) $_GET['cate_id'];
//      $link.="&cate_id=$cate_id";
//  } else {
//     $cate_id = -1;
//  }
$page_show = 5;

$limit = 10;
//echo $cate_id;
$trangs = $modelProduct->getProductNews( -1, -1);

$total_record = mysql_num_rows($trangs);

$total_page = ceil($total_record / $limit);

$page1 = $tmp_uri[1];
//$page=$_GET[page1];
if ($page1 > 1) {
    $page = $page1;
} else {
    $page = 1;
}

$offset = $limit * ($page - 1);

/*if ($cate_id > 0) {
    //echo "123";die(113);
    $list_trang = $modelProduct->getListCongTyByTheLoai($cate_id, $offset, $limit);
} else {*/
    $list_trang = $modelProduct->getProductNews($offset, $limit);
    
   
//}

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
        <form method="post" id="register" name="register" action="">
            <input type="hidden" name="url" value=""/>
            <div class="block_content">
                <h3 class="reg_title">
                    <img style="top: 120px;position: absolute;" src="img/tin-tuc.png"/>
                    <span style="margin-left:65px">{tintucmuaban}<a style="margin-left:100px; font-weight: bold;" href="http://asiatiger.org/khach-hang/them-san-pham.html">{themtinmuaban}</a></span>
                </h3>

                <div class="w3" >
                    <?php /*
                    <div class="resultsCent">
                        <div >

                            <div class="category">
                                <div class="link" id="catgoryDiv">
                                    <h2 class=" strong">{danhmucsp}:</h2>
                                    <!--产品显示分类 -->
                                    <ul>
                                       
                                    </ul>                        
                                    <!--<div class="cl"></div>
                                    <div class="more" id="catCodeMore" >
                                        <a rel="nofollow" href="javascript:void(0);" id="catCode_more" onclick="showMore('catCode')">More</a>
                                    </div>
                                    <div class="less" style="display:none" id="catCodeLess">
                                        <a rel="nofollow" href="javascript:void(0);" id="catCode_less"  onclick="hideMore('catCode')">Less</a>
                                    </div>
                                    <div class="cl"></div>
                                    <!--分类显示结束-->
                                </div>


                            </div>


                        </div>
                    </div> */?>
                    <div id="indexmain">
                        <p class="title" id="pshowProduct">
                            <strong class="select" id="showProduct">{sanpham}</strong>

                        </p>
                        <p style="display:none" id="pBackToProduct"><a id="backToProduct" href="javascipt:void(0)">&lt; Back to list items</a></p>
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
                                        <tr  class="color " >
                                        
                                            <td class="center js-preview ">
                                                <span class="<?php if($row['LoaiHinh']==1){
                                                                            echo "canban";
                                                                }  else {
                                                                    echo "canmua";
                                                                } 
                                                            ?> ">
                                                    <?php 
                                                        if($row['LoaiHinh']==1){
                                                                    echo '{canban}';
                                                        }  else {
                                                            echo "{canmua}";
                                                        }
                                                                
                                                   ?></span>
                                                
                                                    
                                                
                                                <div class="photo100" data-np4Url= "<?php echo $row['url_images']; ?>">
                                                    <div class="thumbnails140105">
                                                        <div class="md-hnvalign">
                                                            <div class="md-hnvalign-mid">
                                                                <div class="md-hnvalign-mid-inner">
                                                                    <a href="<?php echo $row['url_images']; ?>" class="fancybox" title = "<?php echo $row['product_name_'.$lang]; ?>" >
                                                                        <img width="100" height="100"  src="
                                                                        <?php
                                                                        if ($row['url_images'] == '') {
                                                                            echo 'img/no_image.jpg';
                                                                        } else {
                                                                            echo $row['url_images'];
                                                                        }
                                                                        ?>
                                                                             "  alt="<?php echo $row['product_name_'.$lang]; ?>" title="<?php echo $row['product_name_'.$lang]; ?>" />
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
                                                    }?>" ><?php echo $row['product_name_'.$lang]; ?></a></h4>
                                                <div class="high" title="" style="max-height:95px; overflow: hidden;">
                                                    <?php echo $row['content_'. $lang]; ?>
                                                </div>
                                                <p><strong>{mota}: </strong><?php echo $row['MoTa_' . $lang]; ?></p>
                                                <p><strong>{gia}: </strong> <?php echo $row['price']; ?></p>
                                                <p><strong>{tencty}: </strong> <?php echo $row_cty['TenCT_'.$lang]; ?></p>
                                                <!--<ul class="pro-ser-icon">
                                                    <li class="st"  title="Royal Supplier" alt="Royal Supplier">13th&nbsp;</li>
                                                </ul>-->
                                            </td>
                                            <td class="center">

                                                <div class="lienhe">
                                                    <a href="cong-ty/<?php echo $row_cty['ten_khong_dau'].'-'.$row_cty['congty_id'].'.html'; ?>">
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
                                    <tr>
                                        <td colspan="3"><?php echo $modelCongTy->phantrangHome($page, $page_show, $total_page, $link); ?></td>
                                    </tr>
                                </table>
                                <input type="submitsubmit" style="display:none;" id="productContactUs">
                            </form>



                        </div>


                    </div>
                </div>

                
            </div>
        </form>
    </div>
<?php include 'blocks/right-content.php'; ?>
</div>