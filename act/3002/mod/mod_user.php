<?php
/*
 * 文件名称：mod_job.php
 * 功能描述：岗位管理的模型。
 * 代码作者：钱宝伟（创建）、王争强（优化）、孙振强（重构）
 * 创建时间：2010_06_11
 * 修改时间：2010-07-08
 * 当前版本：v3.0
*/

i_mod_base_info();

class mod_user extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__user';
    }

    function list_load() {
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);
        $this->key_search = array('name', 'org', 'duty', 'sex');
    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        $this->list_load();
        $table = $this->xtb . ' AS x ';
        $field = ' x.id, x.name, x.org, x.duty, x.drwx, x.tel_1, x.sex ';
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
        $this->list_load();
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
     * info_del_load:根据$xid进行信息的软删除.
     * @param $xid:信息id.
     * @return $arr:0（失败）或1（成功）.
     */
    function info_del_load($xid) {
        i_xid_check($xid);
        $arr = $this->xdb->read_num($this->atb, ' drwx=0 AND job_id="' . $xid . '" ');
        return $arr;
    }

    /**
     * info_del:根据$xid进行信息的软删除.
     * @param $xid:信息id.
     * @return $arr:0（失败）或1（成功）.
     */
    function info_del($xid) {
        $arr = $this->info_del_load($xid);
        if (0 < $arr) {
            $arr = 0 - $arr;
        } else {
            $arr = $this->info_del_base($xid);
        }
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
        $this->info_save_load();
//        $this->arr['login_pw'] = md5($this->arr['login_pw']);
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
        $this->info_save_load();
//        $this->arr['login_pw'] = md5($this->arr['login_pw']);
        $arr = $this->info_edit_base($xid);
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * info_name_check:同名岗位检测.
     * @param $xid:信息id.
     * @param $arr:现在输入的名称数据.
     * @return $arr:0（没有）或n>0（有）.
     */
    function info_check_login_id($xid) {
        $info_login_id = @$_POST['arr'];
        $info_login_id = i_json2php($info_login_id);
        $arr = $this->xdb->read_num($this->xtb, ' login_id="' . $info_login_id . '" AND id !="' . $xid . '" ');
        $this->print_arr($arr);
        return $arr;
    }
}
?>