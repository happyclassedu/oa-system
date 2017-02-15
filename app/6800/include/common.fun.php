<?php
	function fun_url_ck() {
		if (preg_replace("/https?:\/\/([^\:\/]+).*/i", "\\1", $_SERVER['HTTP_REFERER']) !== preg_replace("/([^\:]+).*/", "\\1", $_SERVER['HTTP_HOST'])) {
			header("Location: http://www.3qpinpai.com");
			exit ();
		}
	}
	function fun_str_ck($sql_str) {
		$check = eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str);
		if ($check) {
			echo "输入非法注入内容！";
			exit ();
		} else {
			return $sql_str;
		}
	}
function ShowMsg($msg,$gourl='',$onlymsg=0,$limittime=0)  //页面跳转函数
{
	$htmlhead  = "<html>\r\n<head>\r\n<title>系统提示</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\" />\r\n";
	$htmlhead .= "<base target='_self'/>\r\n<style>div{line-height:160%;}</style></head>\r\n<body leftmargin='0' topmargin='0'>\r\n<center>\r\n<script>\r\n";
	$htmlfoot  = "</script>\r\n</center>\r\n</body>\r\n</html>\r\n";

	if($limittime==0)
	{
		$litime = 1000;
	}
	else
	{
		$litime = $limittime;
	}

	if($gourl=="-1")
	{
		if($limittime==0)
		{
			$litime = 1000;
		}
		$gourl = "javascript:history.go(-1);";
	}

	if($gourl==''||$onlymsg==1)
	{
		$msg = "<script>alert(\"".str_replace("\"","“",$msg)."\");</script>";
	}
	else
	{
		$func = "      var pgo=0;
      function JumpUrl(){
        if(pgo==0){ location='$gourl'; pgo=1; }
      }\r\n";
		$rmsg = $func;
		$rmsg .= "document.write(\"<br /><div style='width:450px;padding:0px;border:1px solid #D1DDAA;'>";
		$rmsg .= "<div style='padding:6px;font-size:12px;border-bottom:1px solid #D1DDAA;background:#DBEEBD;'><b>XMF1 Message!</b></div>\");\r\n";
		$rmsg .= "document.write(\"<div style='height:130px;font-size:10pt;background:#ffffff'><br />\");\r\n";
		$rmsg .= "document.write(\"".str_replace("\"","“",$msg)."\");\r\n";
		$rmsg .= "document.write(\"";
		if($onlymsg==0)
		{
			if($gourl!="javascript:;" && $gourl!="")
			{
				$rmsg .= "<br /><a href='{$gourl}'>正在指向跳转页面，如果没有反应请点击这里....</a>";
			}
			$rmsg .= "<br/></div>\");\r\n";
			if($gourl!="javascript:;" && $gourl!='')
			{
				$rmsg .= "setTimeout('JumpUrl()',$litime);";
			}
		}
		else
		{
			$rmsg .= "<br/><br/></div>\");\r\n";
		}
		$msg  = $htmlhead.$rmsg.$htmlfoot;
	}
	echo $msg;
	exit();
}

function UserShell($uid,$shell){
	global $db,$dbpre;
	$sql="SELECT * FROM `{$dbpre}admin` WHERE `id`='$uid'";
	$query=$db->query($sql);
	$us=is_array($row=$db->fetch_array($query));
    $isuser=$us ? $shell==md5($row[userid].$row[passwd]."xmf1"):FALSE;
	if($isuser){
		return $row;
	}else{
		ShowMsg("你无权限访问该面，请返回进行登录！","login.html");
	}
}



