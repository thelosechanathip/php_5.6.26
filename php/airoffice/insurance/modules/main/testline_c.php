
<?php


include_once '../lib/config.inc.php';
$Db5 = new MySqlConn5;
$sql = "SELECT pat.cid, CONCAT(hp.hosptype,'',hp.name) AS hosname,CONCAT(pat.pname,pat.fname,' ',pat.lname) AS fullname,vn.vstdate,vn.hn,vn.vn,vn.pttype,vn.hospmain,ou.name AS name_staff ,pt.name AS typename FROM vn_stat vn
Left OUTER JOIN pttype pt ON pt.pttype=vn.pttype
LEFT OUTER JOIN patient pat ON pat.hn=vn.hn
LEFT OUTER JOIN hospcode hp ON hp.hospcode=vn.hospmain
INNER JOIN ovst ov ON ov.vn=vn.vn
LEFT OUTER JOIN opduser ou ON ou.loginname=ov.staff
WHERE vn.vstdate BETWEEN '2016-01-17' AND curdate() AND pt.hipdata_code IN('UCS','WELL') AND vn.pttype NOT IN ('13','15','98','58','40','99','17') AND vn.hospmain NOT IN('11098') ";

    $num = $Db5->num_rows_qurery($sql,'');
    echo $num;
   /* if ($num > 0) {
        $result = $Db5->query($sql, '');
foreach ($result AS $row) {




    // }

    $lineapi = "rbfY9nR6JY4RJFxgihWZH86fmfxfC1nQZuSz6xRsaRA";

//Yh4utKKKp2yFocrT3EkCb1S9SIMxIo2H2qf8RmqEfro
    $mms = "HN : " . $row['hn'] . "  วันรับบริการ :" . $row['vstdate'] . "       "
            . $row["fullname"] . "   " . "หมายเลข บัตร :" . $row['cid'] . "  สิทธิ์:" . $row['pttype'] . " " . $row['typename']
            . "  " . $row['hosname'] . "   " . "ผู้ส่งตรวจ:" . $row['name_staff']

    ;


    date_default_timezone_set("Asia/Bangkok");
//line Send

    $chOne = curl_init();
    curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
// SSL USE 
    curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
//POST 
    curl_setopt($chOne, CURLOPT_POST, 1);
// Message 
    curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=$mms");
//ถ้าต้องการใส่รุป ให้ใส่ 2 parameter imageThumbnail และimageFullsize
//curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$mms&imageThumbnail=http://plusquotes.com/images/quotes-img/surprise-happy-birthday-gifts-5.jpg&imageFullsize=http://plusquotes.com/images/quotes-img/surprise-happy-birthday-gifts-5.jpg&stickerPackageId=1&stickerId=100"); 
// follow redirects 
    curl_setopt($chOne, CURLOPT_FOLLOWLOCATION, 1);
//ADD header array 
    $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $lineapi . '',);
    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
//RETURN 
    curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($chOne);
//Check error 
    if (curl_error($chOne)) {
        echo 'error:' . curl_error($chOne);
    } else {
        $result_ = json_decode($result, true);
        echo "status : " . $result_['status'];
        echo "message : " . $result_['message'];
    }
//Close connect 
    curl_close($chOne);
}
    }*/
?>
