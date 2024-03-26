

<!DOCTYPE html>
<?php ob_start(); ?>
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
    <div class="app-content content">
      <div class="content-overlay"></div>
        <div class="content-wrapper">
           <div class="content-header row">
              <div class="content-header-left col-12 mb-2 mt-1">
                <div class="row breadcrumbs-top">
                  <div class="col-12">
                     <ul class="nav nav-tabs" role="tablist">
                     <li class="nav-item current">
                          <a class="nav-link active editclose" id="home-tab" data-toggle="tab" href="#home" aria-controls="home" role="tab" aria-selected="false">
                            <i class="bx bxs-data align-middle"></i>
                            <span class="align-middle">User List</span>
                          </a>
                        </li>
                        <li class="nav-item ">
                          <a class="nav-link " id="users-tab" data-toggle="tab" href="#users" aria-controls="users" role="tab" aria-selected="true">
                            <i class="bx bx-plus-medical align-middle"></i>
                            <span class="align-middle">Create Users</span>
                            
                          </a>
                        </li>
                        
                      </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="content-body"><!-- Dashboard Ecommerce Starts -->
              <section id="dashboard-ecommerce">
                  
                <div class="tab-content">
                  <div class="tab-pane active" id="home" aria-labelledby="home-tab" role="tabpanel">
                  <h4 class="card-title">User Records</h4>
                  <div class="card">
                    <div class="col-md-12">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table zero-configuration table table-striped">
                              <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Date Added</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <?php Users(); ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  </div>
                  <div class="tab-pane" id="users" aria-labelledby="users-tab" role="tabpanel">
                    <h4 class="card-title">Add User</h4>
                    <div class="card">
                      <div class="col-md-12">
                        <div class="card-content">
                          <div class="card-body">
                          <form action="" enctype="multipart/form-data" id="form_user">
                            <div id="msg"></div>
                            <div class="row">
                              <div class="col-md-6">
                                  <fieldset class="form-group">
                                      <label>User Name<span class="text-danger" id="u_nameErr"></span></label>
                                      <input type="text" class="form-control" name="u_name">
                                      <small>Should be at least 5 characters long</small>
                                  </fieldset>
                              </div>
                              <div class="col-md-6">
                                <fieldset class="form-group">
                                    <label >Email<span class="text-danger" id="u_mailErr"></span></label>
                                    <input type="email" class="form-control" name="u_mail" >
                                </fieldset>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                  <fieldset class="form-group">
                                      <label>Password<span class="text-danger" id="u_passErr"></span></label>
                                      <input type="password" class="form-control visi" name="u_pass" >
                                      <span toggle=".visi" class="bx bx-show field-icon toggle-password"></span>
                                      <small>Password should have letters , numbers and at least 6 characters long.</small>
                                  </fieldset>
                              </div>
                              <div class="col-md-6">
                                <fieldset class="form-group">
                                    <label >Retype-Password<span class="text-danger" id="re_upassErr"></span></label>
                                    <input type="password" class="form-control visi" name="re_upass">
                                </fieldset>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                  <fieldset class="form-group">
                                      <label>Company Name <span class="text-danger" id="u_comErr"></span></label>
                                      <input type="text" class="form-control" name="u_com" >
                                  </fieldset>
                              </div>
                              <div class="col-md-6">
                                <fieldset class="form-group">
                                    <label >Company Number<span class="text-danger" id="u_numErr"></span></label>
                                    <input type="text" class="form-control" name="u_num" >
                                </fieldset>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                  <fieldset class="form-group">
                                      <label>Country<span class="text-danger" id="u_conErr"></span></label>
                                      <select name="u_con" class=" custom-select">
                                          <option >Ghana</option>
                                          <option >Nigeria</option>
                                      </select>
                                  </fieldset>
                              </div>
                              <div class="col-md-6">
                                  <fieldset class="form-group">
                                      <label>Location<span class="text-danger" id="u_locErr"></span></label>
                                      <input type="text" class="form-control" name="u_loc" >
                                  </fieldset>
                              </div>
                            </div>
                            <div class="col-md-12">
                                <label>Company Logo <span class="" id="u_picErr"></span></label>
                                <div  class="ims row" style="margin-bottom: 20px;">
                                    <div class="dz-message col-md-6" style="margin-top: 30px;"> 
                                        <h6>Click to upload image size 500KB</h6>
                                      
                                        <div class="fallback">
                                            <input name="u_pic"  type="file" class="profileDisplay" onchange="displayImage(this)" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                          <div> 
                                            <img src="app-assets/images/picture.png" onclick="triggerClick()"  class="profileImage pic-view" > 
                                        </div>
                                    </div>
                                </div>
                              </div>

                              <button class="btn btn-primary" id="create_user" type="submit">Save</button>
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                </div>
                            
              </section>
              <?php 

                if(isset($_GET['delete'])){
                    $id =  base64_decode($_GET["delete"]);
                    
                    $query = "DELETE FROM users WHERE u_id = $id ";

                    $result = mysqli_query($conn,$query);

                    header('Location:users');
                }

                if(isset($_GET['block'])){
                    $id = base64_decode($_GET["block"]);
                    
                    $query = "UPDATE users SET u_status = 'block' WHERE u_id = $id";

                    $result = mysqli_query($conn,$query);

                    header('Location:users');

                }
                if(isset($_GET["open"])){
                    $id = base64_decode($_GET["open"]);
                    
                    $query = "UPDATE users SET u_status = 'open' WHERE u_id = $id";

                    $result = mysqli_query($conn,$query);

                    header('Location:users');
                } 
                if(isset($_GET["reset"])){
                  $id = base64_decode($_GET["reset"]);
                  
                  $u_pass = "abc123";
                  $password=password_hash($u_pass,PASSWORD_DEFAULT);
                  $query = "UPDATE users SET u_pass='$password' WHERE u_id = $id";

                  $result = mysqli_query($conn,$query);

                  header('Location:users');
              }


              ?>
              <!-- Dashboard Ecommerce ends -->
        </div>
      </div>
    </div>
    <!-- END: Content-->


    <!-- <div class="sidenav-overlay"></div>
    <div class="drag-target"></div> -->

    <?php require("templates/footer.php") ?>

    <?php require("templates/foot.php") ?>

    <?php require("templates/del-modal.php") ?>

    <?php require("templates/cuser-modals.php") ?>

    <script>
 
 //Create Users
 $(document).ready(function(){
   $("body").on("click","#create_user",function(e){
     
     e.preventDefault();
  
     var form = document.getElementById("form_user");
     var data = new FormData(form);

     $.ajax({
           url: "/models/create-user-mod.php",
           type: "POST",
           processData:false,
           contentType:false,
           //dataType:"json",
           data:data,
            success:function(results){
                 $("#create_user").prop("disabled",false);
                 // $("#msg").fadeIn().html(results);
                 var array={};
                 array = JSON.parse(results);
                 if(array["action"]== "0")
                 {               
                     $("#u_nameErr").fadeIn().html(array["u_name"])
                     $("#u_mailErr").fadeIn().html(array["mail"])
                     $("#u_passErr").fadeIn().html(array["pass"])
                     $("#re_upassErr").fadeIn().html(array["re_pass"])
                     $("#u_comErr").fadeIn().html(array["com"])
                     $("#u_numErr").fadeIn().html(array["num"])
                     $("#u_conErr").fadeIn().html(array["con"])
                     $("#u_locErr").fadeIn().html(array["loc"])
                     $("#u_picErr").fadeIn().html(array["pic"])
                  
                     $("#create_user").html("Try Again")
                                                                
                 }else 
                 if(array["action"]=="1")
                 {
                     
                     $("#msg").html('<div class="alert alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>User Created Successfully</span></div>');

                     $("input").val("");
                     
                     

                     $("#u_nameErr").fadeIn().html(" ")
                     $("#u_mailErr").fadeIn().html(" ")
                     $("#u_passErr").fadeIn().html(" ")
                     $("#re_upassErr").fadeIn().html(" ")
                     $("#u_comErr").fadeIn().html(" ")
                     $("#u_numErr").fadeIn().html(" ")
                     $("#u_conErr").fadeIn().html(" ")
                     $("#u_locErr").fadeIn().html(" ")
                     $("#u_picErr").fadeIn().html(" ")
                     
                     
                     $("#create_user").html("Save")
                 }else 
                 if(array["action"]=="CSRF")
                 {
                     
                     window.location.href="/errorfiles/400";
                 }
                 

                 
                
           }
           
       });

   });
 });

 ///Delete Users
 $(document).ready(function(){
      $("body").on("click",".delete",function(){
          var id = $(this).attr('id');
          var del_url = "users?delete="+ id+"";
          $(".delete_it").attr("href", del_url);
          
          $("#user-del").modal("show");
      });
  });

  ///Reset Password
 $(document).ready(function(){
      $("body").on("click",".reset",function(){
          var id = $(this).attr('id');
          var del_url = "users?reset="+ id+"";
          $(".reset_it").attr("href", del_url);
          
          $("#reset").modal("show");
      });
  });
  

  //Edit Users
  $(document).ready(function(){
        $("body").on("click",".u_edit",function(){
          var carid = $(this).attr('id');

          // AJAX request
          $.ajax({
          url: 'ajax-call/user-edit.php',
          type: 'post',
          data: {carid: carid},
          success: function(response){ 
            // Add response in Modal body
            $('.uedit').html(response);

            // Display Modal
            $("#uedit").modal("show");
          }
          });
          
        });
    });

    //Edit Users
 $(document).ready(function(){
   $("body").on("click","#edit_user",function(e){
     
     e.preventDefault();
  
     var form = document.getElementById("form_user_edit");
     var data = new FormData(form);

     $.ajax({
           url: "/models/edit-user-mod.php",
           type: "POST",
           processData:false,
           contentType:false,
           //dataType:"json",
           data:data,
            success:function(results){
                 $("#edit_user").prop("disabled",false);
                //  $("#msge").fadeIn().html(results);
                 var array={};
                 array = JSON.parse(results);
                 if(array["action"]== "0")
                 {               
                     $("#u_enameErr").fadeIn().html(array["u_name"])
                     $("#u_emailErr").fadeIn().html(array["mail"])
                     $("#u_epassErr").fadeIn().html(array["pass"])
                     $("#re_eupassErr").fadeIn().html(array["re_pass"])
                     $("#u_ecomErr").fadeIn().html(array["com"])
                     $("#u_enumErr").fadeIn().html(array["num"])
                     $("#u_econErr").fadeIn().html(array["con"])
                     $("#u_elocErr").fadeIn().html(array["loc"])
                     $("#u_epicErr").fadeIn().html(array["pic"])
                  
                     $("#edit_user").html("Try Again")
                                                                
                 }else 
                 if(array["action"]=="1")
                 {
                     
                     $("#msge").html('<div class="alert alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>User Edit Successfully</span></div>');

                     
                     
                     $("#edit_user").html("Save")
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
                          
                          $("#u_cnameErr").fadeIn().html(array["name"]);
                          
                      
                          $("#profile_name").html("Try Again");
                                                                      
                      }else 
                      if(array["action"]=="1")
                      {
                          
                          $("#msgn").html('<div class="alert alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Username changed Successfully</span></div>');

                          
                          $("#u_cnameErr").html(" ");
                          

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