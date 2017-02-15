<?php
/**
 * 文件名称：mod_bill.php
 * 功能描述：表模型
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改日期：2010-07-13
 * 当前版本：V1.0
 */
i_mod_base_info();

class mod_bill extends mod_base_info {

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

        if ('' == $this->val_search) {
            $this->search = ' AND date(x.time) = curdate() ';
        } elseif (('' != $this->val_search) && ('' ==  $this->val_search['fee_s']) && ('' == $this->val_search['fee_e']) && ($this->val_search['fee_s'] == $this->val_search['fee_e'])) {
            $this->search = ' AND date(x.time) = curdate() ';
        } elseif (('' != $this->val_search) && ('' != $this->val_search['fee_s']) && ('' != $this->val_search['fee_e']) && ($this->val_search['fee_s'] == $this->val_search['fee_e'])) {
            $this->search = ' AND date_format(x.time,"%Y-%m-%d") LIKE "%' . $this->val_search['fee_s'] . '%" ';
        } else {
            $this->search = ' ';
        }  
    }

    /**
     * list_read_report : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        
         $arr_yname = array(
                '转入医疗保险',
                '转出医疗保险',
                '打印缴费单',
                '医保缴费',
                '领取医保卡',
                '办理医保卡',
                '医疗报销',
                '退休'
        );

        $table = $this->xtb . ' AS x ';
        $field = ' * ';

        $str_xyz = '';

        if ('e1' == $this->val_search['td_act']) {
            $str_xyz = ' AND x.yname="' .$arr_yname[$this->val_search['yname_id']] . '" ';
        }elseif ('e2' == $this->val_search['td_act']) {
            $str_xyz = ' AND x.pid=' . $this->val_search['z_id'] . '  AND x.yname="' .$arr_yname[$this->val_search['yname_id']] . '" ';
        } elseif ('e3' == $this->val_search['td_act']) {
            $str_xyz = ' AND x.pid=' . $this->val_search['y_id'] . '  AND x.yname="' .$arr_yname[$this->val_search['yname_id']] . '" ';
        } elseif ('e4' == $this->val_search['td_act']) {
            $str_xyz = ' AND (x.pid=' . $this->val_search['z_id'] . '  OR x.pid=' . $this->val_search['y_id'] . ') AND x.yname="' .$arr_yname[$this->val_search['yname_id']] . '" ';
        } elseif ('e5' == $this->val_search['td_act']) {
            $str_xyz = ' AND x.pid<>' . $this->val_search['z_id'] . '  AND x.pid<>' . $this->val_search['y_id'] . ' AND x.yname="' .$arr_yname[$this->val_search['yname_id']] . '" ';
        }  elseif ('e6' == $this->val_search['td_act']) {
            $str_xyz = ' AND x.yname="' .$arr_yname[$this->val_search['yname_id']] . '" ';
        } elseif ('' == $this->val_search['td_act']) {
            $str_xyz = ' ';
        }

        $where = ' x.drwx=0 AND x.ytype = "医保管理" ' . $str_xyz;
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
         $arr_yname = array(
                '转入医疗保险',
                '转出医疗保险',
                '打印缴费单',
                '医保缴费',
                '领取医保卡',
                '办理医保卡',
                '医疗报销',
                '退休'
        );
        $table = $this->xtb . ' AS x ';

         $str_xyz = '';

         if ('e1' == $this->val_search['td_act']) {
            $str_xyz = ' AND x.yname="' .$arr_yname[$this->val_search['yname_id']] . '" ';
        }elseif ('e2' == $this->val_search['td_act']) {
            $str_xyz = ' AND x.pid=' . $this->val_search['z_id'] . '  AND x.yname="' .$arr_yname[$this->val_search['yname_id']] . '" ';
        } elseif ('e3' == $this->val_search['td_act']) {
            $str_xyz = ' AND x.pid=' . $this->val_search['y_id'] . '  AND x.yname="' .$arr_yname[$this->val_search['yname_id']] . '" ';
        } elseif ('e4' == $this->val_search['td_act']) {
            $str_xyz = ' AND (x.pid=' . $this->val_search['z_id'] . '  OR x.pid=' . $this->val_search['y_id'] . ') AND x.yname="' .$arr_yname[$this->val_search['yname_id']] . '" ';
        } elseif ('e5' == $this->val_search['td_act']) {
            $str_xyz = ' AND x.pid<>' . $this->val_search['z_id'] . '  AND x.pid<>' . $this->val_search['y_id'] . ' AND x.yname="' .$arr_yname[$this->val_search['yname_id']] . '" ';
        }  elseif ('e6' == $this->val_search['td_act']) {
            $str_xyz = ' AND x.yname="' .$arr_yname[$this->val_search['yname_id']] . '" ';
        } elseif ('' == $this->val_search['td_act']) {
            $str_xyz = ' ';
        }
        
        $where = ' x.drwx=0 AND x.ytype = "医保管理" ' . $str_xyz;
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * get_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function get_num($uid, $yname) {
        $table = $this->xtb . ' AS x ';
        //$this->val_search == '' ? $str = ' AND date(x.time) = curdate()' : $str = '';
        if ('' == $uid) {
            $where = ' x.drwx=0 AND x.ytype = "医保管理" AND x.yname="' . $yname . '" ';
        } else {
            $where = ' x.drwx=0 AND x.ytype = "医保管理"  AND x.uid=' . $uid . ' AND x.yname="' . $yname . '" ';
        }
        $arr = $this->list_num_base($table, $where);
        //        $this->print_arr($arr);
        return $arr;
    }

    /**
     * get_sum : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function get_sum() {
        $table = $this->xtb . ' AS x ';
        //$this->val_search == '' ? $str = ' AND date(x.time) = curdate()' : $str = '';
        $where = ' x.drwx=0 AND x.ytype = "医保管理" ';
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
        $arr_x = array('转入医疗保险', '转出医疗保险', '打印缴费单', '医保缴费', '领取医保卡', '办理医保卡', '医疗报销', '退休');
        for ($i = 0; $i < count($arr_x); $i++) {
            $arr[$i]['shift_i_z'] = $this->get_num('82', $arr_x[$i]);
            $arr[$i]['shift_zid'] = '82';
            $arr[$i]['shift_i_y'] = $this->get_num('256', $arr_x[$i]);
            $arr[$i]['shift_yid'] = '256';
            $arr[$i]['sub_total'] = ($this->get_num('82', $arr_x[$i])) + ($this->get_num('256', $arr_x[$i]));
            $arr[$i]['sum_total'] = $this->get_num('', $arr_x[$i]);
            $arr[$i]['other_total'] = ($this->get_num('', $arr_x[$i])) - (($this->get_num('82', $arr_x[$i])) + ($this->get_num('256', $arr_x[$i])));
            $arr[$i]['total'] = $this->get_sum();  
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