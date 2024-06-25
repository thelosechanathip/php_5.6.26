

<?PHP include_once '../../../lib/config.inc.php';
$Db2 = new MySqlConn2; 


              
$sql=" SELECT r.hn,ip.an,dch.name as dch_name,r.refer_number,r.refer_date,r.refer_time,concat(p.pname,p.fname,' ',p.lname) as ptname,
p.birthday,concat(timestampdiff(year,p.birthday,r.refer_date),' ','ปี','',
timestampdiff(month,p.birthday,curdate())-(timestampdiff(year,p.birthday,r.refer_date)*12),' ','เดือน',' ',
timestampdiff(day,date_add(p.birthday,interval (timestampdiff(month,p.birthday,r.refer_date)) month),r.refer_date),' ','วัน') as ptage   ,
r.pre_diagnosis,r.pdx,i.name as pdx_name,rcs.name as rcsf_name
FROM referout r 
INNER join patient p  ON p.hn=r.hn

left outer join icd101 i on r.pdx=i.code
left outer join rfrcs rcs on rcs.rfrcs=r.rfrcs
left outer join ipt ip on ip.an=r.vn
left outer join dchtype dch on dch.dchtype=ip.dchtype
WHERE ip.dchtype='04' AND r.department='IPD' AND r.depcode='".$_POST['ward']."' AND r.refer_date  BETWEEN '".$_POST['DateStart']."' AND '".$_POST['DateEnd']."'
";

                $sql = $Db2->query($sql, '');
                //$data = array();
        foreach ($sql as $row ) {
            $q = array();
          $q['hn']= $row['hn'];
          $q['an']= $row['an'];
          $q['dch_name']= $row['dch_name'];
          $q['refer_number']= $row['refer_number'];
          $q['refer_date']= DateThai($row['refer_date']);
          $q['refer_time']= $row['refer_time'];
          $q['ptname']= $row['ptname'];
          $q['birthday']= DateThai($row['birthday']);
          $q['ptage']= $row['ptage'];
          $q['pre_diagnosis']= $row['pre_diagnosis'];
          $q['pdx']= $row['pdx'];
          $q['pdx_name']= $row['pdx_name'];
          $q['rcsf_name']= $row['rcsf_name'];
          $data[] = $q;
           
        }
                $response = array(
      
        "data" => $data
    );	
   
                echo json_encode($response);   
  
               
