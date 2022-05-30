
<?php include("partials-front/menu.php"); ?>

    <div class="banner-plats">
        <div class="text-center">
            <img src="./img/ichirakuMiso-elements/logo-Recovered0.png" alt="Ichiraku Miso" width="20%">            
        </div>
        <div class="container w-50 text-center">
            <form action="<?= SITEURL; ?>plat-search.php" method="POST">
                <input type="search" name="search" class="form-control" placeholder="Saississez votre plat préféré" required>
                <input type="submit" name="submit" value="Cherecher" class="btn btn-light mt-3">
            </form>
        </div>

        
        <div class="container">
            <h2 class="text-center text-light display-4 mt-3 mb-3">Menu des plats</h2>
            <div class="row">
            <?php 
                $query  = "SELECT * FROM tbl_food WHERE active= 'oui' ";
                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                $count  = mysqli_num_rows($result);

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($result))
                    {
                        $id          = $row['id'];
                        $title       = $row['title'];
                        $description = $row['description'];
                        $price       = $row['price'];
                        $image_name  = $row['image_name'];
            ?>
                <div class="col-xl-6 col-md-12 col-lg-6 d-flex mb-5 mb-lg-0">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <?php 
                                if($image_name == "")
                                {
                                    echo "<div class='alert alert-secondary text-center'>IMAGE INDISPONIBLE.</div>";
                                }
                                else
                                {
                            ?>
                                <img src="<?= SITEURL; ?>img/plat/<?= $image_name; ?>" class="img-fluid rounded-start">
                            <?php
                                }
                                ?>    
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><?= $title; ?></h5>
                                    <p class="card-text roboto"><?= $description; ?></p>
                                    <div class="text-right">
                                        <a href="<?= SITEURL; ?>order.php?food_id=<?= $id; ?>" class="btn btn-success">Commander</a>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        <?php
                        }
                    }
                    else
                    {
                        echo "<div class='alert alert-light text-center'>Aucun plat disponible pour l'instant, visiter nous après.</div>";
                    }
                        ?>
                <div class="clearfix"></div>
            </div> 
    </div>

<?php include("partials-front/footer.php"); ?>
