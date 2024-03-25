
<?php //Load cars

require('../templates/db.php') ;

$carid = 0;
if(isset($_POST['carid'])){
   $carid = mysqli_real_escape_string($conn,$_POST['carid']);
    }
    $select_car = "SELECT * FROM users WHERE u_id = $carid";
      $select_car_query = mysqli_query($conn,$select_car);
          
      
      while($row=mysqli_fetch_array($select_car_query)){
              $u_id = $row['u_id'];
              $u_name = $row['u_name'];
              $u_com = $row['u_com'];
              $u_num = $row['u_num'];
              $u_con = $row['u_con'];
              $u_pass = $row['u_pass'];
              $u_mail = $row['u_mail'];
              $u_loc = $row['u_loc'];
              $u_pic = $row['u_pic'];
              if(empty($u_pic)){
                  $u_pic = 'picture.png';
              }
        

      $response='<form action="" enctype="multipart/form-data" id="form_name">
                    <h5 class="mb-1"><i class="bx bx-link mr-25"></i>Change Username</h5>
                    <div id="msgn"></div>
                        <div class="row">
                                <input class="form-control" type="hidden" name="u_id"  value="'.$u_id.'">
                            
                            <div class="form-group col-md-12">
                                <label>Username <span class="text-danger" id="u_cnameErr"></span></label>
                                <input class="form-control" type="text" name="u_name" value=" '.$u_name.'">
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary glow" id="profile_name">Change</button>
                        
                        </div>
                    </form>
                    <hr>
      
      
                    <form action="" enctype="multipart/form-data" id="form_user_edit">
                    <div id="msge"></div>
                    <input type="hidden" class="form-control" name="u_id" value="'.$u_id.'" readonly="">

                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label >Email<span class="text-danger" id="u_emailErr"></span></label>
                                <input type="email" class="form-control" name="u_mail" value="'.$u_mail.'">
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label>Comapany Name <span class="text-danger" id="u_ecomErr"></span></label>
                                <input type="text" class="form-control" name="u_com" value="'.$u_com.'">
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label >Comapany Number<span class="text-danger" id="u_enumErr"></span></label>
                                <input type="text" class="form-control" name="u_num" value="'.$u_num.'">
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label>Country<span class="text-danger" id="u_econErr"></span></label>
                                <select name="u_con" class="form-control">
                                    <option>'.$u_con.'</option>
                                    <option >Ghana</option>
                                    <option >Nigeria</option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label>Location<span class="text-danger" id="u_elocErr"></span></label>
                                <input type="text" class="form-control" name="u_loc" value="'.$u_loc.'" >
                            </fieldset>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Comapany Logo <span class="" id="u_epicErr"></span></label>
                        <div  class="ims row" style="margin-bottom: 20px;">
                            <div class="dz-message col-md-6" style="margin-top: 30px;"> 
                                <h6>Click to upload image size 500KB</h6>
                                
                                <div class="fallback">
                                    <input name="u_pic" type="file" class="eprofileDisplay" onchange="displayImagee(this)" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div> 
                                    <img src="../app-assets/images/users/'.$u_pic.'" onclick="triggerClicke()"  class="eprofileImage pic-view" > 
                                </div>
                            </div>
                        </div>
                        </div>

                        <button class="btn btn-primary" id="edit_user" type="submit">Save</button>
                        <a href="#" class="btn btn-light-primary editclose" data-dismiss="modal">Close</a>
                    </form>';             
        }
      
  echo $response;
    
    
    exit;
      
 ?>