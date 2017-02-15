<?php
/**
 * 文件名称：mod_job.php
 * 功能描述：招聘会职位模型
 * 代码作者：王争强
 * 创建日期：2010-08-23
 * 修改日期：2010-08-23
 * 当前版本：V1.0
 */

i_mod_base_info();

class mod_job extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__zph_info';
        $this->atb = '#@__zph_phase';
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);
//        $this->key_search = array('phase_name','com_name');
        if('' != $this->val_search){
            $this->search = ' AND (x.phase_name LIKE "%' . $this->val_search['val_search'] . '%" OR x.phase_type LIKE "%' . $this->val_search['val_search'] . '%" OR y.com_name LIKE "%' . $this->val_search['val_search'] . '%" OR y.job_a LIKE "%' . $this->val_search['val_search'] . '%" OR y.job_b LIKE "%' . $this->val_search['val_search'] . '%" OR y.job_c LIKE "%' . $this->val_search['val_search'] . '%") ';//OR y.com_name LIKE "%' . $this->val_search['val_search'] . '%"
        } else {
            $this->search = '';
        }
    }

    /**
     * info_test:测试函数.
     * @return $arr:0（失败）或1（成功）.
     */
    function info_test(){
        $arr = $this->val_search['val_search'];
        $this->print_arr($arr);
        return $arr;
    }
    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        $table = $this->atb . ' AS x, (SELECT * FROM '. $this->xtb . ') AS y ';
        $field = ' x.phase_name, x.date_s, x.phase_type, y.*  ';
        $where = ' y.fid=x.id ';
        $order = ' ORDER BY x.date_s DESC ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num() {
        $table = $this->atb . ' AS x, (SELECT * FROM '. $this->xtb . ') AS y ';
        $where = 'y.fid=x.id ';
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

    /*
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
     * info_time:系统返回日期时间.
     * @param $type:0表示格式是YYYY-MM-DD HH:MM:SS; 1表示格式是YYYY-MM-DD; 2表示格式是HH:MM:SS .
     * @param $arr:返回值.
     * @return .
     */
    function info_time($type) {

        switch ($type) {
            case '0':
                $arr = i_time();
                break;
            case '1':
                $arr = substr(i_time(), 0, 10);
                break;
            case '2':
                $arr = substr(i_time(), 11, 8);
                break;
        }
         $this->print_arr($arr);
         return $arr;
    }
}
?>