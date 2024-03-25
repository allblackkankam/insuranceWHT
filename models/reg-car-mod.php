

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
$c_numErr=$c_makeErr=$c_modelErr=$c_vinErr=$c_tyreErr=$c_tyrenumErr=$c_engineErr=$c_enginenumErr=$c_colorErr=$c_infoErr=$c_picErr=$o_nameErr=$o_numErr=$o_licErr=$i_comErr=$i_typeErr=$i_numErr="";
$c_num=$c_make=$c_model=$c_vin=$c_tyre=$c_tyrenum=$c_engine=$c_enginenum=$c_color=$c_info=$c_pic=$o_name=$o_num=$o_lic=$i_com=$i_type=$i_num="";

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $c_num =mysqli_real_escape_string($conn,test_input($_POST['c_num']));
    $c_make =mysqli_real_escape_string($conn,test_input($_POST['c_make']));
    $c_model =mysqli_real_escape_string($conn,test_input($_POST['c_model']));
    $c_vin =mysqli_real_escape_string($conn,test_input($_POST['c_vin']));
    $c_tyre = mysqli_real_escape_string($conn,test_input($_POST['c_tyre']));
    $c_tyrenum =mysqli_real_escape_string($conn,test_input($_POST['c_tyrenum']));
    $c_engine = mysqli_real_escape_string($conn,test_input($_POST['c_engine']));
    $c_enginenum = mysqli_real_escape_string($conn,test_input($_POST['c_enginenum']));
    $c_color = mysqli_real_escape_string($conn,test_input($_POST['c_color']));
    $c_info= mysqli_real_escape_string($conn,test_input($_POST['c_info']));
    $o_name = mysqli_real_escape_string($conn,test_input($_POST['o_name']));
    $o_num = mysqli_real_escape_string($conn,test_input($_POST['o_num']));
    $o_lic = mysqli_real_escape_string($conn,test_input($_POST['o_lic']));
    $i_com = mysqli_real_escape_string($conn,test_input($_POST['i_com']));
    $i_type = mysqli_real_escape_string($conn,test_input($_POST['i_type']));
    $i_num = mysqli_real_escape_string($conn,test_input($_POST['i_num']));


    if(empty($c_num)){
        $c_numErr = "car number is required"; //add error to error array
        $send = 0;
    }
    if(empty($c_make)){
        $c_makeErr = "car make is required"; //add error to error array
        $send = 0;
    }
    if(empty($c_model)){
        $c_modelErr = "car model is required"; //add error to error array
        $send = 0;
    }
    if(empty($c_vin)){
        $c_vinErr = "vin is required"; //add error to error array
        $send = 0;
    }
    if(empty($c_tyre)){
        $c_tyreErr = " is required"; //add error to error array
        $send = 0;
    }
    if(empty($c_tyrenum)){
        $c_tyrenumErr = " is required"; //add error to error array
        $send = 0;
    }
    if(empty($c_engine)){
        $c_engineErr = "car engine type is required"; //add error to error array
        $send = 0;
    }
    if(empty($c_enginenum)){
        $c_enginenumErr = "car engine number is required"; //add error to error array
        $send = 0;
    }
    if(empty($c_color)){
        $c_colorErr = "color is required"; //add error to error array
        $send = 0;
    }
    if(empty($c_info)){
        $c_infoErr = "info is required"; //add error to error array
        $send = 0;
    }

    //ensure that form fields are filled properly
    if(empty($o_name)){
        $o_nameErr = " is required"; //add error to error array
    }else{
    if(!preg_match('/^[a-zA-Z\s]+$/', $o_name))
        {
            $o_nameErr = "Only letters and white space allowed";
            $send = 0;
        }
    }

    if(empty($o_num)){
        $o_numErr = " number is required"; //add error to error array
        $send = 0;
    }else{
        if (!preg_match("/^[\+0-9\-\(\)\s]*$/",$o_num)) 
        {
            $o_numErr = "Invalid phone number";
            $send = 0;			
        }
    }

    if(empty($o_lic)){
        $o_licErr = "drivers licence is required"; //add error to error array
        $send = 0;
    }

    if(empty($i_com)){
        $i_comErr = " is required"; //add error to error array
        $send = 0;
    }

    if(empty($i_type)){
        $i_typeErr = " is required"; //add error to error array
        $send = 0;
    }

    if(empty($i_num)){
        $i_numErr = " number is required"; //add error to error array
        $send = 0;
    }else{
        if (!preg_match("/^[\+0-9\-\(\)\s]*$/",$i_num)) 
        {
            $i_numErr = "Invalid phone number";
            $send = 0;			
        }
    }

		
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

		if(empty($_FILES["c_pic"]["name"])){
			$c_picErr= "Picture is required ";

        }
	
	
		
		
		$errObject = array("c_num"=>"$c_numErr","make"=>"$c_makeErr","model"=> "$c_modelErr","vin"=> "$c_vinErr","tyre"=>"$c_tyreErr","tyrenum"=>"$c_tyrenumErr","engine"=> "$c_engineErr","enginenum"=>"$c_enginenumErr","color"=>"$c_colorErr", "info"=>"$c_infoErr","pic"=>"$c_picErr","o_name"=>"$o_nameErr","o_num"=>"$o_numErr","o_lic"=>"$o_licErr","i_com"=>"$i_comErr","i_type"=>"$i_typeErr","i_num"=>"$i_numErr", "action"=>"");
	

	if($uploadok==1)
	{   
		$random_number=mt_rand(0,9999999);
		$savedname=time().$random_number.$ext;
		move_uploaded_file($c_pic_temp, "../app-assets/images/cars/$savedname");
	}

	if($send==1){
		$query = "INSERT INTO carreg (c_num, c_make , c_model, c_vin, c_tyre,c_tyrenum,c_engine,c_enginenum,c_color,c_info,o_name,o_num,o_lic,i_com,i_type,i_num,c_pic,added)
		VALUES('$c_num','$c_make','$c_model','$c_vin','$c_tyre','$c_tyrenum','$c_engine','$c_enginenum','$c_color','$c_info','$o_name','$o_num','$o_lic','$i_com','$i_type','$i_num','$savedname', now()) ";

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
	elseif($send==0){
		$errObject["action"]="0";	
		$errObject=json_encode($errObject);
		echo $errObject;

	}
	
	

}


?>
