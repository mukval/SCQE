<?php
    
	require 'config.php';
	require 'db/mysql2.php';
	require 'db/access_db.php';
	require "lib/util.php";
	require "lib/access.php";
	require "db/orm.php";
	require "lib/validations.php";
	require "lib/webcontrols.php";

	
	if(isset($_POST["btnSave"]) && isset($_POST["txtName"]) && isset($_POST["txtSurname"]) && isset($_POST["txtLogin"]) && isset($_POST["txtPassword"]))
    {
        orm::Insert("users", array("Name"=>trim($_POST["txtName"]),
                                    "Surname"=>trim($_POST["txtSurname"]),
                                    "UserName"=>trim($_POST["txtLogin"]),
                                     "Password"=>md5(trim($_POST["txtPassword"])),
                                     "added_date"=>util::Now(),
                                     "email"=>trim($_POST["txtEmail"]),
                                     "user_type"=>trim($_POST["drpUserType"])
                                   ));
    
        header("location:login.php");
    }
	
    ?>