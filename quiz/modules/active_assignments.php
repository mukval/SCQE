<?php if(!isset($RUN)) { exit(); } ?>
<?php

 access::allow("2");

 require "grid.php";
 require "db/users_db.php";
 require "db/asg_db.php";

    $hedaers = array("Name","&nbsp;");
    $columns = array("quiz_name"=>"text");

    $grd = new grid($hedaers,$columns, "index.php?module=active_assignments");

    $grd->process_html_command="process_quiz_status";

    function process_quiz_status($row)
    {
        $html ="";        
        if(intval($row['user_quiz_status'])<2)
        {
            $html.="<td><a href='?module=show_intro&id=".$row['asg_id']."'>Start</a></td>";
        }
        else
        {
            $html.="<td>You have already finished this quiz/survey</td>";
        }
        return $html;
    }

    //$grd->edit_link="index.php?module=add_edit_quiz";

    //$grd->id_links=(array("Start"=>"?module=show_intro"));
    //$grd->id_link_checks = array("");
    $grd->id_column="asg_id";

    $grd->edit=false;
    $grd->delete=false;
    $grd->empty_data_text="Активных Назначений не найдено";

    $user_id = $_SESSION['user_id'];
    $query = asgDB::GetActAsgByUserIDQuery($user_id);
    
    $grd->DrowTable($query);
    $grid_html = $grd->table;

    if(isset($_POST["ajax"]))
    {
         echo $grid_html;
    }

    function desc_func()
    {
        return "Активные Назначения";
    }

?>
