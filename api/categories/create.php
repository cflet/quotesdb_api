<?php 

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate blog category object
$category = new Category($db);

// Get raw data
$data = json_decode(file_get_contents("php://input"));

$category->category = $data->category;

// Create category
if($category->create()) {
    echo json_encode(
    array('id' => "{$category->id}",
    'category' => $category->category)
    );
} else {
    echo json_encode(
    array('message' => 'Category Not Created')
    );
}
