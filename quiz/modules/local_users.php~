<?php if(!isset($RUN)) { exit(); } ?>
<?php

access::allow("1");

    require "grid.php";
    require "db/users_db.php";

    $hedaers = array("Login",  "Name","Surname","Added date","User type", "Email","&nbsp;","&nbsp;");
    $columns = array("UserName"=>"text", "Name"=>"text","Surname"=>"Surname","added_date"=>"short date","type_name"=>"text","email"=>"text");

    $grd = new grid($hedaers,$columns, "index.php?module=local_users");
    $grd->edit_link="index.php?module=add_edit_user";
    $grd->id_column="UserID";

    if($grd->IsClickedBtnDelete())
    {
       orm::Delete("users", array("UserID"=>$grd->process_id));
    }

    $query = users_db::GetUsersQuery();
    $grd->DrowTable($query);
    $grid_html = $grd->table;

    if(isset($_POST["ajax"]))
    {
         echo $grid_html;
    }

    function desc_func()
    {
        return "Local users";
    }

?>