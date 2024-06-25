
<?PHP
//$Db->rule('usermanager');
?>
<form id="fupForm" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required />
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required />
    </div>
    <div class="form-group">
        <label for="file">File</label>
        <input type="file" class="form-control" id="file" name="file" required />
    </div>
    <input type="submit" name="submit" class="btn btn-success submitBtn" value="SUBMIT"/>
</form>
<div class="table-responsive">
  
    <table id="example" class=" display table table-bordered" cellspacing="0" width="100%">
        <thead >

            <tr>
                <th>ลำดับ</th>
                <th>หัวข้อเอกสาร</th>
                <th>file</th>
                <th>วันที่</th>
                <th></th>

            </tr>

        </thead>

    </table>
</div>

<script type="text/javascript">
 $(document).ready(function(e){


        
        
    /*    var t = $('#example').DataTable({
            "ajax":{ 
                   "url": "modules/docpup2/default_data.php",
                    "type":"post",
                    "data":{
                        req:'req'}
                },
            "columnDefs": [

                {
                    "targets": -1,
                    "data": null,
                   // "defaultContent": " <button  id='edit' class='btn btn-primary'>เปิด</button>   <button id='delete' class='btn btn-danger' >ลบ</button>",
                    'bSortable': false, 
                    "render": function ( data, type, row ) {
                            return '<a href="modules/docpup2/uploads/' + row[2] +'" target="blank">' + "เปิดลิงค์" + '</a>';}
                },

               
                
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }

            ],
            "order": [[3, 'desc']]
        });
        t.on('order.dt search.dt', function () {
            t.column(0).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;

            });
        }).draw(); //เรียกใช้งาน datatable*/

  
        $("#fupForm").on('submit', function(e){
       e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'modules/docpup2/docpub_save.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                
                $('.submitBtn').attr("disabled","disabled");
                $('#fupForm').css("opacity",".5");
            },
            success: function(response){ console.log(response);
                $('.statusMsg').html('');
              //  t.ajax.reload();
               if(response.status == 1){
                 //   t.ajax.reload();  

                    $('#fupForm')[0].reset();
                    $('.statusMsg').html('<p class="alert alert-success">'+response.message+'</p>');

                }else{
                    $('.statusMsg').html('<p class="alert alert-danger">'+response.message+'</p>');
                }
                $('#fupForm').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
        });
      
    });


           // File type validation
$("#file").change(function() {
    var file = this.files[0];
    var fileType = file.type;
    var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
    if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
        alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
        $("#file").val('');
        return false;
    }
});

       
   
    
     });

   
  
</script>
