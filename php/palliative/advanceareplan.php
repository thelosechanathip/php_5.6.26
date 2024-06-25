
<script src="https://code.highcharts.com/highcharts.js"></script>

<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script src="https://code.highcharts.com/modules/export-data.js"></script>

<!DOCTYPE html>
<meta charset="utf-8">
<?php
$_SESSION["menu"] = 100;
include "inc_header.php";
include "connection.php";
	date_default_timezone_set('Asia/Bangkok'); 
	$date = new DateTime();
  
?>
<?php

function DateThai($strDate)
				{
					$strYear = date("Y",strtotime($strDate))+543;
					$strMonth= date("n",strtotime($strDate));
					$strDay= date("j",strtotime($strDate));
					$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
					$strMonthThai=$strMonthCut[$strMonth];
					return "$strDay $strMonthThai $strYear";
				}
?>
<?php
?>
<head>

 

  <title>ติดตามการรักษา</title>

  <!-- Custom fonts for this template -->
 

</head>

<body id="page-top">
  <div id="content">
    <div class="row">
      <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
     
<?php

include "inc_footer.php";

?>
 <form method="post" action="add_file_db.php" enctype="multipart/form-data"> 
                        <div class="card-body">
          <div class="form-group col-md-12">                          
          <div class="form-group row">
                                    <label class="col-md-12"><h3>AdvanceCarePlan </h3></label>
            <div class="col-md-4">
              
        <form class="row g-6">
  <div class="col-md-12">
  </div>            
            </div>

        
            </div>
</div>

        <form class="row g-3">
        <div class="col-md-12">
    <label for="inputEmail4" class="form-label">CID              <a href="#" class="text-decoration-none">โปรดใส่เลขบัตรให้ถูกต้อง</a></label>
    <input type="text" name="cid" class="form-control" id="cid">
  </div>
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">ชื่อ-สกุล</label>
    <input type="text" name="name" class="form-control" id="name">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">เบอร์ติดต่อ</label>
    <input type="text" name="tot" class="form-control" id="tot">
  </div>
  <br>
  <br>

  <br>
    <div class="col-md-6">
    <label for="inputEmail4" class="form-label">แพทย์ติดตามอาการ</label>
    <input type="text" name="doctor" class="form-control" id="doctor">
  </div>
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">ผู้ลงข้อมูล</label>
    <input type="text" name="doctor1" class="form-control" id="doctor1">
  </div>

  </div>
  <div class="col-md-4">
    <label for="inputCity" class="form-label">วันที่ลงข้อมูล</label>
    <input type="text" class="input-sm form-control" name="date" id="date" value="<?php echo $date->format('d/m/Y'); ?>">
  </div>


  <div class="col-md-12">
    <br>
    <label for="inputEmail4" class="form-label">อัพโหลดไฟล์</label>
    <input type="file" name="image[]" id="image[]" multiple class="form-control">
    <br>
    <br>
    <div class="col-md-4">
    <p align="center"><button type="submit" class="btn btn-Success" id="butsave">บันทึกข้อมูล<span class="glyphicon glyphicon-send"></span></button></p>
  </div>
       
      </div>
      </div>
    </div>
    <?php
  //1. เชื่อมต่อ database: 
  include('connection.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

  
  //2. query ข้อมูลจากตาราง: 
  $query = "SELECT * FROM uploads "or die("Error:" . mysqli_error()); 
  //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . 
  $result = mysqli_query($con, $query); 
  //4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล: 

  
?>
 
  <table id="dynamic-table" class="table table-striped table-bordered table-hover">
  
  <thead>
  
    <tr>
  
  <tr>

  <th width="150"> <div align="center">cid</div></th>
  <th width="150"> <div align="center">ชื่อ-สกุล</div></th>
  <th width="150"> <div align="center">เบอร์ติดต่อ</div></th>
  <th width="150"> <div align="center">รูป/ไฟล์</div></th>
  <th width="150"> <div align="center">ชื่อไฟล์</div></th>
  <th width="150"> <div align="center">แพทย์ผู้ติดตาม</div></th>
  <th width="150"> <div align="center">ผู้ลงข้อมูล</div></th>
  <th width="150"> <div align="center">วันที่ลงข้อมูล</div></th>
  <!--<th width="150"> <div align="center">แก้ไข</div></th>-->
  <th width="150"> <div align="center"></div></th>
  </tr>
  <?php
    while($row = mysqli_fetch_array($result))
    {
  ?>
  <tr>

  <td><div align="center"><?php echo $row["cid"];?></div></td>
  <td><div align="center"><?php echo $row["name"];?></div></td>
  <td><div align="center"><?php echo $row["tot"];?></div></td>
  <?php echo "<td>"."<img src='upload/".$row[fileupload]."' width='100'>"."</td>";?>
  <td><center><a href="upload/<?php echo $row["fileupload"];?>"><?php echo $row["fileupload"];?></a></center></td>
  <td><div align="center"><?php echo $row["doctor"];?></div></td>
  <td><div align="center"><?php echo $row["doctor1"];?></div></td>
  <td><div align="center"><?php echo $row["date"];?></div></td>
  <!-- <td><center><a href="advanceareplanup.php?upload_id=<?php echo $row["upload_id"];?>"><img src="icon/3592869-compose-create-edit-edit-file-office-pencil-writing-creative_107746.ico" alt="" border="0"></a></center></td>-->
  <td><div align="center"> <?php echo"<a href=\"fromdelete.php?upload_id=".$row["upload_id"]."\" onClick=\"return confirm('คุณต้องการลบหรือไม่')\">";?><img src="icon/trash-can_115312.ico" alt="" border="0"></a></div></td>
  
  
  <?php
    }
  ?>
  
  </tbody>
  
  </table>
  <?php
  mysqli_close($objConnect);
  ?>

  
 </div>
  </div>
</div>
</div>

 </form>
    <!-- End of Topbar -->
    

</body>
</span>
</form>
</html>
