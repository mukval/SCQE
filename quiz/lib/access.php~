<?php
class access
{
    public static function allow($user_type)
    {
        if($user_type!=$_SESSION['user_type'])
        {
            header("location:login.php");
        }
    }
}
?>
