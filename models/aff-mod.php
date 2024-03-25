

<?php 

include "../templates/db.php";

function test_input($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
};

$send = 1;
$aff_nameErr=$aff_numErr=$aff_mailErr=$aff_posErr=$aff_locErr="";
$aff_name=$aff_num=$aff_mail=$aff_pos=$aff_loc="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $aff_name =mysqli_real_escape_string($conn,test_input($_POST['aff_name']));
    $aff_num =mysqli_real_escape_string($conn,test_input($_POST['aff_num']));
    $aff_mail =mysqli_real_escape_string($conn,test_input($_POST['aff_mail']));
    $aff_pos =mysqli_real_escape_string($conn,test_input($_POST['aff_pos']));
    $aff_loc=mysqli_real_escape_string($conn,test_input($_POST['aff_loc']));

  
    	//ensure that form fields are filled properly
		if(empty( $aff_name)){
            $aff_nameErr = "  is required"; //add error to error array
		}else{
			if(!preg_match('/^[a-zA-Z\s]+$/',  $aff_name))
				{
					$ $aff_nameErr = "Only letters and white space allowed";
					$send = 0;
				}
			}

        if(empty($aff_num)){
            $aff_numErr = " is required"; //add error to error array
            $send = 0;
        }else{
            if (!preg_match("/^[\+0-9\-\(\)\s]*$/",$aff_num)) 
            {
                $aff_numErr = "Invalid phone number";
                $send = 0;			
            }
        }

        if(empty($aff_mail)){
            $aff_mailErr = " is required"; //add error to error array
        }else{
            if (!filter_var($aff_mail, FILTER_VALIDATE_EMAIL)) 
            {
                $aff_mailErr = "Invalid email format";
                $send = 0;
            }
        }
	
		if(empty($aff_pos)){
			$aff_posErr = " is required"; //add error to error array
			$send = 0;
		}

		if(empty($aff_loc)){
			$aff_locErr = " is required"; //add error to error array
			$send = 0;
		}

		
		$errObject = array("name"=>"$aff_nameErr","num"=>"$aff_numErr","mail"=>"$aff_mailErr","pos"=>"$aff_posErr","loc"=>"$aff_locErr", "action"=>"");
	

	
	if($send==1){
		$query = "INSERT INTO aff (aff_name, aff_num, aff_mail, aff_pos,aff_loc,added)
		VALUES('$aff_name', '$aff_num', '$aff_mail', '$aff_pos','$aff_loc', now()) ";

		$result = mysqli_query($conn,$query); 

		
	

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
	elseif($send==0){
		$errObject["action"]="0";	
		$errObject=json_encode($errObject);
		echo $errObject;

	}
	
	

}


?>
