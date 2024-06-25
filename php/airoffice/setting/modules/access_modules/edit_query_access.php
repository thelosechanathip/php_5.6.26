<?php
include_once '../../../lib/config.inc.php';
$Db = new MySqlConn;

       //$sql=array("group_user_name"=>"yeaw","group_user_id"=>"1");
    $Db->where('acoperation_id',$_POST['sql']);
$sql = $Db->query('select * from acoperation ', '');
       
 /*$date = '1,12,36';
     
    $e = explode(",", $date);
     
    echo "Date Original = ".$date;
    echo "<br/>";
    echo "Year = ".$e[0]." / Month = ".$e[1]." / Day = ".$e[2];*/

$a_data=array();
          foreach ($sql as $row){
            $e = explode(",", $row['acoperation_user']);
            $e2 = explode(",", $row['acoperation_group']);
                 array_push($a_data,$row);	
                 
             }
           $c=array('acoperation_user2'=>$e ); 
           $d=array('acoperation_group2'=>$e2 ); 
             $b=array_merge($row,$c,$d);
echo json_encode($b);
    