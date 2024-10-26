<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-with");

include('function.php');

$reqMethods = $_SERVER['REQUEST_METHOD'];

if ($reqMethods == 'DELETE') {

    if (isset($_GET['id'])) {

        $delete = deleteCustomer($_GET['id']);
        echo $delete;
    } else {
        $data =
            [
                'status' => 401,
                'message' => 'ID Required'
            ];
        header('HTTP/1.0 401 ID Required');
        echo json_encode($data);
    }
} else {
    $data =
        [
            'status' => 401,
            'message' => 'Method Not Allowed'
        ];
    header('HTTP/1.0 401 Method Not Allowed');
    echo json_encode($data);
};
