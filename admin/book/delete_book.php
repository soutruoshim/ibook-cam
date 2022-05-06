<?php
// check if value was posted
if($_POST){
  
    // include database and object file
    include(__DIR__ . "/../../config/database.php");
    include(__DIR__ . "/../../objects/book.php");
  
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
  
    // prepare product object
    $book = new Book($db);
      
    // set product id to be deleted
    $book->id = $_POST['object_id'];
      
    // delete the product
    if($book->delete()){
        echo "Object was deleted.";
    }
      
    // if unable to delete the product
    else{
        echo "Unable to delete object.";
    }
}
?>