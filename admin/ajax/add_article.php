<?php	
require_once("../Model/Article.php");
$modelArticle = new Article;
$menu_id = $_POST['menu_id'];
$article_id = $_POST['article_id'];
$rs = $modelArticle->addArticleToMenu($menu_id,$article_id);
?>