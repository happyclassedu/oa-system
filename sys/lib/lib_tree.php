<?php
/*
 * 文件名称：lib_tree.php
 * 功能描述：根据条件生成目录树。
 * 代码作者：Mirrado Sun
 * 创建日期：2008-12-17
 * 修改日期：2010-05-10
 * 当前版本：V1.0
*/

class lib_tree {
//====定义此类私有变量==========

    private $cfg;
    private $xdb;  //
    private $xtb = "#@__type";  //tree信息的数据表
    private $sql;
    private $sql_key = " id, name";  //查询数据的字段
    private $sql_tmp;

    private $db;                //数据库操作类的实体
    private $tid = 0;           //顶层的父ID
    private $fid = 0;           //顶层的父ID
    private $xid = 0;           //顶层的父ID
    private $layer_now = 1;     //当前层
    private $layer_max = 3;     //最多层
    private $layer_arr;         //各层栏目数
    private $layer_tmp;         //各层显示到的栏目数
    private $select_where = "";  //查询数据的条件
    private $select_where_temp = "";  //查询数据的条件
    private $style_fix = array('┣━','┗━','　　','┃　');   //显示样式——前缀
    private $arr_ok;  //输出的缓存
    private $arr_tmp;  //输出的缓存
    private $cfg_key = array('xtb','fid','sql');  //传入参数字段




    //====始化此类初方法==========
    function __construct($cfg) {
        global $g_xdb;
        $this->xdb = $g_xdb;

        foreach($this->cfg_key as $val) {
            if (isset($cfg[$val]) && $cfg[$val]!='') {
                $this->$val = $cfg[$val];
            }
        }  //foreach
        
        $this->tid = $this->xid = $this->fid;
    }

    //====基本操作方法开始==========
    /**输出--菜单树*/
    function tree_show() {
        $this->tree_scan();

//        print_r($this->arr);
//        echo '<hr>';
        $this->arr_arrange($this->arr, $this->tid);
//        print_r($this->arr_ok);
        return $this->arr_ok;
        //        return $this->show_temp;
    }
    /**生成--菜单树*/
    function tree_scan() {
        if ($this->layer_now > $this->layer_max) {
            return;
        }
        $this->sql_tmp = " fid = '$this->fid' $this->sql";
        $this->layer_arr[$this->layer_now] = $this->xdb->read_num($this->xtb, $this->sql_tmp);

//        echo $this->layer_arr[$this->layer_now] . '<hr>';
        
        if (0 < $this->layer_arr[$this->layer_now]) {
            $this->layer_scan($this->fid);
        }
    }

    /**生成--菜单树*/
    function child_scan() {
        $this->sql_tmp = " fid = '$this->fid' $this->sql";
        $num = $this->xdb->read_num($this->xtb, $this->sql_tmp);
        if ($num > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**生成--菜单树*/
    function layer_scan($fid) {
        $arr = $this->xdb->read_all($this->xtb, $this->sql_key, $this->sql_tmp);
//        print_r($arr);
//        echo '<hr>';
        $this->arr[$fid] = $arr;
        $this->layer_now++;
        for($i=0; $i<count($arr); $i++) {
            $this->layer_tmp[$this->layer_now-1] = $i+1;
            $this->fid = $arr[$i]['id'];
            $this->arr[$fid][$i]['layer'] = $this->layer_now-1;
            $this->arr[$fid][$i]['fix'] = $this->fix_show();
            $this->tree_scan();
        }
        $this->layer_now--;
    }

    /**生成--显示样式--前缀*/
    function fix_show() {
//        $tmp = '';
//        for($j=2; $j<($this->layer_arr); $j++) {
//            if (($this->layer_tmp[$this->layer-1])<$this->layer_arr[$this->layer_now-1] && $j==($this->layer_now-1)) {
//                if ($this->child_scan() == true) {
//                    $tmp []= '2';
//                } else {
//                    $tmp []= '3';
//                }
//            } elseif ($this->layer_tmp[$this->layer-1]==$this->layer_arr[$this->layer_now-1] && $j==($this->layer_now-1)) {
//                if ($this->child_scan() == true) {
//                    $tmp []= '5';
//                } else {
//                    $tmp []= '6';
//                }
//            } elseif ($this->layer_arr[$j] == $this->layer_tmp[$j]) {
//                $tmp []= '0';
//            } else {
//                $tmp []= '1';
//            }
//        }
//        return $tmp;


		$temp = '';
		for($j=2; $j<($this->layer_now); $j++) {
			if (($this->layer_tmp[$this->layer_now-1])<$this->layer_arr[$this->layer_now-1] && $j==($this->layer_now-1)) {
				$temp .= $this->style_fix[0];
			} else if ($this->layer_tmp[$this->layer_now-1]==$this->layer_arr[$this->layer_now-1] && $j==($this->layer_now-1)) {
				$temp .= $this->style_fix[1];
			} else if ($this->layer_arr[$j] == $this->layer_tmp[$j]) {
				$temp .= $this->style_fix[2];
			} else {
				$temp .= $this->style_fix[3];
			}
		}
		return $temp;

    }


    /**整理数组，让数组按照正常排序*/
    function arr_arrange($arr, $xid) {
        if (isset($arr)) {
            if(array_key_exists($xid, $arr)) {
                foreach($arr[$xid] as $key => $value) {
                    $this->arr_ok[] = $value;
                    $this->arr_arrange($arr, $value['id']);
                }  //foreach
            }
        }
    }
}
?>