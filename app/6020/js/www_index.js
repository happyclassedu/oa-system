/**
* 文件名称：www_index.js
* 功能描述：页面控制器。
* 代码作者：孙振强（创建）
* 创建日期：2010-06-10
* 修改日期：2010-06-18
* 当前版本：V2.0
*/
var ws_id = '8';
var ws_name = '西安立丰集团';

$(document).ready(function(){
      //加载jquery.caroufredsel.js库.
      i_load_jcarousellite();

    $(".div_jcarousel_1").jCarouselLite({
        auto: 800,
        visible: 7,
        speed: 3000
    }); 
});

//function m_index_act() {
//
//}




