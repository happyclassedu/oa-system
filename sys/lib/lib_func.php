<?php
/*
 * 文件名称：function_basic.php
 * 功能描述：一些基本的、常用的函数
 * 代码作者：孙振强
 * 创建时间：2008-12-13
 * 修改日期：2008-12-14
 * 当前版本：V2.0
*/

/* * 初始化系统 */

function i_sys_onload() {
//	include_once g_cfg.'config_session.php';
}
/* * 创建一个数据库操作类（class_db）的实体 */

function i_xdo_create($cfg_name = '') {
    $cfg_file = g_cfg . 'cfg_xdb_' . $cfg_name . '.php';
    if (!file_exists($cfg_file)) {
        echo 'No DB config file, can not create';
        exit;
    }
    include $cfg_file;
    include_once g_lib . 'lib_xdo.php';
    return new lib_xdo($g_cfg_db);
}
/* * 返回程序执行时间 */

function i_act_time() {
    global $g_stime;
    if ('' == $g_stime) {
        return 0;
    } else {
        $tmp = microtime(true) - $g_stime;
        return 'use:' . $tmp . ' .';
    }
}
/* * 创建 session 的实体 */

function i_session_create($session_name) {
    include_once g_cfg . 'cfg_session.php';
}
/* * 清空 session 的实体 */

function i_session_clear($session_name) {
    $dir = g_tmp . 'sessions/' . $session_name;
    i_dir_del($dir);
}
/* * 获取服务器当前时间，可校正时间差 */

function i_time_u($time = 0) {
    $time = time() + $time;  //这里可以修改基准时间。如“+28800”是加8小时。
    return $time;
}

function i_time($time = 0) {
    $time = date('Y-m-d H:i:s', i_time_u($time));
    return $time;
}
/* * 生成文件函数 */

function i_make_file($fname, $buffer) {
    if (fopen($fname, 'w+')) {
        $fp = fopen($fname, 'w+');
        fwrite($fp, $buffer);
        fclose($fp);
    }
}
/* * 读取文件到变量函数 */

function i_read_file($fname) {
    if (file_exists($fname)) {
        return file_get_contents($fname);
    }
}
/* * 通过http访问读取数据到变量 */

function i_read_http($url) {
    return @file_get_contents($url);
}
/* * 去掉字符串的首尾空格 */

function i_str_replace_space($str) {
    $str = preg_replace("/(^<br>*)|(<br>*$)/ ", '', $str);
    $str = preg_replace("/(^[\s]*)|([\s]*$)/ ", '', $str);
    return $str;
}

//缩短字节
function i_str_short($str, $len) {
    if (strlen($str) > $len) {
        for ($i = 0; $i < $len; $i++) {
            if (ord(substr($str, $i, 1)) > 123) {
                $i++;
            }
        }
        return substr($str, 0, $i);
    } else {
        return $str;
    }
}

function i_dir_del($dir) {
    if (is_dir($dir) == false) {
        exit("The Directory Is Not Exist!");
    }
    $handle = opendir($dir);
    while (($file = readdir($handle)) !== false) {
        if ($file != "." && $file != "..") {
            is_dir("$dir/$file") ? dir_del("$dir/$file") : unlink("$dir/$file");
        }
    }
    if (readdir($handle) == false) {
        closedir($handle);
        rmdir($dir);
    }
}

function i_dir_mk($dir, $drwx='0755') {
    if (!is_dir($dir)) {
        mkdir($dir, $drwx);
    }
}

//**获取客户端ip
function i_read_ip() {
    $client_ip = '';
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $client_ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else if (!empty($_SERVER['REMOTE_ADDR'])) {
        $client_ip = $_SERVER['REMOTE_ADDR'];
    } else {
        $client_ip = '';
    }
    return $client_ip;
}

//**防错，给xid赋值
function i_get_xid() {
    global $xid;
    if (empty($xid)) {
        $xid = @$_GET['x'];  //获取 操作对象id
    }
    return $xid;
}

//**防错，给act赋值
function i_get_act() {
    global $act;
    if (empty($act)) {
        $act = @$_GET['a'];
    }
    return $act;
}

/**
 * Transform php's Array for decodeURL.
 * @param arr : php's Array.
 * @return array
 */
function i_arr4decode($arr) {
    if (is_string($arr)) {
        return urldecode($arr);
    } else if (is_array($arr)) {
        foreach ($arr as $key => $val) {
            if (is_string($val) || is_numeric($val)) {
                $arr[$key] = urldecode($val);
            } else if (is_array($val)) {
                $arr[$key] = i_arr4decode($val);
            } else {
                $arr[$key] = '';
            }
        }
        return $arr;
    } else {
        return '';
    }
}

