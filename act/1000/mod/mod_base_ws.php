<?php
/*
* 文件名称：mod_base_info.php
* 功能描述：信息管理基础模型
* 代码作者：孙振强（创建、重构）
* 创建时间：2010-07-08
* 修改时间：2010-07-08
* 当前版本：v1.0
*/

class mod_base_ws {

    /**
     * 定义类的变量
     * $xdb : 数据库操作类的实体.
     * $xtb : 将操作的数据库主表.
     */
    var $xdb;
    var $xtb;
    var $arr;

    /**
     * 构造类。
     * @param $g_xdb : 调用全局的数据库操作类的实体.
     */
    function __construct() {
        global $g_xdb;
        $this->xdb = $g_xdb;
        $this->xtb = '#@__ws_news';
        $this->atb = '#@__ws_cfg';
        $this->btb = '#@__ws_menu';
        $this->ctb = '#@__ws_news';
        $this->dtb = '#@__ws_link';
        $this->etb = '#@__ws_qa'; //问答表
        $this->mod_load();
        $this->ws_url_load();
    }

    /**
     * info_read_ws : 读取当前网站的基本配置信息。
     */
    function info_read_ws() {
        $table = $this->atb . ' AS x ';
        $field = ' * ';
        $where = ' drwx="0" AND id="'. ws_id .'" ';
        $arr = $this->xdb->read_one($table, $field, $where);
        return $arr;
    }

    /**
     * info_read_ws_cfg_base : 读取当前网站的基本配置信息。
     */
    function info_read_ws_cfg_base() {
        $table = $this->atb . ' AS x ';
        $field = ' id, name, name_s, domain, url, beian, linkman, tel, intro, remark, seo_keys, seo_desc ';
        $where = ' drwx="0" AND id="'. ws_id .'" ';
        $arr = $this->xdb->read_one($table, $field, $where);
        return $arr;
    }

    /**
     * ws_url_load : 判断网站的动静进行url字段的合成。
     */
    function ws_url_load() {
        if (1 == ws_mk) {
            $this->url_menu = ', url_www AS url ';
            $this->url_info = ', concat("info", type_ext, "_", id, ".htm") AS url ';
            $this->url_qa = ', concat("qa_", id, ".htm") AS url ';
        } else {
            $this->url_menu = ', url_act AS url ';
            $this->url_info = ', concat("?a=info", type_ext, "&x=", id) AS url ';
            $this->url_qa = ', concat("?a=qa&x=", id) AS url ';
        }
    }

    function ws_url_bat() {
        $this->ws_url_act('menu','0');
        $this->ws_url_act('menu','1');
        $this->ws_url_act('menu','2');
        $this->ws_url_act('menu','3');
        $this->ws_url_act('menu','4');
        $this->ws_url_act('menu','6');
        $this->ws_url_act('menu','5');
        $this->ws_url_act('menu','7');
        $this->ws_url_act('menu','8');
        $this->ws_url_act('menu','9');
        $this->ws_url_act('link','1');
        $this->ws_url_act('link','2');
        $this->ws_url_act('link','3');
        $this->ws_url_act('link','4');
        $this->ws_url_act('link','6');
    }

    /**
     * info_read_menu : 单个--读取指定条件栏目的全部信息。
     * 参数 $xid: 栏目的id。
     */
    function info_read_menu($xid) {
        $table = $this->btb . ' AS x ';
        $field = ' * ' . $this->url_menu . ' ';
        $where = ' drwx="0" AND ws_id="'. ws_id .'" AND id="'. $xid .'"';
        $arr = $this->xdb->read_one($table, $field, $where);
        return $arr;
    }

    /**
     * info_read_link : 单个--读取指定条件栏目的全部信息。
     * 参数 $xid: 栏目的id。
     */
    function info_read_link($xid) {
        $table = $this->dtb . ' AS x ';
        $field = ' * ' . $this->url_menu . ' ';
        $where = ' drwx="0" AND ws_id="'. ws_id .'" AND id="'. $xid .'"';
        $arr = $this->xdb->read_one($table, $field, $where);
        return $arr;
    }

