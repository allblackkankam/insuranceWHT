

<!DOCTYPE html>

<html class="loading" lang="en">
    <?php require("templates/head.php") ;?>

  <!-- BEGIN: Body-->
 <body class="vertical-layout vertical-menu-modern 1-column  navbar-sticky footer-static  blank-page blank-page light-layout" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
  
   <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-body"><!-- forgot password start -->
          <section id="auth-login" class="row flexbox-container">
            <div class="col-xl-4 m-1">
                <div class="card mb-0">
                    <div class="px-0">
                        <div class="card disable-rounded-right mb-0 h-100 d-flex justify-content-center">
                            <div class="card-content">
                                <div class="pt-0 p-2 text-center">
                                    <h4 class="text-center m-2">Welcome</h4>
                                    <p style="font-size:18px">You have successfully signup. You have to verify your account by following the link sent to you by email.<br/> 
    
                                    <div style="margin:20px auto">
                                        <button id="resend" class="btn btn-primary"  >Can't find email Resend?</button>
                                    </div>
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


  </body>
  <!-- END: Body-->


</html>