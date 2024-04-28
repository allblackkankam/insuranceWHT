

<!DOCTYPE html>

<html class="loading" lang="en">
  <?php require("templates/head.php") ?>

  <?php require("models/auth.php") ?>
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
            <div class="content-body"><!-- Dashboard Ecommerce Starts -->
              <div class="card mt-3">
                <div class="card-body">
                  <div class="col-md-6 mb-1">
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
                              $selected = ($year == $_GET['year']) ? 'selected' : '';
                              echo "<option value='$year' $selected>$year</option>";
                          }
                          ?>
                        </select>
                        <div class="input-group-append" id="button-addon2">
                          <button class="btn btn-primary" type="button">Filter</button>
                        </div>
                      </div>
                    </fieldset>
                  </div>
                  <div class="col-12">
                    <div class="row">
                      <!-- <div class="col-md-3 col-sm-6 mb-sm-1">
                        
                      </div> -->

                      <?php
                        // Determine the current year
                        $currentYear = date('Y');

                        // Array of month names
                        $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

                        // Get current month
                        $currentMonth = date('n');

                        // Loop through each month and create a div for each one
                        foreach ($months as $key => $month) {
                            // Check if the month has passed or is the current month
                            if (($key + 1) <= $currentMonth) {
                                echo "<div class='col-md-3 col-sm-6 mb-sm-1'>
                                        <div class='months passed' id='entry'>
                                          <p class='font-size-large'>$month</p>
                                          <div class='mt-2'>
                                            <p>Total Submitted <span class='float-right font-4'>200</span></p>
                                            <p>Total Drugs <span class='float-right font-4'>200</span></p>
                                            <p>Total Other Servives <span class='float-right font-4'>200</span></p>
                                            <p>Total Adjusted <span class='float-right font-4'>200</span></p>
                                          </div>
                                          
                                          
                                        </div>
                                      </div>";
                            } else {
                                echo "<div class='col-md-3 col-sm-6 mb-sm-1'><div class='months not-passed'>$month</div></div>";
                            }
                        }
                        
                      ?>

                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
</head>
<body>
  

    <?php require("templates/footer.php") ?>

    <?php require("templates/foot.php") ?>

    <script src="app-assets/js/scripts/dashboard-analytics.min.js"></script>
    <script>

       $(document).ready(function()
        {
            $("body").on("click","#entry",function(e){
              e.preventDefault();
              window.location.href="entry";

            });
        })	
    </script>
    
    <!-- END: Page JS-->

  </body>
  <!-- END: Body-->

</html>