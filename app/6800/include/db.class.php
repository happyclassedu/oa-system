<?php
class mysql{

	private $host;
	private $name;
	private $pass;
	private $table;
	private $char;

    function __construct($host,$name,$pass,$table,$char){

    	$this->host=$host;
    	$this->name=$name;
    	$this->pass=$pass;
    	$this->table=$table;
    	$this->char=$char;
    	$this->connect();

    }
    function connect() {
    mysql_connect($this->host,$this->name,$this->pass) or die ($this->error());
    mysql_select_db($this->table);
    $this->query("set names '$this->char'");
     }
    function query($value){
    return mysql_query($value);
    }
    function fetch_array($value){
    return mysql_fetch_array($value);
    }




    function error(){
       return mysql_error;
    }

}




?>