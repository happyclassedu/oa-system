<?php
/**
 * 文件名称：mod_ileap.php
 * 功能描述：劳动协理员管理系统
 * 代码作者：钱宝伟、王争强
 * 创建日期：2010-06-02
 * 修改日期：2010-06-02
 * 当前版本：V1.0
 */

class mod_ileap {
    //====定义此类私有变量==========
    private $xdb;  //数据库操作实体
    private $xtb;  //主要操作数据库表

    //====始化此类初方法==========
    function __construct() {
        global $g_xdb;
        $this->xdb = $g_xdb;
        $this->xtb = '#@__ileap_info';
    }
    //====基本操作方法开始========

    function read_list() {
        $show_num = @$_GET['show_num'];
        $page_now = @$_GET['page_now'];
        $info_s = $show_num * $page_now - $show_num;
        $val_search = $this->val_search_get();
        $result_arr = $this->xdb->read_all($this->xtb . ' AS a', 'a.id,a.ileap_code,a.ileap_name,a.degree,a.job_type,a.job_addr_0,a.job_addr_1', 'a.drwx="0" ' . $val_search . ' ORDER BY id DESC LIMIT  ' . $info_s . ',' . $show_num . ' ');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }
    function  read_num() {
        $val_search = $this->val_search_get();
        $result_arr = $this->xdb->read_num($this->xtb . ' AS a', 'a.drwx="0" ' . $val_search . ' ');
        print_r($result_arr);
    }

    function val_search_get() {
        $val_search = @$_POST['val_search'];
        $val_search = i_json2php($val_search);
        if ('' != $val_search) {
            $val_search = ' AND (a.ileap_code LIKE "%' . $val_search . '%" OR a.ileap_name LIKE "%' . $val_search . '%" OR a.degree LIKE "%' . $val_search . '%" OR a.job_type LIKE "%' . $val_search. '%" OR a.job_addr_card LIKE "%' . $val_search. '%") ';
        }
        return $val_search;
    }

    /**读取列表信息*/
    function read_info($xid) {
        $result_arr = $this->xdb->read_one($this->xtb . ' AS a', 'a.*', 'a.drwx="0" AND a.id="' . $xid . '"');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function del_info($xid) {
        $result_arr =  $this->xdb->update($this->xtb, 'drwx="4"', 'id="' . $xid . '"');
        if($result_arr > 0) {
            $result_str = '删除成功!';
        } else {
            $result_str= '删除失败!';
        }
        print_r($result_arr);
    }

    function del_info_true($xid) {
        $result_arr =  $this->xdb->delete($this->xtb, 'id="' . $xid . '"');
        if($result_arr > 0) {
            $result_str = '删除成功!';
        } else {
            $result_str= '删除失败!';
        }
        return $result_str;
    }

    function  add_info() {
        $arr = $_POST['arr'];
        $arr = i_json2php($arr);

        $fields = array();
        $fields = $this->xdb->read_xtb_fields($this->xtb);
        $insert_fields = $insert_values = '';

        foreach($arr as $key => $val) {
            if ($key <> 'id' && in_array($key, $fields)) {
                $insert_fields .= ',' . $key . ' ';
                $insert_values .= ', "' . $val . '" ';
            }
        }  //foreach

        if ('' == $insert_fields) {
            print_r($arr);
            return;
        }

        $result_arr = $this->xdb->insert($this->xtb, $insert_fields, $insert_values);
        echo  $result_arr;
    }

    function  edit_info($xid) {
        $arr = $_POST['arr'];
        $arr = i_json2php($arr);
        
        $fields = array();
        $fields = $this->xdb->read_xtb_fields($this->xtb);
        $updata_values = '';

        foreach($arr as $key => $val) {
            if ($key <> 'id' && in_array($key, $fields)) {
                $updata_values .= ',' . $key . '="' . $val . '" ';
            }
        }  //foreach
        if ('' == $updata_values) {
            print_r($arr);
            return;
        }
        $result_arr = $this->xdb->update($this->xtb, $updata_values, 'id='.$xid);
        echo  $result_arr;
    }
    function search_street() {
        $result_arr = $this->xdb->read_all('lh_ileap_org', '*', 'fid="0"');
        $result_arr = i_php2json($result_arr);
        return $result_arr;
    }
    function search_community($fid) {
        $result_arr = $this->xdb->read_all('lh_ileap_org', '*', 'fid="'.$fid.'"');
        $result_arr = i_php2json($result_arr);
        return $result_arr;
    }
    function stat_info() {
        $stat = $_POST['stat'];
        $result_arr = $this->xdb->read_all($this->xtb, '* ', 'id<>"0" GROUP BY degree');
        return $result_arr;
    }
}
?>