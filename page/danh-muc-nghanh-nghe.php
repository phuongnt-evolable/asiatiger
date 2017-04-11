<?php
    session_start();
   echo $url = $_SERVER['REQUEST_URI'];   
    $_SESSION["url"]=$url;
    $chuoi= substr( $_SESSION["url"],  1);
    $tieude_id = $tmp_uri[2]; 
    $arr = explode("-", $tieude_id);      
   echo $idTL = (int) end($arr);die;
      
    
    $link1 = $_SERVER['REQUEST_URI'];
    $arr = explode("/", $link1);
    $link = $arr[1].'/'.$arr[2];
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
    $idQuocGia=$_GET['idQuocGia'];
    if($idQuocGia!=''){
        $trangs = $modelCongTy->getListCongTyByQuocGia( $cate_id,$idQuocGia,-1, -1);
    }else{
        $trangs = $modelCongTy->getListCongTyByTheLoai( $cate_id,-1, -1);
    }
    

    $total_record = mysql_num_rows($trangs);

    $total_page = ceil($total_record / $limit);
    
    $page1=$tmp_uri[3]; 
    //$page=$_GET[page1];
    if ($page1 > 1) {
        $page = $page1;
    } else {
        $page = 1;
    }

   $offset = $limit * ($page - 1);
    
    if($cate_id > 0){
        if($idQuocGia!=''){
            $list_trang1 = $modelCongTy->getListCongTyByQuocGiaCoImg($cate_id,$idQuocGia,$offset,$limit);
            $list_trang = $modelCongTy->getListCongTyByQuocGiaNoImg($cate_id,$idQuocGia,$offset,$limit);
        }else{
            $list_trang1 = $modelCongTy->getListCongTyByTheLoaiCoImg($cate_id,$offset,$limit);
            $list_trang = $modelCongTy->getListCongTyByTheLoaiNoImg($cate_id,$offset,$limit);
        }   
    }else{
        $list_trang = $modelCongTy->getListCongTyByCategory( $offset, $limit);
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
            
            <div class="resultsCent">
         
                
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
                    <div class="link" id="catgoryDiv" style="clear: both;margin-top: 20px;">
                        <h2 class=" strong">{quocgia}:</h2>
                        <!--产品显示分类 -->
                        <div style="clear: both;"></div>
                        <div >
                            <?php  
                                //$cate_id = 1;
                                $sql = "SELECT * FROM cty_cate WHERE cate_id = $cate_id";
                                $rs = mysql_query($sql);
                                while($row = mysql_fetch_assoc($rs)){
                                        $cate_id = $row['cate_id'];
                                        $congty_id = $row['congty_id'];
                                        $s = "SELECT * FROM congty WHERE congty_id = $congty_id";
                                        $rs1 = mysql_query($s) or die(mysql_error());
                                        $row1 = mysql_fetch_assoc($rs1);	
                                        $idQuocGia = $row1['idQuocGia'];	
                                        $arrQuocGia[$idQuocGia]++;
                                }
                                foreach($arrQuocGia as $idQuocGia=> $so_cong_ty){
                                        $sql = "Select * From category Where cate_id=$cate_id";
                                        $rs = mysql_query($sql);
                                        $row = mysql_fetch_assoc($rs);
                                        if($idQuocGia > 0){
                                                $sql = mysql_query("SELECT * FROM quocgia WHERE idQuocGia = $idQuocGia");
                                                $rowqg = mysql_fetch_assoc($sql); ?>
                                                
                                    <div style="width:215px;float: left;margin-bottom: 2px">
                                        <a  href="cat1/<?php echo $row['cate_alias'].'-'.$row['cate_id'].'.html'.'?idQuocGia='.$rowqg['idQuocGia']?>" alt="<?php echo $rowqg['TenQuocGia_'.$lang]; ?>" title="<?php echo $rowqg['TenQuocGia_'.$lang]; ?>">
                                            <?php echo $rowqg['TenQuocGia_'.$lang].' ('.$so_cong_ty.')'; ?>
                                        </a>
                                        
                                    </div>
                             <?php    }   }     ?>
                            
                            
                        </div>  
                        
                    </div>

                </div>


           
            </div>
            <div id="indexmain">
                <p class="title" id="pshowProduct">
                    <strong class="select" id="showProduct">{sanpham}</strong>

                </p>
                <p style="display:none" id="pBackToProduct"><a id="backToProduct" href="javascipt:void(0)">&lt; Back to list items</a></p>
                <div id="productDiv">
                    <div class="searchTit">
                        <?php if($lang=='vi'){ ?>
                            Tìm được <span class="spa"><?php echo $total_record ?></span>  công ty trong danh mục <span class="spa"><?php echo $row_tl['cate_name_'.$lang]; ?></span>.
                        <?php } ?>
                        <?php if($lang=='cn'){ ?>
                            <span class="spa"><?php echo $row_tl['cate_name_'.$lang]; ?></span> 在 目 錄 里 找 到 <span class="spa"><?php echo $total_record ?></span> 產品
                        <?php } ?> 
                            <?php if($lang=='en'){ ?>
                            Found <span class="spa"><?php echo $total_record ?></span>  company for category<span class="spa"><?php echo $row_tl['cate_name_'.$lang]; ?></span>.
                        <?php } ?>
                    </div>

                    <form method="post" action="#">
                        

                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="searchTable" id="searchProductTable">
                            <colgroup>
                                
                                <col style="width: 160px;"/>
                                <col style="width: auto;"/>
                                <col style="width: 160px;"/>
                            </colgroup>
                            
                            <!-- Hien ds cty co Hinh Dai Dien -->
                            <?php
                               // $i = ($page-1)*$limit;
                                while ($row = mysql_fetch_assoc($list_trang1)) { 
                            ?>
                            <tr  class="color" >
                                
                                <td class="center js-preview">
                                    <div class="photo100" >
                                        <div class="thumbnails140105">
                                            <div class="md-hnvalign">
                                                <div class="md-hnvalign-mid">
                                                    <div class="md-hnvalign-mid-inner">
                                                        <a  class="fancybox" href="<?php echo $row['HinhDaiDien']; ?>" title = "<?php echo $row['TenCT_'.$lang]; ?>" >
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
                                    <h4><a class="high" target="_blank" href="cong-ty/<?php echo $row['ten_khong_dau'].'-'.$row['congty_id'].'.html' ?>" ><?php echo $row['TenCT_'.$lang]; ?></a></h4>
                                    <p class="high" title="">
                                        <?php echo $row['GioiThieu_'.$lang]; ?>
                                    </p>
                                    <p><strong>{diachi}: </strong><?php echo $row['DiaChi_'.$lang]; ?></p>
                                    <p><strong>{dienthoai}: </strong> <?php echo $row['DienThoai'];?></p>
                                    <p><strong>{spchinh}: </strong> <?php echo $row['SanPhamChinh'];?></p>
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
                                    <p class="con">
                                    </p>
                                    &nbsp;
                                </td>
                            </tr>
                                <?php }  ?>
                            
                            <!-- Hien ds cty khong co Hinh Dai Dien -->
                            <?php                               
                                while ($row = mysql_fetch_assoc($list_trang)) { 
                            ?>
                            <tr  class="color" >
                                
                                <td class="center js-preview">
                                    <div class="photo100" data-np4Url= "<?php echo $row['HinhDaiDien']; ?>">
                                        <div class="thumbnails140105">
                                            <div class="md-hnvalign">
                                                <div class="md-hnvalign-mid">
                                                    <div class="md-hnvalign-mid-inner">
                                                        <a href="cong-ty/<?php echo $row['ten_khong_dau'].'-'.$row['congty_id'].'.html' ?>" title = "<?php echo $row['TenCT_'.$lang]; ?>" >
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
                                    <h4><a class="high" target="_blank" href="cong-ty/<?php echo $row['ten_khong_dau'].'-'.$row['congty_id'].'.html' ?>" ><?php echo $row['TenCT_'.$lang]; ?></a></h4>
                                    <p class="high" title="">
                                        <?php echo $row['GioiThieu_'.$lang]; ?>
                                    </p>
                                    <p><strong>{diachi}: </strong><?php echo $row['DiaChi_'.$lang]; ?></p>
                                    <p><strong>{dienthoai}: </strong> <?php echo $row['DienThoai'];?></p>
                                    <p><strong>{spchinh}: </strong> <?php echo $row['SanPhamChinh'];?></p>
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
                                    <p class="con">
                                    </p>
                                    &nbsp;
                                </td>
                            </tr>
                                <?php }  ?>
                            
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
    <?php include 'blocks/right-content.php'; ?>
</div>    




