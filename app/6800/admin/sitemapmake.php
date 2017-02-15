<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
$doc = new DOMDocument('1.0', 'utf-8');  // 声明版本和编码
$doc -> formatOutput = true;  //格式XML输出
$sql="select `id` from `{$dbpre}company`";
$query=mysql_query($sql);
$count=mysql_num_rows($query);
$pg=intval($count/3000);
if($count%3000)
$pg++;
$page=isset($_GET['page'])?$_GET['page']:1;
$getpageinfo=page($page,$count,3000);
$sql="SELECT `id`,`update` FROM `{$dbpre}company` order by `id`  $getpageinfo[sqllimit]";
$query=$db->query($sql);
$urlset    = $doc -> createElement('urlset');

$xmlns    = $doc -> createAttribute('xmlns');
$xmlnsvalue  = $doc -> createTextNode("http://www.sitemaps.org/schemas/sitemap/0.9");

$xmlnsxsi    = $doc -> createAttribute('xmlns:xsi');
$xmlnsxsivalue  = $doc -> createTextNode("http://www.w3.org/2001/XMLSchema-instance");

$schemaLocation    = $doc -> createAttribute('xsi:schemaLocation');
$schemaLocationvalue  = $doc -> createTextNode("http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd");

$xmlns -> appendChild($xmlnsvalue);
$xmlnsxsi -> appendChild($xmlnsxsivalue);
$schemaLocation -> appendChild($schemaLocationvalue);
$urlset       -> appendChild($xmlns);
$urlset       -> appendChild($schemaLocation);
$urlset       -> appendChild($xmlnsxsi);


while($row=mysql_fetch_array($query)){
$url    = $doc -> createElement('url');    //创建一个标签
$loc    = $doc -> createElement('loc');    //创建一个标签
$id    = $doc -> createAttribute('id');      //创建一个属性
$newsid  = $doc -> createTextNode($row[id]);        //设置属性内容
$newsco = $doc -> createTextNode($xm_global['cfg_basehost']."/info.php?id=".$row[id]);      //设置标签内容

$lastmod    = $doc -> createElement('lastmod');
$modtime  = $doc -> createTextNode(date('c',$row[update]));
$changefreq    = $doc -> createElement('changefreq');
$freqtype  = $doc -> createTextNode('daily');
$priority   = $doc -> createElement('priority');
$prival  = $doc -> createTextNode('0.5');


$id        -> appendChild($newsid);    //继承属性
$loc    -> appendChild($id);                  //继承属性内容
$loc    -> appendChild($newsco);    //继承标签内容      //继承子类
$lastmod ->appendChild($modtime);
$changefreq ->appendChild($freqtype);
$priority ->appendChild($prival);
$url    -> appendChild($loc);
$url    -> appendChild($lastmod);
$url    -> appendChild($changefreq);
$url    -> appendChild($priority);
$urlset    -> appendChild($url);
}
$doc    -> appendChild($urlset);
$doc    -> save("../sitemap_".$page.".xml");
//=================================
if($page=="1"){
	$main_sitemap = new DOMDocument('1.0', 'utf-8');  // 声明版本和编码
	$main_sitemap -> formatOutput = true;  //格式XML输出
	$sitemapindex    = $main_sitemap -> createElement('sitemapindex');
	$xmlns    = $main_sitemap -> createAttribute('xmlns');
	$xmlnsvalue  = $main_sitemap -> createTextNode("http://www.sitemaps.org/schemas/sitemap/0.9");
$sitemap    = $main_sitemap -> createElement('sitemap');    //创建一个标签
$loc    = $main_sitemap -> createElement('loc');    //创建一个标签
$id    = $main_sitemap -> createAttribute('id');      //创建一个属性
$newsid  = $main_sitemap -> createTextNode($page);        //设置属性内容
$newsco = $main_sitemap -> createTextNode($xm_global['cfg_basehost']."/sitemap_".$page.".xml");      //设置标签内容
$xmlns -> appendChild($xmlnsvalue);
$sitemapindex        -> appendChild($xmlns);
$id        -> appendChild($newsid);    //继承属性
$loc    -> appendChild($id);                  //继承属性内容
$loc    -> appendChild($newsco);    //继承标签内容
$sitemap    -> appendChild($loc);        //继承子类
$sitemapindex    -> appendChild($sitemap);

	$main_sitemap   -> appendChild($sitemapindex);
	$main_sitemap    -> save("../sitemap.xml");
}else{
$main_sitemap = new DOMDocument('1.0', 'utf-8');  // 声明版本和编码
$main_sitemap->preserveWhiteSpace = false;
$main_sitemap -> formatOutput = true;  //格式XML输出
$main_sitemap->load("../sitemap.xml");
$notes = $main_sitemap->documentElement;
$sitemap    = $main_sitemap -> createElement('sitemap');    //创建一个标签
$loc    = $main_sitemap -> createElement('loc');    //创建一个标签
$id    = $main_sitemap -> createAttribute('id');      //创建一个属性
$newsid  = $main_sitemap -> createTextNode($page);        //设置属性内容
$newsco = $main_sitemap -> createTextNode($xm_global['cfg_basehost']."/sitemap_".$page.".xml");      //设置标签内容
$id        -> appendChild($newsid);    //继承属性
$loc    -> appendChild($id);                  //继承属性内容
$loc    -> appendChild($newsco);    //继承标签内容
$sitemap    -> appendChild($loc);        //继承子类
$notes    -> appendChild($sitemap);
$main_sitemap    -> appendChild($notes);
$main_sitemap    -> save("../sitemap.xml");
}
//=================================
if($page<$pg){
	echo "sitemap_".$page."生成完成，正进行下一个生成";
	$page++;
echo "<script>location.href='?page=".$page."';</script>";
}else{
	echo "生成完成！";
	exit();
}
?>
