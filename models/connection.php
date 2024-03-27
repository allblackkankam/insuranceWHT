<?php 

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "insurancedb";

foreach($db as $key => $value){
    define(strtoupper($key), $value);
}

$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
// if(!$connection){
// die("we are not connected" . mysqli_error($connection));
// }else{
// echo "we are connected";
//  }

 ?>