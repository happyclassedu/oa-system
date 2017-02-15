<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
include_once '../inc/common.php';

$act = i_get_act();
$xid = i_get_xid();

include_once '../mod/mod_beat_ileap.php';

$mod_beat_ileap  = new  mod_beat_ileap();


switch($act) {
    case "beat_ileap_list";
        $result_arr = $mod_beat_ileap->beat_ileap_list();
        print_r($result_arr) ;
        break;
    case "beat_ileap_eidt" ;
        $result_arr = $mod_beat_ileap->beat_eidt_info($xid);
        print_r($result_arr);
        break;
}
?>
