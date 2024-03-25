<h4 class="card-title">Vehicle Reported Lost or Stolen</h4>

  <div class="card">
    <div class="col-md-12">
      <div class="card-content">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table zero-configuration table table-striped">
              <thead>
                  <tr>
                      <th>Vehicle</th>
                      <th>Number Plate</th>
                      <th>Model</th>
                      <th>Reporter</th>
                      <th>Means of Contact</th>
                      <th>Date</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
              <?php //Load cars
                  $select_car = "SELECT * FROM alert";
                  $select_car_query = mysqli_query($conn,$select_car);
                      while($row=mysqli_fetch_array($select_car_query)){
                          $a_id = $row['a_id'];
                          $a_name = $row['a_name'];
                          $a_car = $row['a_car'];
                          $a_model = $row['a_model'];
                          $a_num = $row['a_num'];
                          $a_means = $row['a_means'];
                          $date = $row['added'];

                                          
                  echo'<tr>
                          <td>'.$a_car.'</td>
                          <td>'.$a_num.'</td>
                          <td>'.$a_model.'</td>
                          <td>'.$a_name.'</td>
                          <td>'.$a_means.'</td>
                          <td>'.$date.'</td>
                          <td>

                          <div class="dropdown">
                            <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a id="'.$a_num.'" class="dropdown-item view_alert" href="javascript:void(0)"><i class="bx bx-show mr-1"></i>View More</a>
                              <a id="'.$a_id.'" class="dropdown-item a_edit" href="javascript:void(0)" ><i class="bx bx-edit-alt mr-1"></i> Edit</a>
                              <a id="'.base64_encode($a_id).'" class="dropdown-item delete_alert" href="#"><i class="bx bx-trash mr-1"></i> Delete</a>
                            </div>
                          </div>
                          
                          </td>
                          
                      </tr>';

                      }
                  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <?php 
     if(isset($_GET['delete'])){
      $id =base64_decode( $_GET["delete"]);
      
      $query = "DELETE FROM alert WHERE a_id = $id ";

      $result = mysqli_query($conn,$query);

      echo "<script>location='vrs'</script>";
  }

?>
  
  
 