<?PHP
$Db->rule('labour');
?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
  <li class="breadcrumb-item active">1.รายงานการคลอด</li>
</ol>
<div class=" container-fluid">

<div class="form-control">
    <form action="" method="POST" id="birth_form" name="birth_form">
<div class="input-daterange  input-group" id="datepicker">
   
             <span class="input-group-addon mr-2">จากวันที่</span>
           
                        <input type="text" class="form-control" id="DateStart"  name="DateStart" autocomplete=off />
                        <span class="input-group-addon ml-2">ถึงวันที่</span>
                        <input type="text" class="form-control" id="DateEnd" name="DateEnd" autocomplete=off />
    </div> 
    <button  class=" btn btn-success">ประมวลผล</button>

    </form>
              
 </div>
 
 <div class="table-responsive">

<table id="ff" class=" display table table-bordered" cellspacing="0" width="100%">
    <thead  >

        <tr class="table-success">
            <th>ลำดับ</th>  

            <th>HN</th>
            <th>เลข REFER</th>
            <th>AN</th>
            <th>วันที่แอตมิต</th>
            <th>เวลาแอตมิต</th>
            <th>ตึก</th>
            <th>เตียง</th>
            <th>ชื่อ-สกุล</th>
            <th>อายุ</th>
            <th>ที่อยู่</th>
            <th>GPAL</th>
            <th>สิทธิ์</th>
            <th>OP1</th>
            <th>OP2</th>
            <th>OP3</th>
            <th>OP4</th>
            <th>OP5</th>


        </tr>

    </thead>

</table>
</div>

<script type="text/javascript">
$(document).ready(function () {
    $("#birth_form").validate({
        rules: {
            DateStart: {
                required: true
            },
            DateEnd: {
                required: true
            }
        },
        messages: {
            DateStart: {
                required: "คุณไม่ได้เลือกวันที่เริ่ม "
            },
            DateEnd: {
                required: "คุณไม่ได้เลือกวันที่สิ้นสุด"
            }
        },
        submitHandler: function () {
            $("#birth_form").dataTable().fnDestroy();
            //  alert($('#date_start').val());
            //ทำอะไรต่อไป ในทีนี้ ให้ Submit form นะครับ
            var t = $('#ff').DataTable({
                "iDisplayLength": 50,
                ajax: {
                    url: "modules/labour/birth_inform_data.php",
                    type: "post",
                    dataType: 'json',
                    data: {DateStart: $('#DateStart').val(), date_end: $('#DateEnd').val()}
                },
               
               
                "order": [[1, 'ASC']]
            });

            t.on('order.dt search.dt', function () {
                t.column(0).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            });



            $("#DateStart").val("");
            $("#DateEnd").val("");
        }

    });
    
    $(function(){
       $("#btn_send").click(function () {
       alert('dfd');
    
    }); 
    });

});
</script>
