<?php

/**
 * 文件名称：mod_trans.php
 * 功能描述：人事档案管理模型
 * 代码作者：王争强
 * 创建日期：2010-06-10
 * 修改日期：2010-06-10
 * 当前版本：V1.0
 */
class mod_trans {

    //====定义此类私有变量==========
    private $xdb;
    //数据库操作实体
    private $xtb;  //主要操作数据库表,员工信息表

//    private $ntb;   //调动管理表

//    private $atb;   //员工部门关系表
//    private $btb;   //部门表
    //====始化此类初方法==========
    function __construct() {
        global $g_xdb;
        $this->xdb = $g_xdb;
        $this->ntb = '#@__work';
        $this->rtb = '#@__human_org_r';
        $this->mtb = '#@__work_change';
        $this->xtb = '#@__human AS x';
        $this->atb = ' #@__work AS a ';
        $this->btb = ' #@__human_org_r AS b ';
//        $this->atb = '#@__human_org_r';
//        $this->btb = '#@__org';
//        $this->ctb = '#@__org  AS c';
        $this->dtb = '#@__work  AS d';
        $this->etb = '#@__human';
        $this->ptb = '#@__post';
    }

    //====基本操作方法开始========
    function read_list() {
        $show_num = @$_GET['show_num'];
        $page_now = @$_GET['page_now'];
        $info_s = $show_num * $page_now - $show_num;
        $val_search = $this->val_search_get();
        $result_arr = $this->xdb->read_all(
                        $this->xtb . '
                            LEFT JOIN (SELECT * FROM (SELECT * FROM ' . $this->atb . ' ORDER BY oid DESC) AS tmp GROUP BY human_id) AS y ON y.human_id = x.id
                            LEFT JOIN (SELECT * FROM (SELECT * FROM ' . $this->btb . ' ORDER BY oid DESC) AS tmp GROUP BY human_id) AS z ON z.human_id = x.id',
                        'x.id, x.name, x.code, y.position, z.org_name, z.office_name, z.post_name',
                        'x.drwx=0 ' . $val_search . ' ORDER BY id DESC LIMIT ' . $info_s . ',' . $show_num . ''
        );
//        ('(SELECT e.id , e.name as human_name, e.code AS human_code , e.grad_degree , e.grad_univ, e.grad_major , e.tel_1, d.id AS work_id ,d.position, d.position_grade, d.position_state, d.work_state FROM  ( SELECT * FROM ' . $this->ntb . ' WHERE  drwx="0"  ' . $val_search . ' ORDER BY id DESC LIMIT  ' . $info_s . ',' . $show_num . '  ) AS d  LEFT JOIN ( SELECT * FROM ' . $this->etb . ' WHERE drwx="0") AS e  ON  e.id=d.human_id) AS l
//    LEFT JOIN (SELECT b.id , b.name , b.fid , c.name AS fname , a.human_id, a.post_id , a.post_name FROM ( SELECT * FROM ' . $this->btb . ' WHERE drwx="0") AS b , ( SELECT * FROM ' . $this->btb . ' WHERE drwx="0") AS c , ( SELECT * FROM ' .$this->atb . ' WHERE drwx="0") AS a  WHERE b.fid = c.id AND a.org_id = c.id) AS h ON l.id = h.human_id',
//                'h.id , h.name , h.fid , h.fname ,h.human_id , h.post_id , h.post_name, l.work_id , l.human_name , l.human_code  ,l.grad_degree , l.grad_univ , l.grad_major , l.tel_1 , l.position , l.position_grade , l.position_state , l.work_state ');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function read_num() {
        $val_search = $this->val_search_get();
        $result_arr = $this->xdb->read_num($this->ntb, 'drwx="0" ' . $val_search . ' ');
        print_r($result_arr);
    }

