<?php

class Author {

//DB
private $conn;
private $table = 'authors';


//Post Properties
public $id;
public $author;

//Constructor with DB
public function __construct($db) {
    $this->conn = $db;
}

//Get Authors
public function read() {
    //Create query
    $query = 'SELECT
    id, author
    FROM
    ' . $this->table;

    //Prepared Statement
    $stmt = $this->conn->prepare($query);

    try{
        //Execute query
        $stmt->execute();
        return $stmt;
    }catch(PDOException $e){
        return false;
    }
}

// Get single post
public function read_single() {
    // Create query
    $query = 'SELECT id, author
        FROM ' . $this->table . '
        WHERE
        id = ?';

    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Bind ID
    $stmt->bindParam(1, $this->id);

    try{
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if($row == false) return false;
      else{
        $this->author = $row['author'];
        return $stmt;
      }
    }catch(PDOException $e){
      return false;
    }
}

 // Create Post
 public function create() {
    // Create query
    $query = 'INSERT INTO ' . $this->table . '(author) VALUES(:author) RETURNING id';
    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Clean data
    $this->author = htmlspecialchars(strip_tags($this->author));
    // Bind data
    $stmt->bindParam(':author', $this->author);

    try{
        // Execute query
        if($stmt->execute())
        return $stmt;
    }catch(PDOException $e){
        return false;
    }
}


//Create UPDATE
public function update() {
    //update query
    $query = 'UPDATE ' . $this->table . '
      SET
        author = :author
       WHERE 
        id = :id';
  
        //Prepare statement
        $stmt = $this->conn->prepare($query);
  
        //Clean date
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->id = htmlspecialchars(strip_tags($this->id));
  
        //Bind data
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':id', $this->id);

        try{
           //Execure query
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            return false;
        }

  }

// Delete Post
public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind data
    $stmt->bindParam(':id', $this->id);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
}








}