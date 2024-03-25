

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
$u_nameErr="";
$u_name="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $u_id =mysqli_real_escape_string($conn,test_input($_POST['u_id']));
    $u_name =mysqli_real_escape_string($conn,test_input($_POST['u_name']));

		
        //ensure that form fields are filled properly
		if(empty( $u_name)){
            $u_nameErr = "  is required"; //add error to error array
		}else{
			if(!preg_match('/^[a-z\d_]{5,8}$/i',  $u_name))
				{
					$u_nameErr = " at least 5 character long";
					$send = 0;
				}
            }
            
        $duplicate_u_name = mysqli_query($conn, "SELECT * FROM users WHERE u_name = '$u_name' ");
        $count_duplicate_u_name= mysqli_num_rows($duplicate_u_name);
        
        if($count_duplicate_u_name > 0){
            $u_nameErr = " already exist"; 
            $send = 0;
        }    

		
        $errObject = array("name"=>"$u_nameErr", "action"=>"");
        
        if($send==1){
                $query = "UPDATE users SET u_name='$u_name' WHERE u_id = $u_id ";

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
                
            }elseif($send==0){
                $errObject["action"]="0";	
                $errObject=json_encode($errObject);
                echo $errObject;

            }
        
        }

	    


?>
