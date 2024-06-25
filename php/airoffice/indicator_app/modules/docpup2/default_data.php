<?PHP include_once '../../../lib/config.inc.php';
$Db = new MySqlConnWEB; 
if($_POST['req']=='req'){
              
$sql=" SELECT * FROM doc_publish  ";

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
