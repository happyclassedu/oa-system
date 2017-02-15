$(document).ready(function(){
    m_www_act();
});

function m_www_act() {
    document.getElementById('bg_border').style.height = document.body.clientHeight + 'px';
    swfobject.embedSWF('../img/header_bg.swf', 'header_bg', '950', '150', '9.0.0', null, false, {
        wmode: 'transparent'
    });
}