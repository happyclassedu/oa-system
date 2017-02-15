<?php
/**
 * 文件名称：mod_csearch.php
 * 功能描述：（企业）搜索（英才网）模型
 * 代码作者：王争强
 * 创建日期：2010-08-06
 * 修改日期：2010-08-06
 * 当前版本：V1.0
 */

i_mod_base_info();

class mod_csearch extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__zpw_r'; //简历表
        $this->atb = '#@__zpw_x';  //个企关系表
        $this->btb = '#@__zpw_j';  //职位表
        $this->ctb = '#@__zpw_c';  //企业表
        $this->dtb = '#@__zpw_p';  //个人表
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);

        $this->search = '';
        if('' != $this->val_search['trade']){
            $this->search .= ' AND x.trade LIKE "%' . $this->val_search['trade'] . '%" ';
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

        if('' != $this->val_search['work_term']){
            $this->search .= ' AND x.work_term LIKE "%' . $this->val_search['work_term'] . '%" ';
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

        if ('0' != $this->val_search['atime']) {
            $this->search .= ' AND (x.atime >"' . date('Y-m-d H:i:s', strtotime('-' . $this->val_search['atime'] .' days')) . '")';
        } else {
            $this->search .=  '';
        }

        if ('' != $this->val_search['key']) {
            $this->search .= ' AND (x.name LIKE "%' . $this->val_search['key'] . '%" OR  x.rname LIKE "%' . $this->val_search['key'] . '%")';
        } else {
            $this->search .=  '';
        }

  
    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        $table = $this->xtb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 ';
        $order = '';
        $arr = $this->list_read_base($table, $field, $where, $order);
//        $arr = $this->search ;
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
     * info_interview:邀请面试功能.
     * @param $cid: 企业id.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:0（失败）或其他数字（成功，新信息的id）.
     */
    function info_interview($cid) {
        $tmp = $this->info_save_load();
        for($i=0;$i<count($tmp['arr_rid']);$i++){
            if($this->info_isinterview($cid, $tmp['arr_rid'][$i])){
                $arr = '0'; //已存在
            } else {
                $arr_c =  $this->xdb->read_one($this->ctb, '*', 'id='. $cid);
                $arr_j =  $this->xdb->read_one($this->btb, '*', 'id='. $tmp['j_id']);
                $arr_r =  $this->xdb->read_one($this->xtb, '*', 'id='. $tmp['arr_rid'][$i]);
                $arr_p =  $this->xdb->read_one($this->dtb, '*', 'id='. $arr_r['p_id']);
                $this->xdb->insert($this->atb, 'c_id, j_id, r_id, p_id, l_id, c_name, j_name, r_name, p_name, l_name, i_txt0, i_txt3, i_type, i_time, atime', '"' .$cid . '", "' . $tmp['j_id'] . '", "' . $arr_r['id'] . '", "' . $arr_p['id'] . '", "", "' . $arr_c['fname'] . '", "' . $arr_j['name'] . '", "' . $arr_r['rname'] . '", "' . $arr_p['name'] . '", "", "' . $tmp['i_txt0'] . '", "' . $tmp['i_txt4'] . '", "c_interview", "' . $tmp['i_time'] . '", "' . i_time() .'" ');
                $arr = '1';//添加成功
            }
        }
        $this->print_arr($arr);
        return $arr;
    }

     /**
     * info_isinterview:简历是否已被邀请.
     * @param $cid: 企业id.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:0（失败）或其他数字（成功，新信息的id）.
     */
     function info_isinterview($cid, $xid) {
        $table = $this->atb. ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND x.r_id="' . $xid . '" AND x.i_type="c_interview" AND x.c_id="' . $cid . '"';
        $arr = $this->info_read_base($table, $field, $where);
        if($arr) {
            return true;
        } else {
            return false;
        }
    }

     /**
     * info_fav:收藏简历功能.
     * @param $cid: 企业id.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:0（失败）或其他数字（成功，新信息的id）.
     */
    function info_fav($cid) {
        $tmp = $this->info_save_load();
        for($i=0;$i<count($tmp);$i++){
            if($this->info_isfav($cid, $tmp[$i])){
                $arr = '0'; //已存在
            } else {
                $this->xdb->insert($this->atb, 'c_id, j_id, r_id, p_id, l_id, c_name, j_name, r_name, p_name, l_name, i_type, i_time, i_state', '"' . $cid . '", "", "' . $arr_info['id'] . '", "' . $arr_info['p_id'] . '", "", "", "", "' . $arr_info['rname'] . '", "' . $arr_info['name'] . '", "", "c_favorite", "' . i_time(). '","' . $arr_info['i_state'] .'" ');
                $arr = '1';//添加成功
            }

        }
        $this->print_arr($arr);
        return $arr;
    }

     /**
     * info_isfav:简历是否已被收藏.
     * @param $cid: 企业id.
     * @param $xid: 简历id.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:0（失败）或其他数字（成功，新信息的id）.
     */
     function info_isfav($cid, $xid) {
        $table = $this->atb. ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND x.c_id="' . $cid . '" AND x.r_id="' . $xid . '" AND x.i_type="c_favorite" ';
        $arr = $this->info_read_base($table, $field, $where);
        if($arr) {
            return true;
        } else {
            return false;
        }
    }

    function  info_resume(){
        $tmp = $this->info_save_load();
        $arr = array();
        for($i=0;$i<count($tmp);$i++){
            $table = $this->xtb . ' AS x ';
            $field = ' * ';
            $where = ' x.drwx=0 AND id="' . $tmp[$i] . '" ';
            $arr_info = $this->info_read_base($table, $field, $where);
            $arr[$tmp[$i]] = $arr_info['name'];
        }
        $this->print_arr($arr, 1);
        return $arr;
    }

    function  info_init($cid) {
        $arr = array();
        $result_arr = $this->xdb->read_one($this->ctb, '*', 'id="' . $cid . '"');
        $arr['id'] = $result_arr['id'];
        $arr['fname'] = $result_arr['fname'];
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

    function info_pv() {
        $rid = $_GET['rid'];
        if('' != $rid) {
            $arr_info = $this->xdb->read_one($this->xtb, ' * ', 'id="' .$rid . '"');
            $browse_num = $arr_info['browse_num'] + 1;
            $this->xdb->update($this->xtb, ' browse_num="' . $browse_num . '" ', 'id="' .$rid . '"');
        }

        $arr = '1';
        $this->print_arr($arr);
        return $arr;
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

    function info_session() {
        $arr = $_SESSION['c_id'];
        $this->print_arr($arr);
        return $arr;
    }

}
?>