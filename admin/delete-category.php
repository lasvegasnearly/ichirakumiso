
<?php 
    include('./../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        $id         = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != "")
        {

            $des    = "./../img/categorie/" . $image_name;
            $remove = unlink($des);

            if($remove == FALSE)
            {
                $_SESSION['remove_img'] = "<div class='alert alert-secondary'>L'image n'a pas supprimé, quelque chose incorrect.</div>";
                header("location:" .SITEURL. "admin/manage-category.php");
                die();
            }
        }

        $query  = "DELETE FROM tbl_category WHERE id = '$id' AND image_name = '$image_name'";
        $result = mysqli_query($conn, $query) or die (mysqli_error($conn));

        if($result == TRUE)
        {
            $_SESSION['delete'] = "<div class='alert alert-danger display-4 text-center'>Catégorie a été supprimer avec success.</div>";
            header("location:".SITEURL."admin/manage-category.php");

        }
    }
    else
    {
        $_SESSION['delete'] = "<div class='alert alert-secondary text-center'>Catégorie n'a pas supprimé, quelque chose incorrect.</div>";  
        header("location:".SITEURL."admin/manage-category.php");

        }
?>