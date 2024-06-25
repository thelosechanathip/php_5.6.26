<?PHP
$Db->rule('refer_ipd');
?>

<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
  <li class="breadcrumb-item active">1.รายงาน refer ipd</li>
</ol>

   
   <div class="col-md-12 mb-3">
          
          <form action="" method="POST" id="refer_ipd">
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="firstName">ตั้งแต่วันที่</label>
                <input type="text" class="form-control" name="DateStart" id="DateStart" autocomplete=off>
               
              </div>
             
            </div>

           
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">ประมวลผล</button>
          </form>
        </div>
      </div>
        

   
              
 
 <div class="table-responsive">

    <table id="ff" class="table " cellspacing="0" width="100%">
    <thead  >
    
        <tr class="">
            <th>ลำดับ</th>  
        </tr>

    </thead>

    </table>


<script type="text/javascript">
$(document).ready(function(){
    $("#ff").dataTable().fnDestroy();
         
         var t = $('#ff').DataTable(
          
             {
                 "language": {
                     
           "sProcessing": "กำลังดำเนินการ...",
           "sLengthMenu": "แสดง_MENU_ แถว",
           "sZeroRecords": "ไม่พบข้อมูล",
           "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
           "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
           "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
           "sInfoPostFix": "",
           "sSearch": "ค้นหา:",
           "sUrl": "",
           "oPaginate": {
                         "sFirst": "เิริ่มต้น",
                         "sPrevious": "ก่อนหน้า",
                         "sNext": "ถัดไป",
                         "sLast": "สุดท้าย"
           },
          
  },
  
              
             ajax: {
                 url: "modules/ekg/ekg_data.php",
                 type: "post",
                datatype:"JSON",
                 data: {

                 }
             },
             "columns": [

 { data: "hn" }

],

            // "order": [[0, 'ASC']]
         });
        
        

 });


</script>
