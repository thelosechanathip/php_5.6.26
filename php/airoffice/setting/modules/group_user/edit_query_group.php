<?php
include_once '../../../lib/config.inc.php';
$Db = new MySqlConn;

       //$sql=array("group_user_name"=>"yeaw","group_user_id"=>"1");
    $Db->where('id',$_POST['sql']);
$sql = $Db->query('select * from group_user', '');
            $a_data=array();
          foreach ($sql as $row){
                 array_push($a_data,$row);	
                 
             }
echo json_encode($row);
    