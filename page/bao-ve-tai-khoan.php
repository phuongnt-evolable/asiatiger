<?php
    //session_start();
   $url = $_SERVER['REQUEST_URI'];   
    $_SESSION["url"]=$url;
?>
<style>
    .hinh-nd-gt{
        margin-top: 20px;
        width: 880px;
        margin-left: 60px;
    }
    .gt-cn{
        letter-spacing: 3px;
    }
    .hinh-gt{
        //float:left;
        width: 300px;
        //margin-left: 10px;
        text-align: center;
    }
    .center{
        text-align: center;
    }
    .yes-icon{
        width: 30px;
       // background-image: url("img/yes-icon.png");
        float: left;
        margin-top: -10px;
        margin-right: 20px;
        
    }
    .nd-gt{
        float: left;
        width: 700px;
        margin-left: 20px;
        margin-top: 10px;
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 20px;
    }
    .content-gt{
        margin-top: 30px;
        margin-left: 10px;
        font-size: 16;
        line-height: 1.6;
    }
    content-gt  p{
       margin-bottom: 20px; 
    }
</style>
<div class="container">
    
    <div class="container-left">
        <form method="post" id="register" name="register" action="">
            <input type="hidden" name="url" value=""/>
            <div class="block_content">
                <h3 class="reg_title">
                    <img style="width: 80px;top: 100px;position: absolute;" src="img/loi-ich.jpg"/>
                    <span style="margin-left:95px">{baoveriengtu}</span>
                </h3>
                    <div class="contentFrame">
                    <div class="content" style="margin-top: 30px;">

                         <?php 
                            $sql="SELECT * FROM blocks where block_id=15";
                            $block=mysql_query($sql) or die(mysql_error());                                               
                            $row_block =  mysql_fetch_assoc($block); 

                            echo $row_block['block_content_'.$lang];
                         ?>
                        
                        <div style="text-align: center;margin-top: 30px"><img src="img/icon-dn.jpg"/></div>

                    </div>
                    </div>
            </div>
        </form>
    </div>
    <?php include 'blocks/right-content.php'; ?>
</div>

