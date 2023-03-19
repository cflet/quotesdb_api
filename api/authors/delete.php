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

  // Delete post
  if($author->delete()) {
    echo json_encode(
      array('id' => $author->id)
    );
  } else {
    echo json_encode(
      array('message' => 'Author Not Deleted')
    );
  }

