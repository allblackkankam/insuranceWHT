
  <!-- Car Info Modal -->
  <div class="modal fade text-left" id="vinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document" >
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Vehicle Info</h3>
          <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x"></i>
          </button>
        </div>
         <div class="modal-body vinfo">
       
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

<!-- Create Alert Modal -->
<div class="modal fade text-left" id="calert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Create Alert</h3>
        <button type="button" class="close rounded-pill editclose" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body calert">
        
      </div>
      
    </div>
  </div>
</div>

  <!-- Edit Cars Modal -->
  <div class="modal fade text-left" id="sedit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document" >
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Vehicle Edit</h3>
            <button type="button" class="close rounded-pill editclose" data-dismiss="modal" aria-label="Close">
              <i class="bx bx-x"></i>
            </button>
          </div>
          <div class="modal-body sedit">
            
          </div>
        </div>
      </div>
  </div>
    <!-- END: Footer-->

  <!-- Edit Cars Modal -->
  <div class="modal fade text-left" id="aedit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document" >
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Vehicle Edit</h3>
            <button type="button" class="close rounded-pill editclose" data-dismiss="modal" aria-label="Close">
              <i class="bx bx-x"></i>
            </button>
          </div>
          <div class="modal-body aedit">
            
          </div>
        </div>
      </div>
  </div>
    <!-- END: Footer-->

    <!-- Edit Affiliates Modal -->
  <div class="modal fade text-left" id="affedit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document" >
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Affiliates Edit</h3>
            <button type="button" class="close rounded-pill editclose" data-dismiss="modal" aria-label="Close">
              <i class="bx bx-x"></i>
            </button>
          </div>
          <div class="modal-body affedit">
            
          </div>
        </div>
      </div>
  </div>
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

            // console.log(data);

            $.ajax({
                  url: "/models/edit-reg-car-mod.php",
                  type: "POST",
                  processData:false,
                  contentType:false,
                  //dataType:"json",
                  data:data,
                  success:function(results){
                        $("#edit").prop("disabled",false);
                        $("#emsg").fadeIn().html(results);
                        var array={};
                        array = JSON.parse(results);
                        if(array["action"]== "0")
                        {               
                          ("#c_enumErr").fadeIn().html(array["c_num"])
                            $("#c_emakeErr").fadeIn().html(array["make"])
                            $("#c_emodelErr").fadeIn().html(array["model"])
                            $("#c_evinErr").fadeIn().html(array["vin"])
                            $("#c_etyreErr").fadeIn().html(array["tyre"])
                            $("#c_etyrenumErr").fadeIn().html(array["tyrenum"])
                            $("#c_eengineErr").fadeIn().html(array["engine"])
                            $("#c_eenginenumErr").fadeIn().html(array["enginenum"])
                            $("#c_ecolorErr").fadeIn().html(array["color"])
                            $("#c_einfoErr").fadeIn().html(array["info"])
                            $("#c_epicErr").fadeIn().html(array["pic"])
                            $("#o_enameErr").fadeIn().html(array["o_name"])
                            $("#o_enumErr").fadeIn().html(array["o_num"])
                            $("#o_elicErr").fadeIn().html(array["o_lic"])
                            $("#i_ecomErr").fadeIn().html(array["i_com"])
                            $("#i_etypeErr").fadeIn().html(array["i_type"])
                            $("#i_enumErr").fadeIn().html(array["i_num"])
                            $("#edit").html("Try Again")
                                                                      
                        }else 
                        if(array["action"]=="1")
                        {
                            
                            $("#emsg").html('<div class="alert alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Edited Successfully</span></div>');

                            // window.location.href="";
                            $("#edit").html("Update");
                        }else 
                        if(array["action"]=="CSRF")
                        {
                            
                            window.location.href="/errorfiles/400";
                        }
                        

                        
                      
                  }
                  
              });

          });
        });


    //Create Alerts
    $(document).ready(function(){
      $("body").on("click","#send_alert",function(e){
        
        e.preventDefault();
        // $("#save").parents("#form_add").find(".err").fadeOut(); 
        // $("#save").prop("disabled",true);
        var form = document.getElementById("form_alert");
        var data = new FormData(form);

      
      
        // console.log(data);

        $.ajax({
              url: "/models/alert-mod.php",
              type: "POST",
              processData:false,
              contentType:false,
              //dataType:"json",
              data:data,
              success:function(results){
                    $("#send_alert").prop("disabled",false);
                    // $("#alert_msg").fadeIn().html(results);
                    var array={};
                    array = JSON.parse(results);
                    if(array["action"]== "0")
                    {               
                        $("#a_nameErr").fadeIn().html(array["name"])
                        $("#a_meansErr").fadeIn().html(array["means"])
                        $("#a_infoErr").fadeIn().html(array["info"])
                        $("#send_alert").html("Try Again")
                                                                  
                    }else 
                    if(array["action"]=="1")
                    {
                        
                        $("#alert_msg").html('<div class="alert alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Alert Sent Successfully</span></div>');

                        $("input").val("");
                        $("textarea").val("");
                        

                        $("#a_nameErr").fadeIn().html(array["name"])
                        $("#a_meansErr").fadeIn().html(array["means"])
                        $("#a_infoErr").fadeIn().html(array["info"])
                        
                        // window.location.href="";
                        $("#send_alert").html("Send Alert")
                    }else 
                    if(array["action"]=="CSRF")
                    {
                        
                        window.location.href="/errorfiles/400";
                    }
                    

                    
                  
              }
              
          });

      });
    });


    //Edit Alerts
    $(document).ready(function(){
      $("body").on("click","#edit_alert",function(e){
        
        e.preventDefault();
        // $("#save").parents("#form_add").find(".err").fadeOut(); 
        // $("#save").prop("disabled",true);
        var form = document.getElementById("eform_alert");
        var data = new FormData(form);

      
      
        // console.log(data);

        $.ajax({
              url: "/models/alert-edit-mod.php",
              type: "POST",
              processData:false,
              contentType:false,
              //dataType:"json",
              data:data,
              success:function(results){
                    $("#edit_alert").prop("disabled",false);
                    $("#ealert_msg").fadeIn().html(results);
                    var array={};
                    array = JSON.parse(results);
                    if(array["action"]== "0")
                    {               
                        $("#a_enameErr").fadeIn().html(array["name"])
                        $("#a_emeansErr").fadeIn().html(array["means"])
                        $("#a_einfoErr").fadeIn().html(array["info"])
                        $("#edit_alert").html("Try Again")
                                                                  
                    }else 
                    if(array["action"]=="1")
                    {
                        
                        $("#ealert_msg").html('<div class="alert alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Alert Edited Successfully</span></div>');

                        
                        $("#a_nameErr").fadeIn().html(array["name"])
                        $("#a_meansErr").fadeIn().html(array["means"])
                        $("#a_infoErr").fadeIn().html(array["info"])
                        
                        // window.location.href="";
                        $("#edit_alert").html("Update Alert")
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
