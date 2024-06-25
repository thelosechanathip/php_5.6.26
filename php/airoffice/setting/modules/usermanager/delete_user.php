<?php

include_once '../../../lib/config.inc.php';

$Db = new MySqlConn;
if($_POST['delete_user']=='delete'){
    $Db->where('uid',$_POST['delete_id']);
        $Db->delete('employee');
}