<?php

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate Blog Category object
$category = new Category($db);

// Get ID
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get category
$result = $category->read_single();

if($result == false){
  $noCat = ["message" => 'category_id Not Found'];
  echo json_encode($noCat);
}else{
    // Create output
  $category_arr = ["id" => $category->id,
    "category" => $category->category
  ];
// Make JSON
echo (json_encode($category_arr));  
};

