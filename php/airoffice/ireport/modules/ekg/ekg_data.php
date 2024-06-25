
<?PHP include_once '../../../lib/config.inc.php';
$Db2 = new MySqlConn5; 
         
$sql=" SELECT *
FROM vn_stat 
WHERE  vstdate='2018-10-10'
";

                $sql = $Db2->query($sql, '');
                //$data = array();
        foreach ($sql as $row ) {
            $q = array();
          $q['hn']= $row['hn'];
        
          $data[] = $q;
           
        }
                $response = array(
      
        "data" => $data
    );	
   
                echo json_encode($response);   
  
               
