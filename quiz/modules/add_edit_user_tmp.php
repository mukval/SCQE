<?php if(!isset($RUN)) { exit(); } ?>
<script language="JavaScript" type="text/javascript" src="lib/validations.js"></script>
<?php echo $val->DrowJsArrays(); ?>

<form method="post" name="form1">

<table class="desc_text">
    <tr>
        <td width="100px">Имя : </td>
        <td><input type="textbox" id="txtName" name="txtName" value="<?php echo util::GetData("txtName") ?>" /></td>
    </tr>
    <tr>
        <td>Фамилия : </td>
        <td><input type="textbox" id="txtSurname" name="txtSurname" value="<?php echo util::GetData("txtSurname") ?>" /></td>
    </tr>
    <tr>
        <td>Email : </td>
        <td><input type="textbox" id="txtEmail" name="txtEmail" value="<?php echo util::GetData("txtEmail") ?>"  /></td>
    </tr>
    <tr>
        <td>Тип юзера : </td>
        <td>
            <select id="drpUserType" name="drpUserType">
                <?php echo $user_type_options ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Логин : </td>
        <td><input <?php echo $login_disabled ?> type="textbox" id="txtLogin" name="txtLogin" value="<?php echo util::GetData("txtLogin") ?>" /></td>
    </tr>
     <tr>
        <td>Пароль : </td>
        <td>
            
            <input style="display:<?php echo $psw_display ?>" type="textbox" id="txtPassword" name="txtPassword" value="<?php echo util::GetData("txtPasswordValue") ?>" />
                
                <label style="display:<?php echo $pswlbl_display ?>" id="lblPsw">******** </label><input type="checkbox" name="chkEdit" id="chkEdit" onclick="ProcessPasswordField()" style="display:<?php echo $pswlbl_display ?>"  /><label style="display:<?php echo $pswlbl_display ?>" for="chkEdit">Edit</label>
                
            
        </td>
    </tr>
    <tr>
        <td><br></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <input class="st_button" type="submit" name="btnSave" value="Сохранить" id="btnSave" onclick="return checkform();" />
            <input class="st_button" type="button" name="btnCancel" value="Отмена" id="btnCancel" onclick="javascript:window.location.href='?module=local_users'" />
        </td>
    </tr>
</table>
    <input type="hidden" id="hdnMode" value="<?php echo $mode ?>">
</form>
<script language="javascript">
function ProcessPasswordField()
{
    var checked = document.getElementById('chkEdit').checked ;
    if(checked)
    {
        document.getElementById('txtPassword').style.display="";
        document.getElementById('txtPassword').value="";
        document.getElementById('lblPsw').style.display="none";
    }
    else
    {
        document.getElementById('txtPassword').style.display="none";
        document.getElementById('txtPassword').value="********";
        document.getElementById('lblPsw').style.display="";
    }
}

function checkform()
{
    var mode = document.getElementById('hdnMode').value;

    if(mode=="edit")
    {
        return validate();
    }
    else
    {
        var user_name= document.getElementById('txtLogin').value
        var status=validate();
        if(status)
        {
             $.post("?module=add_edit_user", { login_to_check: user_name, ajax: "yes" },
             function(data){
                 if(data=="0")
                 {
                     return true;
                 }
                 else
                 {
                    alert('This login is already exists !');
                    return false;
                 }

            });
        }
        else
        {
            return false;
        }
    }
}
</script>
