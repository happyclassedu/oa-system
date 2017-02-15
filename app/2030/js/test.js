/**
 * 文件名称：info_link.js
 * 功能描述：链接管理信息的信息控制器JS
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */

var show;
$(document).ready(function(){
    //    alert('1最先执行');
    m_file_act();

    $('#btn_close').click(function(){
        var myhaha = document.getElementById("d_type_val").value;
//        parent.close();
        alert('btn_close1' + myhaha);
//        print_r(myhaha);
//        $('#abcdd').html(show);
//        alert(show);
    });

});

function m_file_act() {
    $('#t_upload').uploadify({
        'uploader'   : '../../1000/img/uploadify.swf',
        'script'     : '../../../sys_act_0/2031/act/info_file.php?a=info_add',
        'cancelImg'  : '../../1000/img/cancel.png',
        'scriptData' : {
            'd_xid' : '123',
            'd_xtb' : 'link'
        }
    });
    $('#t_upload2').uploadify({
        'uploader'   : '../../1000/img/uploadify.swf',
        'script'     : '../../../sys_act_0/2031/act/info_file.php?a=info_add',
        'cancelImg'  : '../../1000/img/cancel.png',
        'scriptData' : {
            'd_xid' : '123',
            'd_xtb' : 'link'
        }
    });
}


function print_r( $value ){
    if($value.constructor == Array || $value.constructor == Object ){
        //        document.write("<ul>");
        show += "<ul>";
        for (var $i in $value){
            if($value[$i].constructor == Array || $value[$i].constructor == Object ){
                //                document.write("<li>["+$i+"] => " + typeof( $value ) + " </li><ul>");
                show += "<li>["+$i+"] => " + typeof( $value ) + " </li><ul>";
                print_r($value[$i]);
                //                document.write("</ul>");
                show += "</ul>";
            }else{
                //                document.write("<li>["+$i+"] => " + $value[$i] + "</li>");
                show += "<li>["+$i+"] => " + $value[$i] + "</li>";
            }
        }
        show += "</ul>";
    }
}