<?php
/*
* ???????mod_pay.php
* ?????????????????????锟斤拷????????? * ?????????????(????)
* ?????????2010-06-30
* ????????2010-06-30
* ????锟斤拷??V1.0
*/
class mod_pay {
//====?????????锟斤拷????=========
    private $xdb;  //??????????
    private $xtb;  //?????????????????????
    private $ytb;  //?????????????????
    private $atb;  //????????????????????
    private $btb;  //???????????????????????
    private $ctb;  //????????????????????

//====?????????????=========
    function __construct() {
        global $g_xdb;
        $this->xdb = $g_xdb;
        $this->xtb = '#@__pay_system';
        $this->ytb = '#@__pay_zhangtao';
        $this->atb = '#@__pay_table';
        $this->btb = '#@__human_zt_r';
        $this->ctb = '#@__human';
        $this->dtb = '#@__human_org_r';
        $this->etb = '#@__work';
        $this->ftb = '#@__org';
    }
//====?????????????=======

    function read_list() {
        $show_num = @$_GET['show_num'];
        $page_now = @$_GET['page_now'];
        $info_s = $show_num * $page_now - $show_num;
        $val_search = $this->val_search_get();
        $result_arr = $this->xdb->read_all('( SELECT * FROM  ' . $this->xtb . ' WHERE drwx="0"  ' . $val_search . ' ORDER BY id DESC LIMIT  '  . $info_s . ',' . $show_num . ' ) AS x  LEFT JOIN (SELECT * FROM ' . $this->ytb .' WHERE  drwx="0" ) AS y ON  y.id=x.zhangtao_id  ', 'y.zhangtao_name , y.zhangtao_intro , x.id , x.zhangtao_id , x.sys_name, x.sys_money');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function  read_num() {
        $val_search = $this->val_search_get();
        $result_arr = $this->xdb->read_num($this->xtb , 'drwx="0" ' . $val_search . '');
        print_r($result_arr);
    }

    function val_search_get() {
        $val_search = @$_POST['val_search'];
        $val_search = i_json2php($val_search);
        if ((''!= $val_search['sys_name'])) {
            $val_search = ' AND ( sys_name LIKE "%' . $val_search['sys_name']  .'%") ';
        }
        elseif ((''!= $val_search['zhangtao_id'])) {
            $val_search = ' AND ( zhangtao_id LIKE "%' . $val_search['zhangtao_id']  .'%") ';
        }
        return $val_search;
    }

    /**????锟斤拷????*/
    function read_info($xid) {
        $result_arr = $this->xdb->read_one($this->xtb ,  '*', 'drwx="0" AND id="' . $xid . '"');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function del_info($xid) {
        $result_arr =  $this->xdb->update($this->xtb, 'drwx="4"', 'id="' . $xid . '"');
        print_r($result_arr);
    }


    function  add_info() {
        $arr = $_POST['arr'];
        $arr = i_json2php($arr);

        $fields = array();
        $fields = $this->xdb->read_xtb_fields($this->xtb);
        $insert_fields = $insert_values = '';

        foreach($arr as $key => $val) {
            if ($key <> 'id' && in_array($key, $fields)) {
                $insert_fields .= ',' . $key . ' ';
                $insert_values .= ', "' . $val . '" ';
            }
        }  //foreach

        if ('' == $insert_fields) {
            print_r($arr);
            return;
        }

        $result_arr = $this->xdb->insert($this->xtb, $insert_fields, $insert_values);
        echo  $result_arr;
    }

    function  edit_info($xid) {
        $arr = $_POST['arr'];
        $arr = i_json2php($arr);

        $fields = array();
        $fields = $this->xdb->read_xtb_fields($this->xtb);
        $updata_values = '';

        foreach($arr as $key => $val) {
            if ($key <> 'id' && in_array($key, $fields)) {
                $updata_values .= ',' . $key . '="' . $val . '" ';
            }
        }  //foreach

        if ('' == $updata_values) {
            print_r($arr);
            return;
        }
        $result_arr = $this->xdb->update($this->xtb, $updata_values, 'id='.$xid);
        echo  $result_arr;
    }
    /***** ????????????? *****/

    function read_set_info($xid) {
        $result_arr = $this->xdb->read_one($this->ytb ,  '*', 'drwx="0" AND id="' . $xid . '"');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function  add_set_info() {
        $arr = $_POST['arr'];
        $arr = i_json2php($arr);

        $fields = array();
        $fields = $this->xdb->read_xtb_fields($this->ytb);
        $insert_fields = $insert_values = '';

        foreach($arr as $key => $val) {
            if ($key <> 'id' && in_array($key, $fields)) {
                $insert_fields .= ',' . $key . ' ';
                $insert_values .= ', "' . $val . '" ';
            }
        }  //foreach

        if ('' == $insert_fields) {
            print_r($arr);
            return;
        }

        $result_arr = $this->xdb->insert($this->ytb, $insert_fields, $insert_values);
        echo  $result_arr;
    }

    function  edit_set_info($xid) {
        $arr = $_POST['arr'];
        $arr = i_json2php($arr);

        $fields = array();
        $fields = $this->xdb->read_xtb_fields($this->ytb);
        $updata_values = '';

        foreach($arr as $key => $val) {
            if ($key <> 'id' && in_array($key, $fields)) {
                $updata_values .= ',' . $key . '="' . $val . '" ';
            }
        }  //foreach

        if ('' == $updata_values) {
            print_r($arr);
            return;
        }
        $result_arr = $this->xdb->update($this->ytb, $updata_values, 'id='.$xid);
        echo  $result_arr;
    }

    function del_set_info($xid) {
        $result_arr =  $this->xdb->update($this->ytb, 'drwx="4"', 'id="' . $xid . '"');
        print_r($result_arr);
    }

    function  read_set_num() {
        $result_arr = $this->xdb->read_num($this->ytb ,  'drwx="0" ');
        print_r($result_arr);
    }

    function read_set_list() {
        $show_num = @$_GET['show_num'];
        $page_now = @$_GET['page_now'];
        $info_s = $show_num * $page_now - $show_num;
        $result_arr = $this->xdb->read_all($this->ytb , '*' , 'drwx="0" ');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function paylist_read($xid) {
        $show_num = @$_GET['show_num'];
        $page_now = @$_GET['page_now'];
        $info_s = $show_num * $page_now - $show_num;
//        $result_arr = $this->xdb->read_all('( SELECT * FROM  ' . $this->xtb . ' WHERE drwx="0"  ORDER BY id DESC LIMIT  '  . $info_s . ',' . $show_num . ' ) AS x  LEFT JOIN (SELECT * FROM ' . $this->ytb .' WHERE  drwx="0" ) AS y ON  y.id=x.zhangtao_id  ', 'y.zhangtao_name , y.zhangtao_intro , x.id , x.zhangtao_id , x.oid , x.sys_name, x.sys_money');
        $result_arr = $this->xdb->read_all($this->xtb , '*' , 'drwx="0" AND zhangtao_id=' .$xid . ' ORDER BY id DESC LIMIT  '  . $info_s . ',' . $show_num . ' ');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function  paylist_num($xid) {
        $result_arr = $this->xdb->read_num($this->xtb , 'drwx="0" AND zhangtao_id=' .$xid . ' ');
        print_r($result_arr);
    }

    function emlist_read() {
        $show_num = @$_GET['show_num'];
        $page_now = @$_GET['page_now'];
        $info_s = $show_num * $page_now - $show_num;
        $result_arr = $this->xdb->read_all('( SELECT * FROM ' . $this->ctb . ' WHERE  drwx="0"  ORDER BY id DESC LIMIT  ' . $info_s . ',' . $show_num . '  )  AS x  LEFT JOIN ( SELECT * FROM ' . $this->dtb . ' WHERE drwx="0") AS y ON x.id = y.human_id ', 'x.id ,x.code, x.name, y.org_name, y.office_name, y.post_name, y.position');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function  emlist_num() {
        $result_arr = $this->xdb->read_num($this->ctb , 'drwx="0" ');
        print_r($result_arr);
    }
    /****************person_pay******************/
    function member_info($xid) {
        $result_arr = $this->xdb->read_one($this->ctb , '*', 'drwx="0" AND id="' . $xid . '"');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function zhangtao_info() {
        $result_arr = $this->xdb->read_all($this->ytb , '*', 'drwx="0" ');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function  add_person_info() {
        $arr = $_POST['arr'];
        $arr = i_json2php($arr);

        $fields = array();
        $fields = $this->xdb->read_xtb_fields($this->btb);
        $insert_fields = $insert_values = '';

        foreach($arr as $key => $val) {
            if ($key <> 'id' && in_array($key, $fields)) {
                $insert_fields .= ',' . $key . ' ';
                $insert_values .= ', "' . $val . '" ';
            }
        }  //foreach

        if ('' == $insert_fields) {
            print_r($arr);
            return;
        }

        $result_arr = $this->xdb->insert($this->btb, $insert_fields, $insert_values);
        echo  $result_arr;
    }

    function  read_person_num() {
        $result_arr = $this->xdb->read_num('((SELECT b.id  , b.human_id , b.human_code , b.human_name, b.zhagntao_name, b.zhangtao_id , e.position_state, e.position, e.position_grade   FROM ' . $this->btb . ' AS b  LEFT JOIN ' . $this->etb . ' AS e ON b.human_id = e.human_id ) AS l LEFT JOIN (SELECT * FROM ' . $this->dtb . ' WHERE drwx="0") AS d ON d.human_id = l.human_id) AS h' ,  ' ');
        print_r($result_arr);
    }

    function read_person_list() {
        $show_num = @$_GET['show_num'];
        $page_now = @$_GET['page_now'];
        $info_s = $show_num * $page_now - $show_num;
//        $val_search = $this->val_search_get();
        $result_arr = $this->xdb->read_all('(SELECT x.id  , x.human_id , x.human_code , x.human_name, x.zhangtao_name, x.zhangtao_id ,y.position  FROM (SELECT * FROM lh_human_zt_r WHERE drwx="0") AS x  LEFT JOIN (SELECT * FROM lh_work WHERE drwx="0") AS y ON x.human_id = y.human_id ) AS l LEFT JOIN (SELECT * FROM lh_human_org_r WHERE drwx="0") AS h ON h.human_id = l.human_id ', 'l.id ,l.human_id ,  l.human_code , l.human_name, l.zhangtao_name, l.zhangtao_id, l.position , h.org_name , h.org_id  ');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function del_person_info($xid) {
        $result_arr =  $this->xdb->update($this->btb, 'drwx="4"', 'id="' . $xid . '"');
        print_r($result_arr);
    }

    function read_person_info($xid) {
        $result_arr = $this->xdb->read_one($this->btb ,  '*', 'drwx="0" AND id="' . $xid . '"');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function  org_info() {
        $result_arr = $this->xdb->read_all( $this->ftb, ' id ,name , fid , intro , remark', 'drwx="0"' . ' ');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    /**************************?????????*************************/
    function add_roll_info() {
        $arr = $_POST['arr'];
        $arr = i_json2php($arr);

        $fields = array();
        $fields = $this->xdb->read_xtb_fields($this->atb);
        $insert_fields = $insert_values = '';

        foreach($arr as $key => $val) {
            if ($key <> 'id' && in_array($key, $fields)) {
                $insert_fields .= ',' . $key . ' ';
                $insert_values .= ', "' . $val . '" ';
            }
        }  //foreach

        if ('' == $insert_fields) {
            print_r($arr);
            return;
        }

        $result_arr = $this->xdb->insert($this->atb, $insert_fields, $insert_values);
        echo  $result_arr;
    }

    function  info_init() {
        $arr = $_POST['arr'];
        $arr = i_json2php($arr);

//         v_arr[i]['fid'] = i_obj_val('i_fid');
//            v_arr[i]['human_id'] = i_obj_val(i + '_human_id');
//            v_arr[i]['human_code'] = $('#'+i).children(':eq(0)').html();
//            v_arr[i]['human_name'] = $('#'+i).children(':eq(1)').html();
//            v_arr[i]['zhangtao_id'] = i_obj_val(i + '_zhangtao_id');
//            v_arr[i]['zhangtao_name'] = $('#'+i).children(':eq(3)').html();
//            v_arr[i]['resch_fate'] = i_obj_val(i + '_resch_fate');
//            v_arr[i]['pay_time'] = i_obj_val('i_pay_time');
//            v_arr[i]['table_state'] = i_obj_val('i_table_state');
//            v_arr[i]['sys_name'] = title_arr[j];
//            v_arr[i]['sys_money'] = i_obj_val(i + '_' + (5+j) + '_sys_money');
        for($i = 0 ; $i < count($arr) ; $i++) {
           $result_arr[$i] = $this->xdb->insert($this->atb, 'fid,human_id,human_code,human_code,zhangtao_id, zhangtao_name, resch_fate, pay_time, table_state,sys_name,sys_money ', $arr[$i]['fid']);
//            if($result_arr[$i]>0) {
//                $result_arr = 1;
//            }
        }
//        print_r($arr);
    }

    function init_f($xid) {
        $result_arr = $this->xdb->read_one($this->atb , '*', 'id="' . $xid . '" ');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function init_c($xid) {
//        $result_arr = $this->xdb->read_all('(SELECT x.id  , x.human_id , x.human_code , x.human_name, x.zhangtao_name, x.zhangtao_id ,y.position  FROM (SELECT * FROM lh_human_zt_r WHERE drwx="0" ) AS x
//            LEFT JOIN (SELECT * FROM lh_work WHERE drwx="0") AS y ON x.human_id = y.human_id ) AS l
//            LEFT JOIN (SELECT * FROM lh_pay_system WHERE drwx="0" AND zhangtao_id=' . $xid . ') AS h ON h.zhangtao_id = l.zhangtao_id ',
//            'l.id ,l.human_id ,  l.human_code , l.human_name, l.zhangtao_name, l.zhangtao_id, l.position , h.sys_name , h.sys_money ');
        $result_arr = $this->xdb->read_all('(SELECT x.id  , x.human_id , x.human_code , x.human_name, x.zhangtao_name, x.zhangtao_id ,y.position  FROM (SELECT * FROM lh_human_zt_r WHERE drwx="0"  AND zhangtao_id=' . $xid . ') AS x
LEFT JOIN (SELECT * FROM lh_work WHERE drwx="0") AS y ON x.human_id = y.human_id ) AS l ',
                'l.id ,l.human_id ,  l.human_code , l.human_name, l.zhangtao_name, l.zhangtao_id, l.position ');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

    function init_c_sys($xid) {
        $result_arr = $this->xdb->read_all($this->xtb , '*' , 'drwx="0" AND zhangtao_id=' . $xid . ' ');
        $result_arr = i_php2json($result_arr);
        print_r($result_arr);
    }

}
?>
