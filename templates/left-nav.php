<?php
    $pg = basename(substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],'.'))); // get file name from url and strip extension
?>


<!-- BEGIN: Main Menu-->
    <!-- <div class="main-menu menu-fixed menu-light menu-accordion" data-scroll-to-active="true">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mr-auto">
            <a class="navbar-brand" href="dashboard">
              <div class="brand-logo"><img class="logo" src="app-assets/images/logo.png"/></div>
              <h2 class="brand-text mb-0">INSURANCE</h2>
            </a>
          </li>
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
            <a href="dashboard"><i class="ficon bx bx-dashboard"></i><span class="menu-title" data-i18n="Chat">Dashboard</span></a>
          </li>
          <li class="<?php if($pg=='pss'){?> active<?php }?> nav-item">
            <a href="pss">
              <p class="ficon bx bx-check-shield text-center" style="width: 100%;font-size:40px;color: #fff"></p>
              <p class="menu-title text-center" style="color: #fff;"><b>Packing Security System</b></p>
            </a>
          </li>
          <li class="<?php if($pg=='vrs'){?> active<?php }?> nav-item">
            <a href="vrs">
             <p class="ficon bx bx-radar text-center" style="width: 100%;font-size:40px;color: #fff"></p>
             <p class="menu-title text-center" style="color: #fff;"><b>VRS</b></p>
            </a>
          </li>
          <li class="<?php if($pg=='users'){?> active<?php }?> nav-item">
            <a href="users">
             <p class="ficon bx bx-user-circle text-center" style="width: 100%;font-size:40px;color: #fff"></p>
             <p class="menu-title text-center" style="color: #fff;"><b>Users</b></p>
            </a>
          </li>

        </ul>
      </div>
    </div> -->
    <!-- END: Main Menu-->

     <!-- BEGIN: Main Menu-->
     <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mr-auto"><a class="navbar-brand" href="index.html">
              <div class="brand-logo"><img class="logo" src="app-assets/images/logo.png"/></div>
              <h2 class="brand-text mb-0">Frest</h2></a></li>
          <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
        </ul>
      </div>
      <div class="shadow-bottom"></div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
            <li class="<?php if($pg=='dashboard'){?> active<?php }?> nav-item">
              <a href="dashboard"><i class="ficon bx bx-dashboard"></i><span class="menu-title" data-i18n="Chat">Dashboard</span></a>
            </li>
            <li class="<?php if($pg=='users'){?> active<?php }?> nav-item">
              <a href="users"><i class="ficon bx bx-user-circle"></i><span class="menu-title" data-i18n="Chat">Users</span></a>
            </li>
        </ul>
      </div>
    </div>
    <!-- END: Main Menu--

    