/**
 * Transform php's Array for encodeURL.
 * @param arr : php's Array.
 * @return array
 */
function i_arr4encode($arr) {
    if (is_string($arr)) {
        return urlencode($arr);
    } else if (is_array($arr)) {
        foreach ($arr as $key => $val) {
            if (is_string($val) || is_numeric($val)) {
                $arr[$key] = urlencode($val);
            } else if (is_array($val)) {
                $arr[$key] = i_arr4encode($val);
            } else {
                $arr[$key] = '';
            }
        }
        return $arr;
    } else {
        return '';
    }
}

/**
 * Transform php's String Json to php's Array, and decode_url.
 * @param str : php's String Json.
 * @return array
 */
function i_json2php($arr) {
    $arr = str_replace('\\', '', $arr);
    $arr = json_decode($arr, true);
    return $arr;
}

/**
 * Transform php's String Json to php's Array, and decode_url.
 * @param str : php's String Json.
 * @return array
 */
function i_php2json($arr) {
    if ('arr' == @$_GET['p_j'] || '' == $arr) {
        return $arr;
    }
    $arr = json_encode($arr);
//    $arr = urlencode($arr);
//    $arr = str_replace('+', ' ', $arr);
    return $arr;
}

/**
 * Transform php's Array for iconv UTF-8.
 * @param arr : php's Array.
 * @return array
 */
function i_arr4iconv($arr, $utf = 'GBK', $ral = '0') {
    if ('UTF8' == $utf) {
        return $arr;
    }
    if (is_string($arr)) {
        return i_str4iconv($arr, $utf, $ral);
    } else if (is_array($arr)) {
        foreach ($arr as $key => $val) {
            if (is_string($val) || is_numeric($val)) {
                $arr[$key] = i_str4iconv($val, $utf, $ral);
            } else if (is_array($val)) {
                $arr[$key] = i_arr4iconv($val, $utf, $ral);
            } else {
                $arr[$key] = '';
            }
        }
        return $arr;
    } else {
        return '';
    }
}

/**
 * Transform php's String for iconv UTF-8.
 * @param arr : php's String.
 * @return string
 */
function i_str4iconv($str, $utf = 'GBK', $ral = '0') {
    if ('UTF8' == $utf) {
        return $str;
    }

    if (is_string($str)) {
        if ('0' == $ral) {
            $str = @iconv($utf, 'UTF-8', $str);
        } else {
            $str = @iconv('UTF-8', $utf, $str);
        }
        return $str;
    } else {
        return '';
    }
}

/**
 * Transform php's String Json to php's Array, and decode_url.
 * @param str : php's String Json.
 * @return array
 */
function i_xid_check($xid) {
    if ('' == $xid || !is_numeric($xid)) {
        echo '"' . $xid . '".';
        echo 'no xid or xid is not a num.';
        exit;
    }
}

/**创建一个smarty类实体*/
function i_smarty_create($cfg_dir = '0', $cfg_cache = false) {
    if ('1' == $cfg_dir) {
        $template_dir = '../tpl/';
    } else {
        $tmp = $_SERVER["SCRIPT_FILENAME"];
        preg_match('/act(.*?)act/ms', $tmp, $tmp);

        $tmp2 = substr($tmp[1], strlen($tmp[1])-5, strlen($tmp[1])-2);
        if (6 != strlen($tmp[1])) {
            $tmp = substr($tmp[1], 0, strlen($tmp[1])-6);
        } else {
            $tmp = '';
        }
        $tmp = substr(g_app, 0, strlen(g_app)-1) . $tmp . '/';
        $template_dir = $tmp . $tmp2 . '/tpl/';
    }

    include_once g_lib.'smarty/smarty.class.php';
    $smarty = new smarty();
    //下面的(你的网站目录)用绝对路径，比如d:/intepub/wwwroot
    $smarty->caching = $cfg_cache;
    $smarty->template_dir = $template_dir;
    $smarty->cache_dir    = g_tmp.'cache/'.app_code;
    $smarty->compile_dir  = g_tmp.'smarty/'.app_code;
    //上面四行为使用Smarty前的必要参数配置
    $smarty->left_delimiter  = '<!--{';
    $smarty->right_delimiter = '}-->';

    i_dir_mk($smarty->compile_dir, 0777);
    i_dir_mk($smarty->cache_dir);
    return $smarty;
}

/**获取smarty模板缓存*/
function i_smarty_get_contents($g_smarty, $tpl) {
    if (!$g_smarty || !$tpl) {
        return;
    }
    $buffer0 = ob_get_contents();
    ob_end_clean();
    ob_start();
    $g_smarty->display($tpl);
    $buffer1 = ob_get_contents();
    ob_end_clean();
    echo $buffer0;
    return $buffer1;
}

