

<!DOCTYPE html>

<html class="loading" lang="en">
  <?php 
    require("templates/head.php");
    require("models/auth.php"); 

    $query= "SELECT * FROM insurance WHERE facility_id ='$center' AND insurance_status = 0;";
    $select_query = mysqli_query($conn,$query);

    $currentMonth = date('m');
    $months = array(
        '01' => 'January',
        '02' => 'February',
        '03' => 'March',
        '04' => 'April',
        '05' => 'May',
        '06' => 'June',
        '07' => 'July',
        '08' => 'August',
        '09' => 'September',
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
                            <div class="input-group-append" id="button-addon2">
                              <button class="btn btn-primary" type="button">Go</button>
                            </div>
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
                    <div class="col-md-4 mb-1">
                      <fieldset>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Select a Month</span>
                          </div>
                          <select name="year" id="year" class="form-control">
                            <?php
                            // Get current year
                           
                            // Generate options for years from current year to 10 years ago
                            foreach ($months as $monthNumber => $monthName) {
                                $selected = ($currentMonth == $monthNumber) ? 'selected' : '';
                                echo "<option value=\"$monthNumber\" $selected>$monthName</option>";
                            }
                            ?>
                          </select>
                          <div class="input-group-append" id="button-addon2">
                            <button class="btn btn-primary" type="button">Filter</button>
                          </div>
                        </div>
                      </fieldset>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <?php 
      require("templates/footer.php"); 
      require("templates/foot.php"); 
    ?>

    <script>

       $(document).ready(function()
        {
            
        })	
    </script>
    
    <!-- END: Page JS-->

  </body>
  <!-- END: Body-->

</html>