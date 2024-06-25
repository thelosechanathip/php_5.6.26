 <?PHP include_once '../../../lib/config.inc.php';
$Db = new MySqlConn; 
//$Db->rule('admin_access', 'usermanager', 'index');
//if($_POST['req']){
$sql = $Db->query('SELECT ac.acoperation_id,ac.acoperation_modules
,ac.acoperation_thai_name_modules,ac.acoperation_group,ac.acoperation_user
,mm.main_modules_name FROM acoperation ac left join main_modules mm on mm.main_modules_id=ac.main_modules ','');
               $data = array();
        foreach ($sql as $row ) {
           
            $data[] = $row ;
        }
                $response = array(
     
        "data" => $data
    );	
                echo json_encode($response);   
//}   
     ?>
