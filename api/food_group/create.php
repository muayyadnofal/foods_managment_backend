<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-type, Access-Control-Allow-Methods, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/FoodGroup.php';
include_once '../../Resources/FoodGroupResource.php';
include_once '../../helpers/ResponseHandler.php';

// define the response object from the response handler class
$response = new Response();

// define the db object from the Database class
$database = new Database();
$db = $database->connectToDB();

// passing the db object to the foodGroup model constructor to prepare the food groups query
$foodGroup = new FoodGroup($db);

// taking the value from the user input
$data = json_decode(file_get_contents("php://input"));
$foodGroup->fddrp_desc = $data->description;

// extracting the data from the table and returning a handled response
if ($foodGroup->create()) {
    $response->success('food group created successfully');
} else {
    $response->failure('cannot create food group');
}
