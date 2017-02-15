<?php
/*
 * 文件名称：xdo.php
 * 功能描述：php操作数据库的方法集成类。
 * 代码作者：Mirrado Sun
 * 创建日期：2010-05-09
 * 修改日期：2010-05-10
 * 当前版本：V1.0
 */

class lib_xdo {

    private $cfg;
    var $sql;
    private $xdb;
    private $xrs;

    /**
     * xdo construct
     * @param cfg : DB source's config array.
     * @return none.
     */
    function __construct($cfg) {
        $this->cfg = $cfg;
        $this->connect();
    }

    /**
     * DB host connect.
     * @return none.
     */
    function connect() {
        try {
            $dsn = 'mysql:host=' . $this->cfg['host'] . '; dbname=' . $this->cfg['data'] . ';';
            $user = $this->cfg['user'];
            $pass = $this->cfg['pass'];
            $options = array(
                PDO::ATTR_PERSISTENT => $this->cfg['host_persistent'],
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $this->cfg['data_utf']
            );
            $this->xdb = new PDO($dsn, $user, $pass, $options);
        } catch (Exception $e) {
            $this->show($e);
            die();
        }
    }

    /**
     * show error and now sql sentence.
     * @param e : php's error object.
     * @return print error.
     */
    function show($e) {
        if ('y' != $this->cfg['show_err']) {
            return 0;
        }
        $str = '';
        if ($this->xdb) {
            $tmp = $this->xdb->errorInfo();
            if ('00000' == $tmp[0]) {
                return 0;
            }
            $str .= '<hr>DB Process Error : ****' . $tmp[2] . '****<hr>';
        } else {
            $str .= '<hr>DB Server Error : ****' . $e->getMessage() . '****<hr>';
        }
        if ('' != $this->sql) {
            $str .= '<hr>SQL Now : ****' . $this->sql . '****<hr>';
        }
        print_r($str);
        exit;
    }

    /**
     * xdo close connect.
     * @return none.
     */
    function close() {
        $this->xrs = null;
        $this->xdb = null;
        $this->sql = null;
    }

    /**
     * sql query load.
     * @return 0 or 1.
     */
    function query_load() {
        if ('' == $this->sql) {
            return 0;
        }

        if (!$this->xdb) {
            $this->connect();
        }

        $this->sql = @i_str4iconv($this->sql, $this->cfg['data_utf'], '1');
        if ($this->cfg['data_fix']) {
            $this->sql = str_replace('#@__', $this->cfg['data_fix'], $this->sql);
        }

        $this->xrs = null;
        return 1;
    }

    /**
     * query sql.
     * @return $this->xrs.
     */
    function query() {
        if (1 != $this->query_load()) {
            return 0;
        }
        $this->xrs = $this->xdb->query($this->sql);
        if (null == $this->xrs) {
            $this->show($e);
        }
        $this->xrs->setFetchMode(PDO::FETCH_ASSOC);
    }

    /**
     * exec sql.
     * @return $this->xrs.
     */
    function exec() {
        if (1 != $this->query_load()) {
            return 0;
        }
        $this->xrs = $this->xdb->exec($this->sql);
        if ('' == $this->xrs) {
            $this->show($e);
        }
    }

    /**
     * insert one info.
     * @param table : operate table's name.
     * @param fields : insert table's fields.
     * @param values : insert table's values.
     * @return insert id.
     */
    function insert($table, $fields, $values) {
        $fields = @ereg_replace("(^(,| )*)|((,| )*$)", "", $fields);
        $values = @ereg_replace("(^(,| )*)|((,| )*$)", "", $values);
        $this->sql = 'INSERT INTO ' . $table . ' (' . $fields . ') VALUE (' . $values . ')';
        $this->exec();
        return $this->xdb->lastInsertId();
    }

    /**
     * insert all infos.
     * @param table : operate table's name.
     * @param fields : insert table's fields.
     * @param values : insert table's values's array.
     * @return last insert id.
     */
    function insert_all($table, $fields, $values) {
        $fields = @ereg_replace("(^(,| )*)|((,| )*$)", "", $fields);
        $sqlvalue = '';
        foreach ($values as $val) {
            $val = @ereg_replace("(^(,| )*)|((,| )*$)", "", $val);
            $sqlvalue .= ' (' . $val . '), ';
        }  //foreach
        $sqlvalue = @ereg_replace("(^(,| )*)|((,| )*$)", "", $sqlvalue);
        $this->sql = 'INSERT INTO ' . $table . ' (' . $fields . ') VALUE ' . $sqlvalue . '';
        $this->exec();
        return $this->xdb->lastInsertId();
    }

