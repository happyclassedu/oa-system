<?php
/**
 * 文件名称：mod_report.php
 * 功能描述：医疗缴费统计表模型
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改日期：2010-07-13
 * 当前版本：V1.0
 */

i_mod_base_info();

class mod_report extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__medi_plog4laodong';
        $this->ytb = '#@__medi_info4laodong';
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);
        
        if('' != $this->val_search){
            $this->search =
               ' AND date_format(x.time,"%Y-%m-%d") >= "' . $this->val_search['fee_s'] . ' "
               AND date_format(x.time,"%Y-%m-%d") <= "' . $this->val_search['fee_e'] . '" ';
        }
        
    }

    /**
     * list_read_report : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */


    function list_read() {
        $table = $this->xtb . ' AS x
        LEFT JOIN ' . $this->ytb . ' AS y ON y.id = x.pid
        LEFT JOIN (SELECT a.id AS xid, b.* FROM ' . $this->xtb . ' AS a, ' . $this->xtb . ' AS b WHERE a.pid=b.pid AND a.drwx=0 AND b.drwx=0 AND a.time>b.time AND a.yname="医保缴费" AND b.yname="医保缴费" GROUP BY b.id) AS z ON z.pid = x.pid ';
        $field = ' x.id, x.pid, x.pname, x.fee_num, x.fee_begin, x.fee_end, x.time, x.fee_type, y.jmedi_time, y.medi_code, y.sex, y.medi_type,y.idcard, y.ori_pay_deadtime, z.fee_end AS zfee_end, z.id AS zid ';
        $where = ' x.drwx=0 AND x.yname="医保缴费" ';
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
        $where = ' x.drwx=0 AND x.yname="医保缴费" ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }
}
?>