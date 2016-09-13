<?php
  $id = (int) $_GET['id'];
  $chitiet = $modelUser->khachhang_chitiet($id);
  $row = mysql_fetch_assoc($chitiet);
  if($row['ngaysinh'] != NULL){
    $arr = explode("/", $row['ngaysinh']);
    $date = $arr['0'];
    $month = $arr['1'];
    $year = $arr['2'];
  }

  if (isset($_POST['btnSave'])) {
      $u = $modelUser->khachhang_edit($id);     
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
            <div class="form-group ">
                          <label class="control-label no-lh col-sm-4" for="birthdate">
                              Ngày sinh:                              
                          </label>

                          <div class="input-wrap col-sm-8">
                            <div class="row">
                              <div id="birthday-picker" class="birthday-picker">
                                  <fieldset class="birthday-picker">
                                      <select style=" width: 30%; margin-right:10px" class="birth-day form-control col-sm-4" name="day" id="day">
                                          <option value="0">Ngày</option>
                                          <?php
                                            //$i=1;
                                            for( $i=1 ; $i <= 31 ; $i++){
                                              if($i<10) { 
                                                echo $value_ngay = "0".$i;
                                              }else{ 
                                                echo $value_ngay = $i ;
                                              } 
                                          ?>
                                          <option value="<?php echo $value_ngay; ?>" <?php if($date==$value_ngay){ echo "selected";} ?>><?php echo $value_ngay; ?></option>
                                          <?php } ?>
                                          
                                          
                                      </select>
                                      <select style=" width: 30%; margin-right:10px" class="birth-month form-control col-sm-4" name="month" id="month">
                                          <option value="0">Tháng</option>
                                          <?php
                                            //$i=1;
                                            for( $i=1 ; $i <= 12 ; $i++){
                                               if($i<10) { 
                                                echo $value_thang = "0".$i;
                                              }else{ 
                                                echo $value_thang = $i ;
                                              } 
                                          ?>
                                          <option value="<?php echo $value_thang; ?>" <?php if($month==$value_thang){ echo "selected";} ?>>Tháng <?php echo $value_thang; ?></option>
                                          <?php } ?>
                                          
                                      </select>
                                      <select style=" width: 30%;" class="birth-year form-control col-sm-4" name="year" id="year">
                                          <option value="0">Năm</option>

                                          <?php
                                            //$i=1;
                                            for( $i=2016 ; $i >= 1985; $i--){
                                          ?>
                                          <option value="<?php echo $i ; ?>" <?php if($year==$i){ echo "selected";} ?>><?php echo $i ; ?></option>
                                          <?php } ?>
                                          
                                      </select>
                                      <input type="hidden" name="ngay_sinh" id="ngay_sinh" value="1989-07-11">
                                  </fieldset>
                              </div>
                              </div>
                              <span class="help-block"></span>
                          </div>
                      </div>
            <!-- <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Ngày sinh</label>
                <div class=" col-sm-8 input-group ngaysinh has-feedback">
                  <div class="input-group-addon ">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input id="ngaysinh" name="ngaysinh" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="dsfsdf" >
                  <span class="form-control-feedback sc-ngay_sinh" aria-hidden="true"></span>
                </div>/.input group
            </div>   -->

            
           
          </div>
          
          
                  
        </div><!-- /.box-body -->
        <div class="box-footer">
          <?php if($row['idLoai']!=1){ ?><input type="hidden" value="<?php echo $row['idLoai']; ?>" name='group' id="group"><?php } ?>
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
