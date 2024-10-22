<?php
error_reporting(0);
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-with");

include('function.php');

$reqMethods = $_SERVER["REQUEST_METHOD"];

if ($reqMethods == 'POST') {

    $inputData = json_decode(file_get_contents('php://input'),true);

   if(empty($inputData)){

   $post_data= postData($_POST);
    
   }
   else{

    $post_data= postData($inputData);
       
   }

} else {

    $data = [
        'status' => 405,
        'message' => 'Method not allowed !',
    ];
    header('HTTP/1.0 405 METHOD NOT ALLOWED ');
    echo json_encode($data);
}