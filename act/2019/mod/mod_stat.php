<?php
/**
 * 文件名称：mod_stat.php
 * 功能描述：户籍信息统计表模型
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
        $this->xtb = '#@__pinfo';
    }


    /**
     * get_info_by_marry : 根据婚姻状况, 户籍状态读取list的信息总条数.
     * @param $marry : 婚姻状况.
     * @param $hjstate: : 户籍状态.
     * @return $arr : 空or记录数.
     */
    function get_info_by_marry($marry, $hjstate) {
        $table = $this->xtb . ' AS x ';
        $field = ' count(*) AS p';
        $where = ' x.drwx=0 AND x.marry ="' .$marry . '"  AND x.hjstate="' . $hjstate . '" ' ;
        $order = ' ';
        $arr = $this->list_read_base($table, $field, $where, $order);
//        $this->print_arr($arr , 1);
        return $arr;
    }

    /**
     * get_info_by_local : 根据生源状况, 户籍状态读取list的信息总条数.
     * @param $local : 生源状况.
     * @param $hjstate: : 户籍状态.
     * @return $arr : 空or记录数.
     */
    function get_info_by_local($local, $hjstate) {
        $table = $this->xtb . ' AS x ';
        $field = 'count(*) AS p';
        $where = ' x.drwx=0 AND x.local = "' .$local . '"  AND x.hjstate="' . $hjstate . '" ' ;
        $order = ' ';
        $arr = $this->list_read_base($table, $field, $where, $order);
//        $this->print_arr($arr , 1);
        return $arr;
    }

    /**
     * get_info_by_degree : 根据学历状况, 户籍状态读取list的信息总条数.
     * @param $degree : 学历状况.
     * @param $hjstate: : 户籍状态.
     * @return $arr : 空or记录数.
     */
    function get_info_by_degree($degree, $hjstate) {
        $table = $this->xtb . ' AS x ';
        $field = 'count(*) AS p';
        $where = ' x.drwx=0 AND x.degree = "' .$degree . '"  AND x.hjstate="' . $hjstate . '" ' ;
        $order = ' ';
        $arr = $this->list_read_base($table, $field, $where, $order);
//        $this->print_arr($arr , 1);
        return $arr;
    }

    /**
     * get_info_by_dastate : 根据档案状态, 户籍状态读取list的信息总条数.
     * @param $dastate : 档案状态.
     * @param $hjstate: : 户籍状态.
     * @return $arr : 空or记录数.
     */
    function get_info_by_dastate($dastate, $hjstate) {
        $table = $this->xtb . ' AS x ';
        $field = 'count(*) AS p';
        $where = ' x.drwx=0 AND x.dastate = "' .$dastate . '"  AND x.hjstate="' . $hjstate . '" ' ;
        $order = ' ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        return $arr;
    }

    function info_stat() {
//uid 291
//操作人员表
        $arr_0_0 = $this->get_info_by_marry('已婚', '在库');
        $arr_0_1 = $this->get_info_by_marry('已婚', '迁出');
        $arr_0_2 = $this->get_info_by_marry('已婚', '借出');

        $arr_1_0 = $this->get_info_by_marry('未婚', '在库');
        $arr_1_1 = $this->get_info_by_marry('未婚', '迁出');
        $arr_1_2 = $this->get_info_by_marry('未婚', '借出');

//本地生源
        $arr_2_0 = $this->get_info_by_local('是', '在库');
        $arr_2_1 = $this->get_info_by_local('是', '迁出');
        $arr_2_2 = $this->get_info_by_local('是', '借出');

//非本地生源
        $arr_3_0 = $this->get_info_by_local('否', '在库');
        $arr_3_1 = $this->get_info_by_local('否', '迁出');
        $arr_3_2 = $this->get_info_by_local('否', '借出');

//学历状况：博士
        $arr_4_0 = $this->get_info_by_degree('博士', '在库');
        $arr_4_1 = $this->get_info_by_degree('博士', '迁出');
        $arr_4_2 = $this->get_info_by_degree('博士', '借出');

//学历状况：研究生
        $arr_5_0 = $this->get_info_by_degree('研究生', '在库');
        $arr_5_1 = $this->get_info_by_degree('研究生', '迁出');
        $arr_5_2 = $this->get_info_by_degree('研究生', '借出');

//学历状况：本科
        $arr_6_0 = $this->get_info_by_degree('本科', '在库');
        $arr_6_1 = $this->get_info_by_degree('本科', '迁出');
        $arr_6_2 = $this->get_info_by_degree('本科', '借出');

//学历状况：大专
        $arr_7_0 = $this->get_info_by_degree('大专', '在库');
        $arr_7_1 = $this->get_info_by_degree('大专', '迁出');
        $arr_7_2 = $this->get_info_by_degree('大专', '借出');

//学历状况：其他
        $arr_8_0 = $this->get_info_by_degree('其他', '在库');
        $arr_8_1 = $this->get_info_by_degree('其他', '迁出');
        $arr_8_2 = $this->get_info_by_degree('其他', '借出');

//档案状态:在库
        $arr_9_0 = $this->get_info_by_dastate('在库', '在库');
        $arr_9_1 = $this->get_info_by_dastate('在库', '迁出');
        $arr_9_2 = $this->get_info_by_dastate('在库', '借出');

//档案状态:办理
        $arr_10_0 = $this->get_info_by_dastate('办理', '在库');
        $arr_10_1 = $this->get_info_by_dastate('办理', '迁出');
        $arr_10_2 = $this->get_info_by_dastate('办理', '借出');

        //档案状态:办理
        $arr_11_0 = $arr_0_0[0]['p'] + $arr_1_0[0]['p'] + $arr_2_0[0]['p'] + $arr_3_0[0]['p'] + $arr_4_0[0]['p'] + $arr_5_0[0]['p'] + $arr_6_0[0]['p'] + $arr_7_0[0]['p'] + $arr_8_0[0]['p'] + $arr_9_0[0]['p'] + $arr_10_0[0]['p'];
        $arr_11_1 = $arr_0_1[0]['p'] + $arr_1_1[0]['p'] + $arr_2_1[0]['p'] + $arr_3_1[0]['p'] + $arr_4_1[0]['p'] + $arr_5_1[0]['p'] + $arr_6_1[0]['p'] + $arr_7_1[0]['p'] + $arr_8_1[0]['p'] + $arr_9_1[0]['p'] + $arr_10_1[0]['p'];
        $arr_11_2 = $arr_0_2[0]['p'] + $arr_1_2[0]['p'] + $arr_2_2[0]['p'] + $arr_3_2[0]['p'] + $arr_4_2[0]['p'] + $arr_5_2[0]['p'] + $arr_6_2[0]['p'] + $arr_7_2[0]['p'] + $arr_8_2[0]['p'] + $arr_9_2[0]['p'] + $arr_10_2[0]['p'];

        $arr = array(
                '0' => array(
                        '0' => $arr_0_0[0]['p'],
                        '1' => $arr_0_1[0]['p'],
                        '2' => $arr_0_2[0]['p']
                ) ,
                '1' => array(
                        '0' => $arr_1_0[0]['p'],
                        '1' => $arr_1_1[0]['p'],
                        '2' => $arr_1_2[0]['p']
                ) ,
                '2' => array(
                        '0' => $arr_2_0[0]['p'],
                        '1' => $arr_2_1[0]['p'],
                        '2' => $arr_2_2[0]['p']
                ) ,
                '3' => array(
                        '0' => $arr_3_0[0]['p'],
                        '1' => $arr_3_1[0]['p'],
                        '2' => $arr_3_2[0]['p']
                ) ,
                '4' => array(
                        '0' => $arr_4_0[0]['p'],
                        '1' => $arr_4_1[0]['p'],
                        '2' => $arr_4_2[0]['p']
                ) ,
                '5' => array(
                        '0' => $arr_5_0[0]['p'],
                        '1' => $arr_5_1[0]['p'],
                        '2' => $arr_5_2[0]['p']
                ) ,
                '6' => array(
                        '0' => $arr_6_0[0]['p'],
                        '1' => $arr_6_1[0]['p'],
                        '2' => $arr_6_2[0]['p']
                ) ,
                '7' => array(
                        '0' => $arr_7_0[0]['p'],
                        '1' => $arr_7_1[0]['p'],
                        '2' => $arr_7_2[0]['p']
                ) ,
                '8' => array(
                        '0' => $arr_8_0[0]['p'],
                        '1' => $arr_8_1[0]['p'],
                        '2' => $arr_8_2[0]['p']
                ) ,
                '9' => array(
                        '0' => $arr_9_0[0]['p'],
                        '1' => $arr_9_1[0]['p'],
                        '2' => $arr_9_2[0]['p']
                ) ,
                '10' => array(
                        '0' => $arr_10_0[0]['p'],
                        '1' => $arr_10_1[0]['p'],
                        '2' => $arr_10_2[0]['p']
                ) ,
             '11' => array(
                        '0' => $arr_11_0,
                        '1' => $arr_11_1,
                        '2' => $arr_11_2
                ) ,

        );
        $this->print_arr($arr , 1);
        return $arr;
    }
}
?>