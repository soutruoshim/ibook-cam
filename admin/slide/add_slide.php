<?php
   include("../inc/header.php");
   // include 'database.php';
   include(__DIR__ . "/../../config/database.php");
   include(__DIR__ . "/../../objects/slide.php");

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // pass connection to objects
    $slide = new Slide($db);


    if ($_POST) {
        // set slide property values
        $slide->title = $_POST['title'];
        $slide->status = $_POST['status'];
        $image=!empty($_FILES["image"]["name"])
        ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
        $slide->image = $image;
        // create the product
        if ($slide->create()) {
            echo "<div class='alert alert-success'>Product was created.</div>";
            // try to upload the submitted file
            // uploadPhoto() method will return an error message, if any.
            echo $slide->uploadPhoto();
        }
    
        // if unable to create the product, tell the user
        else {
            echo "<div class='alert alert-danger'>Unable to create product.</div>";
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
            <div>Add Slide
                <div class="page-title-subheading">This is a page create new slide.
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            
            <div class="d-inline-block dropdown">
                <a type="button" class="btn-shadow btn btn-info" href="../slide/slide.php" >
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
    <div class="col-md-8">
        <div class="main-card mb-3 card">
        <div class="card-body"><h5 class="card-title"></h5>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <div class="position-relative form-group">
                    <label class="">Slide Title</label>
                    <input name="title" id="title" placeholder="" type="text" class="form-control">
                </div>
                <div class="position-relative form-group">
                    <label class="">Image</label><br>
                    <div style="margin-bottom: 8px"><img id="slide_photo" src="<?= '../../upload/images/empty-image-back.jpg' ?>" width="100%" height="300" alt=""></div>
                    <input type="file" name="image" placeholder="Choose image" id="image" class="form-control" onchange="document.getElementById('slide_photo').src = window.URL.createObjectURL(this.files[0])">
                </div>
                <div class="position-relative form-group">
                    <label class="">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="" selected disabled>Choice Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">InActive</option>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="Save Slide">
            </form>
        </div>
        </div>
    </div>
</div>
<?php
   include("../inc/footer.php");
   
?>
                   