function page($page,$total,$pagesize=10,$pagelen=7){

$url=$_SERVER["REQUEST_URI"];
$parse_url=parse_url($url);
$url_path=$parse_url[path];
$url_query=$parse_url[query];
$page=$_GET[page];
if($url_query){

$url_query=ereg_replace("(^|&)page=$page","",$url_query);


$url=str_replace($parse_url["query"],$url_query,$url);

if($url_query) $url.="&page"; else $url.="page";
}else {
$url.="?page";
}
$phpfile=$url;

$pagecode = '';//定义变量，存放分页生成的HTML
$page = intval($page);//避免非数字页码
$total = intval($total);//保证总记录数值类型正确
if(!$total) return array();//总记录数为零返回空数组
$pages = ceil($total/$pagesize);//计算总分页
//处理页码合法性
if($page<1) $page = 1;
if($page>$pages) $page = $pages;
//计算查询偏移量
$offset = $pagesize*($page-1);
//页码范围计算
$init = 1;//起始页码数
$max = $pages;//结束页码数
$pagelen = ($pagelen%2)?$pagelen:$pagelen+1;//页码个数
$pageoffset = ($pagelen-1)/2;//页码个数左右偏移量

//生成html
$pagecode='<div class="page">';
$pagecode.="<span>$page/$pages</span>";//第几页,共几页
//如果是第一页，则不显示第一页和上一页的连接
if($page!=1){
$pagecode.="<a href=\"{$phpfile}=1\">&lt;&lt;</a>";//第一页
$pagecode.="<a href=\"{$phpfile}=".($page-1)."\">&lt;</a>";//上一页
}
//分页数大于页码个数时可以偏移
if($pages>$pagelen){
//如果当前页小于等于左偏移
if($page<=$pageoffset){
$init=1;
$max = $pagelen;
}else{//如果当前页大于左偏移
//如果当前页码右偏移超出最大分页数
if($page+$pageoffset>=$pages+1){
$init = $pages-$pagelen+1;
}else{
//左右偏移都存在时的计算
$init = $page-$pageoffset;
$max = $page+$pageoffset;
}
}
}
//生成html
for($i=$init;$i<=$max;$i++){
if($i==$page){
$pagecode.='<span>'.$i.'</span>';
} else {
$pagecode.="<a href=\"{$phpfile}={$i}\">$i</a>";
}
}
if($page!=$pages){
$pagecode.="<a href=\"{$phpfile}=".($page+1)."\">&gt;</a>";//下一页
$pagecode.="<a href=\"{$phpfile}={$pages}\">&gt;&gt;</a>";//最后一页
}
$pagecode.='</div>';
return array('pagecode'=>$pagecode,'sqllimit'=>' limit '.$offset.','.$pagesize);
}

function GetIP()
{
	if(!empty($_SERVER["HTTP_CLIENT_IP"])){
		$cip = $_SERVER["HTTP_CLIENT_IP"];
	}elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
		$cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}elseif(!empty($_SERVER["REMOTE_ADDR"])){
		$cip = $_SERVER["REMOTE_ADDR"];
	}else{
		$cip = '';
	}
	preg_match("/[\d\.]{7,15}/", $cip, $cips);
	$cip = isset($cips[0]) ? $cips[0] : 'unknown';
	unset($cips);
	return $cip;
}
function BodyImg($obj)
{
    if (!empty($obj))
    {
       if(get_magic_quotes_gpc()){
       	$obj=stripslashes($obj);
       }


       if(preg_match("/<img.*src=[\"](.*?)[\"].*?>/i",$obj, $regs ))
        {
         return $regs[1];
        }
    }
    else
    {
        return false;
    }
}


function Elin_tpl($str,$smarty)
{
	global $xm_global;
	$tpldir = $xm_global['cfg_tpl_dir'] ? $xm_global['cfg_tpl_dir'] : 'default';
	if ($smarty == 'smarty'){
		return ELIN_TPL.'/'.$tpldir.'/'.$str.'.htm';
	}
}






