<?php

//Headers
header('Access-Control-Allow-Origin: *' );
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$method = $_SERVER['REQUEST_METHOD'];
$args = $_SERVER['QUERY_STRING'];


//include 'read.php';
//include 'read_single.php';
//include 'create.php';
//include 'update.php';

if($method == 'PUT') include 'update.php';
elseif($method == 'POST') include 'create.php';
elseif($args) include 'read_single.php';
elseif($method == 'GET') include 'read.php';
elseif($method == 'DELETE') include 'delete.php';