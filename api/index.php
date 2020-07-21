<?php
require_once("config.php");
require_once("apicore.class.php");
$method = $_SERVER["REQUEST_METHOD"];

if ($method === "GET") {
    $quest = htmlspecialchars(str_replace(" ", "+", trim($_GET['quest'])));
       
    $api = new ApiCore();
    $api->findGoogle($quest);
    
    http_response_code(200);
    echo $api->listResults;
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Item does not exist."));
}
