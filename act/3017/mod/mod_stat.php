<?php
/**
 * 文件名称：mod_stat.php
 * 功能描述：医疗缴费统计表模型
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改日期：2010-07-13
 * 当前版本：V1.0
 */

i_mod_base_info();

class mod_stat extends mod_base_info {

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
        if('' != $this->val_search) {
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
        $table = $this->xtb . ' AS x LEFT JOIN (SELECT * FROM (SELECT * FROM ' . $this->ytb . ' ORDER BY oid DESC) AS tmp GROUP BY id) AS y ON y.id = x.pid';
        $field = 'x.id , x.pid, x.time, x.fee_num , x.fee_begin, x.fee_end,(PERIOD_DIFF(DATE_FORMAT(x.fee_end, "%Y%m"), DATE_FORMAT(x.fee_begin, "%Y%m"))+1) AS fee_months , y.name,y.idcard,y.medi_code ';
        $where = ' x.drwx=0 AND x.ytype = "医保管理" AND x.yname="医保缴费"';
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
        $where =' x.drwx=0 AND x.ytype = "医保管理" AND x.yname="医保缴费"';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }
    /**
     * get_info : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function get_info_by_type($fee_type) {
//缴费人数共计
        $table = $this->xtb . ' AS x ';
        $field = 'count(x.id) AS p , sum(x.fee_num) AS f ';
        if('' == $fee_type) {
            $where = ' x.drwx=0 AND x.ytype = "医保管理"  AND x.yname="医保缴费" ' ;
        }else {
            $where = ' x.drwx=0 AND x.ytype = "医保管理"  AND x.yname="医保缴费" AND x.fee_type="' . $fee_type .'"' ;
        }

        $order = ' ';
        $arr = $this->list_read_base($table, $field, $where, $order);
//        $this->print_arr($arr);
//        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * get_info_by_age : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */

    function get_info_by_age($age_s , $age_e) {
//缴费人数共计
        $table = $this->xtb . ' AS x LEFT JOIN (SELECT * FROM (SELECT * FROM ' . $this->ytb . ' ORDER BY oid DESC) AS tmp GROUP BY id) AS y ON y.id = x.pid';
        $field = 'count(x.id) AS p ';
        if('' != $age_s && '' != $age_e) {
            $where = ' x.drwx=0 AND x.ytype = "医保管理"  AND x.yname="医保缴费" AND  ((YEAR(CURDATE())-YEAR(y.birth)) - (RIGHT(CURDATE(),5)<RIGHT(y.birth,5)))>' . $age_s .' AND ((YEAR(CURDATE())-YEAR(y.birth)) - (RIGHT(CURDATE(),5)<RIGHT(y.birth,5)))<' . $age_e ;
        } elseif('' != $age_s && '' == $age_e) {
            $where = ' x.drwx=0 AND x.ytype = "医保管理"  AND x.yname="医保缴费" AND ((YEAR(CURDATE())-YEAR(y.birth)) - (RIGHT(CURDATE(),5)<RIGHT(y.birth,5)))<=' .$age_s;
        } elseif('' == $age_s && '' != $age_e) {
            $where = ' x.drwx=0 AND x.ytype = "医保管理"  AND x.yname="医保缴费" AND ((YEAR(CURDATE())-YEAR(y.birth)) - (RIGHT(CURDATE(),5)<RIGHT(y.birth,5)))>=' . $age_e;
        }
        $order = ' ';
        $arr = $this->list_read_base($table, $field, $where, $order);
//        $this->print_arr($arr);
        return $arr;
    }

    /**
     * get_info_by_retire : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */

    function get_info_by_retire() {
//缴费人数共计
        $table = $this->xtb . ' AS x LEFT JOIN (SELECT * FROM (SELECT * FROM ' . $this->ytb . ' ORDER BY oid DESC) AS tmp GROUP BY id) AS y ON y.id = x.pid';
        $field = 'count(x.id) AS p ';
        $where = ' x.drwx=0 AND x.ytype = "医保管理"  AND x.yname="医保缴费" AND y.medi_type="退休"';
        $order = ' ';
        $arr = $this->list_read_base($table, $field, $where, $order);
//        $this->print_arr($arr);
        return $arr;
    }

    function info_stat() {
//uid 291
//操作人员表
        $arr_jf = $this->get_info_by_type('');
        $arr_xz = $this->get_info_by_type('新增');
        $arr_xj = $this->get_info_by_type('续缴');
        $arr_zr = $this->get_info_by_type('转入');
        $arr_40 = $this->get_info_by_age('40', '');
        $arr_40to50 = $this->get_info_by_age('40', '50');
        $arr_50 = $this->get_info_by_age('', '50');
        $arr_tx = $this->get_info_by_retire();
        $arr = array(
                'jf_p' => $arr_jf[0]['p'] ,  //缴费人数共计
                'xz_p' => $arr_xz[0]['p'] , //新增缴费人数
                'xf_p' => $arr_xj[0]['p'] , //续缴缴费人数
                'zr_p' => $arr_zr[0]['p'] , //转入缴费人数
                'jf_f' => $arr_jf[0]['f'] , //缴费金额共计
                'xz_f' => $arr_xz[0]['f'] , //新增缴费金额
                'xf_f' => $arr_xj[0]['f'] , //续缴缴费金额
                'zr_f' => $arr_zr[0]['f'] , //转入缴费金额
                '40_p' => $arr_40[0]['p'], //40岁以下人数
                '40to50_p' =>  $arr_40to50[0]['p'], //41-50岁人数
                '50_p'=> $arr_50[0]['p'], //51以上人数
                'tx_p' => $arr_tx[0]['p'] //退休人数
        );
        $this->print_arr($arr , 1);
        return $arr;
    }
}
?>