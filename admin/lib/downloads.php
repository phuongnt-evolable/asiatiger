<?php
/*
* http://vn2.php.net/readfile
*
* ham download file
*
* input: ten file nguon
* input: ten file trả về khi download
* input: kiểu file
*/

/*
If you use session and Secure Site(SSL- Secure Sockets Layer) to download files using PHP function readfile(), You can get an error message for Inetrnet Explorer (IE).
To avoid this problem try following function.
Hope it can help you. By, sohel62 at yahoo dot com.

session_cache_limiter('none'); //*Use before session_start()
session_start();
*/
function smartReadFile($location, $filename, $mimeType='application/octet-stream')
{ 
	if(!file_exists($location))
  { header ("HTTP/1.0 404 Not Found");
    return;
  }
 
  $size=filesize($location);
  $time=date('r',filemtime($location));
 
  $fm=@fopen($location,'rb');
  if(!$fm)
  { header ("HTTP/1.0 505 Internal server error");
    return;
  }
 
  $begin=0;
  $end=$size;
 
  if(isset($_SERVER['HTTP_RANGE']))
  { if(preg_match('/bytes=\h*(\d+)-(\d*)[\D.*]?/i', $_SERVER['HTTP_RANGE'], $matches))
    { $begin=intval($matches[0]);
      if(!empty($matches[1]))
        $end=intval($matches[1]);
    }
  }
 
  if($begin>0||$end<$size)
    header('HTTP/1.0 206 Partial Content');
  else
    header('HTTP/1.0 200 OK'); 
 
  header("Content-Type: $mimeType");
  header('Cache-Control: public, must-revalidate, max-age=0');
  header('Pragma: no-cache'); 
  header('Accept-Ranges: bytes');
  header('Content-Length:'.($end-$begin));
  header("Content-Range: bytes $begin-$end/$size");
  header("Content-Disposition: inline; filename=$filename");
  header("Content-Transfer-Encoding: binary\n");
  header("Last-Modified: $time");
  header('Connection: close'); 
 
  $cur=$begin;
  fseek($fm,$begin,0);

  while(!feof($fm) && $cur<$end && (connection_status()==0))
  { print fread($fm,min(1024*16,$end-$cur));
    $cur+=1024*16;
  }
}

/*
*	http://vn2.php.net/readfile
*
* input: ten file nguồn
*/
function downloadFile($file){
	if (file_exists($file)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($file));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		set_time_limit(0); // for a slow connection.
		ob_clean();
		flush();
		readfile($file);
		exit;
	}else{
		header ("HTTP/1.0 404 Not Found");
		return;
	}
}
?>