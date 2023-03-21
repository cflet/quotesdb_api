<?php

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate Blog Quote object
$quote = new Quote($db);

// Get ID
$quote->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get quote
$results = $quote->read_single();


if($results == false){
  $noQuote = ["message" => 'No Quotes Found'];
  echo json_encode($noQuote);
}else{
  //Create output
  $quote_arr = [
    "id" => $quote->id,
    "quote" => $quote->quote,
    "author" => $quote->author_id,
    "category" => $quote->category_id
  ];
  //Make JSON
  echo json_encode($quote_arr);
};
