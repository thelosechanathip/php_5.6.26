 <?PHP include_once '../../../lib/config.inc.php';
$Db = new MySqlConn; 
//$Db->rule('admin_access', 'usermanager', 'index');
//if($_POST['req']){
$sql = $Db->query('select * from group_user','');
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
