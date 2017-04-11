<?php 
require_once "Db.php";
class Home extends Db{	
	
	function getDetailImage($article_id){
		$sql = "SELECT * FROM product WHERE product_id = $article_id";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function getImageByCate($category_id,$offset,$limit){
		$arrResult=array();
		$sql = "SELECT * FROM hinhanh_home WHERE idLoaiHinh = $category_id ORDER BY idHinh DESC";
                if($limit > 0 && $offset >=0)  $sql .= " LIMIT $offset,$limit";		
		 $rs = mysql_query($sql) or die(mysql_error());	
		while($row = mysql_fetch_assoc($rs)){
                $arrResult[] = $row;
               }
                //var_dump("<pre>",$arrResult);die;
               return $arrResult;
	}

	function getImageByCateRightHome($category_id,$offset,$limit){
		$arrResult=array();
		$sql = "SELECT * FROM hinhanh_home WHERE idLoaiHinh = $category_id AND show_home = 1 ORDER BY idHinh DESC";
		if($limit > 0 && $offset >=0)  $sql .= " LIMIT $offset,$limit";
		$rs = mysql_query($sql) or die(mysql_error());
		while($row = mysql_fetch_assoc($rs)){
			$arrResult[] = $row;
		}
		//var_dump("<pre>",$arrResult);die;
		return $arrResult;
	}

        function getDetailArticle($article_id){
		$sql = "SELECT * FROM article WHERE article_id = $article_id";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
        function getListCate($parent_id = -1 ) {
            $sql = "SELECT * FROM category WHERE parent_id = $parent_id or $parent_id = -1 ORDER BY cate_id";
            $rs = mysql_query($sql) or die(mysql_error());
            return $rs;
        }
	function menu_list($type=-1){
		$sql = "SELECT * FROM menu WHERE type = $type OR $type=-1 ORDER BY menu_id ASC";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}	
	function getBlockContent($block_id){
		$sql = "SELECT block_content FROM blocks WHERE block_id = $block_id";
		$rs = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($rs);
		return $row['block_content'];
	}
	function getMenuIdByAlias($menu_alias){
		$sql = "SELECT menu_id FROM menu WHERE menu_alias = '$menu_alias'";
		$rs = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($rs);
		return $row['menu_id'];
	}
        function getDetailCateByAlias($cate_alias){
		$sql = "SELECT * FROM category WHERE cate_alias = '$cate_alias'";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function getDetailMenuByAlias($menu_alias){
		$sql = "SELECT * FROM menu WHERE menu_alias = '$menu_alias'";
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function getListArticleByCategory($category_id=-1,$offset=-1,$limit=-1){
		$sql = "SELECT * FROM article WHERE category_id = $category_id OR $category_id = -1";
		if($limit > 0 && $offset >=0) $sql .= " LIMIT $offset,$limit";		
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
        function getListImageByCategoryNew($getby,$category_id=-1,$offset=-1,$limit=-1){
		$sql = "SELECT * FROM product WHERE $getby = $category_id OR $category_id = -1";
		if($limit > 0 && $offset >=0) $sql .= " LIMIT $offset,$limit";		  
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
        function getListImageSlider(){
		$sql = "SELECT * FROM product ORDER BY RAND() LIMIT 0,10";		  
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
        function getListImageHot(){
		$sql = "SELECT * FROM product WHERE is_hot = 1 ORDER BY product_id DESC LIMIT 0,12";		  
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function getListArticleByCategoryNew($category_id=-1,$offset=-1,$limit=-1){
		$sql = "SELECT * FROM article WHERE category_id = $category_id OR $category_id = -1 ORDER BY article_id DESC ";
		if($limit > 0 && $offset >=0) $sql .= " LIMIT $offset,$limit";		
		$rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function getNewsRelated($article_id){
		$sql = "SELECT * FROM article WHERE category_id = 2 AND article_id <> $article_id ORDER BY article_id DESC LIMIT 0,5";
		$rs = mysql_query($sql);
		return $rs;
	}
	function getNewsHome(){
		$sql = "SELECT * FROM article WHERE category_id = 2 ORDER BY article_id DESC LIMIT 0,4";
		$rs = mysql_query($sql);
		return $rs;
	}
        function getHinhAnhHome(){
		$sql = "SELECT * FROM hinhanh_home ORDER BY RAND()";
		$rs = mysql_query($sql);
		return $rs;
	}
        function getLoaiHinh(){
		$sql = "SELECT * FROM loaihinh ORDER BY idLoaiHinh DESC";
		$rs = mysql_query($sql);
		return $rs;
	}
        function getDetailImageHome($idHinh) {
            $sql = "SELECT * FROM hinhanh_home WHERE idHinh = $idHinh";
            $rs = mysql_query($sql) or die(mysql_error());
            return $rs;
        }
        function insertImage() {           
            $url_images = $this->processData($_POST['url_images']);            
            $href = $_POST['href'];
            $idloaihinh = $_POST['idLoaiHinh']; 
            $tencty = $_POST['tencty'];
            $ten_alias = $this->changeTitle($tencty);
            $sql = "INSERT INTO hinhanh_home	VALUES(NULL,'$idloaihinh','$url_images','$href','$tencty','$ten_alias')";
            mysql_query($sql) or die(mysql_error() . $sql);
        }

        function updateImage($idHinh) {
            $url_images = $this->processData($_POST['url_images']);
            $idloaihinh = $_POST['idLoaiHinh'];
            $href = $_POST['href'];
            $tencty = $_POST['tencty'];
            $ten_alias = $this->changeTitle($tencty);
            $sql = "UPDATE hinhanh_home
                    SET Url='$url_images',Href='$href',TenCT='$tencty',ten_alias='$ten_alias',idLoaiHinh='$idloaihinh'
                    WHERE idHinh = $idHinh ";
            mysql_query($sql) or die(mysql_error() . $sql);
        }
		 public function getArrIdCateByIdHinh($id_hinh){
			 $sql = "SELECT * FROM hinhanh_cate WHERE id_hinh = $id_hinh ";

			 $result = mysql_query($sql) or die(mysql_error() . $sql);

			 $count = mysql_num_rows($result);
			 if($count > 0){
				 while($row = mysql_fetch_assoc($result)){
					 $id_cate[] = $row['cate_id'];
				 }
				 return $id_cate;
			 }else{
				 return $id_cate = array();
			 }

		 }

		public function getCateByCateId($cate_id){
			$sql = "SELECT cate_name_vi FROM category WHERE cate_id = $cate_id ";
			$result = mysql_query($sql) or die(mysql_error() . $sql);
			while($row = mysql_fetch_assoc($result)){
				$cate_name_vi = $row['cate_name_vi'];
			}
			return $cate_name_vi;
		}

		public function getIdHinhByCateId($cate_id){
			$sql = "SELECT * FROM hinhanh_cate WHERE cate_id = $cate_id ";

			$result = mysql_query($sql) or die(mysql_error() . $sql);

			$count = mysql_num_rows($result);
			if($count > 0){
				while($row = mysql_fetch_assoc($result)){
					$id_hinh[] = $row['id_hinh'];
				}
				return $id_hinh;
			}else{
				return $id_hinh = array();
			}
		}

		public function getIdHinhByIdTheLoai($idTL){
			$sql = "SELECT * FROM hinhanh_cate WHERE idTL = $idTL GROUP BY  id_hinh ORDER BY id DESC  ";

			$result = mysql_query($sql) or die(mysql_error() . $sql);

			$count = mysql_num_rows($result);
			if($count > 0){
				while($row = mysql_fetch_assoc($result)){
					$id_hinh[] = $row['id_hinh'];
				}
				return $id_hinh;
			}else{
				return $id_hinh = array();
			}
		}

		public function getIdHinhRightHome($category_id,$offset,$limit){
			
			$sql = "SELECT * FROM hinhanh_home WHERE idLoaiHinh = $category_id AND show_home = 1 ORDER BY idHinh DESC";

			if($limit > 0 && $offset >=0)  $sql .= " LIMIT $offset,$limit";
			$rs = mysql_query($sql) or die(mysql_error());
			
			$count = mysql_num_rows($rs);
			if($count > 0){
				while($row = mysql_fetch_assoc($rs)){
					$id_hinh[] = $row['idHinh'];
				}
				return $id_hinh;
			}else{
				return $id_hinh = array();
			}
		}

		function getDetailImageHomeByIdHinh($idHinh) {
			$sql = "SELECT * FROM hinhanh_home WHERE idHinh = $idHinh";
			$rs = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($rs);
			return $row;
		}
}

?>