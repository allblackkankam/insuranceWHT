

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
                <!-- account setting page start -->
                    <section id="page-account-settings">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <!-- left menu section -->
                                    <div class="col-md-3 mb-2 mb-md-0 pills-stacked">
                                        <ul class="nav nav-pills flex-column">
                                            <li class="nav-item mb-1">
                                                <a class="nav-link d-flex align-items-center active" id="account-pill-general" data-toggle="pill"
                                                    href="#account-vertical-general" aria-expanded="true">
                                                    <i class="bx bx-cog"></i>
                                                    <span>General</span>
                                                </a>
                                            </li>
                                            <li class="nav-item mb-1">
                                                <a class="nav-link d-flex align-items-center" id="account-pill-password" data-toggle="pill"
                                                    href="#account-vertical-password" aria-expanded="false">
                                                    <i class="bx bx-lock"></i>
                                                    <span>Change Password</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- right content section -->
                                    <div class="col-md-9">
                                        <div class="card" style="background: #f2f4f4;border-radius: 10px;">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="tab-content">
                                                        <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">

                                                            <form novalidate>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label>Username</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Username" value="hermione007" required
                                                                                    data-validation-required-message="This username field is required">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label>Name</label>
                                                                                <input type="text" class="form-control" placeholder="Name"
                                                                                    value="" required
                                                                                    data-validation-required-message="This name field is required">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label>E-mail</label>
                                                                                <input type="email" class="form-control" placeholder="Email"
                                                                                    value="" required
                                                                                    data-validation-required-message="This email field is required">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                   
                                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                        <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save
                                                                            changes</button>
                                                                        <button type="reset" class="btn btn-light mb-1">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="tab-pane fade " id="account-vertical-password" role="tabpanel"
                                                            aria-labelledby="account-pill-password" aria-expanded="false">
                                                            <form novalidate>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label>Old Password</label>
                                                                                <input type="password" class="form-control" required
                                                                                    placeholder="Old Password"
                                                                                    data-validation-required-message="This old password field is required">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label>New Password</label>
                                                                                <input type="password" name="password" class="form-control"
                                                                                    placeholder="New Password" required
                                                                                    data-validation-required-message="The password field is required"
                                                                                    minlength="6">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label>Retype new Password</label>
                                                                                <input type="password" name="con-password"
                                                                                    class="form-control" required
                                                                                    data-validation-match-match="password"
                                                                                    placeholder="New Password"
                                                                                    data-validation-required-message="The Confirm password field is required"
                                                                                    minlength="6">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                        <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save
                                                                            changes</button>
                                                                        <button type="reset" class="btn btn-light mb-1">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <!-- account setting page ends -->
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