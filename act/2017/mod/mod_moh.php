<?php
/**
 * 文件名称：mod_moh.php
 * 功能描述：医保业务操作模型
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改日期：2010-07-13
 * 当前版本：V1.0
 */

i_mod_base_info();

class mod_moh extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__medi_plog';
        $this->ytb = '#@__medi_info';
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);
       
        if ('' != $this->val_search) {
            $this->search =
                ' AND x.pname LIKE "%' . $this->val_search['pname'] . '%"
                AND y.medi_state LIKE "%' . $this->val_search['medi_state'] . '%"
                AND y.idcard LIKE "%' . $this->val_search['idcard'] . '%"
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
        $table = $this->xtb . ' AS x
        LEFT JOIN (SELECT * FROM (SELECT * FROM ' . $this->ytb . ' ORDER BY oid DESC) AS tmp GROUP BY id) AS y ON y.id = x.pid';
        $field = ' x.id, x.pid, x.pname, x.yname, x.ytext, y.medi_code, y.medi_state, y.idcard';
        $where = ' x.drwx=0 ';
        $order = ' ';
        $arr = $this->list_read_base($table, $field, $where, $order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    /**
     * list_num : 根据条件读取list的信息总条数.
     * @return $arr : 空or记录数.
     */
     function list_num() {
        $table = $this->xtb . ' AS x LEFT JOIN (SELECT * FROM (SELECT * FROM ' . $this->ytb . ' ORDER BY oid DESC) AS tmp GROUP BY id) AS y ON y.id = x.pid';
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
        $info = $this->info_read_base($this->ytb . ' AS y ',  ' * ', ' y.drwx=0 AND id="' . $x_arr['pid'] . '" ');
        if('办理医保卡' == $x_arr['yname'] || '领取医保卡' == $x_arr['yname']) {
            if('未办理' ==  $info['medi_card_state']) {
//已办理
                $this->xdb->update($this->ytb, 'medi_card_state="已办理"',  'id="' . $info['id'] . '"');
            }elseif ('已办理' ==  $info['medi_card_state']) {
//已领取
                $this->xdb->update($this->ytb, 'medi_card_state="已领取"',  'id="' . $info['id'] . '"');
            }
        }elseif ('办理医保本' == $x_arr['yname'] || '领取医保本' == $x_arr['yname']) {
            if ('未办理' ==  $info['medi_book_state']) {
//已办理
                $this->xdb->update($this->ytb, 'medi_book_state="已办理"',  'id="' . $info['id'] . '"');
            }elseif ('已办理' ==  $info['medi_book_state']) {
//已领取
                $this->xdb->update($this->ytb, 'medi_book_state="已领取"',  'id="' . $info['id'] . '"');
            }
        }elseif ('转出医疗保险' == $x_arr['yname'] || '转入医疗保险' == $x_arr['yname']) {
            if ('在库' ==  $info['medi_state']) {
//转出
                $this->xdb->update($this->ytb, 'medi_state="转出"',  'id="' . $info['id'] . '"');
            }elseif ('转出' ==  $info['medi_state']) {
//在库
                $this->xdb->update($this->ytb, 'medi_state="在库"',  'id="' . $info['id'] . '"');
            }
        } elseif ('退休' == $x_arr['yname']) {
            if ('在库' ==  $info['medi_state']) {
//退休
                $this->xdb->update($this->ytb, 'medi_type="退休"',  'id="' . $info['id'] . '"');
            }
        } elseif ('医保缴费' == $x_arr['yname']) {
            //修改截止日期
            if('0000-00-00' != $x_arr['fee_end']){
                 $this->xdb->update($this->ytb, 'pay_deadtime="' . $x_arr['fee_end'] . '"',  'id="' . $info['id'] . '"');
            }  
        }

        $this->print_arr($arr);
        return $arr;
    }

    function info_init($xid ) {
        i_xid_check($xid);
        $table = $this->ytb . ' AS x ';
        $field = 'x.id,  x.name, x.medi_type, x.medi_state, x.medi_book_state, x.medi_card_state, x.tel_1, ((YEAR(CURDATE())-YEAR(x.birth)) - (RIGHT(CURDATE(),5)<RIGHT(x.birth,5))) AS age ';
        $where = ' x.drwx=0 AND id="' . $xid . '" ';
        $info = $this->info_read_base($table, $field, $where);
        $arr = array(
                'pid' => $info['id'] ,
                'pname' => $info['name'] ,
                'tel_1' =>  $info['tel_1'] ,
                'uid' => u_id ,
                'uname' => u_name ,
                'ytype' => '医保管理' ,
                'medi_type'  => $info['medi_type'] ,
                'medi_state' => $info['medi_state'],
                'medi_book_state' => $info['medi_book_state'],
                'medi_card_state' => $info['medi_card_state'],
                'age' => $info['age'],
                'time' => i_time(),
        );
        $this->print_arr($arr, 1);
        return $arr;
    }

    function info_print() {
        $arr = i_json2php($_POST["arr"]);
        $time = $arr['time'];//打票时间
        $pname = $arr["pname"];//款项来源，人员姓名
        $fee_num = $arr["fee_num"];//缴费金额，小写

$feenum = "99999.pp";//测试用例
        $a = explode(".",$fee_num);//截取字符串，使其变为数组

        if(strlen($a[1])<=2) {
            if(strlen($a[1])==1) {
                $a[1]=$a[1]."0";
            }
            if(strlen($a[1])==0) {
                $a[1]=$a[1]."00";
            }
//echo $a[1]."<br/>";
        }else {
            $a[1]=substr($a[1],0,2);
//echo $a[1]."<br/>";
        }
        $year = substr($time,0,4);
        $month = substr($time,5,2);
        $day = substr($time,8,2);

        $feenum_now= $a[0].'.'.$a[1]; //"￥"

        //$tady= $year." 年 ".$month." 月 ".$day." 日";

        $arr = array('time' => $time ,
                'pname' => $pname,
                'fee_num' => $feenum_now ,
                'year' => $year ,
                'month' => $month ,
                'day' => $day,
        );
        $this->print_arr($arr, 1);
        return $arr;
    }
}
?>