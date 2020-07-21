<?php
//Modificando as configurações de resposta para erros em php
//ini_set('display_erros', 'on');
//error_reporting(E_ALL);

// Config headers
//GET
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
