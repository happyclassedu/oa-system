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

class mod_test {
    var $xdb;
    var $xtb;
    function __construct() {
        global $g_xdb;
        $this->xdb = $g_xdb;
        $this->xtb = 'lh_pinfo';
        $this->atb = 'lh_plog';

    }

    function list_read() {
        $arr = $this->xdb->read_all($this->xtb, 'id,cname,dafrom,datype,danature,daidold,dastate', 'caiwuduibi="20100929"');
        return $arr;
    }

    function list_num() {
        $arr = $this->xdb->read_num($this->xtb, 'caiwuduibi="20100929"');
        return $arr;
    }

    function list_act() {
        $arr = $this->list_read();
        foreach ($arr as $key => $val) {
            $sql_key = ' time,uid,uname,pid,pname,yname,ytype,ytext ';
            $sql_val = "'2010-09-29 18:07:57','287','张梅','".$val['id']."','".$val['cname']."','接收档案','档案管理','将“DL代理”类档案批量接收。'";
            $arr = $this->xdb->insert($this->atb, $sql_key, $sql_val);

        }
        return $arr;
    }

    function info_act() {
        $arr = $this->list_read();
        foreach ($arr as $key => $val) {


        }
        return $arr;
    }
}


$mod = new mod_test();
//$arr = $mod->list_act();

print_r($arr);

// 更新实例
//$g_xdb->update($g_xtb, 'birth="0000-00-00", gradtime="0000-00-00"', 'id="123456"');
?>