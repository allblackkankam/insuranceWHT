<?php //Load cars

require('../templates/db.php') ;

$carid = 0;
if(isset($_POST['carid'])){
   $carid = mysqli_real_escape_string($conn,$_POST['carid']);
    }
    $select_car = "SELECT * FROM carreg WHERE c_id = $carid";
      $select_car_query = mysqli_query($conn,$select_car);
          
      
      while($row=mysqli_fetch_array($select_car_query)){
              $c_id = $row['c_id'];
              $c_num = $row['c_num'];
              $c_make = $row['c_make'];
              $c_model = $row['c_model'];
              $c_vin = $row['c_vin'];
              $c_tyre = $row['c_tyre'];
              $c_tyrenum = $row['c_tyrenum'];
              $c_engine = $row['c_engine'];
              $c_enginenum = $row['c_enginenum'];
              $c_color = $row['c_color'];
              $c_pic = $row['c_pic'];
              $c_info = $row['c_info'];
              $o_name = $row['o_name'];
              $o_num = $row['o_num'];
              $o_lic = $row['o_lic'];
              $i_com = $row['i_com'];
              $i_type = $row['i_type'];
              $i_num = $row['i_num'];
              $date = $row['added'];

      $response='<form action="" enctype="multipart/form-data" id="form_edit" method="post">
                    <div id="emsg"></div>
                    
                        <h4 class="card-title">Vehicle info</h4>
                        <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" class="form-control" name="c_id" value="'.$c_id.'">
                            <fieldset class="form-group">
                                <label>Number plate <span class="text-danger" id="c_enumErr"></span></label>
                                <input type="text" class="form-control" name="c_num" value="'.$c_num.'">
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label >Make of vehicle <span class="text-danger" id="c_emakeErr"></span></label>
                                <input type="text" class="form-control" name="c_make" value="'.$c_make.'">
                            </fieldset>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label>Model <span class="text-danger" id="c_emodelErr"></span></label>
                                <input type="text" class="form-control" name="c_model" value="'.$c_model.'">
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label >Vin/Chasis number <span class="text-danger" id="c_evinErr"></span></label>
                                <input type="text" class="form-control" name="c_vin" value="'.$c_vin.'">
                            </fieldset>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label>Tyres type <span class="text-danger" id="c_etyreErr"></span></label>
                                <input type="text" class="form-control" name="c_tyre" value="'.$c_tyre.'" >
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label >Tyres serial number <span class="text-danger" id="c_etyrenumErr"></span></label>
                                <input type="text" class="form-control" name="c_tyrenum" value="'.$c_tyrenum.'">
                            </fieldset>
                        </div>
                        
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label>Engine Type <span class="text-danger" id="c_eengineErr"></span></label>
                                <input type="text" class="form-control" name="c_engine" value="'.$c_engine.'">
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label>Engine Number <span class="text-danger" id="c_eenginenumErr"></span></label>
                                <input type="text" class="form-control" name="c_enginenum" value="'.$c_enginenum.'">
                            </fieldset>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label>Vehicle Color <span class="text-danger" id="c_ecolorErr"></span></label>
                                <input type="text" class="form-control" name="c_color" value="'.$c_color.'">
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label>Special Identification <span class="text-danger" id="c_einfoErr"></span></label>
                                <textarea type="text" class="form-control" name="c_info" rows="2">'.$c_info.'</textarea>
                            </fieldset>
                        </div>
                        </div>
                        <div class="col-md-12">
                        <label>Vehicle Piture <span class="text-danger" id="c_epicErr"></span></label>
                        <div  class="ims row" style="margin-bottom: 20px;">
                            <div class="dz-message col-md-6" style="margin-top: 30px;"> 
                                <h6>Click to upload image size 500KB</h6>
                                
                                <div class="fallback">
                                    <input name="c_pic"  type="file" class="profileDisplay" onchange="displayImagee(this)" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div> 
                                    <img src="../app-assets/images/cars/'.$c_pic.'" onclick="triggerClicke()"  class="profileImage pic-view" > 
                                </div>
                            </div>
                        </div>
                        </div>
                        <h4 class="card-title">Owners info</h4>
                        <div class="row">
                        <div class="col-md-4">
                            <fieldset class="form-group">
                                <label>Name <span class="text-danger" id="o_enameErr"></span></label>
                                <input type="text" class="form-control" name="o_name"  value="'.$o_name.'">
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="form-group">
                                <label>Phone Number <span class="text-danger" id="o_numErr"></span></label>
                                <input type="text" class="form-control" name="o_num"  value="'.$o_num.'">
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="form-group">
                                <label>Drivers License <span class="text-danger" id="o_licErr"></span></label>
                                <input type="text" class="form-control" name="o_lic"  value="'.$o_lic.'">
                            </fieldset>
                        </div>

                        </div>
                        <h4 class="card-title">Insurance info</h4>
                        <div class="row">
                        <div class="col-md-4">
                            <fieldset class="form-group">
                                <label>Insurance Company <span class="text-danger" id="i_comErr"></span></label>
                                <input type="text" class="form-control" name="i_com"  value="'.$i_com.'">
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="form-group">
                                <label>Insurance Type <span class="text-danger" id="i_typeErr"></span></label>
                                <input type="text" class="form-control" name="i_type"  value="'.$i_type.'">
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="form-group">
                                <label>Insurance Contact <span class="text-danger" id="i_numErr"></span></label>
                                <input type="text" class="form-control" name="i_num"  value="'.$i_num.'">
                            </fieldset>
                        </div>

                        </div>
                        <hr>
                        <button class="btn btn-primary" id="edit" type="submit">Update</button>
                        <button type="button" class="btn btn-light-primary editclose" data-dismiss="modal">Close</button>
                    </form>';             
  }
      
  echo $response;
    
    
    exit;
      
 ?>