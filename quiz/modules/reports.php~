<?php if(!isset($RUN)) { exit(); } ?>
<?php

require "db/reports_db.php";
include "components/libchart/classes/libchart.php";

$asg_id=util::GetKeyID("asg_id", "?module=assignments");

$db = new db();
$db->connect();

$res_qst = $db->query(reports_db::GetQuestionsForReports($asg_id));


function desc_func()
{
    return "Reports";
}

?>
