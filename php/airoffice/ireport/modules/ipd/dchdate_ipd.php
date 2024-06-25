<?PHP
$Db->rule('refer_ipd');
?>

<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
  <li class="breadcrumb-item active">รายชื่อผู้ป่วย covid ที่จำหน่ายจาก รพ.สนาม ตามช่วงวันที่</li>
  
</ol>

   
   <div class="col-md-12 mb-3">
          
          <form action="" method="POST" id="refer_ipd">
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
                <label for="ward">ward</label>
                <select class="custom-select d-block w-100" id="ward" name="ward">
                <?php
                                                $sql = $Db5->query("select * from ward where ward in ('06','05')" , '');
                                                foreach ($sql as $row) {
                                                    ?>
                  <option value="<?=$row['ward'];?>"><?=$row['name'];?></option>
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
 <span class="text-danger"> </span> 
    <table id="ff" class="table " cellspacing="0" width="100%">
    <thead  >
    
        <tr class="">
            <th>ลำดับ</th>  

            <th>HN</th>
            <th>AN</th>
            <th>ชื่อ-สกุล</th>
            <th>วินิจฉัย</th>
            <th>วันที่รับ</th>
            
            <th>วันที่จำหน่าย</th>
            <th>จำนวนวันนอน</th>
            <th>ที่อยู่</th>     
            <th>ตำบล</th>
            <th>อำเภอ</th>
            <th>จังหวัด</th>
            <th>ตึก</th>
        </tr>

    </thead>

    </table>


<script type="text/javascript">

    $("#refer_ipd").validate({
        rules: {
            DateStart: {
                required: true
            },
            DateEnd: {
                required: true
            },
            ward:{
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
            ward:{
                required:'เลือก ward ด้วยครับ'
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
                    url: "modules/ipd/dchdate_data.php",
                    type: "post",
                   datatype:"JSON",
                    data: {
                        DateStart: $('#DateStart').val(), DateEnd: $('#DateEnd').val()
                        ,ward:$('#ward').val()
                    }
                },
                "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                if ( aData["dch_name"] == "With Approval" )
                    {
                            $('td', nRow).css('background-color', '#f2dede' );
                            }
    },
                "columns": [
   
    {data:null},
    { data: "hn" },
    { data: "an" },
    {data:"fullname"},
    {data:"pdx"},
    { data: "regdate" },
    {data:"dchdate"}, 
    {data:"admdate"},
    {data:"informaddr"},
    {data:"tmbpart"},
    {data:"amppart"},
    {data:"chwpart"},
    {data:"wardname"}

   
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
