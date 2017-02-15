<?php
/*
 * 文件名称：mod_test.php
 * 功能描述：测试smarty模型。
 * 代码作者：王争强（创建）
 * 创建时间：2010-11-15
 * 修改时间：2010-11-15
 * 当前版本：V1.0
*/

i_mod_base_ws();

class mod_ws extends mod_base_ws {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        ;
    }


    /**
     * list_read_fmenu : 多个--读取指定条件栏目的基本信息。
     * @param $position : 栏目位置: (主 菜 单：0；顶部栏目：1；底部栏目：2；左侧栏目：3；右侧栏目：4；其他位置：5；）
     * @param $fid : 父类id.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_fmenu($position, $fid='0') {
        $table = $this->btb;
        $field = ' id, name, url_act, url_www ' . $this->url_menu . ' ';
        $where = ' drwx="0" AND ws_id="4" AND position="' . $position . '" AND fid="' . $fid .'" ';
        $order = ' ORDER BY oid DESC ';
        $arr = $this->xdb->read_all($table, $field, $where . $order);
        return $arr;
    }

    function read_index_news2() {
        $arr = $this->list_read_menu_news('66', '5', '9');
        return $arr;
    }

    function info_read_news1($xid) {
        $table = $this->ctb . ' AS x ';
        $field = ' * ';
        $where = ' drwx="0" AND ws_id="'. ws_id .'" AND id="'. $xid .'"';
        $arr = $this->xdb->read_one($table, $field, $where);
        return $arr;
    }

}
?>