<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of beat_ileap
 *
 * @author LianHu
 */
class mod_beat_ileap {
    private $xdb;   //数据库实体
    private $xtb;   //操作数据库的表实体

    //====始化此类初方法==========
    function __construct() {
        global $g_xdb;
        $this->xdb = $g_xdb;
        $this->xtb = 'lh_ileap_info';
    }
    //====基本查询操作方法========
    function beat_ileap_list() {
        $show_num = $_GET['show_num'];   //一页显示多少行数据
        $page_now = $_GET['page_now'];    //总共多少页
        $info_s = $show_num * $page_now - $show_num;
        $result_arr = $this->xdb->read_one($this->xtb, '* ', 'ileap_code=2 and ileap_name=1 ORDER BY id DESC LIMIT  ' . $info_s . ',' . $show_num . ' ');
        //$result_arr = $this->xtb->read_all($this->xtb, '*' , 'id<>"0" order by  id desc limit  ' .$info_s . ','  . $show_num .'' );
        $result_arr=i_php2json($result_arr);  //解密
        return $result_arr; //把得到的解密文件返回给php
    }

    /**
     * 修改操作
     * **/
    function beat_eidt_info($xid) {
        $arr = array();
        $arr = $_POST['arr'];
        $arr = i_json2php($arr);
        $result_arr  = $this->xbd->update($this->xtb, 'ileap_code="'.$arr[0].'", ileap_name="'.$arr[1].'", sex="'.$arr[2].'", minzu="'.$arr[3].'", birth="'.$arr[4].'", cardid="'.$arr[5].'", degree="'.$arr[6].'", univ="'.$arr[7]
                 .'", major="'.$arr[8] .'", job_name="'.$arr[9] .'", job_type="'.$arr[10] .'", job_addr="'.$arr[11] .'", age="'.$arr[12] .'", jcard_addr="'.$arr[13] .'", remark="'.$arr[14] .'", file="'.$arr[15] .'", tel="'.$arr[16] .'", mobil="'.$arr[17]
                  .'", qq="'.$arr[18] .'", email="'.$arr[19].'", addr="'.$arr[20].'", postal="'.$arr[21].'"', 'id='.$xid);
        if($result_arr>0){
            $str_error("111111111111111111111111111111111111");
        }else{
            $str_error("22222222222222222222222222222222222222");
        }
    }
   
}
?>
