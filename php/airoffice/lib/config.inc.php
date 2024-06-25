
<?php

date_default_timezone_set("Asia/Bangkok"); 
define("host", "10.10.10.25");
define("username", "webairhos");
define("password", "aakkaatthhooss");
define("db", "airoffice");


define("db_web", "web_air");


define("host11", "10.10.10.5");
define("username2","sa");
define("password2","sa");
define("db2", "hos");

define("host5","10.10.10.5");
define("username5","sa");
define("password5","sa");
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

    public function update($tableName, $data) {
        if (!empty($data)) {
            $keys = array_keys($data);

            $sql = "UPDATE $tableName SET ";
            for ($i = 0; $i < count($data); $i++) {
                if (is_string($data[$keys[$i]])) {
                    $sql .= $keys[$i] . "='" . $data[$keys[$i]] . "'";
                    if ($i != count($data) - 1) {
                        $sql .= ',';
                    }
                }
            }

            $sql .= $this->_where;

            if ($sql) {
                $query = $this->_mysql->query('SET NAMES UTF8');
                $this->_mysql->query($sql);
            }
        }
    }
public function delete($tableName)
{
    if(!empty($tableName)){
    $sql = "delete from $tableName $this->_where";
    $this->_mysql->query($sql);
    }
}
    public function insert($tableName = '', $data) {

        if (!empty($data)) {

            $keys = array_keys($data);
            $value = array_values($data);

            $sql = "INSERT INTO $tableName ";
            $sql .= "(";
            foreach ($keys AS $key => $k) {
                $sql .= $k;
                if ($key !== count($keys) - 1)
                    $sql .= ', ';
            }
            $sql .= ")";
            $sql .= "VALUES ";
            $sql .= "(";
            foreach ($value AS $val => $v) {
                $sql .= "'" . $v . "'";
                if ($val !== count($value) - 1)
                    $sql .= ', ';
            }
            $sql .= ")";
            if ($sql) {
                $query = $this->_mysql->query('SET NAMES UTF8');
                $this->_mysql->query($sql);
            }
        }
    }

    public function num_rows_qurery($sql) { //หาจำนวนแถวแบบใส่ Query เอง
       
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

    

    public function num_rows($tableName) { //หาจำนวยแถว  login
        
        $this->_tableName = $tableName;
        $sql = 'SELECT * FROM';
        $query = $this->_mysql->query("$sql $this->_tableName $this->_whereuser");
        $results = mysqli_num_rows($query);

        return $results;
    }

//check access rule

    public function rule($module='') {?> 
    <script src="../includes/sweet-alert.min.js"></script>
    <?php

        $Db = new MySqlConn;
       $group_name=  $_SESSION['group_user_name'];
       $user_name= $_SESSION['loginname'];
       
      
       if($user_name){
             if($group_name=='ADMIN'){
               return true;  
             }
             if($module==''){
                 return true;
             } else{
                  $sql = $Db->query("SELECT * FROM acoperation where acoperation_modules='".$module."'","");
           foreach ($sql AS $row) {
                  $group = explode(",", $row['acoperation_group']);
                  $user = explode(",", $row['acoperation_user']);
              }
             $arr_sess=array($group_name,$user_name); //นำ session มาเปลี่ยนเป็น array
             $group= array_merge($group,$user);    //รวม array ใน modules ว่ากลุ่มหรือ user ถูกเพิ่มในตารางสิทธิ์นั้นๆ
             $result = array_intersect( $arr_sess,$group); // คำสั่ง ตรวจสอบชุด array ว่าตรงกันหรือไม่
             if($result){ //ถ้า array ตรงกันให้ส่งค่า ture
             return true;
             }else{
               
                echo "<script language='javascript'>";
                echo "swal({
                    title: '?คุณไม่ได้รับอนุญาติให้เข้าหน้านี้',
                    text: 'กรุณาติดต่อ Admin หาต้องการเข้าใช้งาน',
                    type: 'warning',
                   
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'OK!',
                  
                  });";
                  //not showing an alert box.
                echo "</script>";
                exit;
  
             }
             }
          
         
       }else{
          
        echo "<script language='javascript'>";
        echo "swal({
            swal({
                title: '?คุณไม่ได้รับอนุญาติให้เข้าหน้านี้',
                text: 'กรุณาติดต่อ Admin หาต้องการเข้าใช้งาน',
                type: 'warning',
               
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'OK!',
          });";
          //not showing an alert box.
        echo "</script>";
        exit;


       }
     
    }

}

class MySqlConn2 { //query only

    protected $_mysql;
    protected $_tableName;
    protected $_where;
    protected $_order;
    protected $_limit;

