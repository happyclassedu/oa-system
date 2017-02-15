<?php
/**
 * 文件名称：mod_job.php
 * 功能描述：（企业）职位管理（英才网）模型
 * 代码作者：王争强
 * 创建日期：2010-08-06
 * 修改日期：2010-08-06
 * 当前版本：V1.0
 */

i_mod_base_info();

class mod_job extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__zpw_j';
        $this->atb = '#@__zpw_c';
        $this->btb = '#@__zpw_x';
        $this->ctb = '#@__zpw_r';
        $this->dtb = '#@__zpw_r_i';
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);
        if ('' != $this->val_search) {
            $this->search = '';
            foreach ($this->val_search as $key => $val) {
                if ('' != $val) {
                    $this->search .= ' AND x.' . $key . ' LIKE "%' . $val . '%" ';
                }
            }
        }else {
            $this->search = '';
        }
    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read($cid) {
        $table = $this->xtb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND x.cid=' . $cid . ' ';
        $order = 'ORDER BY x.atime DESC';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num($cid) {
        $table = $this->xtb . ' AS x ';
        $where = ' x.drwx=0 AND cid=' . $cid . ' ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * list_read_zws : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_zws() {
        $table = $this->xtb . ' AS x
        LEFT JOIN (SELECT * FROM (SELECT * FROM ' . $this->atb . ' WHERE drwx=0 ORDER BY oid DESC) AS tmp GROUP BY id) AS y ON y.id=x.cid';
        $field = ' x.*, y.fname, y.address ';
        $where = ' x.drwx=0 AND x.zwstate="已激活" ';
        $order = '';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num_zws : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num_zws() {
        $table = $this->xtb . ' AS x ';
        $where = ' x.drwx=0 AND x.zwstate="已激活" ';
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
     * info_refresh:将职位的更新时间修改为当前时间，使职位在搜索结果中排名靠前，提高招聘效果.
     */
    function info_refresh() {
        $this->info_batch_manage('info_refresh');
    }

    /**
     * info_open:对“已屏蔽”的职位重新进行招聘.
     */
    function info_open() {
        $this->info_batch_manage('info_open');
    }

    /**
     * info_close:对“暂时不需要招聘”的职位进行隐藏，以后如果需要招聘时再激活该职位即可；.
     */
    function info_close() {
        $this->info_batch_manage('info_close');
    }

    /**
     * info_release:重新发布 - 将职位以当天为开始日期，截止日期自动改为新的开始日期加上职位有效期天数;
     */
    function info_release() {
        $this->info_batch_manage('info_release');
    }
    /**
     * info_delete:对“已经招聘完成”，可同时删除多个职位.
     */

    function info_delete() {
        $this->info_batch_manage('info_delete');
    }

    /**
     * info_batch_manage:对职位进行批量处理.
     * @param $act:批量处理的操作行为：update, delect.
     * @param $fields:修改的字段及对应的值.
     * @param $arr:需保存的信息数组.
     * @return $arr:0（失败）或1（成功）.
     */

    function info_batch_manage($act) {
        $tmp = $this->info_save_load();

        if('' == $tmp) {
            $arr = 0; //请选择ID
        }else {
            for($i=0;$i<count($tmp);$i++) {
                switch ($act) {
                    case 'info_release':
                        $table = $this->xtb . ' AS x ';
                        $field = ' * ';
                        $where = ' x.drwx=0 AND id="' . $tmp[$i] . '" ';
                        $arr_info = $this->info_read_base($table, $field, $where);
                        if((strtotime(i_time()) <= strtotime($arr_info['end'])) && (strtotime(i_time()) >= strtotime($arr_info['begin']))) {
                            $this->xdb->update($this->xtb, 'begin="' .i_time() . '"', 'id="' . $tmp[$i] . '"');
                        } else {
                            $this->xdb->update($this->xtb, 'begin="' .i_time() . '", end="' .i_time() . '"', 'id="' . $tmp[$i] . '"');
                        }
                        $arr = 1;
//                        $arr= 'i_time:'. strtotime(i_time()) .'-----begin:' . strtotime($arr_info['begin']) . '-------end:' . strtotime($arr_info['end']);
                        break;
                    case 'info_refresh':
                        $this->xdb->update($this->xtb, 'atime="' .i_time() . '"', 'id="' . $tmp[$i] . '"');
                        $arr = 1;
                        break;
                    case 'info_open':
                        $this->xdb->update($this->xtb, 'zwstate="已激活"', 'id="' . $tmp[$i] . '"');
                        $arr = 1;
                        break;
                    case 'info_close':
                        $this->xdb->update($this->xtb, 'zwstate="已屏蔽"', 'id="' . $tmp[$i] . '"');
                        $arr = 1;
                        break;
                    case 'info_delete':
                        $this->info_del($tmp[$i]);
                        $arr = 1;
                        break;
                }
            }
        }

        $this->print_arr($arr);
        return $arr;
    }


         /**
     * list_read_favorite : 根据条件读取list的信息的内容.
     * @param $pid:信息id.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_favorite($pid) {
        $table = $this->xtb . ' AS x
         , (SELECT * FROM (SELECT * FROM ' . $this->btb . ' WHERE drwx=0 AND i_type="p_favorite" AND p_id="' . $pid . '" ORDER BY oid DESC) AS tmp GROUP BY id) AS y';
        $field = ' x.begin, x.end, y.* ';
        $where = ' x.drwx=0 AND  y.j_id=x.id ';
        $order = '';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num_favorite : 根据条件读取list的信息总条数.
     * @param $pid:信息id.
     * @return $arr : 空or记录数.
     */
    function list_num_favorite($pid) {
        $table = $this->xtb . ' AS x
         , (SELECT * FROM (SELECT * FROM ' . $this->btb . ' WHERE drwx=0 AND i_type="p_favorite" AND p_id="' . $pid . '" ORDER BY oid DESC) AS tmp GROUP BY id) AS y';
        $where = ' x.drwx=0 AND  y.j_id=x.id ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

     /**
     * info_favorite:将职位收藏.
     */
    function info_favorite() {
        $this->batch_manage_job();
    }


      /**
     * batch_manage_job:对职位进行批量处理.
     * @param $act:批量处理的操作行为：update, delect.
     * @param $fields:修改的字段及对应的值.
     * @param $arr:需保存的信息数组.
     * @return $arr:0（失败）或1（成功）.
     */

    function batch_manage_job(){
        $tmp = $this->info_save_load();
        $pid = $_GET['p_id'];
        for($i=0;$i<count($tmp);$i++){
            if($this->info_isfavorite($tmp[$i])){
                $arr = '0'; //已存在
            } else {
                $arr_info = $this->info_jinfo($tmp[$i]);
                $this->xdb->insert($this->btb, 'c_id, j_id, p_id, c_name, j_name, p_name, i_type, i_time', '"' .$arr_info['cid'] . '", "' . $arr_info['id'] . '", "' . $pid . '", "' . $arr_info['cname'] . '", "' . $arr_info['name'] . '", "' . $_SESSION['name'] . '", "p_favorite", "' . i_time(). '" ');
                $arr = '1';//添加成功
            }
        }
        $this->print_arr($arr);
        return $arr;
    }

    function info_jinfo($xid){
        $table = $this->xtb. ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND x.id="' . $xid . '" ';
        $arr = $this->info_read_base($table, $field, $where);
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

     /**
     * list_read_arr : 申请的职位列表.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_arr() {
        $arr_app = $_GET['arr'];
        $arr_app =  i_json2php($arr_app);
        $str = '';
        $row = count($arr_app);
        for($i=0; $i< $row; $i++) {
            $str .= ' x.id='. $arr_app[$i] . ' ';
            if($i < ($row-1)){
                 $str .= ' OR  ';
            }
        }
        $table = $this->xtb . ' AS x
        LEFT JOIN (SELECT * FROM (SELECT * FROM ' . $this->atb . ' WHERE drwx=0 ORDER BY oid DESC) AS tmp GROUP BY id) AS y ON y.id=x.cid';
        $field = ' x.*, y.fname, y.address';
        $where = ' x.drwx=0  AND ' . $str;
        $order = '';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_read_resume : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_resume($pid) {
        $table = $this->ctb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND x.p_id="' . $pid . '" ';
        $order = ' ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

      /**
     * list_read_letter : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
     function list_read_letter($pid) {
        $type = $_GET['type'];
        $table = $this->dtb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND x.p_id="' .$pid .  '" AND x.i_type="' . $type . '"';
        $order = '';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

          /**
     * info_eavoritd:对职位进行批量申请.
     * @param $fields:修改的字段及对应的值.
     * @param $arr:需保存的信息数组.
     * @return $arr:0（失败）或1（成功）.
     */

    function info_eavoritd($pid){
        $tmp = $this->info_save_load();
        $rid = $_GET['r_id']; //简历ID
        $lid = $_GET['l_id'];//求职信ID
        $arr_r = $this->info_get($rid, $this->ctb);
        $arr_l = $this->info_get($lid, $this->dtb);

        for($i=0;$i<count($tmp);$i++){
            $arr_x = $this->info_iseavoritd($rid, $pid, $tmp[$i]);
            $arr_j = $this->info_get($tmp[$i], $this->xtb);
            if('' == $arr_x){
                $this->xdb->insert($this->btb, 'c_id, j_id, r_id, p_id, l_id, c_name, j_name, r_name, p_name, l_name, i_type, i_time', '"' .$arr_j['cid'] . '", "' . $arr_j['id'] . '", "' . $rid . '", "' . $pid . '", "' . $lid .  '", "' . $arr_j['cname'] . '", "' . $arr_j['name'] . '", "' . $arr_r['rname'] . '", "' . $arr_r['name'] . '", "' . $arr_l['name'] . '", "p_eavoritd", "' . i_time(). '" ');

                //应聘次数
                $apply_num = $this->xdb->read_one($this->xtb, ' * ', 'id="' .$arr_j['id'] . '"');
                $apply_num = $arr_info['apply_num'] + 1;
                $this->xdb->update($this->xtb, 'apply_num="' .$apply_num . '"', ' id="' .  $arr_j['id'] . '" ');

                $arr = '1';//添加成功
            } elseif(24 < floor(abs(strtotime($arr_x['i_time'])-strtotime(i_time()))/(3600))) {
                $this->xdb->update($this->btb, 'i_time="' .i_time() . '", l_id="' . $lid  . '"', ' drwx=0 AND r_id="' .  $rid . '"  AND p_id="' .  $pid . '" AND j_id="' .  $arr_j['id'] . '" AND i_type="p_eavoritd" ');

                //应聘次数
                $apply_num = $this->xdb->read_one($this->xtb, ' * ', 'id="' .$arr_j['id'] . '"');
                $apply_num = $arr_info['apply_num'] + 1;
                $this->xdb->update($this->xtb, 'apply_num="' .$apply_num . '"', ' id="' .  $arr_j['id'] . '" ');
                $arr = '2'; //24小时之外，修改申请信息。
            } elseif(24 > floor(abs(strtotime($arr_x['i_time'])-strtotime(i_time()))/(3600))) {
                $arr = '3'; //24小时之内，不能继续申请同一职位。
            } else {
                $arr = '0'; //出错
            }
        }
        $this->print_arr($arr);
        return $arr;
    }
       /**
     * info_iseavoritd:24小时之内不能继续申请职位.
     * @param $fields:修改的字段及对应的值.
     * @param $arr:需保存的信息数组.
     * @return $arr:0（失败）或1（成功）.
     */
    function info_iseavoritd($rid, $pid, $jid) {
        $table = $this->btb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND r_id="' .  $rid . '"  AND p_id="' .  $pid . '" AND j_id="' .  $jid . '" AND x.i_type="p_eavoritd" ';
        $arr = $this->info_read_base($table, $field, $where);
        return $arr;
    }

    /**
     * info_get:根据$xid读取一条信息内容.
     * @param $xid:信息id.
     * @param $xtb:数据库的表名.
     * @return $arr:空or数组加密后的字符串.
     */
    function info_get($xid, $xtb) {
        i_xid_check($xid);
        $table = $xtb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND id="' . $xid . '" ';
        $arr = $this->info_read_base($table, $field, $where);
        return $arr;
    }

    /**
     * list_read_applist : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_applist($pid) {
        $table = $this->xtb . ' AS x
         , (SELECT * FROM (SELECT * FROM ' . $this->btb . ' WHERE drwx=0 AND i_type="p_eavoritd" AND p_id="' . $pid . '" ORDER BY oid DESC) AS tmp GROUP BY id) AS y';
        $field = ' x.begin, x.end, y.* ';
        $where = ' x.drwx=0 AND  y.j_id=x.id ';
        $order = '';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num_applist : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num_applist($pid) {
        $table = $this->xtb . ' AS x
         , (SELECT * FROM (SELECT * FROM ' . $this->btb . ' WHERE drwx=0 AND i_type="p_eavoritd" AND p_id="' . $pid . '" ORDER BY oid DESC) AS tmp GROUP BY id) AS y';
        $where = ' x.drwx=0 AND  y.j_id=x.id ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

      /**
     * info_com:根据$xid读取一条信息内容.
     * @param $xid:信息id.
     * @param $xtb:数据库的表名.
     * @return $arr:空or数组加密后的字符串.
     */
    function info_com($xid) {
        i_xid_check($xid);
        $table = $this->atb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND id="' .  $xid . '" ';
        $arr = $this->info_read_base($table, $field, $where);
        $this->print_arr($arr, 1);
        return $arr;
    }

       /**
     * info_del_batch:根据$xid进行信息的软删除.
     * @param $xid:信息id.
     * @return $arr:0（失败）或1（成功）.
     */
    function info_del_batch() {
        $arr_x = i_json2php($_POST['arr']);
        if('' != $arr_x && isset($arr_x)){
            for($i=0 ; $i < count($arr_x) ; $i++ ) {
                $this->xdb->update($this->btb, 'drwx="4"', 'id="' . $arr_x[$i] . '"');
            }
            $arr = 1;
        } else {
            $arr = 0;//为空，请选择
        }

        $this->print_arr($arr);
        return $arr;
    }

     /**
     * list_read_invite : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_invite($pid) {
        $table = $this->btb . ' AS x';
        $field = ' x.* ';
        $where = ' x.drwx=0 AND  x.i_type="c_interview" AND x.p_id="' . $pid . '" ';
        $order = '';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num_invite : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num_invite($pid) {
        $table = $this->btb . ' AS x';
        $where = ' x.drwx=0 AND  x.i_type="c_interview" AND x.p_id="' . $pid . '" ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

    function info_pv() {
        $jid = $_GET['jid'];
        $id = $_GET['id'];
        if('' != $jid) {
            $arr_info = $this->xdb->read_one($this->xtb, ' * ', 'id="' .$jid . '"');
            $browse_num = $arr_info['browse_num'] + 1;
            $this->xdb->update($this->xtb, ' browse_num="' . $browse_num . '" ', 'id="' .$jid . '"');
        }

        if('' != $id) {
            //读过的状态为1
            $this->xdb->update($this->btb, 'i_state="1"', 'id="' .$id . '"');
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
}
?>