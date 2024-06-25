<?PHP //$Db->rule('group_user');        ?>
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">
            จัดการสิทธิการเข้าใช้งาน
        </h2>
    </div>
</div>

<div class="table-responsive">

    <table id="example" class=" display table table-bordered" cellspacing="0" width="100%">
        <thead >

            <tr>
                <th>ลำดับ</th>
                <th>ชื่อโมดูล (EN)</th>
                <th>ชื่อโมดูล (th)</th>
                <th>สิทธิ์กลุ่ม</th>
                <th>สิทธิ์บุคคล</th>
                <th>โมดูลหลัก</th>
                <th><button class="addBtn btn btn-success">เพิ่มโมดูล</button></th>

            </tr>

        </thead>

    </table>
</div>



<script type="text/javascript">
    $(document).ready(function () {
        var t = $('#example').DataTable({
            "ajax": {
                "url": "modules/access_modules/access_group_data.php",
                "type": "POST",
                "data": {req: 'req'}
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

        $('  #example tbody').on('click', '#edit', function () { //ดึง id มาแก้ไขจาก datatable
            var data = t.row($(this).parents('tr')).data();
            $("#accessgroupformModal").modal();
            $.ajax({
                url:'modules/access_modules/edit_query_access.php',
                type:'POST',
                data:{
                    sql:data[0]
                }
            })
                    .done(function (data) {
                        var ard = JSON.parse(data);
                        $("#ModuleNameEn").hide();
                        $("#textmodules").show();
                        $("#textmodules").text(ard['acoperation_modules']);
                        $("#ModuleNameEn").val(ard['acoperation_modules']);
                        $("#ModuleNameTh").val(ard['acoperation_thai_name_modules']);
                        $('#acgroup').val(ard['acoperation_group2']).change()
                        $('#acuser').val(ard['acoperation_user2']).change()
                        $('#main_modules').val(ard['main_modules']).change()
                        $("#edit_access").val(ard['acoperation_id']);
                      
                  console.log(data);
        });
        });
        $('#example tbody').on('click', '#delete', function () {//ดึง id มาลบ datatable
            var data = t.row($(this).parents('tr')).data();
            if (confirm("ต้องการลบข้อมูลนี้หรือไม่"))
            {
                $.post('modules/access_modules/delete_modules.php', {
                    id: data[0],
                    delete_modules: 'delete'
                })
                        .done(function () {
                            t.ajax.reload();
                        });
            }

        });
        $(function () {
            $(".addBtn").click(function () {
                $("#textmodules").hide();
                $("#ModuleNameEn").show();
                $("#ModuleNameEn").val("");
                $("#ModuleNameTh").val("");
                $("#acgroup").val('').trigger('change')
                $("#acuser").val('').trigger('change')
               $("#main_modules").val('').trigger('change')

                $("#accessgroupformModal").modal();
            });
            $("#cancelBtn").click(function () {

                $("#ModuleNameEn").val("");
                $("#ModuleNameTh").val("");
                $("#acgroup").val('').trigger('change')
                $("#acuser").val('').trigger('change')
                $("#main_modules").val('').trigger('change')
               
            });

            $("#modulesFrom").validate({
                rules: {
                    ModuleNameEn:
                            {required: true,
                                minlength: 5,
                                maxlength: 30,
                                remote: {
                                    url: "modules/access_modules/chk_modules.php",
                                    type: "post"
                                }
                            },
                            main_modules:{
                                required:true
                            }
                },
                messages: {
                    ModuleNameEn: {
                        required: "กรุณากรอก ชื่อโมดูล en ",
                        minlength: "อย่างน้อย 5 ตัวอักษร",
                        maxlength: "ไม่เกิน 30 ตัวอักษร",
                        remote: "มีการใช้ชื่อนี้แล้ว!"

                    },
                    main_modules:{
                        required:"เลือกโมดูลหลัก"
                    }

                },
                submitHandler: function (form) {
                    form.submit( );
                    
                  //  alert($("#acuser").val());
                    //ทำอะไรต่อไป ในทีนี้ ให้ Submit form นะครับ
                    $.ajax({
                        url:'modules/access_modules/add_modules.php',
                        type:'POST',
                        datatype:'JSON',
                        data:{
                        ModuleNameEn: $('#ModuleNameEn').val(),
                        ModuleNameTh: $('#ModuleNameTh').val(),
                        acgroup: $('#acgroup').val(),
                        acuser: $('#acuser').val(),
                        main_modules:$('#main_modules').val(),
                        edit_access: $('#edit_access').val(),

                        saveBtn: 'save'
        
                        }
                    })
                 
                    .done(function(data) {
                         console.log(data);  
                        //alert(data);

                     //   $("#user_cancelBtn").trigger("click");
                       // t.ajax.reload();

                    }); 
                }
            });
        });
     
    });
</script>
<div   role="dialog" data-keyboard="false" data-backdrop="static" id="accessgroupformModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">เพิ่มโมดูล</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">

                            <div class="panel-body">
                                <form class="form-horizontal " id="modulesFrom" action="" method="POST">
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">ชื่อโมดูล en</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="ModuleNameEn"  name="ModuleNameEn" onkeyup="eng_only()"  class="form-control" /> 
                                            <label id="textmodules" class="form-control"></label>
                                        </div>
                                       
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">ชื่อโมดูล th</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="ModuleNameTh"  name="ModuleNameTh"   class="form-control" />   
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">โมดูลหลัก</label>
                                        <div class="col-sm-10">
                                            <select style="width: 100%;" name="main_modules" id="main_modules" >
                                            <option value="">เลือกโมดูลหลัก</option>
                                                <?php
                                                $sql = $Db->query('', 'main_modules');
                                                foreach ($sql as $row) {
                                                    ?>

                                                    <option value="<?php echo $row['main_modules_id'] ?>"> <?php echo $row['main_modules_name']; ?></option>
                                                <?php } ?>
                                            </select>


                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">สิทธิ์กลุ่ม</label>
                                        <div class="col-sm-10">
                                            <select style="width: 100%;" name="acgroup" id="acgroup" multiple="multiple">
                                                <?php
                                                $sql = $Db->query('', 'group_user');
                                                foreach ($sql as $row) {
                                                    ?>

                                                    <option value="<?php echo $row['group_user_name'] ?>"> <?php echo $row['group_user_name']; ?></option>
                                                <?php } ?>
                                            </select>


                                        </div>
                                    </div>
                                  
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">สิทธิ์บุคคล</label>
                                        <div class="col-sm-10">
                                            <select style="width: 100%;" name="acuser" id="acuser" multiple="multiple">
                                                <?php
                                                $sql = $Db->query('', 'employee');
                                                foreach ($sql as $row) {
                                                    ?>

                                                    <option value="<?php echo $row['username'] ?>"> <?php echo $row['username']; ?></option>
                                                <?php } ?>
                                            </select>


                                        </div>
                                    </div>
                                    <input id="edit_access" name="edit_access" type="hidden">
                                   
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button  class="btn btn-success">บันทึก</button>
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
    </div>
</div>


<script type="text/javascript">
    function eng_only() {

        var temp = $("#ModuleNameEn").val();//เก็บข้อความที่พิมพ์ใน text box 

        temp = temp.toLowerCase();//เปลี่ยนให้ทุกตัวอักษรเป็น ตัวพิมพ์เล็ก

//วน loop แต่ละตัวอักษร เพื่อดูว่าแต่ละตัวอักษรเป็นภาษาไทย หรือภาษาอังกฤษ
        for (i = 0; i < temp.length; i++)
        {

            if ((temp[i] == "a") || (temp[i] == "b") || (temp[i] == "c") || (temp[i] == "d") || (temp[i] == "e") || (temp[i] == "f") || (temp[i] == "g") || (temp[i] == "h") || (temp[i] == "i") || (temp[i] == "j") || (temp[i] == "k") || (temp[i] == "l") || (temp[i] == "m") || (temp[i] == "n") || (temp[i] == "o") || (temp[i] == "p") || (temp[i] == "q") || (temp[i] == "r") || (temp[i] == "s") || (temp[i] == "t") || (temp[i] == "u") || (temp[i] == "v") || (temp[i] == "w") || (temp[i] == "x") || (temp[i] == "y") || (temp[i] == "z") || (temp[i] == "z") || (temp[i] == "0") || (temp[i] == "1") || (temp[i] == "2") || (temp[i] == "3") || (temp[i] == "4") || (temp[i] == "5") || (temp[i] == "6") || (temp[i] == "7") || (temp[i] == "8") || (temp[i] == "9") ||  (temp[i] == "_") (temp[i] == "edit"))
            {

            } else
            {
                $("#ModuleNameEn").val($("#ModuleNameEn").val().replace(temp[i], ""));//ลบตัวอักษรที่ไม่ใช่ภาษาอังกฤษออก
            }

        }

    }
    $('select').select2({
        createTag: function (params) {
            var term = $.trim(params.term);

            if (term === '') {
                return null;
            }

            return {
                id: term,
                text: term,
                newTag: true // add additional parameters
            }
        }
    });
</script>

