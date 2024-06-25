<?PHP include_once '../../../lib/config.inc.php';

$Db = new MySqlConn; 


if($_POST['ModuleNameEn']){

    $num = $Db->num_rows_qurery("SELECT * FROM acoperation WHERE acoperation_modules='".$_POST['ModuleNameEn']."'");
    if ($num>0)  {
    // User name is registered on another account
    echo 'false';
  } 
  else  {
    // User name is available
     echo 'true';
  }
}