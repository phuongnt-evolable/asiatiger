<?php
$link = "index.php?com=product_list";

    if (isset($_GET['idTL']) && $_GET['idTL'] > 0) {
        $idTL = (int) $_GET['idTL'];
        $link.="&idTL=$idTL";
    } else {
        $idTL = -1;
    }
    $page_show = 5;

    $limit = 20;

    $trangs = $modelProduct->getListProductByTheLoai($idTL, -1, -1);

    $total_record = mysql_num_rows($trangs);

    $total_page = ceil($total_record / $limit);

    if (isset($_GET['page']) == false) {
        $page = 1;
    } else {
        $page = (int) $_GET['page'];
    }

    $offset = $limit * ($page - 1);
    
    if($idTL > 0){
        //echo "123";die(113);
        $list_trang = $modelProduct->getListProductByTheLoai($idTL,-1,-1);
    }else{
        $list_trang = $modelProduct->getProduct();
    }
    

?>
<script type="text/javascript">
     $(document).ready(function(){
        $(".linkxoa").live('click',function(){
            var flag = confirm("Bạn có chắc chắn xóa");
            if(flag == true){
                var product_id = $(this).attr("product_id");
                $.get('xoa.php',{loai:"product",id:product_id},function(data){
                    window.location.reload();
                });
            }
        });
    });
</script>
<div>
    <div>
        <div style="width: 48%;float: left"><h3>{dssanpham} : {xemds}</h3></div>
        <div style="width: 48%;float: left;text-align: right;padding-top: 20px;text-transform: uppercase;font-size: 15px;font-weight: bold"><a href="index.php?com=product_add">{themsp}</a></div>
    </div>

    <div class="clr" style="clear: both"></div>
</div>
<div id="main_admin">

    <div>

        <div>
            <table>
                <thead>
                    <tr>
                        <td colspan="8">
                            <form method="get" action="" name="formTim" id="formTim">
                                {danhmuc}
                                <select name='idTL' id="idTL">
                            <option value='0'>---Chọn----</option>
                            <?php
                                //$idTL=$row['idTL'];
                                $rs_cha = $modelCate->getAllTL();
                                while($row_cha = mysql_fetch_assoc($rs_cha)){
                            ?>
                            <option value='<?php echo $row_cha['idTL']?>'><?php echo $row_cha['TenTL_'.$lang];?></option>
                            
                            <?php } ?>    
                          </select>
                                <input type="submit" name="btnSubmit" id="btnSubmit" value="  {xem} " />
                                <br /><br />
                                <input type="hidden" name="com" value="product_list"  />
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8"><?php echo $modelProduct->phantrang($page, $page_show, $total_page, $link); ?></td>
                    </tr>
                    <tr>
                        <th width="1%"></th>
                        <th align="center" width="1%">STT</th>
                        <th width="20%" align="left">{tendailoan}</th>
                        <th width="20%" align="left">{tenvietnam}</th>
                        <th width="20%" align="left">{tentienganh}</th>
                        
                        <th width="15%" align="left">{hinhanh} </th>
                        <th width="1%">Action</th>

                    </tr>
                </thead>

                <tbody>
                    <?php
                    $i = ($page-1)*$limit;;
                    while ($row = mysql_fetch_assoc($list_trang)) {
                        $i++;
                        ?>
                        <tr <?php if ($i % 2 == 0) echo "bgcolor='#CCC'"; ?>>
                            <td><input type="checkbox" name="chon" idDM=<?php echo $row['product_id'] ?>></td>
                            <td align="center" style="vertical-align: middle;"><?php echo $i; ?></td>
                            <td align="center" style="font-size: 16px;vertical-align: middle;"><?php echo $row['product_name_cn']; ?></td>
                            <td align="center" style="font-size: 16px;vertical-align: middle;"><?php echo $row['product_name_vi']; ?></td>
                            <td align="center" style="font-size: 16px;vertical-align: middle;"><?php echo $row['product_name_en']; ?></td>
                            
                            <td align="center"><img src="../<?php echo $row['url_images']; ?>" width="100" height="100"/></td>
                            <td style="white-space:nowrap">
                                <a href="index.php?com=product_edit&amp;product_id=<?php echo $row['product_id'] ?>"><img src="img/icons/user_edit.png" alt="" title="" border="0"></a>
                            &nbsp;&nbsp;
                                <img class="linkxoa" product_id="<?php echo $row['product_id'] ?>" src="img/icons/trash.png" alt="Xóa" title="Xóa" border="0"></td>

<?php } ?>
                    <tr>
                        <td colspan="7"><?php echo $modelProduct->phantrang($page, $page_show, $total_page, $link); ?></td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>


    <div class="clr"></div>
</div>