function Get_location($cat){
	if ($cat == 0) return array();
	$sql="SELECT * FROM `xm_procat`";
	$query=mysql_query($sql);
	while($row=mysql_fetch_array($query)){
		$catlist[]=array("catid"=>$row[catid],"parentid"=>$row[parentid],"catname"=>$row[catname],"title"=>$row[title],"keywords"=>$row[keywords],"description"=>$row[description],"modelid"=>$row[modelid],"single"=>$row[single],"html_dir"=>$row[html_dir]);
	}
		$index=0;
		$location  = array();
	while(1){

		foreach($catlist as $row){
			if($cat==$row[catid]){
				$cat=$row[parentid];
				$location[$index]['catid']=$row[catid];
				$location[$index]['catname']=$row[catname];
				$index++;
				break;
			}
		}
		if($index==0||$cat==0){
			break;
		}
	}
return $location;
}
function GetFlink($flag=1){
	if($flag==0){
	$sql="SELECT * FROM `xm_flink` WHERE `webname`<>'' ORDER BY `linkorder`";
	$query=mysql_query($sql);
    while($row=mysql_fetch_array($query)){
    	$fcode.="<span style='margin:5px 10px;'><a href='$row[weburl]' title=".$row[introduce]." target=_blank>$row[webname]</a></span>";
    }
	}else{
	$sql="SELECT * FROM `xm_flink` WHERE `weblogo`<>'' ORDER BY `linkorder`";
	$query=mysql_query($sql);
	while($row=mysql_fetch_array($query)){
    	$fcode.="<span style='margin:10px;'><a href='$row[weburl]' target=_blank><img src='$row[weblogo]' /></a></span>";
    }


	}
return $fcode;
}

function createdir($path)
{
	if (!file_exists($path)){
		createdir(dirname($path));
		mkdir($path, 0777);
		return true;
	} elseif(file_exists($path)){
		return true;
	} else {
		return false;
	}
}



function CatIdCheck($catable,$val){    //找出子类的ID
	global $code,$db;
	$sql="SELECT * FROM `$catable` WHERE `pid`='$val'";
	$query=$db->query($sql);
	while($row=$db->fetch_array($query)){
		$code[]=$row[id];
		CatIdCheck($catable,$row[id]);
	}
 return $code;
}

//========后台产品添加选项================


function get_product_menu( )
{
    global $admin_pro_class;
    $i = 0;
    foreach ( $admin_pro_class as $k => $value )
    {
        $xmelin .= "<input type=\"button\" onClick=\"noneblock('h".$i."')\" value=\"".$value."\"\" >&nbsp;&nbsp;";
        ++$i;
    }
    return $xmelin;
}


