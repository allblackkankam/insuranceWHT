

<?php 

include("connection.php");
include("functions.php");
include("auth.php");



$send = 1;
$uploadok=1;
$logoErr=$nameErr=$phoneErr=$emailErr=$locationErr=$addressErr="";
$logo=$name=$phone=$email=$location=$address="";

// var_dump($_POST);
// var_dump($_FILES);
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if($_POST["action"]=="0"){
        // $id =mysqli_real_escape_string($conn,test_input($_POST['id']));
        $name =mysqli_real_escape_string($conn,test_input($_POST['facilityName']));
        $phone =mysqli_real_escape_string($conn,test_input($_POST['facilityPhone']));
        $email =mysqli_real_escape_string($conn,test_input($_POST['facilityEmail']));
        $location =mysqli_real_escape_string($conn,test_input($_POST['facilityLocation']));
        $address =mysqli_real_escape_string($conn,test_input($_POST['facilityAddress']));

    	//ensure that form fields are filled properly
        if(empty( $name)){
            $nameErr = "  is required"; //add error to error array
            $send = 0;
		}

        if(empty( $phone)){
            $phoneErr = "  is required"; //add error to error array
            $send = 0;
		}

		
        
        if(empty($email)){
          
        }else{
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                $emailErr = "Invalid email format";
                $send = 0;
            }
        }

        

        if(empty($contact)){
            $contactErr = "is required";
            $send = 0;	
        }

		
        $errObject = array("name"=>"$nameErr","phone"=>"$phoneErr","email"=>"$emailErr","location"=>"$locationErr","address"=>"$addressErr", "action"=>"");
        
	    if($send==1){
           
            $query = "UPDATE administrator SET facility_name='$name',email='$email',facility_contact='$phone',location='$location',address='$address' WHERE facility_id='$center';";
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
        if(empty($_FILES["logo"]["name"]))
        {
            
            $logoErr="Logo file required";
            $uploadok=0;
            
        }elseif(!empty($_FILES["logo"]["name"]))
        {
            $name=$_FILES["logo"]["name"];
            $size=$_FILES["logo"]["size"];
            $tempname=$_FILES["logo"]["tmp_name"];
            $targetdir="../app-assets/images/";
            $type=pathinfo(basename($name),PATHINFO_EXTENSION);
            $real=getimagesize($tempname);
            
                    
            //checking for fake or non fake image
            if($real==false)
            {
                 $logoErr="Uploaded file is not an image";
                 $uploadok=0;
                 
            }
            //checking for file type
            if(!preg_match("/^p?jpe?g$/i",$type) && !preg_match("/^gif$/i",$type) && 
            !preg_match("/^(x-)?png$/i",$type ) )
            {
                $logoErr= "Please submit a jpeg,jpg,gif or png image file.";
                $uploadok=0;
                    
            }
            //check file size
            if($size>500000)
            {
                $logoErr= "Image is too large.Size should be less than 500KB";
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
            
            $random_number=mt_rand(0,9999999);
            
        }	
        
        $BigArray = array("logo"=>"$logoErr","Action"=>"");
        if($uploadok==1)
        {	
    
            $savedname=time().$random_number.$ext;
            $targetfile=$targetdir.$savedname;
            if(move_uploaded_file($tempname,$targetfile)){
    
                $query="UPDATE administrator SET logo='$savedname' WHERE facility_id='$center'";
                $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
                if($result)
                {
                    if(mysqli_affected_rows($conn)>0)
                    {
                        
                        $BigArray["Action"]="upload";
                        $arrays=json_encode($BigArray );
                        echo $arrays;
                        
                    }else{
                        
                        $BigArray["Action"]="noupload";
                        $arrays=json_encode($BigArray );
                        echo $arrays;
                        
                    }
                
                }else{
                    
                    $BigArray["Action"]="noupload";
                    $arrays=json_encode($BigArray );
                    echo $arrays;
                }
                
                
            }else{
                
                
                $BigArray["Action"]="noupload1";
                $arrays=json_encode($BigArray );
                echo $arrays;
                
                
            }
            
            
                 
        }elseif($uploadok==0)
        {
            $BigArray["Action"]="noupload2";
            $arrays=json_encode($BigArray);
            echo $arrays;
                        
            
        }
        
    }
            

}


?>
