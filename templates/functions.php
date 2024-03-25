<?php 
    function LoadScars(){
        global $conn;
                    
        $select_car = "SELECT * FROM carreg";
        $select_car_query = mysqli_query($conn,$select_car);
            while($row=mysqli_fetch_array($select_car_query)){
                $c_id = $row['c_id'];
                $c_num = $row['c_num'];
                $c_make = $row['c_make'];
                $c_model = $row['c_model'];
                $o_name = $row['o_name'];
                $o_num = $row['o_num'];
                $date = $row['added'];

                                
        echo'<tr>
                <td>'.$o_name.'</td>
                <td>'.$o_num.'</td>
                <td>'.$c_num.'</td>
                <td>'.$c_make.'</td>
                <td>'.$c_model.'</td>
                <td>'.$date.'</td>
                <td>

                <div class="dropdown">
                  <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a id="'.$c_id.'" class="dropdown-item view" href="javascript:void(0)"><i class="bx bx-show mr-1"></i>View More</a>
                    <a id="'.$c_id.'" class="dropdown-item c_alert" href="javascript:void(0)" ><i class="bx bxs-error mr-1"></i>Alert</a>
                    <a id="'.$c_id.'" class="dropdown-item edit" href="javascript:void(0)" ><i class="bx bx-edit-alt mr-1"></i> Edit</a>
                    <a id="'.base64_encode($c_id).'" class="dropdown-item delete" href="#"><i class="bx bx-trash mr-1"></i> Delete</a>
                  </div>
                </div>
                
                </td>
                
            </tr>';

            }
    
    }

    function Affs(){
      global $conn;
                  
      $aff = "SELECT * FROM aff";
      $query = mysqli_query($conn,$aff);
          while($row=mysqli_fetch_array($query)){
              $aff_id = $row['aff_id'];
              $aff_num = $row['aff_num'];
              $aff_name = $row['aff_name'];
              $aff_mail = $row['aff_mail'];
              $aff_pos = $row['aff_pos'];
              $aff_loc = $row['aff_loc'];
              $date = $row['added'];

                              
      echo'<tr>
              <td>'.$aff_name.'</td>
              <td>'.$aff_num.'</td>
              <td>'.$aff_mail.'</td>
              <td>'.$aff_pos.'</td>
              <td>'.$aff_loc.'</td>
              <td>'.$date.'</td>
              <td>

              <div class="dropdown">
                <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                <div class="dropdown-menu dropdown-menu-right">
                  <a id="'.$aff_id.'" class="dropdown-item aff_edit" href="javascript:void(0)" ><i class="bx bx-edit-alt mr-1"></i> Edit</a>
                  <a id="'.base64_encode($aff_id).'" class="dropdown-item delete" href="#"><i class="bx bx-trash mr-1"></i> Delete</a>
                </div>
              </div>
              
              </td>
              
          </tr>';

          }
  
  }

  function Users(){
    global $conn;
                
    $user = "SELECT * FROM users";
    $query = mysqli_query($conn,$user);
        while($row=mysqli_fetch_array($query)){
            $id = $row['id'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];
            $centerid = $row['facility_id'];
            $username = $row['username'];
            $user_pic = $row['user_pic'];
            $user_status = $row['user_status'];
            $date = $row['date'];

                            
    echo'<tr>
            <td>'.$firstname.' '.' '.$lastname.'</td>
            <td>'.$username.'</td>
            <td>'.$email.'</td>
            <td>'.$user_status.'</td>
            <td>'.$date.'</td>
            <td>

            <div class="dropdown">
              <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
              <div class="dropdown-menu dropdown-menu-right">
                <a id="'.$id.'" class="dropdown-item u_edit" href="javascript:void(0)" ><i class="bx bx-edit-alt mr-1"></i> Edit</a>';
                if($user_status == "block"){
                  echo '<a  class="dropdown-item" href="users?open='.base64_encode($id).'" ><i class="bx bx-check-square mr-1"></i> unblock</a>';
                }else{
                  echo '<a class="dropdown-item" href="users?block='.base64_encode($id).'" ><i class="bx bx-block mr-1"></i> block</a>';
                }
                
            echo' <a id="'.base64_encode($id).'" class="dropdown-item reset" href="#"><i class="bx bx-reset mr-1"></i> Reset password</a> 
                  <a id="'.base64_encode($id).'" class="dropdown-item delete" href="#"><i class="bx bx-trash mr-1"></i> Delete</a>
              </div>
            </div>
            
            </td>
            
        </tr>';

        }

}

?>