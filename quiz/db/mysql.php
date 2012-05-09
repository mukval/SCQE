<?

class DataBase
{

    var $link;


    function connect($sqlip,$sqluser,$sqlpassword)
    {
       return $this->link=mysql_connect($sqlip,$sqluser,$sqlpassword) or die($this->error());
    }

	function connect_()
    {
       return $this->link=mysql_connect(SQL_IP,SQL_USER,SQL_PWD) or die($this->error());
    }

	function pConnect($sqlip,$sqluser,$sqlpassword)
    {
       return $this->link=mysql_pconnect($sqlip,$sqluser,$sqlpassword) or die($this->error());
    }

	function pConnect_()
    {
       return $this->link=mysql_connect(SQL_IP,SQL_USER,SQL_PWD) or die($this->error());
    }
    
    function selectdatabase($sqldatabase)
    {
       return mysql_select_db($sqldatabase, $this->link) or die($this->error());
    }

    function selectdatabase_()
    {
       return mysql_select_db(SQL_DATABASE, $this->link) or die($this->error());
    }
    
    function send_query($query)
    {	   	   	
       $results=mysql_query($query, $this->link) or die($this->error());
       return $results;
    }

	function exec_sql($query)
	{
		$link=mysql_connect(SQL_IP, SQL_USER, SQL_PWD) or die($this->error());
		mysql_select_db(SQL_DATABASE, $link);
		$results=mysql_query($query,$link) or die($this->error());
		mysql_close($link);
		return $results;		
	}
 
    function num_rows($results)
    {
       return mysql_num_rows($results);
    }
    
    function fetch_array($results)
    {
       $row=mysql_fetch_array($results);
       return $row;
    }

	function GetResultsAsArray($query)
	{
		$results=mysql_query($query, $this->link) or die($this->error());

		while($rows=mysql_fetch_array($results))
		{
			$res[]=$rows;
		}

		return $res;
	}

	function GetResultsAsArray2($query,$lang)
	{
		$results=mysql_query($query, $this->link) or die($this->error());

		while($rows=mysql_fetch_array($results))
		{
			$res[$rows['keym']]=$rows[$lang];
		}

		return $res;
	}

	function GetPage($sql, $from)
    {
		if(PAGE_SIZE!=-1)
		{
			$count=PAGE_SIZE;
		    $sql.=" LIMIT $from, $count ";
		}
        return $this->send_query($sql);
    }

	function last_id()
	{
		return mysql_insert_id($this->link);
	}
    
    function close_connection()
    {
       mysql_close($this->link);
    }
    
    function error()
    {
       die(mysql_error());
    }

}

?>
