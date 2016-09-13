<?php
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$d = new database($config['database']);
	switch($com){
	
		case 'user':
			$source = "user";
			$template1 ="login";
			break;
	
		case 'about':
			$source = "about";
			$template = "about";
			$title = "Giới thiệu";			
			break;
		
		case 'promotion':
			$source = "promotion";
			$template = isset($_GET['id']) ? "promotion_detail" : "promotion";
			break;
		case 'product':
			$source = "product";
			if(isset($_GET[ten_loai_kd]) && !isset($_GET[ten_sp_kd])){
				$template= "product";
				$title = $d->GetTitle("table_product_item",$_GET[ten_loai_kd]);
				$descs =$d->GetDesc("table_product_item",$_GET[ten_loai_kd]);
				$keys= $d->GetKeys("table_product_item",$_GET[ten_loai_kd]);
			}
			if(isset($_GET['ten_sp_kd'])){
				$template = "product_detail";
				$title = $d->GetTitle("table_product",$_GET[ten_sp_kd]);
				$descs =$d->GetDesc("table_product",$_GET[ten_sp_kd]);
				$keys= $d->GetKeys("table_product",$_GET[ten_sp_kd]);
			}
			if(!isset($_GET[ten_loai_kd]) && !isset($_GET[ten_sp_kd]))
			{
				$template= "product";
				$title= "Sản phẩm tại cửa hàng Điện Quang";
				$descs = "Các sản phẩn cửa hàng Điện Quang cung cấp : máy nén khí , máy phát điện...";
				$keys= "sản phẩm,cung cấp máy phát điện,cung cấp máy phát khí,máy nén khí ,cửa hàng Điện Quang";
			}
			break;
		
		case 'search':
			$source = "search";
			$template = "search";
			break;
		case 'bds':
			$source = "bds";
			$template = "bds";
			$title ="Dịch vụ";
			$descs = "Dịch vụ cho thuê máy nén khí tại cửa hàng Điện Quang";
			$keys = "cho thuê máy nén khí,máy nén khí,may phát điện";
			break;
		case 'bando':
			$source = "bando";
			$template = "bando";
			$title = "Bản đồ";
			$descs ="Bản đồ vị trí cửa hàng Điện Quang";
			$keys = "điện quang,cửa hàng điện quang,bản đồ địa điểm";
			break;

		case 'codition':
			$source = "dieukien";
			$template = "dieukien";
			break;
		
		case 'news':
			$source = "news";			
			if(isset($_GET['ten_kd'])){
				$template = "news_detail";
				$title = $d->GetTitle("table_news",$_GET[ten_kd]);
				$descs =$d->GetDesc("table_news",$_GET[ten_kd]);
				$keys= $d->GetKeys("table_news",$_GET[ten_kd]);
			}else{
				$template= "news";
				$title= "Tin tức và sự kiện";
				$descs = "Tin tức và một số kinh nghiệm về sử dụng máy nén khí";
				$keys= "tin tức,hướng dẫn,máy nén khí ,cửa hàng Điện Quang";
			}
			break;

		case 'project':
			$source = "project";
				$template = isset($_GET['id']) ? "project_detail" : "project";
			break;

		case 'homesampo':
			$source = "nhamau";
				$template = isset($_GET['id']) ? "nhamau_detail" : "nhamau";
			break;
		
		case 'funiture':
			$source = "noithat";
			$template =isset($_GET['id']) ? "noithat_detail" : "noithat";
			break;
		
		case 'service':
			$source = "service";
			$template =isset($_GET['id']) ? "service_detail" : "service";
			break;

		case 'housing':
			$source = "nhadat";
			$template =isset($_GET['id']) ? "nhadat_detail" : "nhadat";
			break;
		
		case 'contact':
			$source = "contact";
			$template = "contact";
			$title= "Liên hệ";
			$descs = "Khách hàng liên hệ hợp tác qua email với cửa hàng Điện Quang";
			$keys= "liên hệ,hợp tác,máy nén khí ,cửa hàng Điện Quang";
			break;


		case 'knews':
			$source = "cauhoi";
			$template =isset($_GET['id']) ? "cauhoi_detail" : "cauhoi";
			break;
		
		case 'fag':
			$source = "fag";
			$template ="fag_detail";
			break;
		
		default: 
			$source = "index";
			$template = "index";
			$title= "Máy nén khí | May nen khi | Cửa hàng Điện Quang";
			$descs = "Cửa hàng Điện Quang chuyên mua bán,cho thuê máy nén khí, máy phát điện uy tín - chất lượng ";
			$keys= "cho thuê máy nén khí,máy phát điện,máy nén khí ,cửa hàng Điện Quang";
			break;
	}
	
	if($source!="") include _source.$source.".php";
	if($_REQUEST['com']=='logout')
	{
	session_unregister($login_name);
	header("Location:index.php");
	}
	$sql_title = "select ten from #_title limit 0,1";
	$d->query($sql_title);
	$row_title= $d->fetch_array();
	#  lay meta tim kiem
	$sql_meta = "select ten from #_meta limit 0,1";
	$d->query($sql_meta);
	$row_meta= $d->fetch_array();	
?>