<?php

function mpesaReceivePayment(){

    //Return a success response to m-pesa

    $response = array(
        'ResultCode' => 0,
        'ResultDesc' => 'Success'
    );
    echo json_encode($response);

    //Get input stream data
    
    $payload = file_get_contents('php://input');
    $key = md5('2019');
    
$url = 'https://example.com?auth='.$key.'';

//Initiate cURL.

    $dec = (Array)json_decode($payload);
    
    $curl_post_data = array(
      'TransactionType'=>$dec["TransactionType"],
    'TransID'=>strtoupper($dec["TransID"]),
    'TransTime'=>$dec["TransTime"],
    'TransAmount'=>$dec["TransAmount"],
    'BusinessShortCode'=>$dec["BusinessShortCode"],
    'BillRefNumber'=>strtoupper($dec["BillRefNumber"]),
    'MSISDN'=>$dec["MSISDN"],
    'FirstName'=>$dec["FirstName"],
    'MiddleName'=>$dec["MiddleName"],
    'LastName'=>$dec["LastName"]
    );


$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //setting custom header




$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
}
