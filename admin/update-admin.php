
<?php include('./partials/menu.php'); ?>
   
    <div class="container">
        <h1 class="alert alert-warning display-3 text-center">Mise à jour l'admin</h1>
            <br>
            <?php 
                $id     = $_GET['id'];
                $query  = "SELECT * FROM tbl_admin WHERE id = '$id'";
                $result = mysqli_query($conn,$query) or die (mysqli_error($conn));

                if($result == TRUE)
                {
                    $count = mysqli_num_rows($result);

                    if($count == 1)
                    {
                        $rows = mysqli_fetch_assoc($result);
                        $full_name = $rows['full_name'];
                        $username  = $rows['username'];
                       
                    }
                    else
                    {
                        header("location:".SITEURL."admin/manage-admin.php");
                    }
                }
            ?>        
            <form method="POST">
                <table class="table">
                    <tr>
                        <td>Nom complet :</td>
                        <td>
                            <input type="text" name="full_name" class="form-control" value="<?= $full_name;?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Nom d'utilisateur :</td>
                        <td>
                            <input type="text" name="username" class="form-control" value="<?= $username;?>">
                        </td>
                    </tr>
                    <tr class="text-right">
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?= $id;?>">
                            <input type="submit" name="submit" value="Editer" class="btn btn-warning mt-4">
                        </td>
                    </tr>
                </table>
            </form>
    </div>

<?php 

    if(isset($_POST['submit']))
    {
        extract($_POST);

            $query  = "UPDATE tbl_admin SET full_name = '$full_name', username = '$username' WHERE id = '$id' " ; 
            $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
        
            if ($result == TRUE)
            {
                $_SESSION['update_admin'] = "<div class='alert alert-warning text-center display-4'>Admin a été editer avec succèss.</div>";   
                header("location:" .SITEURL. "admin/manage-admin.php");
            }
            else
            {
                $_SESSION['error_updated'] = "<div class='alert alert-secondary text-center'>Admin n'a pas edité, quelque chose incorrect.</div>";
                header("location:" .SITEURL. "admin/manage-admin.php");
            }
    }

?>

    <?php include('./partials/footer.php'); ?>