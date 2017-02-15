<?php
/*
 * 文件名称：mod_mdi_lefter.php
 * 功能描述：主窗口lefter模型。
 * 代码作者：孙振强
 * 创建日期：2009-11-28
 * 修改日期：2010-08-09
 * 当前版本：V3.0
*/

class mod_mdi_lefter {
    var $xdb;
    var $xtb;

    function __construct() {
        global $g_xdb;
        $this->xdb = $g_xdb;
        $this->xtb = 'lh_type';
    }

    function read_type_list() {
        $where = ' uid="'.u_id.'" AND drwx=0 ORDER BY oid DESC ';
        $fields = '*';
        $arr = $this->xdb->read_all('lh_upower', $fields, $where);

        $arr_new = '';
        $arr_new[] = '31';

        if ('10' != u_tid) {
            $arr_new[] = '1611';
        }

        if ($arr != '') {
            foreach($arr as $tmp) {
                $arr_new[] = $tmp['tid'];
            }  //foreach
        }

//        if ('10' != u_tid) {
//            $arr_new[] = '1638';
//            $arr_new[] = '1613';
//            $arr_new[] = '1661';
//            $arr_new[] = '1648';
//            $arr_new[] = '58';
//        }

        $arr = $arr_new;

        $arr_new = '';
        $fields = 'id,cname';
        foreach($arr as $tmp) {
            $where = ' id="'. $tmp . '" ';
            $arr_new[] = $this->xdb->read_one($this->xtb, $fields, $where);
        }  //foreach

        $arr = $arr_new;
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**读取--全部信息--4我的桌面*/
    function read_type_info($xid) {
        $where = ' fid="'.$xid.'"  ORDER BY oid';
        $fields = 'id, cname, url, intro';
        $arr = $this->xdb->read_all($this->xtb, $fields, $where);
        $this->print_arr($arr, 1);
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