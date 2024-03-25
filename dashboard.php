

<!DOCTYPE html>

<html class="loading" lang="en">
  <?php require("templates/head.php") ?>

  <?php require("models/auth.php") ?>

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern 2-columns  navbar-sticky footer-static light-layout" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  
  <?php require("templates/header.php") ?>
  
  <?php 

    require("templates/left-nav.php");
      
  ?>
   

    <!-- BEGIN: Content-->
    <?php 
       
        require("templates/admin-dash.php");
      
    ?>
    <!-- END: Content-->


    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <?php require("templates/footer.php") ?>

    <?php require("templates/foot.php") ?>

    <script src="app-assets/js/scripts/dashboard-analytics.min.js"></script>
    
    <!-- END: Page JS-->

  </body>
  <!-- END: Body-->


</html>