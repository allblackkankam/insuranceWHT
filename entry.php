

<!DOCTYPE html>

<html class="loading" lang="en">
  <?php 
    require("templates/head.php");
    require("models/auth.php"); 

    $query= "SELECT * FROM insurance WHERE facility_id ='$center' AND insurance_status = 0;";
    $select_query = mysqli_query($conn,$query);

    $currentMonth = date('m');
    $currentYear = date('Y');
    $months = array(
        '1' => 'January',
        '2' => 'February',
        '3' => 'March',
        '4' => 'April',
        '5' => 'May',
        '6' => 'June',
        '7' => 'July',
        '8' => 'August',
        '9' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December'
    );
   
   ?>
  <style>
   
    
</style>
  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern 2-columns  navbar-sticky footer-static light-layout" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  
  <?php 
    require("templates/header.php");
    require("templates/left-nav.php");
  ?>
   

    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
        <div class="content-wrapper">
          <div class="content-header row"></div>
            <div class="content-body">
              <div class="card mt-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4 mb-1">
                        <fieldset>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">Select Insurance</span>
                            </div>
                            <select name="insurance" id="insurance" class="form-control">
                              <option value="">Select Insurace</option>
                              <?php
                                while($row=mysqli_fetch_array($select_query)){
                                  $id = $row['id'];
                                  $insurance_name = $row['insurance_name'];
                                  $insurance_code = $row['insurance_code'];
                                  $status = $row['insurance_status'];
                                  
                                  echo'<option value="'. $insurance_code.'">'. $insurance_name.'</option>';

                                

                                }
                      
                              ?>
                            </select>
                          </div>
                        </fieldset>
                    </div>
                    <div class="col-md-4 mb-1">
                      <fieldset>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Select a Year</span>
                          </div>
                          <select name="year" id="year" class="form-control">
                            <?php
                            // Get current year
                            $currentYear = date('Y');
                            
                            // Generate options for years from current year to 10 years ago
                            for ($year = $currentYear; $year >= $currentYear - 10; $year--) {
                                // $selected = ($year == $_GET['year']) ? 'selected' : '';
                                echo "<option value='$year' >$year</option>";
                            }
                            ?>
                          </select>
                        </div>
                      </fieldset>
                    </div>
                    <div class="col-md-4 mb-1">
                      <fieldset>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Select a Month</span>
                          </div>
                          <select name="month" id="month" class="form-control">
                            <?php
                            // Get current year
                           
                            // Generate options for years from current year to 10 years ago
                            foreach ($months as $monthNumber => $monthName) {
                              $disabled = '';
                              // Check if the month is in the future
                              if ($currentYear < date('Y') || ($currentYear == date('Y') && $monthNumber > $currentMonth)) {
                                  $disabled = 'disabled';
                              }
                              $selected = ($currentMonth == $monthNumber) ? 'selected' : '';
                              echo "<option value='$monthNumber' $selected $disabled>$monthName</option>";
                          }
                            ?>
                          </select>
                          <div class="input-group-append" id="button-addon2">
                            <button class="btn btn-primary" id="search" type="button">Go</button>
                          </div>
                        </div>
                      </fieldset>
                    </div>
                  </div>
                  
                </div>
              </div>
              
                
              <div id="display">
             
              </div>
              
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Entry</h3>
                    <button type="button" class="close rounded-pill editclose" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                  <form id="add_first_form">
                    <div id="msg"></div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Service Amount<span class="text-danger" id="service_amtErr"></span></label>
                                <input type="number" class="form-control itnumeric" name="service_amt" id="service_amt">
                                <input type="hidden" class="form-control" name="action" id="action" value="0">
                                <input type="hidden" class="form-control" name="type" id="type" value="edit">
                                <input type="hidden" class="form-control" name="id" id="id">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Drugs Amount<span class="text-danger" id="drugs_amteErr"></span></label>
                                <input type="number" class="form-control itnumeric" name="drugs_amt" id="drugs_amt">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Services Adjustment<span class="text-danger" id="service_adjErr"></span></label>
                                <input type="number" class="form-control itnumeric" name="service_adj" id="service_adj">
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div class="form-group">
                                <label>Drugs Adjustment<span class="text-danger" id="drugs_adjErr"></span></label>
                                <input type="number" class="form-control itnumeric" name="drugs_adj" id="drugs_adj">
                            </div>
                        </div>
                        
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" class="btn btn-primary ml-1" id="add_first">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Save</span>
                    </button>
                </div>
            </div>
            
        </div>
    </div>
    <!-- END: Content-->

    <div class="modal fade text-left" id="paymentmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Payments</h3>
                    <button type="button" class="close rounded-pill editclose" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                  <form id="add_payment_form">
                    <div id="msg"></div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Service Paid<span class="text-danger" id="service_paidErr"></span></label>
                                <input type="number" class="form-control ifnumeric" name="service_paid" id="service_paid" value="0">
                                <input type="hidden" class="form-control" name="action" id="action" value="2">
                                <input type="hidden" class="form-control" name="type" id="typepay" value="new">
                                <input type="hidden" class="form-control" name="id" id="idpay">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Drugs Paid<span class="text-danger" id="drugs_paidErr"></span></label>
                                <input type="number" class="form-control ifnumeric" name="drugs_paid" id="drugs_paid" value="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>WHT Paid<span class="text-danger" id="tax_paidErr"></span></label>
                                <input type="number" class="form-control ifnumeric" name="tax_paid" id="tax_paid" value="0">
                            </div>
                        </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" class="btn btn-primary ml-1" id="add_payment">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Save</span>
                    </button>
                </div>
            </div>
            
        </div>
    </div>

    <?php 
      require("templates/footer.php"); 
      require("templates/foot.php"); 
    ?>

    <script>

       $(document).ready(function()
        {

          let loadData=function(){
            var insurance = $("#insurance").val();
            var year = $("#year").val();
            var month = $("#month").val();

            // alert(month);

            if(insurance=="" || year=="" || month==""){
              toastr.error(
                "Select insurance company.",
                "Error!",
                { positionClass: "toast-bottom-left", containerId: "toast-bottom-left",progressBar: !0,closeButton: !0, }
              );
            }else{
              $.ajax({
                url: "/models/load-entry.php",
                type: "POST",
                data:{"insurance":insurance,"year":year,"month":month},
                success:function(results){
                    
                  $("#display").html(results);
              
                }
              });
            }
          }
          
          $("body").on("click","#search",function(){
            loadData();
          });

        
          $("body").on("click","#add_first",function(e){
     
            e.preventDefault();

            var insurance = $("#insurance").val();
            var year = $("#year").val();
            var month = $("#month").val();
            var type =$("#type").val();
            var monthid = year+"-"+month;

            dataserial={"insurance":insurance,"monthid":monthid}
        
            var form = document.getElementById("add_first_form");
            var data = new FormData(form);
            
            var acceptedValue=0;
            if(type=='new'){
              $(".isnumeric").each(function( index, value ){
                  var thisValue=$(this).val();
                  if($.isNumeric(thisValue)){

                  }else{
                      $(this).css({"border-color":"red"})
                      acceptedValue++;

                  }

              })
            }else{
              $(".itnumeric").each(function( index, value ){
                var thisValue=$(this).val();
                if($.isNumeric(thisValue)){

                }else{
                    $(this).css({"border-color":"red"})
                    acceptedValue++;

                }

              })
            }
            

            if(acceptedValue==0){
              data.append('data', JSON.stringify(dataserial));

              $.ajax({
                  url: "/models/create-entry-mod.php",
                  type: "POST",
                  processData:false,
                  contentType:false,
                  //dataType:"json",
                  data:data,
                  success:function(results){
                      
                    $("#add_first").html("<img style='width:20px;height:20px' src='app-assets/images/sp-loading.gif'/>").prop("disabled",true);
                    //$("body").html(results);
                    var array={};
                    array = JSON.parse(results);
                    if(array["action"]== "0")
                    {               
                        
                        $("#add_first").html("Try Again").prop("disabled",false);
                                                                    
                    }else if(array["action"]=="1")
                    {
                        
                      toastr.success(
                        "Created Successfully.",
                        "Great!",
                        { positionClass: "toast-bottom-left", containerId: "toast-bottom-left",progressBar: !0,closeButton: !0, }
                      );

                      $("#add_first_form").trigger("reset");
                      $("#editmodal").modal("hide");
                      
                      loadData();

                      $("#add_first").html("Save").prop("disabled",false);
                    }else if(array["action"]=="CSRF")
                    {
                        
                      window.location.href="/errorfiles/400";
                    }else{
                      $("#add_first").html("No Change").prop("disabled",false);
                    }
                  }
                  
              });
            }else{
              toastr.error(
                "Only number value are accepted.",
                "Error!",
                { positionClass: "toast-bottom-left", containerId: "toast-bottom-left",progressBar: !0,closeButton: !0, }
              );
            }
          });

          $('body').on('click','.edit',function()
          {   
             
              var code=$(this).parents("tr").attr("data-id");
             
              $("#editmodal").modal("show");

              var amount_drugs=$(this).parents("tr").attr("data-drugamt")
              var amount_services=$(this).parents("tr").attr("data-serviceamt")
              var adj_drugs=$(this).parents("tr").attr("data-drugadj")
              var adj_services=$(this).parents("tr").attr("data-serviceadj")
      
              
              $("#drugs_amt").val(amount_drugs);
              $("#service_amt").val(amount_services);
              $("#drugs_adj").val(adj_drugs);
              $("#service_adj").val(adj_services);
              $("#id").val(code);

              $("#type").val('update');

          })

          $('body').on('click','.delete', function()
          {   
              
            var code=$(this).parents("tr").attr("data-id");
            var year = $("#year").val();
            var month = $("#month").val();
            var monthid = year+"-"+month;
            var datatype = $(this).attr("data-type");
          
            if(datatype==0){
              var id = monthid;
            }else{
              var id = code;
            }

            swal({
                title: "Deleting Entries",
                text: "Deleting this would remove all entries for this month",
                icon: "warning",
                buttons: true,
                html: true,
            }).then((willRoute) => {
                if (willRoute) {
                    $.ajax({
                        url: "models/create-entry-mod.php",
                        type: "POST",
                        data: { "id": id,"type":datatype, "action": "1" },
                        success: function(JSONObject) {
                            // window.location.href = "";
                            //$("body").html(JSONObject);
                            loadData();
                        }
                    })

                }
            })
              
          })

          $('body').on('click','.add',function()
          {   
             
            $("#paymentmodal").modal("show");

            $("#paymentmodal").modal("show");
            $("#idpay").val("");
            $("#typepay").val('new');

          })

          $("body").on("click","#add_payment",function(e){
     
            e.preventDefault();
            
            var insurance = $("#insurance").val();
            var year = $("#year").val();
            var month = $("#month").val();
            var monthid = year+"-"+month;

            dataserial={"insurance":insurance,"monthid":monthid}
        
            var form = document.getElementById("add_payment_form");
            var data = new FormData(form);
            
            var acceptedValue=0;
            $(".ifnumeric").each(function( index, value ){
                var thisValue=$(this).val();
                if($.isNumeric(thisValue)){

                }else{
                    $(this).css({"border-color":"red"})
                    acceptedValue++;

                }

            })
            
            if(acceptedValue==0){
              data.append('data', JSON.stringify(dataserial));

              $.ajax({
                  url: "/models/create-entry-mod.php",
                  type: "POST",
                  processData:false,
                  contentType:false,
                  //dataType:"json",
                  data:data,
                  success:function(results){
                      
                      $("#add_payment").html("<img style='width:20px;height:20px' src='app-assets/images/sp-loading.gif'/>").prop("disabled",true);
                      //$("body").html(results);
                      var array={};
                      array = JSON.parse(results);
                      if(array["action"]== "0")
                      {               
                          
                        $("#add_payment").html("Try Again").prop("disabled",false);
                                                                      
                      }else if(array["action"]=="1")
                      {
                          
                        toastr.success(
                          "Created Successfully.",
                          "Great!",
                          { positionClass: "toast-bottom-left", containerId: "toast-bottom-left",progressBar: !0,closeButton: !0, }
                        );

                        $("#add_payment_form").trigger("reset");
                        $("#paymentmodal").modal("hide");

                        loadData();
                          
                        $("#add_payment").html("Save").prop("disabled",false);
                      }else if(array["action"]=="CSRF")
                      {
                          window.location.href="/errorfiles/400";
                      }else{
                        $("#add_payment").html("No Change").prop("disabled",false);
                      }
                          

                          
                          
                  }
                  
              });
            }else{
              toastr.error(
                "Only number value are accepted.",
                "Error!",
                { positionClass: "toast-bottom-left", containerId: "toast-bottom-left",progressBar: !0,closeButton: !0, }
              );
            }
          });

          $('body').on('click','.editpayment',function()
          {   
             
            var code=$(this).parents("tr").attr("data-id");
            $("#paymentmodal").modal("show");
            var paid_drugs=$(this).parents("tr").attr("data-drugpaid")
            var paid_services=$(this).parents("tr").attr("data-servicepaid")
            var paid_tax=$(this).parents("tr").attr("data-taxpaid")
    
            
            $("#drugs_paid").val(paid_drugs);
            $("#service_paid").val(paid_services);
            $("#tax_paid").val(paid_tax);
            $("#idpay").val(code);

            $("#typepay").val('update');

          })

          $('body').on('click','.report',function()
          {   
             
            var insurance = $("#insurance").val();
            var year = $("#year").val();
            var month = $("#month").val();
            var monthid = year+"-"+month;

            window.open("printreport?in="+insurance+"&mo="+month+"&yr="+year,"Print Report");
           
          })
            
        })	
    </script>
    
    <!-- END: Page JS-->

  </body>
  <!-- END: Body-->

</html>