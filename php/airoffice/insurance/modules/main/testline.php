<?php




        $lineapi = "Wx6BYMBhxMJlrDjWuiD2m2LZ10m7Wf7IPODdgB5jfti";

//iNiWu4G08ols6Cp66UXNvayIYBNO1l8KYjbxZ9PUjwF เน€เธญเธฒเนเธงเนเธ—เธ”เธชเธญเธ

//wWhE4ZpvHO40gQzW27J8Vlps5fPyqn785qcK2iW6W6D เธเธฅเธธเนเธกเธเธฒเธเธเธฃเธฐเธเธฑเธ

        //Wx6BYMBhxMJlrDjWuiD2m2LZ10m7Wf7IPODdgB5jfti เธเธฅเธธเนเธกเธ•เธฃเธงเธเธชเธญเธเธชเธดเธ—เธเธดเน

        $mms = "ทดสอบระบบ"



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

//ยถรฉร’ยตรฉรยงยกร’รรฃรรจรรยป รฃรรฉรฃรรจ 2 parameter imageThumbnail รกร…รimageFullsize

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
