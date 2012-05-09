<?php if(!isset($RUN)) { exit(); } ?>
<?php

access::allow("2");

    require "grid.php";
    require "db/asg_db.php";

    $columns_quiz = array("quiz_name"=>"text", "added_date"=>"text","finish_date"=>"text","is_success"=>"text","pass_score"=>"text","total_point"=>"text");
    $headers_quiz = array("Quiz/Survey name","Start date","Finish date","Success","Pass score","Total point");

    $query = asgDB::GetOldAssignmentsQuery($_SESSION['user_id'],1);
    $grd_quiz = new grid($headers_quiz,$columns_quiz, "index.php?module=old_assignments");
    $grd_quiz->edit=false;
    $grd_quiz->delete=false;
    $grd_quiz->DrowTable($query);
    $grid_quiz_html = $grd_quiz->table;


    $columns_surv = array("quiz_name"=>"text", "added_date"=>"text","finish_date"=>"text");
    $headers_surv = array("Quiz/Survey name","Start date","Finish date");

    $query = asgDB::GetOldAssignmentsQuery($_SESSION['user_id'],2);
    $grd_surv = new grid($headers_surv,$columns_surv, "index.php?module=old_assignments");
    $grd_surv->edit=false;
    $grd_surv->delete=false;
    $grd_surv->DrowTable($query);
    $grid_surv_html = $grd_surv->table;

    function desc_func()
    {
        return "Old assignments";
    }
?>