    public function __construct() {
        $this->_mysql = new mysqli(host11, username2, password2, db2)
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

    public function num_rows_qurery($tableName) { //หา�?ำ�?ว�?�?ถวทั�?ว�?�?
        $this->_tableName = $tableName;
        $sql = 'SELECT * FROM';
        $query = $this->_mysql->query("$sql $this->_tableName $this->_where");
        $results = mysqli_num_rows($query);

        return $results;
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
     public function num_rows_qurery($sql,$tableName) { //หา�?ำ�?ว�?�?ถวทั�?ว�?�?
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
function DateThai($strDate)

{

$strYear = date("Y",strtotime($strDate))+543;

$strMonth= date("n",strtotime($strDate));

$strDay= date("j",strtotime($strDate));

$strHour= date("H",strtotime($strDate));

$strMinute= date("i",strtotime($strDate));

$strSeconds= date("s",strtotime($strDate));

$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");

$strMonthThai=$strMonthCut[$strMonth];

return "$strDay $strMonthThai $strYear";

}
function replicate_status(){
    $Db2 = new MySqlConn2;
$sql='select * from ovst order by vn desc limit 1';
$query2 = $Db2->query($sql,'');
foreach ($query2 as $row) {
 echo "ข้อมูลจากฐานสำรอง ถึงวันที่ ". DateThai($row['vstdate']);  
}
}





class MySqlConnWEB {

    protected $_mysql;
    protected $_tableName;
    protected $_where;
    protected $_order;
    protected $_limit;

    public function __construct() {
        $this->_mysql = new mysqli(host, username, password, db_web)
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

    public function update($tableName, $data) {
        if (!empty($data)) {
            $keys = array_keys($data);

            $sql = "UPDATE $tableName SET ";
            for ($i = 0; $i < count($data); $i++) {
                if (is_string($data[$keys[$i]])) {
                    $sql .= $keys[$i] . "='" . $data[$keys[$i]] . "'";
                    if ($i != count($data) - 1) {
                        $sql .= ',';
                    }
                }
            }

            $sql .= $this->_where;

            if ($sql) {
                $query = $this->_mysql->query('SET NAMES UTF8');
                $this->_mysql->query($sql);
            }
        }
    }
public function delete($tableName)
{
    if(!empty($tableName)){
    $sql = "delete from $tableName $this->_where";
    $this->_mysql->query($sql);
    }
}
    public function insert($tableName = '', $data) {

        if (!empty($data)) {

            $keys = array_keys($data);
            $value = array_values($data);

            $sql = "INSERT INTO $tableName ";
            $sql .= "(";
            foreach ($keys AS $key => $k) {
                $sql .= $k;
                if ($key !== count($keys) - 1)
                    $sql .= ', ';
            }
            $sql .= ")";
            $sql .= "VALUES ";
            $sql .= "(";
            foreach ($value AS $val => $v) {
                $sql .= "'" . $v . "'";
                if ($val !== count($value) - 1)
                    $sql .= ', ';
            }
            $sql .= ")";
            if ($sql) {
                $query = $this->_mysql->query('SET NAMES UTF8');
                $this->_mysql->query($sql);
            }
        }
    }

    public function num_rows_qurery($sql) { //หาจำนวนแถวแบบใส่ Query เอง
       
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

    

    public function num_rows($tableName) { //หาจำนวยแถว  login
        
        $this->_tableName = $tableName;
        $sql = 'SELECT * FROM';
        $query = $this->_mysql->query("$sql $this->_tableName $this->_whereuser");
        $results = mysqli_num_rows($query);

        return $results;
    }

//check access rule

    public function rule($module='') {?> 
    <script src="../includes/sweet-alert.min.js"></script>
    <?php

        $Db = new MySqlConn;
       $group_name=  $_SESSION['group_user_name'];
       $user_name= $_SESSION['loginname'];
       
      
       if($user_name){
             if($group_name=='ADMIN'){
               return true;  
             }
             if($module==''){
                 return true;
             } else{
                  $sql = $Db->query("SELECT * FROM acoperation where acoperation_modules='".$module."'","");
           foreach ($sql AS $row) {
                  $group = explode(",", $row['acoperation_group']);
                  $user = explode(",", $row['acoperation_user']);
              }
             $arr_sess=array($group_name,$user_name); //นำ session มาเปลี่ยนเป็น array
             $group= array_merge($group,$user);    //รวม array ใน modules ว่ากลุ่มหรือ user ถูกเพิ่มในตารางสิทธิ์นั้นๆ
             $result = array_intersect( $arr_sess,$group); // คำสั่ง ตรวจสอบชุด array ว่าตรงกันหรือไม่
             if($result){ //ถ้า array ตรงกันให้ส่งค่า ture
             return true;
             }else{
               
                echo "<script language='javascript'>";
                echo "swal({
                    title: '?คุณไม่ได้รับอนุญาติให้เข้าหน้านี้',
                    text: 'กรุณาติดต่อ Admin หาต้องการเข้าใช้งาน',
                    type: 'warning',
                   
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'OK!',
                  
                  });";
                  //not showing an alert box.
                echo "</script>";
                exit;
  
             }
             }
          
         
       }else{
          
        echo "<script language='javascript'>";
        echo "swal({
            swal({
                title: '?คุณไม่ได้รับอนุญาติให้เข้าหน้านี้',
                text: 'กรุณาติดต่อ Admin หาต้องการเข้าใช้งาน',
                type: 'warning',
               
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'OK!',
          });";
          //not showing an alert box.
        echo "</script>";
        exit;


       }
     
    }

}


