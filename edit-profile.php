

<!DOCTYPE html>

<html class="loading" lang="en">
  <?php 
    require("templates/head.php");
    require("models/auth.php"); 

    $query= "SELECT * FROM administrator WHERE facility_id = '$center';";
    mysqli_multi_query($conn,$query);
    $facility=mysqli_store_result($conn);

    if(mysqli_num_rows($facility)>0){
        $row=mysqli_fetch_assoc($facility);
        $facility_name=$row["facility_name"];		
        $facility_email=$row["email"];
        $facility_contact=$row["facility_contact"];
        $logo=$row["logo"];		
        $facility_address=$row["address"];	
        $facility_location=$row["location"];	

        if(empty($logo)){
            $logo ="picture.png";
        }else{
            $logo=$row["logo"];	
        }
    }

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
                                            <?php if (isRoleAllowed([1])): ?>
                                                <li class="nav-item mb-1">
                                                    <a class="nav-link d-flex align-items-center" id="account-pill-facility" data-toggle="pill"
                                                        href="#account-vertical-facility" aria-expanded="false">
                                                        <i class="bx bx-building"></i>
                                                        <span>Facility Settings</span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            
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
                                                                                <label>Old Username <span class="text-danger" id="oldusernameErr"> </label>
                                                                                <input type="text" class="form-control"  id="oldname" name="oldname" value="">
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
                                                        <div class="tab-pane fade " id="account-vertical-facility" role="tabpanel"
                                                            aria-labelledby="account-pill-password" aria-expanded="false">
                                                            <form id="update_logo">
                                                                <div class="media imgUp" style="background: #fff;padding: 5px 10px;border-radius: 7px;">
                                                                        <div  class="imagePreview rounded mr-75" style="background:url(app-assets/images/<?php echo $logo ?>) no-repeat;background-size:cover;width: 64px;height: 64px;">
                                                                            <!-- <img src="app-assets/images/<?php echo $logo ?>" class="rounded mr-75" alt="logo" height="64" width="64"> -->
                                                                        </div>
                                                                        <div class="media-body mt-25">
                                                                            <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                                                <label for="logo" class="btn btn-sm btn-light-primary ml-50 mb-50 mb-sm-0">
                                                                                <span>Upload logo</span>
                                                                                <input id="logo" type="file" name="logo" hidden="">
                                                                                <input id="action" type="hidden" name="action" value="1">
                                                                                </label>
                                                                                <button class="btn btn-sm btn-light-secondary ml-50" id="save-logo">Update</button>
                                                                            </div>
                                                                            <p class="text-muted ml-1 mt-50"><small>Allowed JPG, GIF or PNG. Max size of 800kB</small> <span class="text-danger" id="logoErr"></p>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                            </form>
                                                            <form id="update_facility">
                                                                
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label>Facility Name <span class="text-danger" id="facilitynameErr"></label>
                                                                            <input type="text" class="form-control" placeholder="Facility Name" value="<?php echo $facility_name ?>" id ="facilityName" name ="facilityName">
                                                                            <input type="hidden" class="form-control" name ="action" value="0" >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label>Phone Number <span class="text-danger" id="facilityphoneErr"></label>
                                                                            <input type="text" class="form-control" placeholder="Phone Number" value="<?php echo $facility_contact ?>" id ="facilityPhone" name ="facilityPhone" >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label>E-mail <span class="text-danger" id="facilityemailErr"></label>
                                                                            <input type="email" class="form-control" placeholder="Email" value="<?php echo $facility_email?>" id ="facilityEmail" name ="facilityEmail">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label>Location <span class="text-danger" id="facilitylocationErr"></label>
                                                                            <input type="text" class="form-control" placeholder="Facility Location" id ="facilityLocation" name ="facilityLocation"  value="<?php echo $facility_location ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label>Address <span class="text-danger" id="addressErr"></label>
                                                                            <textarea type="text" class="form-control" name="facilityAddress" id ="facilityAddress" placeholder="Facility Address"><?php echo $facility_address ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                        <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1" id="update-facility">Save changes</button>
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
            $("body").on("click","#update-details",function(e){
     
                e.preventDefault();
            
                var formdata=$("#update_user").serialize();

                $.ajax({
                    url: "/models/edit-user-mod.php",
                    type: "POST",
                    data:formdata,
                    success:function(results){
                        
                        $("#update-details").html("<img style='width:20px;height:20px' src='app-assets/images/sp-loading.gif'/>").prop("disabled",true);
                        // $("#msg").fadeIn(1000).html(results);
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
                            
                            toastr.success(
                                "Updated Successfully.",
                                "Great!",
                                { positionClass: "toast-bottom-left", containerId: "toast-bottom-left",progressBar: !0,closeButton: !0, }
                            );

                            

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
                if(old_username==""){
                    $("#oldusernameErr").fadeIn().html('Old username is required')
                }else if(username==""){
                    $("#usernameErr").fadeIn().html('New username is required')
                }else if(username===old_username){
                    toastr.error(
                        "You cannot use the same username.",
                        "Error!",
                        { positionClass: "toast-bottom-left", containerId: "toast-bottom-left",progressBar: !0,closeButton: !0, }
                    );
                }else{
                    $.ajax({
                        url: "/models/edit-user-mod.php",
                        type: "POST",
                        data:formdata,
                        success:function(results){
                        
                            $("#change-username").html("<img style='width:20px;height:20px' src='app-assets/images/sp-loading.gif'/>").prop("disabled",true);
                            $("#msg").html(results);
                            var array={};
                            array = JSON.parse(results);
                            if(array["action"]== "0")
                            {               
                                $("#oldusernameErr").fadeIn().html(array["oldname"])
                                $("#usernameErr").fadeIn().html(array["name"])
                                
                                $("#change-username").html("Try Again").prop("disabled",false);
                                                                            
                            }else 
                            if(array["action"]=="1")
                            {
                                
                                toastr.success(
                                    "Updated Successfully__Signing Out.",
                                    "Great!",
                                    { positionClass: "toast-bottom-left", containerId: "toast-bottom-left",progressBar: !0,closeButton: !0, }
                                );

                                // window.location.href="logout";
                                
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
                            //$("#msg2").fadeIn(1000).html(results);
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
                                
                                toastr.success(
                                    "Updated Successfully.",
                                    "Great!",
                                    { positionClass: "toast-bottom-left", containerId: "toast-bottom-left",progressBar: !0,closeButton: !0, }
                                );

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

            $("body").on("click","#update-facility",function(e){
     
                e.preventDefault();
            
                var formdata=$("#update_facility").serialize();

                $.ajax({
                    url: "/models/update-facility-mod.php",
                    type: "POST",
                    data:formdata,
                    success:function(results){
                        
                        $("#update-facility").html("<img style='width:20px;height:20px' src='app-assets/images/sp-loading.gif'/>").prop("disabled",true);
                        // $("#msg").fadeIn(1000).html(results);
                        var array={};
                        array = JSON.parse(results);
                        if(array["action"]== "0")
                        {               
                            $("#logoErr").fadeIn().html(array["logo"])
                            $("#facilitynameErr").fadeIn().html(array["name"])
                            $("#facilityemailErr").fadeIn().html(array["email"])
                            $("#facilitycontactErr").fadeIn().html(array["contact"])
                            $("#facilitylocationErr").fadeIn().html(array["location"])
                            $("#addressErr").fadeIn().html(array["address"])
                            
                            
                            $("#update-facility").html("Try Again").prop("disabled",false);
                                                                        
                        }else 
                        if(array["action"]=="1")
                        {
                            
                            toastr.success(
                                "Updated Successfully.",
                                "Great!",
                                { positionClass: "toast-bottom-left", containerId: "toast-bottom-left",progressBar: !0,closeButton: !0, }
                            );

                            

                            //$("#form_user").trigger("reset");
                            //$("#createmodal").modal("hide");
                            
                            $("#logoErr").fadeIn().html("")
                            $("#facilitynameErr").fadeIn().html("")
                            $("#facilityemailErr").fadeIn().html("")
                            $("#facilitycontactErr").fadeIn().html("")
                            $("#facilitylocationErr").fadeIn().html("")
                            $("#addressErr").fadeIn().html("")
                            
                            
                            $("#update-facility").html("Save Changes").prop("disabled",false);
                        }else if(array["action"]=="2"){
                            $("#update-facility").html("No Changes Made").prop("disabled",false);
                        }
                        if(array["action"]=="CSRF")
                        {
                            
                            window.location.href="/errorfiles/400";
                        }
                            

                    }
                    
                });

            });

            $("body").on("change","#logo", function()
            {
                var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                if (/^image/.test( files[0].type)){ // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file
                    reader.onloadend = function(){ // set image data as background of div
                        //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                        uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
                    }
                }

            });

            $("body").on("click","#save-logo",function(e){
                e.preventDefault();
				$("#save-logo").prop("disabled",true).html("<img style='width:20px;height:20px' src='app-assets/images/sp-loading.gif'/>");
				var forms= document.getElementById("update_logo")
				var formdata = new FormData(forms);					
									
				$.ajax
				({
					url:"/models/update-facility-mod.php",
					type:"POST",
					processData:false,
					contentType:false,
					data:formdata,
					success:function(JSONObject){
						//$("body").html(JSONObject);
						
						$("#save-logo").prop("disabled",false);
						var array={};
						array  = JSON.parse(JSONObject);
						if(array["Action"]=="noupload2")
						{
							
							$("#logoErr").fadeIn().html(array["logo"])
							$("#save-logo").html("Try Again")

						}else if(array["Action"]=="noupload1")
						{
														
                                $("#logoErr").fadeIn().html(array["logo"])
								$("#save-logo").html("Try Again")
							
						}else if(array["Action"]=="noupload")
						{
														
                                $("#logoErr").fadeIn().html(array["logo"])
								$("#save-logo").html("Try Again")
							
						}else
						{
							if(array["Action"]=="upload")
							{
								toastr.success(
                                    "Updated Successfully.",
                                    "Great!",
                                    { positionClass: "toast-bottom-left", containerId: "toast-bottom-left",progressBar: !0,closeButton: !0, }
                                );
								$("#save-logo").html("Update")
							}
						}
					},
					error:function(){
						$("#save-logo").html("Try Again").prop("disabled",false);
						$('#leftbottomfeedback').show().fadeOut(8000).html("Connection lost.Check your network(Internet) and try again");
					}
				})
            });
           
        })	
    </script>
    
    <!-- END: Page JS-->

  </body>
  <!-- END: Body-->

</html>