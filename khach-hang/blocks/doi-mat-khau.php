<?php
    $idUser=$_SESSION["idUser"];
    $pass_cu=$_SESSION["Password"];
?>
<form method="post" name="thisform" action="#" >
    <div id="right">
        <h1>{doimatkhau}</h1>
        <p>&nbsp;</p>
        <table border="0" align="center" cellpadding="0" cellspacing="0" class="form_table">
            <tbody><tr>
                    <td align="right">{passcu}:</td>
                    <td><input name="oldpw" type="password" class="mid_text" id="oldpw" maxlength="15"></td>
                    <td><span id="ktpasscu"></span></td>
                </tr>
                <tr>
                    <td align="right">{passmoi}:</td>
                    <td><input name="newpw" type="password" class="mid_text" id="newpw" maxlength="15" ></td>
                </tr>
                <tr>
                    <td align="right">{nhaplaipass}:</td>
                    <td><input name="confirmpw" type="password" class="mid_text" id="confirmpw" maxlength="15" ></td>
                    <td><span id="ktpassnhaplai"></span></td>
                </tr>
            </tbody></table>
        <p>&nbsp;</p>
        <p class="align_c">
            <input type="button" name="Submit" id="btnDoiMatKhau" value="{capnhat}" class="btn_padding">
            <input type="hidden" name="lang" id="lang" value="<?php echo $lang;?>" class="btn_padding">
            <input type="hidden" name="idUser" id="idUser" value="<?php echo $idUser;?>" class="btn_padding">
        </p>
    </div>
</form>