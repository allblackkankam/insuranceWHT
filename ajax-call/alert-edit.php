
<?php //Load cars

require('../templates/db.php') ;

$carid = 0;
if(isset($_POST['carid'])){
   $carid = mysqli_real_escape_string($conn,$_POST['carid']);
    }
    $select_car = "SELECT * FROM alert WHERE a_id = $carid";
      $select_car_query = mysqli_query($conn,$select_car);
          
      
      while($row=mysqli_fetch_array($select_car_query)){
              $a_id = $row['a_id'];
              $a_name = $row['a_name'];
              $a_means = $row['a_means'];
              $a_num = $row['a_num'];
              $a_car = $row['a_car'];
              $a_model = $row['a_model'];
              $a_info = $row['a_info'];

      $response='<h6 class="text-danger">Alert for car number '.$a_num.'</h6>
                <hr>
                <form action="" enctype="multipart/form-data" id="eform_alert" method="post">
                    <div id="ealert_msg"></div>
                    <input type="hidden"  class="form-control" name="a_id" value="'.$a_id.'">
                     <input type="hidden"  class="form-control" name="a_num" value="'.$a_num.'">
                     <input type="hidden"  class="form-control" name="a_car" value="'.$a_car.'">
                     <input type="hidden"  class="form-control" name="a_model" value="'.$a_model.'">
                    <div class="form-group">
                        <label >Name of contact <span class="text-danger" id="a_enameErr"></span></label>
                        <input type="text" class="form-control" name="a_name" value="'.$a_name.'" >
                    </div>
                    <div class="form-group">
                        <label>Means of contact <span class="text-danger" id="a_emeansErr"></span></label>
                        <select class="form-control" name="a_means">
                            <option>'.$a_means.'</option>
                            <option>Phone</option>
                            <option>Email</option>
                            <option>SMS</option>
                            <option>Whatsapp</option>
                            <option>Others</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label >Alert Message <span class="text-danger" id="a_einfoErr"></span></label>
                        <textarea class="form-control" rows="8" name="a_info">'.$a_info.'</textarea>
                    </div>
                    </div>
                        <button type="submit" class="btn btn-primary" id="edit_alert">Update Alert</button>
                        <button type="button" class="btn btn-light-primary editclose" data-dismiss="modal">Close</button>
                </form>';             
        }
      
  echo $response;
    
    
    exit;
      
 ?>