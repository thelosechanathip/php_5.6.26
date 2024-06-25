<?php
include_once '../../../lib/config.inc.php';
$Db = new MySqlConn;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
  
   
    $filename = $_FILES["file"]["name"];
	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
	$file_ext = substr($filename, strripos($filename, '.')); // get file name
	$filesize = $_FILES["file"]["size"];
	$allowed_file_types = array('.doc','.docx','.rtf','.pdf');	

	if (in_array($file_ext,$allowed_file_types) && ($filesize < 2000000))
	{	
		// Rename file
		$newfilename = md5($file_basename) . $file_ext;
		if (file_exists("files/" . $newfilename))
		{
			// file already exists error
			echo "You have already uploaded this file.";
		}
		else
		{		
		move_uploaded_file($_FILES["file"]["tmp_name"], "files/" . $newfilename);
        $data = array(
            'topic_doc' => $_POST['topic'],
            'date_pub_doc'=>$_POST['date_pub_doc'],
            'publish_id'=>$_POST['userid'],
            'publisher_date'=>$_POST['publisher_date'],
            'catagory_doc'=>$_POST['catagory_doc'],
            'publish_file'=>$newfilename
    
        );
            $Db->insert('web_publish_document',$data);
    		 echo "File uploaded successfully.";
		}
	}
	elseif (empty($file_basename))
	{	
		// file selection error
		echo "Please select a file to upload.";
	} 
	elseif ($filesize > 2000000)
	{	
		// file size error
		echo "The file you are trying to upload is too large.";
	}
	else
	{
		// file type error
		echo "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
		unlink($_FILES["file"]["tmp_name"]);
	}
}