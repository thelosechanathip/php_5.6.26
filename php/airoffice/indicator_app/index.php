<?PHP
session_start();
include_once '../lib/config.inc.php';
$Db = new MySqlConn;
$Db->rule('usermanager');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>ADMIN SYSTEM</title>
        <!-- Bootstrap -->
        <link href="../includes/bootstrap-4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="../includes/DataTables-1.10.13/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../includes/select2-4.0.6/css/select2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../includes/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker3.min.css">

         <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
         <script  src="../includes/jquery-3.1.1.min.js"></script>
                <!-- Include all compiled plugins (below), or include individual files as needed -->
                <script src="../includes/bootstrap-4.5.2/js/bootstrap.min.js"></script>
                <script src=" ../includes/DataTables-1.10.13/js/jquery.dataTables.min.js"></script>
                <script src="../includes/DataTables-1.10.13/js/dataTables.bootstrap.min.js"></script>

                <!-- validator -->

                <script src="../includes/validator/jquery.validate.min.js"></script>
                <script src="../includes/select2-4.0.6/js/select2.min.js"></script>
                <script src="../includes/sweet-alert.min.js"></script>
                <script src="../includes/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.min.js"></script>
                <script src="../includes/bootstrap-datepicker-1.6.4/locales/bootstrap-datepicker.th.min.js"></script>
    </head>
    <body>
        <div class="wrapper"> 
            <div class="header-top">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

            </div>
            <div class="container-fluid">
                <div class="container">
<?php
// Application 
$app = (isset($_GET['m']) ? $_GET['m'] : 'usermanager');
$file = (isset($_GET['p']) ? $_GET['p'] : 'userdata');

if (file_exists('modules/' . $app . '/' . $file . '.php')) {
    include 'modules/' . $app . '/' . $file . '.php';
} else {
    echo '404,ไม่พบหน้าที่ท่านเรียก';
}
?>
                </div> 
            </div>
        </div>  

        <!-- start:javascript -->

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