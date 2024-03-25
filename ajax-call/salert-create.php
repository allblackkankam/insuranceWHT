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

      $response='<h6 class="text-danger">Alert for car number '.$c_num.'</h6>
                <hr>
                <form action="" enctype="multipart/form-data" id="form_alert" method="post">
                    <div id="alert_msg"></div>
                     <input type="hidden"  class="form-control" name="a_num" value="'.$c_num.'">
                     <input type="hidden"  class="form-control" name="a_car" value="'.$c_make.'">
                     <input type="hidden"  class="form-control" name="a_model" value="'.$c_model.'">
                    <div class="form-group">
                        <label >Name of contact <span class="text-danger" id="a_nameErr"></span></label>
                        <input type="text" class="form-control" name="a_name">
                    </div>
                    <div class="form-group">
                        <label>Means of contact <span class="text-danger" id="a_meansErr"></span></label>
                        <select class="form-control" name="a_means">
                            <option>Phone</option>
                            <option>Email</option>
                            <option>SMS</option>
                            <option>Whatsapp</option>
                            <option>Others</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label >Alert Message <span class="text-danger" id="a_infoErr"></span></label>
                        <textarea class="form-control" rows="8" name="a_info"></textarea>
                    </div>
                    </div>
                        <button type="submit" class="btn btn-primary" id="send_alert">Send Alert</button>
                        <button type="button" class="btn btn-light-primary editclose" data-dismiss="modal">Close</button>
                </form>';             
        }
      
  echo $response;
    
    
    exit;
      
 ?>
