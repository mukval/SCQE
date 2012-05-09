<?php if(!isset($RUN)) { exit(); } ?>
<?php

access::allow("1");

    require "grid.php";
    require "db/questions_db.php";

    $quiz_id = util::GetKeyID("quiz_id", "index.php?module=quizzes");

    $hedaers = array("Вопрос", "Тип", "Балл","Дата","&nbsp;","&nbsp;","&nbsp;","&nbsp;");
    $columns = array("question_text"=>"text","question_type"=>"text" ,"point"=>"text","added_date"=>"short date");

    $grd = new grid($hedaers,$columns, "index.php?module=questions&quiz_id=$quiz_id");
    $grd->edit_link="index.php?module=add_question&quiz_id=$quiz_id";

    //$grd->links=(array("Questions"=>"?module=questions"));
    $grd->commands=array("Up"=>"Вверх", "Down"=>"Вниз");

    if($grd->IsClickedBtnDelete())
    {
        questions_db::DeleteQuestion($grd->process_id);        
    }

    if($grd->IsClickedBtn("up"))
    {        
        questions_db::MoveQuestion("up", $grd->process_id);        
    }

    if($grd->IsClickedBtn("down"))
    {
        questions_db::MoveQuestion("down", $grd->process_id);
    }

    $query = questions_db::GetQuestionsQuery($quiz_id);
    $grd->DrowTable($query);
    $grid_html = $grd->table;

    if(isset($_POST["ajax"]))
    {
         echo $grid_html;
    }

    function desc_func()
    {
        return "Questions";
    }

?>
