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
    <h1>{uphinhcty}</h1>
    <p>&nbsp;</p>

    <p class="sort">Notice: [jpg] or [gif] format only, File size restricted to [300KB], Dimension [120px*60px]</p>
    <p>&nbsp;</p>
    <form name="form1" method="post" enctype="multipart/form-data" action="./uplogo_files/uplogo.html" onsubmit="return check();">
        <table border="0" align="center" cellpadding="0" cellspacing="0">
            <tbody><tr>
                    <td>Logo Upload: </td>
                    <td><input type="file" name="file" class="mid_text"></td>
                </tr>
            </tbody></table>
        <p class="divider">&nbsp;</p>
        <p class="align_c"><input type="Submit" name="Submit" id="Submit" value="Upload" class="btn_padding"></p>
    </form>
    <p>&nbsp;</p>
    <p class="notice"> If you have questions about Upload, please <a href="http://www.asiatiger.org/lien-he.html" target="_blank">{lienhe}</a></p>
    <p>&nbsp;</p>
</div>