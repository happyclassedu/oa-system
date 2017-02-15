<?php
/*
 * 文件名称：mod_recruit.php
 * 功能描述：招聘会信息管理类
 * 代码作者：王争强
 * 当前版本：V1.0
 * 创建日期：2010-05-25
 * 修改日期：2010-05-25
*/
class mod_recruit {
    //====定义此类私有变量==========
    private $xdb;  //数据库操作实体
    private $xtb;  //主要操作数据库表
    private $atb;
    private $ntb;

    //====始化此类初方法==========
    function __construct() {
        global $g_xdb;
        $this->xdb = $g_xdb;
        $this->xtb = '#@__zph_info AS x';
        $this->atb = '#@__zph_phase AS a';
        $this->ntb = '#@__zph_info';
    }
    //====基本操作方法开始========
  function read_list() {
        $fid = $_GET['fid'];
        $show_num = $_GET['show_num'];
        $page_now = $_GET['page_now'];
        $info_s = $show_num * $page_now - $show_num;
        $val_search = $this->val_search_get();
        $result_arr = $this->xdb->read_all($this->xtb, 'x.id, x.com_name, x.job_a, x.job_b, x.job_c, x.job_num, x.recruit_num  ', ' x.fid="' . $fid . '" ' . $val_search . ' ORDER BY id DESC LIMIT ' . $info_s . ',' . $show_num . ' ');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function  read_num() {
        $fid = $_GET['fid'];    
        $val_search = $this->val_search_get();
        $result_arr = $this->xdb->read_num($this->xtb, 'x.fid="'.$fid.'" '. $val_search .' ' );
        print_r($result_arr);
    }

     /**读取列表信息*/
    function read_info($xid) {
        $result_arr = $this->xdb->read_one($this->xtb, '*', 'id="' . $xid . '"');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

      /**复制信息*/
    function copy_info($xid) {
        $result_arr = $this->xdb->read_one($this->xtb, '*', 'id="' . $xid . '"');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

     function val_search_get() {
        $val_search = @$_POST['val_search'];
        $val_search = i_json2php($val_search);
        if ('' != $val_search) {
            $val_search = ' AND (  x.com_name LIKE "%' . $val_search . '%" OR x.job_a LIKE "%' . $val_search . '%" OR x.job_b LIKE "%' . $val_search . '%" OR x.job_c LIKE "%' . $val_search . '%" ) ';
        }
        return $val_search;
    }

     function del_info($xid) {
        $result_arr =  $this->xdb->delete($this->ntb, 'id="' . $xid . '"');
        echo $result_arr;   
    }

     function  add_info() {
        $arr = $_POST['arr'];
        $arr = i_json2php($arr);

        $fields = array();
        $fields = $this->xdb->read_xtb_fields($this->ntb);
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

        $result_arr = $this->xdb->insert($this->ntb, $insert_fields, $insert_values);
        echo  $result_arr;
    }

    function  edit_info($xid) {
        $arr = $_POST['arr'];
        $arr = i_json2php($arr);

        $fields = array();
        $fields = $this->xdb->read_xtb_fields($this->ntb);
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
        $result_arr = $this->xdb->update($this->ntb, $updata_values, 'id='.$xid);
        echo  $result_arr;
    }
    
    function recruit_phase() {
        $fid = $_GET['fid'];    
        $result_arr = $this->xdb->read_all($this->atb, '*', 'a.id="'.$fid.'"');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    /*
    *read_phase_led全查询数据，返回一个数组
    */
    function read_recruit_led($fid) {
        $result_arr = $this->xdb->read_all($this->xtb. ' , ' . $this->atb, 'x.id, x.com_name, x.job_a, x.job_b, x.job_c', 'x.fid="'.$fid.'" AND a.id=x.fid  ORDER BY id DESC');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }
}
?>
