<?php
/**
 * 文件名称：mod_pbill.php
 * 功能描述：表模型
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改日期：2010-07-13
 * 当前版本：V1.0
 */
i_mod_base_info();

class mod_pbill extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->arr_name = array('转入党关系', '转出党关系', '党材料管理', '党材料归档', '预备党员转正', '打印预备党员名单', '缴纳党费', '党员身份证明', '缴费票据管理'); //业务名称
        $this->xtb = '#@__party_log';
        $this->ytb = '#@__party_info';

        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);

        if ('' == $this->val_search) {
            $this->search = ' AND date_format(x.atime,"%Y-%m-%d") LIKE "%' . substr(i_time(), 0, 10) . '%" ';;
        }  elseif (('' != $this->val_search['fee_s']) && ('' != $this->val_search['fee_e'])) {
            $this->search = ' AND date_format(x.atime,"%Y-%m-%d") >= "' . $this->val_search['fee_s'] . '" AND date_format(x.atime,"%Y-%m-%d") <= "' . $this->val_search['fee_e'] . '" ';
        } else {
            $this->search = ' ';
        }
    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        $table = $this->xtb . ' AS x ';
        $field = ' * ';

        $str_xyz = '';

        if ('e1' == $this->val_search['td_act']) {
            $str_xyz = ' AND x.name="' .$this->arr_name[$this->val_search['yname_id']] . '" ';
        }elseif ('e2' == $this->val_search['td_act']) {
            $str_xyz = ' AND x.uid=' . $this->val_search['uid_0'] . '  AND x.name="' .$this->arr_name[$this->val_search['yname_id']] . '" ';
        } elseif ('e3' == $this->val_search['td_act']) {
            $str_xyz = ' AND x.uid=' . $this->val_search['uid_1'] . '  AND x.name="' .$this->arr_name[$this->val_search['yname_id']] . '" ';
        } elseif ('e4' == $this->val_search['td_act']) {
            $str_xyz = ' AND (x.uid=' . $this->val_search['uid_0'] . '  OR x.uid=' . $this->val_search['uid_1'] . ') AND x.name="' .$this->arr_name[$this->val_search['yname_id']] . '" ';
        } elseif ('e5' == $this->val_search['td_act']) {
            $str_xyz = ' AND x.uid<>' . $this->val_search['uid_0'] . '  AND x.uid<>' . $this->val_search['uid_1'] . ' AND x.name="' .$this->arr_name[$this->val_search['yname_id']] . '" ';
        }  elseif ('e6' == $this->val_search['td_act']) {
            $str_xyz = ' AND x.name="' .$this->arr_name[$this->val_search['yname_id']] . '" ';
        } elseif ('' == $this->val_search['td_act']) {
            $str_xyz = ' ';
        }

        $where = ' x.drwx=0 AND x.i_type = "党员管理" ' . $str_xyz;
        $order = ' ';
        $arr = $this->list_read_base($table, $field, $where, $order);
//        $arr = $where;
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num() {
        $table = $this->xtb . ' AS x ';

         $str_xyz = '';

        if ('e1' == $this->val_search['td_act']) {
            $str_xyz = ' AND x.name="' .$this->arr_name[$this->val_search['yname_id']] . '" ';
        }elseif ('e2' == $this->val_search['td_act']) {
            $str_xyz = ' AND x.uid=' . $this->val_search['uid_0'] . '  AND x.name="' .$this->arr_name[$this->val_search['yname_id']] . '" ';
        } elseif ('e3' == $this->val_search['td_act']) {
            $str_xyz = ' AND x.uid=' . $this->val_search['uid_1'] . '  AND x.name="' .$this->arr_name[$this->val_search['yname_id']] . '" ';
        } elseif ('e4' == $this->val_search['td_act']) {
            $str_xyz = ' AND (x.uid=' . $this->val_search['uid_0'] . '  OR x.uid=' . $this->val_search['uid_1'] . ') AND x.name="' .$this->arr_name[$this->val_search['yname_id']] . '" ';
        } elseif ('e5' == $this->val_search['td_act']) {
            $str_xyz = ' AND x.uid<>' . $this->val_search['uid_0'] . '  AND x.uid<>' . $this->val_search['uid_1'] . ' AND x.name="' .$this->arr_name[$this->val_search['yname_id']] . '" ';
        }  elseif ('e6' == $this->val_search['td_act']) {
            $str_xyz = ' AND x.name="' .$this->arr_name[$this->val_search['yname_id']] . '" ';
        } elseif ('' == $this->val_search['td_act']) {
            $str_xyz = ' ';
        }

        $where = ' x.drwx=0 AND x.i_type = "党员管理" ' . $str_xyz;
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

    function m_where_str(){

    }

    /**
     * m_get_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function m_get_num($uid, $yname) {
        $table = $this->xtb . ' AS x ';
        if ('' == $uid) {
            $where = ' x.drwx=0 AND x.i_type = "党员管理" AND x.name="' . $yname . '" ';
        } else {
            $where = ' x.drwx=0 AND x.i_type = "党员管理"  AND x.uid=' . $uid . ' AND x.name="' . $yname . '" ';
        }
        $arr = $this->list_num_base($table, $where);
        //        $this->print_arr($arr);
        return $arr;
    }

    /**
     * m_get_sum : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function m_get_sum() {
        $table = $this->xtb . ' AS x ';
        $where = ' x.drwx=0 AND x.i_type = "党员管理" ';
        $arr = $this->list_num_base($table, $where);
        return $arr;
    }

     /**
     * info_stat : 返回医保业务统计的数组.
     * @return $arr : 空or记录数.
     */
    function info_stat() {
        //uid 291
        //'82' 张琳琳 ； '256' 方言
        //操作人员表
        $arr = array();
        for ($i = 0; $i < count($this->arr_name); $i++) {
            $arr[$i]['uname_0'] = $this->m_get_num('82', $this->arr_name[$i]);
            $arr[$i]['uid_0'] = '82';
            $arr[$i]['uname_1'] = $this->m_get_num('256', $this->arr_name[$i]);
            $arr[$i]['uid_1'] = '256';
            $arr[$i]['sub_total'] = ($this->m_get_num('82', $this->arr_name[$i])) + ($this->m_get_num('256', $this->arr_name[$i]));
            $arr[$i]['sum_total'] = $this->m_get_num('', $this->arr_name[$i]);
            $arr[$i]['other_total'] = ($this->m_get_num('', $this->arr_name[$i])) - (($this->m_get_num('82', $this->arr_name[$i])) + ($this->m_get_num('256', $this->arr_name[$i])));
            $arr[$i]['total'] = $this->m_get_sum();
        }

        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * info_time : 返回服务器当前日期 ，格式如 ：YYYY-MM-DD.
     * @return $arr : 空or记录数.
     */
    function info_time() {
         $arr = substr(i_time(), 0, 10);
         $this->print_arr($arr);
         return $arr;
    }
}
?>