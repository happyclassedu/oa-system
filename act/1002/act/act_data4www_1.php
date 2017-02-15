<?php

//exit;

define('g_app_xdb', 'wsp_host');  //本程序所使用数据库配置名称
include_once '../inc/common.php';
$g_xtb = 'lh_ws_news';
$l_xtb = 'lh_ws_news';
$l_xdb = i_xdo_create('wsp_host');

$arr = $l_xdb->read_all($l_xtb,
//        '*',
        'id, remark',
        'id>0 ORDER BY atime LIMIT 1000, 500 ');

echo count($arr);
echo '<br>' ;

$i = 0;
foreach ($arr as $news) {
//    $sql_key = '';
//    $sql_val = '';
//    foreach ($news as $key => $val) {
//        if ('id' == $key) {
//            continue;
//        }
//        $sql_key .= ',' . $key . ' ';
//        $sql_val .= ', "' . $val . '" ';
//    }
    $news['remark'] = i_js2php($news['remark']);

    $news['remark'] = urlencode($news['remark']);
//    $news['remark'] = i_php2js($news['remark']);
//    $news = i_php2json($news);
//print_r($news);
//    $g_xdb->insert($g_xtb, $sql_key, $sql_val);
//    $g_xdb->update($g_xtb, 'remark="'.$news['remark'].'"', 'id="'.$news['id'].'"');
    echo $i++ . '<br>' ;
}

echo 'ok';
//print_r($arr);
?>
