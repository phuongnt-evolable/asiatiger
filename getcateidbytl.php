<?php 
mysql_connect("db07.serverhossting.vn", 'ho107d1_userdb', "^N_8X(V_*b+&") or die("Can't connect to server");
mysql_select_db("ho107d1_vinhsang") or die("Can't connect database");
mysql_query("SET NAMES 'utf8'") or die(mysql_error());

$idTL =1 ;
$sql = "SELECT cate_id FROM category WHERE idTL = $idTL ";
$rs = mysql_query($sql) or die(mysql_error());
$str_category_id = '';
while($row = mysql_fetch_assoc($rs)){
    $str_category_id .=  $row['cate_id'].",";
}

$str_category_id = rtrim($str_category_id,",");

function getListCongTyByTheLoai1($str_cate_id = -1, $offset = -1, $limit = -1) {
        $arrReturn = array();
        
       echo $sql = "SELECT * FROM cty_cate WHERE cate_id IN(".$str_cate_id.")  ORDER BY congty_id DESC   ";  
        if ($limit > 0 && $offset >= 0)
            $sql .= " LIMIT $offset,$limit";
        $rs = mysql_query($sql) or die(mysql_error());
        while($row = mysql_fetch_assoc($rs)){
            
            $congty_id = $row['congty_id'];
            
            $sql = "SELECT * FROM congty WHERE congty_id = $congty_id" ;
            $rs1 = mysql_query($sql);
            $row1 = mysql_fetch_assoc($rs1);


            $arrReturn[$congty_id]= $row1;



        }
        
        return $arrReturn;
    }


$data = getListCongTyByTheLoai1($str_category_id,0,-1);

echo $dem=count($data);

if(!empty($data)){
    foreach ($data as $key => $a) {
    var_dump("<pre>",$key);       
         echo $a['TenCT_vi']."<br >";  
    }   
}
?>
