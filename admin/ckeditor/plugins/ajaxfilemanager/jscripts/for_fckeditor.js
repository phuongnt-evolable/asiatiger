//function below added by logan (cailongqun [at] yahoo [dot] com [dot] cn) from www.phpletter.com
function selectFile(url)
{
  if(url != '')
  {
	  var uf = 2;
      window.opener.CKEDITOR.tools.callFunction(uf, url);
      window.close();
  }else
  {
     alert(noFileSelected);
  }
  

}



function cancelSelectFile()
{
  // close popup window
  window.close() ;
}