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

    var date_s = "2010-01-01";
    date_s = date_s.replace(new RegExp('-', "gm"), '/');
    date_s = new Date(date_s);

    var date_e = "2010-08-31";
    date_e = date_e.replace(new RegExp('-', "gm"), '/');
    date_e = new Date(date_e);
    
    var tmp = date_e.getMonth() + (date_e.getFullYear()-date_s.getFullYear())*12 - date_s.getMonth();
    alert(tmp);
//    document.writeln("月差 : "+date_s.dateDiff("m", date_e)+"<br>");
}

Date.prototype.dateDiff = function(interval,objDate){
    //若参数不足或 objDate 不是日期物件则回传 undefined
    if(arguments.length<2||objDate.constructor!=Date) return undefined;
    switch (interval) {
        //计算秒差
        case "s":
            return parseInt((objDate-this)/1000);
        //计算分差
        case "n":
            return parseInt((objDate-this)/60000);
        //计算時差
        case "h":
            return parseInt((objDate-this)/3600000);
        //计算日差
        case "d":
            return parseInt((objDate-this)/86400000);
        //计算週差
        case "w":
            return parseInt((objDate-this)/(86400000*7));
        //计算月差
        case "m":
            return (objDate.getMonth()+1)+((objDate.getFullYear()-this.getFullYear())*12)-(this.getMonth()+1);
        //計算年差
        case "y":
            return objDate.getFullYear()-this.getFullYear();
        //输入有误
        default:
            return undefined;
    }
}


$('#d_test1').change(function() {
    alert("changed1");
    alert("changed2");
    alert("changed3");
    alert("changed4");
});

$('#d_test2').change(function() {
    $('#d_test1').change();
});