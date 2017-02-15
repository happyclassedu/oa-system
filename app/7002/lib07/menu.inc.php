<?php
//==========================================

//==========================================



class dbzzsql
{
	var $host     = "localhost";			//mssql主机名
	var $user     = "sa";			//mssql用户名
	var $pwd      = "";			//mssql密码
	var $dbname   = "xtcapp_dyl";			//mssql数据库名称
	var $linkid   = 0;			//用来保存连接id
	var $queryid  = 0;			//用来保存查询id
	var $fetchmode= mssql_ASSOC;//取记录时的模式
	var $querytimes = 0;		//保存查询的次数
	var $errno    = 0;			//mssql出错代号
	var $error    = "";			//mssql出错信息
	var $record   = array();	//一条记录数组
//	
	//======================================
	// 函数: mssql()
	// 功能: 构造函数
	// 参数: 参数类的变量定义
	// 说明: 构造函数将自动连接数据库
	//      如果想手动连接去掉连接函数
	//======================================
	function mssql($host,$user,$pwd,$dbname)
	{	if(empty($host) || empty($user) || empty($dbname))
			$this->halt("数据库主机地址,用户名或数据库名称不完全,请检查!");
		$this->host    = $host;
		$this->user    = $user;
		$this->pwd     = $pwd;
		$this->dbname  = $dbname;
		$this->connect();//设置为自动连接
	}
	//======================================
	// 函数: connect($host,$user,$pwd,$dbname)
	// 功能: 连接数据库
	// 参数: $host 主机名, $user 用户名
	// 参数: $pwd 密码, $dbname 数据库名称
	// 返回: 0:失败
	// 说明: 默认使用类中变量的初始值
	//======================================
	function connect($host = "", $user = "", $pwd = "", $dbname = "")
	{
		if ("" == $host)
			$host = $this->host;
		if ("" == $user)
			$user = $this->user;
		if ("" == $pwd)
			$pwd = $this->pwd;
		if ("" == $dbname)
			$dbname = $this->dbname;
		//now connect to the database
		$this->linkid = mssql_connect($host, $user, $pwd);
//		echo $this->linkid."---";
//		$conn=mssql_pconnect ($host, $user, $pwd) or die("无法连接到数据库服务器");//连接mssql数据库服务器
//		mssql_query("SET NAMES 'gb2312'");
		if (!$this->linkid)
		{
			$this->halt();
			return 0;
		}
		if (!mssql_select_db($dbname, $this->linkid))
		{
			$this->halt();
			return 0;
		}
		return $this->linkid;			
	}
	//=====================================
	// 函数: query($sql)
	// 功能: 数据查询
	// 参数: $sql 要查询的SQL语句
	// 返回: 0:失败
	//======================================
	function query($sql)
	{
		$this->querytimes++;
		$this->queryid = mssql_query($sql, $this->linkid);
		if (!$this->queryid)
		{	
			$this->halt();
			return 0;
		}
//		else
//		{
//			echo "执行错误";
//			exit;
//			}
		return $this->queryid;
	}
	//======================================
	// 函数: setfetchmode($mode)
	// 功能: 设置取得记录的模式
	// 参数: $mode 模式 mssql_ASSOC, mssql_NUM, mssql_BOTH
	// 返回: 0:失败
	//======================================
	function setfetchmode($mode)
	{
		if ($mode == mssql_ASSOC || $mode == mssql_NUM || $mode == mssql_BOTH) 
		{
			$this->fetchmode = $mode;
			return 1;
		}
		else
		{
			$this->halt("错误的模式.");
			return 0;
		}
		
	}
	//======================================
	// 函数: fetchrow()
	// 功能: 从记录集中取出一条记录
	// 返回: 0: 出错 record: 一条记录
	//======================================
	function fetchrow()
	{
		$this->record = mssql_fetch_array($this->queryid,$this->fetchmode);
		return $this->record;
	}
	//======================================
	// 函数: fetchAll()
	// 功能: 从记录集中取出所有记录
	// 返回: 记录集数组
	//======================================
	function fetchAll()
	{
		$arr = array();
		while($this->record = mssql_fetch_array($this->queryid,$this->fetchmode))
		{
			echo $this->queryid."<br>".$this->fetchmode;
			$arr[] = $this->record;
			
		}
		mssql_free_result($this->queryid);
		return $arr;
	}
	//======================================
	// 函数: getvalue()
	// 功能: 返回记录中指定字段的数据
	// 参数: $field 字段名或字段索引
	// 返回: 指定字段的值
	//======================================
	function getvalue($field)
	{
		return $this->record[$field];
	}
	//======================================
	// 函数: querytimes()
	// 功能: 返回影响的记录数
	//======================================
	function querytimes()
	{
		return mssql_affected_rows($this->linkid);
	}
	//======================================
	// 函数: recordcount()
	// 功能: 返回查询记录的总数
	// 参数: 无
	// 返回: 记录总数
	//======================================
	function recordcount()
	{
		return mssql_num_rows($this->queryid);
	}
	//======================================
	// 函数: getquerytimes()
	// 功能: 返回查询的次数
	// 参数: 无
	// 返回: 查询的次数
	//======================================
	function getquerytimes()
	{
		return $this->querytimes;
	}
	//======================================
	// 函数: getversion()
	// 功能: 返回mssql的版本
	// 参数: 无
	//======================================
	function getversion() 
	{
		$this->query("select version() as ver");
		$this->fetchrow();
		return $this->getvalue("ver");
	}
	//======================================
	// 函数: getdbsize($dbname, $tblPrefix=null)
	// 功能: 返回数据库占用空间大小
	// 参数: $dbname 数据库名
	// 参数: $tblPrefix 表的前缀,可选
	//======================================
	function getdbsize($dbname, $tblPrefix=null) 
	{
		$sql = "SHOW TABLE STATUS FROM " . $dbname;
		if($tblPrefix != null) {
			$sql .= " LIKE '$tblPrefix%'";
		}
		$this->query($sql);
		$size = 0;
		while($this->fetchrow())
			$size += $this->getvalue("Data_length") + $this->getvalue("Index_length");
		return $size;
	}
	//======================================
	// 函数: insertid()
	// 功能: 返回最后一次插入的自增id
	// 参数: 无
	//======================================
	function insertid() {
		return mssql_insert_id();
	}
	//====================================== 
	// 函数: halt($err_msg)
	// 功能: 处理所有出错信息
	// 参数: $err_msg 自定义的出错信息
	//=====================================
	function halt($err_msg="")
	{
		if ("" == $err_msg)
		{
			$this->errno = mssql_errno();
			$this->error = mssql_error();
			echo "<b>mssql error:<b><br>";
			echo $this->errno.":".$this->error."<br>";
//			echo "<script language=javascript>alert('出现错误,请及时向站长反馈,谢谢!');document.location.href=('/index.php');</script>";
			exit;
		}
		else
		{
			echo "<b>执行错误:<b><br>";
			echo $err_msg."<br>";
			exit;
		}
	}
//	mssql_close($this->linkid);
}
?>