

<?php 

include("connection.php");
include("functions.php");
include("auth.php");



$send = 1;
$firstnameErr=$lastnameErr=$usernameErr=$mailErr=$passErr=$re_passErr=$contactErr=$roleErr="";
$firstname=$lastname=$username=$mail=$pass=$re_pass=$contact=$role="";

//var_dump($_POST);
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if($_POST["action"]=="0"){
        
        $firstname =mysqli_real_escape_string($conn,test_input($_POST['first_name']));
        $lastname =mysqli_real_escape_string($conn,test_input($_POST['last_name']));
        $username=mysqli_real_escape_string($conn,test_input($_POST['username']));
        $role =mysqli_real_escape_string($conn,test_input($_POST['user_role']));
        $contact =mysqli_real_escape_string($conn,test_input($_POST['contact']));
        $mail =mysqli_real_escape_string($conn,test_input($_POST['mail']));

        if($_POST["type"]=="new"){
            $pass =mysqli_real_escape_string($conn,test_input($_POST['pass']));
            $re_pass =mysqli_real_escape_string($conn,test_input($_POST['re_pass']));

            if(empty($pass)){
                $passErr = " is required"; //add error to error array
                $send = 0;
            }else{
                if (!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,40}$/i", $pass)) 
                {
                    $passErr = " must contain letters and numbers";
                }
            }
    
            if(empty($re_pass)){
                $re_passErr = " is required"; //add error to error array
                $send = 0;
            }
            
            if($pass != $re_pass){
                $re_passErr = " The two passwords do not match"; //add error to error array
                $send = 0;
            }

            $password=password_hash($pass,PASSWORD_DEFAULT);

            $userid="U";
            for($i=0;$i<12;$i++){
                
                $userid.=mt_rand(0,9);
            }	
                
            $query="SELECT id FROM users WHERE user_id='$userid'";
            $resultChecker=mysqli_query($conn,$query);
        }else{
            $id =mysqli_real_escape_string($conn,test_input($_POST['id']));
        }

    	//ensure that form fields are filled properly
        if(empty( $firstname)){
            $firstnameErr = "  is required"; //add error to error array
            $send = 0;
		}

        if(empty( $lastname)){
            $lastnameErr = "  is required"; //add error to error array
            $send = 0;
		}

		if(empty($username)){
            $usernameErr = "  is required"; //add error to error array
		}else{
			if(!preg_match('/^[a-z\d_]{5,20}$/i',  $username))
            {
                $usernameErr = " At least 5 character long";
                $send = 0;
            }
        }
            
        $duplicate_u_name = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' ");
        $count_duplicate_u_name= mysqli_num_rows($duplicate_u_name);
        
        if($count_duplicate_u_name > 0){
            $usernameErr = " already exist"; 
        }    
        
        if(empty($mail)){
          
        }else{
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) 
            {
                $mailErr = "Invalid email format";
                $send = 0;
            }
        }

        if($_POST["type"]=="new"){
           
        }
        

        if(empty($contact)){
            
        }else{
            if (!preg_match("/^[\+0-9\-\(\)\s]*$/",$contact)) 
            {
                $contactErr = "Invalid phone number";
                $send = 0;			
            }
        }

        
	
        if(empty($role)){
			$roleErr = " is required"; //add error to error array
			$send = 0;
        }

       

		
        $errObject = array("firstname"=>"$firstnameErr","lastname"=>"$lastnameErr","username"=>"$usernameErr","pass"=>"$passErr","re_pass"=>"$re_passErr","contact"=>"$contactErr","mail"=>"$mailErr","role"=>"$roleErr", "action"=>"");
        
	    if($send==1){
            if($_POST["type"]=="new"){
                $query = "INSERT INTO users (firstname,lastname,email,username,password,contact,facility_id,user_id,user_role,date)
                VALUES('$firstname','$lastname','$email','$username','$password','$contact','$center','$userid','$role', NOW());";
                $result = mysqli_query($conn,$query) or die(mysqli_error($conn)); 
            }else{
                $query = "UPDATE users SET firstname='$firstname',lastname='$lastname',email='$email',username='$username',contact='$contact',user_role='$role' WHERE user_id='$id' AND facility_id = '$center';";
                $result = mysqli_query($conn,$query) or die(mysqli_error($conn)); 
            }
            

            if($result){	
                if(mysqli_affected_rows($conn)>0){
                        
                        $errObject["action"]="1";
                        $errObject=json_encode($errObject);
                        echo $errObject;
                    }else{
                        
                        $errObject["action"]="2";
                        $errObject=json_encode($errObject );
                        echo $errObject;
                    }
                    
                }else{
                    $errObject["action"]="2";
                    $errObject=json_encode($errObject);
                    echo $errObject;
                } 
                
            }elseif($send==0){
                $errObject["action"]="0";	
                $errObject=json_encode($errObject);
                echo $errObject;

            }
    }elseif($_POST['action']=='1'){
        $user_id = mysqli_real_escape_string($conn,test_input($_POST['user_id']));
        $pass = 'a12345';
        $password=password_hash($pass,PASSWORD_DEFAULT);
        $query = "UPDATE users SET password='$password' WHERE user_id='$user_id';";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn)); 

    }elseif($_POST['action']=='2'){
        $user_id = mysqli_real_escape_string($conn,test_input($_POST['user_id']));
        $update = mysqli_real_escape_string($conn,test_input($_POST['update']));
        $query = "UPDATE users SET user_status='$update' WHERE user_id='$user_id';";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn)); 
    }        
            

}


?>
