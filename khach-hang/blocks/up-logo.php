<?php

//$congty_id = $_SESSION["congty_id"];
$sql1 ="SELECT HinhDaiDien From congty WHERE congty_id=$congty_id";
$logo=mysql_query($sql1) or die(mysql_error() . $sql1);
$Sodong=mysql_num_rows($logo);
$row_logo=  mysql_fetch_assoc($logo);

if(isset($_POST['btnUpload'])){ // Người dùng đã ấn submit
    if($_FILES['file']['name'] != NULL){ // Đã chọn file
        // Tiến hành code upload file
        if($_FILES['file']['type'] == "image/jpeg"
        || $_FILES['file']['type'] == "image/png"
        || $_FILES['file']['type'] == "image/gif"){
        // là file ảnh
        // Tiến hành code upload    
            if($_FILES['file']['size'] > 1048576){
                echo "File không được lớn hơn 1mb";
            }else{
                // file hợp lệ, tiến hành upload
                $path = "../upload/images/Logo/"; // file sẽ lưu vào thư mục data
                $tmp_name = $_FILES['file']['tmp_name'];
                 $name = $_FILES['file']['name'];
                $type = $_FILES['file']['type']; 
                $size = $_FILES['file']['size']; 
                // Upload file
                move_uploaded_file($tmp_name,$path.$name);
                
                $url_images = $path.$name;
               $sql = "UPDATE congty
					SET HinhDaiDien = '$url_images'
					WHERE congty_id = $congty_id ";
                mysql_query($sql) or die(mysql_error() . $sql);
                header("location:http://asiatiger.org/khach-hang/up-logo.html");
                //$row_logo=  mysql_fetch_assoc($logo);
                //window.location.reload();
                //echo "File uploaded! <br />";
               // echo "Tên file : ".$name."<br />";
                //echo "Kiểu file : ".$type."<br />";
                //echo "File size : ".$size;
           }
        }else{
           // không phải file ảnh
           echo "Kiểu file không hợp lệ";
        }
   }else{
        echo "Vui lòng chọn file";
   }
}


?>
<script language="JavaScript">
function check() {
	if ( document.form1.file.value == "" ){
		alert( "Please select file to upload!" ) ;document.form1.file.focus();return false;
	}     
	return true;
}
function DelCheck() {
	if ( !(confirm("Are you sure you want to delete「Compamy Logo」?")) ){
		return false;
	}     
	return true;
}
</script>
<div id="right">
    <h1>{uplogo}</h1>
    <p>&nbsp;</p>
    
    
    
     <form name="delform" method="post" action="xoa-logo.html" onsubmit="return DelCheck();">
        <p><img width="100px" src="<?php echo $row_logo['HinhDaiDien']; ?>" class="border" align="absmiddle">&nbsp;&nbsp;
        <!--<input type="Submit" name="Submit" id="btnXoaLoGo" value="{xoa} Logo" class="btn_padding">--></p>
        <input type="hidden" name="HinhDaiDien" id="HinhDaiDien" value="<?php echo $row_logo['HinhDaiDien']; ?>">
        <input type="hidden" name="congty_id" id="congty_id" value="<?php echo $congty_id; ?>">
    </form>
    
    <p>&nbsp;</p>
    
    
    <p class="sort">{chuysizehinh}</p>
    <p>&nbsp;</p>
    <form name="form1" method="post" enctype="multipart/form-data" action="" onsubmit="return check();">
        <table border="0" align="center" cellpadding="0" cellspacing="0">
            <tbody><tr>
                    <td>Logo Upload: </td>
                    <td><input type="file" name="file" class="mid_text"></td>
                </tr>
            </tbody></table>
        <p class="divider">&nbsp;</p>
        <p class="align_c"><input type="Submit" name="btnUpload" id="btnUpload" value="Upload" class="btn_padding"></p>
    </form>
    <p>&nbsp;</p>
    
    <p>&nbsp;</p>
</div>