<?php

class Category {

//DB
private $conn;
private $table = 'categories';


//Post Properties
public $id;
public $category;

//Constructor with DB
public function __construct($db) {
    $this->conn = $db;
}

//Get Categories
public function read() {
    //Create query
    $query = 'SELECT
    id, category
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
    $query = 'SELECT id, category
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
        $this->category = $row['category'];
        return $stmt;
      }
    }catch(PDOException $e){
      return false;
    }
}

 // Create Post
 public function create() {
    // Create query
    $query = 'INSERT INTO ' . $this->table . '(category) VALUES(:category)';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->category = htmlspecialchars(strip_tags($this->category));


    // Bind data
    $stmt->bindParam(':category', $this->category);

   try{
     // Execute query
     $stmt->execute();
     return true;
   }catch(PDOException $e){
     return false;
   }
}

  


//Create UPDATE
public function update() {
    //update query
    $query = 'UPDATE ' . $this->table . '
      SET
        category = :category
       WHERE 
        id = :id';
  
        //Prepare statement
        $stmt = $this->conn->prepare($query);
  
        //Clean date
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->id = htmlspecialchars(strip_tags($this->id));
  
        //Bind data
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':id', $this->id);
  
      try{
        //Execure query
        $stmt->execute();
        return true;
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

  try{
    // Execute query
    $stmt->execute();
    return true;
  }catch(PDOException $e){
    return false;
  }
}


}