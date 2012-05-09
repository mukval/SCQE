<?php
  define("SQL_IP", "localhost");
  define("SQL_USER", "root");
  define("SQL_PWD","");
  define("SQL_DATABASE","test123");

  define("DEBUG_SQL","no");

  function Imported_Users_Password_Hash($entered_password,$password_from_db)
  {
      return md5($entered_password);
  }

  @session_start();

  
?>
