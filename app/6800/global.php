<?php
include_once (dirname(__FILE__).'/configs/config.php');
include_once (dirname(__FILE__).'/include/smarty/Smarty.class.php');
include_once (dirname(__FILE__).'/include/db.class.php');
include_once (dirname(__FILE__).'/include/common.fun.php');
include_once (dirname(__FILE__).'/include/global.inc.php');
$db= new mysql($mydbhost,$mydbuser,$mydbpwd,$mydbname,$mydbcharset);

$smarty=new smarty();
$smarty->template_dir       = $smarty_template_dir;
$smarty->compile_dir        = $smarty_compile_dir;
$smarty->config_dir         = $smarty_config_dir;
$smarty->cache_dir          = $smarty_cache_dir;
$smarty->caching            = $smarty_caching;
$smarty->left_delimiter     = $smarty_delimiter[0];
$smarty->right_delimiter    = $smarty_delimiter[1];

$userinfo=is_login($_COOKIE[fj_usersid],$_COOKIE[fj_usershell]);
$smarty->assign('userinfo',$userinfo);
?>
