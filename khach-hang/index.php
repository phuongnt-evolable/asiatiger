<?php
    session_start();

    $lang_arr = array("vi", "cn", "en");
    if (isset($_GET['lang']) == true) {
        if (in_array($_GET['lang'], $lang_arr) == true)
            $lang = $_GET['lang'];
    }
    elseif (isset($_SESSION['lang']) == true) {
        if (in_array($_SESSION['lang'], $lang_arr) == true)
            $lang = $_SESSION['lang'];
    } else
        $lang = 'cn';
    $_SESSION['lang'] = $lang;
    setcookie('lang', $lang, time() + 60 * 60 * 24 * 30);
    ob_start();
//echo $lang; die;
    require_once "../lang/lang_$lang.php";
    require_once "../admin/Model/Product.php";
    require_once("../admin/Model/QuocGia.php");
    require_once "../admin/Model/Cate.php";
    require_once "../admin/Model/Article.php";
    require_once "../admin/Model/Block.php";
    require_once "../admin/Model/Home.php";
    require_once "../admin/Model/Congty.php";
      //require_once "../admin/model/Db.php";
    $modelProduct = new Product;
    $modelQuocgia = new Quocgia;
    $modelCate = new Cate;
    $modelArticle = new Article;
    $modelBlock = new Block;
    $modelHome = new Home;
    $modelCongTy = new Congty;
    require_once("blocks/seo.php");
    
    $_SESSION['congty_id']!=1 ? $congty_id=$_SESSION["congty_id"] : $congty_id = '';
    $idUser=$_SESSION["idUser"];
    if(isset($idUser)){
        $congty=$modelCongTy->getDetailCongTy($congty_id);
        $row_cty=  mysql_fetch_assoc($congty);
    }  else {
        header("location: http://asiatiger.org/dang-nhap.html");
    }
    
    
