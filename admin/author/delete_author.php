<?php
// check if value was posted
if($_POST){
  
    // include database and object file
    include(__DIR__ . "/../../config/database.php");
    include(__DIR__ . "/../../objects/author.php");
  
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
  
    // prepare product object
    $author = new Author($db);
      
    // set product id to be deleted
    $author->id = $_POST['object_id'];
      
    // delete the product
    if($author->delete()){
        echo "Object was deleted.";
    }
      
    // if unable to delete the product
    else{
        echo "Unable to delete object.";
    }
}
?>