<?php 


session_start();
require_once('../admin/Model/Db.php'); 
$d = new db;


$ho_ten = $d->processData($_POST['ho_ten']);
$dia_chi = $d->processData($_POST['dia_chi']);
$dien_thoai = $d->processData($_POST['dien_thoai']);
$email = $d->processData($_POST['email']);
$httt = $d->processData($_POST['httt']);
$lang=$d->processData($_POST['lang']);
$pass= $d->processData($_POST['pass']);
$ttphaitra = $d ->processData($_POST['ttphaitra']);

$Ten_httt=$d->GetHinhThucThanhToan($httt);
$row_httt=mysql_fetch_assoc($Ten_httt);
$_SESSION['HinhThucThanhToan']=$row_httt['Ten_HTTT_'.$lang];

if($d->checkEmailExist($email)==false){
	 $d -> insertCustomer($dien_thoai,$dia_chi,$ho_ten,$email,$pass);
	$idKH = mysql_insert_id();
	$_SESSION['idKhachHang']=$idKH;
	$idDH = $d->insertDonHang($idKH,$httt,$ttphaitra); 
	$_SESSION['idDonHang']=$idDH;
	//echo $idDH;
	if($idDH){
		while( key($_SESSION['daySoLuong'])!= null){
			$product_id=key($_SESSION['daySoLuong']);	
			$soluong=current($_SESSION['daySoLuong']);		
			$tiensp = $_SESSION['tien_sp'][$product_id];				
			$idDonHang=$_SESSION['idDH'];				
			$d->insertDonHangChiTiet($idDH,$product_id,$soluong,$tiensp);		
		
			
			next($_SESSION['daySoLuong']);
							
		}
		
		/* goi mail */
    if($lang=='vi' || $lang=='en'){
        $tieudethu="JapanCity Beauty: Thông tin đơn hàng";
        $noidungthu = '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#dcf0f8" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
        <tbody>
            <tr>
                <td align="center" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">


                    <table border="0" cellpadding="0" cellspacing="0" width="600" style="margin-top:15px">
                        <tbody>

                            

                            <tr>
                                <td align="center" valign="bottom">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>

                                                <td valign="top" bgcolor="#FFFFFF" width="100%" style="padding:0">
                                                    <div style="color:#fff;font-size:11px">Mã đơn hàng '.$idDH.' . </div>
                                                    <a style="border:medium none;text-decoration:none;color:#007ed3" href="#" target="_blank">
                                                        <img alt="JapanCity Beauty" src="http://asiatiger.org/img/banner-mail.jpg" style="border:none;outline:none;text-decoration:none;display:inline;min-height:auto" class="CToWUd">
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </td>
                            </tr>




                            <tr style="background:#fff">
                                <td align="left" width="600" height="auto" style="padding:15px">
                                    <table>
                                        <tbody>
                                            <tr>

                                                <td>
                                                    <h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Cảm ơn '.$ho_ten.' đã đặt hàng tại JapanCity Beauty,</h1>
                                                    <p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                                                        Đơn hàng của quý khách đã được tiếp nhận và đang trong quá trình xử lý.
                                                    </p>
                                                    <h3 style="font-size:13px;font-weight:bold;color:#444;text-transform:uppercase;margin:20px 0 0 0">Thông tin đơn hàng "'.$idDH.'" <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">'.date("d-m-Y h:i:sa", $row_donhang['ngaymua']).'</span> </h3>

                                                    <div>



                                                    </div>



                                                </td>


                                            </tr>

                                            <tr>
                                                <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">

                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th align="left" width="50%" bgcolor="#ed217c" style="padding:6px 9px 6px 9px;line-height:14px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#fff;text-transform:uppercase;font-weight:bold;border-right:1px solid #e5e5e5">Thông tin thanh toán</th>
                                                                <th align="left" width="50%" bgcolor="#ed217c" style="padding:6px 9px 6px 9px;line-height:14px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#fff;text-transform:uppercase;font-weight:bold">Địa chỉ giao hàng</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <tr>
                                                                <td valign="top" style="padding:7px 9px 9px 9px;border:1px solid #e5e5e5;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:23px;font-weight:normal">

                                                                    <span style="text-transform:capitalize">'.$ho_ten.'</span>
                                                                    <br>

                                                                    <a href="mailto:'.$email.'" target="_blank">'.$email.'</a>
                                                                    <br> '.$dien_thoai.'

                                                                </td>

                                                                <td valign="top" style="padding:7px 9px 9px 9px;border:1px solid #e5e5e5;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:23px;font-weight:normal">
                                                                    '.$ho_ten.'
                                                                    <br> '.$dia_chi.'
                                                                    
                                                                    <br> '.$dien_thoai.'
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td valign="top" style="padding:7px 9px 0px 9px;border:1px solid #e5e5e5;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" colspan="2">
                                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Thời gian giao hàng dự kiến: </strong><strong>2 - 3</strong> ngày làm việc, không kể Thứ 7 &amp; Chủ Nhật</p>
                                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Phí vận chuyển: </strong>0đ (Miễn phí)</p>

                                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Phương thức thanh toán: </strong>'.$_SESSION['HinhThucThanhToan'].'</p>





                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px">CHI TIẾT ĐƠN HÀNG</h2>
                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%" style="background:#f5f5f5">
                                                        <thead>
                                                            <tr>
                                                                <th align="left" bgcolor="#ed217c" style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Sản phẩm</th>
                                                                <th align="left" bgcolor="#ed217c" style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px"></th>
                                                                <th align="left" bgcolor="#ed217c" style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px"> Đơn giá</th>
                                                                <th align="left" bgcolor="#ed217c" style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Số lượng</th>
                                                                
                                                                <th align="right" bgcolor="#ed217c" style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Tổng tạm</th>
                                                            </tr>
                                                        </thead>';
                                                            reset( $_SESSION['daySoLuong'] );  
                                                            reset( $_SESSION['dayMaSP'] );  
                                                            reset( $_SESSION['dayDonGia'] );  
                                                            reset( $_SESSION['dayUrlHinh'] );
                                                            reset( $_SESSION['dayHinh'] );
                                                            
                                                            
                                                            if (isset($_SESSION['daySoLuong']))
                                                             while( key($_SESSION['daySoLuong'])!= null){
                                                                $idSP=key($_SESSION['daySoLuong']);
                                                                $tensp = $d->getNameProduct($idSP);
                                                                $row_tensp=mysql_fetch_assoc($tensp);
                                                                $tensp_vi=$row_tensp['product_name_vi'];
                                                                $mota=current($_SESSION['dayMaSP']);
                                                                $soluong=current($_SESSION['daySoLuong']);
                                                                $dongia=current($_SESSION['dayDonGia']);
                                                                $urlhinh=current($_SESSION['dayUrlHinh']);                                                      
                                                                
                                                                if($soluong>0){ 

                                                       $noidungthu.=' <tbody bgcolor="#eee" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                                            <tr>
                                                                <td align="left" valign="top" style="padding:3px 9px">
                                                                    <strong>'.$tensp_vi.'</strong>
                                                                    
                                                                </td>
                                                                <td></td>
                                                                <td align="left" valign="top" style="padding:3px 9px"><span>'.number_format($dongia).',000 đ'.'</span>
                                                                </td>
                                                                <td align="left" valign="top" style="padding:3px 9px">'.$soluong.'</td>
                                                               
                                                                <td align="right" valign="top" style="padding:3px 9px">
                                                                    <span>'.number_format($dongia * $soluong).',000 đ'.'</span>



                                                                </td>
                                                            </tr>
                                                            
                                                        </tbody>';
                                                        } 
                                                            next($_SESSION['daySoLuong']);
                                                            next($_SESSION['dayDonGia']);
                                                            next($_SESSION['dayMaSP']); 
                                                            next($_SESSION['dayUrlHinh']);
                                                            next($_SESSION['dayHinh']); 
                                                                            
                                                         } 

                                                        $noidungthu.='<tfoot style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                                            <tr>
                                                                <td valign="top" style="padding:7px 9px 0px 9px;border:1px solid #e5e5e5;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" colspan="5">
                                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Chiết khấu hiện tại: </strong><strong> 0 %</strong>. </p>                                                                    

                                                                </td>
                                                            </tr>
                                                            <tr bgcolor="#eee">
                                                                <td colspan="4" align="right" style="padding:7px 9px"><strong><big>Tổng giá trị đơn hàng</big></strong>
                                                                </td>
                                                                <td align="right" style="padding:7px 9px"><strong><big><span>'.number_format($_SESSION['tong_tien']).',000 đ'.'</span></big></strong>
                                                                </td>
                                                            </tr>

                                                        </tfoot>

                                                    </table>



                                                    <br>





                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                                    <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px">THÔNG TIN TÀI KHOẢN</h2>
                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                        
                                                        <tbody>                                                            

                                                            <tr>
                                                                <td valign="top" style="padding:7px 9px 0px 9px;border:1px solid #e5e5e5;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" colspan="2">
                                                                    <p> </p>
                                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Qúy khách đã trở thành thành viên của chúng tôi ! <br><strong>Mật khẩu của bạn là: '.$pass.'</strong> (chú ý chữ thường và chữ in hoa) , xin vui lòng thay đổi mật khẩu sau khi đăng nhập , để tránh trường hợp bị người khác đánh cắp mật khẩu. <br> <a href="http://www.asiatiger.org/MyPham/dang-nhap.html"> Nhấn vào đây để đăng nhập !</a> </p>
                                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Cấp bậc thành viên: </strong>
                                                                        <br> <strong>A.   Hôi viên Diamond :</strong> <br>
                                                                        <span style="margin-left:30px;">  - Số tiền mua sắm đạt 10 triệu cho 1 đơn hàng. </span><br>
                                                                        <span style="margin-left:30px;">  - Hoặc tích lũy tiền hàng đến 30 triệu. </span><br>
                                                                        <span style="margin-left:30px;">  - Hoặc giới thiệu đủ 50 hội viên có cấp bật BEAUTY trở lên. </span> 
                                                                       
                                                                        <br><br> <strong>B.   Hôi viên Ruby : </strong> <br>
                                                                        <span style="margin-left:30px;">  - Số tiền mua sắm đạt 5 triệu cho 1 đơn hàng. </span><br>
                                                                        <span style="margin-left:30px;">  - Hoặc tích lũy tiền hàng đến 10 triệu. </span><br>
                                                                        <span style="margin-left:30px;">  - Hoặc giới thiệu đủ 30 hội viên có cấp bật BEAUTY trở lên. </span>

                                                                        <br><br> <strong>C.   Hôi viên Sapphire :</strong>  <br>
                                                                        <span style="margin-left:30px;">  - Số tiền mua sắm đạt 3 triệu cho 1 đơn hàng. </span><br>
                                                                        <span style="margin-left:30px;">  - Hoặc tích lũy tiền hàng đến 6 triệu. </span><br>
                                                                        <span style="margin-left:30px;">  - Hoặc giới thiệu đủ 10 hội viên có cấp bật BEAUTY trở lên. </span>
                                                                        
                                                                        <br><br> <strong>D.   Hôi viên Beauty : </strong>  <br>
                                                                        <span style="margin-left:30px;">
                                                                            - Mua gối quà Beauty hoặc Số tiền mua sắm đạt 500 nghìn cho 1 đơn hàng.                                                                              
                                                                        </span>
                                                                    </p>
                                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Ưu Đãi Chiết Khấu Khi Mua Hàng : </strong>
                                                                       <br> A. Hôi viên Diamond Chiết Khấu 40%.  
                                                                       <br> B. Hôi viên Ruby Chiết Khấu 30%. 
                                                                       <br> C. Hôi viên Sapphire Chiết Khấu 20%.
                                                                       <br> D. Hôi viên Beauty Chiết Khấu 10%
                                                                       <br> E. Hội Viên Thông Thường Không Chiết Khấu.
                                                                    </p>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <br>
                                                    
                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px #14ade5 dashed;padding:5px;list-style-type:none">
                                                        Để được hỗ trợ trực tiếp, xin liên hệ JapanCity Beauty qua số điện thoại <strong style="color:#099202">+84 908.338.568</strong> (8-17h từ T2-T7) hoặc Email: <a href="mailto:vienphub01@gmail.com" style="color:#099202;text-decoration:none" target="_blank"><strong>vienphub01@gmail.com</strong></a>
                                                    </p>

                                                    

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <br>
                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">
                                                        Một lần nữa JapanCity Beauty cảm ơn quý khách.
                                                        <br>

                                                    </p>
                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right">

                                                        <strong><a style="color:#00a3dd;text-decoration:none;font-size:14px" href="" target="_blank">JapanCity Beauty</a></strong>
                                                        <br>
                                                        <span>Niềm vui mua sắm</span>
                                                    </p>
                                                </td>
                                            </tr>




                                        </tbody>
                                    </table>
                                </td>
                            </tr>


                        </tbody>

                    </table>


                </td>

            </tr>

            <tr>
                <td align="center">
                    <table width="600">
                        <tbody>
                            <tr>
                                <td>
                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal" align="left">
                                        Quý khách nhận được email này vì đã mua hàng tại JapanCity Beauty.
                                        <br>
                                        <b>Văn phòng JapanCity Beauty:</b> 28-34 Đường 26, Phường 11, Quận 11, Thành phố Hồ Chí Minh, Việt Nam (gần Metro Bình Phú)
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>';
    }elseif ($lang=="cn") {
        $tieudethu="JapanCity Beauty: 訂單資料";
        $noidungthu = '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#dcf0f8" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
        <tbody>
            <tr>
                <td align="center" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">


                    <table border="0" cellpadding="0" cellspacing="0" width="600" style="margin-top:15px">
                        <tbody>

                            

                            <tr>
                                <td align="center" valign="bottom">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>

                                                <td valign="top" bgcolor="#FFFFFF" width="100%" style="padding:0">
                                                    <div style="color:#fff;font-size:11px">Mã đơn hàng '.$idDH.' . </div>
                                                    <a style="border:medium none;text-decoration:none;color:#007ed3" href="#" target="_blank">
                                                        <img alt="JapanCity Beauty" src="http://asiatiger.org/img/banner-mail.jpg" style="border:none;outline:none;text-decoration:none;display:inline;min-height:auto" class="CToWUd">
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </td>
                            </tr>




                            <tr style="background:#fff">
                                <td align="left" width="600" height="auto" style="padding:15px">
                                    <table>
                                        <tbody>
                                            <tr>

                                                <td>
                                                    <h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">感謝 '.$ho_ten.' 巳在JapanCity Beauty訂購產品,</h1>
                                                    <p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                                                        客戶的訂單我們巳收到並在處理中.
                                                    </p>
                                                    <h3 style="font-size:13px;font-weight:bold;color:#444;text-transform:uppercase;margin:20px 0 0 0">訂單資料 "'.$idDH.'" <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">'.date("d-m-Y h:i:sa", $row_donhang['ngaymua']).'</span> </h3>

                                                    <div>



                                                    </div>



                                                </td>


                                            </tr>

                                            <tr>
                                                <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">

                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th align="left" width="50%" bgcolor="#ed217c" style="padding:6px 9px 6px 9px;line-height:14px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#fff;text-transform:uppercase;font-weight:bold;border-right:1px solid #e5e5e5">結帳資料</th>
                                                                <th align="left" width="50%" bgcolor="#ed217c" style="padding:6px 9px 6px 9px;line-height:14px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#fff;text-transform:uppercase;font-weight:bold">運貨地點</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <tr>
                                                                <td valign="top" style="padding:7px 9px 9px 9px;border:1px solid #e5e5e5;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:23px;font-weight:normal">

                                                                    <span style="text-transform:capitalize">'.$ho_ten.'</span>
                                                                    <br>

                                                                    <a href="mailto:'.$email.'" target="_blank">'.$email.'</a>
                                                                    <br> '.$dien_thoai.'

                                                                </td>

                                                                <td valign="top" style="padding:7px 9px 9px 9px;border:1px solid #e5e5e5;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:23px;font-weight:normal">
                                                                    '.$ho_ten.'
                                                                    <br> '.$dia_chi.'
                                                                    
                                                                    <br> '.$dien_thoai.'
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td valign="top" style="padding:7px 9px 0px 9px;border:1px solid #e5e5e5;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" colspan="2">
                                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>預計交貨時間:</strong> 2 ~ 3 天工作, 不算週六&週日</p>
                                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>運輸費 : </strong>免費</p>

                                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>付款方式: </strong>'.$_SESSION['HinhThucThanhToan'].'</p>





                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px">訂單明細</h2>
                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%" style="background:#f5f5f5">
                                                        <thead>
                                                            <tr>
                                                                <th align="left" bgcolor="#ed217c" style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">產品</th>
                                                                <th align="left" bgcolor="#ed217c" style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px"></th>
                                                                <th align="left" bgcolor="#ed217c" style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px"> 單價</th>
                                                                <th align="left" bgcolor="#ed217c" style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">數量</th>
                                                                
                                                                <th align="right" bgcolor="#ed217c" style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">小計</th>
                                                            </tr>
                                                        </thead>';
                                                            reset( $_SESSION['daySoLuong'] );  
                                                            reset( $_SESSION['dayMaSP'] );  
                                                            reset( $_SESSION['dayDonGia'] );  
                                                            reset( $_SESSION['dayUrlHinh'] );
                                                            reset( $_SESSION['dayHinh'] );
                                                            
                                                            
                                                            if (isset($_SESSION['daySoLuong']))
                                                             while( key($_SESSION['daySoLuong'])!= null){
                                                                $idSP=key($_SESSION['daySoLuong']);
                                                                $tensp = $d->getNameProduct($idSP);
                                                                $row_tensp=mysql_fetch_assoc($tensp);
                                                                $tensp_vi=$row_tensp['product_name_vi'];
                                                                $mota=current($_SESSION['dayMaSP']);
                                                                $soluong=current($_SESSION['daySoLuong']);
                                                                $dongia=current($_SESSION['dayDonGia']);
                                                                $urlhinh=current($_SESSION['dayUrlHinh']);                                                      
                                                                
                                                                if($soluong>0){ 

                                                       $noidungthu.=' <tbody bgcolor="#eee" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                                            <tr>
                                                                <td align="left" valign="top" style="padding:3px 9px">
                                                                    <strong>'.$tensp_vi.'</strong>
                                                                    
                                                                </td>
                                                                <td></td>
                                                                <td align="left" valign="top" style="padding:3px 9px"><span>'.number_format($dongia).',000 đ'.'</span>
                                                                </td>
                                                                <td align="left" valign="top" style="padding:3px 9px">'.$soluong.'</td>
                                                               
                                                                <td align="right" valign="top" style="padding:3px 9px">
                                                                    <span>'.number_format($dongia * $soluong).',000 đ'.'</span>



                                                                </td>
                                                            </tr>
                                                            
                                                        </tbody>';
                                                        } 
                                                            next($_SESSION['daySoLuong']);
                                                            next($_SESSION['dayDonGia']);
                                                            next($_SESSION['dayMaSP']); 
                                                            next($_SESSION['dayUrlHinh']);
                                                            next($_SESSION['dayHinh']); 
                                                                            
                                                         } 

                                                        $noidungthu.='<tfoot style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                                            <tr>
                                                                <td valign="top" style="padding:7px 9px 0px 9px;border:1px solid #e5e5e5;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" colspan="5">
                                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>目前折扣: </strong><strong> 0 %</strong>. </p>                                                                   

                                                                </td>
                                                            </tr>
                                                            <tr bgcolor="#eee">
                                                                <td colspan="4" align="right" style="padding:7px 9px"><strong><big>總付款</big></strong>
                                                                </td>
                                                                <td align="right" style="padding:7px 9px"><strong><big><span>'.number_format($_SESSION['tong_tien']).',000 đ'.'</span></big></strong>
                                                                </td>
                                                            </tr>

                                                        </tfoot>

                                                    </table>



                                                    <br>





                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                                    <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px">賬號訊息</h2>
                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                        
                                                        <tbody>                                                            

                                                            <tr>
                                                                <td valign="top" style="padding:7px 9px 0px 9px;border:1px solid #e5e5e5;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" colspan="2">
                                                                    <p> </p>
                                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">您已經是我們的會員 ! <br><strong>您的登錄密碼為: '.$pass.'</strong>  (請用戶注意密碼的大小寫), 煩請立即登錄會員, 並更改密碼, 以免招人盜用 <br/>  <a href="http://www.asiatiger.org/MyPham/dang-nhap.html">按此處來進行登錄 !</a> </p>
                                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>會員等級: </strong>
                                                                        <br> <strong>A.  鑽石會員 :</strong> <br>
                                                                        <span style="margin-left:30px;">  - 單次消費達1000萬. </span><br>
                                                                        <span style="margin-left:30px;">  - 或累積消費3000萬. </span><br>
                                                                        <span style="margin-left:30px;">  - 或累積介紹會員50 人,達beauty 會員或以上. </span> 
                                                                       
                                                                        <br><br> <strong>B.  紅寶會員 : </strong> <br>
                                                                        <span style="margin-left:30px;">  - 單次消費達 500萬. </span><br>
                                                                        <span style="margin-left:30px;">  - 或累積消費1000萬. </span><br>
                                                                        <span style="margin-left:30px;">  - 或累積介紹會員30 人,達beauty會員或以上. </span>

                                                                        <br><br> <strong>C.  藍寶會員 :</strong>  <br>
                                                                        <span style="margin-left:30px;">  - 單次消費達300萬. </span><br>
                                                                        <span style="margin-left:30px;">  - 或累積消費600萬. </span><br>
                                                                        <span style="margin-left:30px;">  - 或累積介紹會員10 人, 達beauty會員或以上. </span>
                                                                        
                                                                        <br><br> <strong>D.  Beauty會員  : </strong>  <br>
                                                                        <span style="margin-left:30px;">
                                                                            - 購買beauty 禮盒或單次消費達50 萬以上.                                                                              
                                                                        </span>
                                                                    </p>
                                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>購物可享優惠 : </strong>
                                                                       <br> A. 鑽石會員 6 折  
                                                                       <br> B. 紅寶會員 7 折 
                                                                       <br> C. 藍寶會員 8 折
                                                                       <br> D. Beauty 會員 9 折
                                                                       <br> E. 一般會員
                                                                    </p>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <br>
                                                    
                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px #14ade5 dashed;padding:5px;list-style-type:none">
                                                       需要直接援助, 請聯繫, JapanCity Beauty 的熱線 <strong style="color:#099202">+84 908.338.568</strong> (早上08點至下午05點 – 週一至週六) 或  電子郵件: <a href="mailto:vienphub01@gmail.com" style="color:#099202;text-decoration:none" target="_blank"><strong>vienphub01@gmail.com</strong></a>
                                                    </p>

                                                    

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <br>
                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">
                                                       JapanCity Beauty 感謝客戶!
                                                        <br>

                                                    </p>
                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right">

                                                        <strong><a style="color:#00a3dd;text-decoration:none;font-size:14px" href="http://clicks.JapanCity Beauty/track/click/78515/JapanCity Beauty?p=eyJzIjoiUXlCN1UxOGR1X2tWQU9zMER4ejJsU2dabXljIiwidiI6MSwicCI6IntcInVcIjo3ODUxNSxcInZcIjoxLFwidXJsXCI6XCJodHRwOlxcXC9cXFwvdGlraS52bj91dG1fc291cmNlPXRyYW5zYWN0aW9uYWwrZW1haWwmdXRtX21lZGl1bT1lbWFpbCZ1dG1fdGVybT1sb2dvJnV0bV9jYW1wYWlnbj1uZXcrb3JkZXJcIixcImlkXCI6XCI2NGQ5NjQ1MTYxMTY0ZDc4YWE3Yzg0MTU4NDI5MDMwNlwiLFwidXJsX2lkc1wiOltcImQzMzE1ODY1OTFkZDJlZDAzNGE0M2JmNDQ1MDY4YTQwYTkyNDkzYjZcIl19In0" target="_blank">JapanCity Beauty</a></strong>
                                                        <br>
                                                        <span>購物樂趣</span>
                                                    </p>
                                                </td>
                                            </tr>




                                        </tbody>
                                    </table>
                                </td>
                            </tr>


                        </tbody>

                    </table>


                </td>

            </tr>

            <tr>
                <td align="center">
                    <table width="600">
                        <tbody>
                            <tr>
                                <td>
                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal" align="left">
                                        您收到此電子郵件,因為您有購買貨物在JapanCity Beauty 網站。
                                        <br>
                                        <b>JapanCity Beauty 文房:</b> 胡志明市第11郡第11坊第26號路28-34號
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>';
    }    
	
  
   	
		          
	
	$d->smtpmailer($email, 'phuong.ltweb@gmail.com', 'JapanCity Beauty',$tieudethu,$noidungthu);
	$d->smtpmailer('phuong.ltweb@gmail.com', 'phuong.ltweb@gmail.com', 'JapanCity Beauty',$tieudethu,$noidungthu);	

		//session_destroy();
	}	
}else{
	$idKH = $d->getIDKH($email);
	$_SESSION['idKhachHang']=$idKH;
	$khach_hang=$d-> GetInfoCustomer($idKH);
	$row_kh=mysql_fetch_assoc($khach_hang);

	$tongtiendamua=$row_kh['tongtien'];
    $ngay_sinh=$row_kh['ngaysinh'];
    $time = strtotime('now');  
	$d->updateInfoCustomerChuaThanhToan($idKH,$email,$dien_thoai,$dia_chi,$ho_ten,$ngay_sinh,$time);
	$idDH = $d->insertDonHang($idKH,$httt);
	$_SESSION['idDonHang']=$idDH;
	if($idDH){

		while( key($_SESSION['daySoLuong'])!= null){
			$product_id=key($_SESSION['daySoLuong']);	
			$soluong=current($_SESSION['daySoLuong']);		
			$tiensp = $_SESSION['tien_sp'][$product_id];	
			$idDonHang=$_SESSION['idDH'];			
							
			$d->insertDonHangChiTiet($idDH,$product_id,$soluong,$tiensp);		
		
			
			next($_SESSION['daySoLuong']);
							
		}
		/* goi mail */
	$tieudethu="JapanCity Beauty: Thông tin đơn hàng";
	$noidungthu = '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#dcf0f8" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
    <tbody>
        <tr>
            <td align="center" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">


                <table border="0" cellpadding="0" cellspacing="0" width="600" style="margin-top:15px">
                    <tbody>

                        

                        <tr>
                            <td align="center" valign="bottom">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>

                                            <td valign="top" bgcolor="#FFFFFF" width="100%" style="padding:0">
                                                <div style="color:#fff;font-size:11px">Mã đơn hàng '.$idDH.' . </div>
                                                <a style="border:medium none;text-decoration:none;color:#007ed3" href="#" target="_blank">
                                                    <img alt="JapanCity Beauty" src="http://asiatiger.org/img/banner-mail.jpg" style="border:none;outline:none;text-decoration:none;display:inline;min-height:auto" class="CToWUd">
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </td>
                        </tr>




                        <tr style="background:#fff">
                            <td align="left" width="600" height="auto" style="padding:15px">
                                <table>
                                    <tbody>
                                        <tr>

                                            <td>
                                                <h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Cảm ơn '.$ho_ten.' đã đặt hàng tại JapanCity Beauty,</h1>
                                                <p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                                                    Đơn hàng của quý khách đã được tiếp nhận và đang trong quá trình xử lý.
                                                </p>
                                                <h3 style="font-size:13px;font-weight:bold;color:#444;text-transform:uppercase;margin:20px 0 0 0">Thông tin đơn hàng "'.$idDH.'" <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">'.date("d-m-Y h:i:sa", $row_donhang['ngaymua']).'</span> </h3>

                                                <div>



                                                </div>



                                            </td>


                                        </tr>

                                        <tr>
                                            <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">

                                                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th align="left" width="50%" bgcolor="#ed217c" style="padding:6px 9px 6px 9px;line-height:14px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#fff;text-transform:uppercase;font-weight:bold;border-right:1px solid #e5e5e5">Thông tin thanh toán</th>
                                                            <th align="left" width="50%" bgcolor="#ed217c" style="padding:6px 9px 6px 9px;line-height:14px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#fff;text-transform:uppercase;font-weight:bold">Địa chỉ giao hàng</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>
                                                            <td valign="top" style="padding:7px 9px 9px 9px;border:1px solid #e5e5e5;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:23px;font-weight:normal">

                                                                <span style="text-transform:capitalize">'.$ho_ten.'</span>
                                                                <br>

                                                                <a href="mailto:'.$email.'" target="_blank">'.$email.'</a>
                                                                <br> '.$dien_thoai.'

                                                            </td>

                                                            <td valign="top" style="padding:7px 9px 9px 9px;border:1px solid #e5e5e5;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:23px;font-weight:normal">
                                                                '.$ho_ten.'
                                                                <br> '.$dia_chi.'
                                                                
                                                                <br> '.$dien_thoai.'
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td valign="top" style="padding:7px 9px 0px 9px;border:1px solid #e5e5e5;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" colspan="2">
                                                                <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Thời gian giao hàng dự kiến: </strong><strong>2 - 3</strong> ngày làm việc, không kể Thứ 7 &amp; Chủ Nhật</p>
                                                                <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Phí vận chuyển: </strong>0đ (Miễn phí)</p>

                                                                <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Phương thức thanh toán: </strong>'.$_SESSION['HinhThucThanhToan'].'</p>





                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px">CHI TIẾT ĐƠN HÀNG</h2>
                                                <table cellspacing="0" cellpadding="0" border="0" width="100%" style="background:#f5f5f5">
                                                    <thead>
                                                        <tr>
                                                            <th align="left" bgcolor="#ed217c" style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Sản phẩm</th>
                                                            <th align="left" bgcolor="#ed217c" style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px"></th>
                                                            <th align="left" bgcolor="#ed217c" style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px"> Đơn giá</th>
                                                            <th align="left" bgcolor="#ed217c" style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Số lượng</th>
                                                            
                                                            <th align="right" bgcolor="#ed217c" style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Tổng tạm</th>
                                                        </tr>
                                                    </thead>';
                                                    	reset( $_SESSION['daySoLuong'] );  
														reset( $_SESSION['dayMaSP'] );	
														reset( $_SESSION['dayDonGia'] );  
														reset( $_SESSION['dayUrlHinh'] );
														reset( $_SESSION['dayHinh'] );
														
														
														if (isset($_SESSION['daySoLuong']))
														 while( key($_SESSION['daySoLuong'])!= null){
															$idSP=key($_SESSION['daySoLuong']);
															$tensp = $d->getNameProduct($idSP);
															$row_tensp=mysql_fetch_assoc($tensp);
															$tensp_vi=$row_tensp['product_name_vi'];
															$mota=current($_SESSION['dayMaSP']);
															$soluong=current($_SESSION['daySoLuong']);
															$dongia=current($_SESSION['dayDonGia']);
															$urlhinh=current($_SESSION['dayUrlHinh']);														
															
															if($soluong>0){	

                                                   $noidungthu.=' <tbody bgcolor="#eee" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                                        <tr>
                                                            <td align="left" valign="top" style="padding:3px 9px">
                                                                <strong>'.$tensp_vi.'</strong>
                                                                
                                                            </td>
															<td></td>
                                                            <td align="left" valign="top" style="padding:3px 9px"><span>'.number_format($dongia).',000 đ'.'</span>
                                                            </td>
                                                            <td align="left" valign="top" style="padding:3px 9px">'.$soluong.'</td>
                                                           
                                                            <td align="right" valign="top" style="padding:3px 9px">
                                                                <span>'.number_format($dongia * $soluong).',000 đ'.'</span>



                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top" style="padding:7px 9px 0px 9px;border:1px solid #e5e5e5;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" colspan="5">
                                                                <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Chiết khấu hiện tại: </strong><strong>';
                                                               if($tongtiendamua < 500){
													$noidungthu.='			 0 %  ';
				                                                }elseif ($tongtiendamua >= 500 && $tongtiendamua < 3000) {
				                                    $noidungthu.='			 10 %  ';            	
				                                                }elseif ($tongtiendamua < 5000) {
				                                    $noidungthu.='			 30 %  ';            	
				                                                }elseif ($tongtiendamua < 10000) {
				                                    $noidungthu.='			 40 %  ';            	
				                                                }else {
				                                    $noidungthu.='			 50 %  ';            	
				                                                }
                                                    $noidungthu.=' </strong>. </p>
                                                                
																<p>Tổng số tiền tích luỹ mua hàng : '. number_format($tongtiendamua).',000 đ; </p>
                                                                <p>Cấp độ thành viên hiện tại :';
                                                                if($tongtiendamua < 500){
                                                    $noidungthu.='          <strong> Thành viên mới đăng ký </strong> ';
                                                                }elseif ($tongtiendamua >= 500 && $tongtiendamua < 3000) {
                                                    $noidungthu.='           <strong>Thành viên Beauty </strong>';               
                                                                }elseif ($tongtiendamua < 5000) {
                                                    $noidungthu.='          <strong>Thành viên Sophia</strong>  ';               
                                                                }elseif ($tongtiendamua < 10000) {
                                                    $noidungthu.='          <strong> Thành viên Rubi </strong>';               
                                                                }else {
                                                    $noidungthu.='           <strong>Thành viên Kim cương </strong>';               
                                                                }
                                                    $noidungthu.=' 
                                                                  </p>
										                        <p>';

										                        if($tongtiendamua < 500){
										            $noidungthu.=' Bạn cần mua thêm <strong>'.number_format(500-$tongtiendamua).',000 đ</strong> đễ được giãm 10% và trở thành thành viên <strong> Beauty </strong>'; 
										                        }elseif ($tongtiendamua < 3000) {
										            $noidungthu.=' Bạn cần mua thêm <strong>'.number_format(3000-$tongtiendamua).',000 đ</strong> đễ được giãm 30% và trở thành thành viên <strong> Sophia </strong>'; 
										                        } elseif ($tongtiendamua < 5000) {
										            $noidungthu.=' Bạn cần mua thêm <strong>'.number_format(5000-$tongtiendamua).',000 đ</strong> đễ được giãm 40% và trở thành thành viên <strong> Rubi </strong>'; 
										                        }elseif ($tongtiendamua < 10000) {
										            $noidungthu.=' Bạn cần mua thêm <strong>'.number_format(10000-$tongtiendamua).',000 đ</strong> đễ được giãm 50% và trở thành thành viên <strong> Kim cương </strong>'; 
										                        } 
										             $noidungthu.='</p>
                                                                

                                                            </td>
                                                        </tr>
                                                    </tbody>';
                                                    } 
														next($_SESSION['daySoLuong']);
														next($_SESSION['dayDonGia']);
														next($_SESSION['dayMaSP']);	
														next($_SESSION['dayUrlHinh']);
														next($_SESSION['dayHinh']);	
																		
													 } 

                                                    $noidungthu.='<tfoot style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                                        
                                                        <tr bgcolor="#eee">
                                                            <td colspan="4" align="right" style="padding:7px 9px"><strong><big>Tổng giá trị đơn hàng</big></strong>
                                                            </td>
                                                            <td align="right" style="padding:7px 9px"><strong><big><span>';
                                                            	if($tongtiendamua < 500){
				                                    $noidungthu.=''.number_format($_SESSION['tong_tien']).',000 đ'; 
				                                                }elseif ($tongtiendamua < 3000) {
				                                    $noidungthu.=''. number_format($_SESSION['tong_tien']-(($_SESSION['tong_tien'] * 10)/100)).',000 đ';
				                                                } elseif ($tongtiendamua < 5000) {
				                                    $noidungthu.=''. number_format($_SESSION['tong_tien']-(($_SESSION['tong_tien'] * 30)/100)).',000 đ';
				                                                }elseif ($tongtiendamua < 10000) {
				                                    $noidungthu.=''. number_format($_SESSION['tong_tien']-(($_SESSION['tong_tien'] * 40)/100)).',000 đ';
				                                                }else{
				                                    $noidungthu.=''. number_format($_SESSION['tong_tien']-(($_SESSION['tong_tien'] * 50)/100)).',000 đ';
				                                                }
                                                     $noidungthu.='</span></big></strong>
                                                            </td>
                                                        </tr>

                                                    </tfoot>

                                                </table>



                                                <br>





                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <br>
                                                
                                                <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px #14ade5 dashed;padding:5px;list-style-type:none">
                                                	Để được hỗ trợ trực tiếp, xin liên hệ JapanCity Beauty qua số điện thoại <strong style="color:#099202">+84 908.338.568</strong> (8-17h từ T2-T7) hoặc Email: <a href="mailto:vienphub01@gmail.com" style="color:#099202;text-decoration:none" target="_blank"><strong>vienphub01@gmail.com</strong></a>
                                                </p>

                                                

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <br>
                                                <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">
                                                    Một lần nữa JapanCity Beauty cảm ơn quý khách.
                                                    <br>

                                                </p>
                                                <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right">

                                                    <strong><a style="color:#00a3dd;text-decoration:none;font-size:14px" href="http://clicks.JapanCity Beauty/track/click/78515/JapanCity Beauty?p=eyJzIjoiUXlCN1UxOGR1X2tWQU9zMER4ejJsU2dabXljIiwidiI6MSwicCI6IntcInVcIjo3ODUxNSxcInZcIjoxLFwidXJsXCI6XCJodHRwOlxcXC9cXFwvdGlraS52bj91dG1fc291cmNlPXRyYW5zYWN0aW9uYWwrZW1haWwmdXRtX21lZGl1bT1lbWFpbCZ1dG1fdGVybT1sb2dvJnV0bV9jYW1wYWlnbj1uZXcrb3JkZXJcIixcImlkXCI6XCI2NGQ5NjQ1MTYxMTY0ZDc4YWE3Yzg0MTU4NDI5MDMwNlwiLFwidXJsX2lkc1wiOltcImQzMzE1ODY1OTFkZDJlZDAzNGE0M2JmNDQ1MDY4YTQwYTkyNDkzYjZcIl19In0" target="_blank">JapanCity Beauty</a></strong>
                                                    <br>
                                                    <span>Niềm vui mua sắm</span>
                                                </p>
                                            </td>
                                        </tr>




                                    </tbody>
                                </table>
                            </td>
                        </tr>


                    </tbody>

                </table>


            </td>

        </tr>

        <tr>
            <td align="center">
                <table width="600">
                    <tbody>
                        <tr>
                            <td>
                                <p style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal" align="left">
                                    Quý khách nhận được email này vì đã mua hàng tại JapanCity Beauty.
                                    <br>
                                    <b>Văn phòng JapanCity Beauty:</b> 28-34 Đường 26, Phường 11, Quận 11, Thành phố Hồ Chí Minh, Việt Nam (gần Metro Bình Phú)
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>';
  
   	
		          
	
	$d->smtpmailer($email, 'phuong.ltweb@gmail.com', 'JapanCity Beauty',$tieudethu,$noidungthu);
	$d->smtpmailer('phuong.ltweb@gmail.com', 'phuong.ltweb@gmail.com', 'JapanCity Beauty',$tieudethu,$noidungthu);	

		
		//session_destroy();
	}
}
?>