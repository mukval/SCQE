<?php

 require '../config.php';
 require "../db/questions_db.php";
 require "../db/asg_db.php";
 require "qst_viewer.php";
  require '../db/mysql2.php';
  require '../db/access_db.php';
  require "../lib/util.php";
  require "../db/orm.php";
  require "../lib/validations.php";
  require "../lib/webcontrols.php";

 //@session_start();
 if(!isset($_POST['qst_id'])) exit ;

 $priority=intval($_POST['qst_id']);

 $qst_viewer = new qst_viewer("?module=start_quiz&id=".$_SESSION['asg_id']);
 $qst_viewer->user_quiz_id=$_SESSION['user_quiz_id'];

 $qst_viewer->show_prev=false;

 $qst_viewer->show_next=false;
 $qst_viewer->show_finish=false;

 $qst_query = questions_db::GetQuestionsByPriority($priority, $_SESSION['asg_id'], $_SESSION['user_id']);
 $row_qst = db::fetch(db::exec_sql($qst_query));

 $qst_viewer->BuildQuestionWithResultset($row_qst);
 $qst_html = $qst_viewer->html;

 echo $qst_html;
 
?>
