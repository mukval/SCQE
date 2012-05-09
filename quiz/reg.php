
<script language="JavaScript" type="text/javascript" src="lib/validations.js"></script>

<html>
<head></head>
<body bgcolor="#9B9EA5">
<form action="/q/save_user.php" method="post" >

<table style="margin-top:250;" width="500" align="center" bgcolor="#E7EEF8" >
   
   <tr></tr>
   <tr> <td align="center" colspan="2" style="color: blue;font-family: tahoma;font-size: 11px;font-weight: bold;">Введите данные для регистрации в системе</td></tr>
    <tr></tr>
   <tr>
        <td style="color: #7D848C;font-family: tahoma;font-size: 11px;font-weight: bold;" align="right" width="200px">Имя : </td>
        <td><input style="color: #7D848C;font-family: tahoma;font-size: 11px;height: 17px;width: 200px;" type="textbox" id="txtName" name="txtName" value="" /></td>
    </tr>
    <tr>
        <td style="color: #7D848C;font-family: tahoma;font-size: 11px;font-weight: bold;" align="right" >Фамилия : </td>
        <td><input style="color: #7D848C;font-family: tahoma;font-size: 11px;height: 17px;width: 200px;" type="textbox" id="txtSurname" name="txtSurname" value="" /></td>
    </tr>
    <tr>
        <td style="color: #7D848C;font-family: tahoma;font-size: 11px;font-weight: bold;" align="right" > Email : </td>
        <td><input style="color: #7D848C;font-family: tahoma;font-size: 11px;height: 17px;width: 200px;" type="textbox" id="txtEmail" name="txtEmail" value=""  /></td>
    </tr>
    
    <tr>
        <td style="color: #7D848C;font-family: tahoma;font-size: 11px;font-weight: bold;" align="right">Логин : </td>
        <td><input style="color: #7D848C;font-family: tahoma;font-size: 11px;height: 17px;width: 200px;" type="textbox" id="txtLogin" name="txtLogin" value="" /></td>
    </tr>
     <tr>
        <td style="color: #7D848C;font-family: tahoma;font-size: 11px;font-weight: bold;" align="right">Пароль : </td>
        <td>
            
            <input style="color: #7D848C;font-family: tahoma;font-size: 11px;height: 17px;width: 200px;" type="password" id="txtPassword" name="txtPassword" value="" />
 
        </td>
    </tr>
    <tr><td></td></tr>
    <tr>
        <td colspan="2" align="center">
            <input class="st_button" type="submit" name="btnSave" value="Сохранить" id="btnSave" onclick="return checkform();"/>
        
        </td>
    </tr>
	<input type="hidden" name="drpUserType" id="drpUserType" value="2	">
</table>
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
</body>
</html>