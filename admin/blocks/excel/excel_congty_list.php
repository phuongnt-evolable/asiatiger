<?php
$d = new db;
if (isset($_POST['btnSave'])) {
    $condition = array(
        'limit' => 0,
        'offset' => 0
    );
    $company_list = $modelCongTy->getListCongTyByCondition($condition);
    if (!empty($company_list)) {
        $csv_export = array();

        // Build header and template for csv export data
        $csv_export = $d->generateCsvTemplate($csv_export);
        // Build data for csv export
        $csv_export = $d->generateCsvContent(
            $csv_export,
            $company_list
        );
        $tmp_file_data_name = 'list_all_company_'. uniqid();
        $file_name = $tmp_file_data_name . ".csv";
        $modelCsvHelper->exportCsvListAllCompany($csv_export, $file_name);
    }
    exit;
}
?>



<div class="col-md-12">
  <!-- MAP & BOX PANE -->
  <!-- TABLE: LATEST ORDERS -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Quản lý danh sách công ty</h3>
      
    </div><!-- /.box-header -->
    <div class="box-body">
      <div class="table-responsive">
          <form action="" method="post" id="form_download">
              <input type="hidden" name="tab" value="{{ tab }}">
              <button class="btn btn-download text-hide m-r-2 btnSave" name="btnSave" type="submit">Download</button>
          </form>
      </div><!-- /.table-responsive -->
    </div><!-- /.box-body -->
  </div><!-- /.box -->
  
</div><!-- /.col -->