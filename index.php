
<?php include('partials-front/menu.php'); ?>

    <div class="banner-image w-100 vh-100 d-flex justify-content-center align-items-center">
        <div class="container text-center">
        <h1 class="raleway text-center text-white">Votre plat attend vous chez Ichiraku Miso</h1>
    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>
            <div class="container my-5 d-grip gap-5">
                <div class="p-5">
                    <div class="container w-50 text-center">
                        <form action="<?= SITEURL; ?>plat-search.php" method="POST">
                            <input type="search" class="form-control" name="search" placeholder="Saississez votre plat préféré" required>
                            <input type="submit" name="submit" value="Chercher" class="btn btn-light mt-3">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="categories">
        <div class="container">
        <h2 class="text-center display-4">Découvrir des categories</h2>
                <div class="row">
                    <?php   $query = "SELECT * FROM tbl_category WHERE active='oui' AND featured='oui' LIMIT 6";
                            $result = mysqli_query($conn, $query) or die (mysqli_error($conn));
                            $count = mysqli_num_rows($result);
                            if($count>0)
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    $id         = $row['id'];
                                    $title      = $row['title'];
                                    $image_name = $row['image_name'];
                    ?>
                                            
                    <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
                        <a href="<?= SITEURL; ?>category-plats.php?category_id=<?= $id; ?>" class="text-center">
                            <div class="card" style="width: 18rem;">
                    <?php
                        if($image_name == "")
                        {
                            echo("<img src='img/imgpardefaut/indisponible_image.jpg' width='35%' alt='Pas d'image' class='card-img-top'>");
                        }
                        else
                        {
                        ?>
                            <img src="<?= SITEURL; ?>img/categorie/<?= $image_name; ?>" class="card-img-top">
                    <?php
                        }
                        ?>
                                <div class="card-body text-center float-text carter-one pos-text"><?= $title; ?></div>          
                        </a>                    
                    </div>
                </div>

                    <?php    
                                }
                            }
                            else
                            {
                                echo "<div class='alert alert-warning text-center col-xl-12'>Aucun catégorie disponible pour l'instant, visitez nous-après.</div>";
                            }
                    ?>
                        
            <div class="clearfix"></div>
        </div>
    </section>


    <section class="plats-menu">
        <div class="container">
            <h2 class="text-center display-4">Menu des plats</h2>
            <div class="row">
                <?php 
                $query  = "SELECT * FROM tbl_food WHERE active='oui' AND featured='oui' LIMIT 12";
                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                $count  = mysqli_num_rows($result);
                if($count>0)
                {
                    while($row = mysqli_fetch_assoc($result))
                    {   
                    $id          = $row['id'];
                    $title       = $row['title'];
                    $price       = $row['price'];
                    $description = $row['description'];
                    $image_name  = $row['image_name'];
                ?>
                    

                <?php 
                    if($image_name == "")
                    {
                        echo "<div class='alert alert-secondary text-center'>IMAGE INDISPONIBLE.</div>";
                    }
                    else
                    {
                ?>
                        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0"> 
                            <div class="card" style="width: 18rem;">
                                <img src="<?= SITEURL; ?>img/plat/<?= $image_name; ?>" class="card-img-top">
                <?php
                    }
                ?>
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize grape-nuts"><?= $title; ?></h5>                            
                                        <div class="collapse" id="example<?php $row['id'] ?>">
                                            <p class="card-text roboto"><?= $description; ?></p>
                                        </div>
                                        <a class="btn btn-link" data-toggle="collapse" href="#example<?php $row['id'] ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?=$row['id'] ?>" id="accordion">Découvrir</a>
                                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-success">Commander</a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
            else
            {
                echo ("<div class='alert alert-warning text-center col-xl-12'>Aucun plat disponible pour l'instant, visitez nous après.</div>");
            }
                ?>

                <div class="clearfix"></div>
            </div>
        </div>
        <p class="text-center"><a href="<?= SITEURL; ?>plats.php">Voir les autres plats</a></p>
    </section>

<?php include('partials-front/footer.php'); ?>
