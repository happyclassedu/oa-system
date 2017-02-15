<?php
/**
 * 文件名称：mod_psearch.php
 * 功能描述：（个人）搜索（英才网）模型
 * 代码作者：王争强
 * 创建日期：2010-08-06
 * 修改日期：2010-08-06
 * 当前版本：V1.0
 */

i_mod_base_info();

class mod_psearch extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__zpw_j';
        $this->atb = '#@__zpw_c';
        $this->btb = '#@__zpw_x';
        $this->ctb = '#@__zpw_p'; //用户表
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);

        $this->search = '';
        if('' != $this->val_search['trade']){
            $this->search .= ' AND y.trade LIKE "%' . $this->val_search['trade'] . '%" ';
        } else {
            $this->search .=  '';
        }

        if('' != $this->val_search['type2']){
            $this->search .= ' AND x.type2 LIKE "%' . $this->val_search['type2'] . '%" ';
        } else {
            $this->search .=  '';
        }

        if('' != $this->val_search['degree']){
            $this->search .= ' AND x.degree LIKE "%' . $this->val_search['degree'] . '%" ';
        } else {
            $this->search .=  '';
        }

        if('' != $this->val_search['history']){
            $this->search .= ' AND x.history LIKE "%' . $this->val_search['history'] . '%" ';
        } else {
            $this->search .=  '';
        }

        if('' != $this->val_search['age_1']){
            $this->search .= ' AND x.age_1 >= "' . $this->val_search['age_1'] . '" ';
        } else {
            $this->search .=  '';
        }

        if('' != $this->val_search['age_2']){
            $this->search .= ' AND x.age_2 <= "' . $this->val_search['age_2'] . '" ';
        } else {
            $this->search .=  '';
        }

        if('' != $this->val_search['pay_type']){
            $this->search .= ' AND x.pay_type LIKE "%' . $this->val_search['pay_type'] . '%" ';
        } else {
            $this->search .=  '';
        }

        if('' != $this->val_search['pay']){
            $this->search .= ' AND x.pay LIKE "%' . $this->val_search['pay'] . '%" ';
        } else {
            $this->search .=  '';
        }

        if ('' != $this->val_search['big_classification']) {
            $this->search .= ' AND x.big_classification LIKE "%' . $this->val_search['big_classification'] . '%" ';
        } else {
            $this->search .=  '';
        }

        if ('' != $this->val_search['small_classification']) {
            $this->search .= ' AND x.small_classification LIKE "%' . $this->val_search['small_classification'] . '%" ';
        } else {
            $this->search .=  '';
        }

        if ('' != $this->val_search['addr1']) {
            $this->search .= ' AND x.addr1 LIKE "%' . $this->val_search['addr1'] . '%" ';
        } else {
            $this->search .=  '';
        }

        if ('' != $this->val_search['addr2']) {
            $this->search .= ' AND x.addr2 LIKE "%' . $this->val_search['addr2'] . '%" ';
        } else {
            $this->search .=  '';
        }

        if ('0' != $this->val_search['job_day']) {
            //date('Y-m-d',strtotime('3 days'));
            $this->search .= ' AND (x.job_day >"' . date('Y-m-d H:i:s', strtotime('-' . $this->val_search['job_day'] .' days')) . '")';
        } else {
            $this->search .=  '';
        }

        if ('' != $this->val_search['key']) {
            if('name' == $this->val_search['key_class']){
                $this->search .= ' AND ( x.' . $this->val_search['key_class'] . '  LIKE "%' . $this->val_search['key'] . '%")';
            } else {
                $this->search .= ' AND ( y.' . $this->val_search['key_class'] . '  LIKE "%' . $this->val_search['key'] . '%")';
            }
        } else {
            $this->search .=  '';
        }

  
    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        $table = $this->atb . ' AS y ,(SELECT * FROM (SELECT * FROM ' . $this->xtb . ' WHERE drwx=0 ORDER BY oid DESC) AS tmp GROUP BY id) AS x';
        $field = ' x.*, y.fname, y.trade';
        $where = ' y.drwx=0 AND x.cid=y.id ';
        $order = '';
        $arr = $this->list_read_base($table, $field, $where, $order);
