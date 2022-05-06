<?php
class Book
{

    // database connection and table name
    private $conn;
    private $table_name = "books";

    // object properties
    public $id;
    public $author_id;
    public $title;
    public $ISBN;
    public $category_id;
    public $publisher_id;
    public $publish_year;
    public $price;
    public $image;
    public $size;
    public $page;
    public $book_file_review;
    public $book_file;
    public $detail;
    public $created_dt;
    public $update_dt;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // create product
    public function create()
    {

        //write query
       // insert query
       
        $query = "INSERT INTO " . $this->table_name . "
        SET author_id=:author_id,
         title=:title, 
         ISBN=:ISBN, 
         category_id=:category_id, 
         publisher_id=:publisher_id, 
         publish_year=:publish_year, 
         price=:price, 
         image=:image, 
         page=:page,
         book_file_review=:book_file_review, 
         book_file=:book_file, 
         detail=:detail";


        $stmt = $this->conn->prepare($query);
       
        

        // posted values
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->ISBN=htmlspecialchars(strip_tags($this->ISBN));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->publisher_id = htmlspecialchars(strip_tags($this->publisher_id));
        $this->publish_year=htmlspecialchars(strip_tags($this->publish_year));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->image = htmlspecialchars(strip_tags($this->image));
        //$this->size=htmlspecialchars(strip_tags($this->size));
        $this->page = htmlspecialchars(strip_tags($this->page));
        $this->book_file_review = htmlspecialchars(strip_tags($this->book_file_review));
        $this->book_file=htmlspecialchars(strip_tags($this->book_file));
        $this->detail=htmlspecialchars(strip_tags($this->detail));

        // bind values
        $stmt->bindParam(":author_id", $this->author_id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":ISBN", $this->ISBN);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":publisher_id", $this->publisher_id);
        $stmt->bindParam(":publish_year", $this->publish_year);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":image", $this->image);
        //$stmt->bindParam(":size", $this->size);
        $stmt->bindParam(":page", $this->page);
        $stmt->bindParam(":book_file_review", $this->book_file_review);
        $stmt->bindParam(":book_file", $this->book_file);
        $stmt->bindParam(":detail", $this->detail);
       
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }
    public function readAll()
    {
        $query = "SELECT
                *
            FROM
                " . $this->table_name . "
            ORDER BY
                id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
// used for paging products
    public function countAll()
    {

        $query = "SELECT id FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }
    public function readOne()
    {

        $query = "SELECT *
        FROM " . $this->table_name . "
        WHERE id = ?
        LIMIT 0,1";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->title =  $row['title'];
        $this->author_id =  $row['author_id'];
        $this->ISBN =  $row['ISBN'];
        $this->category_id =  $row['category_id'];
        $this->publisher_id =  $row['publisher_id'];
        $this->publish_year =  $row['publish_year'];
        $this->price =  $row['price'];
        $this->detail =  $row['detail'];
        $this->page =  $row['page'];
        $this->image = $row['image'];
        $this->book_file_review = $row['book_file_review'];
        $this->book_file = $row['book_file'];
        
    }
    public function update()
    {

        $query = "UPDATE
                " . $this->table_name . "
            SET
                author_id=:author_id,
                title=:title, 
                ISBN=:ISBN, 
                category_id=:category_id, 
                publisher_id=:publisher_id, 
                publish_year=:publish_year, 
                price=:price,
                page=:page,
                detail=:detail
            WHERE
                id = :id";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->ISBN=htmlspecialchars(strip_tags($this->ISBN));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->publisher_id = htmlspecialchars(strip_tags($this->publisher_id));
        $this->publish_year=htmlspecialchars(strip_tags($this->publish_year));
        $this->price = htmlspecialchars(strip_tags($this->price));
        //$this->size=htmlspecialchars(strip_tags($this->size));
        $this->page = htmlspecialchars(strip_tags($this->page));
        $this->detail=htmlspecialchars(strip_tags($this->detail));
       
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind parameters
        $stmt->bindParam(":author_id", $this->author_id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":ISBN", $this->ISBN);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":publisher_id", $this->publisher_id);
        $stmt->bindParam(":publish_year", $this->publish_year);
        $stmt->bindParam(":price", $this->price);
        //$stmt->bindParam(":size", $this->size);
        $stmt->bindParam(":page", $this->page);
        $stmt->bindParam(":detail", $this->detail);

        $stmt->bindParam(':id', $this->id);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }
    public function update_with_file()
    {

        $query = "UPDATE
                " . $this->table_name . "
            SET
                title=:title, 
                image=:image, 
                status=:status
            WHERE
                id = :id";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->image=htmlspecialchars(strip_tags($this->image));
        
        $this->id = htmlspecialchars(strip_tags($this->id));

    
        // bind values
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":image", $this->image);
        
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }
// delete the product
    public function delete()
    {

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
// read products by search term
    public function search($search_term, $from_record_num, $records_per_page)
    {

        // select query
        $query = "SELECT
                c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            WHERE
                p.name LIKE ? OR p.description LIKE ?
            ORDER BY
                p.name ASC
            LIMIT
                ?, ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind variable values
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $search_term);
        $stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);

        // execute query
        $stmt->execute();

        // return values from database
        return $stmt;
    }
    public function countAll_BySearch($search_term){
  
        // select query
        $query = "SELECT
                    COUNT(*) as total_rows
                FROM
                    " . $this->table_name . " p 
                WHERE
                    p.name LIKE ? OR p.description LIKE ?";
      
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
      
        // bind variable values
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $search_term);
      
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
        return $row['total_rows'];
    }
    // will upload image file to server
    function uploadPhoto(){
    
        $result_message="";
    
        // now, if image is not empty, try to upload the image
        if($this->image){
    
            // sha1_file() function is used to make a unique file name
            $target_directory = "../../upload/images/book/";
            $target_file = $target_directory . $this->image;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
    
            // error message is empty
            $file_upload_error_messages="";
            // make sure that file is a real image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check!==false){
                // submitted file is an image
            }else{
                $file_upload_error_messages.="<div>Submitted file is not an image.</div>";
            }
            
            // make sure certain file types are allowed
            $allowed_file_types=array("jpg", "jpeg", "png", "gif");
            if(!in_array($file_type, $allowed_file_types)){
                $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
            }
            
            // make sure file does not exist
            if(file_exists($target_file)){
                $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
            }
            
            // make sure submitted file is not too large, can't be larger than 1 MB
            if($_FILES['image']['size'] > (1024000)){
                $file_upload_error_messages.="<div>Image must be less than 1 MB in size.</div>";
            }
            
            // make sure the 'uploads' folder exists
            // if not, create it
            if(!is_dir($target_directory)){
                mkdir($target_directory, 0777, true);
            }

            // if $file_upload_error_messages is still empty
            if(empty($file_upload_error_messages)){
                // it means there are no errors, so try to upload the file
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                    // it means photo was uploaded
                }else{
                    $result_message.="<div class='alert alert-danger'>";
                        $result_message.="<div>Unable to upload photo.</div>";
                        $result_message.="<div>Update the record to upload photo.</div>";
                    $result_message.="</div>";
                }
            }
            
            // if $file_upload_error_messages is NOT empty
            else{
                // it means there are some errors, so show them to user
                $result_message.="<div class='alert alert-danger'>";
                    $result_message.="{$file_upload_error_messages}";
                    $result_message.="<div>Update the record to upload photo.</div>";
                $result_message.="</div>";
            }
    
        }
    
        return $result_message;
    }
 
}
