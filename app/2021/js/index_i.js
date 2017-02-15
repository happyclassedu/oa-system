/**
 * 文件名称：index_i.js
 * 功能描述：index_i页面控制器。
 * 代码作者：孙振强（创建）
 * 创建日期：2010-06-10
 * 修改日期：2010-06-18
 * 当前版本：V2.0
 */

$(document).ready(function(){
    i_tr_css($('#info_tb tbody tr'));
    m_btn_load();
});

function m_btn_load() {
    $('#info_tb input').click(function(){
        var tmp;
        var url;
        var title;
        tmp = this.id;

        if ('btn_list' == tmp.substr(0, 8)) {
            url = './' + tmp.substr(4) + '.htm?a=list';
            title = '列表管理';
        } else if ('btn_info' == tmp.substr(0, 8)) {
            url = './' + tmp.substr(4) + '.htm?a=add';
            title = '新增信息';
        } else if('btn_index' == tmp.substr(0, 9)){
            if('home' == tmp.substr(10)){
                url = '../../2020/htm/info_index.htm?a=home';
                title = '莲湖人才首页';
            } else if('com' == tmp.substr(10)){
                url = '../../2020/htm/info_com_login.htm?a=login';
                title = '企业登录';
            } else if('person' == tmp.substr(10)){
                url = '../../2020/htm/info_person_login.htm?a=login';
                title = '个人登录';
            } 
        }
        i_mdi_open(url, title);
    });
    
}