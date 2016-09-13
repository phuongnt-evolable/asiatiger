
<div class="span780-heading"></div>
<div class="span780-content">


    <div class="showhall-box-blank" id="rbox-contactInfo">
        <div class="title">
            <h4 class="titleH">{lienhe}</h4>
        </div>


        <div class="content">
            <form action="/inquiry/contactus" name="inquryform" method="post" id="inquryform">
                <input name="csrf_token" value="VMsO9O2RBEabYh2CEOcarA==" type="hidden"/>

                <input type ="hidden" name="type" value="COM"/>
                <input type ="hidden" name="recId"  value="pt6gvrgcj7ugl"/>
                <input type ="hidden" name="comIds"  value="pt6gvrgcj7ugl"/>
                <table cellspacing="0" cellpadding="0" class="ui-table-border ui-table-roof">
                    <thead>
                        <tr>
                            <td colspan="3"><h5>{ttct}</h5></td>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <th>
                                {diachi}
                            </th>
                            <td colspan="2">
                                <?php echo $row_cty['DiaChi_'.$lang]; ?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                {dienthoai}
                            </th>
                            <td colspan="2">
                                <?php echo $row_cty['DienThoai']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {fax}
                            </th>
                            <td colspan="2">
                                <?php echo $row_cty['Fax']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {website}
                            </th>
                            <td colspan="2">
                                <a ref="nofollow" href="http://www.<?php echo $website; ?>" target="_blank">http://www.<?php echo $website; ?></a>

                            </td>
                        </tr>
                    </tbody>



                    <tbody>
                        <tr>
                            <th>
                                {nguoilienhe}
                            </th>
                            <td  colspan="2" >
                                <?php echo $row_cty['NguoiLienHe']; ?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                {didong}
                            </th>
                            <td  colspan="2" >
                                <?php echo $row_cty['DiDong']; ?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                {email}
                            </th>
                            <td  colspan="2" >
                                <?php echo $row_cty['Email']; ?>
                            </td>
                        </tr>
                    </tbody>

                    <thead>
                        <tr>
                            <td colspan="3">
                                <h5>{lienhe}</h5>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                <span class="red">*</span>{tieude}
                            </th>
                            <td colspan="2">
                                <input type="text" maxlength=200 name="subject" class="w2 inputBox" id="subject"/>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <span class="red">*</span>{noidung}
                            </th>
                            <td colspan="2">
                                <textarea rows="10" cols="53"  name="message" class="w2 inputBox" id="message" maxlength=3000></textarea>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <div class="showhall-contactNow">
        <a rel="nofollow" onclick="cantact();" href="javascript:void(0);return false;" class="ui-btn ui-btn-orange">{gui}</a>
    </div>



</div>
