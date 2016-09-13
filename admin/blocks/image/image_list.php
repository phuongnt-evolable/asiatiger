<?php
$link = "index.php?com=image_list";
$total_record = '';

    if (isset($_GET['category_id']) && $_GET['category_id'] > 0) {
         $category_id = (int) $_GET['category_id'];
        $link.="&category_id=$category_id";
    } else {
        $category_id = -1;
    }
    $page_show = 5;

    $limit = 20;

    if($category_id > 0){
        //echo "vo day r";
        $trangs=$modelHome->getImageByCate($category_id,-1,-1);
    }  else {
        $trangs = $modelHome->getHinhAnhHome();
    }
    if(!empty($trangs)){
        $total_record = count($trangs);
    }


    $total_page = ceil($total_record / $limit);

    if (isset($_GET['page']) == false) {
        $page = 1;
    } else {
        $page = (int) $_GET['page'];
    }

    $offset = $limit * ($page - 1);
  
        if($category_id > 0){

            $list_trang=$modelHome->getImageByCate($category_id,$offset,$limit);
        }  else {
            $list_trang = $modelHome->getHinhAnhHome();
        }
        
   
    

?>
<script type="text/javascript">
     $(document).ready(function(){
        $(".linkxoa").live('click',function(){
            var flag = confirm("Bạn có chắc chắn xóa");
            if(flag == true){
                var idHinh = $(this).attr("idHinh");
                $.get('xoa.php',{loai:"image",id:idHinh},function(data){
                    window.location.reload();
                });
            }
        });
    });
</script>
<div>
    <div>
        <div style="width: 48%;float: left"><h3>圖片管理</h3></div>
        <div style="width: 48%;float: left;text-align: right;padding-top: 20px;text-transform: uppercase;font-size: 15px;font-weight: bold"><a href="index.php?com=image_add">增加圖片</a></div>
    </div>

    <div class="clr" style="clear: both"></div>
</div>
<div id="main_admin">

    <div>

        <div>
            <table>
                <thead>
                    
                    <tr>
                        <td colspan="6"><?php echo $modelHome->phantrang($page, $page_show, $total_page, $link); ?></td>
                    </tr>
                    <tr>
                        <th width="1%"></th>
                        <th align="center" width="1%">STT</th>
                        <th align="left">Tên CTY</th>
                        <th align="left">Hình</th>
                        <th align="left">Url website</th>
                        <th align="left">Thuộc nghành</th>
                        <th width="1%">Action</th>

                    </tr>
                </thead>

                <tbody>
                    <?php
                    $i = ($page-1)*$limit;
                    
                   foreach($list_trang as $val => $row){
                        $url1=$row['Url']; 
                        $url = str_replace("static", "../static", $url1);
                        $i++;
                        ?>
                        <tr <?php if ($i % 2 == 0) echo "bgcolor='#CCC'"; ?>>
                            <td><input type="checkbox" name="chon" idDM=<?php echo $row['idHinh'] ?>></td>
                            <td align="center" style="vertical-align: middle;"><?php echo $i; ?></td>
                            <td align="center" style="vertical-align: middle;"><?php echo $row['TenCT']; ?></td>
                            <td align="center"><img src="../<?php echo $url; ?>" width="100" /></td>
                            <td align="center"><?php echo $row['Href']; ?></td>
                            <td align="center">
                                <?php
                                    $arr_cate_id = $modelHome->getArrIdCateByIdHinh($row['idHinh']);
                                    foreach($arr_cate_id as $cate_id){
                                       echo $cate_name = $modelHome->getCateByCateId($cate_id) .", ";
                                    }
                                ?>
                            </td>
                            <td style="white-space:nowrap">
                                <a href="index.php?com=image_edit&idHinh=<?php echo $row['idHinh'] ?>&category_id=<?php echo $category_id; ?>"><img src="img/icons/user_edit.png" alt="" title="" border="0"></a>
                            &nbsp;&nbsp;
                                <img class="linkxoa" idHinh="<?php echo $row['idHinh']; ?>" src="img/icons/trash.png" alt="Xóa" title="Xóa" border="0"></td>
                        </tr>
<?php } ?>
                    <tr>
                        <td colspan="6"><?php echo $modelHome->phantrang($page, $page_show, $total_page, $link); ?></td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>


    <div class="clr"></div>
</div>
