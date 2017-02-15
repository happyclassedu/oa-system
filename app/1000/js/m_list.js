/**
 * 文件名称：org_list.js
 * 功能描述：机构管理模块信息列表的前台程序。
 * 代码作者：钱包伟（创建） , 王争强（优化）
 * 创建日期：2010-06-10
 * 修改日期：2010-06-18
 * 当前版本：V2.0
 */

var m = {
    xid : '',
    tmp : '',
    arr : '',
    xtr : '',
    val_search : '',
    info_num : 0,
    show_num : 10,
    page_now : 1,
    list_skin : ''
};

$(document).ready(function(){
//    i_ajax_box_show();
    m_list_read_btn();
    m.xtr = $('#list_tb tbody tr:eq(0)').clone(true);
    i_tr_css($('#list_tb tbody tr'));
    //    m_jpage_load();
    m_btn_load();
    m_list_load();
});

function m_list_load() {
    if (this.m_load) {
        m.tmp = m_load();
        if (false == m.tmp) {
            return false;
        }
    }
    m_list_num();
}

function m_btn_load() {
    $('#btn_add').click(function(){
        i_mdi_open('./info_' + g.id_name + '.htm?a=add', '新增信息--机构管理');
    });

    $('#btn_refresh').click(function(){
        window.location.reload();
    });

    $('#btn_search').click(function(){
        m_search();
    });

    $('#val_search').keypress(function() {
        if(event.keyCode==13){
            $('#btn_search').click();
        }
    });

    $('#btn_close').click(function(){
        i_mdi_close();
    });

    if (this.m_btn_load_plug) {
        m_btn_load_plug();
    }
}

function m_list_num() {
    $.ajax({
        url : i_act + 'a=list_num&'+ m.list_act_get,
        data : 'val_search=' + m.val_search,
        success : function(txt){
            m.info_num = txt;
            m_jpage_load();
            m_list_num_act();
        }
    });
}

function m_list_num_act() {
    if (this.m_list_num_act_plug) {
        m_list_num_act_plug();
    }
}

function m_jpage_load() {
    $('#jpage_box').jpage({
        info_all : m.info_num,
        show_num : m.show_num,
        page_skin : m.list_skin,
        page_act : function(show_num, page_now){
            m.show_num = show_num;
            m.page_now = page_now;
            m_list_read();
        }
    });
}

function m_list_read() {
    i_ajax_box_show();
    $.ajax({
        url : i_act + 'a=list_read&show_num=' + m.show_num + '&page_now=' + m.page_now + '&' + m.list_act_get,
        data : 'val_search=' + m.val_search,
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_list_read_set();
            i_tr_css($('#list_tb tbody tr'));
            m_search_act();
        }
    });
}

function m_list_read_set() {
    $('#list_tb tbody').html('');
    for(i=0; i<m.arr.length; i++) {
        m.xtr.attr('id', i);
        m.xtr.children(':eq(0)').html(m.show_num * m.page_now - m.show_num + i + 1);
        if (this.m_list_read_set_plug) {
            m.list_set_tmp = m_list_read_set_plug();
            if (false == m.list_set_tmp) {
                continue;
            }
        }
        $('#list_tb tbody').append(m.xtr.clone(true));
    }

    i_ajax_box_hide();
}

function m_list_read_btn() {
    $('.btn_view').click(function(){
        i = this.parentNode.parentNode.id;
        m.xid = m.arr[i]['id'];
        i_mdi_open('./info_' + g.id_name + '.htm?a=view&x=' + m.xid, '查看信息--机构管理');
    });
    $('.btn_edit').click(function(){
        i = this.parentNode.parentNode.id;
        m.xid = m.arr[i]['id'];
        i_mdi_open('./info_' + g.id_name + '.htm?a=edit&x=' + m.xid, '修改信息--机构管理');
    });
    $('.btn_del').click(function(){
        i = this.parentNode.parentNode.id;
        m.xid = m.arr[i]['id'];
        m.tmp = m.arr[i]['name'];
        m_info_del();
    });
    if (this.m_list_read_btn_plug) {
        m_list_read_btn_plug();
    }
}

function m_info_del() {
    if (true == confirm('确定要删除“' + m.tmp + '”吗？')) {
        $.ajax({
            url : i_act + 'a=info_del&x=' + m.xid ,
            success : function(txt){
                if (txt > 0) {
                    m_list_num();
                } else {
                    alert('删除' + m.tmp + '失败！');
                }
            }
        });
    }
}

//function m_search_act() {
//    m.tmp = i_obj_val('val_search');
//    if ('' == m.tmp) {
//        return;
//    }
//    $('#list_tb tbody td[class!="btn_box"]').each(function() {
//        this.innerHTML  = this.innerHTML.replace(new RegExp(m.tmp, "gm"), '<B class="val_search">' + m.tmp + '</B>');
//    });
//}

function m_search_act() {
    if ('' == m.val_search) {
        return false;
    }

    var arr;
    arr = i_json2js(m.val_search);

    if (this.m_search_act_plug) {
        m.tmp = m_search_act_plug(arr);
        if (false == m.tmp) {
            return false;
        }
    }

    if ('' != arr && 'object'!= typeof(arr)) {
        $('#list_tb tbody td[class!="btn_box"]').each(function() {
            this.innerHTML  = this.innerHTML.replace(new RegExp(arr, "gm"), '<B class="val_search">' + arr + '</B>');
        });
    }
}

function m_search() {
    m.val_search = new Object();

    $('.search').each(function() {
        m.tmp =  i_obj_val(this.id);
        if ('' != m.tmp) {
            m.val_search[this.id.substr(2)] = m.tmp;
        }
    });

    if (this.m_search_plug) {
        m.tmp = m_search_plug();
        if (false == m.tmp) {
            return false;
        }
    }

    m.tmp = '';
    for (i in m.val_search) {
        m.tmp = i;
        break;
    }    
    if ('' == m.tmp) {
        m.val_search = i_obj_val('val_search');
    }
    
    m.val_search = i_js2json(m.val_search);
    if ('' == m.val_search) {
        //        $('#btn_refresh').click();
        return false;
    }
    
    m_list_num();
}