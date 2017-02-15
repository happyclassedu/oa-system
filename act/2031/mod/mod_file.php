<?php
/*
 * 文件名称：mod_file.php
 * 功能描述：新闻信息管理模型。
 * 代码作者：孙振强（创建）
 * 创建时间：2010-11-15
 * 修改时间：2010-11-15
 * 当前版本：V1.0
*/

i_mod_base_info();

class mod_file extends mod_base_info {

    /**
     * mod_load : 模型初始化定义主表等。
     */
    function mod_load() {
        $this->xtb = '#@__file';
        $this->atb = '#@__file';
        $this->btb = '#@__file_x';
        $this->show_num = @$_GET['show_num'];
        $this->page_now = @$_GET['page_now'];
        $this->val_search = @$_POST['val_search'];
        $this->val_search = i_json2php($this->val_search);
        $this->key_search = array('name', 'name_e', 'name_s');
    }

    /**
     * list_read : 根据条件读取list的信息的内容.
     * @return $arr : 空or数组加密后的字符串.
     */
    function list_read() {
        $table = $this->xtb . ' AS x ';
        $field = ' x.id, name, file_type, file_size, hits ';
        $where = ' x.drwx=0 ';
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
        $arr = $this->info_add_file();
        $arr = $this->info_add_base();
        $this->arr['doc_id'] = $arr;
        $this->xtb = $this->btb;
        $this->fields = '';
        $arr = $this->info_add_base();
        $this->info_read($arr);
        $this->xtb = $this->atb;
        $this->fields = '';
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
     * info_name_check:同名岗位检测.
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

    /**
     * info_add_file:上传文件操作.
     * @param $xid:信息id.
     * @param $arr:现在输入的名称数据.
     * @return $arr:0（没有）或n>0（有）.
     */
    function info_add_file() {
        if (!empty($_FILES)) {
            $file = '';
            $file['scr_tmp'] = $_FILES['file_data']['tmp_name'];
            $file['scr_dir'] = date('Ym/');
            i_dir_mk(g_doc . $file['scr_dir']);
            $file['scr_name'] = date('YmdHis'). rand(100,999);
            $file['scr_fix'] = '.dxf';
            $file['scr'] =  $file['scr_dir'] . $file['scr_name'] . $file['scr_fix'];
            move_uploaded_file($file['scr_tmp'], g_doc . $file['scr']);

            $file['size'] = $_FILES['file_data']['size'];
            $file['name'] = $_FILES['file_data']['name'];
            $tmp =explode("." , $file['name']);
            $file['type'] = $tmp[count($tmp)-1];
            $file['type'] = strtolower($file['type']);
            $file['name'] = str_replace('.' . $file['type'], '', $file['name']);

            if ($_POST['d_name']) {
                $file['name'] = $_POST['d_name'];
            }
            $file['intro'] = @$_POST['d_intro'];
            $this->arr['name'] = $file['name'];
            $this->arr['file_type'] = $file['type'];
            $this->arr['file_size'] = $file['size'];
            $this->arr['scr'] = $file['scr_dir'] . $file['scr_name'] . $file['scr_fix'];
            $this->arr['intro'] = $file['intro'];

            if (preg_match('/\.gif|gif|jpg|jpeg|png|bmp|swf|mp3|flv|js|css$/ ', $file['type'])) {
                $file['img'] = $file['scr_dir'] . $file['scr_name'] . '.' . $file['type'];
                i_dir_mk(g_img . $file['scr_dir']);
                copy(g_doc . $file['scr'], g_img . $file['img'] );
                $this->arr['img'] = $file['img'];
            }
            $this->arr['xid'] = $_POST['d_xid'];
            $this->arr['xtb'] = $_POST['d_xtb'];

            return $this->arr;
        }
    }

    function file_down($xid) {
        i_xid_check($xid);
        $table = $this->xtb . ' AS x ';
        $field = ' scr,file_type,name ';
        $where = ' x.drwx=0 AND id="' . $xid . '" ';
        $arr = $this->info_read_base($table, $field, $where);
//        $arr = $this->info_read($xid);
        $file_text = i_read_file(g_doc . $arr['scr']);
        $file_type = '.' . $arr['file_type'];
        $file_name = $arr['name'];

        $file_down = i_file_down($file_type, $file_name, $file_text);
        return $arr;
    }

    function file_down_ext1($xid) {
        $xtb = @$_GET['xtb'];
        $arr = $this->list_read_file4xtb($xid, $xtb, '1', '1');
        $this->file_down($arr[0]['doc_id']);
    }

    function info_update($xid) {
        i_xid_check($xid);
        $old = @$_GET['old'];
        $sql_val = ' xid="' . $xid . '" ';
        $where =  ' xid="' . $old . '" ';
        $arr = $this->xdb->update($this->btb, $sql_val, $where);
        return $arr;
    }

    /**
     * list_read_file4xtb:文件列表函数.
     * @param $xid:信息id.
     * @param $xtb:数据表名.
     * @param $is_limit:是否限制，0代表不限制，1代表限制.
     * @param $is_print:是否输出，0代表不输出，1代表输出.
     * @return $arr:数组.
     */
    function list_read_file4xtb($xid, $xtb, $is_limit, $is_print) {
        $table = $this->btb . ' AS x ';
        $field = ' x.id, name, doc_id, file_type, file_size, hits, img ';
        $where = ' x.drwx=0 AND x.xtb="' . $xtb . '" AND x.xid="' . $xid . '" ';
        if(isset($is_print) && '1' == $limit) {
            $str = '';
        } else {
            $str = ' LIMIT 0,1 ';
        }
        $order = ' ORDER BY atime DESC ' .  $str . ' ';
        $arr = $this->xdb->read_all($table, $field, $where . $order);
        if(isset($is_print) && '1' == $is_print){
            $this->print_arr($arr, 1);
        }
        return $arr;
    }

    function list_read_file4news($xid) {
        $table = $this->btb . ' AS x ';
        $field = ' x.id, name, doc_id, file_type, file_size, hits, img ';
        $where = ' x.drwx=0 AND x.xtb="news" AND x.xid="' . $xid . '" ';
        $order = ' ORDER BY atime DESC ';
        $arr = $this->xdb->read_all($table, $field, $where.$order);
        $this->print_arr($arr, 1);
        return $arr;
    }

    function file_del4news($xid) {
//        $arr = $this->info_read($xid);
        $field = ' scr, img ';
        $where = ' id="' . $xid . '" ';
        $arr = $this->info_read_base($this->atb, $field, $where);
        if ($arr['scr']) {
            unlink(g_doc . $arr['scr']);
        }
        if ($arr['img']) {
            unlink(g_img . $arr['img']);
        }
        $arr = $this->xdb->delete($this->atb, 'id="' . $xid . '"');
        $arr = $this->xdb->delete($this->btb, 'doc_id="' . $xid . '"');

        $this->print_arr($xid);
    }
}
?>