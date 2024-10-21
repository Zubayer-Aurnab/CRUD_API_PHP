<?php
require '../inc/DB.php';
function getCustomerList()
{
    global $conn;
    $query = 'SELECT * FROM customers';
    $result = mysqli_query($conn, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $response = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' => '= CUSTOMER DATA FOUND',
                'data' => $response
            ];
            header('HTTP/1.0 200  CUSTOMER DATA FOUND');
            return json_encode($data);

        } else {
            $data = [
                'status' => 404,
                'message' => 'NO CUSTOMER DATA FOUND',
            ];
            header('HTTP/1.0 404 NO CUSTOMER DATA FOUND');
            return json_encode($data);
        }

    } else {
        $data = [
            'status' => 401,
            'message' => 'NO cunnectoin with the server',
        ];
        header('HTTP/1.0 401 NO cunnectoin with the server');
        return json_encode($data);
    }

}