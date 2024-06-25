	
			<div class="box-typical box-typical-padding">
				
				<h5 class="m-t-lg with-border">บริษัท</h5>
                                <button id="addBtn" class="btn btn-inline btn-danger ladda-button" data-style="expand-right" data-size="xs"><i class="glyphicon glyphicon-plus"></i></button>

						
                                 
                                <div id="list-data"></div>	
                        </div>

			 <script type="text/javascript">
                $(window).load(function () {
            $.ajax({
                url: "modules/setting/company_data.php",
                type: "post",
                data: {
                 
                },

                success: function (data) {
                    $("#list-data").html(data);
                }
           
            }),
            $("#addBtn").click(function(){
           
            });
                    });

                   
                 
                 
             
            </script>