    /**
     * delete info or infos.
     * @param table : operate table's name.
     * @param sqlwhere : delete sql's where.
     * @return 0 or 1.
     */
    function delete($table, $sqlwhere) {
        $sqlwhere = @ereg_replace("(^(,| )*)|((,| )*$)", "", $sqlwhere);
        $this->sql = 'DELETE FROM ' . $table . ' WHERE ' . $sqlwhere . ' ';
        $this->exec();
        return $this->xrs;
    }

    /**
     * update info or infos.
     * @param table : operate table's name.
     * @param sqlvalue : update info's fields and values.
     * @param sqlwhere : update sql's where.
     * @return 0 or 1.
     */
    function update($table, $sqlvalue, $sqlwhere) {
        $sqlvalue = @ereg_replace("(^(,| )*)|((,| )*$)", "", $sqlvalue);
        $sqlwhere = @ereg_replace("(^(,| )*)|((,| )*$)", "", $sqlwhere);
        $this->sql = 'UPDATE ' . $table . ' SET ' . $sqlvalue . ' WHERE ' . $sqlwhere . '';
        $this->exec();
        return $this->xrs;
    }

    /**
     * select infos.
     * @param table : operate table's name.
     * @param sqlwhat : select info's fields.
     * @param sqlwhere : select sql's where.
     * @return $this->xrs.
     */
    function select($table, $sqlwhat="*", $sqlwhere="") {
        if ($sqlwhere) {
            $sqlwhere = ' WHERE ' . $sqlwhere;
        }
        $this->sql = 'SELECT ' . $sqlwhat . ' FROM ' . $table . $sqlwhere;
        $this->query();
    }

    /**
     * read all infos.
     * @param table : operate table's name.
     * @param sqlwhat : read info's fields.
     * @param sqlwhere : read sql's where.
     * @return all infos' array.
     */
    function read_all($table, $sqlwhat="*", $sqlwhere="") {
        $this->select($table, $sqlwhat, $sqlwhere);
        if ($this->xrs) {
            $arr = $this->xrs->fetchAll();
            $arr = @i_arr4iconv($arr, $this->cfg['data_utf'], '0');
            return $arr;
        } else {
            return null;
        }
    }

    /**
     * read ine info.
     * @param table : operate table's name.
     * @param sqlwhat : read info's fields.
     * @param sqlwhere : read sql's where.
     * @return one info's array.
     */
    function read_one($table, $sqlwhat="*", $sqlwhere="") {
        $this->select($table, $sqlwhat, $sqlwhere . ' LIMIT 0,1');
        if ($this->xrs) {
            $arr = $this->xrs->fetch();
            $arr = @i_arr4iconv($arr, $this->cfg['data_utf'], '0');
            return $arr;
        } else {
            return null;
        }
    }

    /**
     * read one info.
     * @param table : operate table's name.
     * @param sqlwhat : read info's fields.
     * @param sqlwhere : read sql's where.
     * @return one info's first field's value.
     */
    function read_one_val($table, $sqlwhat="*", $sqlwhere="") {
        $this->select($table, $sqlwhat, $sqlwhere);
        if ($this->xrs) {
            $str = $this->xrs->fetchColumn();
            $str = @i_str4iconv($str, $this->cfg['data_utf'], '0');
            return $str;
        } else {
            return null;
        }
    }

    /**
     * read info's.
     * @param table : operate table's name.
     * @param sqlwhat : read info's fields.
     * @param sqlwhere : read sql's where.
     * @return info's num or null.
     */
    function read_num($table, $sqlwhere = '') {
        $this->select($table, '*', $sqlwhere);
        if ($this->xrs) {
            return $this->xrs->rowCount();
        } else {
            return null;
        }
    }

    /**
     * read table's fields.
     * @param table : operate table's name.
     * @return table's fields array.
     */
    function read_xtb_fields($table) {
        $arr = $this->read_all('information_schema.columns', 'COLUMN_NAME field_key', "TABLE_SCHEMA='" . $this->cfg['data'] . "' AND TABLE_NAME='" . $table . "'");
        $arr_new = '';
        foreach ($arr as $arr_tmp) {
            $arr_new[] = $arr_tmp['field_key'];
        }  //foreach
        return $arr_new;
    }
}

// develop test code or dome code.
//$cfg_db['host'] = '127.0.0.4';
//$cfg_db['user'] = 'xalhrc_oa';
//$cfg_db['pass'] = 'oa@2010';
//$cfg_db['data'] = 'xalhrc';
//$cfg_db['data_fix'] = 'lh_';
//$cfg_db['data_utf'] = 'GBK';
//$cfg_db['show_err'] = 'y';
//$cfg_db['host_persistent'] = true;
//
//$mdb = new xdo($cfg_db);
?>