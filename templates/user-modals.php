

<!-- Cars Info modal -->
 <div class="modal fade text-left" id="uvinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Vehicle Info</h3>
        <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body uvinfo">
      
      
          
      </div>
          
      <div class="modal-footer">
        <button type="button" class="btn btn-light-primary" data-dismiss="modal">
          <i class="bx bx-x d-block d-sm-none"></i>
          <span class="d-none d-sm-block">Close</span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- END: Footer-->

<!-- Cars Edit Modal -->
<div class="modal fade text-left" id="vedit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Edit Vehicle</h3>
        <button type="button" class="close rounded-pill editclose" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body vedit">
        
      
        
      </div>
     
    </div>
  </div>
</div>


<!-- Cars histroy Modal -->
<div class="modal fade text-left" id="vhistory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Vehicle History</h3>
        <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body">
        <ul class="widget-timeline vhistory">
                
               
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light-primary" data-dismiss="modal">
          <i class="bx bx-x d-block d-sm-none"></i>
          <span class="d-none d-sm-block">Close</span>
        </button>
      </div>
    </div>
  </div>
</div>
    <!-- END: Footer-->


    <!-- END: Footer-->

<script>
  //Edit Cars
  $(document).ready(function(){
    $("body").on("click","#edit",function(e){
      
      e.preventDefault();
      // $("#save").parents("#form_add").find(".err").fadeOut(); 
      // $("#save").prop("disabled",true);
      var form = document.getElementById("form_edit");
      var data = new FormData(form);

    
     
      // alert(data);

      $.ajax({
            url: "../models/edit-car-mod.php",
            type: "POST",
            processData:false,
						contentType:false,
						//dataType:"json",
            data:data,
             success:function(results){
                  $("#edit").prop("disabled",false);
                  // $("#msge").fadeIn().html(results);
                  var array={};
                  array = JSON.parse(results);
                  if(array["action"]== "0")
                  {               
                      $("#ed_nameErr").fadeIn().html(array["name"])
                      $("#ed_numberErr").fadeIn().html(array["phone"])
                      $("#ec_makeErr").fadeIn().html(array["make"])
                      $("#ec_numberErr").fadeIn().html(array["c_num"])
                      $("#ec_modelErr").fadeIn().html(array["model"])
                      $("#ec_colorErr").fadeIn().html(array["color"])
                      $("#ec_picErr").fadeIn().html(array["img"])
                      $("#edit").html("Try Again")
                                                                 
                  }else 
                  if(array["action"]=="1")
                  {
                      
                      $("#msge").html('<div class="alert alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Edited Successfully</span></div>');

                      // window.location.href="";
                      $("#edit").html("Update")
                  }else 
                  if(array["action"]=="CSRF")
                  {
                      
                      window.location.href="/errorfiles/400";
                  }
                  

                  
                 
            }
            
        });

    });
  });
</script>
