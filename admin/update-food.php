
<?php include('./partials/menu.php'); ?>

    <div class="container">
        <h1 class="alert alert-warning display-3 text-center">Modifier le plat</h1>
        <?php     
            ob_start();
            if(isset($_GET['id']))
            {
                $id     =  $_GET['id'];
                $query  = "SELECT * FROM tbl_food WHERE id='$id'";
                $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
                $row    = mysqli_fetch_assoc($result);

                $title            = $row['title'];
                $description      = $row['description'];
                $price            = $row['price'];
                $current_image    = $row['image_name'];
                $current_category = $row['category_id'];
                $featured         = $row['featured'];
                $active           = $row['active'];
            }
            else
            {
                header("location:" .SITEURL. "admin/manage-food.php");
            }
        ?>

        <form method="POST" enctype="multipart/form-data">
            <table class="table table-hover">
                <tr>
                    <td>
                        Titre :
                    </td>
                    <td>
                        <input type="text" name="title" class="form-control" value="<?= $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Description :
                    </td>
                    <td>
                        <textarea type="text" name="description" class="form-control"><?= $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        Prix :
                    </td>
                    <td>
                        <input type="number" name="price" class="form-control" value="<?= $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Image actuelle :
                    </td>
                    <td>
                        <?php 
                            if($current_image == "")
                            {
                                echo("<img src = './../img/imgpardefaut/indisponible_image.jpg' width='20%' alt='Pas d'image'>");
                            }
                            else 
                            {
                            ?>

                                <img src="<?= SITEURL; ?>img/plat/<?= $current_image; ?>" alt="<?= $title; ?>" width="20%">

                            <?php     
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Nouveau image :
                    </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>
                        Catégorie :
                    </td>
                    <td>
                        <select name="category"  class="form-control">
                        <?php 
                            $query  = "SELECT * FROM tbl_category WHERE active  = 'oui'";
                            $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
                            $count  = mysqli_num_rows($result);

                            if($count > 0)
                            {
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                    $category_title = $row['title'];
                                    $category_id    = $row['id'];
                                    ?>

                                    <option  <?php if($current_category == $category_id) { echo "selected"; } ?> value="<?= $category_id; ?>">
                                        <?= $category_title; ?>
                                    </option>
                                    <?php
                                }
                            }
                            else
                            {
                                echo("<option value='0'>Aucun catégorie</option>");
                            }
                        ?>
                            <option value="-1">Selectionner la catégorie</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Traité :
                    </td>
                    <td>
                        <input type="radio"  <?php if($active == 'oui') { echo 'checked'; } ?> name="featured" class="form-check-input" value="oui"> Oui
                        <input type="radio"  <?php if($active == 'non') { echo 'checked'; } ?> name="featured" class="form-check-input ml-5" value="non"> 
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Non
                    </td>
                </tr>
                <tr>
                    <td>
                        Active :
                    </td>
                    <td>
                        <input type="radio" <?php if($active == 'oui') { echo 'checked'; } ?> name="active" class="form-check-input" value="oui"> Oui
                        <input type="radio" <?php if($active == 'non') { echo 'checked'; } ?> name="active" class="form-check-input ml-5" value="non">
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Non
                    </td>
                </tr>

                <tr class="text-right">
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <input type="hidden" name="current_image" value="<?= $current_image; ?>">

                        <input type="submit" class="btn btn-warning" name="submit">
                    </td>
                </tr>

            </table>

        </form>

        <?php 
        if(isset($_POST['submit']))
        {
            $id            = htmlspecialchars($_POST['id']);
            $title         = htmlspecialchars($_POST['title']);
            $description   = htmlspecialchars($_POST['description']);
            $description   = str_replace("'","\'",$description);
            $price         = htmlspecialchars($_POST['price']);
            $current_image = htmlspecialchars($_POST['current_image']);
            $category      = htmlspecialchars($_POST['category']);
            $featured      = htmlspecialchars($_POST['featured']);
            $active        = htmlspecialchars($_POST['active']);              

            if(isset($_FILES['image']['name']))
            {
                $image_name = $_FILES['image']['name'];

                if($image_name != "")
                {
                    $tmp        = explode('.', $image_name);
                    $ext        = end($tmp);
                    $image_name = "Nom_Plat_" . rand(0000,9999) . '.' . $ext;
                    $src        = $_FILES['image']['tmp_name'];
                    $des        = "./../img/plat/" . $image_name;
                    $upload     = move_uploaded_file($src,$des);

                    if($upload == FALSE)
                    {
                        $_SESSION['upload'] = "<div class='alert alert-secondary text-center'>L'image n'a pas modifié, quelque chose incorrect.</div>";
                        header("location:" .SITEURL. "admin/manage-food.php");
                        die();
                    }
                    if($current_image != "")
                    {
                        $remove_path = "../img/plat/" . $current_image;
                        $remove      = unlink($remove_path);

                        if($remove == FALSE)
                        {
                            $_SESSION['remove_failed'] = "<div class='alert alert-secondary'>L'image n'a pas supprimer, quelque chose incorrect.</div>" ;
                            header("location:" .SITEURL. "admin/manage-food.php");
                            die();
                        }
                    }
                }
                else 
                {
                    $image_name = $current_image;
                }
            }

                else
                {
                    $image_name = $current_image;
                }    

                $query = " UPDATE tbl_food SET
                
                title = '$title',
                
                description = '$description',
                
                price = '$price',
                
                image_name = '$image_name',
                
                category_id = '$category', 
                
                featured = '$featured',
                
                active = '$active' 
                
                WHERE id = '$id'";

                $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
                
                if($result == TRUE)
                {
                    $_SESSION['update'] = "<div class='alert alert-warning text-center display-4'>Le plat a été modifier.</div>";
                    header("location:" .SITEURL. "admin/manage-food.php");
                }
                else 
                {
                    $_SESSION['update'] = "<div class='alert alert-danger text-center'>Le plat n'a pas modifier, quelque chose incorrect.</div>";
                    header("location:" .SITEURL. "admin/manage-food.php");

                    ob_end_flush();
                }
        }    
        ?>

    </div>

<?php include('./partials/footer.php'); ?>
