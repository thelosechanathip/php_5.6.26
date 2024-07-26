<?php
$hostname_ConnHos = '10.10.10.5';
$username_ConnHos = 'sa';
$password_ConnHos = 'sa';
$database_ConnHos = 'hos';

$ConnHos = mysqli_connect($hostname_ConnHos, $username_ConnHos, $password_ConnHos, $database_ConnHos);

if (!$ConnHos) {
    trigger_error(mysqli_connect_error(), E_USER_ERROR);
}

mysqli_set_charset($ConnHos, "utf8");
?>
