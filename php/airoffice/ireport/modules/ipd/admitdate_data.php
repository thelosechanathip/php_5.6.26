

<?PHP include_once '../../../lib/config.inc.php';
$Db5 = new MySqlConn5; 


              
$sql=" select ipt.hn,ipt.an,concat(pt.pname,pt.fname,' ',pt.lname) as fullname,pt.moopart,pt.tmbpart,pt.amppart,pt.chwpart,pt.informaddr,an.pdx,ipt.regdate,ipt.dchdate,ward.name as wardname,ptt.name as ptname from ipt
inner join patient pt on pt.hn=ipt.hn
inner join ward on ward.ward=ipt.ward
left outer join pttype ptt on ptt.pttype=ipt.pttype
left outer join an_stat an on an.an=ipt.an
where  ward.ward ='".$_POST['ward']."' AND ipt.regdate  BETWEEN '".$_POST['DateStart']."' AND '".$_POST['DateEnd']."'
";

                $sql = $Db5->query($sql, '');
                //$data = array();
        foreach ($sql as $row ) {
        $q = array();
          $q['hn']= $row['hn'];
          $q['an']= $row['an'];
          $q['fullname']= $row['fullname'];
          $q['pdx']=$row['pdx'];
          $q['regdate']=DateThai($row['regdate']);
          if($row['dchdate'] == null){
                $q['dchdate']= '';
          }else{
                $q['dchdate']=  DateThai($row['dchdate']);
          }
          $q['ptname']=$row['ptname'];
 $q['moopart']=$row['moopart'];
          $q['tmbpart']=$row['tmbpart'];
          $q['amppart']=$row['amppart'];
          $q['chwpart']=$row['chwpart'];
          $q['informaddr']=$row['informaddr'];
          $q['wardname']=$row['wardname'];
         // $q['birthday']= DateThai($row['birthday']);
          $data[] = $q;
           
        }
                $response = array(
      
        "data" => $data
    );	
   
                echo json_encode($response);   
  
               
