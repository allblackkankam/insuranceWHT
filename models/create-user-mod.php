

<?php 

include "connection.php";

function test_input($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
};

$send = 1;
$f_nameErr=$l_nameErr=$u_nameErr=$u_mailErr=$u_passErr=$re_upassErr=$u_numErr=$u_comErr="";
$f_name=$l_name=$u_name=$u_mail=$u_pass=$re_upass=$u_num=$u_com="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $u_com =mysqli_real_escape_string($conn,test_input($_POST['u_com']));
    $f_name =mysqli_real_escape_string($conn,test_input($_POST['f_name']));
    $l_name=mysqli_real_escape_string($conn,test_input($_POST['l_name']));
    $u_name =mysqli_real_escape_string($conn,test_input($_POST['u_name']));
    $u_pass =mysqli_real_escape_string($conn,test_input($_POST['u_pass']));
    $re_upass =mysqli_real_escape_string($conn,test_input($_POST['re_upass']));
    $u_num =mysqli_real_escape_string($conn,test_input($_POST['u_num']));
    $u_mail =mysqli_real_escape_string($conn,test_input($_POST['u_mail']));
    
   

  
    	//ensure that form fields are filled properly
        if(empty( $f_name)){
            $f_nameErr = "  is required"; //add error to error array
            $send = 0;
		}

        if(empty( $l_name)){
            $l_nameErr = "  is required"; //add error to error array
            $send = 0;
		}

		if(empty( $u_name)){
            $u_nameErr = "  is required"; //add error to error array
		}else{
			if(!preg_match('/^[a-z\d_]{5,8}$/i',  $u_name))
            {
                $u_nameErr = " At least 5 character long";
                $send = 0;
            }
        }
            
        $duplicate_u_name = mysqli_query($conn, "SELECT * FROM users WHERE u_name = '$u_name' ");
        $count_duplicate_u_name= mysqli_num_rows($duplicate_u_name);
        
        if($count_duplicate_u_name > 0){
            $u_nameErr = " already exist"; 
        }    
        
        if(empty($u_mail)){
            $u_mailErr = " is required"; //add error to error array
        }else{
            if (!filter_var($u_mail, FILTER_VALIDATE_EMAIL)) 
            {
                $u_mailErr = "Invalid email format";
                $send = 0;
            }
        }

        if(empty($u_pass)){
            $u_passErr = " is required"; //add error to error array
            $send = 0;
        }else{
            if (!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,40}$/i", $u_pass)) 
            {
                $u_passErr = " must contain letters and numbers";
            }
        }

        $password=password_hash($u_pass,PASSWORD_DEFAULT);

        if(empty($re_upass)){
            $re_upassErr = " is required"; //add error to error array
            $send = 0;
        }
        
        if($u_pass != $re_upass){
            $re_upassErr = " The two passwords do not match"; //add error to error array
            $send = 0;
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

	
        if(empty($u_com)){
			$u_comErr = " is required"; //add error to error array
			$send = 0;
        }

        $session_id = mt_rand(0,9999999);
        
        // Adding Image
		// $name=$_FILES["u_pic"]["name"];
		// $size=$_FILES["u_pic"]["size"];
		// $u_pic_temp=$_FILES["u_pic"]["tmp_name"];
		// $type=pathinfo(basename($name),PATHINFO_EXTENSION);
		// $uploadok=1;
		// $savedname="";
		

		// //checking for file type
		// if(!preg_match("/^p?jpe?g$/i",$type) && !preg_match("/^gif$/i",$type) && 
		// !preg_match("/^(x-)?png$/i",$type ) )
		// {
		// 	$u_picErr= "Please submit a jpeg,jpg,gif or png image file.";
		// 	$uploadok=0;
				
		// }
		// //check file size
		// if($size>500000)
		// {
		// 	$u_picErr= "image is too large.Size should be less than 500KB";
		// 	$uploadok=0;    
		// }
		
		
		//check for uniqueness of file name 
		// if(preg_match("/^p?jpe?g$/i",$type))
		// {
		// 	$ext=".jpg";
		// }elseif(preg_match("/^gif$/i",$type))
		// {
		// 	$ext=".gif";
		// }elseif(preg_match("/^(x-)?png$/i",$type))
		// {
		// 	$ext=".png";
		// }else
		// {
		// 	$ext=".unknown";
		// }

		// if(empty($_FILES["u_pic"]["name"])){
		// 	$u_picErr= " ";

        // }

		
        $errObject = array("f_name"=>"$f_nameErr","l_name"=>"$l_nameErr","u_name"=>"$u_nameErr","pass"=>"$u_passErr","re_pass"=>"$re_upassErr","num"=>"$u_numErr","mail"=>"$u_mailErr","com"=>"$u_comErr", "action"=>"");
        
        // if($uploadok==1)
        // {   
        //     $random_number=mt_rand(0,9999999);
        //     $savedname=time().$random_number.$ext;
        //     move_uploaded_file($u_pic_temp, "../app-assets/images/users/$savedname");
        // }

	    if($send==1){
            $query = "INSERT INTO admin (u_name,u_mail,u_pass,u_com,u_num,session_id,datecreated)
            VALUES('$u_name','$u_mail','$password','$u_com','$u_num',$session_id, now()) ";

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
