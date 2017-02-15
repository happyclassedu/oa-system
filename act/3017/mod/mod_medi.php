<?php
/**
 * 文件名称：mod_medi.php
 * 功能描述：医疗保险系统模型
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改日期：2010-07-13
 * 当前版本：V1.0
 */

i_mod_base_info();

class mod_medi extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__medi_info4laodong';
        $this->ytb = '#@__medi_plog4laodong';
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);
        if ('' != $this->val_search) {
            $this->search = '';
            foreach ($this->val_search as $key => $val) {
                if ('' != $val) {
                    $this->search .= ' AND x.' . $key . ' LIKE "%' . $val . '%" ';
                }
            }
//            $this->search =
//                    ' AND x.name LIKE "%' . $this->val_search['name'] . '%"
//                    AND x.medi_state LIKE "%' . $this->val_search['medi_state'] . '%"
//                    AND x.idcard LIKE "%' . $this->val_search['idcard'] . '%"
//                    AND x.medi_code LIKE "%' . $this->val_search['medi_code'] . '%"';
//                    AND x.record_code LIKE "%' . $this->val_search['record_code'] . '%" ';
        }else{
            $this->search = '';
        }
    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        $table = $this->xtb . ' AS x ';
        $field = ' x.id, x.name, x.birth, x.idcard, x.medi_state, x.record_code, x.record_state, x.medi_code, x.jmedi_time, x.pay_deadtime';
        $where = ' x.drwx=0 ';
        $order = ' ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num() {
        $table = $this->xtb . ' AS x ';
        $where = ' x.drwx=0 ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * info_read:根据$xid读取一条信息内容.
     * @param $xid:信息id.
     * @return $arr:空or数组加密后的字符串.
     */
    function info_read($xid) {
        i_xid_check($xid);
        $table = $this->xtb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND id="' . $xid . '" ';
        $arr = $this->info_read_base($table, $field, $where);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * info_del:根据$xid进行信息的软删除.
     * @param $xid:信息id.
     * @return $arr:0（失败）或1（成功）.
     */
    function info_del($xid) {
        $arr = $this->info_del_base($xid);
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * info_del_true:根据$xid进行信息的硬删除.
     * @param $xid:信息id.
     * @return $arr:0（失败）或1（成功）.
     */
    function info_del_true($xid) {
        $arr = $this->info_del_true_base($xid);
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * info_add:新增信息的保存操作.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:0（失败）或其他数字（成功，新信息的id）.
     */
    function info_add() {
        $arr = $this->info_add_base();
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * info_edit:修改信息的保存操作.
     * @param $xid:信息id.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:0（失败）或1（成功）.
     */
    function info_edit($xid) {
        $arr = $this->info_edit_base($xid);
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_moh($xid) {
        $table = $this->ytb . ' AS x ';
        $field = ' x.id, x.time, x.uname, x.ytype, x.yname, x.ytext';
        $where = ' x.drwx=0 AND x.pid=' . $xid . ' ';
        $order = '  ';
        $this->search = '';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num_moh($xid) {
        $table = $this->ytb . ' AS x ';
        $where = ' x.drwx=0 AND x.pid=' . $xid;
        $this->search = '';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

     /**
     * info_cue:提示此人已三给月未缴费.
     * @param $xid:信息id.
     * @return $arr:空or数组加密后的字符串.
     */
    function info_cue($xid) {
        i_xid_check($xid);
        $table = $this->xtb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND id="' . $xid . '" ';
        $arr_info = $this->info_read_base($table, $field, $where);
        if('0000-00-00' != $arr_info['pay_deadtime']){
            $str = (date("Y") - date("Y", strtotime($arr_info['pay_deadtime'])))*12 + (date("m") - date("m",strtotime($arr_info['pay_deadtime'])));
        } else {
            $str = 0; //默认截止日期为0000-00-00。
        }
        $month_num = $str;
        $arr = array(
            'name' => $arr_info['name'],
             'month_num' => $month_num
            );
        $this->print_arr($arr, 1);
        return $arr;
    }
}
?>