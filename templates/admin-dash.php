<?php

    $query = "SELECT * FROM users WHERE user_role ='1'";
    $result = mysqli_query($conn,$query);
    $users_count=mysqli_num_rows($result);

    $query = "SELECT * FROM aff";
    $result = mysqli_query($conn,$query);
   /* $aff_count=mysqli_num_rows($result);*/

    $query = "SELECT * FROM alert";
    $result = mysqli_query($conn,$query);
   /* $alert_count=mysqli_num_rows($result);*/

    $query = "SELECT * FROM addcar";
    $result = mysqli_query($conn,$query);
   /* $addcar_count=mysqli_num_rows($result);*/

    $query = "SELECT * FROM carreg";
    $result = mysqli_query($conn,$query);
   /* $carreg_count=mysqli_num_rows($result);*/

?>


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body"><!-- Dashboard Ecommerce Starts -->
            <section id="dashboard-analytics">
                <div class="container mx-auto">
                  <div class="row">
                
                      <div class="Jan col-md-2">JANUARY</div>
                      <div class="Feb  col-md-2">FEBRUARY</div>
                      <div class="Mar  col-md-2">MARCH</div>
                      <div class="Apr  col-md-2">APRIL</div>
                      
                      <div class="May  col-md-2">MAY</div>
                      <div class="Jun  col-md-2">JUNE</div>
                      <div class="Jul  col-md-2">JULY</div>
                      <div class="Aug  col-md-2">AUGUST</div>
                      <div class="Sept  col-md-2">SEPTEMBER</div>
                      <div class="Oct  col-md-2">OCTOBER</div>
                      <div class="Nov  col-md-2">NOVEMBER</div>
                      <div class="Dec  col-md-2">DECEMBER</div>
                  </div>

              </div>
                
            </section>
        </div>
    </div>
</div>

