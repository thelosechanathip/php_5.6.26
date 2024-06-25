 <?php
header("Content-type:text/html; charset=UTF-8");          
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false); 
include_once '../../../lib/config.inc.php';
$Db = new MySqlConn;
// ส่วนของการเพิ่ม ลบ แก้ไข ข้อมูล
if ($_POST['saveBtn']) {  //ถ้ามีการกดปุ่ม saveBtn
    if ($_POST['edit_access']) { //ถ้ามีการส่งค่า group_user_id มาแสดงว่าเป็นการแก้ไข
        

        $a = array ('acoperation_modules' => $_POST['ModuleNameEn'],
        'acoperation_thai_name_modules'=>$_POST['ModuleNameTh'],
        'main_modules'=>$_POST['main_modules']
         
    );
$delimiter = '';
$string = '';
foreach($_POST['acuser'] as $id){

   $string .= $delimiter . $id;
   $delimiter = ',';
}
$delimiter2 = '';
$string2 = '';
foreach($_POST['acgroup'] as $id){

   $string2 .= $delimiter2 . $id;
   $delimiter2 = ',';
}
$group=array('acoperation_group'=>$string2 );
 $c=array('acoperation_user'=>$string ); 
$b=array_merge($a,$c,$group);
      
        $Db->where('acoperation_id', $_POST['edit_access']);
        $Db->update('acoperation', $b);
  
}  else { //ถ้าไม่มีการส่งค่า uid มา แสดงว่าบันทึกใหม่
    
  
$a = array ('acoperation_modules' => $_POST['ModuleNameEn'],
            'acoperation_thai_name_modules'=>$_POST['ModuleNameTh'],
            'main_modules'=>$_POST['main_modules']
             
        );
   $delimiter = '';
   $string = '';
   foreach($_POST['acuser'] as $id){
    
       $string .= $delimiter . $id;
       $delimiter = ',';
   }
   $delimiter2 = '';
   $string2 = '';
   foreach($_POST['acgroup'] as $id){
    
       $string2 .= $delimiter2 . $id;
       $delimiter2 = ',';
   }
    $group=array('acoperation_group'=>$string2 );
     $c=array('acoperation_user'=>$string ); 
    $b=array_merge($a,$c,$group);
print_r($b);

$Db->insert('acoperation', $b);
}
    
  
}