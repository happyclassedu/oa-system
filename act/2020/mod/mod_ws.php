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
     * read_ws4info : 读取当前网站的基本配置信息。
     */
    function read_ws4info() {
        $table = $this->atb . ' AS x ';
        $field = ' * ';
        $where = ' drwx="0" ';
        $order = ' ORDER BY atime DESC ';
        $arr = $this->xdb->read_all($table, $field, $where . $order);
        return $arr;
    }

     function read_nav($xid) {
        global $ws;
        $tmp['name'] = '莲湖人才网首页';
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

    function read_index_news1() {
        $arr = $this->list_read_menu_news('385', '4', '6');
        return $arr;
    }

    function read_index_news2() {
        $arr = $this->list_read_menu_news('387', '6', '6');
        return $arr;
    }

     /**
     * list_read_news0 : 多个--读取本网站所有新闻信息的id.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_news0($num_show, $num_s='0') {
        $table = $this->ctb . ' AS x ';
        $field = ' id, name, name_s, atime, menu_id, menu_name, intro ' . $this->url_info . ' ';
        $where = ' drwx="0" AND ws_id="'. ws_id .'" ';
        if('' != $num_show) {
            $str .= ' LIMIT ' . $num_s . ', ' . $num_show . ' ';
        }
        $order = ' ORDER BY atime DESC ' . $str;
        $arr_news0 = $this->xdb->read_all($table, $field, $where . $order);
        $arr = array();
        foreach($arr_news0 as $key => $val) {
            $arr[$key] = $val;
            if('' != $val['menu_id']){
                $arr_menu = $this->info_read_menu($val['menu_id']);
                $arr[$key]['tmp_url'] = $arr_menu['url'];
            }
        }
        return $arr;
    }
}
?>