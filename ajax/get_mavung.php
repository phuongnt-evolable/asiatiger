<?php
    require_once('../admin/Model/Db.php'); 
    $d = new db;

    $idQuocGia = (int) $_POST['idQuocGia'];
    $rs = mysql_query('SELECT * FROM quocgia WHERE idQuocGia = '.$idQuocGia);
    while($row = mysql_fetch_assoc($rs)){
    ?>   
    <option value="<?php echo $row['MaVung'];?>"><?php echo $row['MaVung'];?></option>
    <?php    
    }
?>
