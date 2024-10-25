<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-with");

include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "PUT") {

    $inputValue = json_decode(file_get_contents("php://input"), true);

    if (empty($inputValue)) {
        $updateCustomer = updateCustomer($_POST,$_GET);
    } else {
        $updateCustomer = updateCustomer($inputValue,$_GET);
    }
    echo $updateCustomer;

} else {
    $data = [
        'status' => 405,
        'message' => 'Mthod Not Allowedvzzzzzzzzzzzzzz'
    ];
    header("HTTP/1.0 405 method nto allowed");
    echo json_encode($data);
}
