<?php if(!isset($RUN)) { exit(); } ?>
<?php

access::allow("1");

    require "grid.php";
    require "db/quiz_db.php";

    $hedaers = array("Название", "Описание", "Дата","Вопросы","&nbsp;","&nbsp;");
    $columns = array("quiz_name"=>"text", "quiz_desc"=>"text","added_date"=>"short date");

    $grd = new grid($hedaers,$columns, "index.php?module=quizzes");
    $grd->edit_link="index.php?module=add_edit_quiz";
    
    $grd->id_links=(array("Вопросы"=>"?module=questions"));
    $grd->id_link_key="quiz_id";

    if($grd->IsClickedBtnDelete())
    {
       quizDB::DeleteQuizById($grd->process_id);
    }
      
    $query = quizDB::GetQuizQuery();
    $grd->DrowTable($query);
    $grid_html = $grd->table;

    if(isset($_POST["ajax"]))
    {
         echo $grid_html;
    }

    function desc_func()
    {
        return "Тесты";
    }

?>
