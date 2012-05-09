<?php

class access_db {
    
    public static function GetModules($txtLogin,$txtPass,$txtPassImp,$check_pass=true)
    {
        $query= "select m.*, u.UserID as user_id, u.user_type,u.password, 0 as imported from users u " .
                "left join roles_rights rr on rr.role_id = u.user_type " .
                "left join modules m on m.id= rr.module_id ".
                "where u.UserName='$txtLogin' ";
        if($check_pass==true) $query.="and Password='$txtPass' ";
        $query.=" union ";
        $query.="select m.*, u.UserID as user_id, 2 as user_type,u.password, 1 as imported from v_imported_users u ".
                " left join roles_rights rr on rr.role_id = 2 ".
                " left join modules m on m.id= rr.module_id ".
                " where u.UserName='$txtLogin' ";
        if($check_pass==true) $query.=" and u.Password='$txtPassImp' order by priority";
        //echo $query;
        return db::exec_sql($query);
    }

}
?>
