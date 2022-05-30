
<?php include('./partials/menu.php'); ?>


    <h1 class="alert alert-info display-3 text-center">Gestionnaire d'administration</h1>   
    <div class="container">
    
<?php 

    if(isset($_SESSION['add_admin']))
    {
        echo $_SESSION['add_admin'];  
        unset($_SESSION['add_admin']); 
    }
    if(isset($_SESSION['delete_admin']))
    {
        echo $_SESSION['delete_admin'];
        unset($_SESSION['delete_admin']);
    }
    if(isset($_SESSION['update_admin']))
    {
        echo $_SESSION['update_admin'];
        unset($_SESSION['update_admin']);
    }
    if(isset($_SESSION['error_updated']))
    {
        echo $_SESSION['error_updated'];
        unset($_SESSION['error_updated']);
    }

?>
            <br>
            <table class="table table-hover">
                <tr class="text-right">
                    <td colspan="4">
                    
                    <a href="add-admin.php" class="btn btn-success">Ajouter un admin</a>
                    </td>
                </tr>
                <tr>
                    <th>Numéro de série:</th>
                    <th>Nom complet :</th>
                    <th>Nom d'utilisateur :</th>
                    <th>Actions :</th>
                    <th></th>
                </tr>
<?php 
    $query  = "SELECT * FROM tbl_admin";
    $result = mysqli_query($conn, $query) or die (mysqli_error($conn));
    if($result == TRUE)
    {
        $count = mysqli_num_rows($result);

        if($count > 0)
        {
            while($rows = mysqli_fetch_assoc($result))
            {
                $id        = $rows['id'];
                $full_name = $rows['full_name'];
                $username  = $rows['username'];
?>

<tr>
    <td><?= $id ?></td>
    <td><?= $full_name ?></td>
    <td><?= $username ?></td>
    <td>
        <a href="<?= SITEURL; ?>admin/update-admin.php?id=<?= $id;?>" class="btn btn-warning">Modifier</a>
        <a href="<?= SITEURL; ?>admin/delete-admin.php?id=<?= $id;?>" class="btn btn-danger" onclick = "return confirm('Vous etes sure de supprimer l\'admin?')">Supprimer</a>
    </td>
</tr>

<?php
            }
        }
        else
        {
    
        }
    }
?>
            </table>          
    </div>
    
<?php include('./partials/footer.php'); ?>
