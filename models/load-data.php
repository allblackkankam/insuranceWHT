

<?php 

include("connection.php");
include("functions.php");
include("auth.php");


if($_SERVER["REQUEST_METHOD"]=="POST"){

    if($_POST['action']=='in'){              
        $query= "SELECT * FROM insurance WHERE facility_id ='$center' AND insurance_status < '2';";
        $select_query = mysqli_query($conn,$query);
        echo'<table class="table zero-configuration table-striped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th width="20%">Action</th>
            </tr>
        </thead>
        <tbody>';
        while($row=mysqli_fetch_array($select_query)){
            $id = $row['id'];
            $insurance_name = $row['insurance_name'];
            $insurance_code = $row['insurance_code'];
            $status = $row['insurance_status'];

            if($status== '1'){
                $text="text-muted";
            }else{
                $text="";
            }
        echo'
          
        
        <tr data-name='.$insurance_name.' data-code='.$insurance_code.'>
            <td class="'.$text.'">'.$insurance_name.'</td>
          
            <td>
                <div class="dropdown">
                    <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item edit" href="javascript:void(0)" ><i class="bx bx-edit-alt mr-1"></i> Edit</a>';
                        if($status==1){
                            echo ' <a class="dropdown-item list" href="javascript:void(0)" data-txt="Delist" data-up="0"><i class="bx bxs-upvote mr-1"></i> List</a>';
                        }else{
                            echo ' <a class="dropdown-item delist" href="javascript:void(0)" data-txt="List" data-up="1"><i class="bx bxs-downvote mr-1"></i> Delist</a>';
                        }
                        
                        echo'<a class="dropdown-item delete text-danger" href="javascript:void(0)" data-txt="Delete" data-up="2"><i class="bx bx-trash mr-1 text-danger"></i> Delete</a>
                    </div>
                </div>
            
            </td>
            
        </tr>
        ';

        }
        echo '</tbody>
        </table>';

    }else if($_POST['action']== 'us'){
        $query= "SELECT * FROM users WHERE facility_id ='$center' AND user_role > '1' AND user_status < '2';";
        $select_query = mysqli_query($conn,$query);
        echo'<table class="table zero-configuration table-striped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Status</th>
                <th>Date Added</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>';
        while($row=mysqli_fetch_array($select_query)){
            $id = $row['id'];
            $user_id = $row['user_id'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $status = $row['user_status'];
            $email = $row['email'];
            $username = $row['username'];
            $role = $row['user_role'];
            $contact = $row['contact'];
            $date=$row['date'];

            if($status== '1'){
                $text="text-muted";
                $statustext="<span class='text-danger'>Blocked</span>";
            }else{
                $text="";
                $statustext="<span class='text-success'>Active</span>";
            }
        echo'
          
        
        <tr class="'.$text.'" data-id='.$user_id.' data-fname='.$firstname.' data-lname='.$lastname.' data-role='.$role.' data-email='.$email.' data-username='.$username.' data-contact='.$contact.'>
            <td >'.$firstname.' '.$lastname.'</td>
            <td >'.$username.'</td>
            <td >'.$email.'</td>
            <td >'.$statustext.'</td>
            <td >'.$date.'</td>
          
            <td>
                <div class="dropdown">
                    <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a id="'.$id.'" class="dropdown-item edit" href="javascript:void(0)" ><i class="bx bx-edit-alt mr-1"></i> Edit</a>';
                        if($status == "1"){
                        echo '<a  class="dropdown-item unblock" href="javascript:void(0)" data-txt="Unblock" data-up="0"><i class="bx bx-check-square mr-1"></i> unblock</a>';
                        }else{
                        echo '<a class="dropdown-item unblock" href="javascript:void(0)" data-txt="Block" data-up="1"><i class="bx bx-block mr-1"></i> block</a>';
                        }
                        
                    echo' <a  class="dropdown-item reset" href="#"><i class="bx bx-reset mr-1"></i> Reset password</a> 
                        <a class="dropdown-item delete text-danger" href="#" data-txt="Delete" data-up="2"><i class="bx bx-trash mr-1 text-danger"></i> Delete</a>
                    </div>
                </div>
            
            </td>
            
        </tr>
        ';

        }
        echo '</tbody>
        </table>';
    }

}

?>

