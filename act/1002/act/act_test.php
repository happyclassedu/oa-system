<?php
include_once '../inc/common.php';
$g_xtb = 'lh_user';

class mod_test {
    var $xdb;
    var $xtb;
    function __construct() {
        global $g_xdb;
        $this->xdb = $g_xdb;
        $this->xtb = 'lh_user';

    }

    function list_read() {
        $arr = $this->xdb->read_all($this->xtb, 'id,birth,gradtime,dafee', 'id<>0 order by id LIMIT 10003,10003 ');
        return $arr;
    }

    function list_num() {
        $arr = $this->xdb->read_num($this->xtb, 'id<>0');
        return $arr;
    }

    function info_read(){
        $arr = $this->xdb->read_one($this->xtb, '*', 'loginid="wangzq"');
        return $arr;
    }

    function info_edit_base($xid) {
        i_xid_check($xid);
        $arr = $this->xdb->update($this->xtb, $sql_val, 'id="' . $xid . '"');
        return $arr;
    }


}

$mod = new mod_test();
$arr = $mod->info_read();
        var_dump($arr);
echo "ok";
?>
