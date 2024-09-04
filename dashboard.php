

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
                            
                              echo "<option value='$year'>$year</option>";
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
                    <div class="row" id="display">
                      
                   
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
          let loadData=function(){
           
            var year = $("#year").val();
           
            // alert(month);

            $.ajax({
              url: "/models/load-dashboard.php",
              type: "POST",
              data:{"year":year,},
              success:function(results){
                  
                $("#display").html(results);
            
              }
            });
            
          }
          
          loadData();
          
          $("body").on("click","#entry",function(e){
            e.preventDefault();
            window.location.href="entry";

          });

          $("body").on("change","#year",function(){
            loadData();
          });
        })	
    </script>
    
    <!-- END: Page JS-->

  </body>
  <!-- END: Body-->

</html>