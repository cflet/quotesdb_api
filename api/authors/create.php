<?php 

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate blog author object
$author = new Author($db);

// Get raw data
$data = json_decode(file_get_contents("php://input"));

$author->author = $data->author;
//$author->id = $data->id;

// Create author
if($author->create()) {
    echo json_encode(
    array('id' => "{$author->id}",
    'author' => $author->author
    ));
} else {
    echo json_encode(
    array('message' => 'Author Not Created')
    );
}
