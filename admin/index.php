<?php
require_once "lib/defined.php";
?>

<?php
if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}
session_start();
$lang_arr=array("vi","cn");
    if (isset($_GET['lang']) == true){
      if (in_array($_GET['lang'], $lang_arr)==true) $lang = $_GET['lang'];
    }
    elseif (isset($_SESSION['lang']) == true){ 
     if (in_array($_SESSION['lang'],$lang_arr) == true) $lang = $_SESSION['lang'];
    }else $lang= 'vi';
     $_SESSION['lang'] = $lang;
    setcookie('lang' , $lang , time()+60*60*24*30);
    ob_start();
       //echo $lang; die;
include "lang/lang_$lang.php";
require_once "checkLogin.php";
require_once("Model/Menu.php");
require_once("Model/Cate.php");
require_once("Model/QuocGia.php");
require_once("Model/Block.php");
require_once("Model/Article.php");
require_once("Model/Product.php");
require_once("Model/Home.php");
require_once("Model/DonHang.php");
require_once("Model/Congty.php");
require_once("lib/class.user.php");
require_once("Model/CsvHelper.php");
require_once("Model/goodby/csv/vendor/autoload.php");

$modelMenu = new Menu;
$modelArticle = new Article;
$modelBlock = new Block;
$modelProduct = new Product;
$modelHome = new Home;
$modelCate = new Cate;
$modelQuocgia = new Quocgia;
$modelDonHang = new DonHang;
$modelCongTy = new Congty;
$modelUser = new user;
$modelCsvHelper = new \utilities\CsvHelper;

