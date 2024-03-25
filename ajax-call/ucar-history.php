<?php //Load cars

require('../templates/db.php') ;

$car_num = "";
if(isset($_POST['car_num'])){
   $car_num = mysqli_real_escape_string($conn,$_POST['car_num']);
    }
    $car = "SELECT * FROM addcar WHERE c_number = '$car_num'";
    $car_query = mysqli_query($conn,$car);

    $response ='<div>';
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

        $response .='<li class="timeline-items timeline-icon-success active">
        <div class="timeline-time">'.$date.'</div>
        <h6 class="timeline-title">'.$d_name.' - '.$d_num.'</h6>

      </li>';
            }


        echo $response;
    
        
    
    exit;
      
 ?>