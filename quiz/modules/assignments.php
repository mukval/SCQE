<?php if(!isset($RUN)) { exit(); } ?>
<?php

access::allow("1");

    require "grid.php";
    require "db/asg_db.php";

    $hedaers = array("Название", "Дата", "&nbsp;","&nbsp;","&nbsp;","&nbsp;","&nbsp;");
    $columns = array("quiz_name"=>"text", "added_date"=>"short date");

    $grd = new grid($hedaers,$columns, "index.php?module=assignments");
    $grd->edit_link="index.php?module=add_assignment";

    $grd->commands=array("Начать"=>"start");
    $grd->process_command_override="grd_process_command_override";
    //$grd->edit_attr_override = "grd_ovverride_edit_attr";
    $grd->edit_link_override = "grd_ovverride_edit_link";

    //$grd->id_links=(array("Information"=>"?module=view_assignment", "Reports"=>"?module=reports"));
    $grd->id_links=(array("Информация"=>"?module=view_assignment"));
    $grd->id_link_key="asg_id";    

    if($grd->IsClickedBtnDelete())
    {
        asgDB::DeleteAsgById($grd->process_id);        
    }

    if($grd->IsClickedBtn("start"))
    {
        asgDB::ChangeStat("1", $grd->process_id);
    }

    if($grd->IsClickedBtn("stop"))
    {
        asgDB::ChangeStat("2", $grd->process_id);

        $res_uq = db::exec_sql(orm::GetSelectQuery("user_quizzes", array(), array("assignment_id"=>$grd->process_id, "status"=>"1"), ""));

        while($row_uq=db::fetch($res_uq))
        {
            asgDB::UpdateUserQuiz($row_uq['id'], "4");
        }

    }

    function grd_ovverride_edit_link($row)
    {
        global $grd;
        if(intval($row['status'])>0)
        {
            return "&nbsp;";
        }
        else
        {
            return grid::EditCommandTemplate($row, $grd);
        }
    }

  //  function grd_ovverride_edit_attr($row)
  //  {
   //     if(intval($row['status'])>0)
  //      {
  //          return "onclick='return alert(\"Cannot edit assignment , because quiz/survey already started\")';return false;";
  //      }
  //  }

    function grd_process_command_override($row)
    {
        global $grd;
        if($row['status']==0)
        {
            return grid::ProcessCommandTemplate($row, "start", "Start",$grd);
        }
        else if($row['status']==1)
        {
            return grid::ProcessCommandTemplate($row, "stop", "Stop",$grd);
        }
        else 
        {
            return "<td>&nbsp;</td>";
        }
    }

    $query = asgDB::GetAsgQuery();    

    $grd->DrowTable($query);
    $grid_html = $grd->table;

    if(isset($_POST["ajax"]))
    {
         echo $grid_html;
    }

    function desc_func()
    {
        return "Назначения";
    }

?>
