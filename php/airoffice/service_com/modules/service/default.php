
			
			<div class="box-typical box-typical-padding">
				
				<h5 class="m-t-lg with-border">ทะเบียนงาน</h5>
                                <button id="menuAddService" class="btn btn-inline btn-danger ladda-button" data-toggle="modal" data-target=".bs-example-modal-lg" data-style="expand-right" data-size="xs"><i class="glyphicon glyphicon-plus"></i></button>

						
                                 
                                <div id="list-data"></div>	
                        </div>

			 <script type="text/javascript">
                $(window).load(function () {
            $.ajax({
                url: "modules/service/equip_data.php",
                type: "post",
                data: {
                 
                },

                success: function (data) {
                    $("#list-data").html(data);
                }
           
            }),
            
            $("#menuAddService").click(function () {
            $("#frmService").modal();
        });
            $("#addBtn").click(function(){
           
            });
                    });

                   
                 
                 
             
            </script>