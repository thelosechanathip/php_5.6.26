
<?PHP
$Db->rule('usermanager');
?>
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">
            จัดการผู้ใช้
        </h2>
    </div>
</div>

<div class="table-responsive">
  
    <table id="example" class=" display table table-bordered" cellspacing="0" width="100%">
        <thead >

            <tr>
                <th>ลำดับ</th>
                <th>username</th>
                <th>ชื่อ-สกุล</th>
                <th>กลุ่ม</th>
                <th>สังกัด</th>
                <th><button class="addBtn btn btn-success">เพิ่มข้อมูล</button></th>

            </tr>

        </thead>

    </table>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var t = $('#example').DataTable({
            "ajax":{ 
                   "url": "modules/usermanager/default_data.php",
                    "type":"post",
                    "data":{
                        req:'req'},
                     /*   success(data){
                            console.log(data);
                        } */
                        
                },  
            "columnDefs": [

                {
                    "targets": -1,
                    "data": null,
                    "defaultContent": " <button  id='edit' class='btn btn-primary'>แก้ไข</button>   <button id='delete' class='btn btn-danger' >ลบ</button>",
                    'bSortable': false
                },

                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }

            ],
            "order": [[1, 'asc']]
        });
        t.on('order.dt search.dt', function () {
            t.column(0).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;

            });
        }).draw(); //เรียกใช้งาน datatable

        $('#example tbody').on('click', '#edit', function () { //ดึง id มาแก้ไขจาก datatable
            var data = t.row($(this).parents('tr')).data();
            $("#userformModal").modal();
            $.post("modules/usermanager/edit_query_user.php", {sql: data[0]})
                    .done(function (data) {
//console.log(data);
                        var ard = JSON.parse(data);
                        $("#username").hide();
                        $("#textuser").show();
                        $("#textuser").text(ard['username']);
                        $("#password").val(ard['pass']);
                        $("#pass_old").val(ard['pass']);
                        $("#pname").val(ard['pname_id']);

                        $("#fname").val(ard['fname']);
                        $("#lname").val(ard['lname']);
                        $("#group_user").val(ard['group_user_id']);
                        $("#hospital_department").val(ard['hospital_department_id']);
                        $("#edit_user").val(ard['uid']);
                    });
            // alert( data[0] +"'s salary is: "+ data[ 0 ] );
        });
        $('#example tbody').on('click', '#delete', function () {//ดึง id มาลบ datatable
            var data = t.row($(this).parents('tr')).data();
            if (confirm("ต้องการลบข้อมูลนี้หรือไม่"))
            {
                $.post('modules/usermanager/delete_user.php', {
                    delete_id: data[0],
                    delete_user: 'delete'
                })
                        .done(function () {
          t.ajax.reload();  
                        });
            }
       


    });
    $(function () {
        $(".addBtn").click(function () {
            $("#textuser").hide();
            $("#username").show();
            $("#username").val("");
            $("#password").val("");
            $("#pname").val("");
            $("#fname").val("");
            $("#lname").val("");
            $("#group_user").val("");
            $("#hospital_department").val("");
            $("#edit_user").val("");
            $("#pass_old").val("");
            $("#userformModal").modal();
        });
        $("#cancelBtn").click(function () {
            $("#username-error").empty();
            $("#password-error").empty();
            $("#pname-error").empty();
            $("#fname-error").empty();
            $("#lname-error").empty();
            $("#group_user-error").empty();
            $("#hospital_department-error").empty();



        });

        $("#userform").validate({
            rules: {
                username:
                        {required: true,
                            minlength: 3,
                            maxlength: 10,
                            remote: {
                                url: "modules/usermanager/chk_user.php",
                                type: "post"
                            }
                        },

                password: {required: true,
                    minlength: 4
                },
                pname: {required: true},
                fname: {required: true},
                lname: {required: true},
                group_user: {required: true},
                hospital_department: {required: true}

            },
            messages: {
                username: {
                    required: "กรุณากรอก username ",
                    minlength: "อย่างน้อย 3 ตัวอักษร",
                    maxlength: "ไม่เกิน 10 ตัวอักษร",
                    remote: "Email already in use!"

                },
                password: {
                    required: "กรุณากรอกรหัสผ่าน",
                    minlength: "อย่างน้อย 4 ตัวอักษร"
                },
                pname: {
                    required: "กรุณาเลือกคำนำหน้าชื่อ"
                },
                fname: {
                    required: "กรุณากรอกชื่อ"
                },
                lname: {
                    required: "กรุณากรอกนามสกุล"
                },
                group_user: {
                    required: "กรุณาเลือกกลุ่ม "

                },
                hospital_department: {
                    required: "กรุณาเลือกฝ่าย/งาน"
                }
            },
            submitHandler: function (form) {
                form.submit();
                //ทำอะไรต่อไป ในทีนี้ ให้ Submit form นะครับ
                $.post('modules/usermanager/add_user.php', {
                    edit_user: $('#edit_user').val(),
                    username: $('#username').val(),
                    password: $('#password').val(),
                    pass_old: $('#pass_old').val(),
                    pname: $('#pname').val(),
                    fname: $('#fname').val(),
                    lname: $('#lname').val(),
                    group_user: $('#group_user').val(),
                    hospital_department: $('#hospital_department').val(),
                    saveBtn: 'save'


                });
                success:(function (response) {
                    $("#textuser").hide();
                    $("#username").show();
                    $("#username").empty();
 
                    $("#password").empty("");
                    $("#pname").empty("");
                    $("#fname").empty("");
                    $("#lname").empty("");
                    $("#group_user").empty("");
                    $("#hospital_department").empty("");
                    $("#edit_user").empty("");
                    $("#pass_old").empty("");
                    //$("#user_cancelBtn").trigger("click");
                  t.ajax.reload();  

                });
            }
        });
    });
    
     });
