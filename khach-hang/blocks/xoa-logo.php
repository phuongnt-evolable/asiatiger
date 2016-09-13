<?php
    //$HinhDaiDien=$_POST['HinhDaiDien'];
    $congty_id=$_POST['congty_id'];
    $sql = "UPDATE congty
            SET HinhDaiDien = ''
            WHERE congty_id = $congty_id ";
    mysql_query($sql) or die(mysql_error() . $sql);
    header("location: up-logo.html");
?>