<?php

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate Blog Post object
$category = new Category($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

//Set info to Update
$category->id = $data->id;
$category->category = $data->category;

//Update category
if($category->update()) {
    echo json_encode(
        array('id' => $category->id,
        'category' => $category->category
    ));
    }
else {
    echo json_encode(
        array('message' => 'Category Not Updated'));
  };

