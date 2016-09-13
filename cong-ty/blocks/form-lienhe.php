<form action="" name="inquryform" method = "post" id="inquryform">
    <input name="csrf_token" value="sxvvQtsR95cxCXZReCJ+yA==" type="hidden"/>
   
    <div class="showhall-box-blank" id="">
        <div class="title">
            <h4 class="titleH">{lienhe}</h4>
        </div>
        <div class="content">
            <table cellpadding="0" cellspacing="0" class="ui-table-roof ui-table-border">
                <tbody>
                    <tr>
                        <th>
                            <span class="red">*</span>
                            {tieude}
                        </th>
                        <td>
                            <input type="text" maxlength="200" name="subject" class="w2 inputBox" value="" id="subject"/>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <span class="red">*</span>
                            {noidung}
                        </th>
                        <td>
                            <textarea rows="10" cols="53"  name="message" class="w2 inputBox" id="message" maxlength = 3000></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</form>
<div class="showhall-contactNow">
            <input type="hidden" id="hidevalue" name="hidevalue" value="pt6gvrgcj7ugl"/>
            <a rel="nofollow" id="contact" onclick="cantact()" href="javascript:void(0)" class="ui-btn ui-btn-orange"><i class="ui-icon-contactNow"></i>{lienhe}</a>
        </div>