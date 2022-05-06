<?php
   include("../inc/header.php");
    // include 'database.php';
    include(__DIR__ . "/../../config/database.php");
    include(__DIR__ . "/../../objects/book.php");

    $database = new Database();
    $db = $database->getConnection();
    
?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-notebook icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Books
                <div class="page-title-subheading">This is a page for management book.
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            
            <div class="d-inline-block dropdown">
                <a type="button" class="btn-shadow btn btn-info" href="../book/add_book.php" >
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
                            <table class="table" id="tbl_book">
                                <thead>
                                    <tr>
                                        <th scope="col" width = "10%">Id</th>
                                        <th scope="col" width = "15%">Cover</th>
                                        <th scope="col" width = "20%">Title</th>
                                        <th scope="col" width = "20%">File Revew</th>
                                        <th scope="col" width = "20%">File</th>
                                        <th scope="col" width = "15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                       
                                       $database = new Database();
                                       $db = $database->getConnection();
                                       $book = new Book($db);
                                       $stmt = $book->readAll();
                                       
                                    ?>
                                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                                        $id = $row['id']; ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><img src="<?= '../../upload/images/book/'.$row['image'] ?>" width="70" height="120"/> </td>
                                
                                            <td><?php echo $row['title']; ?></td>
                                            
                                            <td><?php echo $row['file']; ?> <a href="<?= '../../upload/file/book_file_review/'.$row['book_file_review'] ?>">View</a></td>
                                            <td><?php echo $row['file']; ?> <a href="<?= '../../upload/file/book_file/'.$row['book_file'] ?>">View</a></td>
                                            <td>
                                                <form method="POST" action="queries/delete_book.php">
                                                    <a href="edit_book.php?id=<?php echo $row['id']; ?>" type="button" class="btn btn-primary btn-sm">Edit</a>
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
       $('#tbl_book').DataTable();
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
                    $.post('delete_book.php', {
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
