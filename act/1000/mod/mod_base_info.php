<?php
/*
 * 文件名称：mod_base_info.php
 * 功能描述：信息管理基础模型
 * 代码作者：孙振强（创建、重构）
 * 创建时间：2010-07-08
 * 修改时间：2010-07-08
 * 当前版本：v1.0
*/

class mod_base_info {

    /**
     * 定义类的变量
     * $xdb : 数据库操作类的实体.
     * $xtb : 将操作的数据库主表.
     */
    var $xdb;
    var $xtb;
    var $arr;
    var $fields;
    var $search;

    /**
     * 构造类。
     * @param $g_xdb : 调用全局的数据库操作类的实体.
     */
    function __construct() {
        global $g_xdb;
        $this->xdb = $g_xdb;
        $this->mod_load();
    }

    /**
     * fields_read : 获取主表的字段名称.
     * @return $arr : 包含所有字段的数组.
     */
    function fields_read() {
        if (!$this->fields) {
            $this->fields = $this->xdb->read_xtb_fields($this->xtb);
        }
        return $this->fields;
    }

    /**
     * list_read_load : 读取list内容的初始化操作.
     * @param $show_num : 每页要显示的信息条数.
     * @param $page_now : 当前的页码数.
     * @return $str : 记录条数读取数量的sql语句.
     */
    function list_read_load() {
        if ('' == $this->show_num) {
            $str = ' LIMIT 0,10 ';
        } else {
            $info_s = $this->show_num * $this->page_now - $this->show_num;
            $str = ' LIMIT ' . $info_s . ',' . $this->show_num . ' ';
        }
        return $str;
    }

    /**
     * list_read_search:读取list的搜索条件.
     * @param $val_search:js以post方式提交的搜索关键字.
     * @return $str:空or搜索的sql条件语句.
     */
    function list_read_search() {
        if ($this->search) {
            return $this->search;
        }
        $str = '';
        $arr = $this->val_search;
        if (is_array($arr)) {
            $fields = $this->fields_read();
            $str .= ' AND ( ';
            foreach ($arr as $key => $val) {
                if (in_array($key, $fields) && '' != $val) {
                    $str .= ' x.' . $key . ' LIKE "%' . $val . '%" AND';
                }
            }
            $str = preg_replace("/(AND*$)/ ", '', $str);
            $str .= ') ';
        } else if ('' != $arr && $this->key_search) {
//            $fields = $this->fields_read();
            $str .= ' AND ( ';
            foreach ($this->key_search as $key => $val) {
//                if (in_array($val, $fields) && '' != $val) {
                if ('' != $val) {
                    $str .= ' ' . $val . ' LIKE "%' . $arr . '%" OR';
                }
            }
            $str = preg_replace("/(OR*$)/ ", '', $str);
            $str .= ') ';
        } else if ('' != $arr) {
            $str = ' AND (x.name LIKE "%' . $arr . '%") ';
        }
        $this->search = $str;
        return $str;
    }

    /**
     * list_read_base : base,根据条件读取list的信息的内容.
     * @return $arr:空or数组加密后的字符串.
     */
    function list_read_base($table, $field, $where, $order) {
        $str_limits = $this->list_read_load();
        $val_search = $this->list_read_search();
        $arr = $this->xdb->read_all($table, $field,
                $where . $val_search . $order . $str_limits);
        return $arr;
    }

    /**
     * list_num_base : base,根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num_base($table, $where) {
        $val_search = $this->list_read_search();
        $arr = $this->xdb->read_num($table, $where . $val_search);
        return $arr;
    }

    /**
     * info_read_base : base,根据$xid读取一条信息内容.
     * @return $arr:空or数组加密后的字符串.
     */
    function info_read_base($table, $field, $where) {
        $arr = $this->xdb->read_one($table, $field, $where);
        return $arr;
    }

    /**
     * info_del:根据$xid进行信息的软删除.
     * @param $xid:信息id.
     * @return $arr:0（失败）或1（成功）.
     */
    function info_del_base($xid) {
        i_xid_check($xid);
        $arr = $this->xdb->update($this->xtb, 'drwx=4, etime="' . i_time() . '" ', 'id="' . $xid . '"');
        return $arr;
    }

    /**
     * info_del_true:根据$xid进行信息的硬删除.
     * @param $xid:信息id.
     * @return $arr:0（失败）或1（成功）.
     */
    function info_del_true_base($xid) {
        i_xid_check($xid);
        $arr = $this->xdb->delete($this->xtb, 'id="' . $xid . '"');
        return $arr;
    }

    /**
     * info_save_load:保存信息的初始化操作.
     * @param $arr:js以post方式提交的加密数据.
     * @return $arr:php解密并对象化的数据.
     */
    function info_save_load() {
        if ($this->arr) {
            return $this->arr;
        }
        $arr = @$_POST['arr'];
        if ('' == $arr) {
            echo 'No arr for save.';
            exit;
        }
        $arr = i_json2php($arr);
        $this->arr = $arr;
        return $arr;
    }

    /**
     * info_add:新增信息的保存操作.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:0（失败）或其他数字（成功，新信息的id）.
     */
    function info_add_base() {
        $arr = $this->info_save_load();
        $fields = $this->fields_read();
        
        $sql_key = '';
        $sql_val = '';
        foreach ($arr as $key => $val) {
            if ($key <> 'id' && in_array($key, $fields)) {
                $sql_key .= ',' . $key . ' ';
                $sql_val .= ', "' . $val . '" ';
            }
        }

        if ('' == $sql_val) {
            return 'No effective arr for save.';
        } else {
            $sql_key .= ',atime ';
            $sql_val .= ', "' . i_time() . '" ';
        }

        $arr = $this->xdb->insert($this->xtb, $sql_key, $sql_val);
        return $arr;
    }

    /**
     * info_edit:修改信息的保存操作.
     * @param $xid:信息id.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:0（失败）或1（成功）.
     */
    function info_edit_base($xid) {
        i_xid_check($xid);
        $arr = $this->info_save_load();
        $fields = $this->fields_read();

        $sql_val = '';
        foreach ($arr as $key => $val) {
            if ($key <> 'id' && in_array($key, $fields)) {
                $sql_val .= ', ' . $key . '="' . $val . '" ';
            }
        }

        if ('' == $sql_val) {
            return 'No effective arr for save.';
        } else {
            $sql_val .= ', etime="' . i_time() . '" ';
        }

        $arr = $this->xdb->update($this->xtb, $sql_val, 'id="' . $xid . '"');
        return $arr;
    }

    /**
     * info_edit:修改信息的保存操作.
     * @param $xid:信息id.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:0（失败）或1（成功）.
     */
    function print_arr($arr, $p_j=0) {
        if (1 == $p_j) {
            $arr = i_php2json($arr);
        }
        print_r($arr);
    }
}
?>