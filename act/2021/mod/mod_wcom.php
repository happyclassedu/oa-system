<?php
/**
 * 文件名称：mod_wcom.php
 * 功能描述：公司管理（英才网）模型
 * 代码作者：王争强
 * 创建日期：2010-08-06
 * 修改日期：2010-08-06
 * 当前版本：V1.0
 */

i_mod_base_info();

class mod_wcom extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__zpw_c';
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
        }else{
            $this->search = '';
        }
    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        $table = $this->xtb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 ';
        $order = ' ORDER BY x.atime DESC ';
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

}
?>