<?php
    $pg = basename(substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],'.'))); // get file name from url and strip extension
?>


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mr-auto"><a class="navbar-brand" href="index.html">
              <div class="brand-logo"><img class="logo" src="../app-assets/images/logo.png"/></div>
              <h2 class="brand-text mb-0">Ziba</h2></a></li>
          <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
        </ul>
      </div>
      <div class="shadow-bottom"></div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
          <li class="<?php if($pg=='dashboard'){?> active<?php }?> nav-item"><a href="dashboard"><i class="ficon bx bxs-dashboard"></i><span class="menu-title" data-i18n="Email">Dashboard</span></a>
          </li>
          <li class="<?php if($pg=='entry'){?> active<?php }?> nav-item"><a href="entry"><i class="ficon bx bxs-add-to-queue"></i><span class="menu-title" data-i18n="Email">Create Entry</span></a>
          </li>
          <li class=" nav-item"><a href="#"><i class="ficon bx bx-cog"></i><span class="menu-title" data-i18n="Invoice">Setup</span></a>
            <ul class="menu-content">
              <li class="<?php if($pg=='insurance-company'){?> active<?php }?>"><a href="insurance-company"><i class="bx bxs-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">Insurance</span></a>
              </li>
            </ul>
          </li>
          <hr>
          <li class="<?php if($pg=='users'){?> active<?php }?> nav-item"><a href="users"><i class="ficon bx bxs-user-pin"></i><span class="menu-title" data-i18n="Email">Users</span></a>
          </li>
        </ul>
      </div>
    </div>
    <!-- END: Main Menu-->

    