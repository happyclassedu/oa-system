/**
* 文件名称：index_com.js
* 功能描述：企业功能的前台程序。
* 代码作者：王争强
* 创建日期：2010-07-13
* 修改时间：2010-07-13
* 当前版本：v1.0
*/
var cid = '';

//$(document).ready(function(){
//
//});

function m_load() {   
    m_check_issession();
    m_load_arr_plug(); //加载数组
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#a_info_adsearch').click(function(){
        $('#a_info_adsearch').attr('href', './info_com_adsearch.htm?a=adsearch');
    });

    $('#btn_reg').click(function(){
        i_mdi_open('../htm/info_person_register.htm?a=add', '个人注册', 1);
    });

    $('#btn_search').click(function(){
        //        $('#a_list_job').attr('href', './list_job.htm?a=list&c_id=' + cid);
        var key = i_obj_val('d_key');
        if('' == key){
            key = 'null';
        }
        var big_classification = i_obj_val('d_big_classification');
        if('' == big_classification){
            big_classification = '0';
        }
        var addr1 = i_obj_val('d_addr1');
        if('' == addr1){
            addr1 = '0';
        }
        var trade = i_obj_val('d_trade');
        if('' == trade){
            trade = '0';
        }
        var atime = i_obj_val('d_atime');
        if('' == atime){
            atime = '0';
        }
        if('请输入关键字' == key){
            alert('请输入关键字');
        } else {
            i_mdi_open('./list_com_search.htm?a=search&jobtype=' + big_classification +',0' +  '&trade=0' + '&workplace=' + addr1 +',0' + '&publishdate=' + atime + '&key=' + key);
        }
    });

}

//function m_info_set_plug() {
//
//}

//function m_info_add_plug() {
//}


//function m_info_edit_plug() {
//}

//function m_info_view_plug() {
//
//}

//function m_info_input_plug(state) {
//
//}

function m_act_url_plug() {
    return false;  //可以终止跳转
}

//function m_info_save_plug() {
//    return true;
//}

function m_load_arr_plug(){
    m.tmp = '';
    m_info_occupation_plug('d_big_classification');
    m_info_province_plug('d_addr1');
}

function m_check_issession(){
    $.ajax({
        url : i_act + 'a=info_init',
        success : function(txt){
            m.arr = i_json2js(txt);
            cid = m.arr['id'];
            var str = '';
            if('' == cid){
               str = ' <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%" align=center><TBODY><TR><TD height=4></TD></TR></TBODY></TABLE>';
               str += '<TABLE border=0 cellSpacing=0 cellPadding=0 width="100%"><TBODY>';
               str += '<TR><TD height=27 width=64 align=right><FONT color=#848484>用户名：</FONT></TD><TD height=27><INPUT style="WIDTH: 115px" id="d_username"  class=input_login type="text"/><BR><SPAN id="d_error_username"></SPAN></TD></TR>';
               str += '<TR><TD height=27 width=64 align=right><FONT color=#848484>密&nbsp;&nbsp;码：</FONT></TD><TD height=27><INPUT style="WIDTH: 115px" id="d_password" class=input_login type="password"/><BR><SPAN id="d_error_password"></SPAN></TD></TR>'
               str += '<TR align=middle><TD height=27 colSpan=2><INPUT style="WIDTH: 50px; HEIGHT: 20px" id="" border=0 src="../img/button_login.gif" type="image" onclick="m_info_login()"/>&nbsp;<A href="./info_com_register.htm?a=add"><IMG border=0   src="../img/button_reg.gif" width=50 height=20></A></TD></TR>';
               str += '<TR align=middle><TD height=25 colSpan=2><IMG src="../img/Icon1.gif" width=5 height=9><A class=blue20 href="./info_com_register.htm?a=add">注册企业用户</A><IMG src="../img/Icon1.gif" width=5 height=9><A class=blue20  href="">找回密码</A></TD></TR>';
               str += ' </TBODY></TABLE>';
               i_obj_set('d_pan_login', str);
            } else {
                str = '<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0">';
                str += '<TR><TD align="center" height="27">欢迎您『 <span style="color:Red;">' + m.arr['fname'] + '</span> 』</TD></TR>';
                str += '<TR><TD align="center" height="27"><IMG height="7" src="../img/Icon3.gif" width="7"><A href="./list_job.htm?a=list">职位管理</A>&nbsp;&nbsp;&nbsp;<IMG height="7" src="../img/Icon3.gif" width="7"><A href="./list_resume_accept.htm?a=list">招聘管理</A></TD></TR>';
                str += '<TR><TD align="center" height="27"><IMG height="7" src="../img/Icon3.gif" width="7"><A href="./info_search.htm?a=search">简历搜索</A>&nbsp;&nbsp;&nbsp;<IMG height="7" src="../img/Icon3.gif" width="7"><A href="info_com_basic.htm?a=edit&x=' + cid + '">帐号管理</A></TD></TR>';
                str += '<TR><TD align="center" height="27"><IMG height="7" src="../img/Icon3.gif" width="7"><A href="">视频招聘</A>&nbsp;&nbsp;&nbsp;<IMG height="7" src="../img/Icon3.gif" width="7"><A href="" onclick="m_info_loginout()">安全退出</A></TD></TR>';
                str += '</TABLE>';
                i_obj_set('d_pan_login', str);
            }
        }
    });
}
/*******登录函数*******/
function m_info_login(){

    m.arr = new Object();
    m.arr['loginid'] = i_obj_val('d_username');
    m.arr['loginpw'] = i_obj_val('d_password');
    //        m_islogin();
    $.ajax({
        url : i_act + 'a=info_login',
        data : 'arr=' +  i_js2json(m.arr),
        success : function(txt){
            switch (txt) {
                case 'err_u_null' :
                    m_error_msg('d_error_username', '用户名不能为空，请选择！', '0');
                    break;
                case 'err_u_nexist' :
                    m_error_msg('d_error_username', '用户不存在，请注册！', '0');
                    break;
                case 'err_pwd_null' :
                    m_error_msg('d_error_username', '', '2');
                    m_error_msg('d_error_password', '密码不能为空，请选择！', '0');
                    break;
                case 'err_pwd_no' :
                    m_error_msg('d_error_password', '密码不正确，请重新填写！', '0');
                    break;
                case 'err_session_inval' :
                    m_error_msg('d_error_password', 'session失效，请检查！', '0');
                    break;
                case txt :
//                    i_mdi_open(location.href, '', 1);
                    $.cookie('c_id', txt);
                    i_mdi_open(location.href, '', 1);
                    break;
                    break;
                default :
                    alert('操作错误，正在关闭！');
                    i_mdi_close();
                    break;
            }
        }
    });
}

/******安全退出*******/
function m_info_loginout(){
    $.ajax({
        url : i_act + 'a=info_loginout',
        success : function(txt){
            if('1'== txt){
                i_mdi_open(location.href, '企业服务' , 1);
            } else {
                alert('安全退出失败！');
            }
        }
    });
}

