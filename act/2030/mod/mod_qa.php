<?php
/*
 * 文件名称：mod_qa.php
 * 功能描述：问答管理模型。
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
*/

i_mod_base_info();

class mod_qa extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__ws_qa';
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);
        $this->key_search = array('x.name');
    }

    /**
     * list_read_q : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_q() {
        $ws_id = i_ws_id_get();
        $table = $this->xtb . ' AS x ';
        $field = ' x.* ';
        $where = ' (x.drwx="1" OR x.drwx="") AND x.ws_id=' . $ws_id . ' ';
        $order = ' ORDER BY atime DESC ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_read_q : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read4desk() {
        $ws_id = i_ws_id_get();
        $table = $this->xtb . ' AS x ';
        $field = ' x.* ';
        $where = ' (x.drwx="1" OR x.drwx="") AND x.ws_id=' . $ws_id . ' ';
        $order = ' ORDER BY atime DESC ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }
    /**
     * list_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num_q() {
        $ws_id = i_ws_id_get();
        $table = $this->xtb . ' AS x ';
        $where = '(x.drwx="1" OR x.drwx="") AND x.ws_id=' . $ws_id . ' ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

     /**
     * list_read_a : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_a() {
        $ws_id = i_ws_id_get();
        $table = $this->xtb . ' AS x ';
        $field = ' x.* ';
        $where = ' x.drwx="2" AND x.ws_id=' . $ws_id . '  ';
        $order = ' ORDER BY atime DESC ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num_a : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num_a() {
        $ws_id = i_ws_id_get();
        $table = $this->xtb . ' AS x ';
        $field = ' x.* ';
        $where = '  x.drwx="2" AND x.ws_id=' . $ws_id .   ' ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }


     /**
     * list_read_all : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_all() {
        $ws_id = i_ws_id_get();
        $table = $this->xtb . ' AS x ';
        $field = ' x.* ';
        $where = ' x.drwx in (1, 2, 3) AND x.ws_id=' . $ws_id . ' ';
        $order = ' ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num_all : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num_all() {
        $ws_id = i_ws_id_get();
        $table = $this->xtb . ' AS x ';
        $where = ' x.drwx in (1, 2, 3) AND x.ws_id=' . $ws_id . ' ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

     /**
     * list_read_y : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_y() {
        $ws_id = i_ws_id_get();
        $table = $this->xtb . ' AS x ';
        $field = ' x.* ';
        $where = ' x.drwx="3"AND x.ws_id=' . $ws_id . ' ';
        $order = ' ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num_y : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num_y() {
        $ws_id = i_ws_id_get();
        $table = $this->xtb . ' AS x ';
        $where = 'x.drwx="3" AND x.ws_id=' . $ws_id . ' ';
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
        $this->arr['ip'] = $this->get_real_ip();
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
     /**
     * get_real_ip:获取真实IP.
     * @return $ip:获取ip返回值.
     */
    function get_real_ip() {
        $ip=false;
        if(!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) {
                array_unshift($ips, $ip);
                $ip = FALSE;
            }
            for ($i = 0; $i < count($ips); $i++) {
                if (!eregi ("^(10|172.16|192.168).", $ips[$i])) {
                    $ip = $ips[$i];
                    break;
                }
            }
        }
        return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
    }

     /**
     * info_time:系统返回日期时间.
     * @param $type:0表示格式是YYYY-MM-DD HH:MM:SS; 1表示格式是YYYY-MM-DD; 2表示格式是HH:MM:SS .
     * @param $arr:返回值.
     * @return .
     */
    function info_time($type) {

        switch ($type) {
            case '0':
                $arr = i_time();
                break;
            case '1':
                $arr = substr(i_time(), 0, 10);
                break;
            case '2':
                $arr = substr(i_time(), 11, 8);
                break;
        }
        $this->print_arr($arr, 1);
        return $arr;
    }
}
?>