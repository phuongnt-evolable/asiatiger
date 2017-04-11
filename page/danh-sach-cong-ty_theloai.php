

<?php
// get all cate
$menu = $modelCate->getAllTL();

$url = $_SERVER['REQUEST_URI'];

$_SESSION["url"] = $url;

$chuoi= substr( $_SESSION["url"],  1);

$tieude_id = $tmp_uri[2];

$arr = explode("-", $tieude_id);

$idTL = (int) end($arr);

// get list quoc gia
$list_quoc_gia = $modelQuocgia->getAllQuocGia();
while($row_qg = mysql_fetch_assoc($list_quoc_gia)){
    $arr_list_quoc_gia [$row_qg['idQuocGia']]= $row_qg ;
}

// get detail theloai
$theloai = $modelCate->getDetailTheLoai($idTL);
$row_theloai=  mysql_fetch_assoc($theloai);

// get list category by idTL
$list_cate = $modelCate->getListCate($idTL);
while($row = mysql_fetch_assoc($list_cate)){
    $arr_list_cate []= $row ;
}

$str_category_id = '';
foreach($arr_list_cate as $cate){
    $str_category_id .=  $cate['cate_id'].",";
}
$str_category_id = rtrim($str_category_id,",");

if(isset($_GET['idQuocGia'])){
    $explode_id_quoc_gia = explode('/', $_GET['idQuocGia']);
    $idQuocGia = $explode_id_quoc_gia[0];
}else{
    $idQuocGia='';
}

$condition_count_company['idTL'] = $idTL;
if (!empty($idQuocGia)) {
    $condition_count_company['idQuocGia'] = $idQuocGia;
}
$trangs = $modelCongTy->countTotalCompanyByCondition($condition_count_company);

$arr = explode("/", $url);
$link = $arr[1].'/'.$arr[2];
$page_show = 5;
$limit = 10;
$total_record = $trangs['total'];
$total_page = ceil($total_record / $limit);

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

$offset = $limit * ($page - 1);

$condition_count_company['offset'] = $offset;
$condition_count_company['limit']  = $limit;

