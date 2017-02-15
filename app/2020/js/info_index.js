/**
* 文件名称：info_index.js
* 功能描述：英才网首页的前台程序。
* 代码作者：王争强
* 创建日期：2010-08-09
* 修改时间：2010-08-09
* 当前版本：v1.0
*/

//$(document).ready(function(){
//
//    });

function m_load() {
    m_load_arr_plug(); //加载数组
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#btn_login').click(function(){

        var username = i_obj_val('d_username');
        var password = i_obj_val('d_password');

        m.arr = new Object();
        m.arr['loginid'] = username;
        m.arr['loginpw'] = password;

        var rbn_type = i_obj_val('rbn_type');
        if('com' == rbn_type){
            m_com_login();
        } else if('person' == rbn_type) {
            m_person_login();
        } else {
            alert('操作错误，正在关闭！');
            i_mdi_close();
        }

    });

        $('#a_info_register').click(function(){

        var rbn_type = i_obj_val('rbn_type');
        if('com' == rbn_type){
            i_mdi_open('./info_com_register.htm?a=add');
        } else if('person' == rbn_type) {
            i_mdi_open('./info_person_register.htm?a=add');
        } else {
            alert('操作错误，正在关闭！');
            i_mdi_close();
        }

    });

    $('#btn_search').click(function(){
        var key = i_obj_val('d_key');
        if('' == key){
            key = 'null';
        }

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
        
        var job_day = i_obj_val('d_job_day');
        if('' == job_day){
            job_day = '0';
        }
        if('请输入关键字' == key){
            alert('请输入关键字');
        } else {
            i_mdi_open('./list_person_search.htm?a=list&jobtype=' + big_classification +',' + small_classification + '&workplace=' + addr1 +',0&publishdate=' + job_day + '&key=' + key);
        }
    });



    
}

//function m_info_set_plug() {
//
//}

//function m_info_add_plug() {
//
//}


//function m_info_edit_plug() {
//
//}

//function m_info_view_plug() {
//
//}

//function m_info_input_plug(state) {
//
//}

//function m_info_save_plug() {
//    return true;
//}

function m_person_login(){
    m.arr = new Object();
    m.arr['loginid'] = i_obj_val('d_username');
    m.arr['loginpw'] = i_obj_val('d_password');
    $.ajax({
        url : g.act + 'info_person_login.php?a=info_login',
        data : 'arr=' +  i_js2json(m.arr),
        success : function(txt){
             switch (txt) {
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
                case 'err_session_inval' :
                    alert('session失效，请检查！');
                    break;
                case 'err_longin' :
                    i_mdi_open('./info_person_usercenter.htm?a=ucenter', '个人中心', 1);
                    break;
                default :
                    alert('操作错误，正在关闭！');
                    i_mdi_close();
                    break;
            }
        }
    });
}

function m_com_login(){

    m.arr = new Object();
    m.arr['loginid'] = i_obj_val('d_username');
    m.arr['loginpw'] = i_obj_val('d_password');
    //        m_islogin();
    $.ajax({
        url : g.act + 'info_com_login.php?a=info_login',
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
                    $.cookie('c_id', txt);
                    i_mdi_open('./info_com_usercenter.htm?a=ucenter', '', 1);
                    break;
                default :
                    alert('操作错误，正在关闭！');
                    i_mdi_close();
                    break;
            }
        }
    });
}


function m_load_arr_plug(){
    m.tmp = '';
    m_info_occupation_plug('d_big_classification', 'd_small_classification');
    m_info_job_plug('d_small_classification');
    m_info_province_plug('d_addr1');
}


function asecBoard(n)
{
    for(i=1;i<n;i++)
    {
        eval("document.getElementById('al0"+i+"').className='a102'");
        eval("abx0"+i+".style.display='none'");
    }
    eval("document.getElementById('al0"+n+"').className='a101'");
    eval("abx0"+n+".style.display='block'");
}


