

<?php




date_default_timezone_set("Asia/Bangkok"); 
define("host", "192.168.2.11");
define("username", "sa");
define("password", "sa");
define("db", "hos");




define("host5","192.168.2.5");
define("username5","query");
define("password5","xitdyo2018");
define("db5", "hos");

class MySqlConn {

    protected $_mysql;
    protected $_tableName;
    protected $_where;
    protected $_order;
    protected $_limit;

    public function __construct() {
        $this->_mysql = new mysqli(host, username, password, db)
                or die('not connect to sql');
    }

    public function where($prop,$value) {
        if (!empty($prop) && !empty($value)) {
            $this->_where = "WHERE $prop = '$value'";
        }
    }

    public function order($order, $sort) {
        if (!empty($order)) {
            $this->_order = "order by $order $sort";
        }
    }

    public function limit($value) {
        if (!empty($value)) {
            $this->_limit = "LIMIT $value";
        }
    }

    public function query($sql = '', $tableName = '') {
        if (!empty($sql)) {
            $sql = $sql;
        } else {
            $sql = 'SELECT * FROM';
        }
        $results = '';
        $this->_tableName = $tableName;
        $query = $this->_mysql->query('SET NAMES UTF8');
        $query = $this->_mysql->query("$sql $this->_tableName $this->_where
                 $this->_order $this->_limit");



        while ($row = $query->fetch_array()) {
            $results[] = $row;
        }

        return $results;
    }

    

    public function num_rows_qurery($sql) { //�Ҩӹǹ��Ẻ��� Query �ͧ
       
        $query = $this->_mysql->query("$sql $this->_tableName $this->_where");
        $results = mysqli_num_rows($query);

        return $results;
    }
    
    public function where_data($data, $opera = '') {
        if (!empty($data)) {
            $keys = array_keys($data);
            $where = "WHERE ";
            for ($i = 0; $i < count($data); $i++) {
                if (is_string($data[$keys[$i]])) {
                    $where .= $keys[$i] . "='" . $data[$keys[$i]] . "'";
                    if ($i != count($data) - 1) {
                        $where .= " $opera ";
                    }
                }
            }

            $this->_whereuser = $where;
        }
    }

    
}
    


class MySqlConn5 {

    protected $_mysql;
    protected $_tableName;
    protected $_where;
    protected $_order;
    protected $_limit;

    public function __construct() {
        $this->_mysql = new mysqli(host5, username5, password5, db5)
                or die('not connect to sql');
    }

    public function where($prop, $value) {
        if (!empty($prop) && !empty($value)) {
            $this->_where = "WHERE $prop = '$value'";
        }
    }

    public function order($order, $sort) {
        if (!empty($order)) {
            $this->_order = "order by $order $sort";
        }
    }

    public function limit($value) {
        if (!empty($value)) {
            $this->_limit = "LIMIT $value";
        }
    }

    public function query($sql = '', $tableName = '') {
        if (!empty($sql)) {
            $sql = $sql;
        } else {
            $sql = 'SELECT * FROM';
        }
        $results = '';
        $this->_tableName = $tableName;
        $query = $this->_mysql->query('SET NAMES UTF8');
        $query = $this->_mysql->query("$sql $this->_tableName $this->_where
                 $this->_order $this->_limit");



        while ($row = $query->fetch_array()) {
            $results[] = $row;
        }

        return $results;
    }
     public function num_rows_qurery($sql,$tableName) { //�� ?� ?� ? ?�Ƿ� ?� ? ?
          if (!empty($sql)) {
            $sql = $sql;
        } else {
            $sql = 'SELECT * FROM';
        }
        $this->_tableName = $tableName;
     
        $query = $this->_mysql->query("$sql $this->_tableName $this->_where");
        $results = mysqli_num_rows($query);

        return $results;
    }
}











//include_once '../lib/config.inc.php';

//include_once '/var/www/html/airoffice/lib/config.inc.php';

$Db5 = new MySqlConn5;

$Db = new MySqlConn;

$sql = "select pt.fname,vn.* from ".$db5.".vn_stat vn  
inner join ".$db.".patient pt on pt.hn=vn.hn 
where vn.vstdate='2020-02-01'
limit 20 " ;





$num = $Db5->num_rows_qurery($sql, '');

if ($num > 0) {

    $result = $Db5->query($sql, '');

    foreach ($result AS $row) {

      echo $row['fname'] ."\n";
      echo "\n";

      
    }
    
}


 
       





