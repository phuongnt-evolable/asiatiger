<?php	
require_once("../Model/Article.php");
$modelArticle = new Article;
$menu_id = $_POST['menu_id'];
$article_id = $_POST['article_id'];
?>
<style type="text/css">
table#table_list{
	width:100%;
}
table#table_list tr th{
	border: 1px solid #999;
	padding:10px;
	background-color:#CCC;
	color:#00C;
	font-weight:bold;
}
table#table_list tr td {
	border: 1px solid #CCC;
	padding:8px;
	font-weight:bold;
}
</style>
<input type="button" id="btn_add_article" value="  Save  " />
<input type="button" id="btn_cancel" value="  Cancel  " />
<br />
<div style="height:400px;overflow-y:scroll;margin-top:10px">
<input type="hidden" id="menu_id" value="<?php echo $menu_id; ?>" />
<table border="1" cellpadding="4" cellspacing="0" id="table_list">
	<thead>
    	<tr>
        	<th width="1%">&nbsp;</th>
	        <th align="left">Tiêu đề</th>        
        </tr>    	
    </thead>
    <tbody>
    	
        	<?php 
			$rs_article = $modelArticle->getListArticleByCategory(1);
			while($row=mysql_fetch_assoc($rs_article)){
			?>
            <tr <?php echo ($row['article_id'] == $article_id) ? "style='background-color:#00FFFF'" : "" ; ?>>
        	<td>
            	<input <?php echo ($row['article_id'] == $article_id) ? "checked" : "" ; ?> type="radio" value="<?php echo $row['article_id']; ?>" name="article_id" />
            </td>
            <td >
            	<?php echo $row['title']; ?>
            </td>          
        </tr>
          <?php } ?>
    </tbody>
</table>
</div>
<script type="text/javascript">
	$(function(){
		$('#btn_add_article').click(function(){
			var article_id = $('input[name="article_id"]:checked').val();
			var menu_id = $('#menu_id').val();
			$.ajax({
				url: "ajax/add_article.php",
				type: "POST",
				async: false,
				data: {"article_id":article_id,"menu_id" : menu_id},
				success: function(data){
					$("#article_list").dialog('close');
					window.location.reload();
				}
			});
		});	
	});
</script>