?>
<html>
    <head>
        <base href="http://asiatiger.org/khach-hang/" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="shortcut icon" href="images/favicon.ico" >
        <link href="css/main.css" rel="stylesheet" type="text/css">
        <link href="../static/saved_resource.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../js/jquery-1.3.2.js"></script>
        <script type="text/javascript" src="../static/saved_resource(1).css"></script>
        <script type="text/javascript" src="../cong-ty/js/gotop.js"></script>
        <script src="../js/sweet-alert.min.js"></script>
        <link rel="stylesheet" href="../css/sweet-alert.css">
        
        <link rel="stylesheet" href="css/jQueryTab.css" type="text/css" media="screen" /> 
        <link rel="stylesheet" href="css/animation.css" type="text/css" media="screen" />
        
        <script src="js/jQueryTab.js"></script> 
        <script type="text/javascript">
        // initializing jQueryTab plugin 
        
        $('.tabs-7').jQueryTab({
            initialTab: 2,
            tabInTransition: 'fadeIn',
            tabOutTransition: 'fadeOut',
            cookieName: 'active-tab-7'

        });


        </script>
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
            $(document).ready(function(){
                
                   
                //alert('a');
                //$(".wrap-canban").hide();
                 $(".wrap-canmua").hide();
                
                jQuery("[name='loai_hinh']").change(function(){
                    var str="";
                    jQuery("input:radio[name=loai_hinh]:checked").each(function(i,val){
                      if(jQuery(this).val()== 1){
                          $(".wrap-canban").show();
                          $(".wrap-canmua").hide();
                      }else{
                          $(".wrap-canmua").show();
                          $(".wrap-canban").hide();
                      }
                    });
                    //jQuery("#rds_div").html(str);
                });                
                
                $(".add-skype").click(function() {
                    $("#wrapper_input_files").append("<input style='width: 150px; margin-top: 5px;margin-bottom: 5px;' type='text' class='skype' id='skype' name='skype[]' /><br />");
                    
                });
                
                $('.TenCate').hide();                
                $('a.TenTL').click(function(){
                    $(this).parent().find('.TenCate').slideToggle();
                    //console.log($(this).children().html());
                 });
                 
                 $('#tttk').show();                
                $('p.tttk').click(function(){
                    $(this).parent().find('#tttk').slideToggle();
                    //console.log($(this).children().html());
                 });
                 
                 $('#ttct').show();                
                $('p.ttct').click(function(){
                    $(this).parent().find('#ttct').slideToggle();
                    //console.log($(this).children().html());
                 });
                 
                 $('#dmnn').show();                
                $('p.dmnn').click(function(){
                    $(this).parent().find('#dmnn').slideToggle();
                    //console.log($(this).children().html());
                 });
                
                //---------------------------------------
                
                $(".linkxoa-sp").live('click',function(){
                    var flag = confirm("您確定刪除?");
                    if(flag == true){
                        var id = $(this).attr("product_id");
                        $.get('../admin/xoa.php',{loai:"product",id:id},function(data){
                            window.location.reload();
                        });
                    }
                });
                
                //------------------------Thay đổi mật khẩu------------------------
		$("#btnDoiMatKhau").click(function(){								
                        
                        var oldpw=$("#oldpw").val();
                        var newpw=$("#newpw").val();
                        var confirmpw=$("#confirmpw").val();
                        var lang=$("#lang").val();
                        var idUser=$("#idUser").val();
                        //alert(lang);
                        
			if( oldpw=="" || newpw=="" || confirmpw=="")
			{			
				if(lang=='vi'){
                                    alert("Bạn chưa nhập đầy đủ thông tin !");
                                }if(lang=='cn'){
                                    alert("您 沒 有 輸 入 足 夠 的 信 息！");
                                }if(lang=='en'){
                                    alert("You have not entered enough information !");
                                }
				
				if(oldpw==""){					
                                        $("#ktpasscu").html('<img src="../img/false.png" /> {phainhapmkcu} !');
                                        $("#ktpasscu").css("color","red");
                                        $("#oldpw").addClass("false");
				}else{
					$("#oldpw").removeClass("false");                                        
				}
				
				
				if(newpw==""){
					$("#newpw").addClass("false");
				}else{
					$("#newpw").removeClass("false");
				}
                                
                                if(confirmpw==""){
					$("#confirmpw").addClass("false");
				}else{
					$("#confirmpw").removeClass("false");
				}
                                							
				return false;
			}
			else
			{	
                               /* if(oldpw!=""){					
                                         $.get("ajax/kt_pass_cu.php",{passcu:oldpw},function(data){
                                                if(data=="1"){                                            
                                                        $("#oldpw").removeClass("false");						
                                                        $("#ktpasscu").html('<img src="../img/true.png" />');
                                                        $("#ktpasscu").css("color","green");
                                                        return true;
                                                }							
                                                else{ 
                                                        $("#ktpasscu").html('<img src="../img/false.png" /> {mkcukochinhxac}');
                                                        $("#ktpasscu").css("color","red");	
                                                        $("#oldpw").addClass("false");
                                                }

                                        });
				}
                                else if(confirmpw!="" || newpw!="")
				{
                                    if(confirmpw==newpw)
                                    {
                                        if(repass !='' && pass!=''){
                                            $("#confirmpw").removeClass("false");
                                            $("#newpw").removeClass("false");					
                                            $("#ktpassnhaplai").html("");
                                            return true;
                                        } else{
                                            $("#ktpassnhaplai").html('<img src="../img/false.png" /> {mkmoikodcbotrong}');
                                            $("#ktpassnhaplai").css("color","red");					
                                            $("#newpw").addClass("false");
                                            $("#confirmpw").addClass("false");
                                        }  

                                    }				
                                    else
                                    {
                                            $("#ktpassnhaplai").html('<img src="../img/false.png" /> {mkkogiongnhau}');
                                            $("#ktpassnhaplai").css("color","red");					
                                            $("#newpw").addClass("false");
                                            $("#confirmpw").addClass("false");
                                    }					
				}else{ */
                                    //return true;
                                    $("#thongbao").html('<div align="center"><img src="../img/loading.gif" /> {vuilongdoi}</div>');
                                    $.post('ajax/xuly_thaydoipass.php',{idUser:idUser,newpw:newpw},function(data){												
                                        if(lang=='vi'){
                                            alert("Thay đổi mật khẩu thành công !");
                                        }if(lang=='cn'){
                                            alert("更 換 密 碼 成 功！");
                                        }if(lang=='en'){
                                            alert("Successful password change !");
                                        }
                                        window.location.reload();
                                       //setTimeout(function(){window.location.href='http://asiatiger.org/dang-nhap.html';},1000);		
                                    });	
                                //}
                                			
			}	
		});
                
		$("#oldpw").blur(function(){
			var passcu=$(this).val();
                        //alert(passcu);
                        if(passcu==""){
                            $("#ktpasscu").html('<img src="../img/false.png" /> {phainhapmkcu} !');
                            $("#ktpasscu").css("color","red");
                            $("#oldpw").addClass("false");
                        }else{
                            $.get("ajax/kt_pass_cu.php",{passcu:passcu},function(data){
                                    if(data=="1"){                                            
                                            $("#oldpw").removeClass("false");						
                                            $("#ktpasscu").html('<img src="../img/true.png" />');
                                            $("#ktpasscu").css("color","green");
                                    }							
                                    else{ 
                                            $("#ktpasscu").html('<img src="../img/false.png" /> {mkcukochinhxac}');
                                            $("#ktpasscu").css("color","red");	
                                            $("#oldpw").addClass("false");
                                    }

                            });
                        }
			
			
		});
                
                $("#newpw").blur(function(){
			var pass=$(this).val();
			
			$("#confirmpw").blur(function(){
				var repass=$(this).val();
			 	//alert (repass);
				if(repass==pass)
				{
                                    if(repass !='' && pass!=''){
                                        $("#confirmpw").removeClass("false");
					$("#newpw").removeClass("false");					
					$("#ktpassnhaplai").html("");
                                    } else{
                                        $("#ktpassnhaplai").html('<img src="../img/false.png" /> {mkmoikodcbotrong}');
					$("#ktpassnhaplai").css("color","red");					
					$("#newpw").addClass("false");
					$("#confirmpw").addClass("false");
                                    }  
										
				}				
				else
				{
					$("#ktpassnhaplai").html('<img src="../img/false.png" /> {mkkogiongnhau}');
					$("#ktpassnhaplai").css("color","red");					
					$("#newpw").addClass("false");
					$("#confirmpw").addClass("false");
				}	
			});
		});
                
                //------------------------KT Dử liệu------------------------
		$("#btnDoiThongTin").click(function(){		
				
			var email=$("#email").val();
            var ten_cty_vi=$("#ten_cty_vi").val();
            var ten_cty_cn=$("#ten_cty_cn").val();
            var ten_cty_en=$("#ten_cty_en").val();
            var nguoilienhe=$("#nguoilienhe").val();
            
            var skype = [];
            var  i= 0;                        
            $('.skype').each(function(){
                skype[i++] = $(this).val();
            });
            console.log(skype);                        
            var jsonStringSkype = JSON.stringify(skype);
            
            var qq=$("#qq").val();
            var quocgia=$("#quocgia").val();
            var nhadautu=$("#nhadautu").val();
			var diachi_vi=$("#diachi_vi").val();
            var diachi_cn=$("#diachi_cn").val();
            var diachi_en=$("#diachi_en").val();
            var gioithieu_vi=CKEDITOR.instances['gioithieu_vi'].getData(); 
            var gioithieu_cn=CKEDITOR.instances['gioithieu_cn'].getData();
            var gioithieu_en=CKEDITOR.instances['gioithieu_en'].getData();
			var phone=$("#dienthoai").val();			
			var didong=$("#didong").val();
            var fax=$("#fax").val();
            var website=$("#website").val();
            var spchinh=$("spchinh").val();
            var congty_id=$("#congty_id").val();
            var lang=$("#lang").val();
            var cate_id = [];
            var  i= 0;
            $('.Category:checked').each(function(){
                cate_id[i++] = $(this).val();
            });
            console.log(cate_id);
            
            var jsonString = JSON.stringify(cate_id);
                       
			if( didong=="" || email=="" || ten_cty_vi=='' || ten_cty_cn =='' || ten_cty_en =='' || diachi_vi =='' || diachi_cn =='' || diachi_en =='' || quocgia == 0)
			{			
				if(lang=='vi'){
                    alert("Bạn chưa nhập đầy đủ thông tin !");
                }if(lang=='cn'){
                    alert("您 沒 有 輸 入 足 夠 的 信 息！");
                }if(lang=='en'){
                    alert("You have not entered enough information !");
                }
				
				if(email==""){
					$("#email").addClass("false");
				}else{
					$("#email").removeClass("false");
				}
				if(quocgia=="0"){
                    if(lang=='vi'){
                        alert("Bạn chưa chọn quốc gia !");
                    }if(lang=='cn'){
                        alert("您 沒 有 選 擇 國 家！");
                    }if(lang=='en'){
                        alert("You have not selected countries !");
                    }
				}else{
					$("#quocgia").removeClass("false");
				}
				
				if(didong==""){
					$("#didong").addClass("false");
				}else{
					$("#didong").removeClass("false");
				}
                                							
				return false;
			}
			else
			{	
                $("#thongbao").html('<div align="center"><img src="../img/loading.gif" /> {vuilongdoi}</div>');
                $.post('../ajax/xuly_thaydoithongtin.php',{cate_id:jsonString,congty_id:congty_id,email:email,ten_cty_vi:ten_cty_vi,ten_cty_cn:ten_cty_cn,ten_cty_en:ten_cty_en,quocgia:quocgia,nguoilienhe:nguoilienhe,skype:jsonStringSkype,qq:qq,didong:didong,phone:phone,fax:fax,website:website,diachi_vi:diachi_vi,diachi_cn:diachi_cn,diachi_en:diachi_en,gioithieu_vi:gioithieu_vi,gioithieu_cn:gioithieu_cn,gioithieu_en:gioithieu_en,spchinh:spchinh,nhadautu:nhadautu},function(data){
                    if(lang=='vi'){
                        alert("Xử lý thành công !");
                    }if(lang=='cn'){
                        alert("處 理 成 功！");
                    }if(lang=='en'){
                        alert("Handling success !");
                    }
                    
                    window.location.reload();
                   //setTimeout(function(){window.location.href='dang-ky-buoc-2.html';},1000);		
                });
			}	
		});
            });
        </script>        
        <script type="text/javascript" src="http://tw.js.webmaster.yahoo.com/398350/ystat.js"></script>
    
