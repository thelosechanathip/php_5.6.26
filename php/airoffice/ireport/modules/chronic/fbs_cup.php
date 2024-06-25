<?PHP
$Db->rule('refer_ipd');
?>

<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
  <li class="breadcrumb-item active">1.รายงาน การตรวจ FBS </li>
</ol>

   
   <div class="col-md-12 mb-3">
          
          <form action="" method="POST" id="fbs_re">
            <div class="row input-daterange">
              <div class="col-md-4 mb-3">
                <label for="firstName">ตั้งแต่วันที่</label>
                <input type="text" class="form-control" name="DateStart" id="DateStart" autocomplete=off>
               
              </div>
              <div class="col-md-4 mb-3 input-daterange">
                <label for="lastName">ถึงวันที่</label>
                <input type="text" class="form-control" name="DateEnd" id="DateEnd" autocomplete=off>
               
              </div>
              <div class="col-md-4 mb-3">
                <label for="cup">CUP</label>
                <select class="custom-select d-block w-100" id="cup" name="cup">
                <option value="" >--เลือก CUP --</option>
                <?php
                                                $sql = $Db->query("" , 'cup');
                                                foreach ($sql as $row) {
                                                    ?>
                  <option value="<?=$row['moo'];?>"><?=$row['moo'];?></option>
                 
                <?php } ?>
                </select>
                
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
            <th>HN</th>
            <th>วันทีตรวจ</th>
            <th>ชื่อ-สกุล</th>
            <th>FBS</th>
            <th>ที่อยู่</th>
        </tr>

    </thead>

    </table>


<script type="text/javascript">

    $("#fbs_re").validate({
        rules: {
            DateStart: {
                required: true
            },
            DateEnd: {
                required: true
            },
            cup:{
                required:true
            }
        },
        messages: {
            DateStart: {
                required: "คุณไม่ได้เลือกวันที่เริ่ม "
            },
            DateEnd: {
                required: "คุณไม่ได้เลือกวันที่สิ้นสุด"
            },
            cup:{
                required:'เลือก cup ด้วยครับ'
            }
        },
        submitHandler: function () {
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
                    url: "modules/chronic/fbs_cup_data.php",
                    type: "post",
                   datatype:"JSON",
                    data: {
                        DateStart: $('#DateStart').val(), DateEnd: $('#DateEnd').val()
                        ,cup:$('#cup').val()
                    }
                },
            
                "columns": [
   
    {data:null},
    { data: "hn" },
    {data:"vstdate"},
    { data: "fullname" },
    { data: "fbs" },
    { data: "informaddr" }

   
  ],
  dom: 'Bfrtip',
        buttons: [
             'excel'
        ],
       
               // "order": [[0, 'ASC']]
            });
           
            t.on('order.dt search.dt', function () {
                t.column(0).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            });
           // $("#DateStart").val("");
           // $("#DateEnd").val("");
        }

    });
    
    

</script>
