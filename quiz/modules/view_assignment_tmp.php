<?php if(!isset($RUN)) { exit(); } ?>
<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<table class="desc_text_bg">
    <tr>
        <td width="150px">
            Категория :
        </td>
        <td>
            <?php echo $cat_name ?>
        </td>
    </tr>
    <tr>
        <td>
            Тест :
        </td>
        <td>
            <?php echo $test_name ?>
        </td>
    </tr>
    <tr>
        <td>
            Тип :
        </td>
        <td>
            <?php echo $quiz_type ?>
        </td>
    </tr>
    <tr>
        <td>
            SПоказать результаты  :
        </td>
        <td>
            <?php echo $show_results ?>
        </td>
    </tr>
    <tr>
        <td>
            Результаты :
        </td>
        <td>
            <?php echo $results_by ?>
        </td>
    </tr>
    <tr>
        <td>
            Проходной балл/процент :
        </td>
        <td>
            <?php echo $pass_score ?>
        </td>
    </tr>
    <tr>
        <td>
            Время теста (в минутах)  : 
        </td>
        <td>
            <?php echo $test_time ?>
        </td>
    </tr>   
</table>

<br>
<table width="600px">
    <tr>
        <td><br></td>
    </tr>
    <tr>
       <td class="desc_text_bg2">Лакальные пользователи</td>
    </tr>
    <tr>
        <td>
<div id="divLU">
    <?php echo $grid_lu_html ?>
</div>
        </td>
    </tr>
    <tr>
        <td><br></td>
    </tr>
    <tr>
        <td class="desc_text_bg2">Импортированные пользователи</td>
    </tr>
    <tr>
        <td>
<div id="divIU">
    <?php echo $grid_iu_html ?>
</div>
        </td>
    </tr>
</table>


<br>


