<?php

require_once "Db.php";

class Menu extends Db {

    function menu_list() {
        $sql = "SELECT * FROM menu ORDER BY menu_id";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }

    function insertMenu() {
        $type = (int) $_POST['type'];

        $menu = $this->processData($_POST['menu']);

        $update_time = time();
        $article_id = 0;      
        
        $menu_alias = $this->changeTitle($menu);

        $sql = "INSERT INTO menu VALUES(NULL,'$menu','$menu_alias',$article_id,$type,$update_time,'$menu','$menu','$menu')";								
        mysql_query($sql) or die(mysql_error() . $sql);
    }
    function updateMenu($menu_id) {
        $type = (int) $_POST['type'];

        $menu = $this->processData($_POST['menu']);

        $update_time = time(); 
        
        $menu_alias = $this->changeTitle($menu);

         $sql = "UPDATE menu
                SET menu = '$menu',menu_alias = '$menu_alias',
                type = $type,update_time = $update_time,					
                seo_title = '$menu',seo_description = '$menu',seo_keyword = '$menu'					
                WHERE menu_id = $menu_id ";
        mysql_query($sql) or die(mysql_error() . $sql);
    }
    function getDetailMenu($menu_id){
        $sql = "SELECT * FROM menu WHERE menu_id = $menu_id";
        $rs = mysql_query($sql) or die(mysql_error());
        return $rs;
    }

}

?>