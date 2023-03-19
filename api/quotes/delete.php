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

  $rtnObj = json_encode(
    array('id' => $quote->id), JSON_FORCE_OBJECT
  );

  // Delete quote
  if($quote->delete()) {
    echo $rtnObj;
  } else {
    echo json_encode(
      array('message' => 'Quote Not Deleted')
    );
  }

