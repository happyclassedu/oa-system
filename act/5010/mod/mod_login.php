<?php
/*
 * 文件名称：mod_login.php
 * 功能描述：系统登录操作类。
 * 代码作者：孙振强
 * 创建日期：2009-11-28
 * 修改日期：2010-08-08
 * 当前版本：V2.0
*/

class mod_login {
    var $xdb;
    var $xtb;

    function __construct() {
        global $g_xdb;
        $this->xdb = $g_xdb;
        $this->xtb = 'lh_user';
    }

    function login() {
        $login_arr = i_json2php(@$_POST['arr_login']);
        $user_name = $login_arr['user_name'];
        $user_pass = $login_arr['user_pass'];

        //只允许用户名和密码用0-9,a-z,A-Z,'@','_','.','-'这些字符
        $user_name = preg_replace('[^0-9a-zA-Z_@\!\.-]', '', $user_name);
        $user_pass = preg_replace('[^0-9a-zA-Z_@\!\.-]', '', $user_pass);

        if ($user_name == '') {
            return 'error:错误101：对不起，请输入用户账号！';
        }
        if ($user_pass == '') {
            return 'error:错误102：对不起，请输入用户密码！';
        }

        $user_pass = md5($user_pass);

        $infos = $this->xdb->read_one($this->xtb, '*', 'loginid="'.$user_name.'"');

        $arr['act'] = 'error';
        if ($infos['loginpw'] == '') {
            $arr['msg'] = '错误103：对不起，用户账号存在问题，请联系网络管理员！';
            $this->print_arr($arr, 1);
        } else if ($infos['loginpw'] != $user_pass) {
            $arr['msg'] = '错误104：对不起，密码错误，请重新输入！';
            $this->print_arr($arr, 1);
        }

        if ($infos['open'] == 'close') {
            $arr['msg'] = '错误105：对不起，该账号已被禁用，请联系网络管理员！';
            $this->print_arr($arr, 1);
        } else if ($infos['open'] == 'auditing') {
            $arr['msg'] = '错误106：对不起，帐号正在审核中，请稍后再试或联系网络管理员！';
            $this->print_arr($arr, 1);
        } else if ($infos['open'] != 'open' && $infos['open'] != 'hide') {
            $arr['msg'] = '错误107：对不起，帐号存在异常，请联系网络管理员！';
            $this->print_arr($arr, 1);
        }

//        if (!strstr($infos['gopage'], 'http://') && !strstr($infos['gopage'], '/')) {
        if (!strstr($infos['gopage'], 'http://')) {
            $infos['gopage'] = '/sys_app_0/5011/';
        }

        $_SESSION['MyUID'] = $infos['id'];
        $_SESSION['MyTID'] = $infos['tid'];
        $_SESSION['MyTename'] = $infos['tename'];
        $_SESSION['MyID'] = $infos['loginid'];
        $_SESSION['MyName'] = $infos['name'];
        $_SESSION['MyHP'] = $infos['gopage'];
        $_SESSION['duty_id'] = $infos['duty_id'];
        $_SESSION['u_sex'] = $infos['sex'];

        $sqlwhere = 'id="'.$infos['id'].'"';
        $updata_values = ' ,loginip="'.i_read_ip().'" ,logintime="'.i_time().'" ';
        $this->xdb->update($this->xtb, $updata_values, $sqlwhere);
        $arr['act'] = 'ok';
        $arr['msg'] = $infos['gopage'];
        $this->print_arr($arr, 1);
    }

    function logout() {
        session_destroy();
        session_unset();
        exit;
    }

    function print_arr($arr, $p_j=0) {
        if (1 == $p_j) {
            $arr = i_php2json($arr);
        }
        print_r($arr);
        exit;
    }
}
?>