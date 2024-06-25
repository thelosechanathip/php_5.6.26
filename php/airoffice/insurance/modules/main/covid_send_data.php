<?PHP include_once '../../../lib/config.inc.php';
$Db2 = new MySqlConn5; 


              
$sql="select opd.cc,concat(pt.pname,pt.fname,' ',pt.lname) as fullname,pt.cid,pt.birthday,year(now())-year(pt.birthday) as age ,pt.hn,pt.cid,vn.pttype,vn.vstdate,ptt.name from vn_stat vn
left outer join patient pt on pt.hn=vn.hn
left outer join pttype ptt on ptt.pttype=vn.pttype
left outer join ovst ov on ov.vn=vn.vn
left outer join opdscreen opd on opd.vn=vn.vn
where vn.vstdate between '2022-06-30' and date(now()) and  ov.cur_dep='053' and
vn.pdx =''";

                $sql = $Db2->query($sql, '');
               $data = array();
        foreach ($sql as $row ) {
            $data[] = $row ;
        }
                $response = array(
      
        "data" => $data
    );	
                echo json_encode($response);   
  

    
 