<?
session_start();
$user_page_num=10;
$dbzz_page_num=40;
define('dbzz_net', TRUE);
date_default_timezone_set('PRC');
//function send_no_cache_header() {
//header ( "Last-Modified: " . gmdate ( "D, d M Y H:i:s" ) . " GMT" );
//header ( "Cache-Control: "no-store, no-cache, must-revalidate" );
//header ( "Cache-Control: "post-check=0, pre-check=0, false );
//header ( "Pragma: no-cache");
//}

function userip()
{
	    //php获取ip的算法 
			if ($HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"]) 
			{ 
			$ip = $HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"]; 
			} 
			elseif ($HTTP_SERVER_VARS["HTTP_CLIENT_IP"]) 
			{ 
			$ip = $HTTP_SERVER_VARS["HTTP_CLIENT_IP"]; 
			} 
			elseif ($HTTP_SERVER_VARS["REMOTE_ADDR"]) 
			{ 
			$ip = $HTTP_SERVER_VARS["REMOTE_ADDR"]; 
			} 
			elseif (getenv("HTTP_X_FORWARDED_FOR")) 
			{ 
			$ip = getenv("HTTP_X_FORWARDED_FOR"); 
			} 
			elseif (getenv("HTTP_CLIENT_IP")) 
			{ 
			$ip = getenv("HTTP_CLIENT_IP"); 
			} 
			elseif (getenv("REMOTE_ADDR")) 
			{ 
			$ip = getenv("REMOTE_ADDR"); 
			} 
			else 
			{ 
			$ip = "0"; 
			} 	
			return $ip;
	}

function chk_num($strbr)
{
	if ($strbr=="") $strbr=0;
	return $strbr;
	}

function chk_null($strbr)
{
	if ($strbr<>"0" or $strbr<>0) echo $strbr; 
	}
function chk_0($strbr)
{
	if ($strbr<>"0" or $strbr<>0) echo $strbr; 
	else echo "";
	}
 
function checkuserceo($fuzeceo)
{
	if ($fuzeceo==1) $checkuserceo=1;
	else $checkuserceo=0;
	return $checkuserceo;
	} 

function checkuserexit($fuzeceo)
{
	if ($fuzeceo<>1)
	{
						echo "<script language=javascript>alert('无法查看本页！原因：此用户非部门负责人，请与管理员联系！');history.go(-1)</script>";
						exit;
	
		}
	} 
	       
//检查是否有非法字符，有的话就替换
function chkstring($str)
{
	if (is_null($str)==false)
	{
	$str=str_replace("妈的","",$str);
	$str=str_replace("操你妈","",$str);
	$str=str_replace("&#8226","",$str);
	$str=str_replace("#8226；","",$str);
  $str=str_replace("&#9827;","",$str);
	$str=str_replace("★","",$str);
	$str=str_replace("〓","",$str);
	$str=str_replace("◢◣","",$str);
	$str=str_replace("◥◣","",$str);
	$str=str_replace("◣","",$str);
	$str=str_replace("◢","",$str);
	$str=str_replace("◢◤","",$str);
	$str=str_replace("◤","",$str);
	$str=str_replace("☆","",$str);
	$str=str_replace("insert","",$str);
	$str=str_replace("delete","",$str);
	$str=str_replace("update","",$str);
	$str=str_replace("sql","",$str);
	$str=str_replace("cmd","",$str);
	$str=str_replace("cmd.exe","",$str);
	$str=str_replace("fuck","",$str);
	$str=str_replace("干你","",$str);
	$str=str_replace("法轮功","",$str);			
	$str=str_replace("法轮","",$str);
	$str=str_replace("代开发票","",$str);		
	$str=str_replace("卖发票","",$str);	
	$str=str_replace("成人","",$str);	
	$str=str_replace("sex","",$str);
	$str=str_replace("打炮","",$str);	
	$str=str_replace("做爱","",$str);		
	$str=str_replace("同性恋","",$str);	
	$str=str_replace("干美女","",$str);	
	$str=str_replace("操你","",$str);	
	$str=str_replace("操B","",$str);	
	$str=str_replace("◆","",$str);	
	$str=str_replace("▲","",$str);
	$str=str_replace("■","",$str);
	$str=str_replace("※","",$str);
	$str=str_replace("＆","",$str);
  $str=str_replace("⊙","",$str);
  $str=str_replace("～","",$str);
  $str=str_replace("●","",$str);
  $str=str_replace("◇","",$str);
  

	return $str;
		}						
}

function titlenet($str)
{
	if (is_null($str)==false)
	{

	$str=str_replace("www.","",$str);	
	$str=str_replace(".com","",$str);
	$str=str_replace(".net","",$str);
	$str=str_replace(".cn","",$str);
	$str=str_replace(".gov","",$str);
	$str=str_replace("=","",$str);
	return $str;
		}	
	}


//处理地址
function findarea($area)
{
	$file = "../link/area.txt";
	$linedata = file($file);
	$count = count($linedata);
	for($i = 0; $i < $count; $i++) {
		$detail = @explode("\t", chop($linedata[$i]));
		if (strcmp($detail[1],$area)==0) echo "".$detail[0]."&nbsp;&nbsp;".$detail[2];
	}
}

//处理城市
function findcity($area)
{
	$file = "../link/area.txt";
	$linedata = file($file);
	$count = count($linedata);
	for($i = 0; $i < $count; $i++) {
		$detail = @explode("\t", chop($linedata[$i]));
		if (strcmp($detail[1],$area)==0) echo str_replace("市","",$detail[2]);
		
	}
}
	
//过滤回车

function   change2($a)
{   
  $a=   HTMLSpecialChars($a);   
  $a=   stripslashes($a);   
  $a=   ereg_replace(" ","&nbsp;",$a);   
  $a=nl2br($a);   
//  $a=html_entity_decode($a);
  return   $a;  
  }   

//检查字符串是否合法	
function chkstr($str_chk)	
	{
	$usernamelen=strlen($str_chk);
//		echo "字符长度=".$usernamelen;
		for ($i=0;$i<$usernamelen;$i++)
		{
			$str_username=substr($str_chk,$i,1);
//			echo "第".$i."个字符为".$str_username."<br>";
				if (ereg('[-A-Za-z0-9_]',$str_username))
					{
//						echo "第".$i."个字符为".$str_username."是合法的<br>";
						if (!ereg('[^&|%|*|(|)|$|#|@|!|~|`|+|=|<|>|,|/|[|]|{|}]',$str_username)) 
							{
									echo "<script language=javascript>alert('您的帐号格式不对，只能是英文、数字及下中划线，其它字符及空格不能注册');history.go(-1)</script>";
									exit;
							}
					}
				else 
					{	
						echo "<script language=javascript>alert('您的帐号格式不对，只能是英文、数字及下中划线，其它字符及空格不能注册');history.go(-1)</script>";
						exit;
					}
			}
	}


/*由于网站首页以及vTigerCRM里经常在截取中文字符串时出现乱码(使用substr)，
今天找到一个比较好的截取中文字符串方法，在此与大家共享。*/

function msubstr($str, $start, $len) {
    $tmpstr = "";
    $strlen = $start + $len;
    for($i = $start; $i < $strlen; $i++) {
        if(ord(substr($str, $i, 1)) > 0xa0) {
            $tmpstr .= substr($str, $i, 2);
            $i++;
        } else
            $tmpstr .= substr($str, $i, 1);
    }
    return $tmpstr;
}



/******************************************************************
* PHP截取UTF-8字符串，解决半字符问题。
* 英文、数字（半角）为1字节（8位），中文（全角）为3字节
* @return 取出的字符串, 当$len小于等于0时, 会返回整个字符串
* @param $str 源字符串
* $len 左边的子串的长度
****************************************************************/
function utf_substr($str,$len)
{
for($i=0;$i<$len;$i++)
{
$temp_str=substr($str,0,1);
if(ord($temp_str) > 127)
{
$i++;
if($i<$len)
{
$new_str[]=substr($str,0,3);
$str=substr($str,3);
}
}
else
{
$new_str[]=substr($str,0,1);
$str=substr($str,1);
}
}
return join($new_str);
}

?>