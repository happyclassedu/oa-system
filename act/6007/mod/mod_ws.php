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

     function read_nav($xid) {
        global $ws;
        $tmp['name'] = '立丰首页';
        $tmp['url'] = $ws['cfg']['url'];
        $arr[] = $tmp;
        $tmp = $this->read_nav_tree($xid);
        if (null != $tmp) {
            $tmp = array_reverse($tmp);
            $arr = array_merge($arr, $tmp);
        }
        return $arr;
    }

    function read_nav_tree($xid) {
        $table = $this->btb . ' AS x ';
        $field = ' id, fid, name ' . $this->url_menu . ' ';
        $where = ' drwx<2 AND id ="' . $xid . '" ';
        $tmp = $this->xdb->read_one($table, $field, $where);
        if (null == $tmp) {
            return null;
        } else {
            $arr[] = $tmp;
            if (0 != $tmp['fid']) {
                $tmp = $this->read_nav_tree($tmp['fid']);
                if (null != $tmp) {
                    $arr = array_merge($arr, $tmp);
                }
            }
        }
        return $arr;
    }

      /**
     * read_menu4info : 单个--读取指定条件栏目的全部信息。
     * 参数 $xid: 栏目的id。
     */
    function read_menu4info($xid) {
        $table = $this->btb . ' AS x ';
        $field = ' * ' . $this->url_menu . ' ';
        $where = ' drwx="0" AND ws_id="'. ws_id .'" AND type_mod="2" AND type_val="'. $xid .'"';
        $arr = $this->xdb->read_one($table, $field, $where);
        return $arr;
    }

    /**
     * list_read_menu0 : 多个--读取指定条件栏目的基本信息。
     * @param $position : 栏目位置: (主 菜 单：0；顶部栏目：1；底部栏目：2；左侧栏目：3；右侧栏目：4；其他位置：5；）
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_menu0($position) {
        $table = $this->btb;
        $field = ' id, fid, name, url_act, url_www ' . $this->url_menu . ' ';
        $where = ' drwx="0" AND ws_id="'. ws_id .'" AND position="' . $position  . '" ';
        $order = ' ORDER BY oid DESC ';
        $arr = $this->xdb->read_all($table, $field, $where . $order);
        return $arr;
    }

}
?>