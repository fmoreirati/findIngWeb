<?php
require_once("config.php");
require_once("apicore.class.php");
$method = $_SERVER["REQUEST_METHOD"];

if ($method === "GET") {
    $url = explode("/", $_GET['quest']);
    $quest = htmlspecialchars(str_replace(" ", "+", trim($url[0])));
    $num = (isset($url[1]) && is_numeric($url[1])) ? trim($url[1]) : null;
    try {
        $api = new ApiCore();
        $api->findGoogle($quest, $num);

        http_response_code(200);
        echo $api->listResults;
    } catch (Exception $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Item does not exist."));
}