</head>

<body>
    <!-------------------------- navbar -------------------------->
    <div id="navbar_wrapper">
      <div id="navbar">
        <p>Hi <?php echo $row_cty['TenCT_'.$lang];  ?>, welcome to Asiatiger</p>
        <ul>          
          <li><a href="thoat.php">Logout</a></li>
          
        </ul>
      </div>
    </div>
    <!-------------------------- navbar end -------------------------->
    <!-------------------------- header -------------------------->

    <script type="text/javascript" src="../static/beacon_en.js"></script>
    <script type="text/javascript">var dmtrack_c = '{ali_resin_trace=nuser=Y}';
    var dmtrack_pageid = '734d46017f0000011414460248';
    sk_dmtracking();</script> 


    <script>
        seajs.use('http://style.aliunicorn.com/js/6v/lib/icbu/gdata/??gdata.js?t=66132cea_d3949ad8', function(gdata) {
            gdata.define('sc-header-config', {
                'mod': {
                    'sundry': [],
                    'searchbar': null
                }
            });
        });
    </script>

<?php include 'blocks/header.php'; ?>

    <!-------------------------- header end -------------------------->
    <!-------------------------- menu -------------------------->


    <div id="menu">
        <ul>
            <li  class="<?php if($com=='') echo 'selected';  ?>"><a href="index.html">{ttct}</a></li>
            <li class="<?php if($com=='dssp' || $com=='them-sp' || $com=='sua-sp') echo 'selected';  ?>" ><a href="danh-sach-san-pham.html">{sanpham}</a></li>
            <li ><a href="http://asiatiger.org/cong-ty/<?php echo $row_cty['ten_khong_dau'].'-'.$row_cty['congty_id'].'.html'; ?>">{hienthitrangcty}</a></li>
        </ul>
    </div>

    <!-------------------------- menu end -------------------------->
    <!-------------------------- content -------------------------->
    <div id="content">
        <!-------------------------- left -------------------------->
        <div id="left">
            <ul class="list">
                
                <?php
                    if($com!='dssp' && $com!='them-sp' && $com!='sua-sp' ){
                        include"blocks/left-home.php";
                    }else{
                        include"blocks/left-sp.php";
                    }
                ?>
                
            </ul>
            <p>&nbsp;</p>            
        </div>
        <!-------------------------- left end -------------------------->
        <!-------------------------- right -------------------------->
            <?php //echo $com;die;
                switch($com){                
                        case "doimk" : include "blocks/doi-mat-khau.php";break;
                        case "up-logo" : include "blocks/up-logo.php";break;
                        case "xoa-logo" : include "blocks/xoa-logo.php";break;
                        case "up-hinhcty" : include "blocks/up-hinh-cong-ty.php";break;
                        case "dssp" : include "blocks/danh-sach-sp.php";break;
                        case "them-sp" : include "blocks/them-san-pham.php";break;
                        case "sua-sp" : include "blocks/sua-san-pham.php";break;
                        default : include "blocks/right.php";break;        
                }
                        //default : include "page/danh-sach-cong-ty.php";break;            }
            ?>
        <!-------------------------- right end -------------------------->
        <p class="clear">&nbsp;</p>
    </div>
    <!-------------------------- content end-------------------------->
    <p>&nbsp;</p>
    
    
    <!-------------------------- footer -------------------------->
    <div class="skin-default" data-name="mm-sc-new-footer" data-skin="default" data-guid="1409634827621" id="guid-1409634827621" data-version="41" data-type="3">
        <div class="back-top" id="back-top" style="display:none; float: right;">
            <a href="javascript:void(0);" title="返回顶部" class="gotop">返回顶部</a>
        </div>
        <div class="module" data-spm="a271py">
            <div class="mm-sc-new-footer">
