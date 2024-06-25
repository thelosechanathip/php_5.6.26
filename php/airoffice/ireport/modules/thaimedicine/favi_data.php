

<?PHP include_once '../../../lib/config.inc.php';
$Db5 = new MySqlConn5; 


              
$sql=" select opi.hn,concat(pt.pname,pt.fname,' ',pt.lname) as fullname,opi.an ,pt.cid,opi.vstdate ,sum(opi.qty) as total from opitemrece opi
left outer join patient pt on pt.hn=opi.hn
where opi.vstdate between '".$_POST['DateStart']."' AND '".$_POST['DateEnd']."' and opi.icode='1640024' and qty>0
group by opi.hn
";

                $sql = $Db5->query($sql, '');
                //$data = array();
        foreach ($sql as $row ) {
        $q = array();
          $q['hn']= $row['hn'];
          $q['an']= $row['an'];
        $q['fullname']= $row['fullname'];
        $q['cid']= $row['cid'];
          $q['vstdate']=DateThai($row['vstdate']);
          $q['total']=$row['total'];
         
         // $q['birthday']= DateThai($row['birthday']);
          $data[] = $q;
           
        }
                $response = array(
      
        "data" => $data
    );	
   
                echo json_encode($response);   
  
               
