<?php
/**
 * 文件名称：mod_admin.php
 * 功能描述：“莲湖英才网”--管理模型。
 * 代码作者：孙振强（创建）
 * 当前版本：V1.0
 * 创建日期：2010-06-30
 * 修改日期：2010-06-30
 */

class mod_admin {
    //====定义此类私有变量==========
//    private $xdb;  //数据库操作实体
//    private $xtb;  //主要操作数据库表

    //====始化此类初方法==========
    function __construct() {
//        global $g_xdb;
//        $this->xdb = $g_xdb;
//        $this->xtb = '#@__ileap_info';
    }
    //====基本操作方法开始========

    function svn_update() {
        $arr = i_read_http('http://192.168.4.2/sys_admin/act/?a=svn_update_lianhuren_www');
        $arr = urldecode($arr);
        $arr = json_decode($arr, true);
        $arr = i_php2json($arr);
        print_r($arr);
    }

    function svn_update_oa() {
        $arr = i_read_http('http://192.168.4.8/sys_admin/act/?a=svn_update_oa_2009');
        $arr = urldecode($arr);
        $arr = json_decode($arr, true);
        $arr = i_php2json($arr);
        print_r($arr);
    }
}
?>