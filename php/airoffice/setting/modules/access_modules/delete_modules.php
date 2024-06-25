<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../../../lib/config.inc.php';
$Db = new MySqlConn;
if ($_POST['delete_modules'] == 'delete') {
    $Db->where('acoperation_id',$_POST['id']);
    $Db->delete('acoperation');
}