
    <?php include("../config/constants.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./../img/ichirakuMiso-elements/logo-Recovered0.png">
    <link rel="stylesheet" href="../style/bootstrap_fichier/bootstrap.min.css">
    <title>Conncter | ICHIRAKUMISO</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <h3 class="display-3 text-center">ICHIRAKUMISO - Employées</h3>
    <div class="container w-50 text-center">
        <form method="POST">
            <fieldset>
                <legend>
                    <img src="./../img/ichirakuMiso-elements/logo-Recovered0.png"  alt="MchirakuMiso" style="width:35%">
                </legend>
                    <p class="display-4 text-center">Fière de nos employées</p> 

<?php 
    if(isset($_SESSION['login']))
    {
        echo ($_SESSION['login']);
        unset($_SESSION['login']);
    }
?>
                <label class="form-label">Nom d'utilisateur :</label>
                <input type="text" class="form-control" name="username">
                <br>
                <label class="form-label">Mot de passe :</label>
                <input type="password" class="form-control" name="password">
                <input type="submit" name="submit" class="btn btn-success my-4" value="Se connecter">
                <br>
            </fieldset>
        </form> 
    </div>

<?php 
    if(isset($_POST['submit']))
    {
        extract($_POST);
        $password = md5($password);
        $query    = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";
        $result   = mysqli_query($conn,$query) or die (mysqli_error($conn));
        $count    = mysqli_num_rows($result);

        if($count == 1) 
        {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user']  = $username; 
    
            session_start();        
            $_SESSION['id'] = $row['id'] ;
            $_SESSION['username'] = $row['usename'];
            
            $_SESSION['login'] = "<div class='alert alert-success text-center'>Bienvenue, nous ésperons passer une bonne journée.</div>";
            header('location:'.SITEURL.'admin/');
        }
        else 
        {
            $_SESSION['login'] = "<div class='alert alert-danger text-center'>E-mail ou mot de passe incorrect, ressayez une autre fois.</div>";
            
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>

<?php include('./partials/footer.php'); ?>