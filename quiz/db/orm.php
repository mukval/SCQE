<?php

class orm {

    public static function GetSelectQuery($table, $columns,$where_clause,$order_by)
    {
        $columns_select ="";
        for($i=0;$i<count($columns);$i++)
        {
            $columns_select.=",".$columns[$i];
        }        

        if(count($columns)==0)
        {
            $columns_select="*";
        }
        else
        {
            $columns_select=substr($columns_select,1);
        }

        $where = "";
        foreach($where_clause as $key=>$value)
        {
            $where.="AND $key='".$value."'";
        }
        if(strlen($where)>0)
        {
            $where = " where ".substr($where , 3);
        }
        
        if($order_by!="")
        {
            $order_by = "order by $order_by";
        }

        $sql = "select $columns_select from $table $where $order_by";
        return $sql;
    }

    public static function Select($table, $columns,$where_clause,$order_by)
    {        
        $sql = orm::GetSelectQuery($table, $columns,$where_clause,$order_by);        
        return db::exec_sql($sql);
    }

    public static function GetInsertQuery($table,$columns)
    {
        $columns_str="";
        $values_str="";
        foreach($columns as $key=>$value)
        {
            $columns_str.=",$key";
            $values_str.=",'".db::clear($value)."'";
        }
        $columns_str=substr($columns_str,1);
        $values_str=substr($values_str,1);
        $sql = "insert into $table ($columns_str) values($values_str)";
        return $sql;
    }

    public static function Insert($table,$columns)
    {
        $sql = orm::GetInsertQuery($table, $columns);
        db::exec_sql($sql);
    }

    public static function GetDeleteQuery($table,$columns)
    {
        $where = "";
        foreach($columns as $key=>$value)
        {
            $where.="AND $key='".db::clear($value)."'";
        }
        $where = substr($where , 3);
        if($where!="")
        {
            $sql = "delete from $table where $where";
            //db::exec_sql($sql);
        }
        return $sql;
    }

    public static function Delete($table,$columns)
    {
        $sql = orm::GetDeleteQuery($table, $columns);
        db::exec_sql($sql);
    }

    public static function GetUpdateQuery($table,$columns,$where_clause)
    {

        $update_str = "";
        foreach($columns as $key=>$value)
        {
            $update_str .= ", $key='".db::clear($value)."'";
        }
        $update_str=substr($update_str,1);

        $where = "";
        foreach($where_clause as $key=>$value)
        {
            $where.="AND $key='".db::clear($value)."'";
        }
        $where = substr($where , 3);
        if($where!="")
        {
            $sql = "update $table set $update_str where $where";            
        }
        return $sql;
    }

    public static function Update($table,$columns,$where_clause)
    {
        $sql = orm::GetUpdateQuery($table, $columns, $where_clause);
        db::exec_sql($sql);
    }

}
?>
