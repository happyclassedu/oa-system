<?php
/**
 * 文件名称：mod_hoh.php
 * 功能描述：户籍业务操作模型
 * 代码作者：王争强
 * 创建日期：2010-07-29
 * 修改日期：2010-07-29
 * 当前版本：V1.0
 */

i_mod_base_info();

class mod_hoh extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__plog';
        $this->ytb = '#@__pinfo';
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);

        if ('' != $this->val_search) {
            $this->search =
               ' AND x.pname LIKE "%' . $this->val_search['pname'] . '%"
                AND x.uname LIKE "%' . $this->val_search['uname'] . '%"
                AND x.yname LIKE "%' . $this->val_search['yname'] . '%" ';
        } else {
            $this->search = '';
        }

    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        $table = $this->xtb . ' AS x ';
        $field = ' x.id, x.time, x.pid, x.pname, x.uname, x.yname, x.ytype, x.operating_record';
        $where = ' x.drwx=0 ';
        $order = 'ORDER BY x.id DESC ';
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
        $where = 'id="' . $xid . '" ';
        $arr = $this->info_read_base($table, $field, $where);
        $this->print_arr($arr, 1);
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
      // 查出存档人id
        i_xid_check($arr);
        $x_arr = $this->info_read_base($this->xtb . ' AS x ', ' * ', 'id="' . $arr . '" ');

      //根据存档人id查询医保登记表相应的个人信息
        $info = $this->info_read_base($this->ytb . ' AS y ',  ' * ', 'id="' . $x_arr['pid'] . '" ');
        if ('迁出户籍关系' == $x_arr['yname'] || '迁入户籍关系' == $x_arr['yname']) {
            if ('在库' ==  $info['hjstate']) {
      //迁出
                $this->xdb->update($this->ytb, 'hjstate="转出"',  'id="' . $x_arr['pid'] . '"');
            }elseif ('迁出' ==  $info['hjstate']) {
     //迁入
                $this->xdb->update($this->ytb, 'hjstate="在库"',  'id="' . $x_arr['pid'] . '"');
            }
        }elseif ('借出户籍卡' == $x_arr['yname'] || '归还户籍卡' == $x_arr['yname']) {
            if ('在库' ==  $info['hjstate']) {
     //借出
                $this->xdb->update($this->ytb, 'hjstate="借出"',  'id="' . $x_arr['pid'] . '"');
            }elseif ('借出' ==  $info['hjstate']) {
     //归还
                $this->xdb->update($this->ytb, 'hjstate="在库"',  'id="' . $x_arr['pid'] . '"');
            }
        }elseif ('办理计生证明' == $x_arr['yname']) {
            if ('未婚' ==  $x_arr['inbreed_state']) {
     //未婚
                $this->xdb->update($this->ytb, 'inbreed_state="未婚", iaddress="' . $x_arr['iaddress'] . '", getm_time="' . $x_arr['getm_time'] . '", getm_shop="' . $x_arr['getm_shop'] . '", inbreed_birth_1="' . $x_arr['inbreed_birth_1'] .'", inbreed_birth_2="' . $x_arr['inbreed_birth_2'] .'", iremake="' . $x_arr['iremake'] . '"',  'id="' . $x_arr['pid'] . '"');
            }elseif ('初婚未育' ==  $x_arr['inbreed_state']) {
     //初婚未育
                $this->xdb->update($this->ytb, 'inbreed_state="初婚未育", iaddress="' . $x_arr['iaddress'] . '", getm_time="' . $x_arr['getm_time'] . '", getm_shop="' . $x_arr['getm_shop'] . '", inbreed_birth_1="' . $x_arr['inbreed_birth_1'] .'", inbreed_birth_2="' . $x_arr['inbreed_birth_2'] .'", iremake="' . $x_arr['iremake'] . '"',  'id="' . $x_arr['pid'] . '"');
            }elseif ('已婚已育' ==  $x_arr['inbreed_state']) {
     //已婚已育
                $this->xdb->update($this->ytb, 'inbreed_state="已婚已育", iaddress="' . $x_arr['iaddress'] . '", getm_time="' . $x_arr['getm_time'] . '", getm_shop="' . $x_arr['getm_shop'] . '", inbreed_birth_1="' . $x_arr['inbreed_birth_1'] .'", inbreed_birth_2="' . $x_arr['inbreed_birth_2'] .'", iremake="' . $x_arr['iremake'] . '"',  'id="' . $x_arr['pid'] . '"');
            }
        }
        $this->print_arr($arr);
        return $arr;
    }

    function info_init($xid) {
        i_xid_check($xid);
        $table = $this->ytb . ' AS x ';
        $field = 'x.id,  x.cname, x.hjstate, x.mobile, x.sex, x.minzu, x.hukou, x.cardid, x.getm_time, x.getm_shop, x.inbreed_birth_1, ((YEAR(CURDATE())-YEAR(x.birth)) - (RIGHT(CURDATE(),5)<RIGHT(x.birth,5))) AS age, x.inbreed_state, x.iaddress, x.getm_time, x.getm_shop, x.inbreed_birth_1, x.inbreed_birth_2, x.iremake';
        $where = 'x.id="' . $xid . '" ';
        $info = $this->info_read_base($table, $field, $where);
        $arr = array(
                'pid' => $info['id'] ,
                'pname' => $info['cname'] ,
                'mobile' =>  $info['mobile'] ,
                'uid' => u_id ,
                'uname' => u_name ,
                'ytype' => '户籍管理' ,
                'hjstate'  => $info['hjstate'] ,
                'age' => $info['age'],
                'inbreed_state' => $info['inbreed_state'],
                'iaddress' => $info['iaddress'],
                'getm_time' => $info['getm_time'],
                'getm_shop' => $info['getm_shop'],
                'inbreed_birth_1' => $info['inbreed_birth_1'],
                'inbreed_birth_2' => $info['inbreed_birth_2'],
                'iremake' => $info['iremake'],
                'sex' => $info['sex'],
                'minzu' => $info['minzu'],
                'hukou' => $info['hukou'],
                'cardid' => $info['cardid'],
                'getm_time' => $info['getm_time'],
                'getm_shop' => $info['getm_shop'],
                'inbreed_birth_1' => $info['inbreed_birth_1'],
                'time' => i_time(),
        );
        $this->print_arr($arr, 1);
        return $arr;
    }
}
?>