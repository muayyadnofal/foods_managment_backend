<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

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
$food = new FoodGroup($db);

// getting the statement query result
$result = $food->read();

// number of items inside the food groups table
$num = $result->rowCount();

// extracting the data from the table and returning a handled response
if ($num > 0) {
    $foodResources = new FoodGroupResource($result);
    $response->returnData('food_groups', $foodResources->foodGroupResponse(), 'food groups');
} else {
    $response->success('no food group found');
}
