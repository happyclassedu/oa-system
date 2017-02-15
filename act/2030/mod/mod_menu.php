<?php
/*
 * 文件名称：mod_menu.php
 * 功能描述：栏目信息管理模型。
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
*/

i_mod_base_info();

class mod_menu extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__ws_menu';
        $this->atb = '#@__ws_cfg';
    }

    /**
     * list_load : 列表初始化.
     */
    function list_load() {
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);
        $this->key_search = array('name');
    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read($ws_id) {
        $this->list_load();
        $table = $this->xtb . ' AS x ';
        $field = ' id, name, fname, position, type_mod, oid';
        $where = ' x.drwx in (0, 1, 2, 3)  AND x.ws_id=' . $ws_id . ' ';
        $order = ' ORDER BY position, fid, oid DESC ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num($ws_id) {
        $this->list_load();
        $table = $this->xtb . ' AS x ';
        $where = ' x.drwx in (0, 1, 2, 3)  AND x.ws_id=' . $ws_id . ' ';
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
        $where = ' x.drwx in (0, 1, 2, 3) AND id="' . $xid . '" ';
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
     * info_name_check:同名岗位检测.
     * @param $xid:信息id.
     * @param $arr:现在输入的名称数据.
     * @return $arr:0（没有）或n>0（有）.
     */
    function info_name_check($xid, $ws_id) {
        $key = @$_GET['obj_id'];
        $info_name = @$_POST['arr'];
        $info_name = i_json2php($info_name);
        $arr = $this->xdb->read_num($this->xtb, ' ' . $key . '="' . $info_name . '" AND ws_id="'. $ws_id .'" AND id !="' . $xid . '" ');
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * list_read4news:（网站对应)栏目信息函数.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read4news($ws_id){
        $table = $this->xtb . ' AS x ';
        $field = ' id, name ';
        $where = ' drwx in (0, 1, 2, 3) AND ws_id="'. $ws_id .'" AND type_mod=0 ';
        $order = ' ORDER BY CONVERT(name USING GBK) ';
        $arr = $this->xdb->read_all($table, $field, $where . $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_read4link:（网站对应)链接信息函数.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read4link($ws_id){
        $table = $this->xtb . ' AS x ';
        $field = ' id, name ';
        $where = ' drwx in (0, 1, 2, 3) AND ws_id="'. $ws_id .'" AND type_mod=5 ';
        $order = ' ORDER BY CONVERT(name USING GBK) ';
        $arr = $this->xdb->read_all($table, $field, $where . $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_read4qa:（网站对应)问答信息函数.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read4qa($ws_id){
        $table = $this->xtb . ' AS x ';
        $field = ' id, name ';
        $where = ' drwx in (0, 1, 2, 3) AND ws_id="'. $ws_id .'" AND type_mod=6 ';
        $order = ' ORDER BY CONVERT(name USING GBK) ';
        $arr = $this->xdb->read_all($table, $field, $where . $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_read4menu:（网站对应)栏目信息函数.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read4menu($ws_id, $position){
        $arr = i_tree_create($this->xtb, '0', ' AND drwx in (0, 1, 2, 3) AND ws_id="'. $ws_id .'" AND position="'. $position .'" ');
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_read4forum:（网站对应)论坛信息函数. type_mod 9 模式：站内论坛
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read4forum($ws_id){
        $table = $this->xtb . ' AS x ';
        $field = ' id, name ';
        $where = ' drwx in (0, 1, 2, 3) AND ws_id="'. $ws_id .'" AND type_mod=9 ';
        $order = ' ORDER BY CONVERT(name USING GBK) ';
        $arr = $this->xdb->read_all($table, $field, $where . $order);
        $this->print_arr($arr, 1);
        return $arr;
    }
}
?>