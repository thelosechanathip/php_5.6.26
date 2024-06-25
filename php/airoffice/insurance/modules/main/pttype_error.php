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
            <div class="box-header">
              <h3 class="box-title"></h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ลำดับ</th>
                  <th>HN</th>
                  <th>ชื่อ-สกุล</th>
                  <th>CID</th>
                  <th>วันที่รับบริการ</th>
                    <th>เวลา</th>
                  <th>สถานบริการ</th>
                  <th>ผู้ส่งตรวจ</th>
                </tr>
                <tbody class="show-list-data ">
                       <tr class=" list-data">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                   <td></td>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

      <script type="text/javascript">
var dataList = {}
$(function(){
   dataList.getList =(function(){
        var url="modules/main/pttype_error_data.php"; // ไฟล์ที่ต้องการรับค้า
        var dataSet={ action:'list' }; // กำหนดชื่อและค่าที่ต้องการส่ง
        var rowData = $(".list-data").clone(true);
        $.post(url,dataSet,function(response){
           // alert("แจ้งเเมื่อทำการส่งข้อมูลเรียบร้อยแล้ว");
           console.log(response);
           var rowListData="";
           $.each(response.data,function(i){
					rowListData = "";
					rowListData+="<tr class=\"list-data\">";
					rowListData+=$(
                                        rowData.find("td:eq(0)").text(response.data[i].no).end()
					.find("td:eq(1)").text(response.data[i].hn).end()
					.find("td:eq(2)").text(response.data[i].fullname).end()
                                        .find("td:eq(3)").text(response.data[i].cid).end()
                                        .find("td:eq(4)").text(response.data[i].vstdate).end()
                                        .find("td:eq(5)").text(response.data[i].vsttime).end()
                                        .find("td:eq(6)").text(response.data[i].hosname).end()
					.find("td:eq(7)").text(response.data[i].name_staff).end()
					).html();	
					rowListData+="</tr>";
					$(".show-list-data").append(rowListData);
				}); // end loop	
         });
    });
    dataList.getList(0,true);
});
</script>
	
