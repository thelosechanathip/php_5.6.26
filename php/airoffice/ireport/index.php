<?PHP
session_start();
include_once '../lib/config.inc.php';
$Db = new MySqlConn;
$Db2 = new MySqlConn2;
$Db5 = new MySqlConn5;
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title></title>

    <!-- Bootstrap core CSS -->
    <link href="../includes/bootstrap-4.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../includes/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../includes/fonts/sanlife/stylesheet.css">
    <link rel="stylesheet" href="theme/css/main.css">
    <link rel="stylesheet" href="../includes/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="../includes/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.css">



     <script src="../includes/jquery-3.1.1.min.js"> </script>

<script src="../includes/bootstrap-4.1.0/js/bootstrap.min.js"></script>
<script src="../includes/validator/jquery.validate.min.js"></script>
<script src="../includes/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.min.js"></script>
<script src="../includes/bootstrap-datepicker-1.6.4/locales/bootstrap-datepicker.th.min.js"></script>
<script src="../includes/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
 <script src="../includes/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.js"></script>

 <script src="../includes/DataTables/Buttons-1.5.2/js/dataTables.buttons.js"></script>
 <script src="../includes/DataTables/Buttons-1.5.2/js/buttons.flash.min.js"></script>
 <script src="../includes/DataTables/JSZip-2.5.0/jszip.min.js"></script>
 <script src="../includes/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
 <script src="../includes/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
 <script src="../includes/DataTables/Buttons-1.5.2/js/buttons.html5.min.js"></script>
 <script src="../includes/DataTables/Buttons-1.5.2/js/buttons.print.min.js"></script>
 
 
  </head>

  <body class="bg-light">

    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <a class="navbar-brand" href="#"><i class="fa fa-band-aid"></i>I-REPORT</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">dashboard <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">งานเภสัชกรรม</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="?m=thaimedicine&p=drug_using_herbs">1.รายงานจำนวนและมูลค่าการใช้ยาสมุนไพร</a>
              <a class="dropdown-item" href="?m=thaimedicine&p=drug_using">2.สรุปรวมการใช้ยาแผนปัจจุบันผู้ป่วยนอก</a>
              <a class="dropdown-item" href="?m=thaimedicine&p=morphine_report">3.รายชื่อผู้ป่วยที่ใช้ Morphine</a>
              <a class="dropdown-item" href="?m=thaimedicine&p=favi">4.รายชื่อผู้ป่วยที่ใช้ Favipiravir(covid-19)</a>
              
            </div>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Chronic</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="?m=chronic&p=fbs_cup">1.รายชื่อตรวจ FBS ใน CUP</a>
            
            </div>
          </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">งาน Pallaitive</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="?m=palliative&p=palliative">1.ส่งข้อมูลให้งานเรียกเก็บ</a>
            
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">งานผู้ป่วยใน(IPD)</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="?m=ipd&p=refer_ipd">1.รายงาน refer ipd</a>
              <a class="dropdown-item" href="?m=ipd&p=admitdate_ipd">2.รายชื่อผู้ป่วย Admit ตามช่วงวันที่</a>
              <a class="dropdown-item" href="?m=ipd&p=dchdate_ipd">2.รายชื่อผู้ป่วย covid ที่จำหน่ายจาก รพ.สนาม ตามช่วงวันที่</a>
            
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">งานผู้ป่วยนอก(OPD)</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="?m=opd&p=refer_stroke">1.รายงานส่งต่อผู้ป่วย stroke</a>
            
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link " href="../" id="dropdown01"  aria-haspopup="true" aria-expanded="false">กลับหน้าหลัก</a>
            
          </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

   

    <main role="main" class="container-fluid">
   
    <?php
// Application 
$app = (isset($_GET['m']) ? $_GET['m'] : 'main');
$file = (isset($_GET['p']) ? $_GET['p'] : 'default');

if (file_exists('modules/' . $app . '/' . $file . '.php')) {
    include 'modules/' . $app . '/' . $file . '.php';
} else {
    echo '404,ไม่พบหน้าที่ท่านเรียก';
}
?>
    
   
    </main>
    <script type="text/javascript">


//date_piker
$('.input-daterange').datepicker({
    autoclose: true,
    language: "th-th",
    format: 'yyyy-mm-dd',
    todayHighlight: true,
   

});
$('.datepicker').datepicker({
    autoclose: true,
    language: "th-th",
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    
});
</script>

  </body>
</html>
