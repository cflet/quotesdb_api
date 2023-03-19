<?php 

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $quote = new Quote($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $quote->id = $data->id;

 //Create array
 $quote_arr = array(
  'id' => $quote->id
 );

  // Delete quote
  if($quote->delete()) {
    print_r(json_encode($quote_arr));
  } else {
    echo json_encode(
      array('message' => 'Quote Not Deleted')
    );
  }

