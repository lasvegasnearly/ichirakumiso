
<?php include('partials-front/menu.php'); ?>

<div class="container text-center">
        <img src="./img/ichirakuMiso-elements/logo-Recovered0.png" alt="Ichiraku Miso" width="20%">            
</div>        
        <div class="container">
            <h2 class="text-center display-4 mt-3 mb-3">Découvrir des catégories</h2>
            <div class="row">
                <?php 
                    $query  = "SELECT * FROM tbl_category WHERE active='oui'";
                    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
                    $count  = mysqli_num_rows($result);
                    if($count > 0)
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
                if($image_name=="")
                {
                    echo "<div class='alert alert-secondary text-center'>IMAGE INDISPONIBLE.</div>";
                }
                else
                {
                ?>
                        <img src="<?= SITEURL; ?>img/categorie/<?= $image_name; ?>" class="card-img-top">
                <?php
                }
                ?>                                
                        <div class="card-body text-center float-text carter-one pos-text"><?= $title; ?></div>                  
                            </div>
                        </a>
                    </div>
                <?php
                        }
                    }
                    else
                    {
                        echo "<div class='alert alert-warning text-center col-xl-12'>Aucun plat disponible pour l'instant, visiter nous après.</div>";
                    }
                ?>
                <div class="clearfix"></div>
            </div>
        </div>

<?php include('partials-front/footer.php'); ?>