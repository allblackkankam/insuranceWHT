

<?php 

include "../templates/db.php";

function test_input($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
};

$send = 1;
$uploadok =1;
$u_nameErr=$u_mailErr=$u_passErr=$re_upassErr=$u_numErr=$u_comErr=$u_conErr=$u_locErr=$u_picErr="";
$u_name=$u_mail=$u_pass=$re_upass=$u_num=$u_com=$u_con=$u_loc=$u_pic="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $u_id =mysqli_real_escape_string($conn,test_input($_POST['u_id']));
    $u_num =mysqli_real_escape_string($conn,test_input($_POST['u_num']));
    $u_mail =mysqli_real_escape_string($conn,test_input($_POST['u_mail']));
    $u_com =mysqli_real_escape_string($conn,test_input($_POST['u_com']));
    $u_con =mysqli_real_escape_string($conn,test_input($_POST['u_con']));
    $u_loc=mysqli_real_escape_string($conn,test_input($_POST['u_loc']));

       
    	//ensure that form fields are filled properly
		
            
        if(empty($u_mail)){
            $u_mailErr = " is required"; //add error to error array
        }else{
            if (!filter_var($u_mail, FILTER_VALIDATE_EMAIL)) 
            {
                $u_mailErr = "Invalid email format";
                $send = 0;
            }
        }

        if(empty($u_num)){
            $u_numErr = " is required"; //add error to error array
            $send = 0;
        }else{
            if (!preg_match("/^[\+0-9\-\(\)\s]*$/",$u_num)) 
            {
                $u_numErr = "Invalid phone number";
                $send = 0;			
            }
        }

		if(empty($u_con)){
			$u_conErr = " is required"; //add error to error array
			$send = 0;
		}

		if(empty($u_loc)){
			$u_locErr = " is required"; //add error to error array
			$send = 0;
        }
        if(empty($u_com)){
			$u_comErr = " is required"; //add error to error array
			$send = 0;
        }
        
        if(empty($_FILES["u_pic"]["name"])){

        }elseif(!empty($_FILES["u_pic"]["name"])){

		
            // Adding Image
            $name=$_FILES["u_pic"]["name"];
            $size=$_FILES["u_pic"]["size"];
            $c_pic_temp=$_FILES["u_pic"]["tmp_name"];
            $type=pathinfo(basename($name),PATHINFO_EXTENSION);
            $uploadok=1;
            $savedname="";
            

            //checking for file type
            if(!preg_match("/^p?jpe?g$/i",$type) && !preg_match("/^gif$/i",$type) && 
            !preg_match("/^(x-)?png$/i",$type ) )
            {
                $u_picErr= "Please submit a jpeg,jpg,gif or png image file.";
                $uploadok=0;
                    
            }
            //check file size
            if($size>500000)
            {
                $u_picErr= "image is too large.Size should be less than 500KB";
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

            if(empty($_FILES["u_pic"]["name"])){
                $c_picErr= "Picture is required ";

            }

        }

		
        $errObject = array("num"=>"$u_numErr","mail"=>"$u_mailErr","con"=>"$u_conErr","com"=>"$u_comErr","loc"=>"$u_locErr","pic"=>"$u_picErr", "action"=>"");
        
        if($uploadok==1){   
            if(!empty($_FILES["u_pic"]["name"])){ 
                $random_number=mt_rand(0,9999999);
                $savedname=time().$random_number.$ext;
                if(move_uploaded_file($c_pic_temp, "../app-assets/images/users/$savedname")){

                    $query = "UPDATE users SET u_mail='$u_mail',u_com='$u_com',u_con='$u_con',u_loc='$u_loc',u_num='$u_num',u_pic='$savedname'
                    WHERE u_id = $u_id ";

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

            }else{
                $query = "UPDATE users SET u_mail='$u_mail',u_com='$u_com',u_con='$u_con',u_loc='$u_loc',u_num='$u_num' WHERE u_id = $u_id ";

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
            }elseif($uploadok==0){
                $errObject["action"]="0";	
                $errObject=json_encode($errObject);
                echo $errObject;

            }
        
        }

	    


?>
