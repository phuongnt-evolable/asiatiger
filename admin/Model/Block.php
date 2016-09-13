<?php

require_once "Db.php";

class Block extends Db {

    function getListBlock() {
        $sql = "SELECT * FROM blocks ORDER BY block_id";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }

    function insertBlock() {
        $block_content_cn = $_POST['block_content_cn'];
        $block_content_vi = $_POST['block_content_vi'];
        $block_content_en = $_POST['block_content_en'];
        $block_name = $this->processData($_POST['block_name']);

        $update_time = time();         
       
        $sql = "INSERT INTO blocks VALUES(NULL,'$block_name','$block_content_cn','$block_content_vi','$block_content_en',$update_time)";								
        mysql_query($sql) or die(mysql_error() . $sql);
    }
    function updateBlock($block_id) {
        $block_content_cn = $_POST['block_content_cn'];
        $block_content_vi = $_POST['block_content_vi'];
        $block_content_en = $_POST['block_content_en'];
        $update_time = time(); 
        
         $sql = "UPDATE blocks
                SET block_content_cn = '$block_content_cn', block_content_vi = '$block_content_vi', block_content_en = '$block_content_en',update_time = $update_time				
                WHERE block_id = $block_id ";
        mysql_query($sql) or die(mysql_error() . $sql);
    }
    function getDetailBlock($block_id){
        $sql = "SELECT * FROM blocks WHERE block_id = $block_id";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }

}

?>