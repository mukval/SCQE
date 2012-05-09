<?php if(!isset($RUN)) { exit(); } ?>
<?php

access::allow("1");

 require "grid.php";
 require "db/asg_db.php";

 $asg_id=util::GetKeyID("asg_id", "?module=assignments");

 $asg_res = asgDB::GetAsgById($asg_id);

 if(db::num_rows($asg_res)==0)
 {
     die("This assignment cannot be find ");
 }

 $row=db::fetch($asg_res);

 $cat_name=$row['cat_name'];
 $test_name=$row['quiz_name'];
 $quiz_type=$row['quiz_type']=="1" ? "Тест" : "Опрос";
 $show_results=$row['show_results']=="1" ? "Да" : "Нет";
 $results_by=$row['results_mode'] == "1" ? "Балл" : "Процент";
 $pass_score=$row['pass_score'];
 $test_time=$row['quiz_time'];

 $hedaers = array("User ID", "Имя", "Фамилия","Логин","Статус","Удачно","Собранный балл/процент","&nbsp;");
 $columns = array("user_id"=>"text", "Name"=>"text","Surname"=>"text","UserName"=>"text","status_name"=>"text","is_success"=>"text","total_point"=>"text");

 $grd = new grid($hedaers,$columns, "index.php?module=view_assginments");
 $grd->edit=false;
 $grd->delete=false;

 $grd->id_links=(array("Details"=>"?module=view_details"));
 $grd->id_link_key="user_quiz_id";
 $grd->id_column="user_quiz_id";


 $query = asgDB::GetUserResultsQuery($asg_id, 1);
 $grd->DrowTable($query);
 $grid_lu_html = $grd->table;

 
 $grd_iu = new grid($hedaers,$columns, "index.php?module=view_assginments");
 $grd_iu->edit=false;
 $grd_iu->delete=false;

 $grd_iu->id_links=(array("Details"=>"?module=view_details"));
 $grd_iu->id_link_key="user_quiz_id";
 $grd_iu->id_column="user_quiz_id";


 $query = asgDB::GetUserResultsQuery($asg_id, 2);
 $grd_iu->DrowTable($query);
 $grid_iu_html = $grd_iu->table;

 function desc_func()
    {
        return "View assignment";
    }

?>
