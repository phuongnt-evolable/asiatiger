<?php
$link = "index.php?com=duan_list";

    
    $page_show = 5;

    $limit = 20;

    $trangs = $modelArticle->getListDuAn();

    $total_record = mysql_num_rows($trangs);

    $total_page = ceil($total_record / $limit);

    if (isset($_GET['page']) == false) {
        $page = 1;
    } else {
        $page = (int) $_GET['page'];       
    }

    $offset = $limit * ($page - 1);

    //$list_trang1 = $modelArticle->getListArticleByCategory($category_id, $offset, $limit);
    $list_trang = $modelArticle->getListDuAn();
?>
<script type="text/javascript">
     $(document).ready(function(){		
        $(".linkxoa").live('click',function(){			
            var flag = confirm("Bạn có chắc chắn xóa");
            if(flag == true){
                var article_id = $(this).attr("article_id");
                $.get('xoa.php',{loai:"duan",id:article_id},function(data){
                    window.location.reload();			
                });	
            }
        });               
    });
</script>
<div>
    <div>
        <div style="width: 48%;float: left"><h3>{duandalam} : {xemds}</h3></div>
        <div style="width: 48%;float: left;text-align: right;padding-top: 20px;text-transform: uppercase;font-size: 15px;font-weight: bold"><a href="index.php?com=duan_add">{themduan}</a></div>
    </div>

    <div class="clr" style="clear: both"></div>
</div>
<div id="main_admin">

    <div>

        <div>
            <table>
                <thead>
                    
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
                    while ($row = mysql_fetch_assoc($list_trang)) {                       
                        $i++;
                        ?>
                        <tr <?php if ($i % 2 == 0) echo "bgcolor='#CCC'"; ?>>
                            <td><input type="checkbox" name="chon" idDM=<?php echo $row['idDuAn'] ?>></td>
                            <td align="center"><?php echo $i; ?></td>
                            <td align="left"><img width="100px" src="../<?php echo $row['HinhDaiDien']; ?>"/></td>
                            <td align="left"><?php echo $row['TenDuAn_cn']; ?></td>
                            <td align="left"><?php echo $row['TenDuAn_vi']; ?></td>
                            <td align="left"><?php echo $row['TenDuAn_en']; ?></td> 
                            <td style="white-space:nowrap">
                                <a href="index.php?com=duan_edit&amp;duan_id=<?php echo $row['idDuAn'] ?>"><img src="img/icons/user_edit.png" alt="" title="" border="0"></a>
                            &nbsp;&nbsp;
                                <img class="linkxoa" article_id="<?php echo $row['idDuAn'] ?>" src="img/icons/trash.png" alt="Xóa" title="Xóa" border="0"></td>

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
