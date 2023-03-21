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

 //Create return
$quote_arr = ["id" => $quote->id];

 //Delete quote
 $result = $quote->delete();

 $row = $result->fetch(PDO::FETCH_ASSOC);

 if($row == false){
   $mess = ["message" => 'No Quotes Found'];
  echo (json_encode($mess));
 }else{
  echo json_encode($quote_arr);
 }