    /**
     * info_read_menu : 单个--读取指定条件栏目的全部信息。
     * 参数 $xid: 栏目的id。
     */
    function info_read_menu_base($xid) {
        $table = $this->btb . ' AS x ';
        $field = ' id, name, url_act, url_www ' . $this->url_menu . ' ';
        $where = ' drwx="0" AND ws_id="'. ws_id .'" AND id="'. $xid .'"';
        $arr = $this->xdb->read_one($table, $field, $where);
        return $arr;
    }

    /**
     * list_read_menu : 多个--读取指定条件栏目的基本信息。
     * @param $position : 栏目位置: (主 菜 单：0；顶部栏目：1；底部栏目：2；左侧栏目：3；右侧栏目：4；其他位置：5；）
     * @param $fid : 父类id.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_menu($position, $fid='0') {
        $table = $this->btb;
        $field = ' id, name, url_act, url_www ' . $this->url_menu . ' ';
        $where = ' drwx="0" AND ws_id="'. ws_id .'" AND position="' . $position . '" AND fid="' . $fid .'" ';
        $order = ' ORDER BY oid DESC ';
        $arr = $this->xdb->read_all($table, $field, $where . $order);
        return $arr;
    }

    /**
     * list_read_menu : 多个--读取指定类型的栏目id。
     * @param $type_mod : 栏目的类型
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_menu_mod($type_mod) {
        $table = $this->btb . ' AS x ';
        $field = ' id, type_ext ';
        $where = ' drwx="0" AND ws_id="'. ws_id .'" AND type_mod="'. $type_mod .'" ';
        $arr = $this->xdb->read_all($table, $field, $where);
        return $arr;
    }

    /**
     * list_read_menu_all : 多个--读取指定条件栏目的基本信息。
     * @param $position : 栏目位置: (主 菜 单：0；顶部栏目：1；底部栏目：2；左侧栏目：3；右侧栏目：4；其他位置：5；）
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_menu_all($position) {
        $table = $this->btb;
        $field = ' id, fid, name, url_act, url_www ' . $this->url_menu . ' ';
        $where = ' drwx="0" AND ws_id="'. ws_id .'" AND position="' . $position . '" ';
//        $order = ' ORDER BY oid DESC ';
        $arr = $this->xdb->read_all($table, $field, $where . $order);
        return $arr;
    }

    /**
     * list_read_menu : 多个--读取指定条件链接的基本信息。
     * @param $menu_id : 所属栏目的id。
     * @param $fid : 父类id.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_link($menu_id, $show_num) {
        $table = $this->dtb;
        $field = ' id, name, img, url_act, url_www ' . $this->url_menu . ' ';
        $where = ' drwx="0" AND ws_id="'. ws_id .'" AND menu_id="' . $menu_id . '" ';
        $order = ' ORDER BY oid DESC LIMIT 0, ' . $show_num;
        $arr = $this->xdb->read_all($table, $field, $where . $order);
        return $arr;
    }

    /**
     * list_read_link_mod : 多个--读取指定类型的栏目id。
     * @param $type_mod : 栏目的类型
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_link_mod($type_mod) {
        $table = $this->dtb . ' AS x ';
        $field = ' id, type_ext ';
        $where = ' drwx="0" AND ws_id="'. ws_id .'" AND type_mod="'. $type_mod .'" ';
        $arr = $this->xdb->read_all($table, $field, $where);
        return $arr;
    }

    /**
     * list_read_news : 多个--读取一个栏目指定条件的基本信息.
     * @param $menu_id : 栏目id.
     * @param $num_show : 读取数量
     * @param $num_s : 开始读取数
     * @param $order_type : 排序类型，默认为0；0代表时间排序，1代表点击率排序；
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_news($menu_id, $num_show, $num_s='0',$order_type='0') {
        $table = $this->ctb . ' AS x ';
        $field = ' id, name, name_s, atime, hits, img, intro ' . $this->url_info . ' ';
        $where = ' drwx="0" AND ws_id="'. ws_id .'" AND menu_id="' . $menu_id . '" ';
        if('0' == $order_type) {
            $order = ' ORDER BY atime DESC ';
        } elseif ('1' == $order_type) {
            $order = ' ORDER BY hits DESC ';
        }
        if('' != $num_show) {
            $limit .= ' LIMIT ' . $num_s . ', ' . $num_show . ' ';
        }

        $arr = $this->xdb->read_all($table, $field, $where . $order . $limit);
        return $arr;
    }

    /**
     * list_read_news_all : 多个--读取本网站所有新闻信息的id.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_news_all() {
        $table = $this->ctb;
        $field = ' id, type_ext ';
        $where = ' drwx="0" AND ws_id="'. ws_id .'" ';
        $arr = $this->xdb->read_all($table, $field, $where);
        return $arr;
    }

    /**
     * list_read_news_num : 读取一个栏目的新闻信息条数.
     * @param $menu_id : 栏目id.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_news_num($menu_id) {
        $table = $this->ctb;
        $where = ' drwx="0" AND ws_id="'. ws_id .'" AND menu_id="'. $menu_id .'"';
        $arr = $this->xdb->read_num($table, $where);
        return $arr;
    }

    /**
     * list_read_menu_news : 多个——读取指定栏目和栏目的新闻信息.
     * @param $menu_fid : 父级栏目id.
     * @param $menu_limit : 读取栏目的数量.
     * @param $news_limit : 读取新闻信息的数量.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_menu_news ($menu_fid, $menu_limit, $news_limit) {
        $table = $this->btb . ' AS x ';
        $field = ' id, name, type_mod, type_val ' . $this->url_menu . ' ';
        $where = ' drwx="0" AND ws_id="'. ws_id .'" AND fid="' . $menu_fid . '"AND type_mod<"2" ';
        $order = ' ORDER BY oid DESC  LIMIT 0, ' . $menu_limit . '';
        $arr = $this->xdb->read_all($table, $field, $where . $order);

        foreach ($arr as $key => $val) {
            if (0 == $val['type_mod']) {
                $xid = $val['id'];
            } else if (1 == $val['type_mod'] && '' != $val['type_val'] ) {
                $xid = $val['type_val'];
            } else {
                unset($arr[$key]);
                break;
            }
            $arr[$key]['news'] =  $this->list_read_news($xid, $news_limit);
        }
        return $arr;
    }

    /**
     * info_read_news : 读取一条新闻信息.
     * @param $xid : 新闻信息id.
     * @return $arr : 空or数组加密后的字符串.
     */
    function info_read_news($xid) {
        $table = $this->ctb . ' AS x ';
        $field = ' * ';
        $where = ' drwx="0" AND ws_id="'. ws_id .'" AND id="'. $xid .'"';
        $arr = $this->xdb->read_one($table, $field, $where);
        return $arr;
    }