    function read_chang_list() {
        $show_num = @$_GET['show_num'];
        $page_now = @$_GET['page_now'];
        $info_s = $show_num * $page_now - $show_num;
//        $result_arr = $this->xdb->read_all('( SELECT * FROM ' . $this->mtb .' WHERE drwx="0" ' . $val_search . ' ORDER BY id DESC LIMIT  ' . $info_s . ',' . $show_num . ' ) AS x  LEFT JOIN (SELECT * FROM ' .$this->xtb . ' WHERE  drwx="0" ) AS y ON  y.id=x.human_id ', 'y.code, y.name, x.id, x.human_id, x.position_state, x.position,x.atime, x.down_time, x.down_state');
        $result_arr = $this->xdb->read_all('( SELECT * FROM  lh_work_change WHERE drwx="0"  ) AS x  LEFT JOIN (SELECT * FROM lh_human WHERE  drwx="0" ) AS y ON  y.id=x.human_id ', 'y.code, y.name, x.id, x.human_id, x.position_state, x.position,x.atime, x.down_time, x.down_state');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function read_chang_num() {
//        $val_search = $this->val_search_get();
        $result_arr = $this->xdb->read_num($this->mtb, 'drwx="0" ');
        print_r($result_arr);
    }

    function member_list() {
        $show_num = @$_GET['show_num'];
        $page_now = @$_GET['page_now'];
        $info_s = $show_num * $page_now - $show_num;
        $val_search = $this->val_search_get();
        $result_arr = $this->xdb->read_all(
                        $this->xtb . '
                            LEFT JOIN (SELECT * FROM (SELECT * FROM ' . $this->atb . ' ORDER BY oid DESC) AS tmp GROUP BY human_id) AS y ON y.human_id = x.id
                            LEFT JOIN (SELECT * FROM (SELECT * FROM ' . $this->btb . ' ORDER BY oid DESC) AS tmp GROUP BY human_id) AS z ON z.human_id = x.id',
                        'x.id, x.name, x.code, y.position, z.org_name, z.office_name, z.post_name',
                        'x.drwx=0 ' . $val_search . ' ORDER BY id DESC LIMIT ' . $info_s . ',' . $show_num . ''
        );
//                '( SELECT * FROM ' . $this->xtb . ' WHERE  drwx="0"  ' . $val_search . ' ORDER BY id DESC LIMIT  ' . $info_s . ',' . $show_num . '  )  AS x  LEFT JOIN ( SELECT * FROM ' . $this->rtb . ' WHERE drwx="0") AS y ON x.id = y.human_id ', 'x.id ,x.code, x.name, y.org_name, y.office_name, y.post_name, y.position');//AND x.drwx="0" AND y.drwx="0" ' . $val_search . ' ORDER BY id DESC LIMIT  ' . $info_s . ',' . $show_num . ' '

        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

//$this->xdb->read_all('lh_human AS x  LEFT JOIN lh_human_org_r AS y ON x.id = y.human_id', 'x.code, x.name, y.org_name, y.office_name, y.post_name, y.position');
    function member_num() {
        $val_search = $this->val_search_get();
        $result_arr = $this->xdb->read_num($this->xtb, 'drwx="0" ' . $val_search . ' ');
        print_r($result_arr);
    }

    function member_info($xid) {
        $result_arr = $this->xdb->read_one($this->xtb, '*', 'drwx="0" AND id="' . $xid . '"');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function val_search_get() {
        $val_search = @$_POST['val_search'];
        $val_search = i_json2php($val_search);
        if ('' != $val_search) {
            $val_search = ' AND ( x.code LIKE "%' . $val_search . '%" OR x.name LIKE "%' . $val_search . '%" OR x.grad_degree LIKE "%' . $val_search . '%" OR x.grad_univ LIKE "%' . $val_search . '%" OR x.grad_major LIKE "%' . $val_search . '%") ';
        }
        return $val_search;
    }

    /*     * 读取列表信息 */

    function read_info($xid) {
        $result_arr = $this->xdb->read_one(
                        $this->xtb . '
                            LEFT JOIN (SELECT * FROM (SELECT * FROM ' . $this->atb . ' ORDER BY oid DESC) AS tmp GROUP BY human_id) AS y ON y.human_id = x.id',
                        'x.name AS human_name, x.code AS human_code, y.*',
                        'x.drwx=0 AND x.id="' . $xid . '"'
        );
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function del_info($xid) {
        $result_arr = $this->xdb->update($this->mtb, 'drwx="4"', 'id="' . $xid . '"');
        print_r($result_arr);
    }

    function add_info() {
        $arr = $_POST['arr'];
        $arr = i_json2php($arr);

        $fields = array();
        $fields = $this->xdb->read_xtb_fields($this->mtb);
        $insert_fields = $insert_values = '';

        foreach ($arr as $key => $val) {
            if ($key <> 'id' && in_array($key, $fields)) {
                $insert_fields .= ',' . $key . ' ';
                $insert_values .= ', "' . $val . '" ';
            }
        }  //foreach

        if ('' == $insert_fields) {
            print_r($arr);
            return;
        }

        $result_arr = $this->xdb->insert($this->mtb, $insert_fields, $insert_values);
        return $result_arr;
    }

    function add_info_r() {
        $arr = $_POST['arr_r'];
        $arr = i_json2php($arr);

        $fields = array();
        $fields = $this->xdb->read_xtb_fields($this->rtb);
        $insert_fields = $insert_values = '';

        foreach ($arr as $key => $val) {
            if ($key <> 'id' && in_array($key, $fields)) {
                $insert_fields .= ',' . $key . ' ';
                $insert_values .= ', "' . $val . '" ';
            }
        }

        if ('' == $insert_fields) {
            print_r($arr);
            return;
        }

        $result_arr = $this->xdb->insert($this->rtb, $insert_fields, $insert_values);
        return $result_arr;
    }

    function add_affair_info() {
        if ($this->add_info() > 0) {
            if ($this->add_info_r() > 0) {
                print_r('1');
            } else {
                die('录入员工部门信息出错！');
            }
        } else {
            die('录入工作信息变更出错！');
        }
    }

    function edit_info($xid) {
        $arr = $_POST['arr'];
//        $arr = i_json2php($arr);
//
//        $fields = array();
//        $fields = $this->xdb->read_xtb_fields($this->ntb);
//        $updata_values = '';
//
//        foreach($arr as $key => $val) {
//            if ($key <> 'id' && in_array($key, $fields)) {
//                $updata_values .= ',' . $key . '="' . $val . '" ';
//            }
//        }  //foreach
//
//        if ('' == $updata_values) {
//            print_r($arr);
//            return;
//        }
//        $result_arr = $this->xdb->update($this->ntb, $updata_values, 'id='.$xid);
        echo $result_arr;
    }

    function read_org($xid) {
        $result_arr = $this->xdb->read_all($this->btb, 'id, org_id, org_name, office_id, office_name, post_id, post_name', 'drwx="0" AND human_id="' . $xid . '" ORDER BY oid');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function org_info() {
        $result_arr = $this->xdb->read_all($this->btb, ' id ,name , fid , intro , remark', 'drwx="0"' . ' ');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function office_info($xid) {
        $result_arr = $this->xdb->read_all($this->btb, 'id ,name , fid , intro , remark', 'drwx="0"  AND fid=' . $xid . ' ');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function post_info() {
        $result_arr = $this->xdb->read_all($this->ptb, 'id , post_name , post_aim , post_duty', 'drwx="0" ');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function enter_info($xid) {
        $result_arr = $this->xdb->read_one($this->mtb, '*', 'drwx="0" AND human_id=' . $xid . ' ');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function info_inure($xid) {
        $insert_values = $this->xdb->read_one($this->mtb, '*', 'drwx="0" AND id="' . $xid . '"');
        if ('0' == $insert_values['down_state']) {
            $result_arr = $this->xdb->update($this->mtb, 'down_time="' . i_time() . '" , down_state="1"', 'id=' . $xid);
            $result_arr = $this->xdb->insert($this->ntb, 'atime , human_id , employ_time , position , position_grade , report_to ,work_state , position_state , employ_form , post_allowance , grad_degree_grade'
                            , '"' . i_time() . '" , "' . $insert_values['human_id'] . '" , "' . $insert_values['employ_time'] . '" , "' . $insert_values['position'] . '" , "' . $insert_values['position_grade'] . '" , "'
                            . $insert_values['report_to'] . '" , "' . $insert_values['work_state'] . '" , "' . $insert_values['position_state'] . '" , "' . $insert_values['employ_form'] . '" , "' . $insert_values['post_allowance'] . '" , "' . $insert_values['grad_degree_grade'] . '"');
        }
        print_r($result_arr);
    }

    function info_time() {
        $result_arr = i_time();
        print_r($result_arr);
    }

//    function stat_info() {
//        $stat = $_POST['stat'];
//        $result_arr = $this->xdb->read_all($this->xtb, '* ', 'id<>"0" GROUP BY degree');
//        return $result_arr;
//    }
}
?>