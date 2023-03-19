<?php

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate Blog Category object
$category = new Category($db);

//Call blog read method
$result = $category->read();
//Get row count
$num = $result->rowCount();

//Check for any post
if($num > 0) {
    //Post array
     $categories_arr = array();

     while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
    
        $category_item = array(
            'id' => $id,
            'category' => $category
        );
    
        //Push to "data"
        array_push($categories_arr, $category_item);
     }

      //Turn to JSON & output
    echo json_encode($categories_arr);

} else {
    //No Categories
    echo json_encode(
       array('message' => 'No Categories Found')
    );
   }
   