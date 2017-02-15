/**
 * 文件名称：alipayto.js
 * 功能描述：回复信息的信息控制器JS
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */

$(document).ready(function(){
    m_init();
    m_btn_load();
});

function m_init() {
    $.ajax({
            url : i_act + 'x=1',
            success : function(txt){
                var arr = i_json2js(txt);
                i_obj_set('d_out_trade_no', arr['out_trade_no']);
                i_obj_set('d_total_fee', arr['total_fee']);
                i_obj_set('d_htm', arr['htm']);
                i_obj_set('d_url', arr['url']);
            }
        });
}

function m_btn_load() {
    $('#btn_alipay').click(function(){
        alert(1);
       var url = i_obj_val('d_url');
       alert('3' + url);
       $('#info_tb tbody hidden[id!=""]').each(function() {
            m.tmp = i_obj_val(this.id);
            alert(2);
            url += this.id.substr(2) + '=' +  i_obj_val(this.id);
        });
        alert('3' + url);
    });
}

