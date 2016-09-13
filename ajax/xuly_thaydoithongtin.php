<?php
        //var_dump($_POST);die; 
	session_start();
	//ob_start();
	require_once('../admin/Model/Db.php'); 
	$d = new db;
	
        //$a=  $this->getIDTL($category_id);
        //$row=  mysql_fetch_assoc($a);
        //$idTL=$row['idTL'];
        $congty_id=$_POST['congty_id'];
        $ten_cty_cn =$_POST['ten_cty_cn'];
        $ten_cty_vi = $_POST['ten_cty_vi'];
        $ten_cty_en = $_POST['ten_cty_en'];
        $idquocgia = $_POST['quocgia'];
        $diachi_cn = $_POST['diachi_cn'];
        $diachi_vi = $_POST['diachi_vi'];
        $diachi_en = $_POST['diachi_en'];
        $nguoilienhe = $_POST['nguoilienhe'];
        $arr_skype = json_decode(stripslashes($_POST['skype'])); 
        $qq = $d->processData($_POST['qq']);
        $didong = $_POST['didong']; 
        $dienthoai = $_POST['phone']; 
        $fax = $_POST['fax']; 
        $email = $_POST['email']; 
        $website = $_POST['website'];
        //$url_images = $_POST['url_images']; 
        $mota_cn = $_POST['gioithieu_cn'];
        $mota_vi = $_POST['gioithieu_vi'];
        $mota_en = $_POST['gioithieu_en'];
        $gioithieu_cn = $_POST['gioithieu_cn'];
        $gioithieu_vi = $_POST['gioithieu_vi'];
        $gioithieu_en= $_POST['gioithieu_en'];
         $spchinh=$_POST['spchinh'];
         $arr_cate_id=json_decode(stripslashes($_POST['cate_id']));
         //$data = json_decode(stripslashes($_POST['data']));
        var_dump($arr_skype);
        foreach($arr_skype as $val){
            $skype.= $val.',';
        }
        //$congty_name_alias = $this->changeTitle($ten_cty_vi);

         $sql = "UPDATE congty
                SET TenCT_cn = '$ten_cty_cn',TenCT_vi = '$ten_cty_vi',TenCT_en = '$ten_cty_en',ten_khong_dau='$congty_name_alias',NguoiLienHe='$nguoilienhe',Skype='$skype',QQ='$qq',idQuocGia='$idquocgia',DiaChi_cn = '$diachi_cn',DiaChi_vi = '$diachi_vi',DiaChi_en = '$diachi_en',DiDong='$didong',DienThoai = '$dienthoai',Fax = '$fax',Email = '$email',Website = '$website',MoTa_cn = '$mota_cn',MoTa_vi = '$mota_vi',MoTa_en = '$mota_en',GioiThieu_cn = '$gioithieu_cn',GioiThieu_vi = '$gioithieu_vi',GioiThieu_en = '$gioithieu_en',cate_id = '$category_id',SanPhamChinh_vi='$spchinh',SanPhamChinh_cn='$spchinh',SanPhamChinh_en='$spchinh'
                WHERE congty_id = $congty_id ";
        mysql_query($sql) or die(mysql_error() . $sql);
        
        $sql1 = "DELETE FROM cty_cate WHERE congty_id = $congty_id ";
        mysql_query($sql1) or die(mysql_error() . $sql1);
        
        foreach ($arr_cate_id as $cateid) {
           // var_dump($cateid);
                //echo "adsasd";die;
                $sql2="SELECT idTL from category WHERE cate_id=$cateid"; 
                $row=  mysql_query($sql2);
                $row_tl=  mysql_fetch_assoc($row);
                $idTL=$row_tl['idTL'];
               $sql3="INSERT INTO cty_cate VALUES('',$congty_id,$cateid,'$idTL')";
                mysql_query($sql3) or die(mysql_error() . $sql3);                               
            }           
      
?>