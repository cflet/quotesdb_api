<?php

class Quote {

//DB
private $conn;
private $table = 'quotes';

// 'SELECT q.id, q.quote, a.author, c.category
// FROM' . $this-table . 'q
// INNER JOIN authors a
// ON q.author_id = a.id
// INNER JOIN categories c
// ON q.category_id = c.id'


//Post Properties
public $id;
public $quote;
public $author_id;
public $category_id;

//Constructor with DB
public function __construct($db) {
    $this->conn = $db;
}

//Get Quotes
public function read() {
    //Create query
    $query = 'SELECT q.id, q.quote, a.author, c.category
    FROM ' . $this->table . ' q
    INNER JOIN authors a
    ON q.author_id = a.id
    INNER JOIN categories c
    ON q.category_id = c.id';

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
    $query = 'SELECT q.id, q.quote, a.author, c.category
    FROM ' . $this->table . ' q
    INNER JOIN authors a
    ON q.author_id = a.id
    INNER JOIN categories c
    ON q.category_id = c.id
        WHERE
       q.id = ?';

    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Bind ID
    $stmt->bindParam(1, $this->id);

    try{
        // Execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row == false) return false;
        else{
        // Set properties
        $this->id = $row['id'];
        $this->quote = $row['quote'];
        $this->author_id = $row['author'];
        $this->category_id = $row['category'];
        return $stmt;
        }
    }catch(PDOException $e){
        return false;
    }

}

 // Create Post
 public function create() {
    // Create query
    $query = 'INSERT INTO ' . $this->table . '(quote, author_id, category_id) VALUES(:quote, :author_id, :category_id)';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->quote = htmlspecialchars(strip_tags($this->quote));
    $this->author_id = htmlspecialchars(strip_tags($this->author_id));
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));


    // Bind data
    $stmt->bindParam(':quote', $this->quote);
    $stmt->bindParam(':author_id', $this->author_id);
    $stmt->bindParam(':category_id', $this->category_id);

    // Execute query
    if($stmt->execute()) {
      return true;
}

// Print error if something goes wrong
printf("Error: %s.\n", $stmt->error);

return false;



}


//Create UPDATE
public function update() {
    //update query
    $query = 'UPDATE ' . $this->table . '
      SET
        quote = :quote,
        author_id = :author_id,
        category_id = :category_id
       WHERE 
        id = :id';
  
        //Prepare statement
        $stmt = $this->conn->prepare($query);
  
        //Clean date
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));
  
        //Bind data
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);
  
        //Execure query
        if($stmt->execute()) {
            return true;
        }
  
        //Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
  
        return false;
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