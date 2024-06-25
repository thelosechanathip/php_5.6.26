<?php

include_once '../../../lib/config.inc.php';

$Db = new MySqlConn;

// ส่วนของการเพิ่ม ลบ แก้ไข ข้อมูล
if ($_POST['saveBtn']) {  //ถ้ามีการกดปุ่ม saveBtn2
    if ($_POST['edit_user']) { //ถ้ามีการส่งค่า uid มาแสดงว่าเป็นการแก้ไข
        if ($_POST['pass_old'] == $_POST['password']) { //ถ้าไม่มีการเปลี่ยนพาสเวิดให้ใช้ตัวเดิม

            $data = array(
               
                'pname_id' => $_POST['pname'],
                'fname' => $_POST['fname'],
                'lname' => $_POST['lname'],
                'group_user_id' => $_POST['group_user'],
                'hospital_department_id' => $_POST['hospital_department']);
        } else {
            $data = array(
                
                'pass' => md5($_POST['password'])
                , 'pname_id' => $_POST['pname'],
                'fname' => $_POST['fname'],
                'lname' => $_POST['lname'],
                'group_user_id' => $_POST['group_user'],
                'hospital_department_id' => $_POST['hospital_department']
            );
        }
        $Db->where('uid', $_POST['edit_user']);
        $Db->update('employee', $data);
  
}  else { //ถ้าไม่มีการส่งค่า uid มา แสดงว่าบันทึกใหม่
      if($_POST['password']<>""){
        $data = array(
            'username' => $_POST['username'],
            'pass' => md5($_POST['password'])
            , 'pname_id' => $_POST['pname'],
            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'group_user_id' => $_POST['group_user'],
            'hospital_department_id' => $_POST['hospital_department']
        );
       
        $Db->insert('employee', $data);
    }
}}