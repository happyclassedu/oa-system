<?php
/**
 * 文件名称：mod_resume_x.php
 * 功能描述：人才网（企业）简历关系模型
 * 代码作者：王争强
 * 创建日期：2010-08-23
 * 修改日期：2010-08-23
 * 当前版本：V1.0
 */

i_mod_base_info();

class mod_resume_x extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__zpw_x';  //个企关系表
        $this->atb = '#@__zpw_r';  //简历表
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
        $table = $this->atb . ' AS x
         , (SELECT * FROM (SELECT * FROM ' . $this->xtb . ' WHERE drwx=0 AND i_type="p_eavoritd" AND c_id="' . $cid . '" ORDER BY oid DESC) AS tmp GROUP BY id) AS y';
        $field = ' x.name, x.sex, x.degree, y.*  ';
        $where = ' x.drwx=0 AND  y.r_id=x.id  ';
        $order = ' ';
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
        $where = '  x.drwx=0 AND  x.i_type="p_eavoritd" AND x.c_id="' . $cid . '"';
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
        $where = ' x.drwx=0 AND x.id="' . $xid . '" ';
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
     * list_read_interview : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_interview($cid) {
        $table = $this->atb . ' AS x
         , (SELECT * FROM (SELECT * FROM ' . $this->xtb . ' WHERE drwx=0 AND i_type="c_interview" AND c_id="' . $cid . '" ORDER BY oid DESC) AS tmp GROUP BY id) AS y';
        $field = ' x.name, x.sex, x.degree, y.*  ';
        $where = ' x.drwx=0  AND  y.r_id=x.id  ';
        $order = ' ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num_interview : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num_interview($cid) {
        $table = $this->xtb . ' AS x ';
        $where = '  x.drwx=0 AND x.i_type="c_interview" AND x.c_id="' . $cid . '"';
        $arr = $this->list_num_base($table, $where);
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
        for($i=0;$i<count($tmp);$i++){

            $table = $this->xtb . ' AS x ';
            $field = ' * ';
            $where = ' x.drwx=0 AND x.id="' . $tmp[$i] . '" AND x.c_id="' . $cid . '"';
            $arr_info = $this->info_read_base($table, $field, $where);

            if($this->info_isinterview($arr_info['c_id'], $arr_info['r_id'])){
                $arr = '0'; //已存在
            } else {
                $this->xdb->insert($this->xtb, 'c_id, j_id, r_id, p_id, l_id, c_name, j_name, r_name, p_name, l_name, i_type, atime', '"' .$arr_info['c_id'] . '", "' . $arr_info['j_id'] . '", "' . $arr_info['r_id'] . '", "' . $arr_info['p_id'] . '", "' . $arr_info['l_id'] .  '", "' . $arr_info['c_name'] . '", "' . $arr_info['j_name'] . '", "' . $arr_info['r_name'] . '", "' . $arr_info['p_name'] . '", "' . $arr_info['l_name']  . '", "c_interview", "' . i_time() . '" ');
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
        $table = $this->xtb. ' AS x ';
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

            $table = $this->xtb . ' AS x ';
            $field = ' * ';
            $where = ' x.drwx=0 AND x.id="' . $tmp[$i] . '" AND x.c_id="' . $cid . '" ';
            $arr_info = $this->info_read_base($table, $field, $where);
            
            if($this->info_isfav($arr_info['c_id'],$arr_info['r_id'])){
                $arr = '0'; //已存在
            } else {
                $this->xdb->insert($this->xtb, 'c_id, j_id, r_id, p_id, l_id, c_name, j_name, r_name, p_name, l_name, i_type, i_time, i_state', '"' . $arr_info['c_id'] . '", "' . $arr_info['j_id'] . '", "' . $arr_info['r_id'] . '", "' . $arr_info['p_id'] . '", "' . $arr_info['l_id'] .  '", "' . $arr_info['c_name'] . '", "' . $arr_info['j_name'] . '", "' . $arr_info['r_name'] . '", "' . $arr_info['p_name'] . '", "' . $arr_info['l_name'] . '", "c_favorite", "' . i_time(). '","' . $arr_info['i_state'] .'" ');
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
        $table = $this->xtb. ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND x.c_id="' . $cid . '" AND x.r_id="' . $xid . '" AND x.i_type="c_favorite" ';
        $arr = $this->info_read_base($table, $field, $where);
        if($arr) {
            return true;
        } else {
            return false;
        }
    }

     /**
     * info_database:入库简历功能.
     * @param $cid: 企业id.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:0（失败）或其他数字（成功，新信息的id）.
     */
    function info_database($cid) {
        $tmp = $this->info_save_load();
        for($i=0;$i<count($tmp);$i++){

            $table = $this->xtb . ' AS x ';
            $field = ' * ';
            $where = ' x.drwx=0 AND x.id="' . $tmp[$i] . '" AND x.c_id="' . $cid . '" ';
            $arr_info = $this->info_read_base($table, $field, $where);

            if($this->info_isdb($arr_info['c_id'], $arr_info['r_id'])){
                $arr = '0'; //已存在
            } else {
                $this->xdb->insert($this->xtb, 'c_id, j_id, r_id, p_id, l_id, c_name, j_name, r_name, p_name, l_name, i_type, i_time, i_state', '"' .$arr_info['c_id'] . '", "' . $arr_info['j_id'] . '", "' . $arr_info['r_id'] . '", "' . $arr_info['p_id'] . '", "' . $arr_info['l_id'] .  '", "' . $arr_info['c_name'] . '", "' . $arr_info['j_name'] . '", "' . $arr_info['r_name'] . '", "' . $arr_info['p_name'] . '", "' . $arr_info['l_name'] . '", "c_database", "' . i_time(). '","' . $arr_info['i_state'] .'" ');
                $arr = '1';//添加成功
            }

        }
        $this->print_arr($arr);
        return $arr;
    }

     /**
     * info_isdb:简历是否已被入库.
     * @param $cid: 企业id.
     * @param $xid: 简历id.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:0（失败）或其他数字（成功，新信息的id）.
     */
     function info_isdb($cid, $xid) {
        $table = $this->xtb. ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND x.r_id="' . $xid . '" AND x.i_type="c_database" AND x.c_id="' . $cid . '" ';
        $arr = $this->info_read_base($table, $field, $where);
        if($arr) {
            return true;
        } else {
            return false;
        }
    }

      /**
     * info_recycle:简历.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:0（失败）或其他数字（成功，新信息的id）.
     */
     function info_recycle() {
        $tmp = $this->info_save_load();
        for($i=0;$i<count($tmp);$i++){
            
            if($this->info_isrecycle($tmp[$i])){
                $arr = '0'; //已存在
            } else {
                $this->xdb->update($this->xtb, 'drwx="1", i_time="' . i_time() . '", i_type1="c_recycle"', 'id="' .$tmp[$i] . '"');
                $arr = '1';//到回收站成功
            }
            
        }
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * info_isrecycle:简历是否已到回收站.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:0（失败）或其他数字（成功，新信息的id）.
     */
     function info_isrecycle($xid) {
        $table = $this->xtb. ' AS x ';
        $field = ' * ';
        $where = 'x.drwx="1" AND i_type1="c_recycle" AND x.id="' . $xid . '" ';
        $arr = $this->info_read_base($table, $field, $where);
        if($arr) {
            return true;
        } else {
            return false;
        }
    }

      /**
     * list_read_recycle : 根据条件读取list的信息的内容.
     * @param $cid: 企业id.
     * @return $arr : 空or数组加密后的字符串.AND x.c_id="' . $cid . '"'
     */
    function list_read_recycle($cid) {
        $table = $this->atb . ' AS x
         , (SELECT * FROM (SELECT * FROM ' . $this->xtb . ' WHERE drwx=1 AND i_type1="c_recycle" AND c_id="' . $cid . '" ORDER BY oid DESC) AS tmp GROUP BY id) AS y';
        $field = ' x.name, x.sex, x.degree, x.big_classification, x.small_classification , x.addr, x.work_term, y.*  ';
        $where = ' x.drwx=0 AND  y.r_id=x.id  ';
        $order = ' ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num_recycle : 根据条件读取list的信息总条数.
     * @param $cid: 企业id.
     * @return $arr : 空or记录数.
     */
    function list_num_recycle($cid) {
        $table = $this->xtb . ' AS x ';
        $where = '  x.drwx=1 AND c_id="' . $cid . '" AND x.i_type1="c_recycle" ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * info_read_recycle:根据$xid读取一条信息内容.
     * @param $xid:信息id.
     * @return $arr:空or数组加密后的字符串.
     */

   function info_read_recycle($xid) {
        i_xid_check($xid);
        $table = $this->xtb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=1 AND x.id="' . $xid . '" ';
        $arr = $this->info_read_base($table, $field, $where);
        $this->print_arr($arr, 1);
        return $arr;
    }

     /**
     * info_revert:还原简历.
     * @param $xid:信息id.
     * @return $arr:空or数组加密后的字符串.
     */

   function info_revert() {
        $tmp = $this->info_save_load();
        for($i=0;$i<count($tmp);$i++){
                $this->xdb->update($this->xtb, 'drwx="0", i_time="' . i_time() . '", i_type1=""', 'id="' .$tmp[$i] . '"');
                $arr = '1';//到回收站成功
        }
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * info_del_forever:永久删除.
     * @param $xid:信息id.
     * @return $arr:0（失败）或1（成功）.
     */
    function info_del_forever() {
        $tmp = $this->info_save_load();
        for($i=0;$i<count($tmp);$i++){
                $this->info_del_true_base($tmp[$i]);
                $arr = '1';//到回收站成功
        }
        $this->print_arr($arr);
        return $arr;
    }

      /**
     * list_read_fav : 根据条件读取list的信息的内容.
     * @param $cid: 企业id.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_fav($cid) {
        $table = $this->atb . ' AS x
         , (SELECT * FROM (SELECT * FROM ' . $this->xtb . ' WHERE drwx=0 AND i_type="c_favorite" AND c_id="' . $cid . '" ORDER BY oid DESC) AS tmp GROUP BY id) AS y';
        $field = ' x.name, x.sex, x.degree, x.big_classification, x.small_classification , x.addr, x.work_term, y.*  ';
        $where = ' x.drwx=0 AND y.r_id=x.id  ';
        $order = ' ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num_fav : 根据条件读取list的信息总条数.
     * @param $cid: 企业id.
     * @return $arr : 空or记录数.
     */
    function list_num_fav($cid) {
        $table = $this->xtb . ' AS x ';
        $where = '  x.drwx=0 AND x.c_id="' . $cid . '" AND x.i_type="c_favorite" ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

      /**
     * list_read_database : 根据条件读取list的信息的内容.
     * @param $cid: 企业id.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_database($cid) {
        $table = $this->atb . ' AS x
         , (SELECT * FROM (SELECT * FROM ' . $this->xtb . ' WHERE drwx=0 AND c_id="' . $cid . '"  ORDER BY oid DESC) AS tmp GROUP BY id) AS y';
        $field = ' x.name, x.sex, x.degree, x.big_classification, x.small_classification , x.addr, x.work_term, y.*  ';
        $where = ' x.drwx=0 AND y.i_type="c_database" AND  y.r_id=x.id  ';
        $order = ' ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num_database : 根据条件读取list的信息总条数.
     * @param $cid: 企业id.
     * @return $arr : 空or记录数.
     */
    function list_num_database($cid) {
        $table = $this->xtb . ' AS x ';
        $where = '  x.drwx=0 AND c_id="' . $cid . '" AND x.i_type="c_database" ';
        $arr = $this->list_num_base($table, $where);
        $this->print_arr($arr);
        return $arr;
    }

    function info_pv(){
        $rid = $_GET['rid'];
        $id = $_GET['id'];
        if('' != $rid){
            $arr_info = $this->xdb->read_one($this->atb, ' * ', 'id="' .$rid . '"');
            $browse_num = $arr_info['browse_num'] + 1;
            $this->xdb->update($this->atb, ' browse_num="' . $browse_num . '" ', 'id="' .$rid . '"');
        }
        if('' != $id){
            $this->xdb->update($this->xtb, ' i_state="1" ', 'id="' .$id . '"');
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