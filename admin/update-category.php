
<?php include('./partials/menu.php'); ?>

    <div class="container">
        <h1 class="alert alert-warning display-3 text-center">Modifier la catégorie</h1>

    <?php 
        ob_start();
                if(isset($_GET['id']))
                {
                    $id     = $_GET['id'];    
                    $query  = "SELECT * FROM tbl_category WHERE id = '$id'";
                    $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
                    $count  = mysqli_num_rows($result);
                        
                    if($count == 1)
                    {
                        $row = mysqli_fetch_assoc($result);

                        $title         = $row['title'];                   
                        $current_image = $row['image_name'];
                        $featured      = $row['featured'];
                        $active        = $row['active'];
                    }
                    else
                    {
                        $_SESSION['category_not_found'] = "<div class='alert alert-secondary text-center'>Catégorie introuvable.</div>";
                        header("location:". SITEURL ."admin/manage-category.php");
                    } 
                }
                else
                {
                    header("location:". SITEURL ."admin/manage-category.php");
                }
                ?>

        <form method="POST" enctype="multipart/form-data">       
            <table class="table table-hover">
                <tr>
                    <td>Titre :</td>
                    <td><input type="text" name="title" value="<?= $title; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Image actuelle :</td>
                    <td>
                                <?php 
                                if($current_image != "")
                                {
                                ?>    
                                    <img src="<?= SITEURL; ?>img/categorie/<?= $current_image; ?>" width="35%" alt="<?= $title; ?>">
                                <?php
                                }
                                else
                                {
                                        echo("<img src='../img/imgpardefaut/indisponible_image.jpg' width='35%' alt='Pas d'image'>");
                                }
                                ?>
                    </td>
                </tr>
                <tr>
                    <td>Nouveau image :</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Traité :</td>
                    <td>
                        <input type="radio" <?php if($featured == "oui"){echo ("checked");} ?> name="featured" value="oui" class="form-check-input"> Oui
                                
                        <input type="radio" <?php if($featured == "non"){echo ("checked");} ?> name="featured" value="non" class="form-check-input ml-5">
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Non
                    </td>
                </tr>
                <tr>
                    <td>Active :</td>
                    <td>
                        <input type="radio" <?php if($active == "oui"){echo ("checked");} ?> name="active" value="oui" class="form-check-input"> Oui
                                
                        <input type="radio" <?php if($active == "non"){echo ("checked");} ?> name="active" value="non" class="form-check-input ml-5">
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Non
                    </td>
                </tr>
                <tr class="text-right">
                    <td colspan="2">
                        <input type="hidden" name="current_name" value="<?= $current_image; ?>">
                            
                        <input type="hidden" name="id" value="<?= $id; ?>">
                            
                        <input type="submit" name="submit" value="Modifier" class="btn btn-warning mt-4">
                    </td>
                </tr>
            </table>
        </form>             
    </div>

        <?php 
            if(isset($_POST['submit']))
            {
                $id             = htmlspecialchars($_POST['id']);
                $title          = htmlspecialchars($_POST['title']);
                $current_image  = htmlspecialchars($_POST['current_image']);
                $featured       = htmlspecialchars($_POST['featured']);
                $active         = htmlspecialchars($_POST['active']);
                
                if(isset($_FILES['image']['name']))
                {
                    $image_name  = $_FILES['image']['name'];
                    
                    if ($image_name != "") 
                    {
                        $tmp         = explode('.', $image_name);   
                        $ext         = end($tmp);
                        $image_name  = "Nom_Catégorie_" .rand(000,999). '.' . $ext;
                        $source_path = $_FILES['image']['tmp_name'];
                        $des         = "./../img/categorie/" . $image_name;
                        $upload      = move_uploaded_file($source_path,$des);

                        if($upload == FALSE)
                        {
                            $_SESSION['edit'] = "<div class='alert alert-secondary'>L'image n'a pas modifié,quelque chose incorrect.</div>";
                            header("location:".SITEURL."admin/manage-category.php"); 
                            die();      
                        }
                        if ($current_image != "") 
                        {
                            
                            $remove_path = "./../img/categorie/" . $current_image;
                            $remove      = unlink($remove_path);
                            if($remove == FALSE)
                            {
                                $_SESSION['failed_remove'] = "<div class='alert alert-secondary'>Image actuel n'a pas supprimé, qulque chose incorrect.</div>";
                                header("location:" .SITEURL. "admin/manage-admin.php");
                                die();
                            }
                        }
                    }
                    else 
                    {
                        $image_name  = $current_image;    
                    }
                }
                else 
                {
                    $image_name  = $current_image ;    
                }
                
                $query     = "UPDATE tbl_category SET
                title      = '$title',
                image_name = '$image_name',
                featured   = '$featured',
                active     = '$active' WHERE id = '$id'";
                
                $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
                
                if($result == TRUE)
                {
                    $_SESSION['update_category'] = "<div class='alert alert-warning text-center display-4'>Catégorie a été modifier avec succèss.</div>";
                    header("location:" .SITEURL. "admin/manage-category.php");
                }
                else
                {
                    $_SESSION['update_category'] = "<div class='alert alert-secondary text-center'>La catégorie n'a pas modifié, qulque chose incorrect.</div>";
                    header("location:" .SITEURL. "admin/manage-category.php");
                    ob_end_flush();
                }
            }
        ?>

<?php include('./partials/footer.php'); ?>