<?php
    //session_start();    
    if(isset($tmp_uri[2])){
        $tieude_id = $tmp_uri[2];
        $arr = explode("-", $tieude_id);      
        $id_loai = (int) end($arr);
    }else{
        $id_loai = "";
    }
    
    
    
    $page_show = 5;
    $limit = 10;
    //echo $cate_id;
    if(isset($tmp_uri[3])){
        $page1=$tmp_uri[3]; 
    }else{
        $page1="";
    }
    
    
    $link1 = $_SERVER['REQUEST_URI'];

    $arr = explode("/", $link1);
    if(isset($arr[2])){
        $link = $arr[1].'/'.$arr[2];
    }else{
        $link = $arr[1].'/';
    }

   

    //$page=$_GET[page1];

    if ($page1 > 1) {

       $page = $page1;

    } else {

        $page = 1;

    }
     
    if($com=='news'){
        //echo "vo day r ne"; 
        $trangs = $modelArticle->getListArticleByLoai(1,-1,-1);;

    } else{

        $trangs = $modelArticle->getListArticleByLoai( $id_loai,-1, -1);

    }

    $total_record = count($trangs);
    
    $total_page = ceil($total_record / $limit);

    $offset = $limit * ($page - 1);

   

    if($com=='news'){

        $list_trang = $modelArticle->getListArticleByLoai(1,$offset,$limit);            

    }else{
        $list_trang = $modelArticle->getListArticleByLoai($id_loai,$offset,$limit);             
    } 
    

    

//echo $lang;

?>

<div class="container">

    <div class="container-left">
        <form method="post" id="register" name="register" action="">
            <input type="hidden" name="url" value=""/>
            <div class="block_content">
                <h3 class="reg_title">
                    <img style="width: 80px;top: 100px;position: absolute;" src="img/loi-ich.jpg"/>
                    <span style="margin-left:95px"><?php if($id_loai=="3"){echo "{tintuccn}";}else{echo "{tintuc}";} ?></span>
                </h3>
                <div class="contentFrame">
                    <div class="content" style="margin-top: 30px;">

                        <div class="content__block">
                            <?php
                               if(!empty($list_trang)){
                                    foreach ($list_trang as $key => $row) { 
                            ?>
                            <ul class="cate__post">
                                <li class="cate__post-item clearfix">
                                    <a href="<?php echo $row['HinhDaiDien']; ?>"  title="#" class="cate__post-img fancybox">
                                        <img style="width:150px;height:150px" src="<?php if($row['HinhDaiDien']==''){ echo 'img/no_image.jpg';} 
                                                                    else {
                                                                        echo $row['HinhDaiDien'];
                                                                    }  ?>" alt="<?php echo $row['title_'.$lang]; ?>">
                                    </a>

                                    <div class="cate__post-content">
                                        <a href="tintuc/<?php echo $row['title_alias'].'-'.$row['article_id'].'.html'; ?>" title="<?php echo $row['title_'.$lang]; ?>" class="cate__post-name">
                                            <h3><?php echo $row['title_'.$lang]; ?></h3>
                                        </a>

                                        <p class="cate__post-des"><?php echo $row['MoTa_'.$lang]; ?> </p>
                                        <a href="tintuc/<?php echo $row['title_alias'].'-'.$row['article_id'].'.html'; ?>" title="<?php echo $row['title_'.$lang]; ?>" class="cate__post-btt">
                                            <span>{chitiet} <i class="fa fa-caret-right"></i></span>
                                        </a>
                                    </div>
                                </li>
                                <li style="clear:both;"></li>                              

                            </ul>
                               <?php } } ?>
                           

                            <div><?php echo $modelArticle->phantrangHome($page, $page_show, $total_page, $link); ?></div>
                                
                            
                        </div>	<!-- /.content__block -->

                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php include 'blocks/right-content.php'; ?>
</div>

