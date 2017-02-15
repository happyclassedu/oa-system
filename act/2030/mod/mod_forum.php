<?php
/*
* 文件名称：mod_forum.php
* 功能描述：论坛信息模型。
* 代码作者：王争强（创建）
* 创建时间：2010_10_11
* 修改时间：2010-11-15
* 当前版本：V1.0
*/

i_mod_base_info();

class mod_forum extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__ws_forum';
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);
        $this->key_search = array('x.name', 'x.content');
    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read($ws_id, $fid='0') {
        $table = $this->xtb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx in (0, 1, 2, 3) AND x.ws_id=' . $ws_id . ' AND x.fid=' . $fid;
        $order = ' ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num($ws_id, $fid='0') {
        $table = $this->xtb . ' AS x ';
        $where = ' x.drwx in (0, 1, 2, 3)  AND x.ws_id=' . $ws_id . ' AND x.fid=' .$fid;
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * list_read4forum : 根据条件ws_id读取list的信息的内容.
     * @param $show_all : 1代表全部显示；0代表父类显示；
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read4forum($ws_id, $menu_id, $show_all='1') {
        $table = $this->xtb . ' AS x ';
        $field = ' x.* ';
        if('1' == $show_all){
            $str_where  = ' ';
        } elseif('0' == $show_all) {
            $str_where  = ' AND x.fid=0 ';
        }
        $where = ' x.drwx in (0, 1, 2, 3) AND x.ws_id=' . $ws_id . ' AND x.menu_id=' . $menu_id . $str_where  . ' ';
        $order = ' ORDER BY atime DESC ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num4forum : 根据条件ws_id读取list的信息总条数.
     * @param $show_all : 1代表全部显示；0代表父类显示；
     * @return $arr : 空or记录数.
     */
    function list_num4forum($ws_id, $menu_id, $show_all='1') {
        $table = $this->xtb . ' AS x ';
        $field = ' x.* ';
        if('1' == $show_all){
            $str_where  = ' ';
        } elseif('0' == $show_all) {
            $str_where  = ' AND x.fid=0 ';
        }
        $where = '  x.drwx in (0, 1, 2, 3) AND x.fid=0 AND x.ws_id=' . $ws_id . ' AND x.menu_id=' . $menu_id . $str_where . ' ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * list_readbyfid : 根据条件ws_id读取list的信息的内容.
     * @param $fid : 父类id；
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_readbyfid($ws_id, $fid) {
        $table = $this->xtb . ' AS x ';
        $field = ' x.* ';
        $where = ' x.drwx in (0, 1, 2, 3) AND x.ws_id=' . $ws_id . ' AND (x.id=' .$fid . ' OR x.fid=' . $fid . ') ';
        $order = ' ORDER BY atime ASC ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_numbyfid : 根据条件ws_id读取list的信息总条数.
     * @param $fid : 父类id；
     * @return $arr : 空or记录数.
     */
    function list_numbyfid($ws_id, $fid) {
        $table = $this->xtb . ' AS x ';
        $field = ' x.* ';
        $where = '  x.drwx in (0, 1, 2, 3) AND x.ws_id=' . $ws_id  . ' AND (x.id=' .$fid . '  OR x.fid=' . $fid . ') ';
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
        $where = ' id="' . $xid . '" ';
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
        $arr = $this->info_save_load();
        $this->arr['aip'] = i_read_ip();
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

    function m_create_token() {
        $arr = ws_id . date(Ymdhis) . rand(10000, 99999);
        $this->print_arr($arr);
        return $arr;
    }
}
?>