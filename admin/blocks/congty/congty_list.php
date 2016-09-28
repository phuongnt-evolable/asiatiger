<?php
$link = "index.php?com=congty_list";
    if(isset($_GET['tukhoa']) && !empty($_GET['tukhoa'])){
         $tukhoa = $_GET['tukhoa'];
        $link.="&tukhoa=$tukhoa";
     }   

    if (isset($_GET['cate_id']) && $_GET['cate_id'] > 0) {
        $cate_id = (int) $_GET['cate_id'];
        $link.="&cate_id=$cate_id";
    } else {
        $cate_id = -1;
    }
    $page_show = 5;

    $limit = 20;
    //echo $cate_id;

    if(isset($tukhoa)){
        $trangs = $modelCongTy->getListCongTyByTheLoai_TuKhoa($tukhoa,$lang,-1,  -1);
    }else{
        if($cate_id > 0){
            $trangs = $modelCongTy->getListCongTyByTheLoaiAdmin( $cate_id, -1, -1);
        }  else {
            $trangs = $modelCongTy->getListCongTyByCategoryAdmin( -1, -1);
        }
    }

    if(isset($tukhoa)){
        $total_record = count($trangs);
    }else{
        $total_record = mysql_num_rows($trangs);
    }

    $total_page = ceil($total_record / $limit);

    if (isset($_GET['page']) == false) {
        $page = 1;
    } else {
        $page = (int) $_GET['page'];
    }

     $offset = $limit * ($page - 1);

    
    if(isset($tukhoa)){
        $list_trang = $modelCongTy->getListCongTyByTheLoai_TuKhoa($tukhoa,$lang, $offset, $limit);
    }else{
         if($cate_id > 0){
            $list_trang = $modelCongTy->getListCongTyByTheLoaiAdmin($cate_id,$offset,$limit);
        }else{
            $list_trang = $modelCongTy->getListCongTyByCategoryAdmin( $offset, $limit);
        }
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
                <form method="get" action="" name="formTim" id="formTim">
                     <tr>
                        <td colspan="8">

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
                                    <option <?php if($cate_id == $row_con['cate_id']) { echo "selected" ;} ?> value="<?php echo $row_con['cate_id']?>" ><?php echo $row_con['cate_name_'.$lang]?></option>
                                <?php }}else{ ?>
                                    <option value="<?php echo $row_cha['cate_id']?>"><?php echo $row_cha['cate_name_'.$lang]?></option>
                                <?php } ?>
                                  </optgroup>

                                <?php  } ?> 
                          </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Tìm công ty </td>
                        <td colspan="4">
                                <div class="ui-searchbar-main">
                                    <input type="text" class="ui-searchbar-keyword" name="tukhoa" autocomplete="off" x-webkit-speech="x-webkit-speech" x-webkit-grammar="builtin:translate" lang="en">
                                </div>
                            <input type="submit" name="btnSubmit" id="btnSubmit" value="  {xem} " />
                                <input type="hidden" name="com" value="congty_list"/>  
                        </td>

                    </tr>
                </form>
                     <tr>
                         <td colspan="8">
                             <a style="color: #9e241e; font-weight: bold;">Tìm được <?php echo $total_record; ?> công ty.</a>
                         </td>
                     </tr>
                    <tr>
                        <td colspan="8"><?php echo $modelCongTy->phantrang($page, $page_show, $total_page, $link); ?></td>
                    </tr>
                    <tr>
                        <th width="1%"></th>
                        <th align="center" width="1%">STT</th>
                        <th width="20%" align="center">Tên công ty</th>
                        <th width="20%" align="center">{diachi}</th>
                        <!--<th width="20%" align="center">{gioithieu}</th>-->
                        
                        <th width="15%" align="center">{hinhanh} </th>
                        <th width="1%">Action</th>

                    </tr>
                </thead>

                <tbody>
                    <?php
                    $i = ($page-1)*$limit;
                        if(isset($tukhoa)){

                            foreach ($list_trang as $row) {
                                $i++;
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

                            <?php } } else { ?>
                             <?php
                                while ($row = mysql_fetch_assoc($list_trang)) {
                                    $i++;
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
                             <?php } }?>
                    <tr>
                        <td colspan="7"><?php echo $modelCongTy->phantrang($page, $page_show, $total_page, $link); ?></td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>


    <div class="clr"></div>
</div>
