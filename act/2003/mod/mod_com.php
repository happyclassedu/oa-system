<?php
/**
 * 文件名称：mod_com.php
 * 功能描述：公司管理模型
 * 代码作者：王争强
 * 创建日期：2010-08-06
 * 修改日期：2010-08-06
 * 当前版本：V1.0
 */

i_mod_base_info();

class mod_com extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__ws_com';
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);
        $this->key_search = array('loginid', 'fname', 'web', 'email');
    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        $ws_id = @$_GET['ws_id'];
        $table = $this->xtb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND x.ws_id=' .$ws_id . ' ';
        $order = 'ORDER BY x.atime DESC ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num() {
        $ws_id = @$_GET['ws_id'];
        $table = $this->xtb . ' AS x ';
        $where = ' x.drwx=0 AND x.ws_id=' .$ws_id . ' ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * info_read:根据$xid读取一条信息内容.
     * @param $xid:信息id.
     * @return $arr:空or数组加密后的字符串.
     */
    function info_read($xid) {
        i_xid_check($xid);
        $table = $this->xtb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND id="' . $xid . '" ';
        $arr = $this->info_read_base($table, $field, $where);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * info_del:根据$xid进行信息的软删除.
     * @param $xid:信息id.
     * @return $arr:0（失败）或1（成功）.
     */
    function info_del($xid) {
        $arr = $this->info_del_base($xid);
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * info_del_true:根据$xid进行信息的硬删除.
     * @param $xid:信息id.
     * @return $arr:0（失败）或1（成功）.
     */
    function info_del_true($xid) {
        $arr = $this->info_del_true_base($xid);
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * info_add:新增信息的保存操作.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:0（失败）或其他数字（成功，新信息的id）.
     */
    function info_add() {
        $arr = $this->info_add_base();
        $_SESSION['c_id'] = $arr;
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * info_edit:修改信息的保存操作.
     * @param $xid:信息id.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:0（失败）或1（成功）.
     */
    function info_edit($xid) {
        $arr = $this->info_edit_base($xid);
        $this->print_arr($arr);
        return $arr;
    }

       /**
     * info_pwd:修改密码的操作.
     * @param $xid:信息id.
     * @param $arr:需保存的信息数组.
     * @return $arr:0（失败）或1（成功）.
     */
    function info_pwd($xid) {
        $loginpw = $this->info_save_load();
        $arr = $this->xdb->update($this->xtb, 'loginpw="' . $loginpw . '"', 'id="' . $xid . '"');
        $this->print_arr($arr);
        return $arr;
    }
    
      /**
     * info_login:企业登录功能.
     * @param $ws_id:主表的字段集数组.
     * @param $arr:需保存的信息数组.
     * @return $arr_new.
     */
    function info_login(){
        $ws_id = @$_GET['ws_id'];
        $info = $this->info_save_load();
        if('' != $info['loginid']){
            $table = $this->xtb . ' AS x ';
            $field = ' id, loginid, loginpw, sname AS name ';
            $where = ' x.drwx=0 AND x.loginid="' . $info['loginid'] . '" AND x.ws_id=' . $ws_id . ' ';
            $arr_info = $this->info_read_base($table, $field, $where);
            if('' != $arr_info && isset($arr_info)) {
                    if('' != $info['loginpw']) {
                        if($arr_info['loginpw'] == $info['loginpw']) {
                            $_SESSION['c_id'] = $arr_info['id'];
                            $_SESSION['login_time'] = strtotime(i_time()); //当前登录时间
                            if(isset($_SESSION['login_time']) && time() < ($_SESSION['login_time']+ get_cfg_var('session.gc_maxlifetime'))) {
                                $login_hits = $arr_info['login_hits'] + 1; //登录次数
                                $login_ip = i_real_ip();
                                $this->xdb->update($this->xtb, 'login_time="' . i_time() . '", login_hits="' . $login_hits . '", aip="' . $login_ip . '"', 'loginid="' . $info['loginid'] . '"');
                                $arr = 'err_longin'; //正常登录
                            } else {
                                $arr = 'err_session_inval'; //$_SESSION失效
                            }
                        } else {
                            $arr = 'err_pwd_no'; //密码不正确
                        }
                    } else {
                        $arr = 'err_pwd_null'; //密码为空
                    }
            } else {
                $arr = 'err_u_nexist'; //用户不存在
            }

        } else {
            $arr = 'err_u_null'; //用户名为空
        }

        $arr_new['err'] = $arr;
        $arr_new['info'] = $arr_info;
        $this->print_arr($arr_new, 1);
        return $arr_new;
    }

      /**
     * info_checkUser:企业用户注册功能.
     * @param $ws_id:信息ws_id.
     * @param $arr:需保存的信息数组.
     * @return $arr:0（失败）或1（成功）.
     */
    function info_checkUser(){
        $ws_id = @$_GET['ws_id'];
        $loginid = $this->info_save_load();
        $table = $this->xtb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND x.loginid="' . $loginid . '"  AND x.ws_id=' . $ws_id . ' ';
        $arr = $this->info_read_base($table, $field, $where);
        $this->print_arr($arr, 1);
        return $arr;
    }

      /**
     * info_checkemail:检测邮箱是否已被占用.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:0（失败）或1（成功）.
     */
    function info_checkemail(){
        $ws_id = @$_GET['ws_id'];
        $email = $this->info_save_load();
        $arr = $this->xdb->read_num($this->xtb . ' AS x ', ' x.drwx=0 AND x.email="' . $email . '" AND x.ws_id=' . $ws_id . ' ');
        $this->print_arr($arr);
        return $arr;
    }

//    function  info_init($cid) {
//        $arr = array();
//        $result_arr = $this->xdb->read_one($this->xtb, '*', 'id="' . $cid . '"');
//        $arr['id'] = $result_arr['id'];
//        $arr['fname'] = $result_arr['fname'];
//        $arr['login_time'] = $result_arr['login_time'];
//        $arr['login_hits'] = $result_arr['login_hits'];
//        $this->print_arr($arr, 1);
//        return $arr;
//    }

    /**
     * info_name_check:同名公司检测.
     * @param $xid:信息id.
     * @param $arr:现在输入的名称数据.
     * @return $arr:0（没有）或n>0（有）.
     */
    function info_name_check($xid) {
        $key = @$_GET['obj_id'];
        $info_name = @$_POST['arr'];
        $info_name = i_json2php($info_name);
        $arr = $this->xdb->read_num($this->xtb, ' ' . $key . '="' . $info_name . '" AND id !="' . $xid . '" ');
        $this->print_arr($arr);
        return $arr;
    }


    function info_session(){
        $arr = $_SESSION['c_id'];
        $this->print_arr($arr);
        return $arr;
    }

      /**
     * info_loginout: 个人安全退出.
     * @param $arr:需保存的信息数组.
     * @return $arr:0（失败）或1（成功）.
     */

    function info_loginout() {
        if(session_destroy()) {
            $arr = 1;
        } else {
            $arr = 0;
        }
        $this->print_arr($arr);
        return $arr;
    }

     function info_issession(){
         if(isset($_SESSION['c_id'])){
            $arr = '1';
         } else {
            $arr = '0';
         }

        $this->print_arr($arr);
        return $arr;
    }
}
?>