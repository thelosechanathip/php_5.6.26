

<?PHP include_once '../../../lib/config.inc.php';
$Db2 = new MySqlConn5; 


              
$sql="select i.hn,i.refer_out_number,i.an,i.regdate,i.regtime,i.ward,ia.bedno  ,  concat(p.pname,p.fname,'  ',p.lname) as ptname  ,  a.age_y,i.pttype ,pty.name as pttype_name,pg.labor_date,it.name as deliver_type_name   ,w.name as ward_name  ,  (to_days(i.regdate)-to_days(il.lmp)) div 7 as ga,pg.child_count,pg.anc_complete ,l.infant_apgarscore1,l.infant_apgarscore5,l.infant_apgarscore10 ,  d.name as labor_doctor_name ,ilf.birth_weight as infant_weight,ilf.body_length as infant_length  ,  concat(il.g,'-',il.t,'-',   il.p,'-',il.a,'-',il.l) as gpal ,l.mother_hct ,  i.prediag, a.pdx  ,ic.name as main_pdx_name ,l.labour_finishtime , concat(p.addrpart,' ม.',p.moopart,' ',t.full_name) as address_name  , ro.docno as refer_out_docno from ipt i  left outer join iptadm ia on ia.an=i.an  left outer join patient p on p.hn=i.hn  left outer join an_stat a on a.an=i.an  left outer join pttype pty on pty.pttype=i.pttype  left outer join ward w on w.ward = i.ward  left outer join ipt_pregnancy pg on pg.an = i.an  left outer join ipt_pregnancy_deliver_type it on it.id = pg.deliver_type  left outer join labor l on l.an = i.an   left outer join ipt_labour il on il.an = i.an  left outer join ipt_labour_infant ilf on ilf.ipt_labour_id = il.ipt_labour_id and ilf.infant_number = 1  left outer join doctor d on d.code = l.labor_who  left outer join icd101 ic on ic.code = a.pdx  left outer join thaiaddress t on t.addressid = a.aid  left outer join referout ro on ro.vn = i.an  where i.ipt_type=4  and i.an  in (select an from labor )  and i.regdate between '2018-06-01' and '2018-06-29'  order by i.regdate desc,i.regtime desc
";

                $sql = $Db2->query($sql, '');
               $data = array();
        foreach ($sql as $row ) {
            $data[] = $row ;
        }
                $response = array(
      
        "data" => $data
    );	
                echo json_encode($response);   
  
     
