<?php if(!isset($RUN)) { exit(); } ?>
<table>

<?php
while($row = db::fetch($asg_res))
{
    ?>
    <tr>
        <td>
            <hr />
        </td>
    </tr>
    <tr>
        <td>
   <?php
    echo get_question($row);
    ?>
        </td>
    </tr>
    <?php
}
?> 
    
</table>

