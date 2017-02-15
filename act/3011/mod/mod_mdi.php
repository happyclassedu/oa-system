<?php
/*
 * 文件名称：mod_mdi.php
 * 功能描述：mdi模型。
 * 代码作者：孙振强
 * 创建日期：2009-11-28
 * 修改日期：2010-08-09
 * 当前版本：V3.0
*/

class mod_mdi {
    function __construct() {
        global $g_xdb;
        $this->xdb = $g_xdb;
        $this->utb = '#@__user';
        $this->mtb = '#@__mod';
        $this->atb = '#@__u_m';
    }

    /**读取--信息--单条记录至数组*/
    function read_user_info() {
        $where = ' id="'.u_id.'" ';
        $fields = 'id, name, sex, org_id, org, duty, mail, qq';
        $arr = $this->xdb->read_one($this->utb, $fields, $where);
        return $arr;
    }

    /**读取--信息--单条记录至数组*/
    function read_date() {
        include_once '../inc/date_chinese.php';
        $arr['date_chinese'] = date("Y年n月j日　") . $weekday[$cur_wday]."　".$mten[$everymonth[$j][14]].$mtwelve[$everymonth[$j][15]]."年　".$nlmon.$nlday;
        $arr['time'] = i_time();
        return $arr;
    }

    function read_menu() {
        $table = $this->atb . ' AS a, ' . $this->mtb . ' AS m ';
        $fields = ' m.id, m.f_id, m.name, m.url ';
        $where = ' (a.m_id=m.id OR a.m_id=m.f_id) AND a.drwx=0 AND m.drwx=0 AND a.u_id="' . u_id . '" ORDER BY m.f_id, a.oid DESC, m.oid ';
        $arr = $this->xdb->read_all($table, $fields, $where);
        return $arr;
    }
}
//?>