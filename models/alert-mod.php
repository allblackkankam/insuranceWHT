

<?php 

include "../templates/db.php";

function test_input($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
};

$send = 1;
$a_nameErr=$a_meansErr=$a_infoErr="";
$a_name=$a_means=$a_info="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $a_model =mysqli_real_escape_string($conn,test_input($_POST['a_model']));
    $a_num =mysqli_real_escape_string($conn,test_input($_POST['a_num']));
    $a_car =mysqli_real_escape_string($conn,test_input($_POST['a_car']));
    $a_name =mysqli_real_escape_string($conn,test_input($_POST['a_name']));
    $a_means=mysqli_real_escape_string($conn,test_input($_POST['a_means']));
    $a_info =mysqli_real_escape_string($conn,test_input($_POST['a_info']));


  
    	//ensure that form fields are filled properly
		if(empty($a_name)){
			$a_nameErr = "drivers name is required"; //add error to error array
		}else{
			if(!preg_match('/^[a-zA-Z\s]+$/', $a_name))
				{
					$a_nameErr = "Only letters and white space allowed";
					$send = 0;
				}
			}

	
		if(empty($a_means)){
			$$a_meansErr = " is required"; //add error to error array
			$send = 0;
		}

		if(empty($a_info)){
			$a_infoErr = " is required"; //add error to error array
			$send = 0;
		}

		
		$errObject = array("name"=>"$a_nameErr","means"=>"$a_meansErr","info"=>"$a_infoErr", "action"=>"");
	

	
	if($send==1){
		$query = "INSERT INTO alert (a_name, a_means, a_info, a_car,a_num,a_model,added)
		VALUES('$a_name', '$a_means', '$a_info', '$a_car','$a_num','$a_model', now()) ";

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
