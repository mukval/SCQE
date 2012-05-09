<?php

class users_db {
    public static function GetUsersQuery()
    {
        $sql ="select * from users u left join user_types ut on u.user_type=ut.id order by added_date";
        return $sql;
    }

    public static function GetImportedUsersQuery()
    {
        $sql ="select * from v_imported_users order by name,surname";
        return $sql;
    }
}
?>
