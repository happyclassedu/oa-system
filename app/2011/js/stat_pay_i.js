/**
 * 文件名称：list_post.js
 * 功能描述：职务管理。
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
    xtd : '',
    val_search : '',
    info_num : 0,
    show_num : 10,
    page_now : 1
};

var n = '';
$(document).ready(function(){
    m.xid = i_get('x');
    m.zt_i = new Array(
        '事假天数',
        '病假天数',
        '旷工天数',
        '实际出勤',
        '基本工资',
        '岗位工资',
        '学历工资',
        '工龄工资',
        '午餐补助',
        '岗位津贴',
        '全勤奖',
        '奖金',
        '交通补贴',
        '其它金额',
        '收入合计',
        '事假扣款',
        '病假扣款',
        '旷工扣款',
        '其他扣款',
        '扣款合计',
        '应发工资',
        '个税扣款',
        '实发工资'
        );
    m.zt_i_val = new Object();
    m.xtr = $('#list_tb tbody tr:eq(0)').clone(true);
    i_tr_css($('#list_tb tbody tr'));
    m_info_read_base();
    i_read_css('m_list', 0);
    m.xtd = $('<input type="text" value="123" />');
    m.xtd.blur(function(){
        if (this.value != m.tmp) {
            this.parentNode.className = 'td_change';
        }
        this.parentNode.innerHTML = this.value;
    });
    m.xtd.dblclick(function(){
        $(this).blur();
    });
});

//function m_btn_load_plug() {
//    $('#btn_save').click(function(){
//        m_info_save();
//    });
//}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['hm_code']);
    m.xtr.children(':eq(2)').html(m.arr[i]['hm_name']);
    m.xtr.children(':eq(3)').html(m.arr[i]['post_name']);
}

function m_info_read_base() {
    if ('' == n) {
        $.ajax({
            url : i_act + 'a=info_read_base&x=' + m.xid,
            success : function(txt){
                n = i_json2js(txt);
                n_set();
            }
        });
    }
}

function n_set() {

    for (i in m.zt_i) {
        m.zt_i_val[i] = '';
        for (j in n.zt) {
            if (m.zt_i[i] == n.zt[j]['name']) {
                m.zt_i_val[i] = n.zt[j]['money'];
            }
        }
        if ('' == m.zt_i_val[i]) {
            m.zt_i_val[i] = '0.00';
        }
    }

    m.xtr.children(':eq(4)').html(n.pay['zt_name']);
    m.xtr.children(':eq(5)').html(n.pay['pay_day']);
    for (i in m.zt_i_val) {
        m.xtr.children().eq(6+i*1).html(m.zt_i_val[i]);
    }

    m.xtr.children(':gt(5):not(:last)').dblclick(function(){
        m.tmp = this.innerHTML;
        this.innerHTML = '';
        m.xtd.val(m.tmp);
        $(this).append(m.xtd.clone(true));
        $(this).children().focus();
    });

    $('#list_tb tbody').html('')
    for(i=0; i<n.hm.length; i++) {
        m.xtr.attr('id', i);
        m.xtr.children(':eq(0)').html(i + 1);
        m.xtr.children(':eq(1)').html(n.hm[i]['hm_code']);
        m.xtr.children(':eq(2)').html(n.hm[i]['hm_name']);
        m.xtr.children(':eq(3)').html(n.hm[i]['post_name']);
        $('#list_tb tbody').append(m.xtr.clone(true));
    }
    i_tr_css($('#list_tb tbody tr'));
}