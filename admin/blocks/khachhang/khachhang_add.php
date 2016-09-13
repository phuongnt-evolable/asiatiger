<?php
if (isset($_POST['btnSave'])) {
    $u=$modelUser->khachhang_them();
    header("location:index.php?com=khachhang_list_new");
}
?>

<div class="col-md-12">
  <!-- MAP & BOX PANE -->
  <!-- TABLE: LATEST ORDERS -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Update Thông tin </h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
      <form class="form-horizontal" method="post" action="">
        <div class="box-body">
          <div class="col-sm-6">
            
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Họ tên</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="hoten" id="hoten" placeholder="Họ tên" value="<?php echo $row['hoten']; ?>">                
              </div>
            </div>  
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Email</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $row['email']; ?>">                
              </div>
            </div> 
             <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Điện thoại</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="dienthoai" id="dienthoai" placeholder="Điện thoại" value="<?php echo $row['dienthoai']; ?>">                
              </div>
            </div> 
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Địa chỉ</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="diachi" id="diachi" placeholder="Địa chỉ" value="<?php echo $row['diachi']; ?>">                
              </div>
            </div> 
            
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Ngày sinh</label>
                <div class=" col-sm-8 input-group ngaysinh has-feedback">
                  <div class="input-group-addon ">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input id="ngaysinh" name="ngaysinh" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="dsfsdf" >
                  <span class="form-control-feedback sc-ngay_sinh" aria-hidden="true"></span>
                </div>
            </div> 

            
           
          </div>
          <div class="col-sm-6">            
              <div class="box-body">                
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">Mật khẩu</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                  </div>
                </div>                
              </div><!-- /.box-body -->             
            
          </div>
          
                  
        </div><!-- /.box-body -->
        <div class="box-footer">
          
          <button type="submit" name="btnSave" onclick="return validate();"  class="btn btn-info col-sm-offset-2 col-sm-2"><i style="margin-right:10px;" class="fa fa-save "></i>Lưu lại</button>
        </div><!-- /.box-footer -->
      </form><!-- /.table-responsive -->
    </div><!-- /.box-body -->
    <!--<div class="box-footer clearfix">
      <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
      <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
    </div><!-- /.box-footer -->
  </div><!-- /.box -->
</div><!-- /.col -->
