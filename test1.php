<?php
mysql_connect("db07.serverhossting.vn", 'ho107d1_userdb', "^N_8X(V_*b+&") or die("Can't connect to server");
mysql_select_db("ho107d1_vinhsang") or die("Can't connect database");
mysql_query("SET NAMES 'utf8'") or die(mysql_error());

    $cate_id = 1;
    $top = array();                
       $sql = "SELECT *
               FROM congty,cty_cate 
               WHERE congty.congty_id=cty_cate.congty_id AND congty.top = 1 AND cty_cate.cate_id = $cate_id   ORDER BY congty.congty_id DESC  ";        
        $rs = mysql_query($sql) or die(mysql_error());
        while($row = mysql_fetch_assoc($rs)){
            $congty_id = $row['congty_id'];
           // echo $a=$row['congty_id'];
            $top[]=$row;
            //var_dump($arrReturn);
        }         
         $sql1 = "SELECT *
               FROM congty,cty_cate 
               WHERE congty.congty_id NOT IN (SELECT congty.congty_id
                                                FROM congty,cty_cate 
                                                WHERE congty.congty_id=cty_cate.congty_id AND congty.top = 1 AND cty_cate.cate_id = $cate_id   ORDER BY congty.congty_id DESC ) "
                 . "AND congty.congty_id=cty_cate.congty_id AND congty.HinhDaiDien != '' AND cty_cate.cate_id = $cate_id    ORDER BY congty.congty_id DESC  ";        
        $rs1 = mysql_query($sql1) or die(mysql_error());
        while($row1 = mysql_fetch_assoc($rs1)){
            $congty_id1 = $row1['congty_id'];
            $CoHinh[]=$row1;
            //var_dump($CoHinh);
        }  
        $sql2 = "SELECT *
               FROM congty,cty_cate 
               WHERE congty.congty_id NOT IN (SELECT congty.congty_id
                                                FROM congty,cty_cate 
                                                WHERE congty.congty_id=cty_cate.congty_id AND congty.top = 1 AND cty_cate.cate_id = $cate_id   ORDER BY congty.congty_id DESC ) "
                 . "AND congty.congty_id=cty_cate.congty_id AND congty.HinhDaiDien = '' AND cty_cate.cate_id = $cate_id    ORDER BY congty.congty_id DESC  ";        
        $rs2 = mysql_query($sql2) or die(mysql_error());
        while($row2 = mysql_fetch_assoc($rs2)){
            $congty_id2 = $row2['congty_id'];
            $KoHinh[]=$row2;
            //var_dump($CoHinh);
        }    
        $gop=  array_merge($top,$CoHinh,$KoHinh);
        //var_dump($gop);
        foreach ($gop as $val){
           echo $ct_id = $val['congty_id'] .'-'.$val['TenCT_vi'].'<br/>' ;
           // $congty="SELECT * 
                    // FROM congty
                    // WHERE congty_id=$ct_id";
        }
?>
