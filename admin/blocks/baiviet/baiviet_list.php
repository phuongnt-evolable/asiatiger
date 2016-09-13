<?php

   $link = "index.php?com=baiviet_list";

    //echo $id_loai= $_GET['idLoaiTin'];die("asadf");
    if (isset($_GET['idLoaiTin']) && $_GET['idLoaiTin'] > 0) {
        $id_loai = (int) $_GET['idLoaiTin'];
        $link.="&idLoaiTin=$id_loai";
    } else {
        $id_loai = -1;
    }
    $page_show = 5;

    $limit = 20;

    if($id_loai < 0){
        $trangs = $modelArticle->getListArticle(-1,-1); 
    }else{
        $trangs = $modelArticle -> getListArticleByLoai($id_loai, $offset = -1, $limit = -1);
    }
    
    $total_record = count($trangs);

    $total_page = ceil($total_record / $limit);

    if (isset($_GET['page']) == false) {
        $page = 1;
    } else {
        $page = (int) $_GET['page'];       
    }

    $offset = $limit * ($page - 1);

    //$list_trang1 = $modelArticle->getListArticleByCategory($category_id, $offset, $limit);
    if($id_loai < 0){
      $list_trang = $modelArticle->getListArticle($offset, $limit);  
    }else{
        $list_trang = $modelArticle->getListArticleByLoai($id_loai, $offset, $limit );
    }
    
?>
<script type="text/javascript">
     $(document).ready(function(){		
        $(".linkxoa").live('click',function(){			
            var flag = confirm("Bạn có chắc chắn xóa");
            if(flag == true){
                var article_id = $(this).attr("article_id");
                $.get('xoa.php',{loai:"baiviet",id:article_id},function(data){
                    window.location.reload();			
                });	
            }
        });               
    });
</script>
<div>
    <div>
        <div style="width: 48%;float: left"><h3>{baiviet} : {xemds}</h3></div>
        <div style="width: 48%;float: left;text-align: right;padding-top: 20px;text-transform: uppercase;font-size: 15px;font-weight: bold"><a href="index.php?com=baiviet_add">{thembaiviet}</a></div>
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
                                <select name='idLoaiTin' id="idTL">
                            <option value='0'>---Chọn----</option>
                            <?php
                                //$idTL=$row['idTL'];
                                $rs_cha = $modelArticle->getLoaiArticle();
                                while($row_cha = mysql_fetch_assoc($rs_cha)){
                            ?>
                            <option value='<?php echo $row_cha['id']?>'><?php echo $row_cha['TenLoaiTin'];?></option>
                            
                            <?php } ?>    
                          </select>
                                <input type="submit" name="btnSubmit" id="btnSubmit" value="  {xem} " />
                                <br /><br />
                                <input type="hidden" name="com" value="baiviet_list"  />
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7"><?php echo $modelArticle->phantrang($page, $page_show, $total_page, $link); ?></td>
                    </tr>
                    <tr>
                        <th width="1%"></th>
                        <th align="center" width="1%">STT</th>
                        <th align="left">{hinhanh}</th>
                        <th align="left">{tieudedailoan}</th>
                        <th align="left"> {tieudevietnam}</th>
                        <th align="left"> {tentienganh}</th>
                        <th width="1%">Action</th>

                    </tr>
                </thead>

                <tbody>
                    <?php
                    $i = ($page-1)*$limit;;
                        foreach ($list_trang as $key => $row )  {                       
                        $i++;
                        ?>
                        <tr <?php if ($i % 2 == 0) echo "bgcolor='#CCC'"; ?>>
                            <td><input type="checkbox" name="chon" idDM=<?php echo $row['article_id'] ?>></td>
                            <td align="center"><?php echo $i; ?></td>
                            <td align="left" style="vertical-align: top;"><img width="100px" src="../<?php if($row['HinhDaiDien']==''){ echo 'img/no_image.jpg';} 
                                                                                else {
                                                                                    echo $row['HinhDaiDien'];
                                                                                }  ?>"/></td>
                            <td align="left" style="vertical-align: top;"><?php echo $row['title_cn']; ?></td>
                            <td align="left" style="vertical-align: top;"><?php echo $row['title_vi']; ?></td>
                            <td align="left" style="vertical-align: top;"><?php echo $row['title_en']; ?></td>
                            <td style="white-space:nowrap">
                                <a href="index.php?com=baiviet_edit&amp;article_id=<?php echo $row['article_id'] ?>"><img src="img/icons/user_edit.png" alt="" title="" border="0"></a>
                            &nbsp;&nbsp;
                                <img class="linkxoa" article_id="<?php echo $row['article_id'] ?>" src="img/icons/trash.png" alt="Xóa" title="Xóa" border="0"></td>

<?php } ?>
                    <tr>
                        <td colspan="7"><?php echo $modelArticle->phantrang($page, $page_show, $total_page, $link); ?></td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>


    <div class="clr"></div>
</div>