<?php include 'blocks/footer.php'; ?>
            </div>
        </div>        
    </div>

    <!-------------------------- footer end-------------------------->
    
    
    <?php
            $str=ob_get_clean();
            $str = str_replace("{gioithieu}" , gioithieu , $str);

            $str = str_replace("{gioithieuvinhsang}" , gioithieuvinhsang , $str);
            $str = str_replace("{baoveriengtu}" , baoveriengtu , $str);
            $str = str_replace("{bandowebsite}" , bandowebsite , $str);
            
            $str = str_replace("{trangchu}" , trangchu , $str);
            $str = str_replace("{lienhe}" , lienhe , $str);	
            $str = str_replace("{danhmucsp}" , danhmucsp , $str);
            $str = str_replace("{sanpham}" , sanpham , $str);
             $str = str_replace("{ctsanpham}" , ctsanpham , $str); 
            $str = str_replace("{httt}" , httt , $str);
            $str = str_replace("{duandalam}" , duandalam , $str);
            
            
            $str = str_replace("{thaydoithongtin}" , thaydoithongtin , $str);
            $str = str_replace("{doimatkhau}" , doimatkhau , $str);	
            $str = str_replace("{uplogo}" , uplogo , $str);
            $str = str_replace("{didong}" , didong , $str);
             $str = str_replace("{passcu}" , passcu , $str); 
            $str = str_replace("{passmoi}" , passmoi , $str);
            $str = str_replace("{nhaplaipass}" , nhaplaipass , $str);
            $str = str_replace("{capnhat}" , capnhat , $str);
            $str = str_replace("{dssanpham}" , dssanpham , $str);
            $str = str_replace("{themsp}" , themsp , $str);
            $str = str_replace("{danhmuc}" , danhmuc , $str);
            $str = str_replace("{tendailoan}" , tendailoan , $str);	
            $str = str_replace("{tenvietnam}" , tenvietnam , $str);
            $str = str_replace("{tentienganh}" , tentienganh , $str);
             $str = str_replace("{hinhanh}" , hinhanh , $str); 
             $str = str_replace("{mota}" , mota , $str);
            $str = str_replace("{motacn}" , motacn , $str);
            $str = str_replace("{motavi}" , motavi , $str);
            $str = str_replace("{motaen}" , motaen , $str);
            $str = str_replace("{nddailoan}" , nddailoan , $str);
            $str = str_replace("{ndvietnam}" , ndvietnam , $str);
            $str = str_replace("{ndtienganh}" , ndtienganh , $str);
           
            $str = str_replace("{tintucmuaban}" , tintucmuaban , $str);
            $str = str_replace("{dkquangcao}" , dkquangcao , $str);
            $str = str_replace("{tttrienlam}" , tttrienlam , $str);
            $str = str_replace("{weblk}" , weblk , $str);
            $str = str_replace("{bangquangcao}" , bangquangcao , $str);  
            
             $str = str_replace("{thongbao}" , thongbao , $str);
            
           $str = str_replace("{danhmucnghanhnghe}" , danhmucnghanhnghe , $str);
            $str = str_replace("{danhchonguoimua}" , danhchonguoimua , $str);	
            $str = str_replace("{danhchonguoiban}" , danhchonguoiban , $str);
            $str = str_replace("{giupdo}" , giupdo , $str);
             $str = str_replace("{trangvang}" , trangvang , $str); 
            $str = str_replace("{ngonngu}" , ngonngu , $str);
            $str = str_replace("{vietnam}" , vietnam , $str);
            $str = str_replace("{dailoan}" , dailoan , $str);
            $str = str_replace("{trungquoc}" , trungquoc , $str);
            $str = str_replace("{hongkong}" , hongkong , $str);
           $str = str_replace("{dangnhap}" , dangnhap , $str);
           $str = str_replace("{dangky}" , dangky , $str); 
            $str = str_replace("{trangmau}" , trangmau , $str);
            $str = str_replace("{theosp}" , theosp , $str);
            $str = str_replace("{theonhacungcap}" , theonhacungcap , $str);
            $str = str_replace("{chamsockh}" , chamsockh , $str);
            $str = str_replace("{hoatdongmoinhat}" , hoatdongmoinhat , $str);
           $str = str_replace("{tinmoinhat}" , tinmoinhat , $str);
           $str = str_replace("{dichvuthuongmai}" , dichvuthuongmai , $str);
           $str = str_replace("{qcniengiam}" , qcniengiam , $str);
           $str = str_replace("{bandovn}" , bandovn , $str);
           $str = str_replace("{chonhinh}" , chonhinh , $str);
            
            $str = str_replace("{thongke}" , thongke , $str);
            $str = str_replace("{dichvu}" , dichvu , $str);

            $str = str_replace("{dau}" , dau , $str);	
            $str = str_replace("{cuoi}" , cuoi , $str);
            $str = str_replace("{hotline}" , hotline , $str);	
            $str = str_replace("{ttnguoiban}" , ttnguoiban , $str);
            $str = str_replace("{xemthemspcungcty}" , xemthemspcungcty , $str);
            
            $str = str_replace("{tintuc}" , tintuc , $str);	
            $str = str_replace("{tuyendung}" , tuyendung , $str);	
            $str = str_replace("{diachi}" , diachi , $str);

            $str = str_replace("{gioithieucty}" , gioithieucty , $str);

            
            $str = str_replace("{chitiet}" , chitiet , $str);


            $str = str_replace("{tinlienquan}" , tinlienquan , $str);
            $str = str_replace("{trove}" , trove , $str);
            $str = str_replace("{search}" , search , $str);
            $str = str_replace("{timgi}" , timgi , $str);   
            
            $str = str_replace("{tencty}" , tencty , $str);
            $str = str_replace("{email}" , email , $str);
            $str = str_replace("{noidung}" , noidung , $str);
            $str = str_replace("{tieude}" , tieude , $str);
            $str = str_replace("{dienthoai}" , dienthoai , $str);
            $str = str_replace("{gui}" , gui , $str);
            $str = str_replace("{hoten}" , hoten , $str);
            $str = str_replace("{gia}" , gia , $str);
            $str = str_replace("{phainhapmkcu}" , phainhapmkcu , $str);
            
            $str = str_replace("{fax}" , fax , $str);
            $str = str_replace("{nguoilienhe}" , nguoilienhe , $str);
            $str = str_replace("{tttk}" , tttk , $str);
            $str = str_replace("{ttct}" , ttct , $str);
            $str = str_replace("{spchinh}" , spchinh , $str);
            $str = str_replace("{tendn}" , tendn , $str);
            $str = str_replace("{pass}" , pass , $str);
            $str = str_replace("{quenpass}" , quenpass , $str);
            $str = str_replace("{rememberme}" , rememberme , $str);
            $str = str_replace("{hoac}" , hoac , $str);
            $str = str_replace("{batbuocnhap}" , batbuocnhap , $str);
            $str = str_replace("{hangmuckd}" , hangmuckd , $str);
            $str = str_replace("{website}" , website , $str);
            $str = str_replace("{nhaplai}" , nhaplai , $str);
            
            $str = str_replace("{tong}" , tong , $str);
            $str = str_replace("{max8}" , max8 , $str);
            $str = str_replace("{vuilongdoi}" , vuilongdoi , $str);
            $str = str_replace("{chuysizehinh}" , chuysizehinh , $str);
            $str = str_replace("{chuysizehinhsp}" , chuysizehinhsp , $str);
            $str = str_replace("{mkcukochinhxac}" , mkcukochinhxac , $str);
            $str = str_replace("{mkmoikodcbotrong}" , mkmoikodcbotrong , $str);
            $str = str_replace("{mkkogiongnhau}" , mkkogiongnhau , $str);
            $str = str_replace("{hienthitrangcty}" , hienthitrangcty , $str);
            $str = str_replace("{quocgia}" , quocgia , $str);
            $str = str_replace("{chon}" , chon , $str);
            $str = str_replace("{loaihinh}" , loaihinh , $str);
            $str = str_replace("{canban}" , canban , $str);
            $str = str_replace("{canmua}" , canmua , $str);
            $str = str_replace("{danhchovip}" , danhchovip , $str);
            $str = str_replace("{nhadautu}" , nhadautu , $str);
            
            //echo $lang;
            echo $str;
        ?>
    
</body>
</html>
