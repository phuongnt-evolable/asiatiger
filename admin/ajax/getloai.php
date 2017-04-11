<?php
require_once "../Model/Db.php";
$db = new db;

echo $idTL = (int) $_POST['idTL'];
echo $rs = mysql_query('SELECT * FROM congty WHERE cate_id = '.$idTL);
while($row = mysql_fetch_assoc($rs)){
?>   
<option value="<?php echo $row['congty_id'];?>"><?php echo $row['TenCT_vi'];?></option>
<?php    
}
?>
