<?php
 
  require 'config.php';
  require 'db/mysql2.php';
  require 'db/access_db.php';
  require "lib/util.php";
  require "lib/access.php";
  require "db/orm.php";
  require "lib/validations.php";
  require "lib/webcontrols.php";

  ini_set('session.bug_compat_42',0);
  ini_set('session.bug_compat_warn',0);

  $RUN = 1;

   //@session_start();

  $modules = access_db::GetModules($_SESSION['txtLogin'], $_SESSION['txtPass'],$_SESSION['txtPassImp'],true);
  $has_result = db::num_rows($modules);
  if($has_result==0)
  {
        header("location:login.php");
        exit;
  }

  ShowModule();

  function ShowModule()
  {
        global $module_name,$module_t_name,$Util;

        $module_name= isset($_GET["module"]) ? $_GET["module"] : "default" ;

        if(!file_exists("modules/$module_name".".php") || $module_name=="" || strpos($module_name,"../")!=0)
            $module_name="default";

        $module_t_name=$module_name."_tmp";

  }

  include "modules/".$module_name.".php";
  
  if(!isset($_POST["ajax"]))
  {
        $queries = debug::GetSQLs();
        include "index_tmp.php";
  }  

?>