function get_product_input( )
{
    global $admin_pro;
    global $admin_pro_class;
    global $pro_con;
    $i = 0;
    foreach ( $admin_pro_class as $k => $xmelin_v )
    {
        $xmelin .= "<div id=\"h".$i."\" class=\"mytable\"";
        $xmelin .= $i == 0 ? "" : " style=\"display:'none'\"";
        $xmelin .= "><table border=\"0\" cellspacing=\"1\" cellpadding=\"2\" width=\"1052\" bordercolor=\"#799AE1\" class=tableBorder>";
        foreach ( $admin_pro as $k => $a )
        {
            if ( $a['class'] == $xmelin_v )
            {
                $xmelin .= "<tr bgcolor=\"#DEE5FA\"><td class=\"txlrow\" width=100 align=center>".$a['des']."</td><td class=txlrow>";
                if ( $k == "ProCondition" || $k == "Provantage" || $k == "OrderKnow")
                {
                    $xmelin .= "<textarea name=\"".$k."\" style=\"height:150px; width:400px\">".$pro_con[$k]."</textarea>";
                }

                else if ( $k == "ProParameter" || $k == "Structure")
                {
                global $sBasePath;
                $ed= new FCKeditor($k);
                $ed->BasePath=$sBasePath;
                $ed->Value=$pro_con[$k];
                $xmelin .=$ed->Create("elin");


                }
                else if ( $k == "ProPic" || $k == "Dimension" || $k == "TypeMain")
                {
                    $xmelin .= "<input name=\"".$k."\" value=\"".$pro_con[$k]."\"  id=\"".$k."\"/>";
                    $xmelin .= "<label><input type=\"radio\" class=\"radio\" onclick='document.getElementById(\"f".$k."\").style.display = \"none\";' name=\"ifout$k\" value=\"no\" checked=\"checked\" class=\"radio\"/>远程图片</label>\r\n<label><input type=\"radio\" class=\"radio\" onclick='document.getElementById(\"f".$k."\").style.display = \"block\";' name=\"ifout$k\" value=\"yes\" class=\"radio\"/>本地上传</label>\r\n<iframe src=\"upfile.php?id=".$k."\" width=\"450\" frameborder=\"0\" scrolling=\"no\"  id=\"f".$k."\" style=\"display:none; margin-top:10px\"></iframe>";
                }

                else if ( $k == "CateGrouy" )
                {

                    $xmelin .= "<select name=\"".$k."\"/>";
                    $xmelin .="<option value='0'>请选择分类</option>";
                    $xmelin .=configinput($pro_con[$k]);

                    $xmelin .= "<select>";
                }elseif ( $k == "IsoPic" )
                {
                    if(isset($_GET[cid])&&isset($_GET[id])){
                    	$pic_list=explode("|",$pro_con[$k]);
                        array_pop($pic_list);
                        for($i=0;$i<3;$i++){
	                        if($pic_list[$i]){
                               $xmelin .="<img src=\".."."$pic_list[$i]\" width=100px height=100px />&nbsp;&nbsp;&nbsp;";
	                        }else{
                               $xmelin .="<img src=\"images/nopic.gif\" width=100px height=100px />&nbsp;&nbsp;&nbsp;";
	                        }
                        }
                    $xmelin .= "</br><input name=\"".$k."0\"  type=\"file\" size=40/></br><input name=\"".$k."1\"  type=\"file\" size=40 /></br><input name=\"".$k."2\"  type=\"file\" size=40 />";
                    }else{
                    $xmelin .= "<input name=\"".$k."0\"  type=\"file\" size=40/></br><input name=\"".$k."1\"  type=\"file\" size=40 /></br><input name=\"".$k."2\"  type=\"file\" size=40 />";
                    }
                }

                else
                {
                    $xmelin .= "<input name=\"".$k."\" value=\"".$pro_con[$k]."\" class=\"text\" size=50/>";
                }

            }
        }
        $xmelin .= "</td></table></div>";
        $i += 1;
    }
    return $xmelin;
}
function configinput($mod,$id=0){
	global $procode,$dbpre,$db;
	static $sp="";
	$sql="SELECT * FROM `{$dbpre}procat` WHERE `parentid`=$id";
	$query=$db->query($sql);
	while($row=$db->fetch_array($query)){
		if($mod==$row[catid]){
			$procode.="<option value='$row[catid]' selected='selected'>$sp$row[catname]</option>";
		}else{
		$procode.="<option value='$row[catid]'>$sp$row[catname]</option>";
		}
        $sp.="&nbsp;&nbsp;";
		configinput($mod,$row[catid]);
		$sp=substr($sp,12);
	}
return $procode;
}


function hr_selected($option,$name){
  global $hr_con;
 if(empty($_GET[mid])&& is_array($hr_con)){
	foreach($option as $val){
  		echo "<option value='$val'>$val</option>";
  	}
  }else{
  	foreach($option as $val){
  		if($hr_con[$name]==$val){
  			echo "<option value='$val' selected='selected'>$val</option>";
  		}else{
  		    echo "<option value='$val'>$val</option>";
		}
  	}
}
}



function nav_selected($option,$name){
$url=$_SERVER["REQUEST_URI"];
$parse_url=parse_url($url);
$url_path=$parse_url[path];
$url_query=$parse_url[query];
$navmod=$_GET[navmod];
if($url_query){

$url_query=ereg_replace("(^|&)navmod=$navmod","",$url_query);


$url=str_replace($parse_url["query"],$url_query,$url);

if($url_query) $url.="&navmod"; else $url.="navmod";
}else {
$url.="?navmod";
}
 if(empty($name)){
	foreach($option as $key=> $val){
  		echo "<option value='".$url."=".$key."' >$val</option>";
  	}
  }else{
  	foreach($option as $key=> $val){
  		if($name==$key){
  			echo "<option value='".$url."=".$key."' selected='selected'>$val</option>";
  		}else{
  		    echo "<option value='".$url."=".$key."' >$val</option>";
		}
  	}
}
}










function HTMLEncode($str)
{
        if($str!=""){
                $str=str_replace(">","&gt;",$str);
                $str=str_replace("<","&lt;",$str);
                $str=str_replace(chr(32)," ",$str);
                $str=str_replace(chr(34),"&quto;",$str);
                $str=str_replace(chr(39),"&#39;",$str);
                $str=str_replace(chr(13),"",$str);
                $str=str_replace(chr(10).chr(10),"</p><p>",$str);
                $str=str_replace(chr(10),"<br>",$str);
                return $str;
        }
}


