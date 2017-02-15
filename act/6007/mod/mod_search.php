<?php
/*
 * 文件名称：mod_search.php
 * 功能描述：新闻中心信息管理模型。
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
*/
i_mod_base_info();

class mod_search extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__ws_news';
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);
        $this->key_search = array('name', 'name_s', 'menu_name');
    }

    /**
     * list_read2news : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        $ws_id = @$_GET['ws_id'];
        $table = $this->xtb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx in (0, 1, 2, 3) AND x.ws_id=' . $ws_id . ' AND x.menu_id in (280, 272, 271, 281) ';
        $order = ' ORDER BY atime DESC ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num2news : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num() {
        $ws_id = @$_GET['ws_id'];
        $table = $this->xtb . ' AS x ';
        $where = ' x.drwx in (0, 1, 2, 3) AND x.ws_id=' . $ws_id . ' AND x.menu_id in (280, 272, 271, 281) ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

}
?>