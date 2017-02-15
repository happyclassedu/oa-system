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
     * list_read: 根据条件读取list的信息的内容.
     * @param $menu_id: 表示栏目id.
     * @param $istop: 表示是否置顶，等于1时表示置顶.
     * @param $istar: 表示是否推荐，等于1时表示推荐.
     * @param $limit：表示显示的条数，默认全部显示.
     * @return $arr : 空or数组加密后的字符串.
     */
//    function list_read($menu_id, $istop, $istar, $limit) {
//        $table = $this->xtb . ' AS x ';
//        $field = ' id, name, name_s, atime ';
//        $where = ' drwx="0" AND ws_id="'. ws_id .'" AND menu_id="7" ';
//        if('' != $istop){
//            $where .= ' AND istop=' . $istop . ' ';
//        }
//        if('' != $istar){
//            $where .= ' AND istar=' . $istar . ' ';
//        }
//        $order = ' ORDER BY atime ';
//        if('' != $limit){
//            $order .= ' DESC LIMIT 0, ' . $limit . ' ';
//        }
//        $arr = $this->xdb->read_all($table, $field, $where . $order);
//        return $arr;
//    }

    function read_index_news1() {
        $arr = $this->list_read_menu_news('87', '5', '8');
        return $arr;
    }


    function read_index_news2() {
        $arr = $this->list_read_menu_news('88', '5', '8');
        return $arr;
    }

    /**
     * info_read_menu : 单个--读取指定条件栏目的全部信息。
     * 参数 $xid: 栏目的id。
     */
    function read_menu4info($xid) {
        $table = $this->btb . ' AS x ';
        $field = ' * ' . $this->url_menu . ' ';
        $where = ' drwx="0" AND ws_id="'. ws_id .'" AND type_mod="2" AND type_val="'. $xid .'"';
        $arr = $this->xdb->read_one($table, $field, $where);
        return $arr;
    }

    function read_nav($xid) {
        global $ws;
        $tmp['name'] = '网站首页';
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
}
?>