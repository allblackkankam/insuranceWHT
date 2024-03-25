<?php //Load cars

require('../templates/db.php') ;

$carid = 0;
if(isset($_POST['carid'])){
   $carid = mysqli_real_escape_string($conn,$_POST['carid']);
    }
    
    $car = "SELECT * FROM addcar WHERE car_id= $carid";
    $car_query = mysqli_query($conn,$car);

    $response ='<div style="text-align:center">';
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
            $car_pic = 'car.png';
        }

        $response .='<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="../app-assets/images/cars/'.$car_pic.'" class="car-pic-view img-fluid">
        </div>
      </div>
          <hr>
        <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                  <td>Drivers Name</td>
                  <td>' .$d_name.'</td>
                </tr>
                <tr>
                  <td>Drivers Number</td>
                  <td>'.$d_num.' </td>
                </tr>
                <tr>
                  <td>Car Make</td>
                  <td>'.$car_make.'</td>
                </tr>
                <tr>
                  <td>Car Number</td>
                  <td> '.$car_num.'</td>
                </tr>
                <tr>
                  <td>Car Model</td>
                  <td>'.$car_model.'</td>
                </tr>
                <tr>
                  <td>Car Color</td>
                  <td>'.$car_color.'</td>
                </tr>
                <tr>
                  <td>Date Added</td>
                  <td>'.$date.'</td>
                </tr>
              </tbody>
            </table>';
            }
$response .= '</div>';

        echo $response;
    
        
    
    exit;
      
 ?>
