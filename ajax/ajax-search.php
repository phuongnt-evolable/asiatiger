<ul class="ui-beacon-subs">
<?php 
	require("../admin/Model/Db.php");
	$tukhoa=$_GET["tukhoa"];
        $lang=$_GET["lang"];
		$db=new db();
		$tin=$db->TimKiem($tukhoa);
	while($row_tin=mysql_fetch_array($tin)){	
?>

    <li class="ui-beacon-sub"><a><?php echo '<p > <a href="'.$row['link'].'" target="_blank" ><b>'.$row_tin['TenCT_'.$lang].'</b></a><br>'.$row_tin['MoTa_'.$lang] .'</p>'   ; ?></a> </li>

	
<?php } ?>

</ul>

<?php /*<div id="tin"><?php echo '<p > <a href="'.$row['link'].'" target="_blank" ><b>'.$row_tin['TenCT_'.$lang].'</b></a><br>'.$row_tin['MoTa_'.$lang] .'</p>'   ; ?> </div>*/?>