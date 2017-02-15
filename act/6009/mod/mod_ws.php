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