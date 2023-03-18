<?php

//Headers
header('Access-Control-Allow-Origin: *' );
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate Blog Author object
$author = new Author($db);

//Call blog read method
$result = $author->read();
//Get row count
$num = $result->rowCount();

//Check for any post
if($num > 0) {
    //Post array
     $authors_arr = array();
     $authors_arr['data'] = array();

     while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
    
        $author_item = array(
            'id' => $id,
            'author' => $author
        );
    
        //Push to "data"
        array_push($authors_arr['data'], $author_item);
     }

      //Turn to JSON & output
    echo json_encode($authors_arr);

} else {
    //No authors
    echo json_encode(
       array('message' => 'No Authors Found')
    );
   }
   