/**获取smarty模板缓存*/
function i_file_down($file_type, $file_name, $file_text) {
    switch ($file_type) {
        case '.xlsx':
        case '.xls':
        case '.cvs':
            $content_type = 'application/vnd.ms-excel';
            break;
        default:
            $content_type = 'application/octet-stream';
    }

    $file_name = urlencode($file_name);
    $file_name = str_replace("+", "%20", $file_name);

    ob_end_clean();
    ob_start();
    header('Pragma: public');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: pre-check=0, post-check=0, max-age=0');
    header('Content-Transfer-Encoding: binary');
    header('Content-Encoding: none');
    header('Content-type:' . $content_type);
    header('Content-Disposition: attachment; filename="' . $file_name . $file_type . '"');
    ob_end_clean();
    echo $file_text;
    exit;
}

/**创建一个数据库操作类（lib_tree）的实体*/
function i_tree_create($xtb, $fid, $sql) {
//	if ($style) {
//            include $style;
//        } else {
//            include sys_lib."class_tree/default.php";
//        }
    include_once g_lib . 'lib_tree.php';
    $cfg['xtb'] = $xtb;
    $cfg['fid'] = $fid;
    $cfg['sql'] = $sql;
    $lib = new lib_tree($cfg);
    $tmp = $lib->tree_show();
    $lib = NULL;
    return $tmp;
}

/**创建一个数据库操作类（lib_tree）的实体*/
function i_tree_create_1($xtb, $f_id, $sql) {
//	if ($style) {
//            include $style;
//        } else {
//            include sys_lib."class_tree/default.php";
//        }
    include_once g_lib . 'lib_tree_1.php';
    $cfg['xtb'] = $xtb;
    $cfg['f_id'] = $f_id;
    $cfg['sql'] = $sql;
    $lib = new lib_tree($cfg);
    $tmp = $lib->tree_show();
    $lib = NULL;
    return $tmp;
}

/**获取smarty模板缓存*/
function i_include_get_contents($tpl) {
    $buffer0 = ob_get_contents();
    ob_end_clean();
    ob_start();
    include $tpl;
    $buffer1 = ob_get_contents();
    ob_end_clean();
    echo $buffer0;
    return $buffer1;
}

/** 邮件发送函数 */
function i_mail_send($mail_addr, $mail_subject, $mail_body, $mail_replyto='') {
    include_once g_cfg . 'cfg_mail.php';
    include_once g_lib . 'lib_phpmailer.php';
    $mail = new PHPMailer();
    $mail->IsSMTP();  //send via SMTP
    $mail->Host = $g_cfg_mail['host'];  //SMTP servers
    $mail->SMTPAuth = $g_cfg_mail['smtp_auth'];  //turn on SMTP authentication
    $mail->Username = $g_cfg_mail['user_name'];   //SMTP username  注意：普通邮件认证不需要加 @域名
    $mail->Password = $g_cfg_mail['user_pass'];        //SMTP password

    $mail->From     = $g_cfg_mail['from_mail'];  //发件人邮箱
    $mail->FromName = $g_cfg_mail['from_name'] ;  //发件人

    $mail->CharSet  = "UTF-8";  // 这里指定字符集！
    $mail->Encoding = "base64";

//可给多人发送邮件，邮件分割符可为";"，"，"，"；"，","。最好为";"。空格将被过滤
    $mail_addr = str_ireplace(' ',  '',  $mail_addr);
    $mail_addr = str_ireplace('　', '',  $mail_addr);
    $mail_addr = str_ireplace(',',  ';', $mail_addr);
    $mail_addr = str_ireplace('，', ';', $mail_addr);
    $mail_addr = str_ireplace('；', ';', $mail_addr);
    $arr_mail_addr = explode(";", $mail_addr);
    foreach($arr_mail_addr as $val) {
        $mail->AddAddress($val);
    }

    $mail->AddBCC($g_cfg_mail['mail_bcc2'], '系统发送备份');

    if ('' != $mail_replyto) {
        $mail->AddReplyTo($mail_replyto);
    }

//$mail->WordWrap = 50; // set word wrap
//$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");
    $mail->IsHTML(true);  // send as HTML
    $mail->Subject = $mail_subject;  //邮件主题
    $mail->Body    = $mail_body;  //邮件内容
    $mail->AltBody ="text/html";

    if(!$mail->Send()) {
        return $mail->ErrorInfo;
    } else {
        return true;
    }
}
?>