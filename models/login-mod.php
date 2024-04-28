<?php

	session_start();
	include "connection.php";
    $username="";
	$password="";   
	$whatAction="";
	$loginErr="";
	//var_dump($_POST);
	function test_input($data)
	{
		$data = trim($data);
	    $data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{   
		
		if(empty($_POST["u_pass"]) || empty($_POST["u_name"]))
		{	
			$loginErr="All fields are required";		
			$whatAction="0";
			
		}elseif(!empty($_POST["u_pass"]) && !empty($_POST["u_name"])){
			
			$password = mysqli_real_escape_string($conn,test_input($_POST["u_pass"])); 
			
	        $username = mysqli_real_escape_string($conn,test_input($_POST["u_name"]));
			
			$username=strtolower($username);
			
			$query ="SELECT * FROM users WHERE username ='$username'";
			
			$result= mysqli_query($conn,$query);
			if($result){
				if(mysqli_num_rows($result)==1){
					
					$row=mysqli_fetch_assoc($result);
					$passwordDb=$row["password"];
					$status =$row["user_status"];
                    $_SESSION["id"]=$row["id"];
                    $_SESSION["user_role"]=$row["user_role"];
					$_SESSION["username"]=$row["username"];
					$_SESSION["username"]=$username; 						
					//$_SESSION["screenlock"]="1";
					if(password_verify($password,$passwordDb) and $status=="0" ){  
						$whatAction="1"; 							
					}elseif(password_verify($password,$passwordDb) and $status=="1" ){
						$loginErr="Account Restricted .";
						$whatAction="0";
					}else{				  
						$loginErr= "Invalid Password or Username.";			
						$whatAction="0";
					
					}
					
				}else{
					
					$loginErr= "Invalid Password or Username.";			
					$whatAction="0";
				}
				
			}else
			{
				$loginErr="Problem Logging In.Try again";					
				$whatAction="0";
			}
			
			include_once("../csrf/csrfchecktoken.php");//dont move above any $whatAction keep it here;
			mysqli_free_result($result);
			mysqli_close($conn);
			
		}

		
		
		$errObject = array("loginerr"=>"$loginErr","action"=>"$whatAction");
		$errObject=json_encode($errObject);
		echo $errObject;
	}  	   
?>