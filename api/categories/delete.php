<?php 

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $category = new Category($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $category->id = $data->id;

  $rtnObj = json_encode(
    array('id' => $category->id), JSON_FORCE_OBJECT);

  // Delete category
  if($category->delete()) {
    echo $rtnObj;
  } else {
    echo json_encode(
      array('message' => 'Category Not Deleted')
    );
  }

