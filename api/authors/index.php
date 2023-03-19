<?php

//Headers
header('Access-Control-Allow-Origin: *' );
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

$method = $_SERVER['REQUEST_METHOD'];

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$args = $parts[4];


if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
}


if($method == 'PUT') include 'update.php';
elseif($method == 'DELETE') include 'delete.php';
elseif($method == 'POST') include 'create.php';
elseif($args != "") include 'read_single.php';
elseif($method == 'GET') include 'read.php';



