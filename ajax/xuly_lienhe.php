<?php 
session_start();
require_once('../admin/Model/Db.php'); 
$d = new db;

$tieude=$d->processData($_POST['tieude']);
$email=$d->processData($_POST['email']);
$tencty = $d->processData($_POST['tencty']);
$address = $d->processData($_POST['address']);
$phone = $d->processData($_POST['phone']);
$fax= $d->processData($_POST['fax']);
$noidung = $d->processData($_POST['noidung']);
$lang=$d->processData($_POST['lang']);

$nguoilienhe= $d->processData($_POST['nguoilienhe']);
/*
if($d->checkEmailExist($email)==false){
	$d -> insertCustomer($dien_thoai,$dia_chi,$ho_ten);
	$idKH = mysql_insert_id();
	$idDH = $d->insertDonHang($idKH);	
}else{
	$idKH = $d->getIDKH($email);
	$d->updateInfoCustomer($idKH,$email);
	$idDH = $d->insertDonHang($idKH);
}*/
        //$d -> insertCongTy($tencty,$nguoidaidien,$address,$phone,$fax,$website,$email);
	//$congty_id = mysql_insert_id();
	//$user = $d->insertUser($congty_id,$user,$email,$pass);  
        //$id_user = mysql_insert_id();
        
        //$get_user=$d->getUser($id_user);
        //$row=  mysql_fetch_assoc($get_user);
        $emailnhan='asiatiger.org2015@gmail.com';
        //$emailnhan = "emailkhachmoidangky@gmail.com";
        if($lang=='vi'){
            $tieudethu="$tieude";       
            $noidungthu = 'Thư được gửi từ: <strong>'.$nguoilienhe.'</trong> <br/>'
                    .'<span><strong>Tên công ty:</strong> '.$tencty.'</span><br/>'
                    .'<span><strong>Email:</strong> '.$email.'</span><br/>'
                    .'<span><strong>Địa chỉ:</strong> '.$address.'</span><br/>'
                    .'<span><strong>Điện thoại:</strong> '.$phone.'</span><br/>'
                    .'<span><strong>Fax:</strong> '.$fax.'</span><br/>'
                    . 'Với nội dung như sau : <strong>'.$noidung.'</strong> '; 
          
            $d->smtpmailer($emailnhan, "asiatiger.org2015@gmail.com", 'ADMIN VINH SANG',$tieudethu,$noidungthu);
        }elseif ($lang=='cn') {
            $tieudethu="$tieude";       
            $noidungthu = '郵件寄自: <strong>'.$nguoilienhe.'</trong> <br/>'
                    .'<span><strong>公司名稱: </strong> '.$tencty.'</span><br/>'
                    .'<span><strong>電 子 郵 件: </strong> '.$email.'</span><br/>'
                    .'<span><strong>地 址:</strong> '.$address.'</span><br/>'
                    .'<span><strong>電 話:</strong> '.$phone.'</span><br/>'
                    .'<span><strong>傳 真:</strong> '.$fax.'</span><br/>'
                    . '有了這樣的內容 : <strong>'.$noidung.'</strong> ';         
            $d->smtpmailer($emailnhan, "asiatiger.org2015@gmail.com", 'ADMIN VINH SANG',$tieudethu,$noidungthu);
        }  else {
            $tieudethu="$tieude";       
            $noidungthu = 'Mail sent from: <strong>'.$nguoilienhe.'</trong> <br/>'
                    .'<span><strong>Name company:</strong> '.$tencty.'</span><br/>'
                    .'<span><strong>Email:</strong> '.$email.'</span><br/>'
                    .'<span><strong>Address:</strong> '.$address.'</span><br/>'
                    .'<span><strong>Tel:</strong> '.$phone.'</span><br/>'
                    .'<span><strong>Fax:</strong> '.$fax.'</span><br/>'
                    . 'With content : <strong>'.$noidung.'</strong> ';
            $d->smtpmailer($emailnhan, "asiatiger.org2015@gmail.com", 'ADMIN VINH SANG',$tieudethu,$noidungthu);
        }

?>