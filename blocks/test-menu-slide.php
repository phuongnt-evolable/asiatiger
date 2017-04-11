<?php
    if(isset($_GET['category_id'])){
        echo $loaitk = $_GET['category_id'];
    }else{
        $loaitk='';
    }

?>
<div class="container">

    <div class="col-fixed-m-36 col-xs-60 l-fs-main">

        <div class="col-xs-60 m-searchbar" style="float:left;width:60%">

            <div class="col-offset-r-fixed-xs-11 col-offset-r-fixed-m-0">

                <div id="home-searchbar" class="ui-searchbar ui-searchbar-size-large ui-searchbar-mod-type">

                    <div class="ui-searchbar-body">

                        <form method="get" action="tim-kiem.html">                            

                            <div class="ui-searchbar-type">

                                <div data-widget-cid="widget-2">

                                    <div class="ui-searchbar-type-value">                                        

                                        <select class="ui-searchbar-type-display" name='category_id' id="category_id">                                            

                                             <option value='2' <?php if($loaitk==2) echo "selected" ?>>----{theonhacungcap}----</option>

                                             <option value='1' <?php if($loaitk==1) echo "selected" ?>>----{theosp}----</option>                                           

                                        </select>                                        

                                    </div>                                   

                                </div>

                            </div>

                            <div class="ui-searchbar-main faqsearchinputbox" style="margin-left: 195px;width:80%">

                                <input type="text" class="ui-searchbar-keyword" id="faq_search_input" name="SearchText" placeholder="{timgi}">

                                <input type="hidden" id="lang" value="<?php echo $lang; ?>">

                            </div>

                            <div id="searchresultdata" class="faq-articles"> </div>

                            <input type="submit" class="ui-searchbar-submit" value="{search}">                            

                        </form>

                    </div>

                </div>               

            </div>

        </div>

        <div style="width:300px; float: left;"><a target="_blank" href="#"><img style="width:250px;margin-left: 40px;" src="img/quang-cao/china-souther.jpg"></a></div>

        <div style="width:880px;clear: both;">

            <div id="nd_thongbao">

                <marquee style="height: 30px;" behavior="scroll" scrolldelay="30" scrollamount="3">

                    <?php

                        $sql="SELECT * FROM blocks where block_id=12";

                        $block=mysql_query($sql) or die(mysql_error());                                               

                        $row_block =  mysql_fetch_assoc($block); 



                        echo $row_block['block_content_'.$lang];

                     ?>

                </marquee>

            </div>

            <div id="icon_thongbao"><img width="30px" src="img/loa.jpg"></div>

        </div>

        <div class="col-xs-60 l-operate">

            <div id="m-categories" class="m-categories" data-spm="1997230041">

                <div class="col-fixed-xs-250px markets">

                    <h3><a href="Products">{danhmucnghanhnghe}</a></h3>

                    <ul id="markets-list" style="">

                        <?php 

                            $menu=$modelCate->getAllTL();

                            while ($row_menu=  mysql_fetch_assoc($menu)){

                                $idTL=$row_menu['idTL'];

                        ?>

                        <li>
                            <a style="<?php if($lang == 'cn'){ echo 'font-size:16px';}else { echo 'font-size:14px';}?>" href="cat/<?php echo $row_menu['TenTL_KhongDau']."-".$row_menu['idTL']; ?>.html">
    <?php echo $row_menu['TenTL_'.$lang] ?>
                            </a>                           

                        </li>                       

                        <?php } ?>

                    </ul>
                    <?php
                        if($lang=='vi' || $lang=='en'){
                    ?>
                        <div style="width: 320px; margin-top: 5px;">
                            <?php 
                                $category_id=5;
                                $hinh=$modelHome->getImageByCate($category_id,0,2);
                                foreach ($hinh as $val => $row_hinh){

                            ?>
                            <div style="margin-bottom:10px;">
                                <a data-fancybox-group="qc-center" target="_blank" class="fancybox"  href="
                            <?php  echo $row_hinh['Url']; ?>" title="<?php echo $row_hinh['Href']; ?>"><img class="qc" width="320" height="80" src="<?php echo $row_hinh['Url']; ?>"/></a>
                            </div>
                            <?php } ?>

                        </div>

                    <?php } else { ?>
                         <div style="width: 320px;   height: 260px;  margin-top: 45px;">
                            <?php 
                                $category_id=5;
                                $hinh=$modelHome->getImageByCate($category_id,0,3);                
                                foreach ($hinh as $val => $row_hinh){

                            ?>
                            <div style="margin-bottom:10px;">
                                <a data-fancybox-group="qc-center" target="_blank" class="fancybox"  href="
                            <?php  echo $row_hinh['Url']; ?>" title="<?php echo $row_hinh['Href']; ?>"><img class="qc" width="320" height="80" src="<?php echo $row_hinh['Url']; ?>"/></a>
                            </div>
                            <?php } ?>
                        </div> 
                    <?php } ?>
                        <!--<li class="all">

                            <a rel="nofollow" href="tat-ca-nghanh.html">All Categories <span class="action-sign">&nbsp;›</span></a>

                        </li>-->

                </div>

                 <?php 

                    $menu=$modelCate->getAllTL();

                    while ($row_menu=  mysql_fetch_assoc($menu)){

                        $idTL=$row_menu['idTL'];

                        $menu_con=$modelCate->getListCate($idTL);

                        

                 ?>

                <div class="cates util-clearfix" data-widget-cid="widget-7">

                    <ul class="cate-list">

                        <?php

                            // $dem=  mysql_num_rows($menu_con);

                            $i=1;

                            while($row_menu_con=  mysql_fetch_assoc($menu_con)){
                                $i++;
                        ?>
                        <li>

                            <a class="first-cates" href="cat1/<?php echo $row_menu_con['cate_alias'].'-'.$row_menu_con['cate_id'].'.html' ?>"><?php echo $row_menu_con['cate_name_'.$lang] ?></a>

                        </li>

                            <?php if($i % 8 ==0) echo '</ul><ul class="cate-list">'; } ?>

                        <li style="clear:both;"></li>

                        <li>

                            <?php 

                                  $id_nghanh=$row_menu['idTL'];

                                  if($id_nghanh==1){?>

                             <img style="position: absolute;top: 400px;"  src="img/nen-a.png"> 

                             <?php } ?>                                  

                            

                             <?php 

                                  $id_nghanh=$row_menu['idTL'];

                                  if($id_nghanh==2){?>

                             <img style="position: absolute;top: 400px; left: 30px;"  src="img/thoi_trang_nam_2.png"> 

                             <img style="position: absolute;top: 400px; left: 230px;"  src="img/thoi_trang_nu_3.png"> 

                             <img style="position: absolute;top: 100px; left: 430px;"  src="img/thoi_trang_nu_4.png"> 

                              <?php } ?>                                  

                              <?php 

                                  $id_nghanh=$row_menu['idTL'];

                                  if($id_nghanh==3){?>

                             <img style="position: absolute;top: 400px;"  src="img/nen-c.png"> 

                              <?php } ?>

                             <?php 

                                  $id_nghanh=$row_menu['idTL'];

                                  if($id_nghanh==5){?>

                             <img style="position: absolute;top: 400px;"  src="img/nen-d.png"> 

                              <?php } ?>

                             <?php 

                                  $id_nghanh=$row_menu['idTL'];

                                  if($id_nghanh==6){?>

                             <img style="position: absolute;top: 400px;"  src="img/nen-e.png"> 

                              <?php } ?>

                              <?php 

                                  $id_nghanh=$row_menu['idTL'];

                                  if($id_nghanh==7){?>

                             <img style="position: absolute;top: 400px;"  src="img/nen-f.png"> 

                              <?php } ?> 

                             <?php 

                                  $id_nghanh=$row_menu['idTL'];

                                  if($id_nghanh==8){?>

                             <img style="position: absolute;top: 400px;"  src="img/nen-g.png"> 

                              <?php } ?>

                             <?php 

                                  $id_nghanh=$row_menu['idTL'];

                                  if($id_nghanh==9){?>

                             <img style="position: absolute;top: 400px;"  src="img/nen-h.png"> 

                              <?php } ?>

                             <?php 

                                  $id_nghanh=$row_menu['idTL'];

                                  if($id_nghanh==10){?>

                             <img style="position: absolute;top: 400px;"  src="img/nen-i.png"> 

                              <?php } ?>

                             <?php 

                                  $id_nghanh=$row_menu['idTL'];

                                  if($id_nghanh==11){?>

                             <img style="position: absolute;top: 400px;"  src="img/nen-j.png"> 

                              <?php } ?>

                             <?php 

                                  $id_nghanh=$row_menu['idTL'];

                                  if($id_nghanh==12){?>

                             <img style="position: absolute;top: 400px;"  src="img/nen-k.png"> 

                              <?php } ?>

                             <?php 

                                  $id_nghanh=$row_menu['idTL'];

                                  if($id_nghanh==13){?>

                             <img style="position: absolute;top: 400px;"  src="img/nen-l.png"> 

                              <?php } ?>  

                             <?php 

                                  $id_nghanh=$row_menu['idTL'];

                                  if($id_nghanh==14){?>

                             <img style="position: absolute;top: 400px;"  src="img/nen-m.png"> 

                              <?php } ?>

                             <?php 

                                  $id_nghanh=$row_menu['idTL'];

                                  if($id_nghanh==15){?>

                             <img style="position: absolute;top: 400px;"  src="img/nen-n.png"> 

                              <?php } ?> 

                             <?php 

                                  $id_nghanh=$row_menu['idTL'];

                                  if($id_nghanh==16){?>

                             <img style="position: absolute;top: 400px; left: 20px"  src="img/nen-o.png"> 

                              <?php } ?>

                             <?php 

                                  $id_nghanh=$row_menu['idTL'];

                                  if($id_nghanh==17){?>

                             <img style="position: absolute;top: 400px;"  src="img/nen-p.png"> 

                              <?php } ?>

                        

                        </li>

                    </ul>                   

                </div>

                    <?php }  ?>

               

            </div>
            
            <script>

                (function() {

                    var categoriesUrl = 'http://style.aliunicorn.com/js/6v/biz/aisn/ghome/categories/??categories.js?t=9d8113e_ac6db7882';



                    // 



                    seajs.use(['$', categoriesUrl], function(jquery, categories) {

                        categories(jquery('#markets-list li'), jquery('#m-categories .cates'));

                    });

                })();



            </script>

            <div class="col-offset-fixed-xs-250px l-operate-main">

                <style>

                    .m-banners .list {

                        width: 500%;

                    }

                    .m-banners .list li {

                        width: 20%;

                    }

                </style>

                <div id="m-banners" style="width:580px;height: 240px" class="m-banners" >

                    <div class="flexslider">

                        <ul class="slides">
                            <?php
                            $category_id=6;
                            $hinh=$modelHome->getImageByCate($category_id,0,10);
                            foreach ($hinh as $val => $row_hinh){

                            ?>

						  <li>
                              <a target="_blank" href="<?=$row_hinh['Href']=='' ? $row_hinh['Url'] : $row_hinh['Href']; ?>" class="fancybox"><img width="500px" src="<?=$row_hinh['Url']; ?>"/></a>

                          </li> 
                         <?php } ?>

                        </ul>

                      </div>

                </div>
                <div  style="width:580px;"  >
                    <div class="m-industry">
                        <div class="item">
                            <a class="title" rel="nofollow" href="trang-mau.html" class="title">{trangmau} </a>
                        </div>
                    </div>
                    <?php include 'blocks/slide-trang-mau-ngang.php'; ?>
                    
                </div>
                <div class="col-xs-60 m-industry" data-spm="1997230293">

                    <div class="col-xs-30 item" data-industry-id="1524">

                        <a style="margin-left: 50px;" rel="nofollow" href="sach-nien-giam.php" class="title">{qcniengiam} 2016</a>

                        <div style="width:200px;margin-left: 50px;" >

                            <a href="sach-nien-giam.php" ><img width="195" height="269" src="img/NienGiam/anh-mau-nho/Bia-1.jpg"></a>

                        </div>
                    </div>

                    <div class="col-xs-30 item countrys">

                        <a rel="nofollow" href="#" class="title">

                            	  </a>                        

                        
                        <?php 
                            $category_id=4;
                            $hinh=$modelHome->getImageByCate($category_id,0,2);                
                            foreach ($hinh as $val => $row_hinh){

                        ?>
                        <div style="width:200px; margin-top: 15px;" >

                           <a data-fancybox-group="qc-left" target="_blank" class="fancybox"  href="
                        <?php  echo $row_hinh['Url']; ?>" title="<?php echo $row_hinh['Href']; ?>"><img class="qc"  width="270" src="<?php echo $row_hinh['Url']; ?>"></a>

                        </div>
                        <?php } ?>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-offset-fixed-m-36 col-offset-fixed-xs-0 l-fs-sub">					

        <div class="" >

            <!--<div class="guide">             
                
                <a  href="trang-mau.html" style="cursor: pointer;" class="title">

                    {trangmau}

                </a>    -->           

                <?php include 'blocks/test-slide-trang-mau.php'; ?>

           <!-- </div>-->
        </div>       
    </div>

</div>