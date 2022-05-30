
<?php include('./partials/menu.php'); ?>

<div class="container">
    <h1 class="alert alert-info display-3 text-center">Ajouter un admin</h1>

    <?php
        if(isset($_SESSION['add_admin']))
        {
            echo  $_SESSION['add_admin'];
            unset($_SESSION['add_admin']);
        }
    ?>

    <form method="POST">
        <table class="table">
        <legend class="display mb-4">Formulaire d'ajoutation :</legend>
            <tr>
                <td>Nom complet :</td>
                <td><input type="text" name="full_name" class="form-control" required></td>
            </tr>
            <tr>
                <td>Nom d'utilisateur :</td>
                <td><input type="text" name="username" class="form-control" required></td>
            </tr>
            <tr>
                <td>Mot de passe :</td>
                <td><input type="password" name="password" class="form-control" required></td>
            </tr>
            <tr class="text-right">
                <td colspan="2">
                    <input type="submit" name="submit" value="Ajouter" class="btn btn-success mt-4">
                </td>
            </tr>
        </table>
    </form>


    </div>


<?php 
    if(isset($_POST['submit']))
    {
            extract($_POST);
            $password = md5($_POST['password']);
            $query    = "INSERT INTO tbl_admin VALUES(null,'$full_name','$username','$password')";
            $result   = mysqli_query($conn,$query) or die(mysqli_error($conn));
            
            if($result == TRUE)
            {       
                
                $_SESSION['add_admin'] = "<div class='alert alert-success display-4 text-center'>Admin a été ajouter avec sucèss.</div>";
                header("location:".SITEURL.'admin/manage-admin.php');
            }    
            else
            {
                    $_SESSION['add_admin'] = "<div class='alert alert-secondary display-4 text-center'>Admin n'a pas ajouté, quelque chose incorrect.</div>";
                    header("location:".SITEURL.'admin/add-admin.php');
            }    
    } 
?>

<?php include('./partials/footer.php'); ?>