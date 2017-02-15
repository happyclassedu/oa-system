/**
 * 文件名称：list_job.js
 * 功能描述：职位管理的列表控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.c_id = i_get('c_id');
    m_info_com();
    m.ytr = $('#list_j tbody tr:eq(0)').clone(true);
    i_tr_css($('#list_j tbody tr'));
    m_list_num_extend();
    m.ytr.children(':eq(2)').addClass('cursor_p');
    m.ytr.children(':eq(2)').dblclick(function(){
        i = this.parentNode.id;
        m.xid = m.arr[i]['id'];
        i_mdi_open('./info_' + g.id_name + '.htm?a=view&x=' + m.xid + '&c_id=' + m.c_id, '查看信息');
    });

    return false;  //可以终止初始化
}

function m_btn_load_plug() {
//    $('#btn_save').click(function(){
//        m_info_save();
//    });

     $('#btn_add_j').click(function(){
        i_mdi_open('./info_' + g.id_name + '.htm?a=add&c_id=' + m.c_id, '增加职位');
    });
}

//m_list_num的扩展
function m_list_num_extend(){
    $.ajax({
        url : i_act + 'a=list_num&c_id=' + m.c_id,
        data : 'val_search=' + m.val_search,
        success : function(txt){
            m.info_num = txt;
            m_jpage_load_extend();
        }
    });
}

function m_jpage_load_extend() {
    $('#jpage_box').jpage({
        info_all : m.info_num,
        show_num : m.show_num,
        page_skin : 'blue',
        page_act : function(show_num, page_now){
            m.show_num = show_num;
            m.page_now = page_now;
            m_list_read_extend();
        }
    });
}

function m_list_read_extend() {
    $.ajax({
        url : i_act + 'a=list_read&show_num=' + m.show_num + '&page_now=' + m.page_now +'&c_id=' + m.c_id,
        data : 'val_search=' + m.val_search,
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_list_read_set_extend();
            i_tr_css($('#list_j tbody tr'));
            m_list_read_btn_extend();
            m_search_act_extend();
        }
    });
}

function m_list_read_set_extend() {
    $('#list_j tbody').html('');
    for(i=0; i<m.arr.length; i++) {
        m.ytr.attr('id', i);
        m.ytr.children(':eq(0)').html(m.show_num * m.page_now - m.show_num + i + 1);
        m.ytr.children(':eq(1)').html(m.arr[i]['name']);
        m.ytr.children(':eq(2)').html(m.arr[i]['zwstate']);
        m.ytr.children(':eq(3)').html((m.arr[i]['atime']).substring(0, 10));
        m.ytr.children(':eq(4)').html((m.arr[i]['begin']).substring(0, 10) + '至' + (m.arr[i]['end']).substring(0, 10));
        m.ytr.children(':eq(5)').html(m.arr[i]['hits']);
        
        $('#list_j tbody').append(m.ytr.clone(true));
    }
}

function m_list_read_btn_extend() {

    $('.btn_view_j').click(function(){
        m.xid = this.parentNode.parentNode.id;
        i_mdi_open('./info_job.htm?a=view&x=' + m.arr[m.xid]['id'] + '&c_id=' + m.c_id);
    });

     $('.btn_edit_j').click(function(){
        m.xid = this.parentNode.parentNode.id;
        i_mdi_open('./info_job.htm?a=edit&x=' + m.arr[m.xid]['id'] + '&c_id=' + m.c_id);
    });

     $('.btn_del_j').click(function(){
        i = this.parentNode.parentNode.id;
        m.xid = m.arr[i]['id'];
        m.tmp = m.arr[i]['name'];
        m_info_del_extend();
    });

}

function m_info_del_extend() {
    if (true == confirm('确定要删除“' + m.tmp + '”吗？')) {
        $.ajax({
            url : i_act + 'a=info_del&x=' + m.xid ,
            success : function(txt){
                if (txt > 0) {
                    m_list_num_extend();
                } else {
                    alert('删除' + m.tmp + '失败！');
                }
            }
        });
    }
}

function m_search_plug(){
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
        return false;
    }

    m_list_num_extend();

    return false;
}

function m_search_act_extend() {
    if ('' == m.val_search) {
        return false;
    }

    var arr;
    arr = i_json2js(m.val_search);

    if ('' != arr && 'object'!= typeof(arr)) {
        $('#list_j tbody td[class!="btn_box"]').each(function() {
            this.innerHTML  = this.innerHTML.replace(new RegExp(arr, "gm"), '<B class="val_search">' + arr + '</B>');
        });
    }
}

function m_info_com(){
    $.ajax({
        url : i_act + 'a=info_com&c_id=' + m.c_id,
        success : function(txt){
//            alert(txt);
           m.info = i_json2js(txt);
           i_obj_set('d_cname', m.info['fname']);
        }
    });
}