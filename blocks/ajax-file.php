<script>
    $(window).load(function() {
        //alert('a');
        // store the slider in a local variable
      var $window = $(window),
          flexslider;

      // tiny helper function to add breakpoints
      function getGridSize() {
        return (window.innerWidth < 600) ? 2 :
               (window.innerWidth < 900) ? 3 : 4;
      }

        $('.flexslider').flexslider({
          animation: "slide"
        });
        $('.flexslider-weblk').flexslider({
          animation: "slide",
          animationSpeed: 1000,
          animationLoop: true,
          itemWidth: 210,
          itemMargin: 1,
          minItems: getGridSize(), // use function to pull in initial value
          maxItems: getGridSize(), // use function to pull in initial value
          start: function(slider){
            $('body').removeClass('loading');
            flexslider = slider;
          }
        });
      });
</script>
<script type="text/javascript">  
function chkcontrol(j) {  
    var total=0;
    //var j=0;
    for(var i=0; i < document.register.Category.length; i++){
    if(document.register.Category[i].checked){  
    total =total +1;}  
        if(total > 8){  
        alert("max select 8")       
        document.register.Category[i].checked = false;  
        return false;
        }  
    }    
}  



</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.fancybox').fancybox();
        //Sexy.initialize()
   // alert("s");
    // $("#faq_search_input").watermark("Nhập Từ Cần Tìm Kiếm");	// Watermart cho khung nhập
   // $("#faq_search_input1").keyup(function(){
           // var tukhoa=$(this).val();
          //  var lang=$("#lang").val();
            //alert(lang);
          //  $.get("../ajax/ajax-search.php",{tukhoa:tukhoa,lang:lang},function(data){
             //       $("#searchresultdata").html(data);
          //  });
   // });
    
    $('#newsticker').newsTicker({
        row_height: 48,
        max_rows: 5,
        speed: 600,
        direction: 'up',
        duration: 4000,
        autostart: 1,
        pauseOnHover: 0
    });
    $('#newsticker1').newsTicker({
        row_height: 48,
        max_rows: 2,
        speed: 600,
        direction: 'up',
        duration: 4000,
        autostart: 1,
        pauseOnHover: 0
    });
     $('#newsticker3').newsTicker({
        row_height: 48,
        max_rows: 2,
        speed: 600,
        direction: 'up',
        duration: 4000,
        autostart: 1,
        pauseOnHover: 0
    });
    $('#newsticker2').newsTicker({
        row_height: 48,
        max_rows: 2,
        speed: 600,
        direction: 'up',
        duration: 4000,
        autostart: 1,
        pauseOnHover: 0
    });
    
		//---------------------------KT Username----------------------
		$("#username").blur(function(){
			var us=$("#username").val();
                        //alert(us);
			$.get("ajax/username.php",{user:us},function(data){
				if(data=="1"){
					$("#kq1").html('<img src="img/false.png" />{daconguoidk}');
					$("#kq1").css({"color":"red","width":"200px"});
					$("#username").addClass("false");			
				}							
				else{ 	
                        if(us==""){
                            $("#kq1").html('<img src="img/false.png" /> {tendnkhongduocbotrong}!');
                            $("#kq1").css({"color":"red","width":"200px"});
                            $("#username").addClass("false");
                        }else{
						$("#username").removeClass("false");						
						$("#kq1").html('<img src="img/register-form-home.png" /> {bancothesdtennay}!');
                            $("#kq1").css({"color":"green","width":"200px"});
                        }
                                                //$("#kq1").slideToggle('5000');
					}				 
			});			
		});
		
		//------------------------------------KT Email-------------------------
		
		$("#email").blur(function(){
			var email=$("#email").val();
			//alert(email);
			$.post("ajax/email.php",{email:email},function(data){
				if(data=="1"){
					$("#kq3").html('<img src="img/false.png" />{emailconguoidk}');
					$("#kq3").css({"color":"red","width":"200px"});
					$("#email").addClass("false");
				}
				else if(data=="2"){
					$("#kq3").html('<img src="img/false.png" /> {emailkohople}');
					$("#kq3").css({"color":"red","width":"200px"});
					$("#email").addClass("false");
					
				}	
				else { 
					$("#email").removeClass("false");
					$("#kq3").html('<img src="img/register-form-home.png" />');
                    $("#kq3").css({"width":"200px"});
					
				}
			});
		});
		
		//------------------------Kt mật khẩu nhap lai---------------
		$("#pass").blur(function(){
			var pass=$(this).val();
			$("#repassword").blur(function(){
				var repass=$(this).val();
				if(repass==pass)
				{
					$("#repassword").removeClass("false");
					$("#pass").removeClass("false");
					$("#kq5").html("");					
				}				
				else
				{
					$("#kq5").html('<img src="img/false.png" />{mkkogiongnhau}');
					$("#kq3").css("color","red");					
					$("#pass").addClass("false");
					$("#repassword").addClass("false");
				}	
			});
		});
		
		//------------------------KT Dử liệu đăng ký------------------------
		$("#btnOK").click(function(){		
					
			var email=$("#email").val();
            var tencty=$("#tencty").val();
            var nguoidaidien=$("#nguoidaidien").val();
			var address=$("#diachi").val();
            var quocgia=$("#quocgia").val();
            var nhadautu=$("#nhadautu").val();
            var didong=$("#didong").val();
			var phone1=$("#dienthoai1").val();
            var phone2=$("#dienthoai2").val();
            var phone3=$("#dienthoai3").val();
			var us=$("#username").val();
            var fax1=$("#fax1").val();
            var fax2=$("#fax2").val();
            var fax3=$("#fax3").val();
            var website=$("#website").val();
            var spchinh=$("#spchinh").val();
            var pass=$("#pass").val();
            var repass=$("#repassword").val();
            var captcha=$("#6_letters_code").val();
            var ten_khong_dau=$("#tencty").val();
            var lang=$("#lang").val();
            var idTL=$("#idTL").val();
            var nhantb=$("#NhanThongBao").val();
            var cate_id = [];
            var  i= 0;

            $('.Category:checked').each(function(){
                cate_id[i++] = $(this).val();
            });

			if(us=="" ||tencty=="" || address=="" || pass=="" || didong=="" || phone2=="" || email=="" || spchinh=="" || quocgia=="0")
			{		
                if(lang=='vi'){
                     swal("Lỗi...", "Bạn vui lòng điền đầy đủ thông tin !", "error");
                }if(lang=='cn'){
                    swal("錯誤...", "您 沒 有 輸 入 足 夠 的 信 息！", "error");
                }if(lang=='en'){
                    swal("Error...", "You have not entered enough information !", "error");
                }

                if(us==""){
                    $("#username").addClass("false");
                }else{
                    $("#username").removeClass("false");
                }

                if(tencty==""){
                    $("#tencty").addClass("false");
                }else{
                    $("#tencty").removeClass("false");
                }

                if(pass==""){
                    $("#pass").addClass("false");
                }else{
                    $("#pass").removeClass("false");
                }

                if(didong==""){
                    $("#didong").addClass("false");
                }else{
                    $("#didong").removeClass("false");
                }

                if(email==""){
                    $("#email").addClass("false");
                }else{
                    $("#email").removeClass("false");
                }
                if(quocgia=="0"){
                    if(lang=='vi'){
                        swal("Lỗi...", "Bạn chưa chọn quốc gia !", "error");
                    }if(lang=='cn'){
                        swal("錯誤...", "您 沒 有 選 擇 國 家！", "error");
                    }if(lang=='en'){
                        swal("Error...", "You have not selected countries !", "error");
                    }
                }else{
                    $("#quocgia").removeClass("false");
                }

                if(address==""){
                    $("#diachi").addClass("false");
                }else{
                    $("#diachi").removeClass("false");
                }
                /*if(phone3=="" ||  phone2=="" || phone1=="" ){
                 $("#dienthoai3").addClass("false");
                 $("#dienthoai2").addClass("false");
                 $("#dienthoai1").addClass("false");
                 }else{
                 $("#dienthoai3").removeClass("false");
                 $("#dienthoai2").removeClass("false");
                 $("#dienthoai1").removeClass("false");
                 }*/
                if(spchinh==""){
                    $("#spchinh").addClass("false");
                }else{
                    $("#spchinh").removeClass("false");
                }

                if(nguoidaidien==""){
                    $("#nguoidaidien").addClass("false");
                }else{
                    $("#nguoidaidien").removeClass("false");
                }

                if(captcha==""){
                    $("#6_letters_code").addClass("false");
                }else{
                    $("#6_letters_code").removeClass("false");
                }
											
				return false;
			}


			else
			{	
                $("#thongbao").html('<div align="center"><img src="img/loading.gif" /> {vuilongdoi}</div>');
                $.post('ajax/xuly_dangky.php',{us:us,pass:pass,email:email,tencty:tencty,quocgia:quocgia,address:address,phone1:phone1,phone2:phone2,phone3:phone3,fax1:fax1,fax2:fax2,fax3:fax3,website:website,nguoidaidien:nguoidaidien,didong:didong,nhadautu:nhadautu,spchinh:spchinh,cate_id:cate_id,idTL:idTL,ten_khong_dau:ten_khong_dau,lang:lang,nhantb:nhantb},function(data){
                    //swal("成功", "您是否要設定公司專刊!", "success");
                    //setTimeout(function(){window.location.href='khach-hang/index.html';},1000);
//                    swal({
//                        title: '成功',
//                        text: " 您是否要設定公司專刊!",
//                        type: 'success',
//                        showCancelButton: true,
//                        confirmButtonColor: '#3085d6',
//                        cancelButtonColor: '#d33',
//                        confirmButtonText: 'Yes',
//                        cancelButtonText: 'Cancel',
//                        confirmButtonClass: 'btn btn-success',
//                        cancelButtonClass: 'btn btn-danger',
//                        buttonsStyling: false
//                    }).then(function() {
//                        setTimeout(function(){window.location.href='khach-hang/index.html';},1000);
//                    }, function(dismiss) {
//                        // dismiss can be 'cancel', 'overlay', 'close', 'timer'
//                        if (dismiss === 'cancel') {
//                            setTimeout(function(){window.location.href='index.html';},1000);
//                        }
//                    });



                    swal({
                            title: "成功",
                            text: "您是否要設定公司專刊!",
                            type: "success",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes!",
                            cancelButtonText: "Cancel",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        },
                        function(isConfirm){
                            if (isConfirm) {
                                setTimeout(function(){window.location.href='khach-hang/index.html';},1000);
                            } else {
                                setTimeout(function(){window.location.href='index.html';},1000);
                            }
                        });
			    });
            }
		    });
                
                
                //------------------------KT Dử liệu Liên Hệ------------------------
		$("#btnLienHe").click(function(){		
					
            var tieude=$("#tieude").val();
            var noidung=$("#noidung").val();
			var email=$("#email").val();
            var tencty=$("#tencty").val();
            var nguoilienhe=$("#nguoilienhe").val();
			var address=$("#diachi").val();
			var phone=$("#dienthoai").val();
            var fax=$("#fax").val();
            var lang=$("#lang").val();
                        
			if(tieude=="" ||noidung=="" ||nguoilienhe=="" ||tencty=="" || address=="" ||phone==""||fax==""  || email=="" )
			{			
				if(lang=='vi'){
                     swal("Lỗi...", "Bạn vui lòng điền đầy đủ thông tin !", "error");
                }if(lang=='cn'){
                    swal("錯誤...", "您 沒 有 輸 入 足 夠 的 信 息！", "error");
                }if(lang=='en'){
                    swal("Error...", "You have not entered enough information !", "error");
                }

				if(tieude==""){
					$("#tieude").addClass("false");
				}else{
					$("#tieude").removeClass("false");
				}

                if(tencty==""){
					$("#tencty").addClass("false");
				}else{
					$("#tencty").removeClass("false");
				}
				
				if(email==""){
					$("#email").addClass("false");
				}else{
					$("#email").removeClass("false");
				}
				
				
				if(address==""){
					$("#diachi").addClass("false");
				}else{
					$("#diachi").removeClass("false");
				}

				if(phone==""){
					$("#dienthoai").addClass("false");
				}else{
					$("#dienthoai").removeClass("false");
				}

                if(fax==""){
					$("#fax").addClass("false");
				}else{
					$("#fax").removeClass("false");
				}

                if(noidung==""){
					$("#noidung").addClass("false");
				}else{
					$("#noidung").removeClass("false");
				}

                if(nguoilienhe==""){
					$("#nguoilienhe").addClass("false");
				}else{
					$("#nguoilienhe").removeClass("false");
				}
											
				return false;
			}
			else
			{	
                $("#thongbao").html('<div align="center"><img src="img/loading.gif" /> {vuilongdoi}</div>');
                $.post('ajax/xuly_lienhe.php',{tieude:tieude,noidung:noidung,email:email,tencty:tencty,address:address,phone:phone,fax:fax,nguoilienhe:nguoilienhe,lang:lang},function(data){
                    if(lang=='vi'){
                        swal("Thành công", "Xử lý thành công,chúng tôi sẽ trả lời cho quý khách trong thời gian sớm nhất !", "success");
                    }if(lang=='cn'){
                        swal("成功", "已送出, 您的訊息我們會盡快處理及回覆！", "success");
                    }if(lang=='en'){
                        swal("Success", "Processed successfully, we will reply to you as soon as possible!", "success");
                    }
                    $("#thongbao").html('');
                   setTimeout(function(){window.location.href='lien-he.html';},3000);
                });
			}
		});
                
                //------------------------KT Dử liệu đăng nhập------------------------
		$('#pass').keypress(function(event){
			var keycode = (event.keyCode ? event.keyCode : event.which);
			if(keycode == '13'){
				$("#btnDangNhap").click();
			}
		});		
				
		$("#btnDangNhap").click(function(){		
			//alert("asd");
						
			var us=$("#tendn").val();
                        
                        var pass=$("#pass").val();
                        var lang=$("#lang").val();
                        var url=$("#url").val();
                        //alert(url);
			if(us=="" || pass=="")
			{			
				if(lang=='vi'){
                                     swal("Lỗi...", "Bạn vui lòng điền đầy đủ thông tin !", "error");
                                }if(lang=='cn'){                                    
                                    swal("錯誤...", "您 沒 有 輸 入 足 夠 的 信 息！", "error");
                                }if(lang=='en'){                                    
                                    swal("Error...", "You have not entered enough information !", "error");
                                }
				if(us==""){
					$("#tendn").addClass("false");
				}else{
                                        
					$("#tendn").removeClass("false");
				}
                               
				
				if(pass==""){
					$("#pass").addClass("false");
				}else{
					$("#pass").removeClass("false");
				}
				
											
				return false;
			}
			else
			{	
                                $("#thongbao").html('<div align="center"><img src="img/loading.gif" /> {vuilongdoi}</div>');
                                $.post('ajax/xuly_dangnhap.php',{us:us,pass:pass},function(data){												
                                    
                                    if(data=="1"){
                                         if(url !=''){ 
                                             if(url=='/dang-nhap.html'){
                                                 $("#thongbao").html('');
                                                setTimeout(function(){window.location.href='khach-hang';},500);
                                             }else{
                                                 $("#thongbao").html('');
                                                setTimeout(function(){window.location.href='khach-hang/them-san-pham.html';},500);
                                             }  
                                         } else{
                                             $("#thongbao").html('');
                                            setTimeout(function(){window.location.href='khach-hang';},500);
                                         }
                                           
                                    }							
                                    else{ 	
                                        $("#thongbao").html('<img src="img/false.png" /><a style="color:red;margin-left:10px;">{emailormkkodung}</a>');	
                                        $("#tendn").addClass("false");
                                        $("#pass").addClass("false");
                                    }
                                  		
                                });
				//alert("Chúc mừng bạn đã đã đăng ký thành viên thành công. !!! ");
				//return true;
			}	
		});
                
                //------------------------KT Dử liệu quên mật khẩu------------------------
		$("#btnLayMatKhau").click(function(){		
			//alert("asd");
						
			var us=$("#tendn").val();                        
                        var lang=$("#lang").val();
                        var pass=$("#pass").val();
			if(us=="")
			{			
				if(lang=='vi'){
                                     swal("Lỗi...", "Bạn vui lòng điền đầy đủ thông tin !", "error");
                                }if(lang=='cn'){                                    
                                    swal("錯誤...", "您 沒 有 輸 入 足 夠 的 信 息！", "error");
                                }if(lang=='en'){                                    
                                    swal("Error...", "You have not entered enough information !", "error");
                                }
				if(us==""){
					$("#tendn").addClass("false");
				}else{
                                        
					$("#tendn").removeClass("false");
				}                               						
				return false;
			}
			else
			{	                            
                          
                                        $.post("ajax/email.php",{email:us},function(data){
                                                if(data=="1"){
                                                    $("#thongbao").html('<div align="center"><img src="img/loading.gif" /> {vuilongdoi}</div>');
                                                    $.post('ajax/xuly_quenmk.php',{us:us,lang:lang,pass:pass},function(data){                                                        
                                                        if(lang=='vi'){                                        
                                                            swal("Thành công", "Xử lý thành công !", "success");
                                                        }if(lang=='cn'){                                        
                                                            swal("成功", "已送出！", "success");
                                                        }if(lang=='en'){                                        
                                                            swal("Success", "Processed successfully !", "success");
                                                        }
                                                        $("#thongbao").html('');
                                                        setTimeout(function(){window.location.href='dang-nhap.html';},2000);
                                                                
                                                    });
                                                }
                                                else if(data=="2"){
                                                        $("#thongbao").html('<img src="img/false.png" /> {emailkohople}');
                                                        $("#thongbao").css("color","red");
                                                        $("#tendn").addClass("false");

                                                }	
                                                else { 
                                                        $("#tendn").removeClass("false");
                                                        $("#thongbao").html('<img src="img/register-form-home.png" />'); 

                                                }
                                        });
                                
                                
                                
			}	
		});
                
                $('.TenCate').hide();                
                $('a.TenTL').click(function(){
                    $(this).parent().find('.TenCate').slideToggle();
                    //console.log($(this).children().html());
                 });
                 
                 $('#quocgia').change(function() {
                    $.post('ajax/get_mavung.php', {idQuocGia: $(this).val()}, function(data) {
                        $('#dienthoai1').html(data);
                        $('#fax1').html(data);
                    })
                })
    
});
</script>
<script type="text/javascript">
    $(function() {
        $('.slide-tin').vTicker({
            speed: 1000,
            pause: 7000,
            animation: 'fade',
            mousePause: true,
            showItems: 8
        }); 
        $('.slide-sp').vTicker({
            speed: 1000,
            pause: 7000,
            animation: 'fade',
            mousePause: true,
            showItems: 11
        }); 
        $('.slide-trienlam').vTicker({
            speed: 1000,
            pause: 7000,
            animation: 'fade',
            mousePause: true,
            showItems: 4
        }); 
    });

    // prevent click right mouse
    document.addEventListener('contextmenu', event => event.preventDefault());
 </script>
