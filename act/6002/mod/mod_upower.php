<?php
/*
 * 文件名称：mod_org.php
 * 功能描述：机构管理模型
 * 代码作者：钱宝伟（创建）、王争强（优化）、孙振强（重构）
 * 创建时间：2010_06_11
 * 修改时间：2010-07-08
 * 当前版本：v3.0
 */

i_mod_base_info();

class mod_upower extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__upower';
        $this->atb = '#@__user';
        $this->btb = '#@__type';
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);
        $this->key_search = array('y.name', 'z.cname');
    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        $table = $this->xtb . ' AS x 
            LEFT JOIN ' . $this->atb . ' AS y ON y.id = x.uid
            LEFT JOIN ' . $this->btb . ' AS z ON z.id = x.tid';
        $field = ' x.id, x.atime, x.intro, y.name AS u_name, z.cname AS t_name ';
        $where = ' x.drwx=0 AND z.fid=2 AND y.open="open" ';
        $order = ' ORDER BY u_name, x.oid DESC, t_name ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num() {
        $table = $this->xtb . ' AS x
            LEFT JOIN ' . $this->atb . ' AS y ON y.id = x.uid
            LEFT JOIN ' . $this->btb . ' AS z ON z.id = x.tid';
        $where = ' x.drwx=0 AND z.fid=2 AND y.open="open" ';
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
        $table = $this->xtb . ' AS x
            LEFT JOIN ' . $this->atb . ' AS y ON y.id = x.uid
            LEFT JOIN ' . $this->btb . ' AS z ON z.id = x.tid';
        $field = ' x.*, y.name AS u_name, z.cname AS t_name ';
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
        $arr = $this->info_edit_base($xid);
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * list_read_zt : 读取帐套信息列表.
     * @return $arr:空or数组加密后的字符串.
     */
    function list_read_u() {
        $arr = $this->xdb->read_all($this->atb, 'id, name', 'drwx=0 AND open="open" ORDER BY name');
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_read_hm : 读取员工信息列表.
     * @return $arr:空or数组加密后的字符串.
     */
    function list_read_t() {
        $arr = $this->xdb->read_all($this->btb, 'id, cname AS name', 'fid=2 ORDER BY name');
        $this->print_arr($arr, 1);
        return $arr;
    }
}
?>