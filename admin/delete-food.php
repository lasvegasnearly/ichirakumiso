
<?php
    include("./../config/constants.php");

    if(isset($_GET['id'])  && isset($_GET['image_name']))
    {
        $id         = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != "")
        {
            $des    = "../img/plat/" . $image_name;
            $remove = unlink($des);

            if($remove == FALSE)
            {
                $_SESSION['delete_plat_error_img'] = "<div class='alert alert-secondary text-center'>L'image na pas supprimé, quelque chose incorrect.</div>";
                header("location:" .SITEURL. "admin/manage-food.php");
                
            }
        }
        
        $query  = "DELETE FROM tbl_food WHERE id = '$id'";
        $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

        if($result == TRUE) 
        {
            $_SESSION['delete_plat_success'] = "<div class='alert alert-danger text-center display-4'>Le plat a été supprimer avec succèss.</div>";    
            header("location:" .SITEURL. "admin/manage-food.php");
        }
        else 
        {
        $_SESSION['delete_plat_error'] = "<div class='alert alert-secondary text-center'>Le plat n'a pas supprimé, quelque chose incorrect.</div>";
        header("location:" .SITEURL. "admin/manage-food.php");    
        }
    } 
?>