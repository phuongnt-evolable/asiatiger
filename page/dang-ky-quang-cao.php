<?php
    //session_start();
   $url = $_SERVER['REQUEST_URI'];   
    $_SESSION["url"]=$url;
?>
<link href="css/price_email_hosting.css" rel="stylesheet" type="text/css" media="all">
<div class="container">

    <div class="container-left">
        <form method="post" id="register" name="register" action="">
            <input type="hidden" name="url" value=""/>
            <div class="block_content">
                <h3 class="reg_title">
                    <img style="top: 125px;position: absolute;" src="img/quang-cao.png"/>
                    <span style="margin-left:65px">{dkquangcao}</span>
                </h3>                    
                <?php 
                    $sql="SELECT * FROM blocks where block_id=14";
                    $block=mysql_query($sql) or die(mysql_error());                                               
                    $row_block =  mysql_fetch_assoc($block); 

                    echo $row_block['block_content_'.$lang];
                 ?>





            </div>
        </form>
    </div>
    <?php include 'blocks/right-content.php'; ?>
</div>