function GetFocus($val){
	global $db,$dbpre;
	if(empty($val)){
		$sql="SELECT * FROM `{$dbpre}focus`";
	}else{
		$sql="SELECT * FROM `{$dbpre}focus` WHERE `introduce`='".$val."'";
	}

$query=$db->query($sql);
while($row=$db->fetch_array($query)){
	$focus[]=array('picdir'=>$row[picdir],'targeturl'=>$row[targeturl]);
}

return $focus;
}

function GetLeftCat(){
global $db;
$sql="SELECT * FROM `xm_procat` WHERE `parentid`=0";
$query=mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$bigcat[]=array('catid'=>$row[catid],'catname'=>$row[catname]);
	$subsql="SELECT * FROM `xm_procat` WHERE `parentid`=$row[catid]";
	$subquery=$db->query($subsql);
	if(mysql_num_rows($subquery)){
		while($subrow=mysql_fetch_array($subquery)){
		$subcat[$row[catid]][]=array('catid'=>$subrow[catid],'catname'=>$subrow[catname]);
		}
	}

}

foreach($bigcat as $key=>$val){
	if(is_array($val)){
		$bigcat[$key][subcat]=$subcat[$val[catid]];
	}
}
return $bigcat;
}



function xm_assign($str="",$ass=""){
	global $smarty,$xm_global;
	foreach($str as $key=>$val){
	$smarty->assign($str[$key],$ass[$key]);
	}
	$smarty->assign("xm_global",$xm_global);
}

function Get_html_make($changle){
	global $db,$dbpre;
	if($changle=="index"){
		echo "<tr bgcolor='#DEE5FA'><td ><font color=red>只生成首页</font></td></tr>";
	}
	elseif($changle=="all"){
		echo "<tr bgcolor='#DEE5FA'><td ><font color=red>生成整站将会生成所有模块包括单页。</font></td></tr>";

	}
	elseif($changle=="news"||$changle=="products"){
		?>
	<tr bgcolor='#DEE5FA'>
      <td width='175'  valign='top'>选择栏目：</td>
      <td width='864'  valign='top'>
      <select name='typeid'>
      <option value='0' selected='1'>更新所有栏目...</option>
      <?php
      if($changle=="news"){
      html_option("newscat");
      }elseif($changle=="products"){
      html_option("procat");
      }
      ?>
   </select></td>
        </tr>
      <tr bgcolor='#DEE5FA'>
      <td height='20' valign='top'>是否更新子栏目：</td>
      <td height='20' valign='top' >
	  <input name='upnext' type='radio' value='1' checked='1' />
     更新子级栏目
    <input type='radio' name='upnext'  value='0' />
     仅更新所选栏目
    </td>
    </tr>
    <tr>
<?php
	}elseif($changle=="single"){
$sql="SELECT * FROM `{$dbpre}$changle`";
$query=$db->query($sql);
?>
	<tr bgcolor='#DEE5FA'>
      <td width='175'  valign='top'>选择栏目：</td>
      <td width='864'  valign='top'>
      <select name='typeid'>
      <option value='0' selected='1'>更新所有栏目...</option>
<?php
while($row=$db->fetch_array($query)){
	echo "<option value='$row[id]'>$row[name]</option>";
}
?>
   	  </select>
      </td>
     </tr>

<?php
	}
}


function GET_web_des($con){
	    return substr(str_replace(array("\r","\n"),array(" "," "),strip_tags($con)),0,200);
}



function str_cut($str_cut,$length){
    if(strlen($str_cut) > $length){   //处理标题，太长用……表示
       for($i=0; $i < $length; $i++){
           if (ord($str_cut[$i]) > 128) $i++;
       }
       $str_cut = substr($str_cut,0,$i);
   }
   return $str_cut;
}

