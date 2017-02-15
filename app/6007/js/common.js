if (!this.i_read_js) {
    var sys_type = '';
    var g_app_dir = window.location.pathname;  //获取当前url访问的文件目录
    g_app_dir = g_app_dir.substr(0, g_app_dir.lastIndexOf('/'));
    g_app_dir = g_app_dir.substr(g_app_dir.lastIndexOf('/') + 1);
    if ('htm' == g_app_dir) {
        sys_type = 'oa';
        document.write('<script src="../../1000/js/common.js"></script>');
    } else {
        sys_type = 'www';
        document.write('<script src="../app/js/common.js"></script>');
    }
}