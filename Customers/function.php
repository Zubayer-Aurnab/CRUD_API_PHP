<?php
require '../inc/DB.php';

// common error function for the input fields
function error422($message){
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header('HTTP/1.0 401 NO cunnectoin with the server');
    return json_encode($data);
   
};

// fucntoin for post data to the data-base
function postData($customerInput)
{
   global $conn;

   $name =  mysqli_real_escape_string($conn,$customerInput['name']);
   $email =  mysqli_real_escape_string($conn,$customerInput['email']);
   $phone =  mysqli_real_escape_string($conn,$customerInput['phone']);

   //validation
   if(empty(trim($name))){

     return error422('Enter name');

   }elseif(empty(trim($email))){

    return error422('Enter email');

   }elseif (empty(trim($phone))) {

    return error422('Enter phone');
   };

  // the query for inser a data to the database
    $query = "INSERT INTO customers (name,email,phone) VALUES('$name','$email','$phone')";
    $result = mysqli_query($conn,$query);

    if($result){
        $data = [
            'status' => 201,
            'message' => 'Data Inserted Successfully',
        ];
        header('HTTP/1.0 201 Data Inserted Successfully');
        echo json_encode($data);
    }else{
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
