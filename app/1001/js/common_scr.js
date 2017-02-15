function z() {
    var a = window.ActiveXObject ? new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest();
    a.open('GET', '../../1000/js/common.js', false);
    a.send(null);
    if(200 == a.status || 0 == a.status){
        if (window.execScript)
            window.execScript(a.responseText);
        else window.eval.call(window, a.responseText);
    }
}
z();