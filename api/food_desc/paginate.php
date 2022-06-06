<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Food.php';
include_once '../../Resources/FoodResource.php';
include_once '../../helpers/ResponseHandler.php';

// define the response object from the response handler class
$response = new Response();

// define the db object from the Database class
$database = new Database();
$db = $database->connectToDB();

// passing the db object to the food model constructor to prepare the foods query
$food = new Food($db);

// getting the statement query result
$result = $food->paginate();

// number of items inside the foods table
$num = $result->rowCount();

// extracting the data from the table and returning a handled response
if ($num > 0) {
    $foodResources = new FoodResource($result);
    $response->returnData('food', $foodResources->foodsResponse(), 'ordered food here');
} else {
    $response->success('no food found');
}
