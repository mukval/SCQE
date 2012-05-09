<?php if(!isset($RUN)) { exit(); } ?>
<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<script language="JavaScript" type="text/javascript" src="lib/validations.js"></script>

<?php echo $val->DrowJsArrays(); ?>

<script language="javascript">
    function ChangeCat()
    {
        var id = querySt("id") !="-1" ? "&id="+querySt("id") : "";        
        var p_cat_id =$("#drpCats").val();        
         $.post("index.php?module=add_assignment"+id, {  ajax: "yes", fill_tests : "yes", cat_id : p_cat_id },
         function(data){             
             document.getElementById('tdTests').innerHTML=data;
             document.getElementById('drpTests').style.width="150px";
        });
    }

    function ShowUsers(type)
    {
        if(type=='local')
        {            
            document.getElementById('tdLocalUsers').style.display="";
            document.getElementById('tdImportedUsers').style.display="none";            
            document.getElementById('btnLcl').style.color="red";
            document.getElementById('btnImp').style.color="black";
        }
        else
        {
            document.getElementById('tdLocalUsers').style.display="none";
            document.getElementById('tdImportedUsers').style.display="";
            document.getElementById('btnLcl').style.color="black";
            document.getElementById('btnImp').style.color="red";
        }
    }

    function CheckForm()
    {        
        return validate();
    }

    function ShowOptions()
    {
        var type = getType();
        var display = "none";
        if(type=="1") display="";
        else
        {
            document.getElementById('txtSuccessP').value="0";
            document.getElementById('txtTestTime').value="0";
        }

        for(var i=0;i<4;i++)
        {
            document.getElementById("drpTr"+i).style.display=display;
        }        
    }

    function getType()
    {
        var type = document.getElementById('drpType').options[document.getElementById('drpType').selectedIndex].value;
        return type;
    }

</script>

<form id="form1" method="post">    
    <table width="400px">
        <tr>
            <td class="desc_text" width="170px">
                <label class="desc_text">Категория :</label>
            </td>
            <td>
                 <select style="width:150px" id="drpCats" name="drpCats" onchange="ChangeCat()">
                <?php echo $cat_options ?>
                </select>
            </td>
        </tr>
         <tr>
            <td class="text_desc">
                <label class="desc_text">Тест :</label>
            </td>
            <td id="tdTests">
                 <select style="width:150px" id="drpTests" name="drpTests">
                     <option value="-1">Not Selected</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class="text_desc">
                <label class="desc_text">Тип :</label>
            </td>
            <td>
                 <select style="width:150px" id="drpType" name="drpType" onchange="ShowOptions()">
                     <?php echo $type_options ?>
                </select>
            </td>
        </tr>
           <tr id="drpTr0">
            <td class="text_desc">
               <label class="desc_text">Показать результаты :</label>
            </td>
            <td>
                 <select style="width:150px" id="drpShowRes" name="drpShowRes">
                     <?php echo $showres_options ?>
                </select>
            </td>
        </tr>
          <tr id="drpTr1">
            <td class="text_desc">
                <label class="desc_text">Результаты :</label>
            </td>
            <td>
                 <select style="width:150px"  id="drpResultsBy" name="drpResultsBy">
                     <?php echo $result_options ?>
                </select>
            </td>
        </tr>
             <tr id="drpTr2">
            <td class="text_desc">
                <label class="desc_text">Проходной балл/процент  :</label>
            </td>
            <td>
                 <input style="width:50px" type="text" name="txtSuccessP" id="txtSuccessP" value="<?php echo util::GetData("txtSuccessP") ?>"  />
            </td>
        </tr>
               <tr id="drpTr3">
            <td class="text_desc">
                <label class="desc_text">Время теста (в минутах) :</label>
            </td>
            <td>
                 <input style="width:50px"  type="text" name="txtTestTime" id="txtTestTime" value="<?php echo util::GetData("txtTestTime") ?>"  />
            </td>
        </tr>
    </table>

    <br>
    <hr />
    <table width="500">
        <tr>
            <td colspan="2">
                <input id="btnLcl" type="button" onclick="ShowUsers('local')" value="Local users" style="border:0;width:150px;color:red" />&nbsp;<input id="btnImp" type="button" onclick="ShowUsers('imported')" value="Imported users" style="border:0;width:150px" />
            </td>            
        </tr>
        <tr>
            <td valign="top" id="tdLocalUsers">
                 <div id="div_grid"><?php echo $grid_html ?></div>
            </td>
            <td valign="top" id="tdImportedUsers" style="display:none">
                    <div id="div_grid"><?php echo $imported_grid_html ?></div>
            </td>
        </tr>
    </table>
    <br>
    <hr>
    <table>
        <tr>
            <td><input onclick="return CheckForm()" style="width:100px" type="submit" id="btnSave" name="btnSave" value="Сохранить" /></td>
            <td><input onclick="javascript:window.location.href='index.php?module=assignments'" style="width:100px" type="button" id="btnCancel" name="btnCancel" value="Отмена" /></td>
        </tr>
    </table>
</form>
<script language="javascript">
    ChangeCat();
    ShowOptions();
</script>
