<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Nut.php';
include_once '../../Resources/NutResource.php';
include_once '../../helpers/ResponseHandler.php';

// define the response object from the response handler class
$response = new Response();

// define the db object from the Database class
$database = new Database();
$db = $database->connectToDB();

// passing the db object to the nut model constructor to prepare the nuts query
$nut = new Nut($db);

$nut->ndb_no = isset($_GET['id']) ? $_GET['id'] : die();

// getting the statement query result
$result = $nut->read_nut();

// number of items inside the nuts table
$num = $result->rowCount();

// extracting the data from the table and returning a handled response
if ($num > 0) {
    $nutResources = new NutResource($result);
    $response->returnData('nut', $nutResources->nutResponse(), 'ordered nut here');
} else {
    $response->success('no nut found');
}
