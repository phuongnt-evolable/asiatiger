<?php
    $khachhang_list = $modelCongTy->khachhang_list();
?>
<script type="text/javascript">
    $(document).ready(function(){   
      
        $(".linkxoa").click(function(){ 
            var flag = confirm("Bạn có chắc chắn xóa");
            if(flag == true){
                var id = $(this).attr("id");
                var congty_id = $(this).attr("congty_id");
                $.get('xoa.php',{loai:"khachhang",id:id,congty_id:congty_id},function(data){
                    window.location.reload();
                }); 
            }
        });    
        
    });
</script>


<div class="col-md-12">
  <!-- MAP & BOX PANE -->
  <!-- TABLE: LATEST ORDERS -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Quản lý danh sách khách hàng</h3>
      
    </div><!-- /.box-header -->
    <div class="box-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped no-margin ">
          <thead>
            <tr>
              <th>ID</th>              
              <th>User name </th>  
              <th>Email</th>                       
              <th>Action</th>                          
            </tr>
          </thead>
          <tbody>
            
             <?php
                $i = 0;
                while ($row = mysql_fetch_assoc($khachhang_list)) {
                    $i++;                    
              ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $row['User']; ?></td>
              <td><?php echo $row['Email']; ?></td>
              <td style="text-align: center">
                <a style="padding-right: 20px;" href="index.php?com=congty_edit&congty_id=<?php echo $row['congty_id'] ?>"><img src="img/icons/user_edit.png" alt="" title="" border="0"></a>
                  &nbsp;&nbsp;
                  <img class="linkxoa" id="<?php echo $row['id'] ?>" congty_id="<?php echo $row['congty_id'] ?>" src="img/icons/trash.png" alt="Xóa" title="Xóa" border="0">
              </td>                          
            </tr>
            <?php } ?>

          </tbody>
          <tfoot>
              <tr>
                <th>ID</th>              
                <th>Tên khách hàng </th>  
                <th>Email</th>                       
                <th>Action</th> 
              </tr>
          </tfoot>
        </table>
      </div><!-- /.table-responsive -->
    </div><!-- /.box-body -->
    <!--<div class="box-footer clearfix">
      <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
      <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
    </div><!-- /.box-footer -->
  </div><!-- /.box -->
  
</div><!-- /.col -->

