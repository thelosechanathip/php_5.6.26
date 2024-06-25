

<?PHP include_once '../../../lib/config.inc.php';
$Db2 = new MySqlConn5; 


              
$sql=" SELECT pt.hn,concat(pt.pname,pt.fname,' ',pt.lname)AS fullname, op.vstdate, op.fbs,pt.moopart,pt.tmbpart,pt.amppart,pt.chwpart,pt.informaddr from opdscreen   op
left outer join clinicmember cm on cm.hn=op.hn
left outer join patient pt on pt.hn=op.hn
WHERE  op.vstdate between '".$_POST['DateStart']. "' and '".$_POST['DateEnd'] ."'
and cm.clinic=001    and op.fbs<>'' and  pt.chwpart='47' and pt.amppart='11' and pt.tmbpart ='01' and pt.moopart in (".$_POST['cup'].")
group by op.hn ";

                $sql = $Db2->query($sql, '');
                //$data = array();
        foreach ($sql as $row ) {
            $q = array();
          $q['hn']= $row['hn'];
          $q['vstdate']= $row['vstdate'];
          $q['fullname']= $row['fullname'];
          $q['fbs']= $row['fbs'];
          $q['informaddr']= $row['informaddr'];
          $data[] = $q;
           
        }
                $response = array(
      
        "data" => $data
    );	
   
                echo json_encode($response);   
  
               
