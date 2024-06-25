
<?php
include_once '../../../lib/config.inc.php';

$Db2 = new MySqlConn5;
 

//ตรวจสอบว่ามีการส่งค่าตัวแปร $_POST['value'] หรือไม่
//MySqli Select Query
//$value = $_POST['value'];
if($_POST['acc']=='data'){
    $sql = "select op.vstdate,di.name,concat(pt.pname,pt.fname,' ',pt.lname) as fullname,pt.informaddr,op.qty from opitemrece  op
    right join patient pt on pt.hn=op.hn
    right join drugitems di on di.icode=op.icode
     where op.qty<>0 and  ( MONTH(vstdate) = ".$_POST['mountset']." ) AND YEAR(vstdate) = '".$_POST['yearset']."' and op.icode ='".$_POST['icode']."'";

 $query2 = $Db2->query($sql,'');
         
                   
          
?>
 <table  class="table table-bordered">
        <thead>
            <tr>
                <th colspan="6"><h2 class="text-center">รายงานการใช้ยาเสพติดให้โทษประเภท 2 โรงพยาบาลอากาศอำนวย </h2>
                    <div class="text-center"> </div> </th>
            </tr>
            <tr style="background-color:#006699; color:#ffffff;">
                <th width="3">ลำดับ</th>
                <th>วันที่</th>
                <th>ชื่อยา</th>
                <th>ชื่อ</th>
                <th>ทีอยู่</th>
                
                <th>จำนวน</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_array($query2) && sizeof($query2)) { // ตรวจสอบค่าที่ส่งมาว่าเป็น array หรือไม่

                $no = 0;
               // $total_sum_price = 0;
                //$count_qty = 0;
                foreach ($query2 as $row) {
                   $no++;

                    ?>
                    <tr>
                        <td width='2'><?= $no; ?></td>
                        <td width='10' ><?= $row['vstdate']; ?></td>
                        <td width='10'><?= $row['name']; ?></td>
                        <td width="20"><?= $row['fullname']; ?></td> 
                     
                        <td width='20'><?=$row['informaddr']; ?></td>
                     
                
                        <td width='10'><?=$row['qty']; ?></td>

                    </tr>
                   
                <?php
                 }
                ?> 
                <?PHP
               
            }
            
            ?>
        </tbody>
      
    </table>
  วันที่เรียกรายงาน: <?PHP echo DateThai(date('ymd')) ?>
<?php

}
 ?>


   
