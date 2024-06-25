<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>UPLOAD FILE</title>
</head>
<body>
<?php
//1. เชื่อมต่อ database: 
include('connection.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
$id = $_REQUEST['id'];

//2. query ข้อมูลจากตาราง: 
$query = "SELECT * FROM uploads WHERE cid='$id' "or die("Error:" . mysqli_error()); 
//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . 
$result = mysqli_query($con, $query); 
//4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล: 
include "inc_header.php";


?>
<label class="col-md-12"><h3>เอกสารที่แนบมาด้วย <?php echo $row["name"];?></h3></label>
<table id="dynamic-table" class="table table-striped table-bordered table-hover">

<thead>

  <tr>

<tr>

<th width="150"> <div align="center">CID</div></th>
<th width="150"> <div align="center">ชื่อ-สกุล</div></th>
<th width="150"> <div align="center">เบอร์ติดต่อ</div></th>
<th width="150"> <div align="center">แพทย์ติดตามอาการ</div></th>
<th width="150"> <div align="center">ผู้ลงข้อมูล</div></th>
<th width="150"> <div align="center">รูป/ไฟล์</div></th>
<th width="150"> <div align="center"></div></th>
<th width="150"> <div align="center">วันที่ลงข้อมูล</div></th>
</tr>
<?php
	while($row = mysqli_fetch_array($result))
	{
?>
<tr>
  

<td><div align="center"><?php echo $row["cid"];?></div></td>
<td><div align="center"><?php echo $row["name"];?></div></td>
<td><div align="center"><?php echo $row["tot"];?></div></td>
<td><div align="center"><?php echo $row["doctor"];?></div></td>
<td><div align="center"><?php echo $row["doctor1"];?></div></td>
<?php echo "<td>"."<img src='upload/".$row[fileupload]."' width='50'>"."</td>";?>
<td><center><a href="upload/<?php echo $row["fileupload"];?>"><?php echo $row["fileupload"];?></a></center></td>
<td><div align="center"><?php echo $row["date"];?></div></td>

<?php
	}
?>

</tbody>

</table>
<div class="d-grid gap-2 col-6 mx-auto">
  <button class="btn btn-secondary" type="button" onclick="history.go(-1);">ย้อนกลับ</button>
</div></a>
<?php
mysqli_close($objConnect);
?>
</body>

<br/>
<!--
<form action="add_file_db.php" method="post" enctype="multipart/form-data" name="upfile" id="upfile">
  <p>&nbsp;</p>
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="40" colspan="2" align="center" bgcolor="#D6D6D6">Form Upload&nbsp;File</td>
    </tr>
    <tr>
      <td width="126" bgcolor="#EDEDED">&nbsp;</td>
      <td width="574" bgcolor="#EDEDED">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" bgcolor="#EDEDED">File Browser</td>
      <td bgcolor="#EDEDED"><label>
        <input type="file" name="fileupload" id="fileupload"  required="required"/>
      </label></td>
    </tr>
    <tr>
      <td bgcolor="#EDEDED">&nbsp;</td>
      <td bgcolor="#EDEDED">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#EDEDED">&nbsp;</td>
      <td bgcolor="#EDEDED"><input type="submit" name="button" id="button" value="Upload" /></td>
    </tr>
    <tr>
      <td bgcolor="#EDEDED">&nbsp;</td>
      <td bgcolor="#EDEDED">&nbsp;</td>
    </tr>
  </table>-->
</form>
</body>
</html>