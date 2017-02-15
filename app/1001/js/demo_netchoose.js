i_net_init();

function i_cookie_get(key) {
    if (document.cookie.length>0) {
        cookie_s = document.cookie.indexOf(key + '=')
        if (cookie_s != -1) {
            cookie_s = cookie_s + key.length + 1;
            cookie_e = document.cookie.indexOf(";", key)
            if (cookie_e == -1) {
                cookie_e = document.cookie.length;
            }
            return unescape(document.cookie.substring(cookie_s, cookie_e));
        }
    }
    return "";
}

function i_cookie_set(key, val, day, dir) {
    var exdate=new Date()
    exdate.setDate(exdate.getDate()+ day)
    document.cookie = key+ '=' + escape(val) + ((day == null) ? '' : ';expires=' + exdate.toGMTString()) + ((dir == null) ? '' : ';path=' + dir);
}

function i_net_goto(host_url){
    i_cookie_set('host_url', host_url, '10', '/');
    self.location = host_url + location.pathname;
}

function i_net_choose(){
    var host_tmp = '';
    for(var i=1; i<host_arr.length; i++) {
        host_tmp += '<img src="' + host_arr[i]+ '/net.gif" width="0" height="0" onerror=i_net_goto("' + host_arr[i] + '")>';
    }
    document.write(host_tmp);
}

function i_net_init(){
    var host_url = i_cookie_get('host_url');
    if (host_url && host_url.indexOf(location.host)>0) {
        return;
    } else {
        i_net_choose();
    }
}