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
			echo "����Ƿ�ע�����ݣ�";
			exit ();
		} else {
			return $sql_str;
		}
	}
function ShowMsg($msg,$gourl='',$onlymsg=0,$limittime=0)  //ҳ����ת����
{
	$htmlhead  = "<html>\r\n<head>\r\n<title>ϵͳ��ʾ</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\" />\r\n";
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
		$msg = "<script>alert(\"".str_replace("\"","��",$msg)."\");</script>";
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
		$rmsg .= "document.write(\"".str_replace("\"","��",$msg)."\");\r\n";
		$rmsg .= "document.write(\"";
		if($onlymsg==0)
		{
			if($gourl!="javascript:;" && $gourl!="")
			{
				$rmsg .= "<br /><a href='{$gourl}'>����ָ����תҳ�棬���û�з�Ӧ��������....</a>";
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
		ShowMsg("����Ȩ�޷��ʸ��棬�뷵�ؽ��е�¼��","login.html");
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

$pagecode = '';//�����������ŷ�ҳ���ɵ�HTML
$page = intval($page);//���������ҳ��
$total = intval($total);//��֤�ܼ�¼��ֵ������ȷ
if(!$total) return array();//�ܼ�¼��Ϊ�㷵�ؿ�����
$pages = ceil($total/$pagesize);//�����ܷ�ҳ
//����ҳ��Ϸ���
if($page<1) $page = 1;
if($page>$pages) $page = $pages;
//�����ѯƫ����
$offset = $pagesize*($page-1);
//ҳ�뷶Χ����
$init = 1;//��ʼҳ����
$max = $pages;//����ҳ����
$pagelen = ($pagelen%2)?$pagelen:$pagelen+1;//ҳ�����
$pageoffset = ($pagelen-1)/2;//ҳ���������ƫ����

//����html
$pagecode='<div class="page">';
$pagecode.="<span>$page/$pages</span>";//�ڼ�ҳ,����ҳ
//����ǵ�һҳ������ʾ��һҳ����һҳ������
if($page!=1){
$pagecode.="<a href=\"{$phpfile}=1\">&lt;&lt;</a>";//��һҳ
$pagecode.="<a href=\"{$phpfile}=".($page-1)."\">&lt;</a>";//��һҳ
}
//��ҳ������ҳ�����ʱ����ƫ��
if($pages>$pagelen){
//�����ǰҳС�ڵ�����ƫ��
if($page<=$pageoffset){
$init=1;
$max = $pagelen;
}else{//�����ǰҳ������ƫ��
//�����ǰҳ����ƫ�Ƴ�������ҳ��
if($page+$pageoffset>=$pages+1){
$init = $pages-$pagelen+1;
}else{
//����ƫ�ƶ�����ʱ�ļ���
$init = $page-$pageoffset;
$max = $page+$pageoffset;
}
}
}
//����html
for($i=$init;$i<=$max;$i++){
if($i==$page){
$pagecode.='<span>'.$i.'</span>';
} else {
$pagecode.="<a href=\"{$phpfile}={$i}\">$i</a>";
}
}
if($page!=$pages){
$pagecode.="<a href=\"{$phpfile}=".($page+1)."\">&gt;</a>";//��һҳ
$pagecode.="<a href=\"{$phpfile}={$pages}\">&gt;&gt;</a>";//���һҳ
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



function CatIdCheck($catable,$val){    //�ҳ������ID
	global $code,$db;
	$sql="SELECT * FROM `$catable` WHERE `pid`='$val'";
	$query=$db->query($sql);
	while($row=$db->fetch_array($query)){
		$code[]=$row[id];
		CatIdCheck($catable,$row[id]);
	}
 return $code;
}

//========��̨��Ʒ���ѡ��================


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
                    $xmelin .= "<label><input type=\"radio\" class=\"radio\" onclick='document.getElementById(\"f".$k."\").style.display = \"none\";' name=\"ifout$k\" value=\"no\" checked=\"checked\" class=\"radio\"/>Զ��ͼƬ</label>\r\n<label><input type=\"radio\" class=\"radio\" onclick='document.getElementById(\"f".$k."\").style.display = \"block\";' name=\"ifout$k\" value=\"yes\" class=\"radio\"/>�����ϴ�</label>\r\n<iframe src=\"upfile.php?id=".$k."\" width=\"450\" frameborder=\"0\" scrolling=\"no\"  id=\"f".$k."\" style=\"display:none; margin-top:10px\"></iframe>";
                }

                else if ( $k == "CateGrouy" )
                {

                    $xmelin .= "<select name=\"".$k."\"/>";
                    $xmelin .="<option value='0'>��ѡ�����</option>";
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
		echo "<tr bgcolor='#DEE5FA'><td ><font color=red>ֻ������ҳ</font></td></tr>";
	}
	elseif($changle=="all"){
		echo "<tr bgcolor='#DEE5FA'><td ><font color=red>������վ������������ģ�������ҳ��</font></td></tr>";

	}
	elseif($changle=="news"||$changle=="products"){
		?>
	<tr bgcolor='#DEE5FA'>
      <td width='175'  valign='top'>ѡ����Ŀ��</td>
      <td width='864'  valign='top'>
      <select name='typeid'>
      <option value='0' selected='1'>����������Ŀ...</option>
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
      <td height='20' valign='top'>�Ƿ��������Ŀ��</td>
      <td height='20' valign='top' >
	  <input name='upnext' type='radio' value='1' checked='1' />
     �����Ӽ���Ŀ
    <input type='radio' name='upnext'  value='0' />
     ��������ѡ��Ŀ
    </td>
    </tr>
    <tr>
<?php
	}elseif($changle=="single"){
$sql="SELECT * FROM `{$dbpre}$changle`";
$query=$db->query($sql);
?>
	<tr bgcolor='#DEE5FA'>
      <td width='175'  valign='top'>ѡ����Ŀ��</td>
      <td width='864'  valign='top'>
      <select name='typeid'>
      <option value='0' selected='1'>����������Ŀ...</option>
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
    if(strlen($str_cut) > $length){   //������⣬̫���á�����ʾ
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
$mail->Username = "";                          // SMTP username     ע�⣺��ͨ�ʼ���֤����Ҫ�� @����
$mail->Password = "";                         // SMTP password
$mail->From = "800@erlitech.com";                      // ����������
$mail->FromName = "����Ʒ����";                 //   ������ ,���� �й��ʽ������
$mail->CharSet = "GB2312";                          // ����ָ���ַ�����
$mail->Encoding = "base64";
$mail->AddAddress($sendto_email,$user_name);        // �ռ������������
$mail->AddReplyTo("800@erlitech.com","����Ʒ����");
//$mail->WordWrap = 50; // set word wrap
//$mail->AddAttachment("/var/tmp/file.tar.gz");                                                    // attachment  ����1
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");                                         //����2
$mail->IsHTML(true);                               // send as HTML
$mail->Subject = $subject;
// �ʼ�����      ����ֱ�ӷ���html�ļ�
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
		ShowMsg("����Ȩ�޷��ʸ��棬�뷵�ؽ��е�¼��","login.php");
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
$num=count($RecentlyGoodsArray); //RecentlyGoodsNum ��ǰ�洢�ı�������

}else{
	$RecentlyGoodsArray=array();
	$num=0;
}
if($rid!="")
{

   $Id=$rid; //ID Ϊ�õ�������ַ�


    //��������ˣ���֮ǰ��ɾ���������µ���β��׷��

   if (in_array($Id,$RecentlyGoodsArray))
    {
  //   echo "�Ѿ�����,��д��COOKIES <hr />";
    }
   else
   {
      if($num < $TempNum) //���COOKIES�е�Ԫ��С��ָ���Ĵ�С����ֱ�ӽ�������COOKIES
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
       else //���������ָ���Ĵ�С�󣬽���һ����ɾȥ����β���ټ������µļ�¼��
       {
          $pos=strpos($_COOKIE[RecentlyGoods],",")+1; //��һ����������ʼλ��
          $FirstString=substr($_COOKIE[RecentlyGoods],0,$pos); //ȡ����һ������
          $_COOKIE[RecentlyGoods]=str_replace($FirstString,"",$_COOKIE[RecentlyGoods]); //����һ������ɾ��
          $RecentlyGoodsNew=$_COOKIE[RecentlyGoods].",".$Id; //��β���������µļ�¼
          setcookie("RecentlyGoods", $RecentlyGoodsNew,time()+3600);
       }
   }
}

//RecentlyGoods �����ƷRecentlyGoods��ʱ����
return $oknum;

}
?>