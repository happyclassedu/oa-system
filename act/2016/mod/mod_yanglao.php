<?php
/**
 * 文件名称：mod_yanglao.php
 * 功能描述：劳动协理员管理系统
 * 代码作者：孙振强
 * 创建日期：2010-11-13
 * 修改日期：2010-11-13
 * 当前版本：V1.0
 */

i_mod_base_info();

class mod_yanglao extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__yanglao';
        $this->atb = '#@__plog';
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);
        if (!$this->val_search['date_s']) {
            $this->val_search['date_s'] = $this->val_search['date_e'] = date('Y-m-d', i_time_u());
        }
        $this->search = ' and a.time >= "' . $this->val_search['date_s'] . ' 00:00:00" and a.time <= "' . $this->val_search['date_e'] . ' 23:59:59" ';
    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        $table = $this->xtb . ' AS x, ' . $this->atb . ' AS a';
        $field = ' x.id, x.yanglaoid, x.pname, x.cardid, a.jfjs, a.interest, a.feestate, a.feenum, DATE_FORMAT(a.feebegin, "%Y年%m月") AS feebegin, DATE_FORMAT(a.feeend, "%Y年%m月") AS feeend, DATE_FORMAT(a.time, "%Y-%m-%d") AS feeatime ';
        $where = ' x.id = a.pid_yanglao and a.yname="养老缴费" ';
        $order = ' ORDER BY a.time ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num() {
        $table = $this->atb . ' AS a ';
        $where = ' a.yname="养老缴费" ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * list_read4excel : 为excel下载提供数据.
     * @return $arr : 空or记录数.
     */
    function list_read4excel($date_s, $date_e) {
        $table = $this->xtb . ' AS x, ' . $this->atb . ' AS a';
        $field = ' x.yanglaoid, x.pname, x.cardid, a.jfjs, a.interest, a.feestate, a.feenum, DATE_FORMAT(a.feebegin, "%Y年%m月") AS feebegin, DATE_FORMAT(a.feeend, "%Y年%m月") AS feeend, DATE_FORMAT(a.time, "%Y-%m-%d") AS feeatime ';
        $where = ' x.id = a.pid_yanglao and a.yname="养老缴费" ';
        $search = ' and a.time >= "' . $date_s . ' 00:00:00" and a.time <= "' . $date_e . ' 23:59:59" ';
        $order = ' ORDER BY a.time ';
        $arr = $this->xdb->read_all($table, $field, $where.$search.$order);
        return $arr;
    }
}
?>