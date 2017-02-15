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
        $this->rtb = '#@__ws_resume'; //简历表
        $this->stb = '#@__ws_job'; //职位表
        $this->ttb = '#@__ws_com'; //企业表
    }

    function read_nav($xid) {
        global $ws;
        $tmp['name'] = '碑林人才首页';
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
        $arr = $this->list_read_menu_news('1515', '4', '6');
        return $arr;
    }

    /*****简历信息 s*****/
    function info_read_resume($xid) {
        $table = $this->rtb . ' AS x ';
        $field = ' * ';
        $where = ' drwx="0" AND id="'. $xid .'"';
        $arr = $this->xdb->read_one($table, $field, $where);
        return $arr;
    }

    function list_read_resume_all() {
        $table = $this->rtb . ' AS x ';
        $field = ' id ';
        $where = ' drwx="0" AND ws_id=' . ws_id . ' ';
        $arr = $this->xdb->read_all($table, $field, $where);
        return $arr;
    }

    function list_read_resume_num($xid) {
        $table = $this->rtb;
        $where = ' drwx="0" AND ws_id=' . ws_id . ' ';
        $arr = $this->xdb->read_num($table, $where);
        return $arr;
    }

    function list_read_resume($xid, $num_show, $num_s='0') {
        if (1 == ws_mk) {
            $url_plug = ', concat("info_resume_", id, ".htm") AS url ';
        } else {
            $url_plug = ', concat("?a=info_resume&x=", id) AS url ';
        }
        $table = $this->rtb . ' AS x ';
        $field = ' id, name, sex, degree, univ, major ' . $url_plug;
        $where = ' drwx="0" AND ws_id=' . ws_id . ' ';
        if('' != $num_show) {
            $str .= ' LIMIT ' . $num_s . ', ' . $num_show . ' ';
        }
        $order = ' ORDER BY atime DESC ' . $str;
        $arr = $this->xdb->read_all($table, $field, $where . $order);
        return $arr;
    }
    /*****简历信息 e*****/
    /**************职位 s*************/
    function list_read_job_all() {
        $table = $this->stb . ' AS x ';
        $field = ' id ';
        $where = ' drwx="0"';
        $arr = $this->xdb->read_all($table, $field, $where);
        return $arr;
    }

    function info_read_com4job($xid) {
        $table = $this->ttb . ' AS x ';
        $field = ' fname AS name, intro, post_addr AS addr ';
        $where = ' drwx="0" AND id="'. $xid .'"';
        $arr = $this->xdb->read_one($table, $field, $where);
        return $arr;
    }

    function list_read_com_all() {
        $table = $this->ttb . ' AS x ';
        $field = ' id ';
        $where = ' drwx="0"';
        $arr = $this->xdb->read_all($table, $field, $where);
        return $arr;
    }

    function info_read_com($xid) {
        $table = $this->ttb . ' AS x ';
        $field = ' *, fname AS name ';
        $where = ' drwx="0" AND id="'. $xid .'"';
        $arr = $this->xdb->read_one($table, $field, $where);
        return $arr;
    }

    function list_read_job4com($xid) {
        $table = $this->stb . ' AS x ';
        $field = ' id, name, addr, num, pay ';
        $where = ' drwx="0" AND cid="'. $xid .'"';
        $order = ' ORDER BY atime DESC  LIMIT 0,5 ';
        $arr = $this->xdb->read_all($table, $field, $where . $order);
        return $arr;
    }

    function info_read_job($xid) {
        $table = $this->stb . ' AS x ';
        $field = ' * ';
        $where = ' drwx="0" AND id="'. $xid .'"';
        $arr = $this->xdb->read_one($table, $field, $where);
        return $arr;
    }

    function list_read_job_num($xid) {
        $table = $this->stb;
        $where = ' drwx="0"';
        $arr = $this->xdb->read_num($table, $where);
        return $arr;
    }

    function list_read_job($xid, $num_show, $num_s='0') {
        $table = $this->stb . ' AS x ';
        $field = ' id, name, cid, cname, addr, num, pay ';
        $where = ' drwx="0"';
        if('' != $num_show) {
            $str .= ' LIMIT ' . $num_s . ', ' . $num_show . ' ';
        }
        $order = ' ORDER BY atime DESC ' . $str;
        $arr = $this->xdb->read_all($table, $field, $where . $order);
        return $arr;
    }
    /*****************职位 e****************/
}
?>