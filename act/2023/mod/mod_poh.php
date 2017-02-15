<?php
/**
 * 文件名称：mod_poh.php
 * 功能描述：党员业务操作模型
 * 代码作者：王争强
 * 创建日期：2010-07-29
 * 修改日期：2010-07-29
 * 当前版本：V1.0
 */

i_mod_base_info();

class mod_poh extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__party_log';
        $this->atb = '#@__party_info';
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);

        if ('' != $this->val_search) {
            $this->search =
               ' AND x.bname LIKE "%' . $this->val_search['bname'] . '%"
                AND x.uname LIKE "%' . $this->val_search['uname'] . '%"
                AND x.name LIKE "%' . $this->val_search['name'] . '%" ';
        } else {
            $this->search = '';
        }

    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        $table = $this->xtb . ' AS x ';
        $field = ' x.*';
        $where = ' x.drwx=0 ';
        $order = 'ORDER BY x.atime DESC ';
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
        $where = 'id="' . $xid . '" ';
        $arr = $this->info_read_base($table, $field, $where);
        $this->print_arr($arr, 1);
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
      // 查出存档人id
        $x_arr = $this->info_read_base($this->xtb . ' AS x ', ' * ', 'id="' . $arr . '" ');

        if('转入党关系' == $x_arr['name']){
            $this->xdb->update($this->atb, 'party_state="在库"', 'id="' . $x_arr['bid'] . '"');
        } elseif('转出党关系' == $x_arr['name']) {
            $this->xdb->update($this->atb, 'party_state="调出"',  'id="' . $x_arr['bid'] . '"');
        }

        if('党员材料归档' == $x_arr['name']){
            $this->xdb->update($this->atb, 'party_state0="在库"',  'id="' . $x_arr['bid'] . '"');
        }

        if('预备党员转正' == $x_arr['name']){
            $this->xdb->update($this->atb, 'party_type="' . $x_arr['i_txt0']  . '"',  'id="' . $x_arr['bid'] . '"');
        }

        if('缴纳党费' == $x_arr['name']){
            $this->xdb->update($this->atb, 'pay_deadtime="' . $x_arr['i_date']  . '"',  'id="' . $x_arr['bid'] . '"');
        }
        
        $this->print_arr($arr);
        return $arr;
    }
}
?>