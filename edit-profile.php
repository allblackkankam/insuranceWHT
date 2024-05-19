

<!DOCTYPE html>

<html class="loading" lang="en">
  <?php 
    require("templates/head.php");
    require("models/auth.php"); 

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
                                                    href="#account-vertical-username" aria-expanded="false">
                                                    <i class="bx bx-user"></i>
                                                    <span>Change Username</span>
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
                                                            <form  id="update_user">
                                                                <div id="msg"></div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>First Name<span class="text-danger" id="firstnameErr"></span></label>
                                                                            <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $firstname?>"> 
                                                                            <input type="hidden" class="form-control" name="action" value="0">
                                                                            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $user_id?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label >Last Name<span class="text-danger" id="lastnameErr"></span></label>
                                                                            <input type="text" class="form-control" name="last_name"  id="last_name" value="<?php echo $lastname?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6 ">
                                                                        <div class="form-group">
                                                                            <label >Email<span class="text-danger" id="mailErr"></span></label>
                                                                            <input type="email" class="form-control" name="mail" id="mail" value="<?php echo $email?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label >Contact <span class="text-danger" id="contactErr"></span></label>
                                                                            <input type="text" class="form-control" name="contact" id="contact" value="<?php echo $contact?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                        <button type="submit" class="btn btn-primary glow" id="update-details">Save changes</button>
                                                                    </div>
                                                                </div>
                            
                                                            </form>
                                                        </div>
                                                        <div class="tab-pane fade " id="account-vertical-username" role="tabpanel"
                                                            aria-labelledby="account-pill-username" aria-expanded="false">
                                                            <form id="update_username">
                                                                <div id="msg1"></div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label>Old Username </label>
                                                                                <input type="text" class="form-control"  id="oldname" value="<?php echo $username?>" readonly>
                                                                                <input type="hidden" class="form-control" name="action" value="1">
                                                                                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $user_id?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label>New Username <span class="text-danger" id="usernameErr"></span></label>
                                                                                <input type="text" name="username" class="form-control" id="username">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                        <button type="submit" class="btn btn-primary glow" id="change-username">Save
                                                                            changes</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="tab-pane fade " id="account-vertical-password" role="tabpanel"
                                                            aria-labelledby="account-pill-password" aria-expanded="false">
                                                            <form id="update_password">
                                                                <div id="msg2"></div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label>Old Password <span class="text-danger" id="oldpasswordErr"></span></label>
                                                                                <input type="password" name="oldpassword" class="form-control visi" required>
                                                                                <span toggle=".visi" class="bx bx-show field-icon toggle-password" style="left: 95%;"></span>
                                                                                <input type="hidden" class="form-control" name="action" value="2">
                                                                                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $user_id?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label>New Password <span class="text-danger" id="passwordErr"></span></label>
                                                                                <input type="password" name="password" class="form-control visi" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label>Retype new Password <span class="text-danger" id="repassErr"></span></label>
                                                                                <input type="password" name="re_password" class="form-control visi" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                        <button type="submit" class="btn btn-primary glow" id="change_password">Save
                                                                            changes</button>
                                                                       
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
            $("body").on("click","#update-details",function(e){
     
                e.preventDefault();
            
                var formdata=$("#update_user").serialize();

                $.ajax({
                    url: "/models/edit-user-mod.php",
                    type: "POST",
                    data:formdata,
                    success:function(results){
                        
                        $("#update-details").html("<img style='width:20px;height:20px' src='app-assets/images/sp-loading.gif'/>").prop("disabled",true);
                        $("#msg").fadeIn(1000).html(results);
                        var array={};
                        array = JSON.parse(results);
                        if(array["action"]== "0")
                        {               
                            $("#firstnameErr").fadeIn().html(array["firstname"])
                            $("#lastnameErr").fadeIn().html(array["lastname"])
                            $("#mailErr").fadeIn().html(array["mail"])
                            $("#contactErr").fadeIn().html(array["contact"])
                            
                            
                            $("#update-details").html("Try Again").prop("disabled",false);
                                                                        
                        }else 
                        if(array["action"]=="1")
                        {
                            
                            $("#msg").fadeIn().fadeOut(10000).html('<div class="alert alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Updated Successfully</span></div>');

                            //$("#form_user").trigger("reset");
                            //$("#createmodal").modal("hide");
                            
                            $("#firstnameErr").fadeIn().html("")
                            $("#lastnameErr").fadeIn().html("")
                            $("#mailErr").fadeIn().html("")
                            $("#contactErr").fadeIn().html("")
                            
                            
                            $("#update-details").html("Save Changes").prop("disabled",false);
                        }else if(array["action"]=="2"){
                            $("#update-details").html("No Changes Made").prop("disabled",false);
                        }
                        if(array["action"]=="CSRF")
                        {
                            
                            window.location.href="/errorfiles/400";
                        }
                            
 
                    }
                    
                });

            });

            $("body").on("click","#change-username",function(e){
     
                e.preventDefault();
            
                var formdata=$("#update_username").serialize();
                var old_username =$("#oldname").val();
                var username =$("#username").val();
                if(username==""){
                    $("#usernameErr").fadeIn().html('New username is required')
                }else if(username===old_username){
                    $("#msg1").fadeIn().html('<div class="alert alert-danger alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>You cannot use the same username</span></div>');
                }else{
                    $.ajax({
                        url: "/models/edit-user-mod.php",
                        type: "POST",
                        data:formdata,
                        success:function(results){
                        
                            $("#change-username").html("<img style='width:20px;height:20px' src='app-assets/images/sp-loading.gif'/>").prop("disabled",true);
                            // $("#msg2").fadeIn(1000).html(results);
                            var array={};
                            array = JSON.parse(results);
                            if(array["action"]== "0")
                            {               
                                $("#oldunernameErr").fadeIn().html(array["oldname"])
                                $("#usernameErr").fadeIn().html(array["name"])
                                
                                
                                $("#change-username").html("Try Again").prop("disabled",false);
                                                                            
                            }else 
                            if(array["action"]=="1")
                            {
                                
                                $("#msg1").fadeIn().fadeOut(10000).html('<div class="alert alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Updated Successfully</span></div>');

                                //window.location.href="";
                                
                                $("#oldunernameErr").fadeIn().html("")
                                $("#usernameErr").fadeIn().html("")
                                
                                
                                $("#change-username").html("Save Changes").prop("disabled",false);
                            }else if(array["action"]=="2"){
                                $("#change-username").html("No Changes Made").prop("disabled",false);
                            }
                            if(array["action"]=="CSRF")
                            {
                                
                                window.location.href="/errorfiles/400";
                            }
                                

                        }
                    
                    });
                }

            });

            $("body").on("click","#change_password",function(e){
     
                e.preventDefault();
            
                var formdata=$("#update_password").serialize();
                
                    $.ajax({
                        url: "/models/edit-user-mod.php",
                        type: "POST",
                        data:formdata,
                        success:function(results){
                        
                            $("#change_password").html("<img style='width:20px;height:20px' src='app-assets/images/sp-loading.gif'/>").prop("disabled",false);
                            $("#msg2").fadeIn(1000).html(results);
                            var array={};
                            array = JSON.parse(results);
                            if(array["action"]== "0")
                            {               
                                $("#oldpasswordErr").fadeIn().html(array["oldpassword"])
                                $("#passwordErr").fadeIn().html(array["password"])
                                $("#repassErr").fadeIn().html(array["repassword"])
                                
                                
                                $("#change_password").html("Try Again").prop("disabled",false);
                                                                            
                            }else 
                            if(array["action"]=="1")
                            {
                                
                                $("#msg2").fadeIn().fadeOut(10000).html('<div class="alert alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Updated Successfully</span></div>');

                                //window.location.href="";
                                
                                $("#oldpasswordErr").fadeIn().html("")
                                $("#passwordErr").fadeIn().html("")
                                
                                
                                $("#change_password").html("Save Changes").prop("disabled",false);
                            }else if(array["action"]=="2"){
                                $("#change_password").html("No Changes Made").prop("disabled",false);
                            }
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