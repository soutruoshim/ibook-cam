<?php
   include("../inc/header.php");
   include(__DIR__ . "/../../config/database.php");
   include(__DIR__ . "/../../objects/slide.php");

   $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

   // get database connection
    $database = new Database();
    $db = $database->getConnection();
    // prepare objects
    $slide = new Slide($db);
    $slide->id = $id;
    $slide->readOne();


    // if the form was submitted
    if($_POST){
        if(!empty($_FILES["image"]["name"])){
            $slide->title = $_POST['title'];
            $slide->status = $_POST['status'];
            $image = !empty($_FILES["image"]["name"])
            ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
            $slide->image = $image;
            // update slide
            if ($slide->update_with_file()) {
                echo "<div class='alert alert-success'>Product was updated.</div>";
                echo $slide->uploadPhoto();
            }else {
                echo "<div class='alert alert-danger'>Unable to Update product.</div>";
            }
        }else{
            $slide->title = $_POST['title'];
            $slide->status = $_POST['status'];
            // update slide
            if ($slide->update()) {
                echo "<div class='alert alert-success'>Product was updated.</div>";
            }else {
                echo "<div class='alert alert-danger'>Unable to Update product.</div>";
            }
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
            <div>Edit Slide
                <div class="page-title-subheading">This is a page edit slide.
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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post" enctype="multipart/form-data">
                <div class="position-relative form-group">
                    <label class="">Slide Title</label>
                    <input name="title" id="title" value="<?= $slide->title; ?>" placeholder="" type="text" class="form-control">
                </div>
                <div class="position-relative form-group">
                    <label class="">Image</label><br>
                    <div style="margin-bottom: 8px"><img id="slide_photo" src="../../upload/images/slide/<?= $slide->image ?>" width="100%" height="300" alt=""></div>
                    <input type="file" name="image" placeholder="Choose image" id="image" class="form-control" onchange="document.getElementById('slide_photo').src = window.URL.createObjectURL(this.files[0])">
                </div>
                <div class="position-relative form-group">
                    <label class="">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="" selected disabled>Choice Status</option>
                        <option value="active" <?= $slide->status =='active'?'selected':'' ?>>Active</option>
                        <option value="inactive" <?= $slide->status =='inactive'?'selected':'' ?>>InActive</option>
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