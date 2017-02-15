<?php
/*
 * 文件名称：mod_mdi_header.php
 * 功能描述：主窗口header模型。
 * 代码作者：孙振强
 * 创建日期：2009-11-28
 * 修改日期：2010-08-09
 * 当前版本：V3.0
*/

class mod_mdi_header {
    /**读取--信息--单条记录至数组*/
    function read_user_info() {
        if (u_sex == '男') {
            $u_sex = '先生';
        }else if (u_sex == '女') {
            $u_sex = '女士';
        }

        $time_now = date("H", i_time_u());
        if ($time_now < 11) {
            $hi = '早上好';
        }else if ($time_now >= 11 && $time_now < 15) {
            $hi = '中午好';
        }else if ($time_now >= 15 && $time_now < 18) {
            $hi = '下午好';
        }else if ($time_now >= 18) {
            $hi = '晚上好';
        }else {
            $hi = '您好';
        }

        $str = u_name.' '.$u_sex.'，'.$hi.'！';
        print_r($str);
        return $str;
    }


    /**读取--信息--单条记录至数组*/
    function read_calendar() {
        include_once '../inc/calendar_chinese.php';
        $str = date("Y年n月j日　").$weekday[$cur_wday]."　".$mten[$everymonth[$j][14]].$mtwelve[$everymonth[$j][15]]."年　".$nlmon.$nlday;
        print_r($str);
        return $str;
    }
}
?>