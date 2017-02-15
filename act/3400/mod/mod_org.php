<?php
/*
 * 文件名称：mod_org.php
 * 功能描述：机构管理模型
 * 代码作者：钱宝伟（创建）、王争强（优化）、孙振强（重构）。
 * 创建时间：2010_06_11
 * 修改时间：2010-07-08
 * 当前版本：v3.0
*/

i_mod_base_info();

class mod_org extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__org';
    }

    function list_load() {
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);
        $this->key_search = array('name', 'f_name');
    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        $this->list_load();
        $table = $this->xtb . ' AS x ';
        $field = ' x.id, x.name, x.code, x.f_name, x.admin, x.type, x.tel_1 ';
        $where = ' x.drwx=0 ';
        $order = ' ORDER BY type DESC, x.f_id, code ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num() {
        $this->list_load();
        $table = $this->xtb . ' AS x ';
        $where = ' x.drwx=0 ';
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
        $where = ' x.drwx=0 AND id="' . $xid . '" ';
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

        $tmp = '';
        $tmp['obj_tb'] = $this->xtb;
        $tmp['obj_id'] = $arr;
        $tmp['obj_name'] = $this->arr['name'];
        $tmp['evt_id'] = '1';
        $tmp['evt_name'] = '新增经办机构';
        $tmp['evt_type'] = '经办机构管理';
        $tmp['evt_con'] =  '';
        m_log_add($tmp);
        
        $this->list_read4org_choos_mk();
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
        $tmp = $this->info_save_load();
        if ($tmp['name']) {
            $this->xdb->update($this->xtb, ',f_name="' . $tmp['name'] . '",', 'f_id="' . $xid . '"');
        }
        $this->list_read4org_choos_mk();
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * list_read_fid:读取指定fid的list信息.
     * @return $arr:空or数组加密后的字符串.
     */
    function list_read4info($xid) {
        $arr = $this->xdb->read_all($this->xtb, 'id, name, code', ' drwx=0 AND type="'. ($xid+1) .'" ORDER BY code ');
        $this->print_arr($arr, 1);
        return $arr;
    }

    function list_read4org_choose() {
        $arr = i_read_file(m_app . 'js/arr_org.js');
        if ('' == $arr) {
            $this->list_read4org_choos_mk();
        }
    }

    function list_read4org_choos_mk() {
        $arr = $this->xdb->read_all($this->xtb, 'id, name, code, type, f_id, f_name', ' drwx=0 AND (type="1" OR type="2") ORDER BY type DESC, code ');
        $arr = i_php2json($arr);
        $arr = 'var arr_org = ' . $arr . ';';
        i_make_file(m_app . 'js/arr_org.js', $arr);
    }
}
?>