

<?PHP include_once '../../../lib/config.inc.php';
$Db2 = new MySqlConn5; 


              
$sql="SELECT vn.vn,ov.vn,ov.vstdate,ov.hn,pt.cid,CONCAT(pt.pname,pt.fname,' ',pt.lname) AS ptname ,CONCAT(pt.addrpart,' หมู่  ',pt.moopart,' ',th.full_name) AS addr
,GROUP_CONCAT(DISTINCT if(ov.icd10 LIKE 'C%',ov.icd10,NULL)) AS C 
,GROUP_CONCAT(DISTINCT if(ov.icd10 LIKE 'Z515',ov.icd10,NULL)) AS Z 
,GROUP_CONCAT(DISTINCT if(ov.icd10 NOT IN ('C%' OR 'Z5%'),ov.icd10,NULL)) AS AA 
,if(ISNULL(pt.death) OR pt.death='','N',pt.death) AS death
 ,GROUP_CONCAT(DISTINCT ot.ovst_community_service_type_name) AS community,
 GROUP_CONCAT(DISTINCT sd.name,'  ',op.qty,'  ',sd.units) AS s_drug
FROM ovstdiag ov  
LEFT JOIN ovst_community_service oc ON oc.vn=ov.vn AND oc.ovst_community_service_type_id BETWEEN 1 AND 103
LEFT JOIN ovst_community_service_type ot ON ot.ovst_community_service_type_id=oc.ovst_community_service_type_id
LEFT JOIN patient pt ON pt.hn=ov.hn
INNER JOIN vn_stat vn ON vn.vn=ov.vn
LEFT JOIN opitemrece op ON op.vn=ov.vn
INNER JOIN s_drugitems sd on sd.icode=op.icode AND sd.icode IN ('1000196','1540004','1550092','1560072','1580024','1590051','161022')
LEFT JOIN thaiaddress th ON th.addressid = CONCAT(pt.chwpart,pt.amppart,pt.tmbpart)

WHERE   ov.vstdate BETWEEN '".$_POST["date_start"]."' AND '".$_POST["date_end"]."' GROUP BY ov.vn ORDER BY ov.vstdate DESC";

                $sql = $Db2->query($sql, '');
               $data = array();
        foreach ($sql as $row ) {
            $data[] = $row ;
        }
                $response = array(
      
        "data" => $data
    );	
                echo json_encode($response);   
  
     
