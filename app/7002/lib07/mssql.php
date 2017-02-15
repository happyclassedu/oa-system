<?php

CLASS dbzzsql{

var $errsql;

public function connect($dbhost,$dbuser,$dbpass,$dbname,$dblink){
$this->dbhost = $dbhost;
$this->dbuser = $dbuser;
$this->dbpass = $dbpass;
$this->dbname = $dbname;
$this->dblink = $dblink;
   $this->dblink = mysql_connect($this->dbhost,$this->dbuser,$this->dbpass) or die($this->halt());
   mysql_select_db($this->dbname,$this->dblink);
   mysql_query("SET NAMES 'gb2312'");
}

public function exec($sql){
    $this->errsql = $sql;
    $query = mysql_query($sql) or die($this->halt());

    return $query;
}

public function fetch($query,$result_type = MYSQL_ASSOC){
		$arr = array();
		while($this->record = mysql_fetch_array($query,$result_type))
		{
			$arr[] = $this->record;
		}
		mysql_free_result($query);
		return $arr;
}


public function affected_rows(){
   return @mysql_rows_affected($this->dblink) or die ($this->halt());
}

 

public function num_rows($query){
   return mysql_num_rows($query);
}

public function free_result($query) {
    return @mysql_free_result($query) or die($this->halt());;
   }

public function insert_id(){
   $query = $this->query("SELECT @@IDENTITY as last_insert_id");
   $row = $this->fetch($query);
   $this->free_result($query);
   return $row['last_insert_id'];
}

public function seek($query,$offset){
   @mysql_data_seek($query,$offset) or die($this->halt());;
}

public function halt(){
   $error = mysql_errno();
   return 'mysql Error: '.$error."<br>".$this->errsql;
}

public function fetchrow($sql)
{
		$query = $this->exec($sql);
		$rs=mysql_fetch_object($query);
		mysql_free_result($query);
		return $rs;
}
	
public function get_one($sql){
   $query = $this->exec($sql);
   $row = $this->fetch($query);
   $this->free_result($query);
   return $row;
}
public function get_sql($sql){
	$queryresult=$this->exec($sql);
	$ggallrows=$this->num_rows($queryresult);
	$allrow=$this->fetch($queryresult);
	return $allrow;
}
}
$obj=new dbzzsql;
require_once('config.inc.php');
$obj->connect($global_databaseip,$global_databaseuser,$global_databasepwd,$global_databasename,$dblink=false);
?>
