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
        $this->xtb = 'lh_news';
        $this->atb = 'lh_saying';
    }

    /**读取--信息--单条记录至数组*/
    function read_saying() {
        $arr = $this->xdb->read_one($this->atb, '*', ' on_sys="on" ORDER BY rand() ');
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**读取--全部信息--4我的桌面*/
    function read_all_news($xid) {
        $arr = i_json2php($xid);
        $arr_new = '';
        foreach($arr as $xid) {
            $arr_new[$xid] = $this->read_news($xid);
        }  //foreach
        $this->print_arr($arr_new, 1);
    }
    /**读取--全部信息--4我的桌面*/
    function read_news($xid) {
        if ($xid == 0) {
            $arr = $this->read_all_news_my();
        } else if ($xid == 1) {
            $arr = $this->read_all_news_new();
        } else {
            $arr = $this->read_all_news_xid($xid);
        }
        return $arr;
    }

    /**读取--全部信息--4我的桌面*/
    function read_all_news_my() {
        $where = ' tid!="1534" AND uid="'.u_id.'" AND fid=0 Order BY atime DESC LIMIT 0,7 ';
        $field = 'id,title,DATE_FORMAT(atime,"%m-%d") AS stime';
        $arr = $this->xdb->read_all($this->xtb, $field, $where);
        return $arr;
    }

    /**读取--全部信息--4我的桌面*/
    function read_all_news_new() {
        $where = ' (tid=1531 Or tid=1556 Or tid=1566 Or tid=1567 Or tid=1532 Or tid=1535 Or tid=1612) And fid=0 Order By atime Desc LIMIT 0,7';
        $field = 'id, DATE_FORMAT(atime,"%m-%d") AS stime, CONCAT("[", tname, "]　", title) AS title';
        $arr = $this->xdb->read_all($this->xtb, $field, $where);
        return $arr;
    }

    /**读取--全部信息--4我的桌面*/
    function read_all_news_xid($xid) {
        $where = 'tid="'.$xid.'" And fid=0 Order By atime Desc LIMIT 0,7';
        $field = 'id,title,DATE_FORMAT(atime,"%m-%d") AS stime';
        $arr = $this->xdb->read_all($this->xtb, $field, $where);
        return $arr;
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