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

if($_POST['action'] == 'FETCH_USER_ORDERS_LIMIT'){
    $user_id = htmlentities(1);
    $user_orders = $orders->find_by_user_id_with_limit($user_id, 10);
    $count = count($user_orders);
    $output = '';
    if($count > 0){
        $output .= '<table class="table table-striped table-valign-middle">';
        $output .= '<thead>';
        $output .= '<tr>';
        $output .= '<th>Order #</th>';
        $output .= '<th>Price</th>';
        $output .= '<th>Paid </th>';
        $output .= '<th>Payment Status</th>';
        $output .= '<th>Order Status</th>';
        $output .= '<th>View</th>';
        $output .= '</tr>';
        $output .= '</thead>';
        $output .= '<tbody>';
        foreach($user_orders as $user_order){
            $output .= '<tr>';
            $output .= '<td>'.$user_order['id'].'</td>';
            $output .= '<td>'.$user_order['amount'].'</td>';
            $output .= '<td>'.$user_order['paid'].'</td>';
            $output .= '<td>'.$user_order['payment_status'].'</td>';
            $output .= '<td>'.$user_order['order_status'].'</td>';
            $output .= '<td><button type="button" id="'.$user_order['id'].'" class="btn btn-primary view">View</button></td>';
            $output .= '</tr>';
        }
        $output .= '</tbody>';
        $output .= '</table>';
    }else{
        $output .= '<div class="alert alert-danger alert-dismissible">';
        $output .= 'No orders available';
        $output .= '</div>';
    }
    $data['orders'] = $output;
    echo json_encode($data);
}

if($_POST['action'] == 'FETCH_ORDER'){
    $order_id = htmlentities($_POST['order_id']);
    $current_order = $orders->find_by_id($order_id);
    if(!$current_order){
        $data['message'] = 'errorOrder';
        echo json_encode($data);
        die();
    }
    echo json_encode($current_order);
}
