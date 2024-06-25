<?PHP 
//$Db->rule('refer_ipd');
?>

<ol class="breadcrumb">
  <li class="breadcrumb-item active">1.รายชื่อผู้ป่วยที่รับ morhpin</li>
</ol>


        <div class="col-md-12 mb-3">
          
          <form action="" method="POST" id="palliaform">
            <div class="row input-daterange">
              <div class="col-md-4 mb-3">
                <label for="firstName">ตั้งแต่วันที่</label>
                <input type="text" class="form-control" name="date_start" id="date_start" autocomplete=off>
               
              </div>
              <div class="col-md-4 mb-3 input-daterange">
                <label for="lastName">ถึงวันที่</label>
                <input type="text" class="form-control" name="date_end" id="date_end" autocomplete=off>
               
              </div>
              <div class="col-md-4 mb-3">
                <label for="ward">ค้นหาข้อมูล</label>
                <button class="btn btn-primary  btn-block" type="submit">ตกลง</button>
                </select>
                
              </div>
            </div>

            <hr class="mb-4">
          
        </div>
    
<div class="table-responsive">

    <table id="pallia" class=" display table table-bordered" cellspacing="0" width="100%">
        <thead  >

            <tr class="table-success">
                <th>ลำดับ</th>  

                <th></th>
                <th>VN</th>
                <th>วันที่รับบริการ</th>
                <th>HN</th>
                <th>CID</th>
                <th>ชื่อ-สกุล</th>
                <th>ที่อยู่</th>
                <th>วินิจฉัย</th>
                <th>รหัส Z</th>
                <th>รหัสอื่น</th>
                <th>เยี่ยมบ้าน</th>
                <th>เวชภัณฑ์และอุปกรณ์</th>
              

            </tr>

        </thead>

    </table>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#palliaform").validate({
            rules: {
                date_start: {
                    required: true
                },
                date_end: {
                    required: true
                }
            },
            messages: {
                date_start: {
                    required: "คุณไม่ได้เลือกวันที่เริ่ม "
                },
                date_end: {
                    required: "คุณไม่ได้เลือกวันที่สิ้นสุด"
                }
            },
            submitHandler: function () {
                $("#pallia").dataTable().fnDestroy();
                //  alert($('#date_start').val());
                //ทำอะไรต่อไป ในทีนี้ ให้ Submit form นะครับ
                var t = $('#pallia').DataTable({
                    "iDisplayLength": 50,
                    ajax: {
                        url: "modules/palliative/palliative_data.php",
                        type: "post",
                        dataType: 'json',
                        data: {date_start: $('#date_start').val(), date_end: $('#date_end').val()}
                    },
                    "columnDefs": [

                        {
                            "targets": -12,
                            "data": null,
                            "defaultContent": "<button id='send_btn' class='btn btn-danger' >ส่งเบิก</button>",
                            'bSortable': false
                        }

                    ],
                    columns: [
                        {data: null},
                        {data: null},
                        {data:'vn'},
                        {data: 'vstdate'},
                        {data: 'hn'},
                        {data: 'cid'},
                        {data: 'ptname'},
                        {data: 'addr'},
                        {data: 'C'},
                        {data: 'Z'},
                        {data:'AA'},
                        {data: 'community'},
                        {data: 's_drug'}


                    ],
                    dom: 'Bfrtip',
        buttons: [
             'excel'
        ],
                    "order": [[1, 'ASC']]
                });

                t.on('order.dt search.dt', function () {
                    t.column(0).nodes().each(function (cell, i) {
                        cell.innerHTML = i + 1;
                    });
                });



                $("#date_start").val("");
                $("#date_end").val("");
            }

        });
        /* var t = $('#pallia').DataTable({
         "ajax": {
         "url": "modules/palliative/palliative_data.php",
         "type": "post",
         "data": {req: 'req'}
         },
         
         "order": [[1, 'asc']]
         });
         t.on('order.dt search.dt', function () {
         t.column(0).nodes().each(function (cell, i) {
         cell.innerHTML = i + 1;
         
         });
         }).draw(); //เรียกใช้งาน datatable */
       
           $(".send_btn").click(function () {
           alert('dfd');
         //   $("#userformModal").modal();
        }); 
        

    });
</script>
