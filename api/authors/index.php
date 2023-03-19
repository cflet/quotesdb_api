<?php

//Headers
header('Access-Control-Allow-Origin: *' );
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

$method = $_SERVER['REQUEST_METHOD'];


if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
}


if($method == 'PUT') include 'update.php';
elseif($method == 'POST') include 'create.php';
elseif($method == 'GET') include 'read.php';
elseif($method == 'DELETE') include 'delete.php';
elseif($_SERVER['QUERY_STRING'] != null) include 'read_single.php';