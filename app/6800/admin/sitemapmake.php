<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
$doc = new DOMDocument('1.0', 'utf-8');  // �����汾�ͱ���
$doc -> formatOutput = true;  //��ʽXML���
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
$url    = $doc -> createElement('url');    //����һ����ǩ
$loc    = $doc -> createElement('loc');    //����һ����ǩ
$id    = $doc -> createAttribute('id');      //����һ������
$newsid  = $doc -> createTextNode($row[id]);        //������������
$newsco = $doc -> createTextNode($xm_global['cfg_basehost']."/info.php?id=".$row[id]);      //���ñ�ǩ����

$lastmod    = $doc -> createElement('lastmod');
$modtime  = $doc -> createTextNode(date('c',$row[update]));
$changefreq    = $doc -> createElement('changefreq');
$freqtype  = $doc -> createTextNode('daily');
$priority   = $doc -> createElement('priority');
$prival  = $doc -> createTextNode('0.5');


$id        -> appendChild($newsid);    //�̳�����
$loc    -> appendChild($id);                  //�̳���������
$loc    -> appendChild($newsco);    //�̳б�ǩ����      //�̳�����
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
	$main_sitemap = new DOMDocument('1.0', 'utf-8');  // �����汾�ͱ���
	$main_sitemap -> formatOutput = true;  //��ʽXML���
	$sitemapindex    = $main_sitemap -> createElement('sitemapindex');
	$xmlns    = $main_sitemap -> createAttribute('xmlns');
	$xmlnsvalue  = $main_sitemap -> createTextNode("http://www.sitemaps.org/schemas/sitemap/0.9");
$sitemap    = $main_sitemap -> createElement('sitemap');    //����һ����ǩ
$loc    = $main_sitemap -> createElement('loc');    //����һ����ǩ
$id    = $main_sitemap -> createAttribute('id');      //����һ������
$newsid  = $main_sitemap -> createTextNode($page);        //������������
$newsco = $main_sitemap -> createTextNode($xm_global['cfg_basehost']."/sitemap_".$page.".xml");      //���ñ�ǩ����
$xmlns -> appendChild($xmlnsvalue);
$sitemapindex        -> appendChild($xmlns);
$id        -> appendChild($newsid);    //�̳�����
$loc    -> appendChild($id);                  //�̳���������
$loc    -> appendChild($newsco);    //�̳б�ǩ����
$sitemap    -> appendChild($loc);        //�̳�����
$sitemapindex    -> appendChild($sitemap);

	$main_sitemap   -> appendChild($sitemapindex);
	$main_sitemap    -> save("../sitemap.xml");
}else{
$main_sitemap = new DOMDocument('1.0', 'utf-8');  // �����汾�ͱ���
$main_sitemap->preserveWhiteSpace = false;
$main_sitemap -> formatOutput = true;  //��ʽXML���
$main_sitemap->load("../sitemap.xml");
$notes = $main_sitemap->documentElement;
$sitemap    = $main_sitemap -> createElement('sitemap');    //����һ����ǩ
$loc    = $main_sitemap -> createElement('loc');    //����һ����ǩ
$id    = $main_sitemap -> createAttribute('id');      //����һ������
$newsid  = $main_sitemap -> createTextNode($page);        //������������
$newsco = $main_sitemap -> createTextNode($xm_global['cfg_basehost']."/sitemap_".$page.".xml");      //���ñ�ǩ����
$id        -> appendChild($newsid);    //�̳�����
$loc    -> appendChild($id);                  //�̳���������
$loc    -> appendChild($newsco);    //�̳б�ǩ����
$sitemap    -> appendChild($loc);        //�̳�����
$notes    -> appendChild($sitemap);
$main_sitemap    -> appendChild($notes);
$main_sitemap    -> save("../sitemap.xml");
}
//=================================
if($page<$pg){
	echo "sitemap_".$page."������ɣ���������һ������";
	$page++;
echo "<script>location.href='?page=".$page."';</script>";
}else{
	echo "������ɣ�";
	exit();
}
?>
