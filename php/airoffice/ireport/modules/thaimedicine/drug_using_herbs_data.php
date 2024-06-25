
<?php
include_once '../../../lib/config.inc.php';
$Db2 = new MySqlConn5;
 

//ตรวจสอบว่ามีการส่งค่าตัวแปร $_POST['value'] หรือไม่
//MySqli Select Query
//$value = $_POST['value'];
if($_POST['acc']=='data'){
    $sql = "select i.vstdate,i.icode,d.did,d.name,sum(qty) as cc ,d.unitprice
    ,sum(qty)*d.unitprice as cs
from opitemrece i
left join drugitems d on d.icode = i.icode
left join pttype ptt on ptt.pttype = i.pttype
where i.vstdate BETWEEN '".$_POST['DateStart']."' AND '". $_POST['DateEnd'] ."' and d.drugcategory like '%สมุน%'
group by d.name
order by cc desc";



                $query2 = $Db2->query($sql,'');
         
                   
          
?>
 <table  class="table table-bordered">
        <thead>
            <tr>
                <th colspan="6"><h2 class="text-center">รายงานการใช้ยาสมุนไพรของโรงพยาบาลอากาศอำนวย </h2>
                    <div class="text-center">ตั้งแต่  <?PHP echo DateThai($_POST['DateStart']); ?>     ถึง  <?PHP echo DateThai($_POST['DateEnd']); ?> </div> </th>
            </tr>
            <tr style="background-color:#006699; color:#ffffff;">
                <th width="3">ลำดับ</th>
                <th>ชื่อยาสมุนไพร</th>
                <th>รหัสยาสมุนไพร</th>
                <th>ราคา/หนวย</th>
                <th>จำนวน</th>
                <th>รวม</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_array($query2) && sizeof($query2)) { // ตรวจสอบค่าที่ส่งมาว่าเป็น array หรือไม่

                $no = 0;
                $total_sum_price = 0;
                $count_qty = 0;
                foreach ($query2 as $row) {
                    $no++;
                    $total_sum_price += $row['cc'];
                    $count_qty += $row['cs'];
                    ?>
                    <tr>
                        <td width='2'><?= $no; ?></td>
                        <td width='50%' ><?= $row['name']; ?></td>
                        <td width="8"><?= $row['icode']; ?></td> 
                        <td width='20'><?=number_format($row['unitprice'], 2, '.', ''); ?></td>
                        <td width='10'><?= $row['cc']; ?></td>
                
                        <td width='10'><?=number_format($row['cs'], 2, '.', ''); ?></td>

                    </tr>

                <?php }
                ?> <tr>

                    <td colspan="3"><h4>รวม</h4></td>
                    <td rowspan="2"></td>
                    <td style="background-color:#666699; color:#ffffff;"><?=$total_sum_price." หน่วย"; ?></td>
                    <td style="background-color:#3366FF; color:#ffffff;"><?=number_format($count_qty, 2, '.', '')." บาท";?></td>

                </tr>
                <?PHP
               
            }
            
            ?>
        </tbody>
      
    </table>
  วันที่เรียกรายงาน: <?PHP echo DateThai(date('ymd')) ?>
<?php

}
 ?>


   
