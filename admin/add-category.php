
<?php include("./partials/menu.php"); ?>

    <?php 
    ob_start();

    if(isset($_SESSION['add']))
    {
        echo ($_SESSION['add']);
        unset($_SESSION['add']);
    }

    if (isset($_SESSION['upload'])) 
    {
        echo ($_SESSION['upload']);
        unset($_SESSION['upload']);
    }
    ?>
    
    <div class="container">
        <h1 class="alert alert-info display-3 text-center">Ajouter un catégorie</h1>
        <form method="POST" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td>Titre :</td>
                    <td><input type="text" name="title" class="form-control" required></td>
                </tr>
                <tr>
                    <td>Traité :</td>
                    <td>
                        <input type="radio" value="oui" name="feautured" class="form-check-input"> Oui
                        <input type="radio" value="non" name="feautured" class="form-check-input ml-5">
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Non
                    </td>
                </tr>
                <tr>
                    <td>Image :</td>
                    <td><input type="file" name="image" class="mt-2 mb-2" required></td>
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
                        <input type="submit" name="submit" value="Ajouter" class="btn btn-success mt-4">
                    </td>
                </tr>
            </table>
        </form>   
    </div>

<?php
    if(isset($_POST['submit']))
    {
        $title = htmlspecialchars($_POST['title']);   
        if(isset($_POST['feautured']))
        {
            $feautured = $_POST['feautured'];
        }
        else
        {
            $feautured = "non";
        }

        if(isset($_POST['active']))
        {
            $active = $_POST['active'];
        }
        else
        {
            $active = "non";
        }

        if(isset($_FILES['image']['name']))
        {
            $image  = $_FILES['image']['name'];

            if($image != "")
            {
                $tmp         = explode('.', $image);
                $ext         = end($tmp);
                $image       = "Plat_Category_" . rand(000,999) . '.' . $ext;
                $source_path = $_FILES['image']['tmp_name'];
                $des         = "./../img/categorie/" . $image;
                $upload      = move_uploaded_file($source_path,$des);

                if($upload == FALSE)
                {
                    $_SESSION['upload'] = "<div class='alert alert-secondary text-center'>L'image n'a pas ajouté, quelque chose incorrect.</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                    die();
                }
            }
        }
        else
        {
            $image = "";
        }            

        $query  = "INSERT INTO tbl_category VALUES (null,'$title','$image','$feautured','$active')";
        $result = mysqli_query($conn, $query) or die (mysqli_error($conn));
        
        if($result == TRUE)
        {
            $_SESSION['add'] = "<div class='alert alert-success display-4 text-center'>La catégorie a été ajouter avec succcès.</div>";
            header("location:" .SITEURL. "admin/manage-category.php");
        }
        else
        {
            $_SESSION['add'] = "<div class='alert alert-secondary tzxt-center'>La catégorie n'a pas ajouté, quelque chose incorrect.</div>";
            header("location:" .SITEURL. "admin/add-category.php");
            ob_end_flush(); 
        }
    }
?>

<?php include("./partials/footer.php"); ?>