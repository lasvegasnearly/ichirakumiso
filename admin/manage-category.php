
<?php include('./partials/menu.php'); ?>

    <h1 class="alert alert-info display-3 text-center">Gestionnaire des catégories</h1>
    <div class="container">

<?php
    if(isset($_SESSION['add'])){

        echo($_SESSION['add']);
        unset($_SESSION['add']);
    
    }     

    if(isset($_SESSION['remove_img'])){

        echo($_SESSION['remove_img']);
        unset($_SESSION['remove_img']);

    }

    if(isset($_SESSION['delete'])){

        echo($_SESSION['delete']);
        unset($_SESSION['delete']);

    }

    if(isset($_SESSION['category_not_found'])){

        echo($_SESSION['category_not_found']);
        unset($_SESSION['category_not_found']);
    }

    if(isset($_SESSION['update_category'])){
        echo($_SESSION['update_category']);
        unset($_SESSION['update_category']);
    }

    if(isset($_SESSION['edit'])){
        echo($_SESSION['edit']);
        unset($_SESSION['edit']);
    }

    if(isset($_SESSION['failed_remove'])){
        echo($_SESSION['failed_remove']);
        unset($_SESSION['failed_remove']);
    }
?>

            <table class="table table-hover">
                <tr class="text-right">
                    <td  colspan="7">
                        <a href="<?= SITEURL ?>admin/add-category.php" class="btn btn-success">Ajouter un catégorie</a>
                    </td>
                </tr>
                <tr>
                    <th>Numéro de série:</th>
                    <th>Titre :</th>
                    <th>Image :</th>
                    <th>Traité :</th>
                    <th>Active :</th>
                    <th>Actions :</th>
                </tr>
<?php 
    $query  = "SELECT * FROM tbl_category";
    $result = mysqli_query($conn, $query) or die (mysqli_error($conn));
    $count  = mysqli_num_rows($result);

    if($count > 0)
    {
        while ($row = mysqli_fetch_assoc($result)) 
        {
            $id         = $row['id'];
            $title      = $row['title'];
            $image_name = $row['image_name'];
            $featured   = $row['featured'];
            $active     = $row['active'];
?>
                <tr>
                    <td><?= $id; ?></td>
                    <td><?= $title; ?></td>
                    <td>
<?php 

    if($image_name != "")
    {

?>
    <img src="<?= SITEURL; ?>img/categorie/<?= $image_name ?>" alt="<?= $title; ?>" width="20%" class="img rounded-circle">

<?php
    }
    else
    {
        echo("<img src='./../img/imgpardefaut/indisponible_image.jpg' width='20%' alt='Pas d'image' class='img rounded-circle'>");
    }

?>
                    </td>
                    <td>
                        <?= $featured; ?>
                    </td>
                    <td>
                        <?= $active; ?>
                    </td>
                    <td>
                        <a href="<?=SITEURL?>admin/update-category.php?id=<?=$row['id']?>" class="btn btn-warning">Modifier</a>
                        
                        <a href="<?=SITEURL?>admin/delete-category.php?id=<?=$row['id']?>&image_name=<?=$image_name?>" class="btn btn-danger btn-sm mt-3" onclick = "return confirm('Vous etes sure de supprimer cette catégorie?')">Supprimer catégorie</a>
                    </td>
                </tr>
<?php
        }
    }
    else
    {   
?>
                <tr>
                    <td colspan="7" class="alert alert-dark display-4 text-center">Aucun catégorie a été ajouter.</td>
                </tr>
<?php
    }
?>   

            </table>
    </div>
    
<?php include('./partials/footer.php'); ?>