</script>
<div   role="dialog" data-keyboard="false" data-backdrop="static" id="userformModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Form เพิ่มผู้ใช้งาน</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">

                            <div class="panel-body">
                                <form class="form-horizontal " id="userform" action="" method="POST">
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">USERNAME</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="username"  name="username"  onkeyup="eng_only()" class="form-control" 


                                                   />
                                            <label id="textuser" class="form-control"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">PASSWORD</label>
                                        <div class="col-sm-10">
                                            <input id="password" name="password" type="password" onkeyup="eng_only()" class="form-control"

                                                   >

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">คำนำหน้า</label>
                                        <div class="col-sm-10">
                                            <select  id="pname" name="pname" class="form-control" >
                                                <option value="0">-- เมนู --</option>
                                                <?php
                                                $sql = $Db->query('', 'pname');
                                                foreach ($sql as $row) {
                                                    ?>
                                                    <option value="<?php echo $row['pname_id'] ?>"> <?php echo $row['pname']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">ชื่อ</label>
                                        <div class="col-sm-10">
                                            <input id="fname" name="fname"  type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">นามสกุล</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  id="lname" name="lname" type="text" data-validation="required">
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">กลุ่มผู้ใช้งาน</label>
                                        <div class="col-sm-10">
                                            <select  id="group_user" name="group_user" class="form-control ">
                                                <option value="" >-- เมนู --</option>
                                                <?php
                                                $sql = $Db->query('','group_user');
                                                foreach ($sql as $row) {
                                                    ?>

                                                    <option value="<?php echo $row['id'] ?>"> <?php echo $row['group_user_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">ฝ่าย/งาน</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="hospital_department" name="hospital_department"  style="width:100%;">
                                                <option value="" >-- เมนู --</option>
                                                <?php
                                                $sql = $Db->query('', 'hospital_department');
                                                foreach ($sql as $row) {
                                                    ?>

                                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['id'] ?> : <?php echo $row['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <input id="edit_user" name="edit_user" type="hidden">
                                    <input id="pass_old" name="pass_old" type="hidden">
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button  class="  btn btn-success">บันทึก</button>
                                            <button id="cancelBtn" type="button" class="btn btn-danger btn-default pull-center" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function eng_only() {

                var temp = $("#username").val();//เก็บข้อความที่พิมพ์ใน text box 

                temp = temp.toLowerCase();//เปลี่ยนให้ทุกตัวอักษรเป็น ตัวพิมพ์เล็ก

//วน loop แต่ละตัวอักษร เพื่อดูว่าแต่ละตัวอักษรเป็นภาษาไทย หรือภาษาอังกฤษ
                for (i = 0; i < temp.length; i++)
                {

                    if ((temp[i] == "a") || (temp[i] == "b") || (temp[i] == "c") || (temp[i] == "d") || (temp[i] == "e") || (temp[i] == "f") || (temp[i] == "g") || (temp[i] == "h") || (temp[i] == "i") || (temp[i] == "j") || (temp[i] == "k") || (temp[i] == "l") || (temp[i] == "m") || (temp[i] == "n") || (temp[i] == "o") || (temp[i] == "p") || (temp[i] == "q") || (temp[i] == "r") || (temp[i] == "s") || (temp[i] == "t") || (temp[i] == "u") || (temp[i] == "v") || (temp[i] == "w") || (temp[i] == "x") || (temp[i] == "y") || (temp[i] == "z") || (temp[i] == "z") || (temp[i] == "0") || (temp[i] == "1") || (temp[i] == "2") || (temp[i] == "3") || (temp[i] == "4") || (temp[i] == "5") || (temp[i] == "6") || (temp[i] == "7") || (temp[i] == "8") || (temp[i] == "9") || (temp[i] == "edit"))
                    {

                    } else
                    {
                        $("#username").val($("#username").val().replace(temp[i], ""));//ลบตัวอักษรที่ไม่ใช่ภาษาอังกฤษออก
                    }

                }

            }

        </script>

    </div>
</section>

</div>
