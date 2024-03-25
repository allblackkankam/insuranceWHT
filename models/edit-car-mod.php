

<?php 

include "../templates/db.php";

function test_input($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
};

$send = 1;
$uploadok = 1;
$d_nameErr=$d_numberErr=$c_makeErr=$c_numberErr=$c_modelErr=$c_colorErr=$c_picErr="";
$d_name=$d_number=$c_make=$c_number=$c_model=$c_color=$c_pic="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $car_id = test_input($_POST['car_id']);
	$d_name = test_input($_POST['d_name']);
	$d_number = test_input($_POST['d_number']);
	$c_make = test_input($_POST['c_make']);
	$c_number = test_input($_POST['c_number']);
	$c_model = test_input($_POST['c_model']);
	$c_color = test_input($_POST['c_color']);



    $d_name = mysqli_real_escape_string($conn,$d_name);
    $d_number = mysqli_real_escape_string($conn,$d_number);
    $c_make = mysqli_real_escape_string($conn,$c_make);
    $c_number = mysqli_real_escape_string($conn,$c_number);
    $c_model = mysqli_real_escape_string($conn,$c_model);
	$c_color = mysqli_real_escape_string($conn,$c_color);


   
   

    	//ensure that form fields are filled properly
		if(empty($d_name)){
			$d_nameErr = "drivers name is required"; //add error to error array
		}else{
			if(!preg_match('/^[a-zA-Z\s]+$/', $d_name))
				{
					$d_nameErr = "Only letters and white space allowed";
					$send = 0;
				}
			}

		if(empty($d_number)){
			$d_numberErr = "drivers contact number is required"; //add error to error array
			$send = 0;
		}else{
			if (!preg_match("/^[\+0-9\-\(\)\s]*$/",$d_number)) 
			{
				$d_numberErr = "Invalid phone number";
				$send = 0;			
			}
		}

		if(empty($c_make)){
			$c_makeErr = "car make is required"; //add error to error array
			$send = 0;
		}

		if(empty($c_number)){
			$c_numberErr = "car number is required"; //add error to error array
			$send = 0;
		}

		if(empty($c_model)){
			$c_modelErr = "car model is required"; //add error to error array
			$send = 0;
		}

		if(empty($c_color)){
			$c_colorErr = "car color is required"; //add error to error array
			$send = 0;
        }
        
        if(empty($_FILES["c_pic"]["name"])){

        }elseif(!empty($_FILES["c_pic"]["name"])){
            // Adding Image
            $name=$_FILES["c_pic"]["name"];
            $size=$_FILES["c_pic"]["size"];
            $c_pic_temp=$_FILES["c_pic"]["tmp_name"];
            $type=pathinfo(basename($name),PATHINFO_EXTENSION);
            $uploadok=1;
            $savedname="";
            

            //checking for file type
            if(!preg_match("/^p?jpe?g$/i",$type) && !preg_match("/^gif$/i",$type) && 
            !preg_match("/^(x-)?png$/i",$type ) )
            {
                $c_picErr= "Please submit a jpeg,jpg,gif or png image file.";
                $uploadok=0;
                    
            }
            //check file size
            if($size>500000)
            {
                $c_picErr= "image is too large.Size should be less than 500KB";
                $uploadok=0;    
            }
            
            
            //check for uniqueness of file name 
            if(preg_match("/^p?jpe?g$/i",$type))
            {
                $ext=".jpg";
            }elseif(preg_match("/^gif$/i",$type))
            {
                $ext=".gif";
            }elseif(preg_match("/^(x-)?png$/i",$type))
            {
                $ext=".png";
            }else
            {
                $ext=".unknown";
            }
        }
	
		
	
	
		
		
		$errObject = array("name"=>"$d_nameErr","phone"=>"$d_numberErr","make"=>"$c_makeErr","c_num"=>"$c_numberErr","model"=>"$c_makeErr","color"=>"$c_colorErr","img"=>"$c_picErr", "action"=>"");
	

	if($uploadok==1)
	{   
        if(!empty($_FILES["c_pic"]["name"])){
            $random_number=mt_rand(0,9999999);
            $savedname=time().$random_number.$ext;
            
		    if(move_uploaded_file($c_pic_temp, "../app-assets/images/cars/$savedname")){
                
                $query = "UPDATE addcar SET d_name='$d_name', d_number='$d_number', c_make='$c_make', c_number='$c_number',c_model='$c_model',c_color='$c_color',c_pic='$savedname' WHERE car_id= $car_id";
        
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
        }else{
            $query = "UPDATE addcar SET d_name='$d_name', d_number='$d_number', c_make='$c_make', c_number='$c_number',c_model='$c_model',c_color='$c_color' WHERE car_id= $car_id";
        
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

		
    }elseif($uploadok==0){
		$errObject["action"]="0";	
		$errObject=json_encode($errObject);
		echo $errObject;

	}
	
	

}


?>
