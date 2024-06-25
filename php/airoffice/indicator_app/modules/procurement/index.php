
<?PHP
$Db->rule('usermanager');
?>

  
    <title>Upload file Demo</title>
   
    <script type="text/javascript">
        $(document).ready(function () {
            $("#form").on("submit", function (event) {
                event.preventDefault(); //prevent default submitting
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: "modules/procurement/procurement_save.php",
                    type: "post",
                    data: formData,
                    processData: false, //Not to process data
                    contentType: false, //Not to set contentType
                    success: function (data) {
                        alert(data);
                    }
                });
            });
        });
    </script>
</head>
<body>
<!--<form id="form">
    <b>Upload file example</b>
    <br>
    <input type="text" id="topic" name="topic">
    <br>
    <input type="file" id="inputFile" name="inputFile"/>
    <br>
    <button type="submit" id="upload" name="upload">Upload</button>
</form>
-->
<form id="form" >
  <div class="form-row">
    <div class="col-md-12 mb-3">
      <label for="validationDefault01">หัวข้อเอกสาร</label>
      <input type="text" class="form-control" id="topic" name='topic'  required>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationDefault02">เลือกไฟล์</label>
      <input type="file" class="form-control-file" id="file" name="file">
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationDefault02">วันที่เผยแพร่</label>
      <input type="text" class="form-control datepicker" id="date_pub_doc" name="date_pub_doc" value="<?=date("Y-m-d");?>"  required>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationDefault03">หมวดหมู่เอกสาร</label>
      <select  class="form-control" id="catagory_doc" name="catagory_doc">
      <?php
                                                $sql = $Db->query('','web_cat_docpub');
                                                foreach ($sql as $row) {
                                                    ?>
                                                    <option value="<?php echo $row['web_cat_docpub_id'] ?>"> <?php echo $row['web_cat_docpub_name']; ?></option>
                                                <?php } ?>
      </select>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationDefault03">ผู้เผยแพร่</label>
      <input type="text" class="form-control" id="publisher" value="<?=$_SESSION['name'] .'  '. $_SESSION['lname'];?>" readonly>
      <input type="hidden" value="<?=$_SESSION['uid']?>" name="userid" id="userid" >
      <input type="hidden" value="<?=date("Y-m-d");?>" name="publisher_date" id="publisher_date" >
    </div>
   
   
  </div>
 
 
  <button  id="upload" name="upload" class="btn btn-primary" type="submit">เผยแพร่</button>
</form>