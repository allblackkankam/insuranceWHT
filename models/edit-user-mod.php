

<?php 

include("connection.php");
include("functions.php");
include("auth.php");



$send = 1;
$firstnameErr=$lastnameErr=$usernameErr=$mailErr=$passErr=$re_passErr=$contactErr=$roleErr=$oldpasswordErr=$oldusernameErr="";
$firstname=$lastname=$username=$mail=$pass=$re_pass=$contact=$role=$oldpassword=$oldusername="";

//var_dump($_POST);
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if($_POST["action"]=="0"){
        $id =mysqli_real_escape_string($conn,test_input($_POST['id']));
        $firstname =mysqli_real_escape_string($conn,test_input($_POST['first_name']));
        $lastname =mysqli_real_escape_string($conn,test_input($_POST['last_name']));
        $contact =mysqli_real_escape_string($conn,test_input($_POST['contact']));
        $mail =mysqli_real_escape_string($conn,test_input($_POST['mail']));

    	//ensure that form fields are filled properly
        if(empty( $firstname)){
            $firstnameErr = "  is required"; //add error to error array
            $send = 0;
		}

        if(empty( $lastname)){
            $lastnameErr = "  is required"; //add error to error array
            $send = 0;
		}

		
        
        if(empty($mail)){
          
        }else{
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) 
            {
                $mailErr = "Invalid email format";
                $send = 0;
            }
        }

        

        if(empty($contact)){
            
        }else{
            if (!preg_match("/^[\+0-9\-\(\)\s]*$/",$contact)) 
            {
                $contactErr = "Invalid phone number";
                $send = 0;			
            }
        }

		
        $errObject = array("firstname"=>"$firstnameErr","lastname"=>"$lastnameErr","contact"=>"$contactErr","mail"=>"$mailErr", "action"=>"");
        
	    if($send==1){
           
            $query = "UPDATE users SET firstname='$firstname',lastname='$lastname',email='$email',contact='$contact' WHERE user_id='$id' AND facility_id = '$center';";
            $result = mysqli_query($conn,$query) or die(mysqli_error($conn)); 
            
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
        $id = mysqli_real_escape_string($conn,test_input($_POST['id']));
        $nameusername =mysqli_real_escape_string($conn,test_input($_POST['username']));
        $oldusername =mysqli_real_escape_string($conn,test_input($_POST['oldname']));


        if(empty($oldusername)){
            $oldusernameErr = "  is required"; //add error to error array
		}else{
           
            $olduserquery="SELECT username FROM users WHERE user_id ='$id' LIMIT 1";  					
			$olduserresult=mysqli_query($conn,$olduserquery)or die(mysqli_error($conn));
			if($olduserresult)
		    {
				$row=mysqli_fetch_assoc($olduserresult);
				$username=$row["username"];
				if($oldusername!==$username)
				{
                    $oldusernameErr = "Current username is incorrect";	
                    $send = 0;		  
				}else
				{
                    $oldusernameErr = "";
                    
				}				
																			
			}
        }

        

        if(empty($nameusername)){
            $usernameErr = "  is required"; //add error to error array
		}else{
			if(!preg_match('/^[a-z\d_]{5,20}$/i',  $nameusername))
            {
                $usernameErr = " At least 5 character long";
                $send = 0;
            }
        }

       
            
        $duplicate_u_name = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' ;");
        $count_duplicate_u_name= mysqli_num_rows($duplicate_u_name);
        
        if($count_duplicate_u_name > 0){
            $usernameErr = " already exist"; 
            $send = 0;
        }    

        $errObject = array("oldname"=>"$oldusernameErr","name"=>"$usernameErr","action"=>"");

        if($send==1){
           
            $query = "UPDATE users SET username='$username' WHERE user_id='$id' AND facility_id = '$center';";
            $result = mysqli_query($conn,$query) or die(mysqli_error($conn)); 
            
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

    }elseif($_POST['action']=='2'){
        $id = mysqli_real_escape_string($conn,test_input($_POST['id']));
        $oldpassword=mysqli_real_escape_string($conn,test_input($_POST['oldpassword']));
        $pass =mysqli_real_escape_string($conn,test_input($_POST['password']));
        $re_pass =mysqli_real_escape_string($conn,test_input($_POST['re_password']));

        if(empty($oldpassword))   
		{  
			$oldpasswordErr="Old password is required";
		}else{
			$passquery="SELECT password FROM users WHERE user_id ='$id' LIMIT 1";  					
			$passresult=mysqli_query($conn,$passquery)or die(mysqli_error($conn));
			if($passresult)
		    {
				$row=mysqli_fetch_assoc($passresult);
				$PinCode=$row["password"];
				if(password_verify($oldpassword,$PinCode))
				{
								  
				}else
				{
					$oldpasswordErr = "Passwords don't match.";
                    $send = 0;
				}				
																			
			}else
			{	$oldpasswordErr = "Enter Old Password Again.";
                $send = 0;
				
			}
			mysqli_free_result($passresult);		
			
		}

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

        $errObject = array("oldpassword"=>"$oldpasswordErr","password"=>"$passErr","repassword"=>"$re_passErr","action"=>"");

        if($send==1){
           
            $query = "UPDATE users SET password='$password' WHERE user_id='$id';";
            $result = mysqli_query($conn,$query) or die(mysqli_error($conn)); 
            
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
        
    }        
            

}


?>
