
<div class="table-responsive">
    <table class="table zero-configuration table table-striped">
        <thead>
            <tr>
                <th>Driver</th>
                <th>Phone Number</th>
                <th>Vehicle</th>
                <th>Number Plate</th>
                <th>Action</th>
            </tr>
        </thead>
            <tbody id="cars">
            <?php 
                
                $select_car = "SELECT * FROM addcar WHERE user_id = $session_id";
                $select_car_query = mysqli_query($conn,$select_car);
                    while($row=mysqli_fetch_array($select_car_query)){
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

                                        
                echo'<tr>
                        <td>'.$d_name.'</td>
                        <td>'.$d_num.'</td>
                        <td>'.$car_make.'</td>
                        <td>'.$car_num.'</td>
                        
                        <td>
                        <div class="dropdown">
                            <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                            <div class="dropdown-menu dropdown-menu-right">
                            <a id="'.$car_id.'" class="dropdown-item view" href="javascript:void(0)"><i class="bx bx-show mr-1"></i>View More</a>
                            <a car_num="'.$car_num.'" class="dropdown-item history" href="javascript:void(0)"><i class="bx bx-history mr-1"></i>History</a>
                            <a id="'.$car_id.'" class="dropdown-item edit" href="javascript:void(0)" ><i class="bx bx-edit-alt mr-1"></i> edit</a>
                            <a rel="'.base64_encode($car_id).'" class="dropdown-item delete" href="javascript:void(0)"><i class="bx bx-trash mr-1"></i> delete</a>
                            </div>
                        </div>
                        </td>
                        
                    </tr>';

                    }


            ?>
            </tbody>
        </table>
    </div>
    
    
