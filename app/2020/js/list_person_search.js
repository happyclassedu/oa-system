/**
* 文件名称：list_person_search.js
* 功能描述：搜索列表的前台程序。
* 代码作者：王争强
* 创建日期：2010-07-29
* 修改日期：2010-07-29
* 当前版本：V1.0
*/
var pid = '';
var jid = '';
var cid = '';

//url参数
 var job_day = '';
var type2 = '';
var degree= '';
var history = '';
var sex = '';
var age_1 = '';
var age_2 = '';
var pay_type = '';
var pay = '';
var big_classification = '';
var small_classification = '';
var addr1 = '';
var addr2 = '';
var trade = '';
var workplace = '';
var publishdate = '';
var key = '';
var key_class = '';

var array = ''; //转化url参数成为数组

//$(document).ready(function(){
//    alert('最先执行');
//});

function m_load() {
    m_check_issession();
    m_load_arr_plug(); //加载数组

    jobtype = i_get('jobtype');
    type2 = i_get('type2');
    if('null' == type2){
        type2 = '';
    }

    degree = i_get('degree');
    if('null' == degree){
        degree = '';
    }

    history = i_get('history');
    if('null' == history){
        history = '';
    }

    sex = i_get('sex');
    if('null' == sex){
        sex = '';
    }

    age_1 = i_get('age_1');
    if('0' == age_1){
        age_1 = '';
    }
    age_2 = i_get('age_2');
    if('0' == age_2){
        age_2 = '';
    }

    pay_type = i_get('pay_type');
    if('null' == pay_type){
        pay_type = '';
    }

    pay = i_get('pay');
    if('0' == pay){
        pay = '';
    }

    trade = i_get('trade');
    if('0' != trade){
        i_obj_set('d_trade', trade);
    } else {
        i_obj_set('d_trade', '');
        trade =  '';
    }


    workplace = i_get('workplace');
    publishdate = i_get('publishdate');
    if('0' != publishdate){
        i_obj_set('d_job_day', publishdate);
    } else {
        i_obj_set('d_job_day', '0');
        publishdate = '0';
    }



    key = i_get('key');
    if('null' != key){
        i_obj_set('d_key', key);
    } else {
        i_obj_set('d_key', '');
        key = '';
    }

    key_class = i_get('key_class');
    i_obj_set('d_key_class', key_class);


    var arr_jobtype = jobtype.split(',');
    big_classification = arr_jobtype[0];
    small_classification = arr_jobtype[1];



    if('0' != big_classification){
        i_obj_set('d_big_classification', big_classification);
    } else {
        i_obj_set('d_big_classification', '');
        big_classification = '';
    }

    if('0' != small_classification){
        i_obj_set('d_small_classification', small_classification);
    } else {
        i_obj_set('d_small_classification', '');
        small_classification = '';
    }

    var arr_workplace = workplace.split(',');
    addr1 = arr_workplace[0];
    addr2 = arr_workplace[1];

    if('0' != addr1){
        i_obj_set('d_addr1', addr1);
    } else {
        i_obj_set('d_addr1', '');
        addr1 = '';
    }

    if('0' != addr2){
        i_obj_set('d_addr2', addr2);
    } else {
        i_obj_set('d_addr2', '');
        addr2 = '';
    }

    array = new Object();
    array['type2'] = type2;
    array['degree'] = degree;
    array['history'] = history;
    array['age_1'] = age_1;
    array['age_2'] = age_2;
    array['pay_type'] = pay_type;
    array['pay'] = pay;
    array['trade'] = trade;
    array['big_classification'] = big_classification;
    array['small_classification'] = small_classification;
    array['addr1'] = addr1;
    array['addr2'] = addr2;
    array['job_day'] = publishdate;
    array['key'] = key;
    array['key_class'] = key_class;

    m.val_search = i_js2json(array);




//    return false;  //可以终止初始化
}

