<?php

/**通过http访问读取数据到变量*/
function read_http($url) {
    return @file_get_contents($url);
}

/**处理$buffer内容，更换路径等*/
function buffer_replace_www($buffer) {
    $buffer = preg_replace('[(<!--)+.+(-->)]', '', $buffer);
    $buffer = str_ireplace("\r", '', $buffer);
    $buffer = str_ireplace("\n", '', $buffer);
    $buffer = str_ireplace('  ', '', $buffer);
    $buffer = str_ireplace('	', '', $buffer);
    $buffer = str_ireplace('doc::', '/doc/', $buffer);
    $buffer = str_ireplace('<a class="doc_down" href="', '<a class="doc_down" href="' . m_act . '?a=down&x=', $buffer);
    return $buffer;
}

function buffer_replace_dev($buffer) {
    $buffer = str_ireplace('doc::', '/doc/', $buffer);
    $buffer = str_ireplace('<a class="doc_down" href="', '<a class="doc_down" href="' . m_act . '?a=down&x=', $buffer);
    return $buffer;
}

/**
 * i_tpl2www，由模板生成实体处理函数.
 * @参数 $buffer_zip  : 是否压缩代码.
 * @参数 $buffer_mk   : 是否生成文件.
 * @参数 $buffer_show : 是否输出缓存.
 * @参数 $ws  : 给smarty赋值的变量.
 * @参数 $tpl : 给smarty赋值的模板.
 * @参数 $mkf : 生成文件的路径.
 */
function i_tpl2www($buffer_zip=1, $buffer_mk=0, $buffer_show=0) {
    global $ws, $tpl, $mkf;
    $g_smarty = i_smarty_create();  //创建smaty模型实体
    $g_smarty->assign('ws', $ws);  //smaty变量赋值

    $buffer = i_smarty_get_contents($g_smarty, $tpl);  //获取内容到缓存

    if (0 == $buffer_zip) {
        $buffer = buffer_replace_dev($buffer);
    } else {
        $buffer = buffer_replace_www($buffer);
    }

    if (1 == $buffer_mk && $mkf) {
        i_make_file($mkf, $buffer);  //执行生成操作
    }

    if (1 == $buffer_show) {
        print_r($buffer);  //输出缓存
    }
}

function i_tpl2www_act() {
    if ('1' == ws_mk) {
        i_tpl2www(1, 1);
    } else if ('1' == @$_GET['dev']) {
        i_tpl2www(0, 0, 1);
    } else {
        i_tpl2www(1, 0, 1);
    }
}

function i_tpl2www_part() {
    global $tpl, $mkf, $xid;
    $tpl = $xid . '_scr.htm';  //定义页面模板路径
    $mkf = m_app . 'tpl/' . $xid . '.htm';  //定义生成文件路径
    i_tpl2www(0, 1);
    $tpl = $xid . '_scr_act.htm';  //定义页面模板路径
    $mkf = m_app . 'tpl/' . $xid . '_act.htm';  //定义生成文件路径
    i_tpl2www(0, 1);
}

function i_tpl2www_link() {
    global $tpl, $mkf, $xid;
    $tpl = 'link_scr.htm';  //定义页面模板路径
    $mkf = m_app . 'tpl/' . $xid . '.htm';  //定义生成文件路径
    i_tpl2www(0, 1);
    $tpl = 'link_scr_act.htm';  //定义页面模板路径
    $mkf = m_app . 'tpl/' . $xid . '_act.htm';  //定义生成文件路径
    i_tpl2www(0, 1);
}

function i_get_pid() {
    global $pid;
    if (empty($pid)) {
        $pid = @$_GET['p'];  //获取 操作对象id
    }

    if ('' == $pid || '1' > $pid) {
        $pid = '1';  //默认页码为：1
    }
    return $pid;
}

function i_list_page($xid, $page, $fix='list') {
    if (1 == $page['page_num']) {
        $page['page_prev'] = 1;
        $page['page_next'] = 1;
    } else if (1 == $page['page_now']) {
        $page['page_prev'] = 1;
        $page['page_next'] = 2;
    } else if ($page['page_num'] == $page['page_now']) {
        $page['page_prev'] = $page['page_num'] - 1;
        $page['page_next'] = $page['page_num'];
    } else {
        $page['page_prev'] = $page['page_now'] - 1;
        $page['page_next'] = $page['page_now'] + 1;
    }

    if (10 > $page['page_num'] || 6 > $page['page_now']) {
        $page['page_b'] = 1;
        if (10 > $page['page_num']) {
            $page['page_e'] = $page['page_num'];
        } else {
            $page['page_e'] = 9;
        }
    } else if ($page['page_num'] - $page['page_now'] < 6) {
        $page['page_b'] = $page['page_num'] - 8;
        $page['page_e'] = $page['page_num'];
    } else {
        $page['page_b'] = $page['page_now'] - 4;
        $page['page_e'] = $page['page_now'] + 4;
    }

    $arr = $page;
    if (1 == ws_mk) {
        $arr['first'] = $fix. '_'. $xid .'_1.htm';
        $arr['last'] = $fix. '_'. $xid .'_'. $page['page_num'] .'.htm';
        $arr['prev'] = $fix. '_'. $xid .'_'. $page['page_prev'] .'.htm';
        $arr['next'] = $fix. '_'. $xid .'_'. $page['page_next'] .'.htm';
        for($i=$page['page_b']; $i<=$page['page_e']; $i++) {
            $arr['num'][$i] = $fix. '_'. $xid .'_'. $i .'.htm';
        }
    } else {
        $arr['first'] = '?a='. $fix .'&x='. $xid .'&p=1';
        $arr['last'] = '?a='. $fix .'&x='. $xid .'&p='. $page['page_num'];
        $arr['prev'] = '?a='. $fix .'&x='. $xid .'&p='. $page['page_prev'];
        $arr['next'] = '?a='. $fix .'&x='. $xid .'&p='. $page['page_next'];
        for ($i=$page['page_b']; $i<=$page['page_e']; $i++) {
            $arr['num'][$i] = '?a='. $fix .'&x='. $xid .'&p='. $i;
        }
    }

    return $arr;
}

function   i_display_multi_menu($arr) {
    $str .= '<ul><li class="arrow"></li>';
    for($i=0;$i<count($arr);$i++){
         $str .= '<li><a href="' . $arr[$i]['url'] . '" ';
         if(!empty ($arr[$i]['child'])) {
            $str .= ' class="fNiv" target="_blank">' . $arr[$i]['name'] . '</a>';
            $str .=  i_display_multi_menu($arr[$i]['child']) . '</li>';
        }  else {
            $str .= ' target="_blank">' . $arr[$i]['name'] . '</a></li>';
        }
     }
     $str .= '</ul>';
     return $str;
}

//获取菜单及子菜单
 function i_get_menu2child($arr) {
    //定义目标数组
     $d = array();
     //定义索引数组，用于记录节点在目标数组的位置
     $ind = array();
     foreach($arr as $v) {
         $v['child'] = array(); //给每个节点附加一个child项
         if($v['fid'] == 0) {
             $i = count($d);
             $d[$i] = $v;
             $ind[$v['id']] = & $d[$i];
         } else {
             $i = count($ind[$v['fid']]['child']);
             $ind[$v['fid']]['child'][$i] = $v;
             $ind[$v['id']] = & $ind[$v['fid']]['child'][$i];
         }
     }

    //检查结果
//    print_r($d);
     return $d;
 }
?>