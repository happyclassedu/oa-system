<?php
/*
 * 文件名称：mod_mdi_mainer.php
 * 功能描述：主窗口mainer模型。
 * 代码作者：孙振强
 * 创建日期：2009-11-28
 * 修改日期：2010-08-09
 * 当前版本：V3.0
*/

class mod_mdi_mainer {
    var $xdb;
    var $xtb;

    function __construct() {
        global $g_xdb;
        $this->xdb = $g_xdb;
        $this->xtb = 'lh_ws_news';
        $this->atb = 'lh_saying';
    }

    /**读取--信息--单条记录至数组*/
    function read_saying() {
        $arr = $this->xdb->read_one($this->atb, '*', ' on_sys="on" ORDER BY rand() ');
        $this->print_arr($arr, 1);
        return;
    }

    /**读取--全部信息--4我的桌面*/
    function read_news_new() {
        $where = ' drwx!="4" AND ws_id="4" LIMIT 0, 10 ';
        $field = 'id, DATE_FORMAT(atime,"%m-%d") AS stime, CONCAT("[", menu_name, "]　", name_s) AS title';
        $arr = $this->xdb->read_all($this->xtb, $field, $where);
        $this->print_arr($arr, 0);
        return;
    }

    function print_arr($arr, $p_j=0) {
        if (1 == $p_j) {
            $arr = i_php2json($arr);
        }
        print_r($arr);
        exit;
    }
}
?>