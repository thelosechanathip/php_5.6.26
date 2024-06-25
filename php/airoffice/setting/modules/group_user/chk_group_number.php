<?PHP include_once '../../../lib/config.inc.php';

$Db = new MySqlConn; 


if($_POST['group_number']){

    $num = $Db->num_rows_qurery("SELECT * FROM group_user WHERE id='".$_POST['group_number']."'");
    if ($num>0)  {
    // User name is registered on another account
    echo 'false';
  } 
  else  {
    // User name is available
     echo 'true';
  }
}