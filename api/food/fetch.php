<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize
require_once('../../init/initialization.php');

// Database Connect
$connection = $database->connect();

$d = new DateTime();

$type = new Food_Type();

$type_name = htmlentities($_POST['type']);

$current_type = $type->find_by_type($type_name);

$foods = new Foods();

$org_foods = $foods->find_by_type_id($current_type['id']);

$num_foods = count($org_foods);

// start on the query
$query = '';

// output array
$output = array();

$query .= "SELECT * FROM foods ";
$query .= "WHERE type_id = '{$current_type['id']}' ";

// Bring  in search query
if (isset($_POST["search"]["value"])) {
    $query .= "AND (";
    $query .= "food_name LIKE '%{$_POST["search"]["value"]}%' ";
    $query .= "OR description LIKE '%{$_POST["search"]["value"]}%' ";
    $query .= "OR price LIKE '%{$_POST["search"]["value"]}%' ";
    $query .= ") ";
}

// order query
if (isset($_POST["order"])) {
    $query .= "ORDER BY " . $_POST['order']['0']['column'] . " " . $_POST['order']['0']['dir'] . " ";
} else {
    $query .= "ORDER BY id DESC ";
}

// Pagging
if($_POST["length"] != -1){
	$query .= "LIMIT ".intval($_POST["length"])." OFFSET ".intval($_POST["start"]);
}

$statement = $connection->prepare($query);
$statement->execute();
$filtered_rows = $statement->rowCount();

// data array
$data = array();

while($row = $statement->fetch(PDO::FETCH_ASSOC)){
    $sub_array = array();
    $sub_array[] = $row["food_name"];
    $sub_array[] = $row["description"];
    $sub_array[] = $row["price"];
    $data[] = $sub_array;
}

// store results in output array
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$num_foods,
	"data"				=>	$data
);

echo json_encode($output);