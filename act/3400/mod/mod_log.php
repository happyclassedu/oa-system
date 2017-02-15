<?php
/*
 * 文件名称：mod_org.php
 * 功能描述：机构管理模型
 * 代码作者：钱宝伟（创建）、王争强（优化）、孙振强（重构）。
 * 创建时间：2010_06_11
 * 修改时间：2010-07-08
 * 当前版本：v3.0
*/

i_mod_base_info();

class mod_log {

    /**
     * 构造类。
     * @param $g_xdb : 调用全局的数据库操作类的实体.
     */
    function __construct() {
        global $g_xdb;
        $this->xdb = $g_xdb;
        $this->xtb = '#@__log';
    }

    /**
     * fields_read : 获取主表的字段名称.
     * @return $arr : 包含所有字段的数组.
     */
    function read_fields() {
        if (!$this->fields) {
            $this->fields = $this->xdb->read_xtb_fields($this->xtb);
        }
        return $this->fields;
    }

    /**
     * info_add:新增信息的保存操作.
     * @param $arr:需保存的信息数组.
     * @param $fields:主表的字段集数组.
     * @return $arr:0（失败）或其他数字（成功，新信息的id）.
     */
    function info_add($arr) {
        $this->read_fields();

        $sql_key = '';
        $sql_val = '';
        
        foreach ($arr as $key => $val) {
            if ($key <> 'id' && in_array($key, $this->fields)) {
                $sql_key .= ',' . $key . ' ';
                $sql_val .= ', "' . $val . '" ';
            }
        }

        if ('' == $sql_val) {
            return '';
        } else {
            $sql_key .= ', atime, u_id, u_name ';
            $sql_val .= ', "' . i_time() . '", "'. u_id .'", "'. u_name .'" ';
        }

        $arr = $this->xdb->insert($this->xtb, $sql_key, $sql_val);
        return $arr;
    }
}
?>