<?php
/*
* 文件名称：mod_user.php
* 功能描述：用户信息模型。
* 代码作者：王争强（创建）
* 创建时间：2010_10_11
* 修改时间：2010-11-15
* 当前版本：V1.0
*/

i_mod_base_info();

class mod_user extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__ws_user';
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);
        $this->key_search = array('x.name');
    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        $table = $this->xtb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx="0" ';
        $order = ' ORDER BY atime DESC ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num() {
        $table = $this->xtb . ' AS x ';
        $where = ' x.drwx="0" ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * list_read4user : 根据条件ws_id读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read4user() {
        $ws_id = @$_GET['ws_id'];
        $table = $this->xtb . ' AS x ';
        $field = ' x.* ';
        $where = ' x.drwx="0" AND x.ws_id=' . $ws_id . ' ';
        $order = ' ORDER BY atime DESC ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num4user : 根据条件ws_id读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num4user() {
        $ws_id = @$_GET['ws_id'];
        $table = $this->xtb . ' AS x ';
        $field = ' x.* ';
        $where = '  x.drwx="0" AND x.ws_id=' . $ws_id .   ' ';
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
        $where = ' id="' . $xid . '" ';
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
        $arr = $this->info_save_load();
        $this->arr['reg_ip'] = i_read_ip();
        $arr = $this->info_add_base();
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
     * is_user:用户是否注册功能.
     * @param $xid:信息id.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:0 (false)或1（true）.
     */
    function is_user() {
        $ws_id = @$_GET['ws_id'];
        $arr = $this->info_save_load();
        $table = $this->xtb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND x.loginid="' . $arr . '" AND x.ws_id=' . $ws_id . ' ';
        $arr = $this->info_read_base($table, $field, $where);
        if(isset($arr) && '' != $arr['loginid']) {
            $arr = '1'; //1代表true
        } else {
            $arr = '0'; //0代表false
        }
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * info_login:登录功能.
     * @param $xid:信息id.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:
     *      "0"表示正常登录；
     *      "1"表示SESSION失效；
     *      "2"表示密码不正确；
     *      "3"表示密码为空；
     *      "4"表示用户不存在；
     *      "5"表示用户名为空；
     */
    function info_login() {
        $ws_id = @$_GET['ws_id'];
        $info = $this->info_save_load();
        if('' != $info['loginid']) {
            $table = $this->xtb . ' AS x ';
            $field = ' * ';
            $where = ' x.drwx=0 AND x.loginid="' . $info['loginid'] . '" AND x.ws_id=' . $ws_id . ' ';
            $arr_info = $this->info_read_base($table, $field, $where);
            if('' != $arr_info && isset($arr_info)) {
                if('' != $info['loginpw']) {
                    if($arr_info['loginpw'] == $info['loginpw']) {
                        $_SESSION['ws_uid'] = $arr_info['id']; //网站前台登录session保存的id.
                        $_SESSION['ws_uname'] = $arr_info['loginid']; //网站前台登录session保存的id.
                        $_SESSION['ws_u_arr'] = $arr_info; //网站前台登录session保存的arr.
                        $_SESSION['login_time'] = strtotime(i_time()); //当前登录时间
                        if(isset($_SESSION['login_time']) && time() < ($_SESSION['login_time']+ get_cfg_var('session.gc_maxlifetime'))) {
                            $login_hits = $arr_info['login_hits'] + 1; //登录次数
                            $login_ip = i_read_ip();
                            $this->xdb->update($this->xtb, 'login_time="' . i_time() . '", login_hits="' . $login_hits . '", login_ip="' . $login_ip . '"', 'loginid="' . $info['loginid'] . '"');
                            $arr = '0'; //正常登录
                        } else {
                            $arr = '1'; //$_SESSION失效
                        }
                    } else {
                        $arr = '2'; //密码不正确
                    }
                } else {
                    $arr = '3'; //密码为空
                }
            } else {
                $arr = '4'; //用户不存在
            }

        } else {
            $arr = '5'; //用户名为空
        }

        $this->print_arr($arr);
        return $arr;
    }

    /**
     * session_val:获取session值.
     * @param $xid:信息id.
     * @param $arr:需保存的信息数组.
     * @return $arr:返回session值.
     */
    function session_val() {
        $arr = $_SESSION;
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * session_logout:获取session值.
     * @param $arr:需保存的信息数组.
     * @return $arr:返回1或0.
     */
    function session_logout() {
        // 这种方法是将原来注册的某个变量销毁
        unset($_SESSION);
        // 这种方法是销毁整个 Session 文件
        if(session_destroy() == true){
            $arr = '1';
        } else {
            $arr = '0';
        }
        $this->print_arr($arr);
        return $arr;
    }
}
?>