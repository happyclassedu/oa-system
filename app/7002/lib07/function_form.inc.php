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
	    //php��ȡip���㷨 
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
						echo "<script language=javascript>alert('�޷��鿴��ҳ��ԭ�򣺴��û��ǲ��Ÿ����ˣ��������Ա��ϵ��');history.go(-1)</script>";
						exit;
	
		}
	} 
	       
//����Ƿ��зǷ��ַ����еĻ����滻
function chkstring($str)
{
	if (is_null($str)==false)
	{
	$str=str_replace("���","",$str);
	$str=str_replace("������","",$str);
	$str=str_replace("&#8226","",$str);
	$str=str_replace("#8226��","",$str);
  $str=str_replace("&#9827;","",$str);
	$str=str_replace("��","",$str);
	$str=str_replace("��","",$str);
	$str=str_replace("����","",$str);
	$str=str_replace("����","",$str);
	$str=str_replace("��","",$str);
	$str=str_replace("��","",$str);
	$str=str_replace("����","",$str);
	$str=str_replace("��","",$str);
	$str=str_replace("��","",$str);
	$str=str_replace("insert","",$str);
	$str=str_replace("delete","",$str);
	$str=str_replace("update","",$str);
	$str=str_replace("sql","",$str);
	$str=str_replace("cmd","",$str);
	$str=str_replace("cmd.exe","",$str);
	$str=str_replace("fuck","",$str);
	$str=str_replace("����","",$str);
	$str=str_replace("���ֹ�","",$str);			
	$str=str_replace("����","",$str);
	$str=str_replace("������Ʊ","",$str);		
	$str=str_replace("����Ʊ","",$str);	
	$str=str_replace("����","",$str);	
	$str=str_replace("sex","",$str);
	$str=str_replace("����","",$str);	
	$str=str_replace("����","",$str);		
	$str=str_replace("ͬ����","",$str);	
	$str=str_replace("����Ů","",$str);	
	$str=str_replace("����","",$str);	
	$str=str_replace("��B","",$str);	
	$str=str_replace("��","",$str);	
	$str=str_replace("��","",$str);
	$str=str_replace("��","",$str);
	$str=str_replace("��","",$str);
	$str=str_replace("��","",$str);
  $str=str_replace("��","",$str);
  $str=str_replace("��","",$str);
  $str=str_replace("��","",$str);
  $str=str_replace("��","",$str);
  

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


//������ַ
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

//��������
function findcity($area)
{
	$file = "../link/area.txt";
	$linedata = file($file);
	$count = count($linedata);
	for($i = 0; $i < $count; $i++) {
		$detail = @explode("\t", chop($linedata[$i]));
		if (strcmp($detail[1],$area)==0) echo str_replace("��","",$detail[2]);
		
	}
}
	
//���˻س�

function   change2($a)
{   
  $a=   HTMLSpecialChars($a);   
  $a=   stripslashes($a);   
  $a=   ereg_replace(" ","&nbsp;",$a);   
  $a=nl2br($a);   
//  $a=html_entity_decode($a);
  return   $a;  
  }   

//����ַ����Ƿ�Ϸ�	
function chkstr($str_chk)	
	{
	$usernamelen=strlen($str_chk);
//		echo "�ַ�����=".$usernamelen;
		for ($i=0;$i<$usernamelen;$i++)
		{
			$str_username=substr($str_chk,$i,1);
//			echo "��".$i."���ַ�Ϊ".$str_username."<br>";
				if (ereg('[-A-Za-z0-9_]',$str_username))
					{
//						echo "��".$i."���ַ�Ϊ".$str_username."�ǺϷ���<br>";
						if (!ereg('[^&|%|*|(|)|$|#|@|!|~|`|+|=|<|>|,|/|[|]|{|}]',$str_username)) 
							{
									echo "<script language=javascript>alert('�����ʺŸ�ʽ���ԣ�ֻ����Ӣ�ġ����ּ����л��ߣ������ַ����ո���ע��');history.go(-1)</script>";
									exit;
							}
					}
				else 
					{	
						echo "<script language=javascript>alert('�����ʺŸ�ʽ���ԣ�ֻ����Ӣ�ġ����ּ����л��ߣ������ַ����ո���ע��');history.go(-1)</script>";
						exit;
					}
			}
	}


/*������վ��ҳ�Լ�vTigerCRM�ﾭ���ڽ�ȡ�����ַ���ʱ��������(ʹ��substr)��
�����ҵ�һ���ȽϺõĽ�ȡ�����ַ����������ڴ����ҹ�����*/

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
* PHP��ȡUTF-8�ַ�����������ַ����⡣
* Ӣ�ġ����֣���ǣ�Ϊ1�ֽڣ�8λ�������ģ�ȫ�ǣ�Ϊ3�ֽ�
* @return ȡ�����ַ���, ��$lenС�ڵ���0ʱ, �᷵�������ַ���
* @param $str Դ�ַ���
* $len ��ߵ��Ӵ��ĳ���
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