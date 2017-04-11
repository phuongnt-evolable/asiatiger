<?php
    //session_start();
   $url = $_SERVER['REQUEST_URI'];   
    $_SESSION["url"]=$url;
?>
<style>
    
    .tieude-tin{
        //float:left;
        width: 830px;
        margin-left: 10px;
        height: 50px;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        color: #A81027;
    }
    .nd-tin{
        //float: left;
        width: 820px;
        margin-left: 20px;
        margin-top: 20px;
    }
    
</style>
<div class="container">
    
    <div class="container-left">
        <form method="post" id="register" name="register" action="">
            <input type="hidden" name="url" value=""/>
            <div class="block_content">
                <h3 class="reg_title">
                    <img style="width: 80px;top: 120px;position: absolute;" src="img/icon-news.jpg"/>
                    <span style="margin-left:95px">{tintuc}</span>
                </h3>
                    <div class="contentFrame">
                    <div class="content" style="margin-top: 60px;">

                        <div class="tieude-tin"><h1><?php echo $row_1['title_'.$lang]; ?></h1></div>
                        <div class="nd-tin">
                            <?php echo $row_1['content_'.$lang]; ?>
                        </div>
                        

                    </div>
                    </div>
            </div>
        </form>
    </div>
    <?php include 'blocks/right-content.php'; ?>
</div>

