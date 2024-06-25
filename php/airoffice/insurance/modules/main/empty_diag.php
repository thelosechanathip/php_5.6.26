<section class="content-header">
      <h1>
        จำนวนผู้ป่วยที่ไม่ได้ลงวินิจฉัย
        <small>แยกรายแผนก</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"></li>
      </ol>
    </section>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>

              <form action="" method="POST" id="chk_diag">
            <div class="row input-daterange">
            
            <button class="btn btn-primary btn-lg btn-block" type="submit">ประมวลผล</button>
          </form>
            </div>
            <!-- /.box-header -->
          
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

<?php

 
  /*  $date1 = "11-11-2019";
    $date = strtotime($date);
    $date = strtotime("-1 day", $date);
    echo date('Y-m-d', $date);*/
// Start date
// Start date
  $date_diag = '2019-11-09';
  // End date
  $end_date_diag = date('Y-m-d');

  while (strtotime($date_diag) <= strtotime($end_date_diag)) {
                echo "$date_diag\n";



                $date_diag = date ("Y-m-d", strtotime("+1 day", strtotime($date_diag)));
  }
 ?>
     
