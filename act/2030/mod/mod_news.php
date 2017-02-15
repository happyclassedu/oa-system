<?php
/*
 * 文件名称：mod_news.php
 * 功能描述：新闻信息管理模型。
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
*/

i_mod_base_info();

class mod_news extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__ws_news';
        $this->atb = '#@__ws_cfg';
        $this->btb = '#@__ws_menu';
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);
        $this->key_search = array('name', 'name_s', 'menu_name');
    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        $ws_id = i_ws_id_get();
        $table = $this->xtb . ' AS x ';
        $field = ' id, name, atime, hits, u_name, menu_name, ws_id ';
        $where = ' x.drwx in (0, 1, 2, 3) AND x.ws_id=' . $ws_id . ' ';
        $order = ' ORDER BY atime DESC ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read4desk() {
        $ws_id = i_ws_id_get();
        $table = $this->xtb . ' AS x ';
        $field = ' id, name, atime, hits, u_name, menu_name, ws_id ';
        $where = ' x.drwx in (0, 1, 2, 3) AND x.ws_id=' . $ws_id . ' ';
        $order = ' ORDER BY atime DESC ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num() {
        $ws_id = i_ws_id_get();
        $table = $this->xtb . ' AS x ';
        $where = ' x.drwx in (0, 1, 2, 3) AND x.ws_id=' . $ws_id . ' ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * list_read_menu4news : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_menu4news() {
        $ws_id = i_ws_id_get();
        $menu_id = @$_GET['menu_id'];
        $table = $this->xtb . ' AS x ';
        $field = ' id, name, atime, hits, u_name, menu_id, menu_name, ws_id, ws_name ';
        $where = ' x.drwx in (0, 1, 2, 3) AND x.ws_id=' . $ws_id . ' AND x.menu_id=' . $menu_id . ' ';
        $order = ' ORDER BY atime DESC ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num_menu4news : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num_menu4news() {
        $ws_id = i_ws_id_get();
        $menu_id = @$_GET['menu_id'];
        $table = $this->xtb . ' AS x ';
        $where = ' x.drwx in (0, 1, 2, 3) AND x.ws_id=' . $ws_id  . ' AND x.menu_id=' . $menu_id . ' ';
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
     * info_name_check:同名岗位检测.
     * @param $xid:信息id.
     * @param $arr:现在输入的名称数据.
     * @return $arr:0（没有）或n>0（有）.
     */
    function info_name_check($xid) {
        $key = @$_GET['obj_id'];
        $info_name = @$_POST['arr'];
        $info_name = i_json2php($info_name);
        $arr = $this->xdb->read_num($this->xtb, ' ' . $key . '="' . $info_name . '" AND id !="' . $xid . '" ');
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * info_cfg:网站信息函数.
     * @return $arr : 空or数组加密后的字符串.
     */
    function info_cfg() {
        $arr = $this->xdb->read_all($this->atb, ' * ', ' drwx="0" AND id<>"0" ');
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * info_menu:（网站对应)栏目信息函数.
     * @return $arr : 空or数组加密后的字符串.
     */
    function info_menu() {
        $ws_id = i_ws_id_get();
//        $str = ('' != $ws_id)?  ' AND ws_id="' . $ws_id . '" ' : ' ';
//        $arr = $this->xdb->read_all($this->btb, ' * ', ' drwx="0" ' . $str);
        $arr = i_tree_create($this->btb, '0', ' AND drwx="0" AND ws_id="'. $ws_id .'" ');
        $this->print_arr($arr, 1);
        return $arr;
    }

//    /**
//     * info_cfg2menu:网站信息函数.
//     * @return $arr : 空or数组加密后的字符串.
//     */
//    function info_cfg2menu(){
//        $arr = array();
//        $arr_cfg = $this->xdb->read_all($this->atb, ' * ', ' drwx="0" AND id<>"0" ');
//        $this->print_arr($arr, 1);
//        return $arr;
//    }
}
?>