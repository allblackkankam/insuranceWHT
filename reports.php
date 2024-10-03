

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
    .table-bordered tr td{
      padding:10px !important;
      font-size:13px;
    }
    
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
                              <option value="0">All</option>
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
                            <option value="0">All</option>
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
                              echo "<option value='$monthNumber' $disabled>$monthName</option>";
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
                url: "/models/load-report.php",
                type: "POST",
                data:{"insurance":insurance,"year":year,"month":month},
                success:function(results){
                    
                  $("#display").html(results);
                  $(".zero-configuration").DataTable({
                      "bSort": false
                  });
              
                }
              });
            }
          }
          
          $("body").on("click","#search",function(){
            loadData();
          });


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