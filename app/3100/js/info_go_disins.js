/**
 * 文件名称：info_go_disins.js
 * 功能描述：出国定居退保的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//});

function m_load() {
    m.arr_info = '';
    m.check = '';
    m_init();
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#d_idcard').blur(function(){
        if(m_checkCardID(this.id, '', 'd_sex', 'd_birth')){
            var check = m_info_name_check(this.id);
            if('1' == check) {
                alert( '数据库中已存在相同值,请选择或填写！');
            } else if('0' == check){
                if(confirm( '对不起，数据库中不存在此值，是否新增参保人员信息！'))
                {
                    i_mdi_open('./info_czyl.htm?a=add', '新增参保人员信息', 1);
                }
            }
        }
    });


    $('#btn_change').click(function(){
        i_box_open({
            content: '../htm/list_cp.htm?a=list',
            player: 'iframe',
            title: 'Welcome',
            width: '1050px',
            height: '600px'
        });
    });
}

//function m_info_set_plug() {
//
//}

function m_info_add_plug() {
//    i_obj_disable('d_i_state0');
    i_obj_set('d_i_type', '7'); //7代表出国定居退保
    i_obj_set('d_i_state0', '终止');
    i_obj_set('d_i_state1', '终止');
    $('#d_idcard').addClass('info_must');
}


function m_info_edit_plug() {
   $('#d_idcard').addClass('info_must');
}

function m_info_view_plug() {
    $('#d_idcard').removeClass('info_must');
}

//function m_info_input_plug(state) {
//
//}

//function m_act_url_plug() {
//    return false;  //可以终止跳转
//}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_idcard');
    if ('' == m.tmp) {
         alert('公民身份证号码不能为空，请填写！');
        return false;
    } else {
        if(!m_checkCardID('d_idcard', '', 'd_sex', 'd_birth')){
            return false;
        }
    }

    m.tmp = i_obj_val('d_name');
    if ('' == m.tmp) {
         alert('姓名不能为空，请填写！');
        return false;
    }

    m.tmp = i_obj_val('d_birth');
    if ('' == m.tmp) {
         alert('出生日期不能为空，请填写！');
        return false;
    }
    
    m.tmp = m_info_name_check('d_idcard');
    if('0' ==  m.tmp) {
        if(confirm( '对不起，数据库中不存在此值，是否新增参保人员信息！'))
                {
                    i_mdi_open('./info_czyl.htm?a=add', '新增参保人员信息', 1);
                }
        return false;
    }

    return true;
}

function m_box_close_plug(arr) {
    i_obj_set('d_ins_code', arr['ins_code']);
    i_obj_set('d_idcard', arr['idcard']);
    i_obj_set('d_name', arr['name']);
    i_obj_set('d_sex', arr['sex']);
    i_obj_set('d_degree', arr['degree']);
    i_obj_set('d_birth', arr['birth']);
    i_obj_set('d_minzu', arr['minzu']);
}


function m_info_name_check(obj_id) {
    m.arr = i_obj_val(obj_id);
    if ('' != m.arr) {
        $.ajax({
            url : g.act + 'info_czyl.php?a=info_name_check&x=' + m.xid + '&obj_id=' + obj_id.substr(2),
            data : 'arr=' + i_js2json(m.arr),
            success : function(txt){
                m.arr = i_json2js(txt);
                if (0 < m.arr) {
                    m.check = '1';
                } else {
                    m.check = '0';
                }
            }
        });
    }
    return m.check;
}

function m_init() {

}