function smtp_mail ( $sendto_email, $subject, $body, $extra_hdrs, $user_name) {
$mail = new PHPMailer();
$mail->IsSMTP();                                     // send via SMTP
$mail->Host = "";                       // SMTP servers
$mail->SMTPAuth = true;                             // turn on SMTP authentication
$mail->Username = "";                          // SMTP username     注意：普通邮件认证不需要加 @域名
$mail->Password = "";                         // SMTP password
$mail->From = "800@erlitech.com";                      // 发件人邮箱
$mail->FromName = "三秦品牌网";                 //   发件人 ,比如 中国资金管理网
$mail->CharSet = "GB2312";                          // 这里指定字符集！
$mail->Encoding = "base64";
$mail->AddAddress($sendto_email,$user_name);        // 收件人邮箱和姓名
$mail->AddReplyTo("800@erlitech.com","三秦品牌网");
//$mail->WordWrap = 50; // set word wrap
//$mail->AddAttachment("/var/tmp/file.tar.gz");                                                    // attachment  附件1
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");                                         //附件2
$mail->IsHTML(true);                               // send as HTML
$mail->Subject = $subject;
// 邮件内容      可以直接发送html文件
$mail->Body = $body;
$mail->AltBody ="text/html";
$mail->Send();
}


function chk_user_login($uid,$shell){
	global $db,$dbpre;
	$sql="SELECT * FROM `{$dbpre}member` WHERE `id`='$uid'";
	$query=$db->query($sql);
	$us=is_array($row=$db->fetch_array($query));
    $isuser=$us ? $shell==md5($row[userid].$row[userpwd]."XMF1"):FALSE;
	if($isuser){
		return $row;
	}else{
		setcookie("fj_usersid","");
    	setcookie("fj_usershell","");
		ShowMsg("你无权限访问该面，请返回进行登录！","login.php");
	}
}

function is_login($uid,$shell){
	global $db,$dbpre;
	$sql="SELECT * FROM `{$dbpre}member` WHERE `id`='$uid'";
	$query=$db->query($sql);
	$us=is_array($row=$db->fetch_array($query));
    $isuser=$us ? $shell==md5($row[userid].$row[userpwd]."XMF1"):FALSE;
	if($isuser){
		return $row;
	}
}

function RecentlyGoods($rid,$count){
$TempNum=$count;
if (isset($_COOKIE['RecentlyGoods']))
{
$oknum=$RecentlyGoods=$_COOKIE['RecentlyGoods'];
$RecentlyGoodsArray=explode(",", $RecentlyGoods);
$num=count($RecentlyGoodsArray); //RecentlyGoodsNum 当前存储的变量个数

}else{
	$RecentlyGoodsArray=array();
	$num=0;
}
if($rid!="")
{

   $Id=$rid; //ID 为得到请求的字符


    //如果存在了，则将之前的删除，用最新的在尾部追加

   if (in_array($Id,$RecentlyGoodsArray))
    {
  //   echo "已经存在,则不写入COOKIES <hr />";
    }
   else
   {
      if($num < $TempNum) //如果COOKIES中的元素小于指定的大小，则直接进行输入COOKIES
       {
         if(empty($_COOKIE[RecentlyGoods]))
           {
             setcookie("RecentlyGoods",$Id,time()+3600);

           }
         else
          {
           $RecentlyGoodsNew=$_COOKIE[RecentlyGoods].",".$Id;
           setcookie("RecentlyGoods", $RecentlyGoodsNew,time()+3600);
          }
       }
       else //如果大于了指定的大小后，将第一个给删去，在尾部再加入最新的记录。
       {
          $pos=strpos($_COOKIE[RecentlyGoods],",")+1; //第一个参数的起始位置
          $FirstString=substr($_COOKIE[RecentlyGoods],0,$pos); //取出第一个参数
          $_COOKIE[RecentlyGoods]=str_replace($FirstString,"",$_COOKIE[RecentlyGoods]); //将第一个参数删除
          $RecentlyGoodsNew=$_COOKIE[RecentlyGoods].",".$Id; //在尾部加入最新的记录
          setcookie("RecentlyGoods", $RecentlyGoodsNew,time()+3600);
       }
   }
}

//RecentlyGoods 最近商品RecentlyGoods临时变量
return $oknum;

}
?>