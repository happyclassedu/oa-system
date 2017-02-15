$(document).ready(function(){
    i_ileap_info_num();
});

var xid;

function i_ileap_info_del(xid) {
    $.ajax({
        url : i_act + 'a=del_info&x=' + xid ,
        success : function(text){
            alert(text);
            i_ileap_info_num();
        //            window.location = '../htm/dict_list.htm';
        }
    });
}

$(document).ready(function(){
    i_ileap_info_num();
});

function i_ileap_info_num() {
    $.ajax({
        url : i_act + 'a=read_num',
        success : function(text){
            i_ileap_jpage_load(text);
        }
    });
}

function i_ileap_jpage_load(info_num) {
    $('#jpage_box').jpage({
        info_all : info_num,
        show_num : '7',
        page_skin : 'blue',
        page_act : i_ileap_read_list
    });
}

i_ileap_read_list = function(show_num, page_now) {
    $.ajax({
        url : i_act + 'a=beat_ileap_list&show_num=' + show_num + '&page_now=' + page_now,
        success : function(text){
            var arr = i_json2js(text);//将php文件进行解密，并返回到js      
            $('#list_table tbody').html('');  //清空tbody里面的内容
            var tr_txt = '';
            for(var i=0 ; i<arr.length; i++) {
                tr_txt += '<tr>';
                tr_txt += '<td>'+ arr[i]['id'] +'</td>';
                tr_txt += '<td>'+ arr[i]['ileap_code'] +'</td>';
                tr_txt += '<td>'+ arr[i]['ileap_name'] +'</td>';
                tr_txt += '<td>'+ arr[i]['degree'] +'</td>';
                tr_txt += '<td>'+ arr[i]['job_type'] +'</td>';
                tr_txt += '<td>'+ arr[i]['street_work'] +'</td>';
                tr_txt += '<td>'+ arr[i]['community'] +'</td>';
                tr_txt += '<td align="center"><input id="btn_view" type="button" value="查看" /><input id="btn_edit" type="button" value="修改"> <input id="btn_del" type="button" value="删除"></td>';
                tr_txt += '</tr>';
            }
            $('#list_table tbody').append(tr_txt);
             $('#btn_view').click(function(){
                xid = this.parentNode.parentNode.firstChild.innerHTML;
                window.location = "../htm/ileap_info.htm?a=view&x="+ xid;
            });
            $('#btn_edit').click(function(){
                xid = this.parentNode.parentNode.firstChild.innerHTML;
                window.location = "../htm/ileap_info.htm?a=edit&x="+ xid;
            });
            $('#btn_del').click(function(){
                xid = this.parentNode.parentNode.firstChild.innerHTML;
                i_ileap_info_del(xid);
            });
        }
    });
}

