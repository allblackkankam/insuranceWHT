<?php

    $query = "SELECT * FROM users WHERE user_role ='1'";
    $result = mysqli_query($conn,$query);
    $users_count=mysqli_num_rows($result);

    $query = "SELECT * FROM aff";
    $result = mysqli_query($conn,$query);
    $aff_count=mysqli_num_rows($result);

    $query = "SELECT * FROM alert";
    $result = mysqli_query($conn,$query);
    $alert_count=mysqli_num_rows($result);

    $query = "SELECT * FROM addcar";
    $result = mysqli_query($conn,$query);
    $addcar_count=mysqli_num_rows($result);

    $query = "SELECT * FROM carreg";
    $result = mysqli_query($conn,$query);
    $carreg_count=mysqli_num_rows($result);

?>


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body"><!-- Dashboard Ecommerce Starts -->
            <section id="dashboard-analytics">
                <div class="row">
                <!-- Website Analytics Starts-->
            
                <div class="col-xl-3 col-md-6 col-12 activity-card">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Activity</h4>
        </div>
        <div class="card-content">
          <div class="card-body pt-1">
            <div class="d-flex activity-content">
              <div class="avatar bg-rgba-primary m-0 mr-75">
                <div class="avatar-content">
                  <i class="bx bx-bar-chart-alt-2 text-primary"></i>
                </div>
              </div>
              <div class="activity-progress flex-grow-1">
                <small class="text-muted d-inline-block mb-50">Total Sales</small>
                <small class="float-right">$8,125</small>
                <div class="progress progress-bar-primary progress-sm">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" style="width:50%"></div>
                </div>
              </div>
            </div>
            <div class="d-flex activity-content">
              <div class="avatar bg-rgba-success m-0 mr-75">
                <div class="avatar-content">
                  <i class="bx bx-dollar text-success"></i>
                </div>
              </div>
              <div class="activity-progress flex-grow-1">
                <small class="text-muted d-inline-block mb-50">Income Amount</small>
                <small class="float-right">$18,963</small>
                <div class="progress progress-bar-success progress-sm">
                  <div class="progress-bar" role="progressbar" aria-valuenow="80" style="width:80%"></div>
                </div>
              </div>
            </div>
            <div class="d-flex activity-content">
              <div class="avatar bg-rgba-warning m-0 mr-75">
                <div class="avatar-content">
                  <i class="bx bx-stats text-warning"></i>
                </div>
              </div>
              <div class="activity-progress flex-grow-1">
                <small class="text-muted d-inline-block mb-50">Total Budget</small>
                <small class="float-right">$14,150</small>
                <div class="progress progress-bar-warning progress-sm">
                  <div class="progress-bar" role="progressbar" aria-valuenow="60" style="width:60%"></div>
                </div>
              </div>
            </div>
            <div class="d-flex mb-75">
              <div class="avatar bg-rgba-danger m-0 mr-75">
                <div class="avatar-content">
                  <i class="bx bx-check text-danger"></i>
                </div>
              </div>
              <div class="activity-progress flex-grow-1">
                <small class="text-muted d-inline-block mb-50">Completed Tasks</small>
                <small class="float-right">106</small>
                <div class="progress progress-bar-danger progress-sm">
                  <div class="progress-bar" role="progressbar" aria-valuenow="30" style="width:30%"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
                </div>
            </section>
        </div>
    </div>
</div>

