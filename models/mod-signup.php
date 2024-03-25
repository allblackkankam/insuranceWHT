

<?php 

include "connection.php";

function test_input($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
};

$send = 1;
$f_nameErr=$l_nameErr=$u_nameErr=$u_mailErr=$u_passErr=$re_upassErr=$u_numErr=$facilitynameErr="";
$f_name=$l_name=$u_name=$u_mail=$u_pass=$re_upass=$u_num=$facilityname="";

if($_SERVER["REQUEST_METHOD"]=="POST"){

    if(empty($_POST["u_com"]))
    {
        $facilitynameErr = "Name of health center is required.";
        $send=0;         					
    }else
    {
        $facilityname =  mysqli_real_escape_string($conn,test_input($_POST["u_com"]));
        $_SESSION["facilityname"]= $facilityname;    
    }
   
    
  
    //ensure that form fields are filled properly
    if(empty($_POST['f_name'])){
        $f_nameErr = "  is required"; //add error to error array
        $send = 0;
    }else{
        $f_name =mysqli_real_escape_string($conn,test_input($_POST['f_name']));
    }

    if(empty($_POST['l_name'])){
        $l_nameErr = "  is required"; //add error to error array
        $send = 0;
    }else{
        $l_name=mysqli_real_escape_string($conn,test_input($_POST['l_name']));
    }

    if(empty($_POST["u_name"]))
    {
        $u_nameErr = "username is  required";	
        $send=0;			
    }else
    {
        $u_name= mysqli_real_escape_string($conn,test_input($_POST["u_name"])); 
        $u_name=strtolower($u_name);
        if(!preg_match('/^[a-z\d_]{5,}$/i',  $u_name))
        {
            $u_nameErr ="At least 5 character long";
            $u_name="";
            $send=0;
        }
        if($u_name!="")
        {
            $query = "SELECT id FROM users WHERE username ='$u_name'";  
            $result= mysqli_query($conn,$query);
            if($result)
            {
                if(mysqli_num_rows($result)==0)
                {
                    
                }else
                {
                    $u_nameErr= "Sorry username not available.";
                    $send=0;
                        
                }
                            
            }else
            {
                $u_nameErr="Can't connect";
                $send=0;
            } 
            mysqli_free_result($result);
        }
    }	   


    if(empty($_POST['u_mail'])){
        $u_mailErr = " is required"; //add error to error array
    }else{
        $u_mail =mysqli_real_escape_string($conn,test_input($_POST['u_mail']));
        if (!filter_var($u_mail, FILTER_VALIDATE_EMAIL)) 
        {
            $u_mailErr = "Invalid email format";
            $send = 0;
        }else{
            
            $query ="SELECT id FROM administrator WHERE email='$u_mail'";
            $result=mysqli_query($conn,$query);
        
            if($result)
            {
                if(mysqli_num_rows($result)==0)
                {
                    
                }else{
                    
                    $u_mailErr  = "Email Already Exit."; 
                    $send = 0;  
                }
            
            
            }
        
        }
    }

    if(empty($_POST['u_pass'])){
        $u_passErr = " is required"; //add error to error array
        $send = 0;
    }else{
        $u_pass =mysqli_real_escape_string($conn,test_input($_POST['u_pass']));
        $password=password_hash($u_pass,PASSWORD_DEFAULT);
        if (!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,40}$/i", $u_pass)) 
        {
            $u_passErr = " must contain letters and numbers";
            $password="";
        }
    }

    

    if(empty($_POST['re_upass'])){
        $re_upassErr = " is required"; //add error to error array
        $send = 0;
    }else{
        $re_upass =mysqli_real_escape_string($conn,test_input($_POST['re_upass']));
        if($u_pass != $re_upass){
            $re_upassErr = " The two passwords do not match"; //add error to error array
            $send = 0;
        }
    }
        
   

    if(empty($_POST['u_num'])){
        $u_numErr = " is required"; //add error to error array
        $send = 0;
    }else{
        $u_num =mysqli_real_escape_string($conn,test_input($_POST['u_num']));
        if (!preg_match("/^[\+0-9\-\(\)\s]*$/",$u_num)) 
        {
            $u_numErr = "Invalid phone number";
            $send = 0;			
        }
    }

	
        

    do{

            
        $centerid="C";
        for($i=0;$i<12;$i++){
            
            $centerid.=mt_rand(0,9);
        }
        
        $query="SELECT id FROM administrator WHERE facility_id='$centerid'";
        $resultChecker=mysqli_query($conn,$query);
        
    }while(mysqli_num_rows($resultChecker)>0);

    do{

            
        $userid="U";
        for($i=0;$i<12;$i++){
            
            $userid.=mt_rand(0,9);
        }	
            
        $query="SELECT id FROM users WHERE user_id='$userid'";
        $resultChecker=mysqli_query($conn,$query);
        
    }while(mysqli_num_rows($resultChecker)>0);

    $secretKey=time();
    for($i=0;$i<5;$i++){
            
        $secretKey.=mt_rand(0,9);
    }
        

		
    $errObject = array("f_name"=>"$f_nameErr","l_name"=>"$l_nameErr","u_name"=>"$u_nameErr","pass"=>"$u_passErr","re_pass"=>"$re_upassErr","num"=>"$u_numErr","mail"=>"$u_mailErr","com"=>"$facilitynameErr", "action"=>"");
    

    if($send==1){

        $query = "INSERT INTO administrator (facility_name,secretkey,email,facility_id,facility_contact,date)
        VALUES('$facilityname','$secretKey','$u_mail','$centerid','$u_name',NOW());";
        $query .= "INSERT INTO users (firstname,lastname,email,username,password,facility_id,contact,user_id,user_role,date)
        VALUES('$f_name','$l_name','$u_mail','$u_name','$password','$centerid','$u_num','$userid',1, NOW());";

        $result = mysqli_multi_query($conn,$query) or die(mysqli_error($conn)); 
        mysqli_next_result($conn);

        if($result){
            
            if(mysqli_affected_rows($conn)>0){
                    
                    $errObject["action"]="1";
                    $errObject=json_encode($errObject);
                    echo $errObject;

                    $_SESSION["facilityname"]=$facilityname;

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
