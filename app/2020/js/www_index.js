/**
 * 文件名称：index.js
 * 功能描述：index_i页面控制器。
 * 代码作者：孙振强（创建）
 * 创建日期：2010-06-10
 * 修改日期：2010-06-18
 * 当前版本：V2.0
 */

$(document).ready(function(){
//    m_btn_load_plug();
    m_index_act();
});

function m_index_act() {
    new i_tab_show('index_news1_title', 'rcw_zxdt', 0, 'a', 'ul');
    new i_tab_show('index_news2_title', 'rcw_jlzd', 0, 'a', 'ul');
}

//radio返回值
function m_GetRadioValue(RadioName){
    var obj;
    obj=document.getElementsByName(RadioName);
    if(obj!=null){
        var i;
        for(i=0;i<obj.length;i++){
            if(obj[i].checked){
                return obj[i].value;
            }
        }
    }
    return null;
}

/*function m_btn_load_plug() {
    $('#btn_login').click(function(){
        var temp = m_GetRadioValue('btn_r_login');
        if('com' == temp){
            window.location.href = './info_clogin.htm?a=login';
        //            m_com_login();
        } else if('person' == temp) {
            window.location.href = './info_plogin.htm?a=login';
        //            m_person_login();
        }
    });

    $('#a_info_register').click(function(){
        var rbn_type = i_obj_val('rbn_type');
        if('com' == rbn_type){
            i_mdi_open('./info_cregister.htm?a=add');
        } else if('person' == rbn_type) {
            i_mdi_open('./info_pregister.htm?a=add');
        } else {
            alert('操作错误，正在关闭！');
            i_mdi_close();
        }
    });
}*/


