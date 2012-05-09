<?php if(!isset($RUN)) { exit(); } ?>
<?php

 require "grid.php";
 //require "db/users_db.php";
 require "db/asg_db.php";

 $asg_id = util::GetID("?module=active_assignments");
 $results=asgDB::GetAsgQueryById($asg_id);

 $row_num = db::num_rows($results);
 if($row_num==0)
 {
     header("location:?module=active_assignments");
     exit;
 }
 $row = db::fetch($results);

 if($row['show_intro']=="1")
 {
    $intro = $row['intro_text'];
 }
 else
 {
     header("location:?module=start_quiz&id=".$asg_id);
 }

 if(isset($_POST['btnCont']))
 {
     header("location:?module=start_quiz&id=".$asg_id);     
 }

 function desc_func()
    {
        return "Intro";
    }
   
?>
