<?php
/*
* 文件名称：mod_alipay.php
* 功能描述：支付接口信息模型。
* 代码作者：王争强（创建）
* 创建时间：2010_10_11
* 修改时间：2010-11-15
* 当前版本：V1.0
*/

i_mod_base_info();

class mod_alipay extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__ws_alipay';
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);
        $this->key_search = array('x.name', 'x.ws_name');
    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        $table = $this->xtb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx="0" ';
        $order = ' ORDER BY atime DESC ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num() {
        $table = $this->xtb . ' AS x ';
        $where = ' x.drwx="0" ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * list_read4alipay : 根据条件ws_id读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read4alipay() {
        $ws_id = @$_GET['ws_id'];
        $table = $this->xtb . ' AS x ';
        $field = ' x.* ';
        $where = ' x.drwx="0" AND x.ws_id=' . $ws_id . ' ';
        $order = ' ORDER BY atime DESC ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num4alipay : 根据条件ws_id读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num4alipay() {
        $ws_id = @$_GET['ws_id'];
        $table = $this->xtb . ' AS x ';
        $field = ' x.* ';
        $where = '  x.drwx="0" AND x.ws_id=' . $ws_id .   ' ';
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
     * mk_cfg:生成cfg配置文件，相当于alipay_config.php文件于目录inc下.
     * @param $xid:信息id.
     * @return $arr:0（失败）或1（成功）.
     */
    function mk_cfg($xid) {
        global $g_xdb;
        $arr = $g_xdb->read_one($this->xtb, '*', 'id="' . $xid . '" ');
        $mk = '../inc/' . $arr['ws_id'] . '_alipay_cfg.php';
        $buffer .= '<?php ';
        $buffer .= ' $partner = "' . $arr['partner'] . '";';
        $buffer .= ' $key = "' . $arr['i_key'] . '";';
        $buffer .= ' $seller_email = "' . $arr['seller_email'] . '";';
        $buffer .= ' $notify_url = "' . $arr['notify_url'] . '";';
        $buffer .= ' $notify_url = "' . $arr['return_url'] . '";';
        $buffer .= ' $show_url = "' . $arr['show_url'] . '";';
        $buffer .= ' $mainname = "' . $arr['mainname'] . '";';
        $buffer .= ' $sign_type = "' . $arr['sign_type'] . '";';
        $buffer .= ' $_input_charset = "' . $arr['_input_charset'] . '";';
        $buffer .= ' $transport = "' . $arr['transport'] . '";';
        $buffer .= ' ?>';
        i_make_file($mk, $buffer);
        if(file_exists($mk)){
            $arr = '1';
        } else {
            $arr = '0';
        }
        print_r($arr);
      return $arr;
    }
}
?>