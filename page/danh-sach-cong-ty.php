<?php
   // session_start();

    
   $url = $_SERVER['REQUEST_URI'];   

    $_SESSION["url"]=$url;

    $chuoi= substr( $_SESSION["url"],  1);

    $tieude_id = $tmp_uri[2]; 

    $arr = explode("-", $tieude_id);      

    $cate_id = (int) end($arr); 

    

    $sql="Select * From category Where cate_id=$cate_id";

    $theloai=mysql_query($sql) or die(mysql_error());                                               

    $row_tl =  mysql_fetch_assoc($theloai);

    
   

    $id_tl=$row_tl['idTL'];

    $sql1="Select * From category Where idTL=$id_tl"; 

    $danhmuc=mysql_query($sql1) or die(mysql_error());
    $tl=$modelCate->getDetailTheLoai($id_tl);

    $row_tl1=  mysql_fetch_assoc($tl);
    

   // $row_danhmuc1=  mysql_fetch_assoc($danhmuc);

    //$row_danhmuc1['cate_name_'.$lang];

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

    if(isset($tmp_uri[3])){
        $page1=$tmp_uri[3];
    }else{
        $page1 =NULL;
    }   

    if ($page1 > 1) {

       $page = $page1;

    } else {

        $page = 1;

    }
    if(isset($_GET['idQuocGia'])){
       $idQuocGia1=$_GET['idQuocGia']; 
       $idQuocGia2 = explode('/',$idQuocGia1);
     //var_dump($idQuocGia2);           
     $idQuocGia_GET = $idQuocGia2[0];
    //var_dump($arr1);
    //echo$idQuocGia= $arr1['1'];
     $quocgia="SELECT * FROM quocgia where idQuocGia=$idQuocGia_GET";
     $rsquocgia=  mysql_query($quocgia);
     $row_quoc_gia=  mysql_fetch_assoc($rsquocgia);
   }else{
    $idQuocGia_GET='';
    $row_quoc_gia='';
   }
     



    if($idQuocGia_GET!=''){
        //echo "vo day r ne"; 
        $trangs = $modelCongTy->getListCongTyByQuocGia( $cate_id,$idQuocGia_GET,-1, -1);
    }else{
        $trangs = $modelCongTy->getListCongTyByTheLoai( $cate_id,-1, -1);
    }

    $total_record = count($trangs);
    
    $total_page = ceil($total_record / $limit);

    $offset = $limit * ($page - 1);

    if($cate_id > 0){

        if($idQuocGia_GET!=''){

            $list_trang = $modelCongTy->getListCongTyByQuocGia($cate_id,$idQuocGia_GET,$offset,$limit);            

        }else{
            $list_trang = $modelCongTy->getListCongTyByTheLoai($cate_id,$offset,$limit);             
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
    <div class="breadcrumbs util-clearfix" style="clear: both;">    

        <div class="breadcrumbs-item" itemtype="http://data-vocabulary.org/Breadcrumb">

            <a href="#" itemprop="url" title=""><span itemprop="title">{trangchu}</span></a>

        </div>



        <div itemtype="http://data-vocabulary.org/Breadcrumb" class="breadcrumbs-item hasSub">            

            <a title="Danh mục nghành nghề" itemprop="url" href="#"><span itemprop="title">{danhmucnghanhnghe}</span></a>

            

            <ul>  

                 <?php 

                    $menu=$modelCate->getAllTL();

                    while ($row_menu=  mysql_fetch_assoc($menu)){

                ?>

                <li><a alt="<?php echo $row_menu['TenTL_'.$lang]; ?>" title="<?php echo $row_menu['TenTL_'.$lang]; ?>" href="cat/<?php echo $row_menu['TenTL_KhongDau'].'-'. $row_menu['idTL'].'.html' ?>"><?php echo $row_menu['TenTL_'.$lang]; ?></a></li> 

                    <?php } ?>

            </ul>             

        </div>



        <div itemtype="http://data-vocabulary.org/Breadcrumb" class="breadcrumbs-item hasSub">

            <a title="<?php echo $row_tl1['TenTL_'.$lang] ?>" itemprop="url" href="cat/<?php echo $row_tl1['TenTL_KhongDau'].'-'. $row_tl1['idTL'].'.html' ?>"><span itemprop="title"><?php echo $row_tl1['TenTL_'.$lang] ?></span></a>

            <ul> 

                <?php

                    $tl1=$modelCate->getListCate($id_tl);

                    while($row_tl1=  mysql_fetch_assoc($tl1)){

                ?>

                <li><a alt="<?php echo $row_tl1['cate_name_'.$lang]; ?>" title="<?php echo $row_tl1['cate_name_'.$lang]; ?>" href="cat1/<?php echo $row_tl1['cate_alias'].'-'.$row_tl1['cate_id'].'.htnl' ?>"><?php echo $row_tl1['cate_name_'.$lang]; ?></a></li>                

                    <?php } ?>

            </ul>  

        </div>

        <div class="breadcrumbs-item active lastItem" itemtype="http://data-vocabulary.org/Breadcrumb" >

            <a title="<?php echo $row_tl['cate_name_'.$lang] ?>" itemprop="url" href="#"><h1 class="active"><span itemprop="title"><?php echo $row_tl['cate_name_'.$lang] ; ?></span></h1></a>

        </div>

    </div>

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

                                   $sql2="Select congty_id From cty_cate Where cate_id=$cate";

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

                                        if(isset($row1['idQuocGia'])){
                                            $idQuocGia1 = $row1['idQuocGia'];
                                            //$arrQuocGia[$idQuocGia1] = 0;
                                        }

                                        $arrQuocGia[$idQuocGia1]++;

                                }

                                foreach($arrQuocGia as $idQuocGia=> $so_cong_ty){

                                        $sql = "Select * From category Where cate_id=$cate_id";

                                        $rs = mysql_query($sql);

                                        $row = mysql_fetch_assoc($rs);

                                        if($idQuocGia > 0){

                                                $sql = mysql_query("SELECT * FROM quocgia WHERE idQuocGia = $idQuocGia");

                                                $rowqg = mysql_fetch_assoc($sql); ?>

                                                

                                    <div style="width:105px;float: left;margin-bottom: 2px">

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

                            Tìm được <span class="spa"><?php echo $total_record ?></span>  công ty trong danh mục <span class="spa"><?php echo $row_tl['cate_name_'.$lang]; ?></span> <?php if($idQuocGia_GET!=''){ echo '       {quocgia} : '.'<span class="spa">'.$row_quoc_gia['TenQuocGia_'.$lang].'</span>'; } ?>

                        <?php } ?>

                        <?php if($lang=='cn'){ ?>

                            <span class="spa"><?php echo $row_tl['cate_name_'.$lang]; ?></span> 在 目 錄 里 找 到 <span class="spa"><?php echo $total_record ?></span> 產品

                        <?php } ?> 

                            <?php if($lang=='en'){ ?>

                            Found <span class="spa"><?php echo $total_record ?></span>  company for category <span class="spa"><?php echo $row_tl['cate_name_'.$lang]; ?> </span><?php if($idQuocGia_GET!=''){ echo ' {quocgia} : '.'<span class="spa">'.$row_quoc_gia['TenQuocGia_'.$lang].'</span>'; } ?>.

                        <?php } ?>

                    </div>



                    <form method="post" action="#">

                        



                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="searchTable" id="searchProductTable">

                            <colgroup>

                                

                                <col style="width: 160px;"/>

                                <col style="width: auto;"/>

                                <col style="width: 160px;"/>

                            </colgroup>

                            
                            <!-- Hien ds cty  -->

                            <?php                               

                                if(!empty($list_trang)){
                                    foreach ($list_trang as $key => $row) { 
                                        //var_dump("<pre>",$key);       
                                         //echo $row['TenCT_vi']."<br >";
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

                                        <?php 
                                            
                                          echo $gioithieu=$row['GioiThieu_'.$lang];
                                           //echo "<pre>";
                                           // print_r($gioithieu);                                            
                                           // echo "</pre>";
                                          // echo $mota_ngan = CatChuoiTheoCau('Chao Mung Ban Den Voi Thu Thuat Web',7);
                                           //exit; 
                                       ?>

                                    </p>


                                    <?php //if($row['DiaChi_'.$lang]!=''){ ?><p><strong>{diachi}: </strong><?php echo $row['DiaChi_'.$lang]; ?></p><?php //} ?>

                                    <?php //if($row['DienThoai']!=''){ ?><p><strong>{dienthoai}: </strong> <?php echo $row['DienThoai'];?></p><?php//} ?>

                                    <?php //if($row['Fax']!=''){ ?><p><strong>{fax}: </strong> <?php echo $row['Fax'];?></p><?php//} ?>

                                    <?php //if($row['Website']!=''){ ?> <p><strong>{website}: </strong> <a target="_blank" href="http://<?php  $cat_www = str_replace("www.","",$row['Website']); echo str_replace("http://","",$cat_www); ?>"> <?php  echo $row['Website'];?></a></p> <?php //} ?>

                                    <?php //if($row['NguoiLienHe']!=''){ ?><p><strong>{nguoilienhe}: </strong> <?php echo $row['NguoiLienHe'];?></p><?php //} ?>

                                    <?php //if($row['DiDong']!=''){ ?><p><strong>{didong}: </strong> <?php echo $row['DiDong'];?></p><?php //} ?>

                                    <?php //if($row_qg['TenQuocGia_'.$lang]!=''){ ?><p><strong>{quocgia}: </strong> <?php  echo $row_qg['TenQuocGia_'.$lang];?></p><?php //} ?>

                                    <?php //if($row['NhaDauTu_'.$lang]!=''){ ?><p><strong>{nhadautu}: </strong> <?php  echo $row['NhaDauTu_'.$lang];?></p><?php //} ?>

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

                                <?php } }   ?>

                            

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









