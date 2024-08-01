

<?php 

include("connection.php");
include("functions.php");
include("auth.php");



// $send = 1;
// $firstnameErr=$lastnameErr=$usernameErr=$mailErr=$passErr=$re_passErr=$contactErr=$roleErr="";


//var_dump($_POST);

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if($_POST["action"]=="0"){
        $service_amt=$drug_amt=$service_adj=$drugs_adj="";
        
        
        $service_amt =mysqli_real_escape_string($conn,test_input($_POST['service_amt']));
        $drugs_amt =mysqli_real_escape_string($conn,test_input($_POST['drugs_amt']));
        $service_adj=mysqli_real_escape_string($conn,test_input($_POST['service_adj']));
        $drugs_adj=mysqli_real_escape_string($conn,test_input($_POST['drugs_adj']));
        $type=mysqli_real_escape_string($conn,test_input($_POST['type']));
        
        $data=$_POST["data"];
        $dataarray = json_decode($data, true);

        $insurance=$dataarray["insurance"];
        $month=$dataarray["monthid"];
		
        // $errObject = array("firstname"=>"$firstnameErr","lastname"=>"$lastnameErr","username"=>"$usernameErr","pass"=>"$passErr","re_pass"=>"$re_passErr","contact"=>"$contactErr","mail"=>"$mailErr","role"=>"$roleErr", "action"=>"");
       
        if($_POST["type"]=="new"){
            $en_type ="0";
            $query = "INSERT INTO entry (facility_id,user_id,entry_id,insurance_code,amount_drugs,amount_services,adjustment_services,adjustment_drugs,type,date)
            VALUES('$center','$user_id','$month','$insurance','$drugs_amt','$service_amt','$service_adj',' $drugs_adj','$en_type', NOW());";
            $result = mysqli_query($conn,$query) or die(mysqli_error($conn)); 
        }else{
            $id =mysqli_real_escape_string($conn,test_input($_POST['id']));
            $query = "UPDATE entry SET amount_drugs='$drugs_amt',amount_services='$service_amt',adjustment_services='$service_adj',adjustment_drugs='$drugs_adj' WHERE id='$id' AND facility_id = '$center';";
            $result = mysqli_query($conn,$query) or die(mysqli_error($conn)); 
        }
        
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
            
        
    }elseif($_POST['action']=='1'){
        $id = mysqli_real_escape_string($conn,test_input($_POST['id']));
        $type = mysqli_real_escape_string($conn,test_input($_POST['type']));

        if($type==0){
            $deleteid = 'entry_id';
        }else{
            $deleteid = 'id';
        }
        $query = "DELETE FROM entry WHERE  $deleteid ='$id';";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn)); 

    }elseif($_POST['action']=='2'){
        $service_paid=$drugs_paid="";
        
        
        $service_paid =mysqli_real_escape_string($conn,test_input($_POST['service_paid']));
        $drugs_paid =mysqli_real_escape_string($conn,test_input($_POST['drugs_paid']));
        $tax_paid =mysqli_real_escape_string($conn,test_input($_POST['tax_paid']));
        $type=mysqli_real_escape_string($conn,test_input($_POST['type']));
        
        $data=$_POST["data"];
        $dataarray = json_decode($data, true);

        $insurance=$dataarray["insurance"];
        $month=$dataarray["monthid"];
		
        // $errObject = array("firstname"=>"$firstnameErr","lastname"=>"$lastnameErr","username"=>"$usernameErr","pass"=>"$passErr","re_pass"=>"$re_passErr","contact"=>"$contactErr","mail"=>"$mailErr","role"=>"$roleErr", "action"=>"");
       
        if($_POST["type"]=="new"){
            $en_type ="1";
            $query = "INSERT INTO entry (facility_id,user_id,entry_id,insurance_code,drugs_paid,services_paid,tax_paid,type,date)
            VALUES('$center','$user_id','$month','$insurance','$drugs_paid','$service_paid','$tax_paid','$en_type', NOW());";
            $result = mysqli_query($conn,$query) or die(mysqli_error($conn)); 
        }else{
            $id =mysqli_real_escape_string($conn,test_input($_POST['id']));
            $query = "UPDATE entry SET drugs_paid='$drugs_paid',services_paid='$service_paid',tax_paid='$tax_paid' WHERE id='$id' AND facility_id = '$center';";
            $result = mysqli_query($conn,$query) or die(mysqli_error($conn)); 
        }
        
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
    }        
}


?>
