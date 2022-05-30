
<?php 
    include('./../config/constants.php');
    $id     = $_GET['id'];
    $query  = "DELETE FROM tbl_admin WHERE id= '$id'";
    $result = mysqli_query($conn, $query) or die (mysqli_error($conn));

    if($result == TRUE)
    {
        $_SESSION['delete_admin'] = "<div class='alert alert-danger display-4 text-center'>Admin a été supprimer avec succèss.</div>";
        header("location:".SITEURL."admin/manage-admin.php");
    }
    else
    {
        $_SESSION['delete_admin'] = "<div class='alert alert-secondary text-secondary'>Admin n'a pas supprimé, quelque chose incorrect.</div>";
        header("location:".SITEURL."admin/manage-admin.php");
    }
?>