<?php

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate Blog Quote object
$quote = new Quote($db);

// Get ID
$quote->id = isset($_GET['id']) ? $_GET['id'] : null;

// Get quote
$result = $quote->read_single();

if($result == false){
  $noQuote = ["message" => 'No Quotes Found'];
  echo json_encode($noQuote);
}else{
$row = $result->fetch(PDO::FETCH_ASSOC);

  //check if row has data
  if($row != null){
      //Create object
  $quote_obj = [
    "id" => $quote->id,
    "quote" => $quote->quote,
    "author" => $quote->author_id,
    "category" => $quote->category_id
  ];
  //Make JSON
  echo json_encode($quote_obj);
  }else {
  //No data create array
  $quote_arr = array(
    "id" => $quote->id,
    "quote" => $quote->quote,
    "author" => $quote->author_id,
    "category" => $quote->category_id
  );
  echo json_encode($quote_arr);
  }
};
