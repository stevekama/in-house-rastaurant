<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialization.php');
require_once(INIT_PATH.DS.'initialization_migrations.php');

$data = array();

$food_type = new Food_Type_Migration();

if($_POST['action'] == "CREATE_TABLE"){
    $table = $food_type->create();
    if($table){
        $data['message'] = "success";
    }
    echo json_encode($data); 
}

if($_POST['action'] == "FETCH_COLUMNS"){
    $results = $admins_migration->find_columns();
    $output = '<table class="table table-bordered">';
    $output .= '<thead>';
    $output .= ' <tr>';
    $output .= '<th>Colum Name</th>';
    $output .= '<th>Type</th>';
    $output .= '</tr>';
    $output .= '</thead>';
    $output .= '<tbody>';
    foreach($results as $column){
        $output .= ' <tr>';
        $output .= '<td>'.$column['Field'].'</td>';
        $output .= '<td>'.$column['Type'].'</td>';
        $output .= '</tr>';
    }
    $output .= '</tbody>';
    $output .= '</table>';

    $data['output'] = $output;
    echo json_encode($data);
}

// destroy table
if($_POST['action'] == "DELETE_TABLE"){
    $table = $admins_migration->drop();
    if($table){
        $data['message'] = "success";
    }

    echo json_encode($data);
}