/**
 * 文件名称：index.js
 * 功能描述：index_i页面控制器。
 * 代码作者：孙振强（创建）
 * 创建日期：2010-06-10
 * 修改日期：2010-06-18
 * 当前版本：V2.0
 */

var t = {};

$(document).ready(function(){
    m_btn_load_plug();
    m_index_act();
    m_login_check();
});

function m_index_act() {
    new i_pics_player("#index_pics",{
        width:"220px",
        height:"165px",
        fontsize:"12px",
        time:"5000"
    });

    new i_tab_show('index_news1_title', 'index_news1', 0, 'a', 'ul');
    new i_tab_show('index_news2_title', 'index_news2_cnt', 0, 'a', 'ul');
}

function m_btn_load_plug() {
    $('#btn_login').click(function(){
        t.arr_login = {};
        t.arr_login['loginid'] = i_obj_val('txt_username');
        t.arr_login['loginpw'] = i_obj_val('txt_password');
        t.arr_login['loginpc'] = i_obj_val('btn_r_login');
        if('p' == t.arr_login['loginpc']){
            m_login_p();
        } else if('c' == t.arr_login['loginpc']) {
            m_login_c();
        }
    });

    $('#btn_ucenter_p').click(function(){
        i_mdi_open('./info_person.htm?a=ucenter', '个人会员中心', 1);
    });

    $('#btn_resume_view').click(function(){
        i_mdi_open('./info_resume_' + $.cookie('xid') + '.htm', '查看我的简历', 0);
    });

    $('#btn_resume_edit').click(function(){
        i_mdi_open('./info_p_resume.htm?a=edit&x=' + $.cookie('xid'), '修改我的简历', 0);
    });

    $('.btn_logout').click(function(){
        m_logout();
    });

    $('#btn_reg_p').click(function(){
        i_mdi_open('./info_pregister.htm?a=add');
    });

    $('#btn_reg_c').click(function(){
        i_mdi_open('./info_cregister.htm?a=add');
    });
    
    $('#btn_search').click(function() {
        self.location.href = 'list_job_1_1.htm';
    });

    $('#txt_s_job_class').click(function(){
        i_box_open({
            content: '../htm/x_job_class.htm',
            player: 'iframe',
            title: '',
            width: '620px',
            height: '380px'
        });
    });

    $('#txt_s_job_title').click(function(){
        if (!t['job_class']) {
            alert('请先选择职位类别！');
            $('#txt_s_job_class').click();
            return false;
        }
        i_box_open({
            content: '../htm/x_job_title.htm?x=' + t['job_class'][0],
            player: 'iframe',
            title: '',
            width: '410px',
            height: '280px'
        });
    });

    $('#txt_s_com_class').click(function(){
        i_box_open({
            content: '../htm/x_com_class.htm',
            player: 'iframe',
            title: '',
            width: '620px',
            height: '380px'
        });
    });

    $('#txt_s_job_addr').click(function(){
        i_box_open({
            content: '../htm/x_job_addr.htm',
            player: 'iframe',
            title: '',
            width: '620px',
            height: '380px'
        });
    });
}

function m_login_check(){
    if ('login' != $.cookie('loginstate')) {
        return;
    }

    i_obj_hide('box_login');
    if ('p' == $.cookie('loginpc')) {
        i_obj_show('box_login_p');
        i_obj_set('user_title', $.cookie('name') + ' '+ $.cookie('sex') + '，');

    }

    if ('c' == $.cookie('loginpc')) {
        i_obj_show('box_login_c');
    }
}

function m_logout(){
    i_obj_hide('box_login_p');
    i_obj_hide('box_login_c');
    i_obj_show('box_login');
    $.cookie('loginstate', 'logout');
}

function m_login_p(){
    $.ajax({
        url : g.act + 'info_plogin.php?a=info_login',
        data : 'arr=' +  i_js2json(t.arr_login),
        success : function(txt){
            t.arr = i_json2js(txt);
            m_login_act();
        }
    });
}

//                    i_mdi_open('./info_com.htm?a=ucenter', '企业会员中心', 1);
function m_login_c(){
    $.ajax({
        url : g.act + 'info_clogin.php?a=info_login',
        data : 'arr=' +  i_js2json(t.arr_login),
        success : function(txt){
            t.arr = i_json2js(txt);
            m_login_act();
        }
    });
}



function m_login_act(){
    switch (t.arr.err) {
        case 'err_u_null' :
            alert('用户名不能为空，请填写！');
            break;
        case 'err_pwd_null' :
            alert('密码不能为空，请填写！');
            break;
        case 'err_pwd_no' :
            alert('密码不正确，请重新填写！');
            break;
        case 'err_u_nexist' :
            alert('用户不存在，请注册！');
            break;
        case 'err_longin' :
            $.cookie('loginid', t.arr.info.loginid);
            $.cookie('xid', t.arr.info.id);
            $.cookie('name', t.arr.info.name);
            if ('p' == t.arr_login['loginpc']) {
                if ('男' == t.arr.info.sex) {
                    t.arr.info.sex = '先生';
                } else if ('女' == t.arr.info.sex) {
                    t.arr.info.sex = '女士';
                } else {
                    t.arr.info.sex = '';
                }
                $.cookie('sex', t.arr.info.sex);
                $.cookie('loginpc', 'p');
            } else if ('c' == t.arr_login['loginpc']) {
                $.cookie('loginpc', 'c');
            }
            $.cookie('loginstate', 'login');
            alert('登陆成功');
            i_obj_set('txt_password', '');
            m_login_check();
            break;
        default :
            break;
    }
}

function m_box_close_plug(arr) {
    if (!arr || '' == arr) {
        return;
    }
    if ('job_class' == arr.type) {
        t['job_class'] = arr.info;
        i_obj_set('txt_s_job_class', arr.info['1']);
        if (arr.title) {
            t['job_title'] = arr.title;
            i_obj_set('txt_s_job_title', t['job_title']['2']);
        } else {
            i_obj_set('txt_s_job_title', '请选择职位名称');
            t['job_title'] = '';
        }
    } else if ('job_title' == arr.type) {
        t['job_title'] = arr.info;
        i_obj_set('txt_s_job_title', arr.info['2']);
    } else if ('com_class' == arr.type) {
        t['com_class'] = arr.info;
        i_obj_set('txt_s_com_class', arr.info['1']);
    } else if ('job_addr' == arr.type) {
        t['job_addr'] = arr.info;
        i_obj_set('txt_s_job_addr', arr.info['1'] + ' : ' + arr.city['2']);
    }
}