<?php

exit;

include_once '../inc/common.php';
$g_xtb = 'news';
$l_xtb = 'lh_ws_news';
$l_xdb = i_xdo_create('localhost');

$arr = $g_xdb->read_all($g_xtb, 'id AS oid, typeID AS menu_id, commend AS istar, hits, title AS name, content AS remark, shorttitle AS name_s, writer AS u_name, source, litpic AS img, pubdate AS atime, editdate AS etime, userID AS u_id, description AS intro, keywords AS tag, reader AS drwx', 'id<>"" LIMIT 4500, 500 ');

$i = 0;
foreach ($arr as $news) {
    if ('on' == $news['istar']) {
        $news['istar'] = 1;
    }
    $news['remark'] = i_php2json($news['remark']);

    $sql_key = '';
    $sql_val = '';
    foreach ($news as $key => $val) {
        $sql_key .= ',' . $key . ' ';
        $sql_val .= ', "' . $val . '" ';
    }

    $l_xdb->insert($l_xtb, $sql_key, $sql_val);
    echo $i++ . '<br>' ;
}

echo 'ok';
//print_r($arr);
?>
