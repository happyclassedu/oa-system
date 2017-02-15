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
        $this->xtb = '#@__user';
    }

    function login() {
        $arr_login = i_json2php(@$_POST['arr_login']);
        $arr='';
        $arr['act'] = 'error';

        //只允许网址、用户名和密码用0-9,a-z,A-Z,'@','_','.','-'这些字符
        $arr_login['login_id'] = preg_replace('[^0-9a-zA-Z_@\!\.-]', '', $arr_login['login_id']);
        $arr_login['login_pw'] = preg_replace('[^0-9a-zA-Z_@\!\.-]', '', $arr_login['login_pw']);

        if ('' == $arr_login['login_id']) {
            $arr['msg'] = '错误101：对不起，请输入“登陆账号”！';
            $this->print_arr($arr, 1);
        }
        if ('' == $arr_login['login_pw']) {
            $arr['msg'] = '错误102：对不起，请输入“登陆密码”！';
            $this->print_arr($arr, 1);
        }

        $info = $this->xdb->read_one($this->xtb, '*', 'login_id="'. $arr_login['login_id'] .'" AND drwx!="4"');

        if ('' == $info['login_pw']) {
            $arr['msg'] = '错误103：对不起，用户账号存在问题，请联系网络管理员！';
            $this->print_arr($arr, 1);
//        } else if (md5($arr_login['login_pw']) != $info['login_pw']) {
        } else if ($arr_login['login_pw'] != $info['login_pw']) {
            $arr['msg'] = '错误104：对不起，密码错误，请重新输入！';
            $this->print_arr($arr, 1);
        }

        if ('1' == $info['drwx']) {
            $arr['msg'] = '错误105：对不起，该账号已被禁用，请联系网络管理员！';
            $this->print_arr($arr, 1);
        } else if ('2' == $info['drwx']) {
            $arr['msg'] = '错误106：对不起，帐号正在审核中，请稍后再试或联系网络管理员！';
            $this->print_arr($arr, 1);
        } else if ('3' == $info['drwx'] || '4' < $info['drwx']) {
            $arr['msg'] = '错误107：对不起，帐号存在异常，请联系网络管理员！';
            $this->print_arr($arr, 1);
        }

        $info['gopage'] = '/sys_app_0/3011/';

        $_SESSION['u_id'] = $info['id'];
        $_SESSION['login_id'] = $info['login_id'];
        $_SESSION['u_name'] = $info['name'];
        $_SESSION['u_sex'] = $info['sex'];

        $sqlwhere = 'id="' . $info['id'] . '"';
        $updata_values = ' ,login_ip="'.i_read_ip().'" ,login_time="'.i_time().'" ';
        $this->xdb->update($this->xtb, $updata_values, $sqlwhere);
        $arr['act'] = 'ok';
        $arr['msg'] = $info['gopage'];
        $arr['info'] = $info;
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