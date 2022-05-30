
<?php include('./partials/menu.php'); ?>

    <h1 class="alert alert-info display-3 text-center">Gestion des plats</h1>
    <div class="container">

<?php
    if(isset($_SESSION['add_plat']))
    {
        echo ($_SESSION['add_plat']);
        unset($_SESSION['add_plat']);
    }

    if(isset($_SESSION['delete_plat_error']))
    {
        echo ($_SESSION['delete_plat_error']);
        unset($_SESSION['delete_plat_error']);
    }

    if(isset($_SESSION['delete_plat_success']))
    {
        echo ($_SESSION['delete_plat_success']);
        unset($_SESSION['delete_plat_success']);
    }

    if(isset($_SESSION['delete_plat_error_img']))
    {
        echo ($_SESSION['delete_plat_error_img']);
        unset($_SESSION['delete_plat_error_img']);
    }

    if(isset($_SESSION['update']))
    {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }
?>

            <table class="table table-hover">
                <tr class="text-right">
                    <td colspan="8">
                    <a href="<?= SITEURL?>admin/add-food.php" class="btn btn-success">Ajouter un plat</a>
                    </td>
                </tr>
                <tr>
                    <th>Numéro de série :</th>
                    <th>Title :</th>
                    <th>Price  :</th>
                    <th>Image :</th>
                    <th>Traité :</th>
                    <th>Active :</th>
                    <th>Actions :</th>
                </tr>
            <?php 
            $query  = "SELECT * FROM tbl_food";
            $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
            $count  = mysqli_num_rows($result);
            
            if($count > 0)
            {
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
                        $id         = $row['id'];
                        $title      = $row['title'];
                        $price      = $row['price'];
                        $image_name = $row['image_name'];
                        $featured   = $row['featured'];
                        $active     = $row['active'];
                    ?>
                    <tr>
                            <td><?= $id; ?></td>
                            <td><?= $title; ?></td>
                            <td><?= $price . '$'; ?></td>
                            <td><?php
                                if($image_name == "")
                                {
                                    echo("<img src='./../img/imgpardefaut/indisponible_image.jpg' width='20%' alt='Pas d'image' class='mg rounded-circle'>");
                                }
                                else 
                                {
                                    ?>
                                    <img src="<?= SITEURL; ?>img/plat/<?= $image_name; ?>" alt="<?= $title; ?>" width="20%" class="img rounded-circle">
                                    <?php    
                                }
                                ?></td>     
                            <td><?= $featured; ?></td>
                            <td><?= $active; ?></td>
                            <td>
                                <a href="<?= SITEURL ?>admin/update-food.php?id=<?= $id; ?>" class="btn btn-warning">Editer</a>
                                <a href="<?= SITEURL ?>admin/delete-food.php?id=<?= $id; ?>&image_name=<?= $image_name; ?>" class="btn btn-danger mt-2" onclick = "return confirm('Vous etes sure de supprimer cet plat?')">Supprimer</a>
                            </td>
                        </tr>   
            <?php
                    }
            }
            else
            {
                echo("<td colspan = '7' class='alert alert-dark display-4 text-center'>Aucun plat a été ajouter.</td>");
            }
            ?>                    
            </table>
        </div>

<?php include('./partials/footer.php'); ?>