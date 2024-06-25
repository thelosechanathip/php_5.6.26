<?PHP include_once '../../../lib/config.inc.php';
$Db = new MySqlConn; 
if($_POST['req']=='req'){
              
$sql="SELECT * from employee where fname like '".$_POST['fullname']."%'
";

                $sql = $Db->query($sql, '');
               $data = array();
        foreach ($sql as $row ) {
            $data[] = $row ;
        }
                $response = array(
      
        "data" => $data
    );	
                echo json_encode($response);   
}       
     ?>
