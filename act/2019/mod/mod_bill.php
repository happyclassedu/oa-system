<?php
/**
 * 文件名称：mod_bill.php
 * 功能描述：工作日结清单表模型
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
        $this->xtb = '#@__plog';
        $this->ytb = '#@__pinfo';

        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);

//        if('' == $this->val_search['fee_s']){
//            $date_n = date('Y-m-d', i_time_u());
////            $search = ' and a.time >= "' . $date_s . ' 00:00:00" and a.time <= "' . $date_e . ' 23:59:59" ';
//            $this->search = ' and x.time >= "' . $date_n . ' 00:00:00" and x.time <= "' . $date_n . ' 23:59:59" ';
//        } else {
//            $this->search = ' and x.time >= "' . $this->val_search['fee_s'] . ' 00:00:00" and x.time <= "' . $this->val_search['fee_e'] . ' 23:59:59" ';
//        }
        if ('' == $this->val_search) {
            $this->search = ' AND date_format(x.time,"%Y-%m-%d")=curdate() ';
        } elseif (('' != $this->val_search) && ('' ==  $this->val_search['fee_s']) && ('' == $this->val_search['fee_e']) && ($this->val_search['fee_s'] == $this->val_search['fee_e'])) {
            $this->search = ' AND date_format(x.time,"%Y-%m-%d")=curdate() ';
        } elseif (('' != $this->val_search) && ('' != $this->val_search['fee_s']) && ('' != $this->val_search['fee_e']) && ($this->val_search['fee_s'] == $this->val_search['fee_e'])) {
            $this->search = ' AND date_format(x.time,"%Y-%m-%d")>"' . $this->val_search['fee_s'] . '" AND date_format(x.time,"%Y-%m-%d")<"' . $this->val_search['fee_e'] . '"';
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
                '迁出户籍关系',
                '迁入户籍关系',
                '借出户籍卡',
                '归还户籍卡',
                '办理婚育证明',
                '申领独生子女证明',
//                '申领生育指标',
                '办理准生证',
                '办理计生证明',
                '填写育龄妇女登记表'
        );

        $table = $this->xtb . ' AS x ';
        $field = 'x.id , x.pid, x.time, x.uname, x.pname, x.ytype, x.yname, x.operating_record ';

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

       

        $where = ' x.drwx=0 AND x.ytype = "户籍婚育管理" ' . $str_xyz;
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
         $arr_yname = array(
                '迁出户籍关系',
                '迁入户籍关系',
                '借出户籍卡',
                '归还户籍卡',
                '办理婚育证明',
                '申领独生子女证明',
//                '申领生育指标',
                '办理准生证',
                '办理计生证明',
                '填写育龄妇女登记表'
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

        $where = ' x.drwx=0 AND x.ytype = "户籍婚育管理" ' . $str_xyz;
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
        if ('' == $uid) {
            $where = ' x.drwx=0 AND x.ytype = "户籍婚育管理" AND x.yname="' . $yname . '" ';
        } else {
            $where = ' x.drwx=0 AND x.ytype = "户籍婚育管理"  AND x.uid=' . $uid . ' AND x.yname="' . $yname . '" ';
        }
        $arr = $this->list_num_base($table, $where);
        return $arr;
    }

    /**
     * get_sum : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function get_sum() {
        $table = $this->xtb . ' AS x ';
        $where = ' x.drwx=0 AND x.ytype = "户籍婚育管理" ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

    function info_stat() {
//uid 291
//'82' 张杰 ； '256' 高小
//操作人员表
        $arr = array();
        $arr_x = array(
                '迁出户籍关系',
                '迁入户籍关系',
                '借出户籍卡',
                '归还户籍卡',
                '办理婚育证明',
                '申领独生子女证明',
//                '申领生育指标',
                '办理准生证',
                '办理计生证明',
                '填写育龄妇女登记表'
            );

        for ($i = 0; $i < count($arr_x); $i++) {
            $arr[$i]['shift_i_z'] = $this->get_num('300', $arr_x[$i]);
            $arr[$i]['shift_zid'] = '300';
            $arr[$i]['shift_i_y'] = $this->get_num('290', $arr_x[$i]);
            $arr[$i]['shift_yid'] = '290';
            $arr[$i]['sub_total'] = ($this->get_num('300', $arr_x[$i])) + ($this->get_num('290', $arr_x[$i]));
            $arr[$i]['sum_total'] = $this->get_num('', $arr_x[$i]);
            $arr[$i]['other_total'] = ($this->get_num('', $arr_x[$i])) - (($this->get_num('300', $arr_x[$i])) + ($this->get_num('290', $arr_x[$i])));
            $arr[$i]['total'] = $this->get_sum();
            $arr[$i]['local_time'] = substr(i_time(), 0, 10);
        }
        
        $this->print_arr($arr, 1);
        return $arr;
    }


    function info_test($yname) {
        $table = ' tmp_tb ';
        $field = ' (SELECT COUNT(*) FROM ' . $this->xtb . ' WHERE drwx=0 AND ytype="户籍婚育管理" AND yname="' . $yname . '") AS total,
            (SELECT COUNT(*) FROM ' . $this->xtb . ' WHERE drwx=0 AND ytype="户籍婚育管理" AND yname="' . $yname . '" AND uid="300") AS employee_1,
            (SELECT COUNT(*) FROM ' . $this->xtb . ' WHERE drwx=0 AND ytype="户籍婚育管理" AND yname="' . $yname . '" AND uid="290") AS employee_2 ';
        $where = '';
        $arr = $this->xdb->read_all($table, $field);
        $this->print_arr($arr, 1);
        return $arr;
    }
}
?>