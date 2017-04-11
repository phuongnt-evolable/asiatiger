<?php
$link = "index.php?com=congty_list";

    if (isset($_GET['cate_id']) && $_GET['cate_id'] > 0) {
        $cate_id = (int) $_GET['cate_id'];
        $link.="&cate_id=$cate_id";
    } else {
        $cate_id = -1;
    }
    $page_show = 5;

    $limit = 20;
    //echo $cate_id;
    $trangs = $modelCongTy->getListCongTyChuaNghanh( -1, -1);

    $total_record = mysql_num_rows($trangs);

    $total_page = ceil($total_record / $limit);

    if (isset($_GET['page']) == false) {
        $page = 1;
    } else {
        $page = (int) $_GET['page'];
    }

    $offset = $limit * ($page - 1);
    
    if($cate_id > 0){
        //echo "123";die(113);
        $list_trang = $modelCongTy->getListCongTyByTheLoai($cate_id,-1,-1);
    }else{
        //$list_trang = $modelCongTy->getListCongTyByCategory( $offset, $limit);
        $list_trang = $modelCongTy->getListCongTyChuaNghanh($offset = -1, $limit = -1);
    }
    
//echo $lang;
?>
<script type="text/javascript">
     $(document).ready(function(){
        $(".linkxoa").live('click',function(){
            var flag = confirm("Bạn có chắc chắn xóa");
            if(flag == true){
                var congty_id = $(this).attr("congty_id");
                //alert(congty_id);
                $.get('xoa.php',{loai:"congty",id:congty_id},function(data){
                    window.location.reload();
                });
            }
        });
    });
</script>
<div>
    <div>
        <div style="width: 48%;float: left"><h3>{dscty} : {xemds}</h3></div>
        <div style="width: 48%;float: left;text-align: right;padding-top: 20px;text-transform: uppercase;font-size: 15px;font-weight: bold"><a href="index.php?com=congty_add">{themcty}</a></div>
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
                                <select name='cate_id' id="cate_id">
                                <option value='0'>---Chọn----</option>
                            <?php
                                $rs_cha = $modelCate->getAllTL();
                                while($row_cha = mysql_fetch_assoc($rs_cha)){
                                   // $idTL=$row_cha['idTL'];
                                ?>

                                <optgroup value="<?php echo $row_cha['idTL']?>" label="<?php echo $row_cha['TenTL_'.$lang]?>">
                                    <?php
                                $rs_con = $modelCate->getListCate($row_cha['idTL']);
                                if(mysql_num_rows($rs_con) > 0) {while($row_con = mysql_fetch_assoc($rs_con)){
                                ?>
                                    <option value="<?php echo $row_con['cate_id']?>"><?php echo $row_con['cate_name_'.$lang]?></option>
                                <?php }}else{ ?>
                                    <option value="<?php echo $row_cha['cate_id']?>"><?php echo $row_cha['cate_name_'.$lang]?></option>
                                <?php } ?>
                                  </optgroup>

                                <?php  } ?> 
                          </select>
                                <input type="submit" name="btnSubmit" id="btnSubmit" value="  {xem} " />
                                <br /><br />
                                <input type="hidden" name="com" value="congty_list"  />
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8"><?php echo $modelCongTy->phantrang($page, $page_show, $total_page, $link); ?></td>
                    </tr>
                    <tr>
                        <th width="1%"></th>
                        <th align="center" width="1%">STT</th>
                        <th width="20%" align="center">{tencty}</th>
                        <th width="20%" align="center">{diachi}</th>
                        <!--<th width="20%" align="center">{gioithieu}</th>-->
                        
                        <th width="15%" align="center">{hinhanh} </th>
                        <th width="1%">Action</th>

                    </tr>
                </thead>

                <tbody>
                    <?php
                    
                   
                        
                        
                        if(!empty($list_trang)){
                            $i = ($page-1)*$limit;                        
                            foreach ($list_trang as $key => $row) {
                                $i++;                            
                            //var_dump("<pre>",$key);       
                                 // $a['TenCT_vi']."<br >";  
                    ?>
                        <tr <?php if ($i % 2 == 0) echo "bgcolor='#CCC'"; ?>>
                            <td><input type="checkbox" name="chon" idDM=<?php echo $row['congty_id'] ?>></td>
                            <td align="center" style="vertical-align: middle;"><?php echo $i; ?></td>
                            <td align="center" style="font-size: 16px;vertical-align: middle;"><?php echo $row['TenCT_'.$lang]; ?></td>
                            <td align="center" style="font-size: 16px;vertical-align: middle;"><?php echo $row['DiaChi_'.$lang]; ?></td>
                            <!--<td align="center" style="font-size: 16px;vertical-align: middle;">
                                <div style="height: 100px; width: 350px; overflow: hidden;"><?php 
                                   echo $noidung= $row['GioiThieu_'.$lang];
                                    //echo $chuoi1=substr($noidung,1,100);
                                ?>
                                    </div>
                            </td>-->
                            
                            <td align="center"><img src="../<?php echo $row['HinhDaiDien']; ?>" width="100" height="100"/></td>
                            <td style="white-space:nowrap">
                                <a href="index.php?com=congty_edit&amp;congty_id=<?php echo $row['congty_id'] ?>"><img src="img/icons/user_edit.png" alt="" title="" border="0"></a>
                            &nbsp;&nbsp;
                                <img class="linkxoa" congty_id="<?php echo $row['congty_id'] ?>" src="img/icons/trash.png" alt="Xóa" title="Xóa" border="0"></td>

                        <?php } } ?>
                    <tr>
                        <td colspan="7"><?php echo $modelCongTy->phantrang($page, $page_show, $total_page, $link); ?></td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>


    <div class="clr"></div>
</div>
