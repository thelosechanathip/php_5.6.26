<?php
session_start();
include_once 'lib/config.inc.php';
$Db = new MySqlConn;
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-OFFICE โรงพยาบาลอากาศอำนวย</title>

    <!-- Bootstrap -->
    <script src="includes/js/pace.js"></script>
    <link href="includes/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="includes/css/theme.css" rel="stylesheet">
    <link href="includes/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="includes/css/animate.css" rel="stylesheet">
	
        <link href="includes/css/theme-loading-bar.css" rel="stylesheet" />
   
  </head>
  <body>
	<div class="container" id="container" style="display:none;">
		<header>
			<!-- Main comapny header -->
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			  <div class="container">
				<div class="navbar-header">
				  <a class="navbar-brand top-navbar-brand" href="#"><img src="images/alpha-logo.png"/> AIR-OFFICE โรงพยาบาลอากาศอำนวย</a>
				</div> 
				
			  </div>
			</nav>
		</header>
		<section id="form" class="animated fadeInDown">
			<div class="container">    
				<div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
					<div class="panel white-alpha-90" >
						<div class="panel-heading">
							<div class="panel-title text-center"><h2>เข้าสู่ระบบ <span class="text-primary">e-office</span></h2></div>
						</div>     
						<div class="panel-body" >
							<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                                                        <form id="loginform" method="post" action="" class="form-horizontal" role="form">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input id="login-username" type="text" class="form-control" name="user" value="" placeholder="username">                                        
								</div>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input id="login-password" type="password" class="form-control" name="pass" placeholder="password">
								</div>
								<div class="input-group col-xs-12 text-center login-action">
								  <div class="checkbox">
									<label>
									  <input id="login-remember" type="checkbox" name="remember" value="1" style="margin-top: 10px;"> Remember me &nbsp;
                                                                          <span id="btn-login"><button name="login" type="submit" class="btn btn-success">Login  </button></span>
									</label>
								  </div>
								</div>
								<div style="margin-top:10px" class="form-group">
									<div class="col-sm-12 controls">
									  
									</div>
								</div>
							</form>     
						</div>                     
					</div>  
				</div>
			</div>
		</section>
		<footer>
			<nav class="navbar navbar-default navbar-fixed-bottom"> <ul class="nav navbar-nav navbar-right">
                            
			  <div class="container text-center">
				<div class="footer-content">
				พัฒนาโดย  <a href="" class="btn btn-primary"> งาน IT โรงพยาบาลอากาศอำนวย  </a>
				</div>
                             
			  </div><!-- /.container-fluid -->
			</nav>
		</footer>
	</div>

      <script src="includes/jquery-3.1.1.min.js"></script>
      <script src="includes/bootstrap-3.3.7/js/bootstrap.min.js"></script>
      <script src="includes/js/jquery.backstretch.min.js"></script>

	<script>
		Pace.on('hide', function(){
		  $("#container").fadeIn('1000');
		  $.backstretch([
				"images/taxi-1.jpg",
				"images/taxi-2.jpg"
			], {duration: 5000, fade: 1000});
		});
		
	</script>
	
  </body>
</html>
<?php if(isset($_POST['login'])){
    
    $data = array(
        'username' => $_POST['user'],
        'pass' => md5($_POST['pass'])
    );

    $Db->where_data($data, 'and');
    $num = $Db->num_rows('employee');
    if ($num > 0) {
        $Db->where('username', $_POST['user']);
        $sql = $Db->query('SELECT emp.*,gu.*  FROM employee emp LEFT JOIN group_user gu ON gu.id=emp.group_user_id', '');
        foreach ($sql AS $row) {
            $_SESSION['loginname'] = $row['username'];
            $_SESSION['name'] = $row['fname'];
			$_SESSION['lname'] = $row['lname'];
			$_SESSION['uid'] = $row['uid'];
						 $_SESSION['group_user_id'] = $row['group_user_id'];
						 $_SESSION['group_user_name'] = $row['group_user_name'];
						 $_SESSION['hospital_department_id'] = $row['hospital_department_id'];
            echo "<script> window.location.replace('index.php') </script>" ;
        }
    } else {
        echo "<script> alert('ชื่อหรือรหัสผ่านไม่ถูกต้อง')</script>" ;
        echo "<script> window.location.replace('login.php') </script>" ;
    }} ?>