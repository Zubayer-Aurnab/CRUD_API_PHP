<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-with");

include('function.php');

$reqMethods = $_SERVER["REQUEST_METHOD"];

if ($reqMethods == 'GET') {

    if(isset($_GET['id'])){
        $customer = getSingleCustomer($_GET);
        echo $customer;
    }else{
        $customerList = getCustomerList();
        echo $customerList;
    };

  

} else {
    $data = [
        'status' => 405,
        'message' =>  'Method not allowed',
    ];
    header('HTTP/1.0 405 METHOD NOT ALLOWED ');
    echo json_encode($data);
}