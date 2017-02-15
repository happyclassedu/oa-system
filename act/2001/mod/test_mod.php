<?php
/**
 * 文件名称：test_mod.php
 * 功能描述：练习查询功能
 * 代码作者：钱宝伟
 * 创建日期：2010-06-22
 * 修改日期：2010-06-22
 * 当前版本：V1.0
 */
class test_mod {
     //====定义此类私有变量==========
    private $xdb;  //数据库操作实体
    private $xtb;  //主要操作数据库表

    //====始化此类初方法==========
    function __construct() {
        global $g_xdb;
        $this->xdb = $g_xdb;
        $this->xtb = '#@__leave';
    }
    //====基本操作方法开始========

     function read_list() {
        $show_num = @$_GET['show_num'];
        $page_now = @$_GET['page_now'];
        $info_s = $show_num * $page_now - $show_num;
        $val_search = $this->val_search_get();
        $result_arr = $this->xdb->read_all($this->xtb , '*', 'drwx="0" ' . $val_search . ' ORDER BY id DESC LIMIT  ' . $info_s . ',' . $show_num . ' ');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }
      function  read_num() {
        $val_search = $this->val_search_get();
        $result_arr = $this->xdb->read_num($this->xtb , 'drwx="0" ' . $val_search . ' ');
        print_r($result_arr);
    }
        /**读取列表信息*/
    function read_info($xid) {
        $result_arr = $this->xdb->read_one($this->xtb , '*', 'drwx="0" AND id="' . $xid . '"');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function val_search_get() {
        $val_search = @$_POST['val_search'];
        $val_search = i_json2php($val_search);
        if(('' != $val_search['human_code']) && ('' != $val_search['human_name']) && ('' != $val_search['leave_state'])
                && ('' != $val_search['time_s']) && ('' != $val_search['time_e'])) {
              $str_val = ' AND (  human_code LIKE "%' . $val_search['human_code'] . '%" OR human_name LIKE "%' . $val_search['human_name'] . '%" OR leave_state LIKE "%' . $val_search['leave_state'] . '%" OR in_leave_time> "' . $val_search['time_s'] . '" OR in_leave_time< "' . $val_search['time_e'] .'" ) ';
        } elseif(('' != $val_search['human_code']) && ('' != $val_search['human_name']) && ('' != $val_search['leave_state'])
                && ('' != $val_search['time_s']) && ('' == $val_search['time_e'])) {
            $str_val = ' AND (  human_code LIKE "%' . $val_search['human_code'] . '%" OR human_name LIKE "%' . $val_search['human_name'] . '%" OR leave_state LIKE "%' . $val_search['leave_state'] . '%" OR in_leave_time> "' . $val_search['time_s'] .'" ) ';
        }  elseif(('' != $val_search['human_code']) && ('' != $val_search['human_name']) && ('' != $val_search['leave_state'])
                && ('' == $val_search['time_s']) && ('' == $val_search['time_e'])) {
            $str_val = ' AND (  human_code LIKE "%' . $val_search['human_code'] . '%" OR human_name LIKE "%' . $val_search['human_name'] . '%" AND leave_state LIKE "%' . $val_search['leave_state'] .'" ) ';
        }  elseif(('' != $val_search['human_code']) && ('' != $val_search['human_name']) && ('' == $val_search['leave_state'])
                && ('' == $val_search['time_s']) && ('' == $val_search['time_e'])) {
            $str_val = ' AND (  human_code LIKE "%' . $val_search['human_code'] . '%" OR human_name LIKE "%' . $val_search['human_name'] .'" ) ';
        } elseif(('' != $val_search['human_code']) && ('' == $val_search['human_name']) && ('' == $val_search['leave_state'])
                && ('' == $val_search['time_s']) && ('' == $val_search['time_e'])) {
            $str_val = ' AND (  human_code LIKE "%' . $val_search['human_code']  .'" ) ';
        } elseif(('' == $val_search['human_code']) && ('' != $val_search['human_name']) && ('' == $val_search['leave_state'])
                && ('' == $val_search['time_s']) && ('' == $val_search['time_e'])) {
            $str_val = ' AND (  human_name LIKE "%' . $val_search['human_name']  .'" ) ';
        } elseif(('' == $val_search['human_code']) && ('' == $val_search['human_name']) && ('' != $val_search['leave_state'])
                && ('' == $val_search['time_s']) && ('' == $val_search['time_e'])) {
            $str_val = ' AND (  leave_state LIKE "%' . $val_search['leave_state']  .'" ) ';
        } elseif(('' == $val_search['human_code']) && ('' == $val_search['human_name']) && ('' == $val_search['leave_state'])
                && ('' != $val_search['time_s']) && ('' != $val_search['time_e'])) {
             $str_val = ' AND (  in_leave_time> "' . $val_search['time_s'] . '" OR in_leave_time< "' . $val_search['time_e'] .'" ) ';
        } elseif(('' == $val_search['human_code']) && ('' != $val_search['human_name']) && ('' == $val_search['leave_state'])
                && ('' != $val_search['time_s']) && ('' != $val_search['time_e'])) {
             $str_val = ' AND (  human_name LIKE "%' . $val_search['human_name'] . '%" OR in_leave_time> "' . $val_search['time_s'] . '" OR in_leave_time< "' . $val_search['time_e'] .'" ) ';
        } elseif(('' != $val_search['human_code']) && ('' == $val_search['human_name']) && ('' != $val_search['leave_state'])
                && ('' == $val_search['time_s']) && ('' == $val_search['time_e'])) {
            $str_val = ' AND (  human_code LIKE "%' . $val_search['human_code'] . '%" AND leave_state LIKE "%' . $val_search['leave_state'] .'%") ';
        } elseif(('' == $val_search['human_code']) && ('' != $val_search['human_name']) && ('' != $val_search['leave_state'])
                && ('' == $val_search['time_s']) && ('' == $val_search['time_e'])) {
             $str_val = ' AND (  human_name LIKE "%' . $val_search['human_name'] . '%" AND leave_state LIKE "%' . $val_search['leave_state'] . '%" ) ';
        } elseif(('' == $val_search['human_code']) && ('' == $val_search['human_name']) && ('' == $val_search['leave_state'])
                && ('' == $val_search['time_s']) && ('' == $val_search['time_e'])) {
            $str_val = ' ';
        }
        return $str_val;
    }

      function human_list() {
        $result_arr = $this->xdb->read_all('#@__human' , '*', 'drwx="0"');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

}
?>
