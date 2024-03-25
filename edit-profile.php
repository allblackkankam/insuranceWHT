

<!DOCTYPE html>

<html class="loading" lang="en">
  <?php require("templates/head.php") ?>

  <?php require("models/auth.php") ?>

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern 2-columns  navbar-sticky footer-static dark-layout" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  
  <?php require("templates/header.php") ?>
  
  <?php if ($_SESSION['u_role'] == 'user' ){
        require("templates/left-nav.php");
        
      } elseif($_SESSION['u_role'] == 'super') {
        require("templates/a-left-nav.php");
      }else{
        require("templates/super-left-nav.php");
      }
  ?>
   

    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
        <div class="content-wrapper">
           <div class="content-header row">
              <div class="content-header-left col-12 mb-2 mt-1">
                <div class="row breadcrumbs-top">
                  <div class="col-12">
                    <h4 class="card-title">Edit infomation</h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="content-body"><!-- users edit start -->
            <section class="users-edit">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab"
                                        href="#account" aria-controls="account" role="tab" aria-selected="true">
                                        <i class="bx bx-user mr-25"></i><span class="d-none d-sm-block">User Info</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" id="uname-tab" data-toggle="tab"
                                        href="#uname" aria-controls="uname" role="tab" aria-selected="true">
                                        <i class="bx bx-user-circle mr-25"></i><span class="d-none d-sm-block">User Name</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab"
                                        href="#information" aria-controls="information" role="tab" aria-selected="false">
                                        <i class="bx bx-info-circle mr-25"></i><span class="d-none d-sm-block">Change Password</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">
                                    <!-- users edit media object start -->
                                    
                                    <!-- users edit media object ends -->
                                    <!-- users edit account form start -->
                                    <form action="" enctype="multipart/form-data" id="profile_edit">
                                        <div id="msge"></div>
                                        <div class="col-md-12">
                                            <label>Profile  Piture <span class="text-danger" id="u_epicErr"></span></label>
                                            <div  class="ims row" style="margin-bottom: 20px;">
                                                <div class="dz-message col-md-6" style="margin-top: 30px;"> 
                                                    <h6>Click to upload image size 500KB</h6>
                                                
                                                    <div class="fallback">
                                                        <input name="u_pic" type="file" class="profileDisplay" onchange="displayImage(this)" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div> 
                                                        <img src="app-assets/images/users/<?php echo $u_pic ?>" onclick="triggerClick()"  class="profileImage pic-view" > 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <input type="hidden" class="form-control" name="u_id" readonly="" value="<?php echo $u_id ?>"> 
                                            <div class="col-md-6">
                                                <fieldset class="form-group">
                                                    <label >Email <span class="text-danger" id="u_emailErr"></span></label>
                                                    <input type="email" class="form-control" name="u_mail" value="<?php echo $u_mail ?>">
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6">
                                                <fieldset class="form-group">
                                                    <label>Comapany Name <span class="text-danger" id="u_ecomErr"></span></label>
                                                    <input type="text" class="form-control" name="u_com" value="<?php echo $u_com ?>">
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <fieldset class="form-group">
                                                    <label >Comapany Number <span class="text-danger" id="u_enumErr"></span></label>
                                                    <input type="text" class="form-control" name="u_num" value="<?php echo $u_num ?>">
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6">
                                                <fieldset class="form-group">
                                                    <label>Country <span class="text-danger" id="u_econErr"></span></label>
                                                    <select name="u_con" class="form-control">
                                                        <option><?php echo $u_con ?></option>
                                                        <option >Ghana</option>
                                                        <option >Nigeria</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <fieldset class="form-group">
                                                    <label>Location <span class="text-danger" id="u_elocErr"></span></label>
                                                    <input type="text" class="form-control" name="u_loc"value="<?php echo $u_loc ?>" >
                                                </fieldset>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary" id="profile" type="submit">Save Changes</button>
                                    </form>
                                    <!-- users edit account form ends -->
                                </div>
                                <div class="tab-pane fade show" id="uname" aria-labelledby="uname-tab" role="tabpanel">
                                    <!-- users edit Info form start -->
                                    <form action="" enctype="multipart/form-data" id="form_name">
                                      <h5 class="mb-1"><i class="bx bx-link mr-25"></i>Change Username</h5>
                                      <div id="msgn"></div>
                                        <div class="row">
                                                <input class="form-control" type="hidden" name="u_id" value="<?php echo $u_id ?>">
                                            
                                            <div class="form-group col-md-12">
                                                <label>Username <span class="text-danger" id="u_nameErr"></span></label>
                                                <input class="form-control" type="text" name="u_name" value="<?php echo $u_name ?>">
                                            </div>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary glow" id="profile_name">Change</button>
                                           
                                        </div>
                                    </form>
                                    <!-- users edit Info form ends -->
                                </div>
                                <div class="tab-pane fade show" id="information" aria-labelledby="information-tab" role="tabpanel">
                                    <!-- users edit Info form start -->
                                    <form action="" enctype="multipart/form-data" id="form_pass">
                                      <h5 class="mb-1"><i class="bx bx-link mr-25"></i>Change Password</h5>
                                      <div id="msgp"></div>
                                        <div class="row">
                                                <input class="form-control" type="hidden" name="u_id" value="<?php echo $u_id ?>">
                                                <input class="form-control" type="hidden" name="u_rpass" value="<?php echo $u_pass ?>">
                                            <div class="form-group col-md-6">
                                                <label>Current Password <span class="text-danger" id="u_cpassErr"></span></label>
                                                <input class="form-control visi" type="Password" name="u_cpass" id="u_c">
                                                <span toggle=".visi" class=" field-icon toggle-password bx bx-show"></span>
                                                
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>New Password <span class="text-danger" id="u_npassErr"></span></label>
                                                <input class="form-control visi" type="Password" name="u_npass" id="u_n">
                                                <small>Password should have letters , numbers and at least 6 characters long.</smal>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary glow" id="profile_pass">Change Password</button>
                                           
                                        </div>
                                    </form>
                                    <!-- users edit Info form ends -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- users edit ends -->
        </div>
      </div>
    </div>
    <!-- END: Content-->

  
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <?php require("templates/footer.php") ?>


    <?php require("templates/foot.php") ?>

    <script>
        //Edit Users
        $(document).ready(function(){
            $("body").on("click","#profile",function(e){
                
                e.preventDefault();
                // $("#save").parents("#form_add").find(".err").fadeOut(); 
                // $("#save").prop("disabled",true);
                var form = document.getElementById("profile_edit");
                var data = new FormData(form);

            
                
                // console.log(data);

                $.ajax({
                    url: "/models/edit-user-mod.php",
                    type: "POST",
                    processData:false,
                    contentType:false,
                    //dataType:"json",
                    data:data,
                        success:function(results){
                            $("#profile").prop("disabled",false);
                            // $("#msge").fadeIn().html(results);
                            var array={};
                            array = JSON.parse(results);
                            if(array["action"]== "0")
                            {               
                                
                                $("#u_emailErr").fadeIn().html(array["mail"])
                                $("#u_ecomErr").fadeIn().html(array["com"])
                                $("#u_enumErr").fadeIn().html(array["num"])
                                $("#u_econErr").fadeIn().html(array["con"])
                                $("#u_elocErr").fadeIn().html(array["loc"])
                                $("#u_epicErr").fadeIn().html(array["pic"])
                            
                                $("#profile").html("Try Again")
                                                                            
                            }else 
                            if(array["action"]=="1")
                            {
                                
                                $("#msge").html('<div class="alert alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>User Edit Successfully</span></div>');

                                
                                
                                $("#edit_user").html("Save Changes")
                            }else 
                            if(array["action"]=="CSRF")
                            {
                                
                                window.location.href="/errorfiles/400";
                            }
                            

                            
                            
                    }
                    
                });

            });
        });

    //Change password
    $(document).ready(function(){
        $("body").on("click","#profile_pass",function(e){
            
            e.preventDefault();
            // $("#save").parents("#form_add").find(".err").fadeOut(); 
            $("#profile_pass").html("<img style='width:20px;height:20px' src='app-assets/images/sp-loading.gif'/>").prop("disabled",true);
            var form = document.getElementById("form_pass");
            var data = new FormData(form);

        
            
            // console.log(data);

            $.ajax({
                url: "/models/pass-mod.php",
                type: "POST",
                processData:false,
                contentType:false,
                //dataType:"json",
                data:data,
                    success:function(results){
                        $("#profile_pass").prop("disabled",false);
                        // $("#msgp").fadeIn().html(results);
                        var array={};
                        array = JSON.parse(results);
                        if(array["action"]== "0")
                        {               
                            
                            $("#u_cpassErr").fadeIn().html(array["cpass"]);
                            $("#u_npassErr").fadeIn().html(array["npass"]);
                            
                        
                            $("#profile_pass").html("Try Again");
                                                                        
                        }else 
                        if(array["action"]=="1")
                        {
                            
                            $("#msgp").html('<div class="alert alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Password changed Successfully</span></div>');

                            $("#u_c").val("");
                            $("#u_n").val("");
                            
                            $("#u_cpassErr").html(" ");
                            $("#u_npassErr").html(" ");

                            $("#profile_pass").html("Change Password")
                        }else 
                        if(array["action"]=="CSRF")
                        {
                            
                            window.location.href="/errorfiles/400";
                        }

                        
                }
                
            });

        });
    });

    //Change Username
    $(document).ready(function(){
        $("body").on("click","#profile_name",function(e){
            
            e.preventDefault();
            // $("#save").parents("#form_add").find(".err").fadeOut(); 
            $("#profile_name").html("<img style='width:20px;height:20px' src='app-assets/images/sp-loading.gif'/>").prop("disabled",true);
            var form = document.getElementById("form_name");
            var data = new FormData(form);

        
            // console.log(data);

            $.ajax({
                url: "/models/uname-mod.php",
                type: "POST",
                processData:false,
                contentType:false,
                //dataType:"json",
                data:data,
                    success:function(results){
                        $("#profile_name").prop("disabled",false);
                        // $("#msgn").fadeIn().html(results);
                        var array={};
                        array = JSON.parse(results);
                        if(array["action"]== "0"){               
                            
                            $("#u_nameErr").fadeIn().html(array["name"]);
                            
                        
                            $("#profile_name").html("Try Again");
                                                                        
                        }else 
                        if(array["action"]=="1")
                        {
                            
                            $("#msgn").html('<div class="alert alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Username changed Successfully</span></div>');

                            
                            $("#u_nameErr").html(" ");
                           

                            $("#profile_name").html("Change")
                        }else 
                        if(array["action"]=="CSRF")
                        {
                            
                            window.location.href="/errorfiles/400";
                        }

                        
                }
                
            });

        });
    });


    </script>

    
    
    <!-- END: Page JS-->

  </body>
  <!-- END: Body-->


</html>