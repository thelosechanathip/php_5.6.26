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
					<th>ชื่อบริษัท</th>
					<th>ประเภท</th>
					<th>
						ที่ตั้ง
					</th>
					<th>
						เบอร์ร้าน
					</th>
					<th>fax</th>
					<th>มือถือ</th>
				</tr>
				</thead>
				<tbody>
                                    <?PHP
                                    
                $sql_code = "SELECT * FROM asset_company ";


                $sql = $Db->query($sql_code, '');
                
                 foreach ($sql as $row) { ?>
					<tr>
						<td></td>
						<td><?=$row['name'];?></td>
						<td ><?=$row['sale'];?></td>
						<td><?=$row['addr'];?></td>
						<td><?=$row['tel'];?></td>
						<td><?=$row['fax'];?></td>
						<td>
						<?=$row['mobile'];?>	
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