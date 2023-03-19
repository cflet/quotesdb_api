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

 //Create array
 $author_arr = array(
  'id' => $author->id
 );

  // Delete post
  if($author->delete()) {
    print_r(json_encode($author_arr));
  } else {
    echo json_encode(
      array('message' => 'Author Not Deleted')
    );
  }

