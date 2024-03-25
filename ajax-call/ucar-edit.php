<?php //Load cars

require('../templates/db.php') ;

$carid = 0;
if(isset($_POST['carid'])){
   $carid = mysqli_real_escape_string($conn,$_POST['carid']);
    }
    $car = "SELECT * FROM addcar WHERE car_id= $carid";
    $car_query = mysqli_query($conn,$car);

    $response ='<form action="" enctype="multipart/form-data" id="form_edit">';
    while($row=mysqli_fetch_array($car_query)){
        $car_id = $row['car_id'];
        $d_name = $row['d_name'];
        $d_num = $row['d_number'];
        $car_num = $row['c_number'];
        $car_make = $row['c_make'];
        $car_model = $row['c_model'];
        $car_color = $row['c_color'];
        $car_pic = $row['c_pic'];
        $date = $row['date_added'];
        if(empty($car_pic)){
            $car_pic = "car.png";
        }

        $response .='<div id="msge">
        </div>
        <div class="row">
            <input type="hidden" class="form-control" name="car_id" value="'.$car_id.'">
            <div class="col-md-6">
                <fieldset class="form-group">
                    <label>Drivers Name <span class="text-danger" id="ed_nameErr"></span></label>
                    <input type="text" class="form-control" name="d_name"  value="'.$d_name.'">
                </fieldset>
            </div>
            <div class="col-md-6">
            <fieldset class="form-group">
                <label >Divers Phone Number <span class="text-danger" id="ed_numberErr"></span></label>
                <input type="text" class="form-control" name="d_number" value="'.$d_num.'">
            </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <fieldset class="form-group">
                    <label>Vehicle Make <span class="text-danger" id="ec_makeErr"></span></label>
                    <input type="text" class="form-control" name="c_make" value="'.$car_make.'">
                </fieldset>
            </div>
            <div class="col-md-6">
            <fieldset class="form-group">
                <label >Vehicle Number Plate <span class="text-danger" id="ec_numberErr"></span></label>
                <input type="text" class="form-control" name="c_number" value="'.$car_num.'">
            </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <fieldset class="form-group">
                    <label>Vehicle Model <span class="text-danger" id="ec_modelErr"></span></label>
                    <input type="text" class="form-control" name="c_model" value="'.$car_model.'">
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset class="form-group">
                    <label>Vehicle Color <span class="text-danger" id="ec_colorErr"></span></label>
                    <input type="text" class="form-control" name="c_color" value="'.$car_color.'">
                </fieldset>
            </div>
        </div>
        <div class="col-md-12">
            <label>Vehicle Piture <span class="text-danger" id="ec_picErr"></span></label>
            <div  class="ims row" style="margin-bottom: 20px;">
                <div class="dz-message col-md-6" style="margin-top: 30px;"> 
                    <h6>Click to upload image size 500KB</h6>
                    
                    <div class="fallback">
                        <input name="c_pic"  type="file" class="eprofileDisplay" onchange="displayImagee(this)" >
                    </div>
                </div>
                <div class="col-md-6">
                        <div> 
                        <img src="../app-assets/images/cars/'.$car_pic.'" onclick="triggerClicke()"  class="eprofileImage pic-view" > 
                    </div>
                </div>
            </div>
            </div>
            <button class="btn btn-primary" id="edit" type="submit">Update</button>
            <button type="button" class="btn btn-light-primary editclose" data-dismiss="modal"  >Close</button>
            
        ';
            }
$response .= '</form>';

        echo $response;
    
        
    
    exit();
      
 ?>