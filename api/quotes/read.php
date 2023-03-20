<?php

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate Blog Quote object
$quote = new Quote($db);

//Call blog read method
$result = $quote->read();
//Get row count
$num = $result->rowCount();

//Check for any post
if($num > 0) {
    //Post array
     $quotes_arr = array();
     //$quotes_arr['data'] = array();

     while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
    
        $quote_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author_id,
            'category' => $category_id
        );
    
        //Push to "data"
        array_push($quotes_arr, $quote_item);
     }

      //Turn to JSON & output
    echo json_encode($quotes_arr);

} else {
    //No Quotes
    echo json_encode(
       array('message' => 'No Quotes Found')
    );
   }
   