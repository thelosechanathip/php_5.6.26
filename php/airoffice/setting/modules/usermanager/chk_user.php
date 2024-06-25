<?PHP include_once '../../../lib/config.inc.php';

$Db = new MySqlConn; 


if($_POST['username']){
  
    $num = $Db->num_rows_qurery("SELECT * FROM employee WHERE username='".$_POST['username']." '");
    if ($num>0)  {
    // User name is registered on another account
    echo 'false';
  } 
  else  {
    // User name is available
     echo 'true';
  }
}