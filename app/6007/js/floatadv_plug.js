//左右浮动广告
/**
 * left_width: 宽度--单位:px
 * left_height: 高度
 * left_url: 左url
 * right_url: 右url
 * left_img: 左图片
 * right_img: 右图片
 **/
var lastScrollY = 0;
var minScreenW = '1366';

m_float_adv0_plug('128', '460', '128', '460', '', '', 'left_floatadv.jpg', 'right_floatadv.jpg');

function m_float_adv0_plug(left_width, left_height, right_width, right_height, left_url, right_url, left_img, right_img){
    if(window.screen.width < minScreenW)
    {
        m_ClosedivU();
    } else {
        var left_div = "<DIV id='outBox0'  style='left:0;POSITION:absolute;TOP:40px;width:" + left_width + "px;height:" + left_height + "px;background:#efefef'><a href='" + left_url + "' target='_blank'><img src='../img/" + left_img + "' border='0'></a><a href='#' onclick='m_ClosedivU()'  style='color:#ff0000;FONT-SIZE:10PT'>关闭广告</a>'</div>"
        var right_div = "<DIV id='outBox1' style='right:0;POSITION:absolute;TOP:40px;width:" + right_width + "px;height:" + right_height + "px;background:#efefef''><a href='" + right_url + "' target='_blank'><img src='../img/" + right_img + "' border='0'></a><a href='#' onclick='m_ClosedivU()' style='color:#ff0000;FONT-SIZE:10PT'>关闭广告</a>'</div>"

        document.write(left_div);
        document.write(right_div);
        window.setInterval('m_heartBeat()',1);
    }
}

function m_heartBeat(){
    var diffY;
    var outBox0 = document.getElementById("outBox0");
    var outBox1 = document.getElementById("outBox1");
    if (document.documentElement && document.documentElement.scrollTop)
        {
            diffY = document.documentElement.scrollTop;
        }
    else if (document.body)
        {
            diffY = document.body.scrollTop;
        }
    else
    {/*Netscape stuff*/}
    percent=.1*(diffY-lastScrollY);
    if(percent > 0) {
        percent=Math.ceil(percent);
    }
    else
        {
            percent=Math.floor(percent);
        }
    outBox0.style.top = parseInt(outBox0.style.top) + percent + "px";
    outBox1.style.top = parseInt(outBox0.style.top) + percent + "px";
    lastScrollY = lastScrollY + percent;
}

function m_ClosedivU()
{
    var outBox0 = document.getElementById("outBox0");
    var outBox1 = document.getElementById("outBox1");
    outBox0.style.visibility = "hidden";
    outBox1.style.visibility = "hidden";
}



