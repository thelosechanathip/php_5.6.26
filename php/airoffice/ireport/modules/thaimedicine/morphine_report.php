<?php
$Db->rule('thaimedicine'); //จำนวนและมูลค่าการใช้ยาสมุนไพร
?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
  <li class="breadcrumb-item active">รายงานการใช้ยา Morphine </li>
</ol>
<div class=" container-fluid">

<div class="form-control">
    <form action="" method="POST" id="selectData" name="selectData">
    <div class="col-md-12 mb-3">
          
       
            <div class="row input-daterange">
              <div class="col-md-4 mb-3">
                <label for="firstName">เดือน</label>
                <select  class="form-control" name="mountset" id="mountset" >
                <option value="1">มกราคม</option>
                <option value="2">กุมภาพันธ์</option>
                <option value="3">มีนาคม</option>
                <option value="4">เมษายน</option>
                <option value="5">พฤษภาคม</option>
                <option value="6">มิถุนายน</option>
                <option value="7">กรกฎาคม</option>
                <option value="8">สิงหาคม</option>
                <option value="9">กันยายน</option>
                <option value="10">ตุลาคม</option>
                <option value="11">พฤศจิกายน</option>
                <option value="12">ธันวาคม</option>
                
                </select>
               
              </div>
              <div class="col-md-4 mb-3 input-daterange">
                <label for="lastName">ปี</label>
                <select class="form-control" name="yearset" id="yearset">
                <?php  
     for ($x=date("Y"); $x >=date("Y")-1; $x--) { ?>
                <option value="<?php echo $x; ?>">
                        
                              <?php   echo $x+543; ?>
                           </option> 
     <?php } ?>
                </select>
               
              </div>
              <div class="col-md-4 mb-3">
                <label for="ward">ward</label>
                <select class="custom-select d-block w-100" id="icode" name="icode">
                <option value="" >--เลือก--</option>
                <?php
                                                $sql = $Db->query("select  icode,name,istatus from drugitems  where name like '%morphine%'  and istatus='Y' " , '');
                                                foreach ($sql as $row) {
                                                    ?>
                  <option value="<?=$row['icode'];?>"><?=$row['name'];?></option>
                <?php } ?>
                </select>
                
              </div>
            </div>

             <button type="submit"  id="submit"   class="btn btn-primary mt-3">ประมวลผล</button>  
             

    </form>
              
 </div>
     
        <div class="row mt-5">
            <div class="loader"></div>
           
        </div>
         <div id="showdata"></div>
    
      
   
<script type="text/javascript">
$(document).ready(function(){
  $(".loader").hide();
});
    $("#submit").click(function(){
       $("#selectData").validate({
            rules: {
                mountset:
                        {required: true   
                        },

               yearset: {required: true    
                }
            },
            messages: {
              mountset: {
                    required: "กรุณากรอกเลือกวันที่"
                },
                yearset: {
                    required: "กรุณาเลือกวันที่"
                                    }
            },
            submitHandler: function (form) {
                  //ทำอะไรต่อไป ในทีนี้ ให้ Submit form นะครับ
                // alert($('#icode').val());
                 $.ajax({ 
                        url:"modules/thaimedicine/morphine_report_data.php",
                        type:"post",
                        data:{  mountset: $('#mountset').val(),icode:$('#icode').val(),
                        yearset:   $('#yearset').val() ,acc:'data' },
        
                        beforeSend: function(){
                       $(".loader").show();
                    },
                 }).done(function(data){
                //  var a = document.createElement('a');
          // var url = window.URL.createObjectURL(data);
            a.href = "modules/thaimedicine/";
            a.download = '22.txt';
            document.body.append(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(url);
                 });
                
              
            }
            
        });
      
    });
  
     
</script>