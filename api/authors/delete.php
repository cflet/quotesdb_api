<?php 

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $author = new Author($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $author->id = $data->id;

  //to JSON obj
  rtnObj = json_encode(
    array('id' => $author->id), JSON_FORCE_OBJECT);

  // Delete post
  if($author->delete()) {
    echo rtnObj;
  } else {
    echo json_encode(
      array('message' => 'Author Not Deleted')
    );
  }

