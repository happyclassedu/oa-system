<?php
/**
 * 文件名称：mod_hreg.php
 * 功能描述：户籍婚姻系统模型
 * 代码作者：王争强
 * 创建日期：2010-07-29
 * 修改日期：2010-07-29
 * 当前版本：V1.0
 */

i_mod_base_info();

class mod_hreg extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__pinfo';
        $this->ytb = '#@__plog';
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);
        if ('' != $this->val_search) {
            $this->search = '';
            foreach ($this->val_search as $key => $val) {
                if ('' != $val) {
                    $this->search .= ' AND x.' . $key . ' LIKE "%' . $val . '%" ';
                }
            }
//            $this->search =
//                    ' AND x.cname LIKE "%' . $this->val_search['cname'] . '%"
//                    AND x.hjid LIKE "%' . $this->val_search['hjid'] . '%"
//                    AND x.hjstate LIKE "%' . $this->val_search['hjstate'] . '%"
//                    AND x.major LIKE "%' . $this->val_search['major'] . '%"
//                    AND x.univ LIKE "%' . $this->val_search['univ'] . '%"
//                    AND x.daidold LIKE "%' . $this->val_search['daidold'] . '%" ';
        }else {
            $this->search = '';
        }
    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        $table = $this->xtb . ' AS x ';
        $field = ' x.id, x.cname, x.sex, x.hjid, x.hjstate, x.univ, x.major, x.marry, x.hjstate, x.daidold';
        $where = ' x.id!=0 ';
        $order = 'ORDER BY x.id DESC ';
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
        $where = ' x.id!=0 ';
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
     * list_read_hoh : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_hoh($xid) {
        $ytype = i_json2php($_GET['ytype']);
        $str = '';
        if('' != $ytype){
            $str = ' AND x.ytype="'. $ytype . '" ';
        } else {
            $str = '';
        }
        $table = $this->ytb . ' AS x ';
        $field = ' x.id, x.time, x.pid, x.uname, x.ytype, x.yname, x.operating_record';
        $where = ' x.drwx=0 AND x.pid=' . $xid . $str;
        $order = ' ';
        $this->search = '';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num_hoh : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num_hoh($xid) {
        $ytype = i_json2php($_GET['ytype']);
        $str = '';
        if('' != $ytype){
            $str = ' AND x.ytype="'. $ytype . '" ';
        } else {
            $str = '';
        }
        $table = $this->ytb . ' AS x ';
        $where = ' x.drwx=0 AND x.pid=' . $xid . $str;
        $this->search = '';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

     /**
     * list_read4excel : 为excel下载提供数据.
     * @return $arr : 空or记录数.
     */
    function list_read4excel($xid, $type) {
//        $type = i_json2php($_GET['ytype']);
        $table = $this->ytb . ' AS x ';
        $field = ' x.id, x.time, x.pid, x.uname, x.ytype, x.yname, x.operating_record';
        $where = ' x.drwx=0 AND x.pid=' . $xid ;
        $search = ('' != $type) ? ' AND x.ytype="'. $type . '" ' : '';
        $order = ' ORDER BY time ';
        $arr = $this->xdb->read_all($table, $field, $where.$search.$order);
        return $arr;
    }
}
?>