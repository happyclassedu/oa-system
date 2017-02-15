/**
 * 文件名称：org_list.js
 * 功能描述：机构管理模块信息列表的前台程序。
 * 代码作者：钱包伟（创建） , 王争强（优化）
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
            url = './' + tmp.substr(4) + '.htm';
            title = '列表管理';
        } else if ('btn_info' == tmp.substr(0, 8)) {
            url = './' + tmp.substr(4) + '.htm?a=add';
            title = '新增信息';
        }
        i_mdi_open(url, title);
    });
}