    /**
     * list_qa_read : 多个--读取一个栏目指定条件的基本信息.
     * @param $num_show : 读取数量
     * @param $num_s : 开始读取数
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_qa_read($num_show, $num_s='0') {
        $table =  $this->etb . ' AS x ';
        $field = ' id, name, q_name, atime, i_type, drwx ' . $this->url_qa . ' ';
        $where = ' drwx in (1, 2) AND ws_id=' . ws_id . ' ';
        $str = '';
        if('' != $num_show) {
            $str .= ' LIMIT ' . $num_s . ', ' . $num_show . ' ';
        }
        $order = ' ORDER BY atime DESC ' . $str;
        $arr = $this->xdb->read_all($table, $field, $where . $order);
        return $arr;
    }

    /**
     * list_qa_num : 根据条件读取list的信息总条数.
     * drwx留言/回复/隐藏状态：1, 2, 3
     * @return $arr : 空or记录数.
     */
    function list_qa_num() {
        $table = $this->etb . ' AS x ';
        $where = ' drwx in (1, 2) AND ws_id=' . ws_id . ' ';
        $arr = $this->xdb->read_num($table, $where);
        return $arr;
    }

    /**
     * list_qa_read_all : 多个--读取一个栏目指定条件的基本信息.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_qa_read_all() {
        $table =  $this->etb . ' AS x ';
        $field = ' id, name, q_name, atime, i_type, drwx ' . $this->url_qa . ' ';
        $where = ' drwx in (1, 2) AND ws_id=' . ws_id . ' ';
        $arr = $this->xdb->read_all($table, $field, $where);
        return $arr;
    }

    /**
     * info_read_qa : 读取一条问答信息.
     * @param $xid : 问答信息id.
     * @return $arr : 空or数组加密后的字符串.
     */
    function info_read_qa($xid) {
        $table = $this->etb . ' AS x ';
        $field = ' * ';
        $where = ' drwx in (1, 2) AND ws_id="'. ws_id .'" AND id="'. $xid .'"';
        $arr = $this->xdb->read_one($table, $field, $where);
        return $arr;
    }

