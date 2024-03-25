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

              if(empty($c_pic)){
                $c_pic = 'car.png';
            }

      $response='<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="../app-assets/images/cars/'.$c_pic.'" class="car-pic-view img-fluid">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <hr>
    <div class="table-responsive">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>Number plate</td>
            <td>'.$c_num.'</td>
          </tr>
          <tr>
            <td>Make of Vehicle</td>
            <td>'.$c_make.'</td>
          </tr>
          <tr>
            <td>Model</td>
            <td>'.$c_model.'</td>
          </tr>
          <tr>
            <td>Color</td>
            <td>'.$c_color.'</td>
          </tr>
          <tr>
            <td>Vin/Chasis number</td>
            <td> '.$c_vin.'</td>
          </tr>
          <tr>
            <td>Tyres type</td>
            <td> '.$c_tyre.'</td>
          </tr>
          <tr>
            <td>Tyres serial number</td>
            <td> '.$c_tyrenum.'</td>
          </tr>
          <tr>
            <td>Special identification</td>
            <td>'.$c_info.'</td>
          </tr>
          <tr>
            <td>Engine type</td>
            <td>'.$c_engine.'</td>
          </tr>
          <tr>
            <td>Engine number</td>
            <td>'.$c_enginenum.'</td>
          </tr>
          <tr>
            <td>Owner</td>
            <td>'.$o_name.' - '.$o_num.'</td>
          </tr>
          <tr>
            <td>Drivers License</td>
            <td>'.$o_lic.'</td>
          </tr>
          <tr>
            <td>Insurance Company</td>
            <td>'.$i_com.' - '.$i_num.'</td>
          </tr>
          <tr>
            <td>Insurance Type</td>
            <td>'.$i_type.'</td>
          </tr>
        </tbody>
      </table>
    </div>';             
  }
      

   

  echo $response;
    
        
    
    exit;
      
 ?>