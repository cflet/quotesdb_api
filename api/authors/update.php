<?php

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate Blog Post object
$author = new Author($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

//Set info to Update
$author->id = $data->id;
$author->author = $data->author;

echo var_dump($author->id);


if($author->author == ""){
    $missParam = ["message" => 'Missing Required Parameters'];
    echo json_encode($missParam);
}else{
    try{
        $result = $author->update();
        if($result =! false){
            $mess = ["id" => $author->id,
                    "author" => $author->author];
        echo json_encode($mess);}
    }catch(PDOException $e){
        $err = ["message" => "Proper Error Message"];
        echo json_encode($err);
}
}

