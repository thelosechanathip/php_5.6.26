<?php

header("Content-type:application/json; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

    include_once '../../../lib/config.inc.php';
    $Db = new MySqlConn;
 if (isset($_POST['action']) && $_POST['action'] == "list") {
    $sql = "SELECT * FROM insurance_error_pttype";

   
    $result = $Db->query($sql, '');

    foreach ($result AS $row) {
        $no++;
        $json_data['data'][] = array(
            "no" => $no,
            "hn" => $row['hn'],
            "fullname" => $row['fullname'],
             "cid"=>$row['cid'],
             "vstdate"=>$row['vstdate'],
            "vsttime"=>$row['vsttime'],
                 "name_staff"=>$row['name_staff'],
             "hosname"=>$row['hosname']
        );
    }
    if (isset($json_data)) {
        $json = json_encode($json_data);
        if (isset($_GET['callback']) && $_GET['callback'] != "") {
            echo $_GET['callback'] . "(" . $json . ");";
        } else {
            echo $json;
        }
    }
 }