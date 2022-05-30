
<?php include('./partials/menu.php'); ?>

<?php 
    ob_start();

    if(isset($_SESSION['error_upload_dish']))
    {
        echo ($_SESSION['error_upload_dish']);
        unset($_SESSION['error_upload_dish']);
    }
?>

    <div class="container">
        <h1 class="container alert alert-info display-3 text-center">Ajouter un plat</h1>
        <form method="POST" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td>Titre :</td>
                        <td>
                            <input type="text" class="form-control" name="title" required>
                        </td>
                </tr>
                <tr>
                    <td>Description :</td>
                        <td>
                            <textarea name="description" class="form-control" cols="30" rows="10" required></textarea>
                        </td>
                </tr>
                <tr>
                    <td>Prix :</td>
                        <td>
                            <input type="number" class="form-control" name="price">
                        </td>
                </tr>
                <tr>
                    <td>Image :</td>
                    <td>
                        <input type="file" name="image" required>
                    </td>
                </tr>
                <tr>
                    <td>Catégorie :</td>
                    <td>
                        <select class="form-control" name="category">
                            <option value="-1">Selectionner la catégorie</option>
                            <?php  
                                $query  = "SELECT * FROM tbl_category WHERE active = 'oui'";
                                $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
                                $count  = mysqli_num_rows($result);

                                if($count > 0)
                                {
                                    while ($rows = mysqli_fetch_assoc($result))
                                    {
                                        $id    = $rows['id'];
                                        $title = $rows['title'];
                            ?>

                            <option value="<?= $id ; ?>"><?= $title; ?></option>
                                <?php
                                    }
                                }
                                else 
                                {
                                ?>

                            <option value="0">Catégorie indisponible</option>

                                <?php    
                                }
                                ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Traité :</td>
                    <td>
                                <input type="radio" value="oui" name="featured" class="form-check-input"> Oui

                                <input type="radio" value="non" name="featured" class="form-check-input ml-5">
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Non
                    </td>
                </tr>
                <tr>
                    <td>Active :</td>
                    <td>
                                <input type="radio" value="oui" name="active" class="form-check-input"> Oui

                                <input type="radio" value="non" name="active" class="form-check-input ml-5">
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Non
                    </td>
                </tr>
                <tr class="text-right">
                    <td colspan="2">
                        <input type="submit" value="Ajouter" name="submit" class="btn btn-success mt-4">
                    </td>
                </tr>
            </table>
        </form>
    </div>

<?php 
    if(isset($_POST['submit']))
    {
        $title       = htmlspecialchars($_POST['title']);
        $description = htmlspecialchars($_POST['description']);
        $description = str_replace("'","\'",$description);
        $price       = htmlspecialchars($_POST['price']);
        $category    = htmlspecialchars($_POST['category']); 
        
        if(isset($_FILES['image']['name']))
        {
            $image_name = $_FILES['image']['name'];

            if($image_name != "")
            {
                $tmp        = explode('.', $image_name);
                $ext        = end($tmp);
                $image_name = "Plat-nom-" .rand(0000,9999).".".$ext;
                $src        = $_FILES['image']['tmp_name'];
                $des        = "./../img/plat/" .$image_name;
                $upload     = move_uploaded_file($src,$des);

                if($upload == FALSE)
                {
                    $_SESSION['error_upload_dish'] = "<div class='alert alert-secondary text-center'>L'image n'a pas envoyé, quelque chose incorrect.</div>";
                    header("location:" .SITEURL. "admin/add-food.php");
                    die();
                }
            }

        }

        else 
        {
            $image_name = "";    
        }
        
        if (isset($_POST['featured'])) 
        {
            $featured = $_POST['featured'];
        }
        else 
        {
            $featured = "non";
        }

        
        if (isset($_POST['active'])) 
        {
            $active = $_POST['active'];
        }
        else 
        {
            $active = "non";
        }
     
        $query  = "INSERT INTO tbl_food SET title = '$title',description = '$description',price = '$price', image_name = '$image_name',category_id = '$category', featured = '$featured',active = '$active' ";
        $result = mysqli_query($conn,$query) or die (mysqli_error($conn));

        if($result == TRUE)
        {
            $_SESSION['add_plat'] = "<div class='alert alert-success text-center display-4'>Le plat a été ajouter avec succèss.</div>";

            header("location:" .SITEURL. "admin/manage-food.php");
        }
        else 
        {
            $_SESSION['add_plat'] = "<div class='alert alert-secondary text-center'>Le plat n'a pas ajouté, quelque chose incorrect.</div>";

            header("location:" .SITEURL. "admin/manage-food.php");
        }
    }
    ob_end_flush();
?>

<?php include('./partials/footer.php'); ?>
