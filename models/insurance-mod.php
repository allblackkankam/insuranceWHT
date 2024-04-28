

<?php 

include("connection.php");
include("functions.php");
include("auth.php");

var_dump($_POST);
if($_SERVER["REQUEST_METHOD"]=="POST"){

    if($_POST['action']=='0'){

        $random_number=mt_rand(0,9999999);

        $insurance_title = mysqli_real_escape_string($conn,test_input($_POST['insurance_name']));
        $query = "INSERT INTO insurance(insurance_name,insurance_code,facility_id,date) VALUES ('$insurance_title','$random_number','$center', NOW() );";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn)); 

    }elseif($_POST['action']=='1'){
        $insurance_title = mysqli_real_escape_string($conn,test_input($_POST['insurance_name']));
        $insurance_code = mysqli_real_escape_string($conn,test_input($_POST['insurance_code']));
       
        $query = "UPDATE insurance SET insurance_name='$insurance_title' WHERE insurance_code='$insurance_code';";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn)); 
    }elseif($_POST['action']=='2'){
        
        $insurance_code = mysqli_real_escape_string($conn,test_input($_POST['insurance_code']));
        $update = mysqli_real_escape_string($conn,test_input($_POST['update']));
        $query = "UPDATE insurance SET insurance_status='$update' WHERE insurance_code='$insurance_code';";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn)); 
    }
    

}else{
    echo 'No connection';
}


	    


?>
