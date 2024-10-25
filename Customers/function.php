<?php
require '../inc/DB.php';

// common error function for the input fields
function error422($message)
{
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header('HTTP/1.0 401 NO cunnectoin with the server');
    echo json_encode($data);
};


// updat the customer data to the DB
function updateCustomer($inputs, $params)
{
    global $conn;

    if (!isset($params)) {
        return error422('id is required for this action');
    };
    //get all the input field
    $name = mysqli_real_escape_string($conn, $inputs['name']);
    $email = mysqli_real_escape_string($conn, $inputs['email']);
    $phone = mysqli_real_escape_string($conn, $inputs['phone']);
    $id = mysqli_real_escape_string($conn, $params['id']);

    //validation
    if (empty(trim($name))) {

        return error422('Enter name');
    } elseif (empty(trim($email))) {

        return error422('Enter email');
    } elseif (empty(trim($phone))) {

        return error422('Enter phone');
    } elseif (empty(trim($id))) {
        return error422('Enter id');
    }

    $query = "UPDATE customers SET name='$name',email='$email',phone='$phone' WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);


    if ($result) {

        $data = [
            'status' => 200,
            'message' => 'Customer Updated Successfully'
        ];
        header('HTTP/1.0 200 customer Updated');
        return json_encode($data);
    } else {
        $data = [
            'status' => 500,
            'message' => 'INTERNAL SERVER ERROR'
        ];
        header('HTTP/1.0 500 INTERNAL SERVER ERROR');
        return json_encode($data);
    }
};


//get single customer data from the database
function getSingleCustomer($id)
{
    global $conn;
    if (empty($id)) {

        return error422('Enter Id');
    }

    $customerId = mysqli_real_escape_string($conn, $id['id']);
    $query = "SELECT * FROM customers WHERE id = '$customerId' LIMIT 1 ";
    $result = mysqli_query($conn, $query);


    if (mysqli_num_rows($result) > 0) {
        $res = mysqli_fetch_assoc($result);
        $data = [
            'status' => 200,
            'message' => 'Data Find Successfully',
            'data' => $res
        ];
        header('HTTP/1.0 200 Data Find Successfully');
        return json_encode($data);
    } else {
        $data = [
            'status' => 404,
            'message' => 'No Customer Found',
        ];
        header('HTTP/1.0 401 No Customer Found');
        return json_encode($data);
    }
};

// fucntoin for post data to the data-base
function postData($customerInput)
{
    global $conn;

    $name =  mysqli_real_escape_string($conn, $customerInput['name']);
    $email =  mysqli_real_escape_string($conn, $customerInput['email']);
    $phone =  mysqli_real_escape_string($conn, $customerInput['phone']);

    //validation
    if (empty(trim($name))) {

        return error422('Enter name');
    } elseif (empty(trim($email))) {

        return error422('Enter email');
    } elseif (empty(trim($phone))) {

        return error422('Enter phone');
    };

    // the query for inser a data to the database
    $query = "INSERT INTO customers (name,email,phone) VALUES('$name','$email','$phone')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = [
            'status' => 201,
            'message' => 'Data Inserted Successfully',
        ];
        header('HTTP/1.0 201 Data Inserted Successfully');
        echo json_encode($data);
    } else {
        $data = [
            'status' => 500,
            'message' => 'INTERNAL SERVER ERROR',
        ];
        header('HTTP/1.0 401 INTERNAL SERVER ERROR');
        return json_encode($data);
    }
}
// function for get all the data from the data-base
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
};
