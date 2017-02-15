/**
* 文件名称：info_person.js
* 功能描述：(个人)快速搜索功能的前台程序。
* 代码作者：王争强
* 创建日期：2010-07-13
* 修改时间：2010-07-13
* 当前版本：v1.0
*/
var pid = '';

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
        $('#a_info_adsearch').attr('href', './info_person_adsearch.htm?a=adsearch');
    });

    $('#btn_reg').click(function(){
        i_mdi_open('./info_person_register.htm?a=add', '个人注册', 1);
    });

    $('#btn_search').click(function(){

        var key = i_obj_val('d_key');
        if('' == key){
            key = 'null';
        }
        var key_class = i_obj_val('d_key_class');

        var big_classification = i_obj_val('d_big_classification');
        if('' == big_classification){
            big_classification = '0';
        }
        var small_classification = i_obj_val('d_small_classification');
        if('' == small_classification){
            small_classification = '0';
        }
        var addr1 = i_obj_val('d_addr1');
        if('' == addr1){
            addr1 = '0';
        }
        var addr2 = i_obj_val('d_addr2');
        if('' == addr2){
            addr2 = '0';
        }
        var trade = i_obj_val('d_trade');
        if('' == trade){
            trade = '0';
        }
        var job_day = i_obj_val('d_job_day');
        if('' == job_day){
            job_day = '0';
        }
        if('请输入关键字' == key){
            alert('请输入关键字');
        } else {
            i_mdi_open('./list_person_search.htm?a=list&jobtype=' + big_classification +',' + small_classification +  '&trade=' + trade + '&workplace=' + addr1 +',' + addr2 + '&publishdate=' + job_day + '&key=' + key + '&key_class=' + key_class);
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
    m_info_industry_plug('d_trade');
    m_info_occupation_plug('d_big_classification', 'd_small_classification');
    m_info_job_plug('d_small_classification');
    m_info_province_plug('d_addr1', 'd_addr2');
    m_info_city_plug('d_addr2');
}

function m_check_issession(){
    $.ajax({
        url : i_act + 'a=info_init',
        success : function(txt){
            m.arr = i_json2js(txt);
            pid = m.arr['id'];
            var str = '';
            if('0' == pid || '' == pid){
                str = '<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0><TBODY><TR><TD height=4></TD> </TR> </TBODY></TABLE><TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TBODY><TR><TD align=right width=64 height=27><FONT color=#848484>用户名：</FONT></TD> <TD height=27><INPUT class=input_login id="d_username"  style="WIDTH: 115px"/><BR><SPAN id="d_error_username" ></SPAN></TD></TR><TR> <TD align=right width=64 height=27><FONT color=#848484>密&nbsp;&nbsp;码：</FONT></TD><TD height=27><INPUT class=input_login id="d_password" style="WIDTH: 115px" type="password"><BR><SPAN id="d_error_password"></SPAN></TD> </TR><TR align=middle><TD colSpan=2 height=30><INPUT id="btn_login" style="WIDTH: 50px; HEIGHT: 20px" type="image"  src="../img/button_login.gif"  border="0" onclick="m_info_login()"/>&nbsp;<INPUT id="btn_reg" style="WIDTH: 50px; HEIGHT: 20px" type="image"  src="../img/Button_Reg_2.gif"  border="0">&nbsp;</TD></TR><TR align=middle><TD colSpan=2 height=21><IMG height=9  src="../img/Icon1_2.gif" width=5><A class=blue20  href="./info_person_register.htm?a=add">注册个人用户</A><IMG height=9 src="../img/Icon1_2.gif" width=5><A class=blue20   href="#">找回密码</A></TD></TR></TBODY></TABLE>';
                i_obj_set('d_pan_login', str);
            } else {
                str = '<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0"><TR><TD align="center" height="28">欢迎您『 <span id="d_uname" style="color:Red;">' + m.arr['loginid'] + '</span> 』</TD></TR><TR><TD align="center" height="27"><IMG height="7" src="../img/Icon3.gif" width="7"><A href="./info_person_usercenter.htm?a=ucenter">管理中心</A>&nbsp;&nbsp;&nbsp;<IMG height="7" src="../img/Icon3.gif" width="7"><A id="a_resume_list" href="./list_resume.htm?a=list&p_id=' + pid + '">我的简历</A></TD></TR><TR><TD align="center" height="27"><IMG height="7" src="../img/Icon3.gif" width="7"><A id="a_list_job" href="./list_job.htm?a=list&p_id=' + pid + '">我的职位</A>&nbsp;&nbsp;&nbsp;<IMG height="7" src="../img/Icon3.gif" width="7"> <A id="a_person_basic" href="./info_person_basic.htm?a=edit&x=' + pid + '">个人信息</A></TD></TR><TR><TD align="center" height="27"><IMG height="7" src="../img/Icon3.gif" width="7"><A id="a_info_search" href="./info_adsearch.htm?a=adsearch">职位搜索</A>&nbsp;&nbsp;&nbsp;<IMG height="7" src="../img/Icon3.gif" width="7"><A id="a_info_logout" href="" onclick="m_info_loginout()">安全退出</A></TD></TR></TABLE>';
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
                case 'err_longin' :
                    i_mdi_open(location.href, '', 1);
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
                i_mdi_open(location.href, '个人服务' , 1);
            } else {
                alert('安全退出失败！');
            }
        }
    });
}

//切换标签
function asecBoard(n)
{
    for(i=1;i<3;i++)
    {
        eval("document.getElementById('al0"+i+"').className='a102'");
        eval("abx0"+i+".style.display='none'");
    }
    eval("document.getElementById('al0"+n+"').className='a101'");
    eval("abx0"+n+".style.display='block'");
}
