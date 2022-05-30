    
<?php include('partials-front/menu.php'); ?>
    <div class="banner-category-plats">

        <div class="text-center">
            <img src="./img/ichirakuMiso-elements/logo-Recovered0.png" alt="Ichiraku Miso" width="20%">            
        </div>
        <?php 
            if(isset($_GET['category_id']))
            {
                $category_id    = $_GET['category_id'];  
                $query          = "SELECT title FROM tbl_category WHERE id=$category_id";
                $result         = mysqli_query($conn, $query);
                $row            = mysqli_fetch_assoc($result);
                $category_title = $row['title'];
            }
            else
            {
                header('location:'.SITEURL);
            }
        ?>
        <div class="text-center">
            <div class="container">
                <h2 class="display-4 text-light mb-2">Les plats disponibles dans <a class="">"<?= $category_title; ?>"</a></h2>
            </div>     
        </div>
        <section class="container mt-4">
            <div class="row">    
            <?php 
            $query  = "SELECT * FROM tbl_food WHERE category_id = '$category_id' ";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            $count = mysqli_num_rows($result);
            if($count > 0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $id          = $row['id'];
                    $title       = $row['title'];
                    $description = $row['description'];
                    $image_name  = $row['image_name'];
            ?>        
                <div class="col-md-6 col-lg-3 d-flex mb-5 mb-lg-0">
                    <div class="card" style="width: 18rem;">
                        <?php 
                        if($image_name=="")
                        {
                            echo "<div class='alert alert-secondary text-center'>IMAGE INDISPONIBLE .</div>";
                        }
                        else
                        {
                        ?>
                        <?php
                            }
                        ?>
                                <img src="<?= SITEURL; ?>img/plat/<?= $image_name; ?>" class="card-img-top">
                                <div class="card-body">
                                    <a href="<?= SITEURL; ?>order.php?food_id=<?= $id; ?>" class="text-center" style="color:#d79254;"><h5 class="card-title text-capitalize grape-nuts"><?= $title; ?></h5></a>
                                    <p class="card-text roboto"><?= $description; ?></p>                                                    <!-- <p class="card-text"><?= $price . ' $'; ?></p> -->
                                </div>
                    </div>
                </div>
            <?php
                }
            }
            else
            {
                echo "<div class='alert alert-warning text-center col-xl-12'>Aucun plat disponible pour l'instant, visitez nous après</div>";
            }                    
            ?>
                </div>
            <div class="clearfix"></div>
        </section>
    </div>

<?php include('partials-front/footer.php'); ?>