    function info_read_hits($xid) {
        $arr = $this->xdb->read_one_val($this->ctb, 'hits', 'id='.$xid);
        $this->xdb->update($this->ctb, 'hits=hits+1', 'id='.$xid);
        return $arr;
    }


    /**
     * ws_url_act : 批处理网站栏目或链接的动静态url.
     * @param $xtb : 要处理数据表.
     * @param $type_mod : 栏目类型: 0 表示新闻信息；1 表示站内跳转列表；2 表示站内跳转信息；3 表示站内自定义；4 表示外部链接；5 表示链接信息；6 表示问答信息 ；7 模型：多列表；8 站内跳转多列表；
     * @return $arr : 空or数组加密后的字符串.
     */
    function ws_url_act($xtb, $type_mod) {
        switch ($xtb) {
            case 'menu':
                $table = $this->btb;
                break;
            case 'link':
                $table = $this->dtb;
                break;
            default:
                return;
        }

        $where_plug = ' AND type_val!="" ';

        switch ($type_mod) {
            case '0':
                $set_val = ' url_act=concat("?a=list", type_ext, "&x=", id), url_www=concat("list", type_ext, "_", id, "_1.htm") ';
                $where_plug = '';
                break;
            case '1':
                $set_val = ' url_act=concat("?a=list", type_ext,"&x=", type_val), url_www=concat("list", type_ext, "_", type_val, "_1.htm") ';
                break;
            case '2':
                $set_val = ' url_act=concat("?a=info", type_ext,"&x=", type_val), url_www=concat("info", type_ext, "_", type_val, ".htm") ';
                break;
            case '3':
                $set_val = ' url_act=concat("?a=diy&x=", type_val), url_www=type_val ';
                break;
            case '4':
                $set_val = ' url_act=type_val, url_www=type_val ';
                break;
            case '5':
                $set_val = ' url_act=concat("?a=list_link&x=", id), url_www=concat("list_link_", id, "_1.htm") ';
                $where_plug = '';
                break;
            case '6':
                $set_val = ' url_act=concat("?a=list_qa&x=", id), url_www=concat("list_qa_", id, "_1.htm") ';
                $where_plug = '';
                break;
            case '7':
                $set_val = ' url_act=concat("?a=list_m&x=", id), url_www=concat("list_m_", id, "_1.htm") ';
                $where_plug = '';
                break;
            case '8':
                $set_val = ' url_act=concat("?a=list_m&x=", type_val), url_www=concat("list_m_", type_val, ".htm") ';
                break;
            case '9':
                $set_val = ' url_act=type_val, url_www=type_val ';
                break;
            default:
                return;
        }
        $where = ' drwx="0" AND ws_id="'. ws_id .'" AND type_mod="'. $type_mod .'" ';
        $arr = $this->xdb->update($table, $set_val, $where . $where_plug);
        return $arr;
    }

    function mk_list_all() {
        global $xid;
        $arr_mod = $this->list_read_menu_mod('0');
        foreach ($arr_mod as $val) {
            $xid = $val['id'];
            $ext = '';
            if(isset ($val['type_ext']) && '' != $val['type_ext']) {
                $ext = $val['type_ext'];
            }
            $this->mk_list($ext);
        }
    }

    function mk_list($ext='') {
        $j = 1;
        for ($i=0; $i<$j; $i++) {
            $j++;
            include "www_list" . $ext . ".php";
            if ('ok' == $list_mk) {
                return;
            }
        }
    }

    /**
     * mk_info_all : 生成全部静态内容页.
     * @param $xid : 内容页id.
     * @param $ext : 内容页扩展值type_ext.
     */
    function mk_info_all() {
        global $xid;
        $arr_mod = $this->list_read_news_all();
        foreach ($arr_mod as $val) {
            $xid = $val['id'];
            $ext = '';
            if(isset ($val['type_ext']) && '' != $val['type_ext']) {
                $ext = $val['type_ext'];
            }
            $this->mk_info($ext);
        }
    }

    function mk_info($ext='') {
        include 'www_info' . $ext . '.php';
    }
}
?>