
<?php include('partials-front/menu.php'); ?>

    <div class="container text-center">
        <img src="./img/ichirakuMiso-elements/logo-Recovered0.png" alt="Ichiraku Miso" width="20%">            
    </div>
    <div class="container w-50 text-center">
        <?php $search = mysqli_real_escape_string($conn, $_POST['search']); ?>
        <h2 class="display-4">Les plats disponibles dans <a class="text-dark">"<?= $search; ?>"</a></h2>
    </div>        
        <div class="container">
            <div class="row">
            <?php 
                $query  = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                $count  = mysqli_num_rows($result);
                if($count > 0)
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $id          = $row['id'];
                        $title       = $row['title'];
                        $price       = $row['price'];
                        $description = $row['description'];
                        $image_name  = $row['image_name'];
            ?>

                <div class="col-xl-6">    
                    <div class="card">
                            <?php         
            if($image_name=="")
            {
                echo "<div class='alert alert-secondary text-center'>IMAGE INDISPONIBLE.</div>";
            }
            else
            {
            ?>
                        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                            <a href="<?= SITEURL; ?>order.php?food_id=<?= $id; ?>">
                                <img src="<?= SITEURL; ?>img/plat/<?= $image_name; ?>" class="card-img-top img-fluid">
                            </a>
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                        </div>
            <?php 
            }
            ?>
                        <div class="card-body">
                            <h5 class="card-title text-capitalize"><?= $title; ?></h5>
                                <p class="card-text"><?= $description; ?></p>
                                <p class="text-muted"><?= 'Prix : ' .$price. ' $'; ?></p>
                        </div>
                    </div>    
                </div>    
                <?php
                    }
                }
                else
                {
                    echo "<div class='alert alert-warning text-center col-xl-12'>Malheureusement, votre recherche pas disponible.</div>";
                }
                ?>                       
            <div class="clearfix"></div>
            </div>
        </div>    

<?php include('partials-front/footer.php'); ?>