<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

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
    try{
        $result = $author->create();
        $table = $result->fetch(PDO::FETCH_ASSOC);
        $newId = $table['id'];
        $mess = ["id" => $newId, "author" => $author->author];
        echo json_encode($mess);
    }catch(PDOException $e){
        //authorId or categoryId not found
        echo json_encode();
    }
}




