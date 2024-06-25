 <?PHP include_once '../../../lib/config.inc.php';
$Db = new MySqlConn; 
if($_POST['req']=='req'){
              
$sql="SELECT em.uid ,em.username,CONCAT(pname.pname,em.fname,' ',em.lname) AS fullname
     ,gu.group_user_name ,hd.name FROM employee em 
LEFT OUTER  JOIN pname ON pname.pname_id=em.pname_id
LEFT OUTER   JOIN hospital_department hd ON hd.id=em.hospital_department_id
LEFT OUTER   JOIN group_user gu ON gu.id=em.group_user_id";

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
