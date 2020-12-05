<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize
require_once('../../init/initialization.php');

$d = new DateTime();

$data = array();

$orders = new Orders();

$orders->user_id = 1;
$orders->amount = 0;
$orders->paid = 0;
$orders->payment_status = 'NEW';
$orders->order_status = 'NEW';
$orders->created_date = $d->format('Y-m-d H:i:s');
$orders->edited_date = $d->format('Y-m-d H:i:s');
if($orders->save()){
    $data['order_id'] = $orders->id;
    $data['message'] = 'success';
}

echo json_encode($data);