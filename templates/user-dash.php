<?php

    
   

    $query = "SELECT * FROM alert";
    $result = mysqli_query($conn,$query);
    $alert_count=mysqli_num_rows($result);

    $query = "SELECT * FROM addcar WHERE user_id = $u_id";
    $result = mysqli_query($conn,$query);
    $addcar_count=mysqli_num_rows($result);

?>


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body"><!-- Dashboard Ecommerce Starts -->
            <section id="dashboard-analytics">
              <div class="row">
                <!-- Website Analytics Starts-->
                
                
                <div class=" col-md-4">
                  <div class="card">
                    <div class="card-header d-flex justify-content-between pb-xl-0 pt-xl-1">
                      <div class="conversion-title">
                      <i class="bx bx-car mr-25 align-middle"></i>
                        <span class="align-middle text-muted">Packed Cars</span>
                        
                      </div>
                      <div class="conversion-rate">
                        <h2><?php echo $addcar_count; ?></h2>
                      </div>
                    </div>
                    <div class="card-content">
                      <div class="card-body text-center">
                        <div id="bar-negative-chart"></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                      <div class="card">
                      <div class="card-content">
                          <div class="card-body text-center pb-0">
                          <h2><?php echo $alert_count ?></h2>
                          <span class="text-muted">Alerts</span>
                          <div id="success-line-chart"></div>
                          </div>
                      </div>
                      </div>
                  </div>

                

              </div>
               
          </section>
        </div>
    </div>
</div>

