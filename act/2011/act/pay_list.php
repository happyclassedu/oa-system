<?php
/*
 * 文件名称：pay_list.php
 * 功能描述：工资管理信息列表查询功能。
 * 代码作者：钱宝伟(创建)
 * 创建日期：2010-06-30
 * 修改日期：2010-06-30
 * 当前版本：V1.0
*/
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_pay.php';
$mod_pay = new mod_pay();

switch ($act) {
    case 'num_read':
        $mod_pay->read_num();
        break;
    case 'list_read':
        $mod_pay->read_list();
        break;
    case 'info_del':
        $mod_pay->del_info($xid);
        break;
    case 'init_zhangtao':
        $mod_pay->zhangtao_info();
}
?>
