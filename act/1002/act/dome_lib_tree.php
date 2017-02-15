<?php
/*
 * 文件名称：mod_base_info.php
 * 功能描述：信息管理基础模型
 * 代码作者：孙振强（创建、重构）
 * 创建时间：2010-07-08
 * 修改时间：2010-07-08
 * 当前版本：v1.0
*/
include_once '../inc/common.php';


//
//if ($fid != "") $parameter['xid'] = $fid;
//if ($max != "") $parameter['layer_max'] = $max;

//include_once g_lib."lib_tree.php";

//$cfg['xtb'] = '#@__ws_menu';
//$cfg['fid'] = '0';
//$cfg['sql'] = ' AND ws_id=3 ';
$tree_tmp = i_tree_create('#@__ws_menu', '0', ' AND ws_id=3 ');


foreach($tree_tmp as $key => $val) {
    echo $val['fix'].$val['name'].'<br>';
}  //foreach



//print_r($arr);

// 更新实例
//$g_xdb->update($g_xtb, 'birth="0000-00-00", gradtime="0000-00-00"', 'id="123456"');
?>