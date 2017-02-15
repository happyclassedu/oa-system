document.write('<script src="../../1000/js/common.js"></script>');

function m_ssession_verify(){
    $.ajax({
        url : g.act + 'session.php?a=ssession_verify',
        success : function(txt){
            if('0' == txt || '' == txt){
                i_mdi_open('info_person_login.htm?a=add', '', 1);
                return false;
            } else {
                return true;
            }
        }
    });
}