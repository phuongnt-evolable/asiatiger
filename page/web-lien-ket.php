<?php
    session_start();    
    $tieude_id = $tmp_uri[2];
    $arr = explode("-", $tieude_id);      
    $id_loai = (int) end($arr);
    
    $page_show = 5;
    $limit = 10;
    //echo $cate_id;
    $page1=$tmp_uri[3]; 
    
    $link1 = $_SERVER['REQUEST_URI'];

    $arr = explode("/", $link1);

    $link = $arr[1].'/'.$arr[2];

    //$page=$_GET[page1];

    if ($page1 > 1) {

       $page = $page1;

    } else {

        $page = 1;

    }
     
    
        //echo "vo day r ne"; 
        $trangs = $modelHome->getImageByCate(2,-1-1);
                            

    

    $total_record = count($trangs);
    
    $total_page = ceil($total_record / $limit);

    $offset = $limit * ($page - 1);

   

    

    $list_trang = $modelHome->getImageByCate(2,$offset,$limit);            

     
    

    

//echo $lang;

?>

<div class="container">

    <div class="container-left">
        <form method="post" id="register" name="register" action="">
            <input type="hidden" name="url" value=""/>
            <div class="block_content">
                <h3 class="reg_title">
                    <img style="width: 80px;top: 100px;position: absolute;" src="img/loi-ich.jpg"/>
                    <span style="margin-left:95px">{weblk}</span>
                </h3>
                <div class="contentFrame">
                    <div class="content" style="margin-top: 30px;">

                        <div class="content__block">
                            <?php
                               if(!empty($list_trang)){
                                    foreach($list_trang as $val => $row) { 
                            ?>
                            <ul class="cate__post">
                                <li class="cate__post-item clearfix">
                                    <a target="_blank" href="<?php echo $row['Href']; ?>"  title="#" class="cate__post-img fancybox">
                                        <img style="width:100px;" src="<?php if($row['Url']==''){ echo 'img/no_image.jpg';} 
                                                                    else {
                                                                        echo $row['Url'];
                                                                    }  ?>" alt="<?php echo $row['TenCT']; ?>">
                                    </a>

                                    <div class="cate__post-content">
                                        <a  target="_blank" href="<?php echo $row['Href']; ?>" title="<?php echo $row['TenCT']; ?>" class="cate__post-name">
                                            <h3><?php echo $row['TenCT']; ?></h3>
                                        </a>

                                        <p class="cate__post-des"><?php echo $row['MoTa_'.$lang]; ?> </p>
                                        
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

