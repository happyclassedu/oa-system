<?php
/*
 * 文件名称：mod_org.php
 * 功能描述：机构管理模型
 * 代码作者：钱宝伟（创建）、王争强（优化）、孙振强（重构）。
 * 创建时间：2010_06_11
 * 修改时间：2010-07-08
 * 当前版本：v3.0
 */

i_mod_base_info();

class mod_hm_w extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__hrms_hm_w';
        $this->atb = '#@__hrms_hm_i';
        $this->btb = '#@__hrms_hm_t';
    }

    /**
     * info_read:根据$xid读取一条信息内容.
     * @param $xid:信息id.
     * @return $arr:空or数组加密后的字符串.
     */
    function info_read($xid) {
        i_xid_check($xid);
        $arr = $this->xdb->read_num($this->xtb, ' drwx=0 AND hm_id="' . $xid . '" ');
        if (0 == $arr) {
            return '';
        }
        $table = $this->xtb . ' AS x ';
        $field = ' x.* ';
        $where = ' x.drwx=0 AND x.hm_id="' . $xid . '" ';
        $arr = $this->info_read_base($table, $field, $where);
        $this->print_arr($arr, 1);
        return $arr;
    }

    function info_read_hm_i($xid) {
        i_xid_check($xid);
        $table = $this->atb . ' AS x ';
        $field = ' x.name AS hm_name, x.code AS hm_code';
        $where = ' x.drwx=0 AND x.id="' . $xid . '" ';
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
        i_xid_check($xid);
        $xid = $this->xdb->read_one_val($this->xtb, 'id, oid', ' drwx=0 AND hm_id="' . $xid . '" ');
        $arr = $this->info_edit_base($xid);
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * list_read_fid:读取指定fid的list信息.
     * @return $arr:空or数组加密后的字符串.
     */
    function list_read_hm_t($xid) {
        $table = $this->btb . ' AS x';
        $field = ' org_0_id, org_0_name, org_1_id, org_1_name, job_id, job_name ';
        $where = ' drwx=0 AND hm_id="' . $xid . '" ';
        $order = ' ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }
}
?>