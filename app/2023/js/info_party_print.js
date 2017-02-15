/**
 * 文件名称：info_party_print.js
 * 功能描述：打印预备党员名单功能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-29
 * 修改时间：2010-07-29
 * 当前版本：v1.0
 */
//
//$(document).ready(function(){
//
//});

function m_load() {
    i_read_css('m_list', 0);
    m.xtr = $('#list_tb tbody tr:eq(0)').clone(true);
    i_tr_css($('#list_tb tbody tr'));
    m_load_disable();
    m_init_info_read();
    m_init();
    m.arr_qc = '';
    m_info_qc_plug();
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#btn_save').click(function(){
       window.parent.location.reload();
    });

    $(document).keypress(function(){
        if(event.keyCode == 13 ){
            $('#btn_save').click();
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

function m_info_save_plug() {
    m.tmp = i_obj_val('d_name');
    if ('' == m.tmp) {
        alert('业务名称不能为空！');
        return false;
    }

    m_init_info_ytext_set();
    return true;
}

function m_init_info_read() {
    i_obj_set('d_name', '打印参加转正大会名单');
    $.ajax({
        url : g.act + 'info_party.php?a=info_read&x=' + m.xid,
        success : function(txt){
            m.info = i_json2js(txt);
            i_obj_set('d_bid', m.info['id']);
            i_obj_set('d_bname', m.info['name']);     
        }
    });
}

function m_init(){
    $.ajax({
        url : g.act + 'info_party.php?a=info_init',
        success : function(txt){
            m.info = i_json2js(txt);
            i_obj_set('d_uid', m.info['uid']);
            i_obj_set('d_uname', m.info['uname']);
            i_obj_set('d_i_type', m.info['i_type']);
        }
    });
}

function m_init_info_ytext_set(){
    var ytext = '';
    ytext +=  '期次：' + i_obj_val('d_i_txt0') +  '；备注：' + i_obj_val('d_remark') + '；<br>';
    i_obj_set('d_operating_record', ytext);
}

function m_load_disable(){
    i_obj_disable('d_name');
    i_obj_disable('d_uname');
    i_obj_disable('d_atime');
}

function m_info_qc_plug(){
    $.ajax({
        url : g.act + 'info_party.php?a=list_read4qc',
        success : function(txt){
            m.arr_qc = i_json2js(txt);  //将php文件进行解密，并返回到js
            $('#d_i_txt0').html('');  //清空tbody里面的内容
            var option_txt = '';
            option_txt += '<option value="" selected="selected">期次类型</option>';
            for(var i=0 ; i<m.arr_qc.length; i++) {
                option_txt += '<option value="'+ m.arr_qc[i]['party_qc'] +'">'+ m.arr_qc[i]['party_qc'] + '</option>';
            }
            $('#d_i_txt0').append(option_txt);
        }
    });
   
    $('#d_i_txt0').change( function() {
          m.tmp  = $('#d_i_txt0').val();
          m_list_read(m.tmp);
//         var checkText=$('#d_big_classification').find("option:selected").text();
    });
}

function m_list_read(party_qc) {
//    alert('m.xid' + m.xid);
    $.ajax({
        url : g.act + 'info_party.php?a=list_read4print&'+ '&party_qc=' + party_qc,
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_read_list_val();
            i_tr_css($('#list_tb tbody tr'));
        }
    });
}

function m_read_list_val() {
    m.tmp = '';
    for(var i=0 ; i<m.arr.length; i++) {
        m.xtr.attr('id', i);
        m.xtr.children(':eq(0)').html(i + 1);
        m.xtr.children(':eq(1)').html(m.arr[i]['atime']);
        m.xtr.children(':eq(2)').html(m.arr[i]['name']);
        m.xtr.children(':eq(3)').html(m.arr[i]['sex']);
        m.xtr.children(':eq(4)').html(m.arr[i]['party_code']);
        m.xtr.children(':eq(5)').html(m.arr[i]['univ']);
        m.xtr.children(':eq(6)').html(m.arr[i]['party_type']);
        m.xtr.children(':eq(7)').html(m.arr[i]['join_party_time']);
        m.xtr.children(':eq(8)').html(m.arr[i]['tel_0']);
        m.xtr.children(':eq(9)').html(m.arr[i]['remark']);
        m.tmp += m.xtr.parents().html();
    }
    $('#list_tb tbody').html(m.tmp);
}