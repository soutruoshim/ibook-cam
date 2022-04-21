<?php
   include("../inc/header.php");
   include(__DIR__ . "/../../config/database.php");
   if(isset($_GET['id'])){
    $id = $_GET['id'];
   
    $b = new database();
    $b->select("slides","*","id='$id'");
    $result = $b->sql;

    $row = mysqli_fetch_assoc($result);
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
            <form method="POST" action="queries/update_slide.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="position-relative form-group">
                    <label class="">Slide Title</label>
                    <input name="title" id="title" value="<?php if(isset($row)) { echo $row['title']; } ?>" placeholder="" type="text" class="form-control">
                </div>
                <div class="position-relative form-group">
                    <label class="">Image</label><br>
                    <div style="margin-bottom: 8px"><img id="slide_photo" src="<?php if(isset($row)) { echo WEB_URL.'/images/slide/'.$row['image']; } ?>" width="100%" height="300" alt=""></div>
                    <input type="file" name="image" placeholder="Choose image" id="image" class="form-control" onchange="document.getElementById('slide_photo').src = window.URL.createObjectURL(this.files[0])">
                </div>
                <div class="position-relative form-group">
                    <label class="">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="" selected disabled>Choice Status</option>
                        <option value="active" <?= isset($row) && $row['status']=='active'?'selected':'' ?>>Active</option>
                        <option value="inactive" <?= isset($row) && $row['status']=='inactive'?'selected':'' ?>>InActive</option>
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