$list_trang = $modelCongTy->getListCongTyByCondition($condition_count_company);

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
                while ($row_menu=  mysql_fetch_assoc($menu)){
                    ?>
                    <li><a alt="<?php echo $row_menu['TenTL_'.$lang]; ?>" title="<?php echo $row_menu['TenTL_'.$lang]; ?>" href="cat/<?php echo $row_menu['TenTL_KhongDau'].'-'. $row_menu['idTL'].'.html' ?>"><?php echo $row_menu['TenTL_'.$lang]; ?></a></li>
                <?php } ?>
            </ul>
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
                            foreach ($arr_list_cate as $cate){
                                $condition['cate_id'] = $cate['cate_id'];
                                $count_total_company_by_cate = $modelCongTy->countTotalCompanyByCondition($condition);
                                $dem = $count_total_company_by_cate['total'];
                                ?>
                                <div style="width:215px;float: left;margin-bottom: 2px">
                                    <a  href="cat1/<?php echo $cate['cate_alias'].'-'.$cate['cate_id'].'.html'?>" alt="<?php echo $cate['cate_name_'.$lang]; ?>" title="<?php echo $cate['cate_name_'.$lang]; ?>">
                                        <?php echo $cate['cate_name_'.$lang]; ?>
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
                            $condition_qg['idTL'] = $idTL;
                            $list_quoc_gia = $modelQuocgia->getListQuocGiaByCondition($condition_qg);
                            while ($quoc_gia = mysql_fetch_array($list_quoc_gia)){
                                ?>
                                <div style="width:215px;float: left;margin-bottom: 2px">
                                    <a  href="cat/<?php echo $row_theloai['TenTL_KhongDau'].'-'.$row_theloai['idTL'].'.html'.'?idQuocGia='.$quoc_gia['idQuocGia']?>" alt="<?php echo $quoc_gia['TenQuocGia_'.$lang]; ?>" title="<?php echo $quoc_gia['TenQuocGia_'.$lang]; ?>">
                                        <?php echo $quoc_gia['TenQuocGia_'.$lang].' ('.$quoc_gia["total"].')'; ?>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="link" id="catgoryDiv" style="clear: both;margin-top: 20px;">
                        <h2 class=" strong">{nhadautu}:</h2>
                        <!--产品显示分类 -->
                        <div style="clear: both;"></div>
                        <div >
                            <?php
                            // nha_dau_tu = 1 -- get add data by nha_dau_tu
                            $condition_qg['nha_dau_tu'] = '1';
                            $list_nha_dau_tu = $modelQuocgia->getListQuocGiaByCondition($condition_qg);
                            while ($nha_dau_tu = mysql_fetch_array($list_nha_dau_tu)){
                                ?>
                                <div style="width:215px;float: left;margin-bottom: 2px">
                                    <a  href="cat/<?php echo $row_theloai['TenTL_KhongDau'].'-'.$row_theloai['idTL'].'.html'.'?idNhaDauTu='.$nha_dau_tu['idQuocGia']?>" alt="<?php echo $nha_dau_tu['TenQuocGia_'.$lang]; ?>" title="<?php echo $nha_dau_tu['TenQuocGia_'.$lang]; ?>">
                                        <?php echo $nha_dau_tu['TenQuocGia_'.$lang].' ('.$nha_dau_tu["total"].')'; ?>
                                    </a>
                                </div>
                            <?php } ?>
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
                            Tìm được <span class="spa"><?php echo $total_record ?></span>  công ty trong danh mục <span class="spa"><?php echo $row_theloai['TenTL_'.$lang]; ?></span>.
                        <?php } ?>
                        <?php if($lang=='cn'){ ?>
                            <span class="spa"><?php echo $row_theloai['TenTL_'.$lang]; ?></span> 在 目 錄 里 找 到 <span class="spa"><?php echo $total_record ?></span> 產品
                        <?php } ?>
                        <?php if($lang=='en'){ ?>
                            Found <span class="spa"><?php echo $total_record ?></span>  company for category <span class="spa"><?php echo $row_theloai['TenTL_'.$lang]; ?></span>.
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
                                if(!empty($list_trang)){
                                foreach ($list_trang as $key => $row_detail_company) {
                                    $idQuocGiaCompany = (int)$row_detail_company['idQuocGia'];
                                    $idNhaDauTu = (int)$row_detail_company['NhaDauTu'];
                             ?>
                                    <tr  class="color" >
                                        <td class="center js-preview">
                                            <div class="photo100" data-np4Url= "<?php echo $row_detail_company['HinhDaiDien']; ?>">
                                                <div class="thumbnails140105">
                                                    <div class="md-hnvalign">
                                                        <div class="md-hnvalign-mid">
                                                            <div class="md-hnvalign-mid-inner">
                                                                <a href="cong-ty/<?php echo $row_detail_company['ten_khong_dau'].'-'.$row_detail_company['congty_id'].'.html' ?>" title = "<?php echo $row_detail_company['TenCT_'.$lang]; ?>" >
                                                                    <img width="100" height="100"  src="
                              <?php if($row_detail_company['HinhDaiDien']==''){ echo 'img/no_image.jpg';}
                                                                    else {
                                                                        echo $row_detail_company['HinhDaiDien'];
                                                                    }
                                                                    ?>
                              "  alt="<?php echo $row_detail_company['TenCT_'.$lang]; ?>" title="<?php echo $row_detail_company['TenCT_'.$lang]; ?>" />
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h4><a class="high" target="_blank" href="cong-ty/<?php echo $row_detail_company['ten_khong_dau'].'-'.$row_detail_company['congty_id'].'.html' ?>" ><?php echo $row_detail_company['TenCT_'.$lang]; ?></a></h4>
                                            <p class="high" title="">
                                                <?php echo $row_detail_company['GioiThieu_'.$lang]; ?>
                                            </p>
                                            <?php
                                                if(isset($_SESSION['idUser'])){
                                            ?>
                                            <p><strong>{diachi}: </strong><?php echo $row_detail_company['DiaChi_'.$lang]; ?></p>
                                            <p><strong>{dienthoai}: </strong> <?php echo $row_detail_company['DienThoai'];?></p>
                                            <p><strong>{fax}: </strong> <?php echo $row_detail_company['Fax'];?></p>
                                            <p><strong>{website}: </strong> <a target="_blank" href="http://<?php  $cat_www = str_replace("www.","",$row_detail_company['Website']); echo str_replace("http://","",$cat_www); ?>"> <?php  echo $row_detail_company['Website'];?></a></p>
                                            <p><strong>{nguoilienhe}: </strong> <?php echo $row_detail_company['NguoiLienHe'];?></p>
                                            <p><strong>{didong}: </strong> <?php echo $row_detail_company['DiDong'];?></p>
                                            <?php } ?>
                                            <p><strong>{quocgia}: </strong>
                                                <?php
                                                    if(!empty($arr_list_quoc_gia[$idQuocGiaCompany])){
                                                        echo $arr_list_quoc_gia[$idQuocGiaCompany]['TenQuocGia_'.$lang];
                                                    }
                                                ?>
                                            </p>
                                            <p><strong>{nhadautu}: </strong>
                                                <?php
                                                    if(!empty($arr_list_quoc_gia[$idNhaDauTu])){
                                                        echo $arr_list_quoc_gia[$idNhaDauTu]['TenQuocGia_'.$lang];
                                                    }
                                                ?>
                                            </p>
                                        </td>
                                        <td class="center">
                                            <div class="lienhe">
                                                <a href="mailto:<?php echo $row_detail_company['Email']; ?>">
                                                    <span class="ico-csb"></span>
                                                    {lienhe}
                                                </a>
                                            </div>
                                            <p class="con">
                                            </p>
                                            &nbsp;
                                        </td>
                                    </tr>
                                <?php } } ?>
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

