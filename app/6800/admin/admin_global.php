<?php
session_start();
$sBasePath = "../include/FCKeditor/";
include_once(dirname(__FILE__).'/../include/db.class.php');
include_once(dirname(__FILE__).'/../configs/config.php');
include_once(dirname(__FILE__).'/../include/common.fun.php');
include_once(dirname(__FILE__).'/../include/global.inc.php');
include_once (ELIN_SMARTY.'/Smarty.class.php');
$charset='GBK';
$db= new mysql($mydbhost,$mydbuser,$mydbpwd,$mydbname,$charset);
$smarty=new smarty();
$smarty->template_dir       = $smarty_template_dir;
$smarty->compile_dir        = $smarty_compile_dir;
$smarty->config_dir         = $smarty_config_dir;
$smarty->cache_dir          = $smarty_cache_dir;
$smarty->caching            = $smarty_caching;
$smarty->left_delimiter     = $smarty_delimiter[0];
$smarty->right_delimiter    = $smarty_delimiter[1];

$sql="SELECT * FROM `xm_sysconfig`";
$query=$db->query($sql);
while($row=mysql_fetch_array($query)){
$xm_global[$row[varname]]=$row[value];
}
global $xm_global;

?>
