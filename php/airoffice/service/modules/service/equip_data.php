<?php
include_once '../../../lib/config.inc.php';
$Db = new MySqlConn;
?>		      
                                <table id="equip-table" class="table table-bordered table-striped ">
                                    <thead >
				<tr>
					<th width="1">
						#
					</th>
					<th>หมายเลขครุภัณฑ์</th>
					<th>ชื่อครุภัณฑ์</th>
					<th class="table-icon-cell">
						ยี่ห้อ/รุ่น/ขนาด
					</th>
					<th class="table-icon-cell">
						สถานที่
					</th>
					<th>สถานะใช้งาน</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
                                    <?PHP
                                    
                $sql_code = "SELECT ae.* FROM asset_equipment ae LEFT OUTER JOIN asset_equipment_type aet ON aet.equipment_type_code=ae.TYPE order by ae.NOID ASC ";


                $sql = $Db->query($sql_code, '');
                
                 foreach ($sql as $row) { ?>
					<tr>
						<td></td>
						<td><?=$row['NOID'];?></td>
						<td ><?=$row['NAME'];?></td>
						<td><?=$row['MODEL'];?></td>
						<td>24</td>
						<td>6 minets ago</td>
						<td>
							
						</td>
					</tr>
                 <?PHP } ?>
				</tbody>
			</table>
			 <script type="text/javascript">
               $('document').ready(function(){
       var t = $('#equip-table').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0,
            
        } ],
    
        "order": [[ 1, 'asc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw(); //เรียกใช้งาน datatable
        
    });
            </script>