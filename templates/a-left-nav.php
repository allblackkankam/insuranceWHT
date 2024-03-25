<?php
    $pg = basename(substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],'.'))); // get file name from url and strip extension
?>


<!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mr-auto"><a class="navbar-brand" href="dashboard">
              <div class="brand-logo"><img class="logo" src="app-assets/images/logo.png"/></div>
              <h2 class="brand-text mb-0" style="color:#fff">CARPARK</h2></a></li>
          <li class="nav-item nav-toggle">
            <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse" >
              <i class="bx bx-x d-block d-xl-none font-medium-4 primary" ></i>
              <i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block " data-ticon="bx-disc"></i>
            </a>
          </li>
        <hr>
      </div>
      <div class="shadow-bottom"></div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">         
          <li class="<?php if($pg=='dashboard'){?> active<?php }?> nav-item">
            <a href="dashboard">
              <p class="ficon bx bx-dashboard text-center" style="width: 100%;font-size:40px;color: #fff"></p>
              <p class="menu-title text-center" style="color: #fff;"><b>Dashboard</b></p>
            </a>
          </li>
          <li class="<?php if($pg=='vrs'){?> active<?php }?> nav-item">
            <a href="vrs">
             <p class="ficon bx bx-radar text-center" style="width: 100%;font-size:40px;color: #fff"></p>
             <p class="menu-title text-center" style="color: #fff;"><b>VRS</b></p>
            </a>
          </li>
        

          <div style="padding:20px;margin-top:40px;">
        
            <li class="nav-item">
              <a href="edit-profile" class="btn btn-primary" style="padding:5px">
                <i class="ficon bx bx-user" style="color:#fff;font-size:18px"></i> 
                <span class="menu-title">Edit Profile</span>
              </a>
            </li>
            <br>
            <li class="nav-item">
              <a href="logout" class="btn btn-danger" style="padding:5px">
                <i class="ficon bx bx-power-off" style="color:#fff;font-size:18px" ></i> 
                <span class="menu-title">Logout</span>
              </a>
            </li>
            
          </div>
            
          
          
          
        </ul>
      </div>
    </div>
    <!-- END: Main Menu-->