//        $arr = $this->search;
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num() {
        $table = $this->xtb . ' AS x ';
        $where = ' x.drwx=0 ';
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
     * info_favorite:将职位收藏.
     */
    function info_favorite() {
        $this->info_batch_manage();
    }


      /**
     * info_batch_manage:对职位进行批量处理.
     * @param $act:批量处理的操作行为：update, delect.
     * @param $fields:修改的字段及对应的值.
     * @param $arr:需保存的信息数组.
     * @return $arr:0（失败）或1（成功）.
     */

    function info_batch_manage($pid){
        $tmp = $this->info_save_load();
        for($i=0;$i<count($tmp);$i++){
            if($this->info_isfavorite($tmp[$i])){
                $arr = '0'; //已存在
            } else {
                $arr_info = $this->info_cinfo($tmp[$i]);
                $this->xdb->insert($this->btb, 'c_id, j_id, p_id, c_name, j_name, p_name, i_type, i_time', '"' .$arr_info['cid'] . '", "' . $arr_info['id'] . '", "' . $pid . '", "' . $arr_info['cname'] . '", "' . $arr_info['name'] . '", "' . $_SESSION['name'] . '", "p_favorite", "' . i_time(). '" ');
                $arr = '1';//添加成功
            }
        }
        $this->print_arr($arr);
        return $arr;
    }

    function info_isfavorite($xid) {
        $table = $this->btb. ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND x.j_id="' . $xid . '" AND x.i_type="p_favorite" ';
        $arr = $this->info_read_base($table, $field, $where);
        if($arr) {
            return true;
        } else {
            return false;
        }
    }

    function info_cinfo($xid){
        $table = $this->xtb. ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND x.id="' . $xid . '" ';
        $arr = $this->info_read_base($table, $field, $where);
        return $arr;
    }

      /**
     * info_login:企业登录功能.
     * @param $xid:信息id.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:0（失败）或1（成功）.
     */

    function info_login() {
        $info = @$_POST['arr'];
        $info = i_json2php($info);
        if('' !=$info['loginid']) {
            $table = $this->ctb . ' AS x ';
            $field = ' * ';
            $where = ' x.drwx=0 AND x.loginid="' . $info['loginid'] . '" ';
            $arr_info = $this->info_read_base($table, $field, $where);
            if('' != $arr_info && isset($arr_info)) {
                    if('' != $info['loginpw']) {
                        if($arr_info['loginpw'] == $info['loginpw']) {
                            $_SESSION['p_id'] = $arr_info['id'];
                            $_SESSION['login_time'] = strtotime(i_time()); //当前登录时间
                            if(isset($_SESSION['login_time']) && time() < ($_SESSION['login_time']+ get_cfg_var('session.gc_maxlifetime'))) {
                                $login_hits = $arr_info['login_hits'] + 1; //登录次数
                                $login_ip = $this->get_real_ip();
                                $this->xdb->update($this->ctb, 'login_time="' . i_time() . '", login_hits="' . $login_hits . '", login_ip="' . $login_ip . '"', 'loginid="' . $info['loginid'] . '"');
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

        $this->print_arr($arr);
        return $arr;
    }

    function  info_init($pid) {
        $arr = array();
        $result_arr = $this->xdb->read_one($this->ctb, '*', 'id="' . $pid . '"');
        $arr['id'] = $result_arr['id'];
        $arr['loginid'] = $result_arr['loginid'];
        $arr['login_time'] = $result_arr['login_time'];
        $arr['login_hits'] = $result_arr['login_hits'];
        $this->print_arr($arr, 1);
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
    
   function info_session() {
        $arr = $_SESSION['p_id'];
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * get_real_ip:获取真实IP.
     * @return $ip:获取ip返回值.
     */
    function get_real_ip() {
        $ip=false;
        if(!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) {
                array_unshift($ips, $ip);
                $ip = FALSE;
            }
            for ($i = 0; $i < count($ips); $i++) {
                if (!eregi ("^(10|172.16|192.168).", $ips[$i])) {
                    $ip = $ips[$i];
                    break;
                }
            }
        }
        return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
    }
    
    /**
     * info_time:系统返回日期时间.
     * @param $type:0表示格式是YYYY-MM-DD HH:MM:SS; 1表示格式是YYYY-MM-DD; 2表示格式是HH:MM:SS .
     * @param $arr:返回值.
     * @return .
     */
    function info_time($type) {

        switch ($type) {
            case '0':
                $arr = i_time();
                break;
            case '1':
                $arr = substr(i_time(), 0, 10);
                break;
            case '2':
                $arr = substr(i_time(), 11, 8);
                break;
        }
        $this->print_arr($arr);
        return $arr;
    }

}
?>