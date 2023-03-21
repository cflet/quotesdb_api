<?php 

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate blog author object
$author = new Author($db);

// Get raw data
$data = json_decode(file_get_contents("php://input"));
$author->author = $data->author;

//Check for missing param
if($author->author == ""){
    $missParam = ["message" => 'Missing Required Parameters'];
    echo json_encode($missParam);
}else{
  $result = $author->create();

  if($result != false){
  $table = $result->fetch(PDO::FETCH_ASSOC);
  $newId = strval($table['id']);
  $mess = ["id" => $newId, "author" => $author->author];
  echo json_encode($mess); 
  }else{
    $notFound = ["message" => 'author_id Not Found'];
    echo json_encode($notFound); 
  }
}