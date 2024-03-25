

<?php 

include "../templates/db.php";

function test_input($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
};


$send=1;

$u_cpassErr=$u_npassErr="";
$u_cpass=$u_npass="";

    if($_SERVER["REQUEST_METHOD"]=="POST"){
    $u_id =mysqli_real_escape_string($conn,test_input($_POST['u_id']));
    $u_cpass =mysqli_real_escape_string($conn,test_input($_POST['u_cpass']));
    $u_npass =mysqli_real_escape_string($conn,test_input($_POST['u_npass']));
    $u_pass =mysqli_real_escape_string($conn,test_input($_POST['u_rpass']));
  
    $v_pass = password_verify($u_cpass, $u_pass);
    	//ensure that form fields are filled properly

        if(empty($u_cpass)){
            $u_cpassErr = " is required"; //add error to error array
        }else{
            if($v_pass==0){
                $u_cpassErr = " is invalid";
            }
        }
      
        

        if(empty($u_npass)){
            $u_npassErr = " is required"; //add error to error array
            $send = 0;
        }else{
            if (!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,40}$/i", $u_npass)) 
            {
                $u_npassErr = " must contain letters,numbers and at least 6 characters long";
            }
        }
       
        $password=password_hash($u_npass,PASSWORD_DEFAULT);

        

		
        $errObject = array("cpass"=>"$u_cpassErr","npass"=>"$u_npassErr", "action"=>"");
        
        if($v_pass==1){   
            if($send==1){

            
                $query = "UPDATE users SET u_pass='$password' WHERE u_id = $u_id ";

                $result = mysqli_query($conn,$query); 

                if(!$result){
                    echo "no connection". mysqli_error($conn);
                }
            

                if($result){	
                if(mysqli_affected_rows($conn)>0){
                        
                        $errObject["action"]="1";
                        $errObject=json_encode($errObject);
                        echo $errObject;
                    }
                    else{
                        
                        $errObject["action"]="2";
                        $errObject=json_encode($errObject );
                        echo $errObject;
                    }
                    
                }
                else{
                    $errObject["action"]="2";
                    $errObject=json_encode($errObject);
                    echo $errObject;
                } 

            }
            }elseif($v_pass==0){
                $errObject["action"]="0";	
                $errObject=json_encode($errObject);
                echo $errObject;

            }
        
    }

	    


?>
