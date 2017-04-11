<html>
<head>
          <title>Trang Xu ly va Ket qua upload</title>
</head>
<body>
<?php
  if ($_FILES["file_up"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file_up"]["error"] . "<br />";
    }
  else
    {
    if (file_exists("upload/images/Logo/" . $_FILES["file_up"]["name"]))
      {
      echo $_FILES["file_up"]["name"] . " da ton tai file tren server. ";
      }
    else
      {  
      move_uploaded_file($_FILES["file_up"]["tmp_name"],
      "upload/images/Logo/" . $_FILES["file_up"]["name"]);    
      }
    }
?> 
<br />
<?php
    $link = "upload/images/Logo/" . $_FILES["file_up"]["name"];      
    echo "Duong link cua file la: $link <br />";    
    echo "Ten File: " . $_FILES["file_up"]["name"] . "<br />";
    echo "Type: " . $_FILES["file_up"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file_up"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file_up"]["tmp_name"] . "<br />";
?>
<br />
<img src="<?php echo $link; ?>" width="100" />
<br />
</body>
</html>
 


Read more: http://hocthietkeweb.org/hoc-thiet-ke-web-o-dau-tot-nhat-huong-dan-lap-trinh-code-php-upload-files-anh-len-server/#ixzz3LEaH5XmM