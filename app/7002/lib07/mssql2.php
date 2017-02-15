<?php

class dbsql
{
var $dbhost;
var $dbuser;
var $dbpass;
var $dbname;
var $link =0;
var $doresult ="";
var $lastid = "";

function dbsql($dbhost,$dbuser,$dbpass,$dbname) {
$this->dbhost = $dbhost;
$this->dbuser = $dbuser;
$this->dbpass = $dbpass;
$this->dbname = $dbname;
}

function connect(){
$this->link = @mssql_connect($this->dbhost,$this->dbuser,$this->dbpass);
if(!$this->link){
$this->halt("Connect to this Server ( '$this->dbhost','$this->dbuser','dbpass' ) : Failed");
return 0;
}
if(!@mssql_select_db($this->dbname)){
$this->halt("Select to($this->dbname) Failed.");
return 0;
}
return 1;
}

function select(){
if(@mssql_select_db($this->dbname))
return 1;
else
return 0;
}

function query($sql){
if($this->link == 0){
$this->halt("Execute SQL Failed: Hava not valid database connect.");
return 0;
}

ob_start();
$this->doresult = mssql_query($sql,$this->link);
$error = ob_get_contents();
ob_end_clean();
if($error){

$this->halt("Execute SQL: Query($sql,$this->linkID) failed.");
return 0;
}
$reg = "#insert into#";
if(preg_match($reg,$sql)){
$sql = "select @@IDENTITY as id";
$res = mssql_query($sql,$this->link);
$this->lastid = mssql_result($res,0,id);
}
return $this->doresult;
}

function num_rows($result=""){
if($result != "") $this->doresult = $result;
$row = @mssql_num_rows($this->doresult);
if($row >= 0) return $row;
$this->halt("Get a row of result Failed: Result $result is invalid.");
return 0;
}

function lastid(){
return $this->lastid;
}

function result($result="",$row=0,$field=0){
if($result != "") $this->doresult = $result;
$fieldvalue = @mssql_result($this->doresult,$row,$field);
if($fieldvalue != "") return $fieldvalue;
$this->halt("Get field: Result($this->doresult,$row,$field) failed.");
return 0; 
}
//mssql_fetch_array的究竟用哪一个好呢？用短一点的这个经常会出错！
/* function fetch_array($query) {
return mssql_fetch_array($query);
}
*/
//下面这个也有问题！
function fetch_array($result){
if(!empty($result)) $this->doresult = $result;
$record = @mssql_fetch_array($this->doresult);
if(array($record)) //这里原来是if(is_array($record))，但是出错了，改为现在的array就正常。is_array和array的区别在哪里？ return $record;
$this->halt("Get the next record Failed: the Result $result is invalid.");
return 0;
}




function free_result($result=""){
if($result != "") $this->doresult = $result;
return @mssql_free_result($this->doresult);
}

function halt($errmsg) {
$message="<Title>Web Info</Title>";
$message.="<b>Web info</b>: $errmsg\n\n";
$message.="<br><br><b>Script</b>: ".$_SERVER["SCRIPT_NAME"]."\n<br>";
$message.="<b>IPAdd</b>: ".$_COOKIE['UserIP']."\n<br>";
echo "<p style=\"font-family: Verdana, Tahoma; font-size: 11px; background: #FFFFFF;\">";
echo $message;
echo '<br>Similar error report has beed dispatched to administrator before.';
function_exists('exit') ? exit() : exit();
}


}

?> 