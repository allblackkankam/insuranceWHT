<!DOCTYPE html>

<html class="loading" lang="en">
  <?php require("templates/head.php") ?>
  <?php include_once("csrf/csrfgeneratetoken.php"); ?>

  <!-- BEGIN: Body-->
 <body class="vertical-layout vertical-menu-modern 1-column  navbar-sticky footer-static  blank-page blank-page light-layout" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
  
   <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-body"><!-- forgot password start -->
          <section id="auth-login" class="row flexbox-container">
            <div class="col-xl-3 m-1">
                <div class="card mb-0">
                    <div class="px-0">
                        <div class="card disable-rounded-right mb-0 h-100 d-flex justify-content-center">
                            <div class="card-header p-2">
                                <div class="card-title">
                                    <h4 class="text-center">Welcome Back</h4>
                                    <hr class="mb-0">
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="p-2">
                                    <form action="" id="login-forms">
                                        <div id="login-err"></div>
                                        <div class="form-group mb-50">
                                            <label class="text-bold-600" for="exampleInputEmail1">Username</label>
                                            <input type="text" class="form-control" id="username" name="u_name" >
                                            <input type="hidden" class="form-control"  name="u_status" >
                                        </div>
                                        <div class="form-group" style="position:relative">
                                            <label class="text-bold-600" for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control visi" id="password" name="u_pass" >
                                            <span toggle=".visi" class="bx bx-show field-icon toggle-password"></span>
                                        </div>
                                        <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                                            <div class="text-left">
                                                <div class="checkbox checkbox-sm">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                    <label class="checkboxsmall" for="exampleCheck1"><small>Keep me logged in</small></label>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <a href="forgot-password" class="card-link"><small>Forgot Password?</small></a>
                                            </div>
                                        </div>
                                        <input type="hidden" name="token" value="<?php echo $_SESSION["csrfToken"]?>"/>	
                                        <button type="submit" class="btn btn-primary glow w-100 position-relative" id="login">Login<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                        
                                    </form>
                                    <hr>
                                        <div class="text-center"><small class="mr-25">Don't have an account?</small><a href="register"><small>Sign up</small></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white ifoot">
            <footer class="footer">
                <p class="clearfix mb-0 text-center" id="copyright">&copy; 
                    <script> document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>  
                    
            </footer>
        </div>
        </section>
        <!-- BEGIN: Footer-->
        <style>
            .ifoot{
                position: absolute;
                bottom: 0;
                width: 100%;
            }
        </style>
            
            <!-- END: Footer-->
        </div>
      </div>
    </div>
    <!-- END: Content-->


    <!-- <div class="sidenav-overlay"></div>
    <div class="drag-target"></div> -->


    <?php require("templates/foot.php") ?>

    <script>
        $(document).ready(function()
        {
            $("body").on("click","#login",function(e)
            {
                e.preventDefault();
                var username=$("#username").val()
                var password=$("#password").val()
                if(username=="" || password==""){

                    $("#login-err").html("<div class='alert alert-danger mb-1'>All fields are required</div>"); 

                }else{

                    $("#login-err"); 
                    $("#login").html("<img style='width:20px;height:20px' src='app-assets/images/sp-loading.gif'/>").prop("disabled",true);
                    var data=$("#login-forms").serialize();
                    $.ajax
                    ({
                        url:"/models/login-mod.php",
                        type:"POST",
                        data:data,
                        success:function(results)
                        {	
                            // $("#login-err").html(results);
                            $("#login").prop("disabled",false);
                            var array={};
                            array = JSON.parse(results);
                            if(array["action"]=="0")
                            {				
                                $("#login-err").html("<div class='alert alert-danger mb-1'>" +array["loginerr"]+"</div>")
                                $("#login").html("Try Again")												
                            }else 
                            if(array["action"]=="1")
                            {
                                
                                window.location.href="dashboard";
                                
                            }else 
                            if(array["action"]=="CSRF")
                            {
                                
                                window.location.href="/errorfiles/400";
                            }
                            
                        }

                    })
                }
            })	
        })		
            
    </script>

    
    
    <!-- END: Page JS-->

  </body>
  <!-- END: Body-->


</html>