
<?php

/*$arr = array("one", "two", "three");

foreach ($arr as $value) {

echo "Value: $value<br>";

}*/
$str = "Jul 02 2013";
    $str = strtotime(date("M d Y ")) - (strtotime($str));
    echo floor($str/3600/24);

header("Content-type:application/json; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

    include_once '../../../lib/config.inc.php';
    $Db5 = new MySqlConn5;
   
 //if ( $_POST['action'] == "list") {
    $startdate=$_POST['DateStart'];
    $enddate=$_POST['DateEnd'];
    $sql = "select * from vn_stat vn where vn.vstdate between '2022-06-01' and date(now()) and vn.pttype in ('C1','C2','C3','C4','C5','C6','C7','C8') and
    vn.pdx =''";

    $num = $Db5->num_rows_qurery($sql, '');

   /* if ($num > 0) {
        $mms= " หน่วยงานที่ไม่มีวินิจฉัยในวันที่ ".DateThai($startdate);
        
    
    //}
            $lineapi = "pWbX0LTSy0HnUxWq2FE7CDt3qqsIgK2SmCepxCzkxPZ";
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
     
    //¶éÒµéÍ§¡ÒÃãÊèÃØ» ãËéãÊè 2 parameter imageThumbnail áÅÐimageFullsize
    
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
    
         
       $i=1;
        $result = $Db5->query($sql, '');
        foreach ($result AS $row) {
      

        //iNiWu4G08ols6Cp66UXNvayIYBNO1l8KYjbxZ9PUjwF เอาไว้ทดสอบ
        
        //wWhE4ZpvHO40gQzW27J8Vlps5fPyqn785qcK2iW6W6D กลุ่มงานประกัน
        
                //Wx6BYMBhxMJlrDjWuiD2m2LZ10m7Wf7IPODdgB5jfti กลุ่มตรวจสอบสิทธิ์
        
            //   echo  "หน่วยงาน : " . $row['department'] . ":" . $row['countpdx'] . " ราย"
        
            $mms= $i.".".$row['department']. $row['countpdx']."ราย";
            $i++;
        
        //}
                $lineapi = "pWbX0LTSy0HnUxWq2FE7CDt3qqsIgK2SmCepxCzkxPZ";
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
         
        //¶éÒµéÍ§¡ÒÃãÊèÃØ» ãËéãÊè 2 parameter imageThumbnail áÅÐimageFullsize
        
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

   /* foreach ($result AS $row) {
        $no++;
        $json_data['data'][] = array(
            "no" => $no,
            "department" => $row['department'],
            "countpdx"=>$row['countpdx'],
            "datestart"=>$_POST['DateStart']
            
        );
    }
    if (isset($json_data)) {
        $json = json_encode($json_data);
        if (isset($_GET['callback']) && $_GET['callback'] != "") {
            echo $_GET['callback'] . "(" . $json . ");";
        } else {
            echo $json;
        }
    }*/
   // }
    
 //}