$com = (isset($_GET['com'])) ? $_GET['com'] : "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        
        <base href="http://www.asiatiger.org/admin/" />
        <title></title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <!-- stylesheets -->
        <link rel="stylesheet" type="text/css" href="resources/css/reset.css" />
        <link rel="stylesheet" type="text/css" href="resources/css/style.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="resources/css/style_full.css" />
        <link id="color" rel="stylesheet" type="text/css" href="resources/css/colors/blue.css" />
        <!-- scripts (jquery) -->
        <script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
        <!--[if IE]><script language="javascript" type="text/javascript" src="resources/scripts/excanvas.min.js"></script><![endif]-->
        <script src="resources/scripts/jquery-ui-1.8.custom.min.js" type="text/javascript"></script>

        <script src="resources/scripts/tiny_mce/jquery.tinymce.js" type="text/javascript"></script>
        <!-- scripts (custom) -->
        <!--<script src="resources/scripts/smooth.js" type="text/javascript"></script>
        <script src="resources/scripts/smooth.menu.js" type="text/javascript"></script>
        <script src="resources/scripts/smooth.table.js" type="text/javascript"></script>
        <script src="resources/scripts/smooth.dialog.js" type="text/javascript"></script>
        <script src="resources/scripts/smooth.autocomplete.js" type="text/javascript"></script>-->
        <link rel="stylesheet" type="text/css" href="css/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap-min.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.min.css" />

        <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="ckfinder/ckfinder.js"></script>
        <script src="js/admin.js" type="text/javascript"></script>
        <script src="js/drag.js" type="text/javascript"></script>
        <script type="text/javascript">  
            function chkcontrol(j) {  
                var total=0;
                //var j=0;
                for(var i=0; i < document.thisform.Category.length; i++){
                if(document.thisform.Category[i].checked){  
                total =total +1;}  
                    if(total > 8){  
                    alert("max select 8")       
                    document.thisform.Category[i].checked = false;  
                    return false;
                    }  
                }    
            }  
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                style_path = "resources/css/colors";

                $("#date-picker").datepicker();
                
                $('.TenCate').hide();                
                $('a.TenTL').click(function(){
                    $(this).parent().find('.TenCate').slideToggle();
                    //console.log($(this).children().html());
                 });
                 
                 
                 //------------------------KT Dử liệu thêm công ty------------------------
		$("#btnSave").click(function(){		
				//alert("a");	die;
                        var top=$('input:radio[name=top]:checked').val();
                        var shopvip=$('input:radio[name=shopvip]:checked').val();
                        
                        //alert(top);
			var ten_cty_cn=$("#ten_cty_cn").val();
                        var ten_cty_vi=$("#ten_cty_vi").val();
                        var ten_cty_en=$("#ten_cty_en").val();
            var nha_dau_tu=$("#nha_dau_tu").val();

                        var url_images=$("#url_images").val();
			var diachi_cn=$("#diachi_cn").val();
                        var diachi_vi=$("#diachi_vi").val();
                        var diachi_en=$("#diachi_en").val();
                        var quocgia=$("#quocgia").val();
			var dienthoai=$("#dienthoai").val();                        
                        var fax=$("#fax").val();
                        var email=$("#email").val();
                        var nguoilienhe=$("#nguoilienhe").val();
                        var skype=$("#skype").val();
                        var qq=$("#qq").val();
                        var didong=$("#didong").val();
                        var website=$("#website").val();
                        var spchinh_vi=$("#spchinh_vi").val();  
                        var spchinh_cn=$("#spchinh_cn").val(); 
                        var spchinh_en=$("#spchinh_en").val(); 
                        
                        //var gioithieu_cn=$("textarea #gioithieu_cn").val();
                        var gioithieu_cn = CKEDITOR.instances.gioithieu_cn.getData();
                        var gioithieu_vi = CKEDITOR.instances.gioithieu_vi.getData();
                        var gioithieu_en = CKEDITOR.instances.gioithieu_en.getData();
                        var idTL=$("#idTL").val();
                        var cate_id = [];
                        var  i= 0;
                        $('.Category:checked').each(function(){
                            cate_id[i++] = $(this).val();
                        });
                        console.log(cate_id);
                        //var spchinh=$("#spchinh").val();
                        //alert(cate_id);
                        
			if(ten_cty_vi=="" ||ten_cty_cn=="" || diachi_cn=="" ||diachi_vi=="" || quocgia==""  )
			{		
                                
                                    alert("Bạn chưa nhập đầy đủ thông tin !");
                                
				
				if(ten_cty_vi==""){
					$("#ten_cty_vi").addClass("false");
				}else{
					$("#ten_cty_vi").removeClass("false");
				}
                                if(ten_cty_cn==""){
					$("#ten_cty_cn").addClass("false");
				}else{
					$("#ten_cty_cn").removeClass("false");
				}
				
				if(diachi_cn==""){
					$("#diachi_cn").addClass("false");
				}else{
					$("#diachi_cn").removeClass("false");
				}
				if(quocgia=="0"){
                                    
                                        alert("Bạn chưa chọn quốc gia !");
                                    
				}else{
					$("#quocgia").removeClass("false");
				}
				
				if(diachi_vi==""){
					$("#diachi_vi").addClass("false");
				}else{
					$("#diachi_vi").removeClass("false");
				}
                                
                               
											
				return false;
			}
			else
			{	
                                $("#thongbao").html('<div align="center"><img src="../img/loading.gif" /> Vui lòng đợi trong giây lát !</div>');
                                $.post('ajax/xuly_themcty.php',{top:top,shopvip:shopvip,ten_cty_cn:ten_cty_cn,ten_cty_vi:ten_cty_vi,ten_cty_en:ten_cty_en,nha_dau_tu:nha_dau_tu,url_images:url_images,diachi_cn:diachi_cn,diachi_vi:diachi_vi,diachi_en:diachi_en,quocgia:quocgia,dienthoai:dienthoai,fax:fax,email:email,nguoilienhe:nguoilienhe,skype:skype,qq:qq,didong:didong,website:website,spchinh_vi:spchinh_vi,spchinh_cn:spchinh_cn,spchinh_en:spchinh_en,gioithieu_cn:gioithieu_cn,gioithieu_vi:gioithieu_vi,gioithieu_en:gioithieu_en,cate_id:cate_id,idTL:idTL},function(data){
                                    alert('Xử lý thành công!');
                                   // window.location.reload();
                                   setTimeout(function(){window.location.href='index.php?com=congty_list';},1000);
                                });
				//alert("Chúc mừng bạn đã đã đăng ký thành viên thành công. !!! ");
				//return true;
			}	
		});
                
                
                //------------------------KT Dử liệu sữa công ty------------------------
		$("#btnUpdateCty").click(function(){		
				//alert("a");
                        var congty_id=$("#congty_id").val();
                        var top=$('input:radio[name=top]:checked').val();
                        var shopvip=$('input:radio[name=shopvip]:checked').val();
			var ten_cty_cn=$("#ten_cty_cn").val();
                        var ten_cty_vi=$("#ten_cty_vi").val();
                        var ten_cty_en=$("#ten_cty_en").val();
            var nha_dau_tu=$("#nha_dau_tu").val();
                        var url_images=$("#url_images").val();
			var diachi_cn=$("#diachi_cn").val();
                        var diachi_vi=$("#diachi_vi").val();
                        var diachi_en=$("#diachi_en").val();
                        var quocgia=$("#quocgia").val();
			var dienthoai=$("#dienthoai").val();                        
                        var fax=$("#fax").val();
                        var email=$("#email").val();
                        var nguoilienhe=$("#nguoilienhe").val();
                        var skype=$("#skype").val();
                        var qq=$("#qq").val();
                        var didong=$("#didong").val();
                        var website=$("#website").val();
                        var spchinh_vi=$("#spchinh_vi").val();  
                        var spchinh_cn=$("#spchinh_cn").val(); 
                        var spchinh_en=$("#spchinh_en").val();                        
                        var gioithieu_cn = CKEDITOR.instances.gioithieu_cn.getData();
                        var gioithieu_vi = CKEDITOR.instances.gioithieu_vi.getData();
                        var gioithieu_en = CKEDITOR.instances.gioithieu_en.getData();
                        
                        var idTL=$("#idTL").val();
                        var cate_id = [];
                        var  i= 0;
                        $('.Category:checked').each(function(){
                            cate_id[i++] = $(this).val();
                        });
                        console.log(cate_id);
                        
                         var jsonString = JSON.stringify(cate_id);

			if(ten_cty_vi=="" ||ten_cty_cn=="" || diachi_cn=="" ||diachi_vi=="" || quocgia=="" )
			{		
                                
                                    alert("Bạn chưa nhập đầy đủ thông tin !");
                                
				
				if(ten_cty_vi==""){
					$("#ten_cty_vi").addClass("false");
				}else{
					$("#ten_cty_vi").removeClass("false");
				}
                                if(ten_cty_cn==""){
					$("#ten_cty_cn").addClass("false");
				}else{
					$("#ten_cty_cn").removeClass("false");
				}
				
				if(diachi_cn==""){
					$("#diachi_cn").addClass("false");
				}else{
					$("#diachi_cn").removeClass("false");
				}
				if(quocgia=="0"){
                                    
                                        alert("Bạn chưa chọn quốc gia !");
                                    
				}else{
					$("#quocgia").removeClass("false");
				}
				
				if(diachi_vi==""){
					$("#diachi_vi").addClass("false");
				}else{
					$("#diachi_vi").removeClass("false");
				}	
											
				return false;
			}
			else
			{	
                                $("#thongbao").html('<div align="center"><img src="../img/loading.gif" /> Vui lòng đợi trong giây lát !</div>');
                                $.post('ajax/xuly_updatecty.php',{top:top,shopvip:shopvip,congty_id:congty_id,ten_cty_cn:ten_cty_cn,ten_cty_vi:ten_cty_vi,ten_cty_en:ten_cty_en,nha_dau_tu:nha_dau_tu,url_images:url_images,diachi_cn:diachi_cn,diachi_vi:diachi_vi,diachi_en:diachi_en,quocgia:quocgia,dienthoai:dienthoai,fax:fax,email:email,nguoilienhe:nguoilienhe,skype:skype,qq:qq,didong:didong,website:website,spchinh_vi:spchinh_vi,spchinh_cn:spchinh_cn,spchinh_en:spchinh_en,gioithieu_cn:gioithieu_cn,gioithieu_vi:gioithieu_vi,gioithieu_en:gioithieu_en,cate_id:jsonString,idTL:idTL},function(data){
                                    alert('Update thành công!');
                                    //window.location.reload();
                                   setTimeout(function(){window.location.href='index.php?com=congty_list';},100);		
                                });
				//alert("Chúc mừng bạn đã đã đăng ký thành viên thành công. !!! ");
				//return true;
			}	
		});

                //------------------------KT Dử liệu sua hinh anh ------------------------
                $("#btnUpdateHinh").click(function(){
                    var ten_cty=$("#tencty").val();
                    var url_images=$("#url_images").val();
                    var href=$("#href").val();
                    var id_loai_hinh=$("#idLoaiHinh").val();
                    var show_home=$('input:radio[name=show_home]:checked').val();
                    var id_hinh = $("#id_hinh").val();
                    var cate_id = [];
                    var  i= 0;
                    $('.Category:checked').each(function(){
                        cate_id[i++] = $(this).val();
                    });
                    var jsonString = JSON.stringify(cate_id);

                    if(url_images==""  )
                    {
                        alert("Bạn chưa nhập hình ảnh !");
                        return false;
                    }
                    else
                    {
                        $("#thongbao").html('<div align="center"><img src="../img/loading.gif" /> Vui lòng đợi trong giây lát !</div>');
                        $.post('ajax/xuly_update_hinhanh.php',{ten_cty:ten_cty,url_images:url_images,href:href,cate_id:jsonString,id_loai_hinh:id_loai_hinh,id_hinh:id_hinh,show_home:show_home},function(data){
                            alert('Update thành công!');
                            //window.location.reload();
                            setTimeout(function(){window.location.href='index.php?com=image_list&category_id='+id_loai_hinh;},100);
                        });
                    }
                });

                //------------------------KT Dử liệu them hinh anh------------------------
                $("#btn_save_hinh_anh").click(function(){
                    var ten_cty = $("#tencty").val();
                    var url_images = $("#url_images").val();
                    var href = $("#href").val();
                    var id_loai_hinh = $("#idLoaiHinh").val();
                    var show_home=$('input:radio[name=show_home]:checked').val();
                    var cate_id = [];
                    var  i= 0;
                    $('.Category:checked').each(function(){
                        cate_id[i++] = $(this).val();
                    });
                    var jsonString = JSON.stringify(cate_id);

                    if(url_images == " "  )
                    {
                        alert("Bạn chưa nhập hình ảnh !");
                        return false;
                    }
                    else
                    {
                        $("#thongbao").html('<div align="center"><img src="../img/loading.gif" /> Vui lòng đợi trong giây lát !</div>');
                        $.post('ajax/xuly_them_hinh_anh.php',{ten_cty:ten_cty,url_images:url_images,href:href,cate_id:jsonString,id_loai_hinh:id_loai_hinh,show_home:show_home},function(data){
                            alert('Them hinh anh thành công!');
                            setTimeout(function(){window.location.href='index.php?com=image_list&category_id='+id_loai_hinh;},1000);
                        });
                    }
                });
    });

            $(function() {

                $(".ngay").datepicker({
                    numberOfMonths: 1, dateFormat: 'dd-mm-yy',
                    monthNames: ['Một', 'Hai', 'Ba', 'Tư', 'Năm', 'Sáu', 'Bảy', 'Tám', 'Chín',
                        'Mười', 'Mười một', 'Mười hai'],
                    monthNamesShort: ['Tháng1', 'Tháng2', 'Tháng3', 'Tháng4', 'Tháng5',
                        'Tháng6', 'Tháng7', 'Tháng8', 'Tháng9', 'Tháng10', 'Tháng11', 'Tháng12'],
                    dayNames: ['Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm',
                        'Thứ sáu', 'Thứ bảy'],
                    dayNamesMin: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                    showWeek: true, showOn: 'both',
                    changeMonth: true, changeYear: true,
                    currentText: 'Hôm nay', weekHeader: 'Tuần'

                });

            })
            $("#reset").click(function() {
                $.post('reset.php', {}, function(data) {
                    alert(data);
                })
            })


        </script>
    </head>
    <body>
        <div id="colors-switcher" class="color">
            <a href="" class="blue" title="Blue"></a>
            <a href="" class="green" title="Green"></a>
            <a href="" class="brown" title="Brown"></a>
            <a href="" class="purple" title="Purple"></a>
            <a href="" class="red" title="Red"></a>
            <a href="" class="greyblue" title="GreyBlue"></a>
        </div>
        <!-- header -->
        <div id="header">
            <!-- logo -->
            <div id="logan" style="float: left; margin-right: 20px">
                <a href="" title="Vinh Sang Admin"><img style="margin-top: 20px;" src="../img/logan.png" alt="#"  width="300px" /></a>
            </div>
            <div id="logo" style="float: left">
               <a href="" title="Vinh Sang Admin"><img src="../img/logo.png" alt="#"  width="300px" /></a>
            </div>
            <!-- end logo -->
            <!-- logan -->
            
            <!-- end logan -->
            <!-- user -->
            <ul id="user">
                <li><a href="vi"><img width="50px" src="../img/flag_vi.png"></a></li>
                <li><a href="cn"><img width="50px" src="../img/flag_cn.png"></a></li>
                <li><a href="thoat.php">Logout</a></li>
            </ul>
            <!-- end user -->
            <div id="header-inner">
                <div id="home">
                    <a href="index.php"></a>
                </div>
                <?php include URL_LAYOUT . "menu.php"; ?>
                <!-- end quick -->
                <div class="corner tl"></div>
                <div class="corner tr"></div>
            </div>
        </div>
        <!-- end header -->
        <!-- content -->
        <div id="content">
            <!-- table -->
            <div class="box">
                <div style="clear:both"></div>
                <?php
                $tmpCom = explode('_', $com);
                //echo $com;
                if ($com == "")
                    include "blocks/product/product_list.php";
                else
                    include "blocks/" . $tmpCom[0] . '/' . $com . '.php';
                ?>
            </div>

            <!-- end table -->



        </div>
        <!-- end content -->
        <!-- footer -->
        <div id="footer">
            <p>Copyright &copy; 2000-2010 Your Company. All Rights Reserved.</p>
        </div>
        <!-- end footert -->
        
        <?php
            $str=ob_get_clean();
            $str = str_replace("{sanpham}" , sanpham , $str);
            $str = str_replace("{dssanpham}" , dssanpham , $str);
            $str = str_replace("{themsp}" , themsp , $str);
            /*$str = str_replace("{quanly}" , quanly , $str);*/
            $str = str_replace("{xemds}" , xemds , $str);
            $str = str_replace("{danhmuc}" , danhmuc , $str);
            $str = str_replace("{themdanhmuccha}" , themdanhmuccha , $str);
            $str = str_replace("{themdanhmuccon}" , themdanhmuccon , $str);
            $str = str_replace("{qldanhmuc}" , qldanhmuc , $str);
            $str = str_replace("{xem}" , xem , $str);
            $str = str_replace("{tendailoan}" , tendailoan , $str);
            $str = str_replace("{tenvietnam}" , tenvietnam , $str);
            $str = str_replace("{tentienganh}" , tentienganh , $str);
            
            $str = str_replace("{cty}" , cty , $str);
            $str = str_replace("{themcty}" , themcty , $str);
            $str = str_replace("{dscty}" , dscty , $str);
            $str = str_replace("{gioithieucn}" , gioithieucn , $str);
            $str = str_replace("{gioithieuvi}" , gioithieuvi , $str);
            $str = str_replace("{gioithieuen}" , gioithieuen , $str);
            $str = str_replace("{fax}" , fax , $str);
            $str = str_replace("{website}" , website , $str);
            
            $str = str_replace("{hinhanh}" , hinhanh , $str);
            $str = str_replace("{gia}" , gia , $str);
            $str = str_replace("{gianho}" , gianho , $str);
            $str = str_replace("{gialon}" , gialon , $str);
            $str = str_replace("{mota}" , mota , $str);
            $str = str_replace("{chonhinh}" , chonhinh , $str);
            $str = str_replace("{themmoi}" , themmoi , $str);
            $str = str_replace("{baiviet}" , baiviet , $str);
            $str = str_replace("{tintuc}" , tintuc , $str);
            $str = str_replace("{dsbaiviet}" , dsbaiviet , $str);
            $str = str_replace("{thembaiviet}" , thembaiviet , $str);
            $str = str_replace("{tieudedailoan}" , tieudedailoan , $str);
            $str = str_replace("{tieudevietnam}" , tieudevietnam , $str);
            $str = str_replace("{nddailoan}" , nddailoan , $str);
            $str = str_replace("{ndvietnam}" , ndvietnam , $str);
            $str = str_replace("{ndtienganh}" , ndtienganh , $str);
            $str = str_replace("{motacn}" , motacn , $str);
            $str = str_replace("{motavi}" , motavi , $str);
            $str = str_replace("{motaen}" , motaen , $str);
            $str = str_replace("{duandalam}" , duandalam , $str);
            $str = str_replace("{dsduan}" , dsduan , $str);
            $str = str_replace("{themduan}" , themduan , $str);
            
            $str = str_replace("{dsgiohang}" , dsgiohang , $str);
            $str = str_replace("{giohang}" , giohang , $str);
            $str = str_replace("{stt}" , stt , $str);
            $str = str_replace("{ten}" , ten , $str);
            $str = str_replace("{tensanpham}" , tensanpham , $str);
            $str = str_replace("{dienthoai}" , dienthoai , $str); 
            $str = str_replace("{diachi}" , diachi , $str); 
            $str = str_replace("{email}" , email , $str); 
            $str = str_replace("{ngaydathang}" , ngaydathang , $str);
            $str = str_replace("{xemdathang}" , xemdathang , $str);
            $str = str_replace("{tongtien}" , tongtien , $str);
            $str = str_replace("{tong}" , tong , $str);
            $str = str_replace("{donhangchitiet}" , donhangchitiet , $str);
            $str = str_replace("{tongsldathang}" , tongsldathang , $str);
            $str = str_replace("{soluong}" , soluong , $str);
            $str = str_replace("{dongia}" , dongia , $str);
            $str = str_replace("{thanhtien}" , thanhtien , $str);
            $str = str_replace("{capnhattrangthai}" , capnhattrangthai , $str); 
            $str = str_replace("{dathanhtoan}" , dathanhtoan , $str); 
            $str = str_replace("{choxuly}" , choxuly , $str);
            $str = str_replace("{trangthai}" , trangthai , $str);
            
            $str = str_replace("{nguoidung}" , nguoidung , $str);
            $str = str_replace("{thaymk}" , thaymk , $str);
            $str = str_replace("{mkcu}" , mkcu , $str); 
            $str = str_replace("{mkmoi}" , mkmoi , $str);
            $str = str_replace("{nhaplaimkmoi}" , nhaplaimkmoi , $str);
            
            
            echo $str;
        ?>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    </body>
</html>