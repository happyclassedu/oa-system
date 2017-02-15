<?php
/**
 * 文件名称：mod_resume.php
 * 功能描述：人才网（个人）简历管理模型
 * 代码作者：王争强
 * 创建日期：2010-08-23
 * 修改日期：2010-08-23
 * 当前版本：V1.0
 */

i_mod_base_info();

class mod_resume extends mod_base_info {
    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__zpw_r'; //简历表
        $this->atb = '#@__zpw_x'; //个企关系表
        $this->btb = '#@__zpw_r_i'; //简历子信息表
        $this->ctb = '#@__zpw_p'; //用户表
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
    function list_read($pid) {
        $table = $this->xtb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND x.p_id="' . $pid . '" ';
        $order = ' ';
        $arr = $this->list_read_base($table, $field, $where, $order);

        for($i = 0 ;$i < count($arr); $i++){
            $edu_num = $this->list_rx_num($arr[$i]['id'],'educate');
            $work_num = $this->list_rx_num($arr[$i]['id'],'work');
            $arr[$i]['edu_num'] = $edu_num;
            $arr[$i]['work_num'] = $work_num;
        }
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_num($pid) {
        $table = $this->xtb . ' AS x ';
        $where = ' x.drwx=0 AND x.p_id="' . $pid . '"  ';
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

        //简历等级
        $edu_num = $this->list_rx_num($xid,'educate');
        $work_num = $this->list_rx_num($xid,'work');
        $arr['edu_num'] = $edu_num;
        $arr['work_num'] = $work_num;

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
        if ($arr > 0) {
            $this->xdb->update($this->btb, 'drwx="0"', 'r_id="' . $xid . '"');
        }
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
     * info_test:测试函数.
     * @return $arr:0（失败）或1（成功）.
     */
    function info_test() {
        $arr = $_SESSION['person_id'] . $_SESSION['name'];
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * info_add:新增信息的保存操作.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:0（失败）或其他数字（成功，新信息的id）.
     */
    function info_add($pid) {
        $num = $this->list_num($pid); //限制简历为5条。
        if($num <= 5){
            $arr = $this->info_add_base();
            $tmp = i_json2php($_POST['arr']);
            if('1' == $tmp['resume_def_state']) {
                $this->xdb->update($this->xtb, 'resume_def_state="0"', ' id!="' . $arr .'" AND p_id="' . $pid . '" ');//设置默认简历时，修改该用户的其他简历的默认值
            }
        }
        
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
        $tmp = $this->info_save_load();
        if($tmp){
//            $this->xdb->update($this->xtb, 'job_day="' . i_time() . '"', ' id="' . $xid . '" ');
            if ('1' == $tmp['resume_def_state']) {
                $this->xdb->update($this->xtb, 'resume_def_state="0"', ' id!="' . $xid .'" AND p_id="' . $pid . '" ');//设置默认简历时，修改该用户的其他简历的默认值
            }   
        }
        $this->print_arr($arr);
        return $arr;
    }

    /**
     * list_read_i : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_num_i($rid, $type) {
        $table = $this->btb . ' AS x ';
        $where = ' x.drwx=0 AND x.r_id="' .$rid .  '" AND x.i_type="' . $type . '"';
        $arr = $this->list_num_base($table, $where);
        return $arr;
    }

    function info_init($pid){
        $arr = array();
        $result_arr = $this->xdb->read_one($this->ctb, '*', 'id="' . $pid . '"');
        $arr['loginid'] = $result_arr['loginid'];
        $arr['info_num'] = $this->xdb->read_num($this->xtb, 'drwx=0 AND p_id=' . $pid);
        $this->print_arr($arr, 1);
        return $arr;
    }

       /**
     * list_read_i : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read_i() {
        $rid = $_GET['rid'];
        $type = $_GET['type'];
        $table = $this->btb . ' AS x ';
        $field = ' * ';
        $where = ' x.drwx=0 AND x.r_id="' .$rid .  '" AND x.i_type="' . $type . '" AND x.open="1" ';
        $order = '';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_rx_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
    function list_rx_num($rid, $type) {
        $table = $this->btb . ' AS x ';
        $where = ' x.drwx=0 AND x.r_id="' .$rid .  '" AND x.i_type="' . $type . '"';
        $arr = $this->list_num_base($table, $where);
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

    /**
     * info_session:返回session值.
     * @param $arr:返回值.
     * @return .
     */
    function info_session() {
        $arr = $_SESSION['p_id'];
        $this->print_arr($arr);
        return $arr;
    }
}
?>