<?php
$Db->rule('thaimedicine'); //จำนวนและมูลค่าการใช้ยาสมุนไพร
?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
  <li class="breadcrumb-item active">รายงานจำนวนการใช้ยาแผนปัจจุบันผู้ป่วยนอก</li>
</ol>
<div class=" container-fluid">

<div class="form-control">
    <form action="" method="POST" id="select-date" name="select-date">
<div class="input-daterange  input-group" id="datepicker">
   
             <span class="input-group-addon mr-2">จากวันที่</span>
           
                        <input type="text" class="form-control" id="DateStart"  name="DateStart" autocomplete=off />
                        <span class="input-group-addon ml-2">ถึงวันที่</span>
                        <input type="text" class="form-control" id="DateEnd" name="DateEnd" autocomplete=off />
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
       $("#select-date").validate({
            rules: {
                DateStart:
                        {required: true   
                        },

               DateEnd: {required: true    
                }
            },
            messages: {
                 DateStart: {
                    required: "กรุณากรอกเลือกวันที่"
                },
                 DateEnd: {
                    required: "กรุณาเลือกวันที่"
                                    }
            },
            submitHandler: function (form) {
                  //ทำอะไรต่อไป ในทีนี้ ให้ Submit form นะครับ
                 $.ajax({ 
                        url:"modules/thaimedicine/drug_using_data.php",
                        type:"post",
                        data:{  DateStart: $('#DateStart').val(),
                        DateEnd:   $('#DateEnd').val() ,acc:'data' },
        
                        beforeSend: function(){
                       $(".loader").show();
                    },
                 }).done(function(data){
                  $(".loader").hide();
                  $("#showdata").html(data);
                 });
                
              
            }
            
        });
      
    });
  
     
</script>