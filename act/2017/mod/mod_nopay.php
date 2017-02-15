<?php
/**
 * 文件名称：mod_nopay.php
 * 功能描述：未缴费统计表模型
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改日期：2010-07-13
 * 当前版本：V1.0
 */

i_mod_base_info();

class mod_nopay extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__medi_info';
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);
        if('' != $this->val_search) {
            $this->search =
                    ' AND date_format(x.pay_deadtime,"%Y-%m-%d") >= "' . $this->val_search['fee_s'] . ' "
                    AND date_format(x.pay_deadtime,"%Y-%m-%d") <= "' . $this->val_search['fee_e'] . '" ';
        }
    }

    /**
     * list_read_report : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        $table = $this->xtb . ' AS x ';
        $field = ' x.*, (PERIOD_DIFF(DATE_FORMAT(curdate(), "%Y%m"), DATE_FORMAT(x.pay_deadtime, "%Y%m"))) AS month_num';
        $where = ' x.drwx=0 AND x.pay_deadtime <> "0000-00-00" AND (PERIOD_DIFF(DATE_FORMAT(curdate(), "%Y%m"), DATE_FORMAT(x.pay_deadtime, "%Y%m"))) > 3 ';
        $order = ' ';
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
        $where =' x.drwx=0 AND x.pay_deadtime <> "0000-00-00" AND (PERIOD_DIFF(DATE_FORMAT(curdate(), "%Y%m"), DATE_FORMAT(x.pay_deadtime, "%Y%m"))) > 3 ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }
}
?>