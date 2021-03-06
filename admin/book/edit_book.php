<?php
   include("../inc/header.php");
   include(__DIR__ . "/../../config/database.php");
   include(__DIR__ . "/../../objects/book.php");
   include(__DIR__ . "/../../objects/author.php");
   include(__DIR__ . "/../../objects/publisher.php");
   include(__DIR__ . "/../../objects/category.php");

   $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

   // get database connection
    $database = new Database();
    $db = $database->getConnection();
    // prepare objects
    $book = new Book($db);
    $book->id = $id;
    $book->readOne();


    // if the form was submitted
    if($_POST){
        $book->title =  $_POST['title'];
        $book->author_id =  $_POST['author_id'];
        $book->ISBN =  $_POST['ISBN'];
        $book->category_id =  $_POST['category_id'];
        $book->publisher_id =  $_POST['publisher_id'];
        $book->publish_year =  $_POST['publication_year'];
        $book->price =  $_POST['price'];
        $book->detail =  $_POST['detail'];
        $book->page =  $_POST['page'];

        // update book
        if ($book->update()) {
            echo "<div class='alert alert-success'>book was updated.</div>";
            if(!empty($_FILES["image"]["name"])){
                $image = !empty($_FILES["image"]["name"])
                ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
                $book->image = $image;
                $book->update_image();
                $book->uploadPhoto();
            }
            if(!empty($_FILES["book_file_review"]["name"])){
                $book_file_review = !empty($_FILES["book_file_review"]["name"])
                ? sha1_file($_FILES['book_file_review']['tmp_name']) . "-" . basename($_FILES["book_file_review"]["name"]) : "";
                
                $book->book_file_review = $book_file_review;
                $book->update_book_file_review();
                $book->uploadFileReview();
            }
            if(!empty($_FILES["book_file"]["name"])){
                $book_file = !empty($_FILES["book_file"]["name"])
                ? sha1_file($_FILES['book_file']['tmp_name']) . "-" . basename($_FILES["book_file"]["name"]) : "";
                $book->book_file = $book_file;

                $book->book_file = $book_file;
                $book->update_book_file();
                $book->uploadFile();
            }
            
        }else {
            echo "<div class='alert alert-danger'>Unable to Update book.</div>";
        }
    }
?>

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-notebook icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Edit book
                <div class="page-title-subheading">This is a page edit book.
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            
            <div class="d-inline-block dropdown">
                <a type="button" class="btn-shadow btn btn-info" href="../book/books.php" >
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-reply fa-w-20"></i>
                    </span>
                    Back
                </a>
                
            </div>
        </div>    
    </div>
</div>
<div class="row">
<div class="col-md-12">
        <div class="main-card mb-3 card">
        <div class="card-body"><h5 class="card-title"></h5>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative form-group">
                        <label class="">Title</label>
                        <input name="title" id="title" value="<?= $book->title; ?>" placeholder="" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative form-group">
                        <label class="">ISBN</label>
                        <input name="ISBN" id="ISBN" value="<?= $book->ISBN; ?>" placeholder="" type="text" class="form-control">
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative form-group">
                        <label class="">Author</label>
                        <?php 
                            $author = new Author($db);
                            $stmt = $author->readAll();
                       ?>
                       <select class="form-control" name="author_id" id="author_id">
                           <option value="" selected disabled>Choice Author</option>
                            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?= $row['id'] ?>" <?= $row['id']== $book->author_id?'selected':'' ?> > <?= $row['title'] ?> </option>
                            <?php } ?>
                         
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative form-group">
                        <label class="">Category</label>
                        <?php 
                            $category = new Category($db);
                            $stmt = $category->readAll();
                        ?>
                        <select class="form-control" name="category_id" id="category_id">
                            <option value="" selected disabled>Choice Category</option>
                            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option <?= $row['id']== $book->category_id ?'selected':''  ?> value="<?= $row['id'] ?>"> <?= $row['title'] ?> </option>
                            <?php } ?>

                        </select>
                   </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative form-group">
                        <label class="">Publisher</label>
                        <?php 
                            $publisher = new Publisher($db);
                            $stmt = $publisher->readAll();
                        ?>
                        <select class="form-control" name="publisher_id" id="publisher_id">
                            <option value="" selected disabled>Choice Publisher</option>
                            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option <?= $row['id']==$book->publisher_id?'selected':''  ?> value="<?= $row['id'] ?>"> <?= $row['title'] ?> </option>
                            <?php } ?>

                        </select>
                   </div>
                </div>
                <div class="col-md-6">
                        <div class="position-relative form-group">
                        <label class="">Publication Year</label>
                        <!-- <input name="publication_year" id="publication_year" placeholder="" type="text" class="form-control"> -->
                        <select class="form-control" name="publication_year" id="publication_year">
                            <option value="" selected disabled>Select Year</option>
                        <?php for($year = intval(date('Y')) - 10;  $year <= intval(date('Y')); $year++ ) { ?>
                        <option  <?= $year==$book->publish_year?'selected':''  ?> value="<?= $year ?>"> <?= $year ?> </option>
                        <?php } ?>

                        </select>
                    </div>
                </div>
            </div>    
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative form-group">
                        <label class="">Pages</label>
                        <input name="page" id="page" placeholder="" value="<?= $book->page; ?>" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative form-group">
                        <label class="">Price</label>
                        <input name="price" id="price" placeholder="" value="<?= $book->price; ?>" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="position-relative form-group">
                <label class="">Detail</label>
                <textarea rows="5" cols="20" name="detail" id="detail" placeholder="" type="text" class="form-control"><?= $book->detail; ?></textarea>
                
            </div>
            <div class="position-relative form-group">
                <label class="">Image</label><br>
                <div style="margin-bottom: 8px"><img id="book_photo" src="<?php if(isset($book->image)) { echo '../../upload/images/book/'.$book->image; } ?>" width="180" height="200" alt=""></div>
                <input type="file" name="image" placeholder="Choose image" id="image" class="form-control" onchange="document.getElementById('book_photo').src = window.URL.createObjectURL(this.files[0])">
            </div>
            <div class="position-relative form-group">
                        <label class="">Book File Review</label>
                        <input type="file" name="book_file_review" placeholder="Choose Book File" id="book_file_review" class="form-control">
                    </div>

            <div class="position-relative form-group">
                <label class="">Book File</label>
                <input type="file" name="book_file" placeholder="Choose Book File" id="book_file" class="form-control">
            </div>
            
            <input type="submit" class="btn btn-primary" name="submit" value="Save Ebook">
           </form>
        </div>
        </div>
    </div>
</div>
<?php
   include("../inc/footer.php");
?>