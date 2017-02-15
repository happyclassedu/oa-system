<?php
/**
 * 文件名称：mod_phase.php
 * 功能描述：招聘会信息管理系统
 * 代码作者：钱宝伟(创建)，王争强（优化）
 * 创建日期：2010-06-07
 * 修改日期：2010-06-12
 * 当前版本：V2.0
 */
class mod_phase {
    //====定义此类私有变量==========
    private $xdb;  //数据库操作实体
    private $xtb;  //主要操作数据库表

    //====始化此类初方法==========
    function __construct() {
        global $g_xdb;
        $this->xdb = $g_xdb;
        $this->xtb = '#@__zph_phase';
        $this->atb = '#@__zph_info';
    }
    /*
    *read_list全查询数据，返回一个数组
    */
    function read_list() {
//        $fid = $_GET['fid'];
        $result_arr = array();
        $show_num = $_GET['show_num'];   //一页显示多少行数据
        $page_now = $_GET['page_now'];   //总共多少页
        $info_s = $show_num * $page_now - $show_num;
        $val_search = $this->val_search_get();
        $result_arr_f = $this->xdb->read_all($this->xtb ,'id, phase_name, phase_type, date_s, state' , 'id<>0' . $val_search . ' ORDER BY date_s DESC');
        for($i = 0; $i<count($result_arr_f); $i++){
           $tmp_arr[$i] = $this->read_list_count($result_arr_f[$i]['id']);
           $result_arr[$i] = array(
                    'id' => $result_arr_f[$i]['id'],
                    'phase_name' => $result_arr_f[$i]['phase_name'],
                    'phase_type' => $result_arr_f[$i]['phase_type'],
                    'date_s' => $result_arr_f[$i]['date_s'],
                    'state' => $result_arr_f[$i]['state'],
                    'com_num' => $tmp_arr[$i][0]['com_num'],
                    'job_sum' => $tmp_arr[$i][0]['job_sum'],
                    'recruit_sum' => $tmp_arr[$i][0]['recruit_sum'],
           );
        }
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    /*
    *read_list_count 计算出对应数据，返回一个数组
    */
    function read_list_count($fid) {
        $result_arr = $this->xdb->read_all($this->atb ,'COUNT(fid) AS com_num, SUM(job_num) AS job_sum, SUM(recruit_num) AS recruit_sum' , 'fid=' . $fid . ' ');
        return $result_arr;
    }

    /*
    *read_num查询信息列表的总行数
    */
    function read_num() {
        $val_search = $this->val_search_get();
        $result_arr = $this->xdb->read_num($this->xtb, 'id<>"0" ' . $val_search . ' ');
        print_r($result_arr) ;
    }

    function val_search_get() {
        $val_search = @$_POST['val_search'];
        $val_search = i_json2php($val_search);
        if ('' != $val_search) {
            $val_search = ' AND ( phase_name LIKE "%' . $val_search . '%" OR phase_type LIKE "%' . $val_search . '%" OR adress LIKE "%' . $val_search . '%" OR content LIKE "%' . $val_search. '%" OR date_s LIKE "%' . $val_search. '%" OR date_e LIKE "%' . $val_search. '%") ';
        }
        return $val_search;
    }
    /*
    * read_info根据xid读取列表信息
    */
    function  read_info($xid) {
        $result_arr = $this->xdb->read_one($this->xtb, '*', 'id="' . $xid . '"');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    /*
     *del_info根据xid删除列表信息一条信息
    */
    function del_info($xid) {
        $result_arr = $this->xdb->delete($this->xtb, 'id="' . $xid . '"');
        print_r($result_arr);
    }


    /*
     * add_info添加新信息
    */



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

    /*
    *read_phase_led全查询数据，返回一个数组
    */
    function read_phase_led() {
        $result_arr = $this->xdb->read_all($this->xtb, 'id,phase_name', 'id<>"0" ORDER BY id DESC LIMIT 0,10');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }
}
?>
