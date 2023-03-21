<?php

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate Blog Post object
$author = new Author($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

//Set info to Update
$author->id = $data->id;
$author->author = $data->author;

//Update author
if($author->update()) {
    echo json_encode(
        array('id' => $author->id,
        'author' => $author->author
    ));
    }
else {
    echo json_encode(
        array('message' => 'Author Not Updated'));
  };

