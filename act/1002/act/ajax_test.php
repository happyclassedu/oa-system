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
$g_xtb = 'lh_pinfo20100808';

class mod_test {
    var $xdb;
    var $xtb;
    function __construct() {
        global $g_xdb;
        $this->xdb = $g_xdb;
        $this->xtb = 'lh_pinfo20100808';

    }

    function list_read() {
        $arr = $this->xdb->read_all($this->xtb, 'id,birth,gradtime,dafee', 'id<>0 order by id LIMIT 10003,10003 ');
        return $arr;
    }

    function list_num() {
        $arr = $this->xdb->read_num($this->xtb, 'id<>0');
        return $arr;
    }

    function info_edit_base($xid) {
        i_xid_check($xid);
        $arr = $this->xdb->update($this->xtb, $sql_val, 'id="' . $xid . '"');
        return $arr;
    }


}

$mod = new mod_test();
$arr = $mod->list_read();

//$str = '';
foreach ($arr as $key => $val) {
    $str = '';
    $str = 'birth_date="' . date_act($val['birth']) . '", gradtime_date="' . date_act($val['gradtime']) . '", dafee_date="' . date_act($val['dafee']) . '"';

    $g_xdb->update($g_xtb, $str, 'id="'.$val['id'].'"');

}
echo "ok";

function date_act($date0) {
    if ($date0=="") {
        $date1="00000000";
    }
    else if (stristr($date0,".")) {
            $array = explode(".",$date0);
            $year  = $array[0];
            $month = $array[1];
            $day   = @$array[2];

            if(!$month) $month = "01";
            if(strlen($month)==1) $month = "0".$month;
            if(!$day)   $day   = "01";
            if(strlen($day)  ==1)   $day   = "0".$day;


            $date1 = $year.$month.$day;
        } else if (stristr($date0,"-")) {
                $array = explode("-",$date0);
                $year  = $array[0];
                $month = $array[1];
                $day   = @$array[2];
                if(!$month) $month = "01";
                if(strlen($month)==1) $month = "0".$month;
                if(!$day)   $day   = "01";
                if(strlen($day)  ==1)   $day   = "0".$day;


                $date1 = $year.$month.$day;
            }
            else if (stristr($date0,"/")) {
                    $array = explode("/",$date0);
                    $year  = $array[0];
                    $month = $array[1];
                    $day   = @$array[2];
                    if(!$month) $month = "01";
                    if(strlen($month)==1) $month = "0".$month;
                    if(!$day)   $day   = "01";
                    if(strlen($day)  ==1)   $day   = "0".$day;


                    $date1 = $year.$month.$day;
                }

             else if (stristr($date0,"年")) {
                        $array = explode("年",$date0);
                        $year  = $array[0];
                        $month = $array[1];
                        $array = explode("月",$month);
                        $month = $array[0];
                        $day   = $array[1];
                        $array = explode("日",$day);
                        $day   = $array[0];
                        if(!$month) $month = "01";
                        if(strlen($month)==1) $month = "0".$month;
                        if(!$day)   $day   = "01";
                        if(strlen($day)  ==1)   $day   = "0".$day;


                        $date1 = $year.$month.$day;
                    } else if (strlen($date0)==6) {
                            $date1 = $date0."01";
                        } else if (strlen($date0)==4) {
                                $date1 = $date0."0101";
                            } else if (strlen($date0) >8) {
                                //		echo "错误数据：".$date0."<br/>";
                                    $remark=$date0;
                                    $date1="00000000";
                                } else if (strlen($date0) <4) {
                                    //		echo "错误数据：".$date0."<br/>";
                                        $remark=$date0;
                                        $date1="00000000";
                                    } else {
                                        $date1 = $date0;
                                    }

    $year  = substr($date1, 0, 4);
    $month = substr($date1, 4, 2);
    $day   = substr($date1, 6, 2);

    if ($month>12 || $day>31) {
    //		echo $year;
    //		echo "-";
    //		echo $month;
    //		echo "-";
    //		echo $day;
    //		echo "<br>";
        $date1 = "0000-00-00";


    } else {
        $date1 = $year."-".$month."-".$day;
    }
    return $date1;
}
// 更新实例
//$g_xdb->update($g_xtb, 'birth="0000-00-00", gradtime="0000-00-00"', 'id="123456"');
?>