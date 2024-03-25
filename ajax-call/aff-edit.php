<?php //Load cars

require('../templates/db.php') ;

$carid = 0;
if(isset($_POST['carid'])){
   $carid = mysqli_real_escape_string($conn,$_POST['carid']);
    }
    $car = "SELECT * FROM aff WHERE aff_id= $carid";
    $car_query = mysqli_query($conn,$car);

    $response ='<form action="" enctype="multipart/form-data" id="form_aff_edit">';
    while($row=mysqli_fetch_array($car_query)){
        $aff_id = $row['aff_id'];
        $aff_name = $row['aff_name'];
        $aff_num = $row['aff_num'];
        $aff_mail = $row['aff_mail'];
        $aff_pos= $row['aff_pos'];
        $aff_loc = $row['aff_loc'];
        $date = $row['added'];

        $response .='<div id="msge_aff">
        </div>
    
            <input type="hidden" class="form-control" name="aff_id" value="'.$aff_id.'">
            <div class="row">
              <div class="col-md-4">
                  <fieldset class="form-group">
                  <label>Name <span class="text-danger" id="aff_enameErr"></span></label>
                      <input type="text" class="form-control" name="aff_name" value="'.$aff_name.'">
                  </fieldset>
              </div>
              <div class="col-md-4">
                <fieldset class="form-group">
                    <label>Phone Number <span class="text-danger" id="aff_enumErr"></span></label>
                    <input type="text" class="form-control" name="aff_num" value="'.$aff_num.'">
                </fieldset>
              </div>
              <div class="col-md-4">
                <fieldset class="form-group">
                    <label>Email <span class="text-danger" id="aff_emailErr"></span></label>
                    <input type="email" class="form-control" name="aff_mail" value="'.$aff_mail.'">
                </fieldset>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <fieldset class="form-group">
                    <label>Position <span  class="text-danger" id="aff_eposErr"></span></label>
                    <input type="text" class="form-control" name="aff_pos" value="'.$aff_pos.'">
                </fieldset>
              </div>
              <div class="col-md-6">
                <fieldset class="form-group">
                <label>Location<span class="text-danger" id="aff_elocErr"></span></label>
                    <input type="text" class="form-control" name="aff_loc" value="'.$aff_loc.'">
                </fieldset>
              </div>
            </div>
            <button class="btn btn-primary" id="edit_aff" type="submit">Update</button>
            <button type="button" class="btn btn-light-primary editclose" data-dismiss="modal">Close</button>
            
        ';
            }
$response .= '</form>';

        echo $response;
    
        
    
    exit();
      
 ?>