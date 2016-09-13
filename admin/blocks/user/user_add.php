<?php
if (isset($_POST['btnSubmit'])) {
    $u->user_them();
    header("location:index.php?com=user_list");
}
?>
<form action="" method="post" name="form_add_dm_ks">
    <div>
        <div>
            <h3>Manage User : add new</h3>
        </div>
        <div class="clr"></div>
    </div>
    <div id="main_admin">

        <div id="main_left">

            <table>
                <tr class="left">
                    <td width="150px">Group</td>
                    <td>
                        <select name='group' id="group">
                            <option value='0'>Chosse group</option>
                            <option value='1'>Editor</option>
                            <option value='2'>Admin</option>
                        </select>
                    </td>
                </tr>
                <tr class="left">
                    <td>Full name:</td>
                    <td><input type="text" name="fullname" id="fullname" class="tf" style="width: 300px" />
                    </td>
                </tr>
                <tr class="left">
                    <td>Email:</td>
                    <td><input type="text" name="email" id="email" class="tf" style="width: 300px"/>                        
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                        <td>
                                              
                            <input type="submit" class="save" name="btnSubmit" value="Save"/>		                               

                            <input type="reset" class="cancel" name="btnCancel" value="Reset"/>                                                      

                    
                            </td>

                </tr>  


            </table>
        </div>


        <div class="clr"></div>
    </div>
</form>