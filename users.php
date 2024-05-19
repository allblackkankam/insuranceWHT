

<!DOCTYPE html>

<html class="loading" lang="en">
  <?php 
    require("templates/head.php");
    require("models/auth.php"); 

   ?>
 
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
                <div class="card-header">
                    <h4 class="card-title font-weight-bolder text-uppercase">Users</h4>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                        
                        <li class="ml-2"><button class="btn btn-primary create">Create User</button></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="card-content">
                    <div class="card-body">
                      <div id="load-data">

                      </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="modal fade text-left" id="createmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Create User</h3>
                    <button type="button" class="close rounded-pill editclose" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" enctype="multipart/form-data" id="form_user">
                        <div id="msg"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name<span class="text-danger" id="firstnameErr"></span></label>
                                    <input type="text" class="form-control" name="first_name" id="first_name">
                                    <input type="hidden" class="form-control" name="action" value="0">
                                    <input type="hidden" class="form-control" name="type" id="type">
                                    <input type="hidden" class="form-control" name="id" id="id">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Last Name<span class="text-danger" id="lastnameErr"></span></label>
                                    <input type="text" class="form-control" name="last_name"  id="last_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Name<span class="text-danger" id="usernameErr"></span></label>
                                    <input type="text" class="form-control" name="username" id="username">
                                    <small>Should be at least 5 characters long</small>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label >Email<span class="text-danger" id="mailErr"></span></label>
                                    <input type="email" class="form-control" name="mail" id="mail" >
                                </div>
                            </div>
                            <div class="col-md-6 passremoved">
                                <div class="form-group">
                                    <label>Password<span class="text-danger" id="passErr"></span></label>
                                    <input type="password" class="form-control visi" name="pass" >
                                    <span toggle=".visi" class="bx bx-show field-icon toggle-password" style="left: 89%"></span>
                                    <small>Password should have letters , numbers and at least 6 characters long.</small>
                                </div>
                            </div>
                            <div class="col-md-6 passremoved">
                                <div class="form-group ">
                                    <label >Retype-Password<span class="text-danger" id="re_passErr"></span></label>
                                    <input type="password" class="form-control visi" name="re_pass">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Contact <span class="text-danger" id="contactErr"></span></label>
                                    <input type="text" class="form-control" name="contact" id="contact">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Role <span class="text-danger" id="roleErr"></span></label>
                                    <select name="user_role" id="user_role" class="form-control">
                                        <option value="">Select role</option>
                                        <option value="2">Admin</option>
                                        <option value="3">Claims Officer </option>
                                        <option value="4">Clerk</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" class="btn btn-primary ml-1" id="create_user" >
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Save</span>
                    </button>
                </div>
            </div>
            
        </div>
    </div>

    <?php 
      require("templates/footer.php"); 
      require("templates/foot.php"); 
    ?>

    <script>

       $(document).ready(function()
       {
            let loadData=function(){

                $.ajax
                ({
                    url:"/models/load-data.php",	
                    type:"POST",
                    data:{"action":"us"},
                    success:function(data)
                    {	
                        $('#load-data').html(data);  
                        $(".zero-configuration").DataTable();
                    }	
                })
                

            }

            loadData();

            $("body").on("click",".create",function(){

                $("#createmodal").modal({
                    show:true,
                    keyboard:true
                })

                $(".passremoved").show();
                $("#type").val('new');
                $("#form_user").trigger("reset");

            

            })

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
                       
                        $("#create_user").html("<img style='width:20px;height:20px' src='app-assets/images/sp-loading.gif'/>").prop("disabled",true);
                        //$("#msg").fadeIn(1000).html(results);
                        var array={};
                        array = JSON.parse(results);
                        if(array["action"]== "0")
                        {               
                            $("#firstnameErr").fadeIn().html(array["firstname"])
                            $("#lastnameErr").fadeIn().html(array["lastname"])
                            $("#usernameErr").fadeIn().html(array["username"])
                            $("#mailErr").fadeIn().html(array["mail"])
                            $("#passErr").fadeIn().html(array["pass"])
                            $("#re_passErr").fadeIn().html(array["re_pass"])
                            $("#roleErr").fadeIn().html(array["role"])
                            $("#contactErr").fadeIn().html(array["contact"])
                           
                            
                            $("#create_user").html("Try Again").prop("disabled",false);
                                                                        
                        }else 
                        if(array["action"]=="1")
                        {
                            
                            $("#msg").fadeIn().fadeOut(10000).html('<div class="alert alert-success alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Added Successfully</span></div>');

                            $("#form_user").trigger("reset");
                            //$("#createmodal").modal("hide");
                            
                            loadData();

                            $("#firstnameErr").fadeIn().html("")
                            $("#lastnameErr").fadeIn().html("")
                            $("#usernameErr").fadeIn().html("")
                            $("#mailErr").fadeIn().html("")
                            $("#passErr").fadeIn().html("")
                            $("#re_passErr").fadeIn().html("")
                            $("#roleErr").fadeIn().html("")
                            $("#contactErr").fadeIn().html("")
                            
                            
                            $("#create_user").html("Save").prop("disabled",false);
                        }else 
                        if(array["action"]=="CSRF")
                        {
                            
                            window.location.href="/errorfiles/400";
                        }
                            

                            
                            
                    }
                    
                });

            });

            $('body').on('click','.block ,.delete ,.unblock',function()
            {   
                
                var code=$(this).parents("tr").attr("data-id");
                var txt=$(this).attr("data-txt");
                var up=$(this).attr("data-up");
    
                swal({
                    title: txt+ " Alert",
                    text: "Are you sure you want to do this",
                    icon: "warning",
                    buttons: true,
                    html: true,
                }).then((willRoute) => {
                    if (willRoute) {
                        $.ajax({
                            url: "models/create-user-mod.php",
                            type: "POST",
                            data: { "user_id": code, "action": "2","update":up },
                            success: function(JSONObject) {
                                // window.location.href = "";
                                //$("body").html(JSONObject);
                                loadData();
                            }
                        })

                    }
                })
                
            })

            $('body').on('click','.reset',function()
            {   
                
                var code=$(this).parents("tr").attr("data-id");
                var txt=$(this).attr("data-txt");
                var up=$(this).attr("data-up");
    
                swal({
                    title: "Reset Password",
                    text: "Password would be changed to a12345",
                    icon: "warning",
                    buttons: true,
                    html: true,
                }).then((willRoute) => {
                    if (willRoute) {
                        $.ajax({
                            url: "models/create-user-mod.php",
                            type: "POST",
                            data: { "user_id": code, "action": "1" },
                            success: function(JSONObject) {
                                // window.location.href = "";
                                //$("body").html(JSONObject);
                                swal({
                                    title: "Reset Password Successfull",
                                    text: "Password changed to a12345",
                                    icon: "success",
                                    html: true,
                                })
                                loadData();
                            }
                        })

                    }
                })
                
            })

            $('body').on('click','.edit',function()
            {   
                $("#form_user").trigger("reset");
                var code=$(this).parents("tr").attr("data-id");
                var txt="Edit User";
                
                $("#createmodal").modal("show");
                $(".passremoved").hide()

                var firstname=$(this).parents("tr").attr("data-fname")
                var lastname=$(this).parents("tr").attr("data-lname")
                var email=$(this).parents("tr").attr("data-email")
                var username=$(this).parents("tr").attr("data-username")
                var contact=$(this).parents("tr").attr("data-contact")
                var role=$(this).parents("tr").attr("data-role")

                
                $("#first_name").val(firstname);
                $("#last_name").val(lastname);
                $("#username").val(username);
                $("#mail").val(email);
                $("#contact").val(contact);
                $("#user_role").val(role);
                $("#id").val(code);

                $("#type").val('update');

                
            })


        })	
    </script>
    
    <!-- END: Page JS-->

  </body>
  <!-- END: Body-->

</html>