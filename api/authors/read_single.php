<?php

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate Blog Author object
$author = new Author($db);

// Get ID
$author->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get author
$result = $author->read_single();

if($result == false){
  $noAut = ["message" => 'author_id Not Found'];
  echo json_encode($noAut);
}else{
    // Create output
  $author_arr = ["id" => $author->id,
    "author" => $author->author
  ];
// Make JSON
echo (json_encode($author_arr)); 
};
