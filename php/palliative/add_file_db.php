<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database: 
include('connection.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี



 $output_dir = "upload/";/* Path for file upload */
 $name = $_POST['name'];
 $cid = $_POST['cid'];
 $tot = $_POST['tot'];
 $doctor = $_POST['doctor'];
 $doctor1 = $_POST['doctor1'];
 $date = $_POST['date'];
    $fileCount = count($_FILES["image"]['name']);
	for($i=0; $i < $fileCount; $i++)
		
		{
            $RandomNum   = time();
			$remove_these = array(' ','`','"','\'','\\','/','_');
            $ImageName      = str_replace(' ','-',strtolower($_FILES['image']['name'][$i]));
            $ImageType      = $_FILES['image']['name'][$i]; /*"image/png", image/jpeg etc.*/
            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt       = str_replace('.','',$ImageExt);
            $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "".md5(time()), $ImageName);
            $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
            
            $ret[$NewImageName]= $output_dir.$NewImageName;
            
            /* Try to create the directory if it does not exist */
			if (!file_exists($output_dir . $last_id))
			{
				@mkdir($output_dir . $last_id, 0777);
			}
                        
            move_uploaded_file($_FILES["image"]["tmp_name"][$i],$output_dir.$last_id."/".$NewImageName );
		    
             $sql = "insert into `uploads` SET  `fileupload`='".$NewImageName."',`cid`='".$cid."',`name`='".$name."',`tot`='".$tot."',`doctor`='".$doctor."',`doctor1`='".$doctor1."',`date`='".$date."' ";

              $result = $con->query($sql);
               }

            //   $sql = "INSERT INTO uploadfile (fileupload,fileupload1,name) 
	//	VALUES('$newname','$newname1','$name')";	
		//$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	
	mysqli_close($con);
    
    if($result){
        echo "<script type='text/javascript'>";
        echo "alert('Upload File Succesfuly');";
        echo "window.location = 'advanceareplan.php'; ";
        echo "</script>";
        }
        else{
        echo "<script type='text/javascript'>";
        echo "alert('Error back to upload again');";
        echo "window.location = 'advanceareplan.php'; ";
        echo "</script>";

        }
        ?>