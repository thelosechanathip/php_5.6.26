
<section class="content-header">
      <h1>
        PTTYPE ERROR
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"></li>
      </ol>
    </section>

        <div class="col-xs-12">
          <div class="box">
           
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
            <table id="pallia" class=" display table table-bordered" cellspacing="0" width="100%">
        <thead  >

            <tr class="table-success">
                <th>ลำดับ</th>  

              
                <th>HN</th>
                <th>ชื่อ-สกุล</th>
                <th>อายุ</th>
                <th>เลขบัตร</th>
                <th>วันที่รับบริการ</th>
                <th>รหัสสิทธิ์</th>
                <th>ชื่อสิทธิ์</th>
                <th>cc</th>
               
               
              

            </tr>

        </thead>

    </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

      <script type="text/javascript">
  $(document).ready(function () {
              
    setInterval( function () {
    t.ajax.reload();
},20000 );
                var t = $('#pallia').DataTable({
                   // "iDisplayLength": 50,
                    ajax: {
                        url: "modules/main/covid_send_data.php",
                        type: "post",
                        dataType: 'json',
                      //  data: {date_start: $('#date_start').val(), date_end: $('#date_end').val()}
                    },
                    "paging":   false,
              
                    columns: [
                        {data:null},
                        {data: 'hn'},
                        {data:'fullname'},
                        {data: 'age'},
                       
                        {data: 'cid'},
                        {data:'vstdate'},
                        {data:'pttype'},
                        {data:'name'},
                  {data: 'cc'},
                       // {data: 'addr'},
                      //  {data: 'C'},
                      //  {data: 'Z'},
                      //  {data:'AA'},
                      //  {data: 'community'},
                      //  {data: 's_drug'}


                    ],
                 
     
                 //   "order": [[1, 'ASC']]
                });

                t.on('order.dt search.dt', function () {
                    t.column(0).nodes().each(function (cell, i) {
                        cell.innerHTML = i + 1;
                    });
                });


        

    });
</script>
	
