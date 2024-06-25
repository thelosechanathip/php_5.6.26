<button id="AdcomBtn" class="btn btn-primary">เพิ่มข้อมูล</button>


<script type="text/javascript">
    $("#AdcomBtn").click(function () {
        $("#namecom").val("");
        $("#asset-id").val("");
        $("#AdcomFrm").modal();
       
    });
    $("#comsave").click(function () {
        alert("dfdf");
    });
    $("#AdcomBtnclose").click(function () {
        alert('dfdf');
    });
    
</script>

<div id="AdcomFrm" class="container-fluid modal fade"><hr>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-pencil"></i> </span>
                    <h5>เพิ่มรายการ</h5>
                </div>
                <div class="widget-content nopadding">
                    <form id="form-wizard" class="form-horizontal" method="post">
                        <div id="form-wizard-1" class="step">
                            <div class="control-group">
                                <label class="control-label">ชื่อ</label>
                                <div class="controls">
                                    <input  id="namecom" type="text" name="namecom" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">หมายเลขครุภัณฑ์</label>
                                <div class="controls">
                                    <input id="asset-id" type="text" name="asset-id" />
                                </div>
                            </div>

                        </div>
                        <div id="form-wizard-2" class="step">
                            <div class="control-group">
                                <label class="control-label">วัน/เดือน/ปี ที่รับ</label>
                                <div class="controls">
                                    <input type="text" id="date-import">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">ประเภทอุปกรณ์</label>
                                <div class="controls">
                                    <select id="type" >
                                        <option value=""><--เลือกประเภทอุปกรณ์--></option>
                                         <?php
                                                $sql = $Db->query('', 'service_com_type');
                                                foreach ($sql as $row) {
                                                    ?>
                                                    <option value="<?php echo $row['service_com_type_id'] ?>"> <?php echo $row['service_com_type_name']; ?></option>
                                                <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">สถานที่ตั้งอุปกรณ์</label>
                                <div class="controls">
                                    <select></select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">สถานะ</label>
                                <div class="controls">
                                    <select>
                                        
                                         <?php
                                                $sql = $Db->query('', 'service_com_status');
                                                foreach ($sql as $row) {
                                                    ?>
                                                    <option value="<?php echo $row['service_com_status_id'] ?>"> <?php echo $row['service_com_status_name']; ?></option>
                                                <?php } ?>
                                    </select>
                                </div>
                            </div>
                              <div class="control-group">
                                <label class="control-label">รายละเอียดเพิ่มเติม</label>
                                <div class="controls">
                                    <textarea class="textarea"  ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button id="comsave">บันทึก</button>
                            <div id="status"></div>
                        </div>
                        <div id="submitted"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#date-import').datepicker({
        autoclose: true,
        language: "th-th",
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });
</script>

