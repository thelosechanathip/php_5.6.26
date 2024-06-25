<?php
session_start();
if(!isset($_SESSION['loginname']))
{
   
        echo "<script> window.location.replace('login.php') </script>" ;
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>ระบบ AIR-OFFICE</title>

        <!-- Bootstrap Core CSS -->
        <link href="includes/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="includes/css/theme-loading-bar.css" rel="stylesheet" />
        <!-- Font Awesome CSS -->
        <link href="includes/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
		
		<!-- Custom CSS -->
                <link href="includes/css/animate.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="includes/css/style.css" rel="stylesheet">

        <!-- Template js -->
        <script src="includes/jquery-3.1.1.min.js"></script>
        <script src="includes/bootstrap-3.3.7/js/bootstrap.min.js"></script>
        <script src="includes/js/jquery.appear.js"></script>
        
        <!-- progressbar -->
        <script src="includes/progess/js/jquery.progresstimer.js"></script>
    </head>
    <body>    
        <!-- Start Logo Section -->
        <section id="logo-section" class="text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <a href="#">
                        <div class="logo text-center">
                            <h1>E-OFFICE</h1>
                            <span>โรงพยาบาลอากาศอำนวย</span>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Logo Section --> 
        
        <!-- Start Main Body Section -->
        <div class="mainbody-section text-center">
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-4">
                        
                        <div class="menu-item blue">
                            <a href="ireport/">
                                <i class="fa fa-magic"></i>
                                <p>I REPORT</p>
                            </a>
                        </div>
                        
                        <div class="menu-item green">
                            <a href="#portfolio-modal" target="_blank" data-toggle="modal">
                                <i class="fa fa-ambulance"></i>
                                <p>จองรถออนไลน์</p>
                            </a>
                        </div>
                        
                        <div class="menu-item light-red">
                            <a href="../palliative" data-toggle="modal">
                                <i class="fa fa-user"></i>
                                <p>โปรแกรม palliative care</p>
                            </a>
                        </div>
                         
                    </div>
                    
                    <div class="col-md-4">
                                <div class="menu-item color">
                                    <a href="service_com/">
                                        <i class="fa fa-wrench"></i>
                                        <p>แจ้งซ่อม</p>
                                    </a>
                                </div>
                            
                                <div class="menu-item light-orange">
                                    <a href="" >
                                        <i class="fa fa-institution"></i>
                                        <p>โปรแกรมพัสดุ</p>
                                    </a>
                            </div>

                                <div class="menu-item purple">
                                    <a href="insurance/" data-toggle="modal">
                                        <i class="fa fa-usd"></i>
                                        <p>งานประกันสุขภาพ</p>
                                    </a>
                            </div>                        
                    </div>
                    
                    <div class="col-md-4">
                        
                        <div class="menu-item light-red">
                            <a href="indicator_app/" data-toggle="modal">
                                <i class="fa fa-users"></i>
                                <p>จัดการเว็บไซต์</p>
                            </a>
                        </div>
                        
                        <div class="menu-item color">
                            <a href="setting/">
                                <i class="fa fa-cogs fa-5x "></i>
                                <p>SETTING</p>
                            </a>
                        </div>
                        
                        <div class="menu-item blue">
                            <a href="logout.php">
                                <i class="fa fa-share-square-o"></i>
                                <p>ออกจากระบบ</p>
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- End Main Body Section -->
        
        <!-- Start Copyright Section -->
        <div class="copyright text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div>พัฒนาโดยงาน IT โรงพยาบาลอากาศอำนวย <a href="http://wwww.akathospital0.com" target="_blank">เว็บไซต์โรงพยาบาลอากาศอำนวย</a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Copyright Section -->
   
       

    </body>
    
</html>