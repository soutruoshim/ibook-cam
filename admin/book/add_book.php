<?php
include("../inc/header.php");
// include 'database.php';
include(__DIR__ . "/../../config/database.php");
include(__DIR__ . "/../../objects/book.php");
include(__DIR__ . "/../../objects/author.php");
include(__DIR__ . "/../../objects/publisher.php");
include(__DIR__ . "/../../objects/category.php");

// get database connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$book = new Book($db);


if ($_POST) {
    // set book property values
   
    $book->title =  $_POST['title'];
    $book->author_id =  $_POST['author_id'];
    $book->ISBN =  $_POST['ISBN'];
    $book->category_id =  $_POST['category_id'];
    $book->publisher_id =  $_POST['publisher_id'];
    $book->publish_year =  $_POST['publication_year'];
    $book->price =  $_POST['price'];
    $book->detail =  $_POST['detail'];
    $book->page =  $_POST['page'];
   
    $image = !empty($_FILES["image"]["name"])
        ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
    $book->image = $image;

    $book_file_review = !empty($_FILES["book_file_review"]["name"])
        ? sha1_file($_FILES['book_file_review']['tmp_name']) . "-" . basename($_FILES["book_file_review"]["name"]) : "";
    $book->book_file_review = $book_file_review;

    $book_file = !empty($_FILES["book_file"]["name"])
        ? sha1_file($_FILES['book_file']['tmp_name']) . "-" . basename($_FILES["book_file"]["name"]) : "";
    $book->book_file = $book_file;

    // create the product
    if ($book->create()) {
        echo "<div class='alert alert-success'>Book was created.</div>";
        // uploadPhoto() method will return an error message, if any.
        echo $book->uploadPhoto();
    }

    // if unable to create the product, tell the user
    else {
        echo "<div class='alert alert-danger'>Unable to create book.</div>";
    }
}
?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-photo icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Add book
                <div class="page-title-subheading">This is a page create new book.
                </div>
            </div>
        </div>
        <div class="page-title-actions">

            <div class="d-inline-block dropdown">
                <a type="button" class="btn-shadow btn btn-info" href="../book/books.php">
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
            <div class="card-body">
                <h5 class="card-title"></h5>
                <form method="POST" action="" enctype="multipart/form-data">
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
                                <input name="title" id="title" placeholder="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label class="">ISBN</label>
                                <input name="ISBN" id="ISBN" placeholder="" type="text" class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label class="">Author</label>
                                <?php
                                $b = new database();
                                $author = new Author($db);
                                $stmt = $author->readAll();
                                ?>
                                <select class="form-control" name="author_id" id="author_id">
                                    <option value="" selected disabled>Choice Author</option>
                                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <option value="<?= $row['id'] ?>"> <?= $row['title'] ?> </option>
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
                                        <option value="<?= $row['id'] ?>"> <?= $row['title'] ?> </option>
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
                                        <option value="<?= $row['id'] ?>"> <?= $row['title'] ?> </option>
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
                                    <?php for ($year = intval(date('Y')) - 10; $year <= intval(date('Y')); $year++) { ?>
                                        <option value="<?= $year ?>"> <?= $year ?> </option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label class="">Pages</label>
                                <input name="page" id="page" placeholder="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label class="">Price</label>
                                <input name="price" id="price" placeholder="" type="text" class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="position-relative form-group">
                        <label class="">Detail</label>
                        <textarea rows="5" cols="20" name="detail" id="detail" placeholder="" type="text" class="form-control"></textarea>

                    </div>
                    <div class="position-relative form-group">
                        <label class="">Image</label><br>
                        <div style="margin-bottom: 8px"><img id="book_photo" src="<?= 'images/empty_img.png' ?>" width="180" height="200" alt=""></div>
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

                    <input type="submit" class="btn btn-dark" name="submit" value="Save Ebook">
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include("../inc/footer.php");

?>