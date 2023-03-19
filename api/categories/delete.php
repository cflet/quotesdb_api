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

  //Create Array
  $category_arr = array(
    'id' => $category->id
  );


  // Delete category
  if($category->delete()) {
    print_r(json_encode($category_arr));
  } else {
    echo json_encode(
      array('message' => 'Category Not Deleted')
    );
  }

