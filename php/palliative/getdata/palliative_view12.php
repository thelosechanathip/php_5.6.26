 
<table width="60%" align="left" border="0">
  <tr>
    <th scope="col">
    
    <?php
$dt1 = $_GET["dt1"];
$dt2 = $_GET["dt2"];
	
	include "condb.php";
	 $sql1 = "select count(DISTINCT o.hn) AS 'Sum'
from ovstdiag o
left outer join vn_stat v on v.vn=o.vn
WHERE o.icd10 in (\"Z515\") and v.vstdate between '".$dt1."' AND '".$dt2."' 
";
$result1=mysqli_query($conn,$sql1);
	$result_show1 = mysqli_query($conn,$sql1) or die(mysqli_error());
	$row_show1 = mysqli_fetch_array($result_show1);
	 while($row1=mysqli_fetch_array($result1, MYSQLI_ASSOC) ){	 ?>
    
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?=$row1["Sum"]?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>จำนวนผู้ป่วย</h4>
      </div>
    </div>
  
         <?php
			 	 }?></th>
  </tr>
</table>
 <p>&nbsp;</p>
 <p><br />
   
   
 </p>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ลำดับ</th>
      <th scope="col">hn</th>
      <th scope="col">ชื่อ-สกุล</th>
      <th scope="col">ที่อยู่</th>
      <?php 

include "condb.php";


$sql = "select DISTINCT o.hn AS 'hn',CONCAT(pt.pname,'',pt.fname,' ',pt.lname) as ชื่อ,pt.informaddr as ที่อยู่
from ovstdiag o
left outer join vn_stat v on v.vn=o.vn
LEFT JOIN patient pt on pt.hn=o.hn
WHERE o.icd10 in (\"Z515\") and v.vstdate between '".$dt1."' AND '".$dt2."' ";
$result=mysqli_query($conn,$sql);
	$result_show = mysqli_query($conn,$sql) or die(mysqli_error());
	$row_show = mysqli_fetch_array($result_show);
	$i = 1;
			   while($row=mysqli_fetch_array($result, MYSQLI_ASSOC) ){	
?>
    </tr>
  </thead>
  <tbody> 
    <tr>
      <td scope="col"><?=$i;?></td>
      <td scope="col"><?=$row["hn"]?></td>
      <td scope="col"><?=$row["ชื่อ"]?></td>
      <td scope="col"><?=$row["ที่อยู่"]?></td>
             <?php
			 $i++;	 }?>
    </tr>
  </tbody>
</table>

