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
                <div class="col-xl-4 col-md-6 col-12 m-5">
                    <div class="card ">
                        <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                            <div class="">
                                <div class="card-title">
                                    <h4 class="text-center mb-2">Sign Up</h4>
                                    <hr class="m-0">
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="text-primary"> Lets get started</p>
                            </div>
                            <div class="card-content">
                                <form id="form_user">
                                    <div id="msg"></div>
                                    <div class="form-group mb-50">
                                        <label>Company Name <span class="text-danger" id="u_comErr"></span></label>
                                        <input type="text" class="form-control" name="u_com" id="u_com">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-50">
                                            <label for="f_name">first name <span class="text-danger" id="f_nameErr"></span></label>
                                            <input type="text" class="form-control" id="f_name" name="f_name">
                                        </div>
                                        <div class="form-group col-md-6 mb-50">
                                            <label for="l_name">last name <span class="text-danger" id="l_nameErr"></span></label>
                                            <input type="text" class="form-control" id="l_name" name="l_name">
                                        </div>
                                    </div>
                                    <div class="form-group mb-50 ">
                                        <label for="eu_name">username <span class="text-danger" id="u_nameErr"></span></label>
                                        <input type="text" class="form-control" name="u_name"  id="u_name">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12 mb-50">
                                            <label>Password<span class="text-danger" id="u_passErr"></span></label>
                                            <input type="password" class="form-control visi" name="u_pass" id="u_upass">
                                            <span toggle=".visi" class="bx bx-show field-icon toggle-password" style="left: 92%;"></span>  
                                            <small class="text-primary">Password should have letters, numbers and at least 6 characters long.</small>
                                        </div>
                                        
                                        <div class="form-group col-md-12 mb-50">
                                            <fieldset class="form-group">
                                                <label >Retype-Password<span class="text-danger" id="re_upassErr"></span></label>
                                                <input type="password" class="form-control visi" name="re_upass" is="re_upass">
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="form-group mb-50">
                                        <fieldset class="form-group">
                                            <label >Email<span class="text-danger" id="u_mailErr"></span></label>
                                            <input type="email" class="form-control" name="u_mail" id="u_mail">
                                        </fieldset>
                                    </div>
                                    
                                    
                                
                                    <div class="form-group mb-50">
                                        <fieldset class="form-group">
                                            <label >Phone Number<span class="text-danger" id="u_numErr"></span></label>
                                            <input type="text" class="form-control" name="u_num" >
                                        </fieldset>
                                    </div>
                                    <button type="submit" class="btn btn-primary glow position-relative w-100" id="create_user">Sign Up<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                </form>
                                <hr>
                                <div class="text-center"><small class="mr-25">Already have an account?</small><a href="/"><small>Sign in</small> </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
            $("body").on("click","#create_user",function(e){
     
                e.preventDefault();
            
                var form = document.getElementById("form_user");
                var data = new FormData(form);

                $.ajax({
                    url: "/models/mod-signup.php",
                    type: "POST",
                    processData:false,
                    contentType:false,
                    //dataType:"json",
                    data:data,
                        success:function(results){
                            $("#create_user").prop("disabled",false);
                            //$("body").html(results);
                            var array={};
                            array = JSON.parse(results);
                            if(array["action"]== "0")
                            {       
                                $("#f_nameErr").fadeIn().html(array["f_name"])        
                                $("#l_nameErr").fadeIn().html(array["l_name"])
                                $("#u_nameErr").fadeIn().html(array["u_name"])
                                $("#u_nameErr").fadeIn().html(array["u_name"])
                                $("#u_mailErr").fadeIn().html(array["mail"])
                                $("#u_passErr").fadeIn().html(array["pass"])
                                $("#re_upassErr").fadeIn().html(array["re_pass"])
                                $("#u_comErr").fadeIn().html(array["com"])
                                $("#u_numErr").fadeIn().html(array["num"])

                            
                                $("#create_user").html("TRY AGAIN")
                                                                            
                            }else 
                            if(array["action"]=="1")
                            {
                                
                                window.location.href= "/success";
                            }else 
                            if(array["action"]=="CSRF")
                            {
                                
                                window.location.href="/errorfiles/400";
                            }
                            

                            
                            
                    }
                    
                });

            });
        })		
            
    </script>

    
    
    <!-- END: Page JS-->

  </body>
  <!-- END: Body-->


</html>