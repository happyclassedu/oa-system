/**
 * 文件名称：list_com_other.js
 * 功能描述：企业账号信息的列表控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

//function m_load() {
////    return false;  //可以终止初始化
//}

function m_btn_load_plug() {
//    $('#btn_save').click(function(){
//        m_info_save();
//    });
}

function m_list_read_btn_plug() {
    
    $('.btn_edit_com').click(function(){
        m.xid = this.parentNode.parentNode.id;
        i_mdi_open('./info_com.htm?a=view&x=' + m.arr[m.xid]['id']);
    });

    $('.btn_edit_com_pwd').click(function(){
        m.xid = this.parentNode.parentNode.id;
        i_mdi_open('./info_com_pwd.htm?a=view&x=' + m.arr[m.xid]['id']);
    });

    $('.btn_edit_com_setting').click(function(){
        m.xid = this.parentNode.parentNode.id;
        i_mdi_open('./info_com_account.htm?a=view&x=' + m.arr[m.xid]['id']);
    });

   $('.btn_del_com').click(function(){
        i = this.parentNode.parentNode.id;
        m.xid = m.arr[i]['id'];
        m.tmp = m.arr[i]['fname'];
        m_info_del_plug();
    });

}

function m_info_del_plug() {
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

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['fname']);
    m.xtr.children(':eq(1)').attr('title', m.arr[i]['fname']);
    m.xtr.children(':eq(2)').html(m.arr[i]['i_tmp0']);
    m.xtr.children(':eq(3)').html(m.arr[i]['user_state']);
    m.xtr.children(':eq(4)').html(m.arr[i]['atime']);
    m.xtr.children(':eq(5)').html(m.arr[i]['login_hits']);
    m.xtr.children(':eq(6)').html(m.arr[i]['login_time']);
}

function m_search_act_plug(arr) {
    var tmp;
    $('#list_tb tbody td').each(function(i){
        tmp = '';
        if(i%8 == 1){
            tmp = arr['fname'];
        } else if(i%8 == 2){
            tmp = arr['i_tmp0'];
        } else if(i%8 == 3){
            tmp = arr['user_state'];
        }

        if('' != tmp && undefined != tmp){
            this.innerHTML  = this.innerHTML.replace(new RegExp(tmp, "gm"), '<B class="val_search">' + tmp + '</B>');
        }
    });
    return false;
}