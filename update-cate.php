<?php 
mysql_connect("db07.serverhossting.vn", 'ho107d1_userdb', "^N_8X(V_*b+&") or die("Can't connect to server");
mysql_select_db("ho107d1_vinhsang") or die("Can't connect database");
mysql_query("SET NAMES 'utf8'") or die(mysql_error());

//mysql_query("DELETE FROM cty_cate");die;

$sql = "SELECT * FROM congty ";
$rs = mysql_query($sql) or die(mysql_error());

while($row = mysql_fetch_assoc($rs)){
	$cate_id = $row['cate_id'];
	$congty_id = $row['congty_id'];
        $sql1="SELECT idTL from category WHERE cate_id=$cate_id";
                $row=  mysql_query($sql1);
                $row_tl=  mysql_fetch_assoc($row);
                $idTL=$row_tl['idTL'];
	$s = "Insert into cty_cate values(NULL,$congty_id,$cate_id,'$idTL')  ";
	$rs1 = mysql_query($s);
	var_dump($rs1);echo '<br>';
	//$row1 = mysql_fetch_assoc($rs1);	
	//$idQuocGia = $row1['idQuocGia'];	
	//$arrQuocGia[$idQuocGia]++;
}
?>
