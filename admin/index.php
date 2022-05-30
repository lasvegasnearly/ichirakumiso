<?php

    session_start();

    if(isset($_SESSION['id'])){

        $username = $_SESSION['username'];

        
?>
<?php include('./partials/menu.php'); ?>

    <div class="container"> 
        <h1 class="alert alert-primary display-3 text-center">Tableau de bord</h1>

<?php 
    if (isset($_SESSION['login']))
    {
        echo  ($_SESSION['login']);
        unset ($_SESSION['login']);
    }         
?>

        <section class="row">      

            <div class="col-md-3">
                <div class="card text-light bg-primary mb-3" style="max-width: 18rem;">
                <?php 
                    $query  = "SELECT * FROM tbl_category";
                    $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
                    $count  = mysqli_num_rows($result)
                ?>
                    <div class="card-header">Catégories :</div>
                    <div class="card-body">
                        <h5 class="card-title">Nombre :</h5>
                            <p class="card-text display-2"><?= $count; ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">    
                <div class="card text-light bg-primary mb-3" style="max-width: 18rem;">
                <?php 
                    $query  = "SELECT * FROM tbl_food";
                    $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
                    $count  = mysqli_num_rows($result)
                    ?>
                    <div class="card-header">Plats :</div>        
                    <div class="card-body">
                        <h5 class="card-title">Nombre :</h5>
                        <p class="card-text display-2"><?= $count; ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">    
                <div class="card text-light bg-primary mb-3" style="max-width: 18rem;">
                    <?php 
                        $query  = "SELECT * FROM tbl_order";
                        $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
                        $count  = mysqli_num_rows($result)
                        ?>
                    <div class="card-header">Total des orders :</div>
                    <div class="card-body">
                        <h5 class="card-title">Nombre :</h5>
                        <p class="card-text display-2"><?= $count; ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">    
                <div class="card text-light bg-success mb-3" style="max-width: 18rem;">
                <?php 
                    $query         = "SELECT SUM(total) AS Total FROM tbl_order WHERE status = 'Livré' ";
                    $result        = mysqli_query($conn,$query) or die (mysqli_error($conn));
                    $row           = mysqli_fetch_assoc($result);
                    $total_revenue = $row['Total'];
                    ?>
                    <div class="card-header">Revenus générés :</div>
                    <div class="card-body">
                        <h5 class="card-title">Nombre :</h5>
                        <p class="card-text display-2"><?= $total_revenue . '$' ?></p>
                    </div>
                </div>
            </div>    

        </section>
    
    </div>    


<?php include('./partials/footer.php'); ?>

<?php 
     }
     else{
        header("location:login.php");
     }
?>