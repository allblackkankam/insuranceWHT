

<!DOCTYPE html>

<html class="loading" lang="en">
  <?php 
    require("templates/head.php"); 
    require("models/auth.php");
    checkUserRole(array("1","2"));
  ?>
  
  <style>
   
    
</style>
  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern 2-columns  navbar-sticky footer-static light-layout" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  
  <?php 
    require("templates/header.php") ;
    require("templates/left-nav.php");
  ?>
   

    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
        <div class="content-wrapper">
          <div class="content-header"></div>
            <div class="content-body"><!-- Dashboard Ecommerce Starts -->
              <div class="col-md-8 mx-auto">
                <div class="card mt-3">
                  <div class="card-header">
                      <h4 class="card-title font-weight-bolder text-uppercase mb-2">Insurance Company</h4>
                      <form id="insurance_form">
                        <fieldset>
                          <div class="input-group">
                            <input type="text" class="form-control form-control-lg" placeholder="Insurance Name" id="insurance_name" name="insurance_name">
                            <input type="hidden" name="insurance_code" id="insurance_code" value="">
                            <input type="hidden" name="action"  id="action" value="0">
                            <div class="input-group-append" id="button-addon2">
                              <button class="btn btn-primary" type="button" id="save">Save</button>
                            </div>
                          </div>
                        </fieldset>
                        <div id="msg"></div>
                      </form>
                  </div>
                  <hr>
                  <div class="card-content">
                    <div class="card-body">
                      <div id="load-data">

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <?php require("templates/footer.php") ?>

    <?php require("templates/foot.php") ?>

    <script>

      $(document).ready(function()
      {
      
        let loadData=function(){

          $.ajax
          ({
              url:"/models/load-data.php",	
              type:"POST",
              data:{"action":"in"},
              success:function(data)
              {	
                  $('#load-data').html(data);  
                  $(".zero-configuration").DataTable();
              }	
          })
                

        }

        loadData();
          
        $("body").on("click","#save",function(e)
        {
            e.preventDefault();
            var formdata=$("#insurance_form").serialize();
          
            var name=$("#insurance_name").val();

            if(name==""){
                $("#msg").html("<span class='text-danger'>Input Field Can't be empty</span>")
            }else{
                $.ajax
                ({
                    url: "models/insurance-mod.php",
                    type: "POST",
                    data:formdata,
                    success:(function(data)
                    {   
                        
                        //$("body").html(data);
                        //window.location.href="";
                        $("#insurance_form").trigger("reset");
                        loadData();
                        
                    })
                })
            }
            
                    
        })

        $('body').on('click','.edit',function()
        {   
            $("#form_post").trigger("reset");   
            $("#action").val("1");  //for editing purpose
            var name=$(this).parents("tr").attr("data-name")
            var code=$(this).parents("tr").attr("data-code")
            
            $("#insurance_name").val(name).focus();
            $("#insurance_code").val(code);
        })

        $('body').on('click','.delist ,.delete ,.list',function()
        {   
              
            var code=$(this).parents("tr").attr("data-code");
            var txt=$(this).attr("data-txt");
            var up=$(this).attr("data-up");
  
            swal({
                title: txt+ " Alert",
                text: "Are you sure you want to do this",
                icon: "warning",
                buttons: true,
                html: true,
            }).then((willRoute) => {
                if (willRoute) {
                    $.ajax({
                        url: "models/insurance-mod.php",
                        type: "POST",
                        data: { "insurance_code": code, "action": "2","update":up },
                        success: function(JSONObject) {
                            // window.location.href = "";
                            //$("body").html(JSONObject);
                            loadData();
                        }
                    })

                }
            })
            
        })

        
      })	
    </script>
    
    <!-- END: Page JS-->

  </body>
  <!-- END: Body-->

</html>