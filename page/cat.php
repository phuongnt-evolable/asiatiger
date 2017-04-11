<?php
    session_start();
    $url = $_SERVER['REQUEST_URI'];   
    $_SESSION["url"]=$url;

    $tieude_id = $tmp_uri[2];

    $arr = explode("-", $tieude_id);      

    $cate_id = (int) end($arr);

    $cat=$modelCate->getDetailCate($cate_id);

    $row_cat=  mysql_fetch_assoc($cat);

    $idTL=$row_cat['idTL'];

    $tl=$modelCate->getDetailTheLoai($idTL);

    $row_tl=  mysql_fetch_assoc($tl);

?>



<div class="container">

    <div class="breadcrumbs util-clearfix">    

        <div class="breadcrumbs-item" itemtype="http://data-vocabulary.org/Breadcrumb">

            <a href="#" itemprop="url" title="vinhsang.com.vn"><span itemprop="title">{trangchu}</span></a>

        </div>



        <div itemtype="http://data-vocabulary.org/Breadcrumb" class="breadcrumbs-item hasSub">            

            <a title="Danh mục nghành nghề" itemprop="url" href="#"><span itemprop="title">{danhmucnghanhnghe}</span></a>

            

            <ul>  

                 <?php 

                    $menu=$modelCate->getAllTL();

                    while ($row_menu=  mysql_fetch_assoc($menu)){

                ?>

                <li><a alt="<?php echo $row_menu['TenTL_'.$lang]; ?>" title="<?php echo $row_menu['TenTL_'.$lang]; ?>" href="#"><?php echo $row_menu['TenTL_'.$lang]; ?></a></li> 

                    <?php } ?>

            </ul>             

        </div>



        <div itemtype="http://data-vocabulary.org/Breadcrumb" class="breadcrumbs-item hasSub">

            <a title="<?php echo $row_tl['TenTL_'.$lang] ?>" itemprop="url" href="#"><span itemprop="title"><?php echo $row_tl['TenTL_'.$lang] ?></span></a>

            <ul> 

                <?php

                    $tl1=$modelCate->getListCate($idTL);

                    while($row_tl1=  mysql_fetch_assoc($tl1)){

                ?>

                <li><a alt="<?php echo $row_tl1['cate_name_'.$lang]; ?>" title="<?php echo $row_tl1['cate_name_'.$lang]; ?>" href="cat1/<?php echo $row_tl1['cate_alias'].'-'.$row_tl1['cate_id'].'.htnl' ?>"><?php echo $row_tl1['cate_name_'.$lang]; ?></a></li>                

                    <?php } ?>

            </ul>  

        </div>

        <div class="breadcrumbs-item active lastItem" itemtype="http://data-vocabulary.org/Breadcrumb" >

            <a title="<?php echo $row_cat['cate_name_'.$lang] ?>" itemprop="url" href="#"><h1 class="active"><span itemprop="title"><?php echo $row_cat['cate_name_'.$lang] ?></span></h1></a>

        </div>

    </div>

    <div class="container-left">

        <div class="cate-categories-sub util-clearfix" id="cate-sub-scroll">

            <div class="filter-head util-clearfix">

                <h1 class="filter-head-title"><?php echo $row_cat['cate_name_'.$lang] ?></h1>

                <ul class="list-radio-cate">

                    <li>

                        <input id="shop02" class="shop_type" type="radio" name="shop" value="vip" />

                        <label for="shop02">Shop Vip</label>

                    </li>

                    <li>

                        <input id="shop03" class="shop_type" type="radio" name="shop" value="all" checked/>

                        <label for="shop03">Tất cả</label>

                    </li>

                </ul>

                <div class="filter-city">

                    <span class="tit-filter-city">Tỉnh/Thành</span>

                    <div class="list-filter-city">

                        <ul>

                            <li>

                                <input checked="checked" type="checkbox" id="chkCity_all" name="chkCity_all" value="" onclick="window.location = 'city_id=0';"/>

                                <label for="chkCity_all">Tất cả</label>

                            </li>



                            <li>

                                <input  type="checkbox" id="chkCity_29" name="chkCity_29" value="" onclick="window.location = 'city_id=29';"/>

                                <label for="chkCity_29">TP. Hồ Chí Minh</label>

                            </li>

                            <li>

                                <input  type="checkbox" id="chkCity_15" name="chkCity_15" value="" onclick="window.location = 'city_id=15';"/>

                                <label for="chkCity_15">Đà Nẵng</label>

                            </li>

                            <li>

                                <input  type="checkbox" id="chkCity_22" name="chkCity_22" value="" onclick="window.location = 'city_id=22';"/>

                                <label for="chkCity_22">Hà Nội</label>

                            </li>

                        </ul>

                    </div>

                </div><!-- filter-city -->

                <span class="btn-show-cont" id="jsCollapseMainFillter"></span>

            </div><!-- filter-head -->



            <div id="jsFillterToogle"> 

                <div class="filter-attr filter-attr-type util-clearfix">

                    <span class="tit-filter-attr">Danh mục</span>

                    <div class="cont-filter-attr">

                        <ul>



                            <li ><a href="/u940/khach-san-1-sao.html">Khách sạn 1 sao</a></li>										



                            <li ><a href="/u941/khach-san-2-sao.html">Khách sạn 2 sao</a></li>										



                            <li ><a href="/u942/khach-san-3-sao.html">Khách sạn 3 sao</a></li>										



                            <li ><a href="/u943/khach-san-4-sao.html">Khách sạn 4 sao</a></li>										



                            <li ><a href="/u944/khach-san-5-sao.html">Khách sạn 5 sao</a></li>										



                            <li ><a href="/u945/nha-nghi.html">Nhà nghỉ</a></li>										



                            <li ><a href="/u946/mini-hotel.html">Mini hotel</a></li>										

                        </ul>

                    </div>

                    <span class="btn-show-cont collapse jsFillterAttToogle"></span>

                </div><!-- filter-attr -->



                <div class="filter-attr filter-attr-price util-clearfix">

                    <span class="tit-filter-attr">Giá</span><!-- tit-filter-attr -->

                    <div class="cont-filter-attr">

                        <ul>

                            <li>

                                <input  type="radio" name="checkPrice" id="chkTypePro0_level1" onclick="window.location = 'price_from=1&price_to=10000000';"/>

                                <label for="chkTypePro0_level1">Tất cả</label>

                            </li>

                            <li>

                                <input  type="radio" name="checkPrice" id="chkTypePro0_level2" onclick="window.location = 'price_from=1&price_to=100000';"/>

                                <label for="chkTypePro0_level2">Dưới 100k</label>

                            </li>

                            <li>

                                <input  type="radio" name="checkPrice" id="chkTypePro0_level3" onclick="window.location = 'price_from=100000&price_to=300000';"/>

                                <label for="chkTypePro0_level3">Từ 100k - 300k</label>

                            </li>

                            <li>

                                <input  type="radio" name="checkPrice" id="chkTypePro0_level4" onclick="window.location = 'price_from=300000&price_to=500000';"/>

                                <label for="chkTypePro0_level4">Từ 300k - 500k</label>

                            </li>

                            <li>

                                <input  type="radio" name="checkPrice" id="chkTypePro0_level5" onclick="window.location = 'price_from=500000&price_to=1000000';"/>

                                <label for="chkTypePro0_level5">Từ 500k - 1000k</label>

                            </li>

                            <li>

                                <input  type="radio" name="checkPrice" id="chkTypePro0_level6" onclick="window.location = 'price_from=1000000&price_to=10000000';"/>

                                <label for="chkTypePro0_level6">Trên 1000k</label>

                            </li>

                        </ul>

                    </div><!-- cont-filter-attr -->

                </div><!-- filter-attr -->

                <div class="filter-attr filter-attr-choose util-clearfix">

                    <span class="tit-filter-attr">Chọn sản phẩm</span><!-- tit-filter-attr -->

                    <div class="cont-filter-attr">

                        <ul>

                            <li >

                                <input  id="chkTypePro07" type="checkbox" value="promotion=1" name="chkTypePro07">

                                <label for="chkTypePro07">Khuyến mãi</label>

                            </li>

                            <li ><a title="Mới nhất" class="icon-down" href="sort=product_new_desc" class="down">Mới nhất</a></li>

                            <li><a title="Giá" class="icon-down-double" href="sort=price_desc" class="begin">Giá</a></li>

                        </ul>

                    </div><!-- cont-filter-attr -->

                </div><!-- filter-attr -->

            </div>

        </div><!-- cate-categories-sub -->

        <script>

            $('#chkTypePro07').click(function() {

                window.location = $(this).val();

            });

            $('.checkfilter').click(function() {

                var checked = $(this).attr('checked');

                var url = $(this).attr('data-value');

                var urlnone = $(this).attr('data-non-value');

                if (checked == "checked")

                    window.location = url;

                else

                    window.location = urlnone;

            });

        </script>         

        <!-- LIST PRODUCT -->

        <div class="block-products-cate block-products-cate-sub">

            <div class="cont-cate list-cate-sub list-cat-sub-02 util-clearfix">             



                <?php

                    //echo $cate_id = (int) end($arr);

                $page_show = 5;



                $limit = 20;



                $trangs = $modelCongTy->getListCongTyByTheLoai($cate_id,-1, -1);



                $total_record = mysql_num_rows($trangs);



                $total_page = ceil($total_record / $limit);



                if (isset($_GET['page']) == false) {

                    $page = 1;

                } else {

                    $page = (int) $_GET['page'];

                }



                $offset = $limit * ($page - 1);



                $list_trang = $modelCongTy->getListCongTyByTheLoai($cate_id,$offset, $limit);



                $i = ($page - 1) * $limit;

                while ($row_cty = mysql_fetch_assoc($list_trang)) {

                    $i++;                    

                    

                ?>

                <div class="mid-item">

                    <div class="inner-mid-item">

                        <a class="wrapImg" href="#" title="<?php echo $row_cty['TenCT_'.$lang]; ?>">

                            <img src="

                                <?php if($row_cty['HinhDaiDien']==''){ echo 'img/no-img.gif';} 

                                    else {

                                        echo $row_cty['HinhDaiDien'];

                                    } 

                                ?>" width="200" height="200" alt="<?php echo $row_cty['TenCT_'.$lang]; ?>">

                        </a>

                        <?php /*

                        <p class="price">

                            <span class="curr-price">1.800.000đ</span>

                        </p>*/?>



                        <a class="prd-name" href="#" title="<?php echo $row_cty['GioiThieu_'.$lang]; ?>"><?php echo $row_cty['GioiThieu_'.$lang]; ?></a>

                        <p class="prd-view">3</p>

                        <a class="pr-shop  pr-shop-normal" href="#" title="<?php echo $row_cty['TenCT_'.$lang]; ?>"><?php echo $row_cty['TenCT_'.$lang]; ?></a>



                        <p class="pr-shop-address"><?php echo $row_cty['DiaChi']; ?></p>

                    </div>

                </div>	                

                <?php } ?>

                <div><?php echo $modelProduct->phantrang($page, $page_show, $total_page, $link); ?></div>

            </div><!-- cont-cate -->



            <!--<ul class="pagination"><li class="active"><a>1</a></li><li><a href="/u937/khach-san.html?page=2">2</a></li><li class="next"><a href="/u937/khach-san.html?page=2" title="Trang sau">Sau</a></li></ul>    -->       

        </div><!-- block-products-cate -->



    </div>

    <?php include 'blocks/right.php'; ?>

</div>