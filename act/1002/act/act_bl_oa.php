<?php
/*
 * 文件名称：mod_base_info.php
 * 功能描述：信息管理基础模型
 * 代码作者：孙振强（创建、重构）
 * 创建时间：2010-07-08
 * 修改时间：2010-07-08
 * 当前版本：v1.0
*/

include_once '../inc/common.php';
$g_xtb = 'lh_pinfo';

class mod_test {
    var $xdb;
    var $xtb;
    function __construct() {
        global $g_xdb;
        global $g_xtb;
        $this->xdb = $g_xdb;
//        $this->xtb = $g_xtb;
        $this->xtb = ' lh_pinfo AS a, lh_pinfo_huji AS b ';
        $this->sql_where = ' a.cardid!="" AND a.cardid = b.cardid AND a.cname = b.cname ';
    }

    function list_read() {
        $sql_key = ' a.id, a.cname, b.cname, a.cardid ';
        $sql_where = $this->sql_where;
        $sql_order = ' ORDER BY a.cname ';
        $sql_limit = ' LIMIT 0,1 ';
        $arr = $this->xdb->read_all($this->xtb, $sql_key, $sql_where . $sql_order . $sql_limit);
        return $arr;
    }

    function list_num() {
        $sql_where = $this->sql_where;
        $arr = $this->xdb->read_num($this->xtb, $sql_where);
        return $arr;
    }
}

$mod = new mod_test();

$arr = $mod->list_read();
echo 'all : ' . $arr . '<hr>';

//$arr = $mod->list_read();
//echo 'now : ' . count($arr,0) . '<hr>';

//print_r($arr);

//include_once 'act_date.php';

//$str = '';
//foreach ($arr as $key => $val) {
//    $tmp = act_date($val['dafee_bak']);
//    if ($tmp == '1970-01-01' || $tmp == '2000-01-01') {
//        continue;
//    }
//    echo $val['id'] . ' : ' . $tmp . ' : ' . $val['gradtime'] . ' : ' . $val['dafee_bak'] . ' <br>';
//    $str = ' dafee="' . $tmp . '" ';
//    echo $str . '<br>';
//    $g_xdb->update($g_xtb, $str, 'id="'.$val['id'].'"');
//}

//print_r($arr);
echo "<hr>" . i_act_time();
// 更新实例
//$g_xdb->update($g_xtb, 'birth="0000-00-00", gradtime="0000-00-00"', 'id="123456"');
//SELECT id, cardid, birth, SUBSTRING(cardid, 7, 8) AS birth_bak FROM lh_pinfo WHERE LENGTH(cardid)=18 AND birth!="" AND REPLACE(birth, "-", "") != SUBSTRING(cardid, 7, 8)
//SELECT id, cardid, birth, SUBSTRING(cardid, 7, 6) AS birth_bak FROM lh_pinfo WHERE LENGTH(cardid)=15 AND birth!="" AND SUBSTRING(REPLACE(birth, "-", ""), 3, 6) != SUBSTRING(cardid, 7, 6)
//SELECT id, cardid, birth, SUBSTRING(cardid, 7, 6) AS birth_bak FROM lh_pinfo WHERE LENGTH(cardid)=15 AND birth IS NULL
//SELECT id, cardid, birth, SUBSTRING(cardid, 7, 8) AS birth_bak FROM lh_pinfo WHERE LENGTH(cardid)=18 AND birth IS NULL
//SELECT id, gradtime_bak, gradtime FROM lh_pinfo WHERE gradtime_bak!="" AND gradtime IS NULL
//SELECT id, dafee_bak, dafee FROM lh_pinfo WHERE dafee_bak!="" AND dafee IS NULL
?>