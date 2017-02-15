/*******
 *参数说明：
 *btnPrev : 上一张按钮
 *btnNext : 下一张按钮
 *btnGo : 标签控制，也就是用’1,2,3,4…’来控制
 *mouseWheel : 是否支持鼠标滑轮滚动，属性值：false / true；默认为false 打开此项需要jQuery UI插件支持
 *auto : 设置自动播放的速度，默认自动播放是关闭的，格式 auto: 800 (为播放速度)
 *speed : 动画效果速度
 *easing : 动画效果优化，姑且这么里面 需要外部插件支持
 *vertical : 动画方向，如果设置为true，则表示垂直滚动，默认为false
 *circular : 是否重复播放，如果设置为false，则到最后一个下一张按钮就点不动了，到第一张上一张按钮就点不动
 *visible : 设置默认显示几个li，默认是3个
 *start : 效果从第几个开始，默认为0
 *scroll : 一次滑动几个li，默认是2
 *beforeStart : 这个是接口，每次滑动效果执行之前执行的自定义函数
 *afterEnd : 这个是接口，每次滑动效果执行之后执行的自定义函数
*******/

$(document).ready(function(){
    //加载jquery.jcarousellite.js库.
   i_load_jcarousellite();
    $(".default .carousel").jCarouselLite({
        btnNext: ".default .next",
        btnPrev: ".default .prev",
        visible: 6,      //显示图片数量
        speed: 1000,     //滚动完成时长 单位毫秒
        scroll: 1        //每次滚动图片数量
    });
    
    $(".auto .jCarouselLite").jCarouselLite({
        auto: 800,
        visible: 6, 
        speed: 1000
    });

});
