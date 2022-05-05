<?php
   include("../inc/header.php");
    // include 'database.php';
    include(__DIR__ . "/../../config/database.php");
    include(__DIR__ . "/../../objects/category.php");
?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
            <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Categories
                <div class="page-title-subheading">This is a page for management categories.
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            
            <div class="d-inline-block dropdown">
                <a type="button" class="btn-shadow btn btn-info" href="../category/add_category.php" >
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-plus fa-w-20"></i>
                    </span>
                    Add
                </a>
                
            </div>
        </div>    
    </div>
</div>

            <div class="content-wrap">
                <div class="container-fluid">
                <div class="main-card mb-3 card">
                 <div class="card-body"><h5 class="card-title"></h5>
                <div class="row">
                        <div class="col-md-12 p-3">
                            <table class="table" id="tbl_category">
                                <thead>
                                    <tr>
                                        <th scope="col" width = "10%">Id</th>
                                        <th scope="col" width = "35%">Title</th>
                                        <th scope="col" width = "35%">Image</th>
                                        <th scope="col" width = "10%">Status</th>
                                        <th scope="col" width = "10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                       
                                       $database = new Database();
                                       $db = $database->getConnection();
                                       $category = new Category($db);
                                       $stmt = $category->readAll();
                                       
                                    ?>
                                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                                        $id = $row['id']; ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><img src="<?= '../../upload/images/category/'.$row['image'] ?>" width="170" height="70"/> </td>
                                            <td><?php echo $row['status']; ?></td>
                                            <td>
                                                <form method="POST" action="queries/delete_category.php">
                                                    <a href="edit_category.php?id=<?php echo $row['id']; ?>" type="button" class="btn btn-primary btn-sm">Edit</a>
                                                    <a delete-id='<?= $id ?>' class='btn btn-danger text-white btn-sm delete-object' type="button">Delete</a>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
                </div>
            </div>

<?php
   include("../inc/footer.php");
?>

<script>
    $(document).ready(function() {
       $('#tbl_category').DataTable();
    } );

// JavaScript for deleting product
$(document).on('click', '.delete-object', function(){
  
    var id = $(this).attr('delete-id');
    console.log("id", id);
    Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('delete_category.php', {
                    object_id: id
                }, function(data){
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    ).then((value) => {
                        location.reload();
                    });
                   
                }).fail(function() {
                    alert('Unable to delete.');
                });
                   
        }
    })

    return false;
});

</script>                   
