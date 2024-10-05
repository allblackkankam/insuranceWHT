<?php
    session_start();
    $username=$_SESSION["username"]; 	
    if(!$username){
        
        header("location:/");
        
    }

  

    if(isset($_SESSION['username'])){
    $user_id = $_SESSION['id'];
    $use_role =$_SESSION['user_role'];
  
    $query = "SELECT * FROM users WHERE id = $user_id ";
    $select_user_items = mysqli_query($conn, $query);

        while($row=mysqli_fetch_array($select_user_items)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];
            $contact = $row['contact'];
            $center = $row['facility_id'];
            $user_pic = $row['user_pic'];
            $password = $row['password'];
            if (empty($u_pic)) {
                $user_pic = "avatar1.png";
            }
        }
    }

?>