function m_btn_load_plug() {

    $('#d_checkbox_all').click(function(){
        if ($(this).attr("checked") == true) { // 全选
            $("#list_tb :checkbox").each(function() {
                $(this).attr("checked", true);
            });
        } else { // 取消全选
            $("#list_tb :checkbox").each(function() {
                $(this).attr("checked", false);
            });
        }
    });

    $('#btn_app_job').click(function(){
        var array = new Array();
        $(".d_checkbox:checked").each(function(i) {
            array[i] = $(this).val();
        });

        if('' != array){
            if(confirm('确定要“申请职位”吗？')){
                //        $('#error_test').html(); //报错测试
                i_mdi_open('./info_job_eavoritd.htm?a=add&p_id=' + pid + '&arr=' + i_js2json(array));
            }
        } else {
            alert('请选择职位！');
        }
    });

    $('#btn_favorite_job').click(function(){

        var array = new Array();
        $(".d_checkbox:checked").each(function(i) {
            array[i] = $(this).val();
        });
        if('' != array){
            if(confirm('确定要“收藏职位”吗？')){
                //        $('#error_test').html(); //报错测试
                $.ajax({
                    url : i_act + 'a=info_favorite',
                    data : 'arr='+ i_js2json(array),
                    success : function(txt){
                        if('1' == txt){
                            alert('收藏成功');
                        } else if('0' == txt){
                            alert('对不起，职位已经收藏');
                        }
                    }
                });
            }
        } else {
            alert('请选择职位！');
        }
    });

    $('#btn_veiw_job').click(function(){
        var array = new Array();
        $(".d_checkbox:checked").each(function(i) {
            array[i] = $(this).val();
        });

        if('' != array){
            $.ajax({
                url : i_act + 'a=info_read&x=' + array[0],
                success : function(txt){
                    m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
                    jid = m.arr['id'];
                    cid = m.arr['cid'];
                    i_mdi_open('./info_job_look.htm?a=view&x=' + jid + '&cid=' + cid);
                }
            });
        } else {
            alert('请选择职位！');
        }
    });

    $('#a_list_search').click(function(){
        key = i_obj_val('d_key');
        if('' == key){
            key = 'null';
        }

        key_class = i_obj_val('d_key_class');

        big_classification = i_obj_val('d_big_classification');
        if('' == big_classification){
            big_classification = '0';
        }

        small_classification = i_obj_val('d_small_classification');
        if('' == small_classification){
            small_classification = '0';
        }

        addr1 = i_obj_val('d_addr1');
        if('' == addr1){
            addr1 = '0';
        }

        addr2 = i_obj_val('d_addr2');
        if('' == addr2){
            addr2 = '0';
        }

        trade = i_obj_val('d_trade');
        if('' == trade){
            trade = '0';
        }

        job_day = i_obj_val('d_job_day');
        if('' == job_day){
            job_day = '0';
        }

        if('请输入关键字' == key){
            alert('请输入关键字');
        } else {
            i_mdi_open('./list_person_search.htm?a=search&jobtype=' + big_classification +',' + small_classification +  '&trade=' + trade + '&workplace=' + addr1 +',' + addr2 + '&publishdate=' + job_day + '&key=' + key + '&key_class=' + key_class, '简历搜索', 1);
        }
    });
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(0)').html('<input class="d_checkbox" name="d_checkbox" type="checkbox" value="' + m.arr[i]['id'] + '"/>');
    m.xtr.children(':eq(1)').html('<a href="./info_job_look.htm?a=view&x=' + m.arr[i]['id'] + '&cid=' + m.arr[i]['cid'] + '">' + m.arr[i]['name'] + '</a>');
    m.xtr.children(':eq(2)').html('<a href="./info_com_look.htm?a=view&x=' + m.arr[i]['cid'] + '&j_id=' + m.arr[i]['id'] + '">' + m.arr[i]['fname'] + '</a>');
    m.xtr.children(':eq(3)').html(m_arr2show(0, 1, m.arr[i]['addr1'], array_province) + ' ' +  m_arr2show(0, 2, m.arr[i]['addr2'], array_city));
    m.xtr.children(':eq(4)').html(m.arr[i]['pay'] + m.arr[i]['pay_type']);
    m.xtr.children(':eq(5)').html((m.arr[i]['job_day']).substring(0, 10));
}

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
                str = '<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0"><TR><TD align="center" height="28">欢迎您『 <span id="d_uname" style="color:Red;">' + m.arr['loginid'] + '</span> 』</TD></TR><TR><TD align="center" height="27"><IMG height="7" src="../img/Icon3.gif" width="7"><A href="./info_person_usercenter.htm?a=ucenter">管理中心</A>&nbsp;&nbsp;&nbsp;<IMG height="7" src="../img/Icon3.gif" width="7"><A id="a_resume_list" href="./list_resume.htm?a=list&p_id=' + pid + '">我的简历</A></TD></TR><TR><TD align="center" height="27"><IMG height="7" src="../img/Icon3.gif" width="7"><A id="a_list_job" href="./list_job.htm?a=list&p_id=' + pid + '">我的职位</A>&nbsp;&nbsp;&nbsp;<IMG height="7" src="../img/Icon3.gif" width="7"> <A id="a_person_basic" href="./info_person_basic.htm?a=edit&x=' + pid + '">个人信息</A></TD></TR><TR><TD align="center" height="27"><IMG height="7" src="../img/Icon3.gif" width="7"><A id="a_info_search" href="./info_person_adsearch.htm?a=adsearch">职位搜索</A>&nbsp;&nbsp;&nbsp;<IMG height="7" src="../img/Icon3.gif" width="7"><A id="a_info_logout" href="" onclick="m_info_loginout()">安全退出</A></TD></TR></TABLE>';
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
                    i_mdi_open(location.href, '简历搜索', 1);
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
