if (this.i_read_js) {
    g.id_www = i_obj_val('g_id_www');
    if ('' != g.id_www) {
        i_read_js('www_' + g.id_www);
    }
} else {
    var sys_type = 'www';
    document.write('<script src="../app/js/common.js"></script>');
}