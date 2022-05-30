
<?php include('partials-front/menu.php'); ?>

<?php 
    if(isset($_GET['food_id']))
    {
        $food_id  = $_GET['food_id'];
        $query    = "SELECT * FROM tbl_food WHERE id = '$food_id' ";
        $result   = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $count    = mysqli_num_rows($result);
        
        if($count == 1)
        {
            $row = mysqli_fetch_assoc($result);

            $title      = $row['title'];
            $price      = $row['price'];
            $image_name = $row['image_name'];
        }
        else
        {
            header("location:" .SITEURL);
        }
    }
    else
    {
        header("location:" .SITEURL);
    }
?>

    <section class="order-bg d-flex flex-column min-vh-100">
        <div class="container">
            <h2 class="text-center text-white display-4">Confirmer votre commande</h2>
            <form method="POST" class="order">
                <fieldset style="border-color: transparent;">
                    <div class="food-menu-img">
                        <?php 
                            if($image_name == "")
                            {
                                echo "<div class='alert alert-secondary text-center'>Image not Available.</div>";
                            }
                            else
                            {
                                ?>
                                
                                <img src="<?= SITEURL; ?>img/plat/<?= $image_name; ?>" alt="<?= $title; ?>" class="img-responsive img-curve">
                                
                                <?php
                            }
                        ?>
                    </div>

                    <div class="plat-menu-desc">
                        <h3 class="text-light grape-nuts"><?= $title; ?></h3>
                        <input type="hidden" name="food" value="<?= $title; ?>">
                        <b class="text-light"><?= $price; ?> $</b>
                        <input type="hidden" name="price" value="<?= $price; ?>">
                        <div class="text-light">Quantité :</div>
                        <input type="number" name="qty" value="1" required class="form-control">
                    </div>
                </fieldset>
                
                <fieldset>
                    <legend class="text-light text-center">Compléter votre informations :</legend>
                    <div class="text-light">Nom compléte :</div>
                    <input type="text" name="full-name" class="form-control" required>
                    <div class=" text-light">Numéro de téléphone :</div>
                    <input type="tel" name="contact" class="form-control" required>
                    <div class=" text-light">Email :</div>
                    <input type="email" name="email" class="form-control" required>
                    <div class=" text-light">Addresse :</div>
                    <textarea name="address" rows="10" class="form-control" required></textarea>
                    <input type="submit" name="submit" value="Confirmer" class="btn btn-light text-center mt-3">
                </fieldset>

            </form>

            <?php 
                if(isset($_POST['submit']))
                {
                    $food       = htmlspecialchars($_POST['food']);
                    $price      = htmlspecialchars($_POST['price']);
                    $qty        = htmlspecialchars($_POST['qty']);
                    $total      = $price * $qty;  
                    $order_date = date("Y-m-d h:i:sa"); 

                    $status = "Livré"; 

                    $customer_name    = htmlspecialchars($_POST['full-name']);
                    $customer_contact = htmlspecialchars($_POST['contact']);
                    $customer_email   = htmlspecialchars($_POST['email']);
                    $customer_address = htmlspecialchars($_POST['address']);
                    $customer_address = str_replace("'","\'",$customer_address);

                    $query = "INSERT INTO tbl_order SET 
                        food = '$food',
                        price = $price,
                        quantity = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    
                    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

                    if($result == TRUE)
                    {
                        session_start();
                        $_SESSION['order'] = "<div class='alert alert-primary text-center'><b>Votre commande a été effuctué avec succès.</b></div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        $_SESSION['order'] = "<div class='alert alert-secondary text-center'><b>Votre commande n'a pas effuctué, recommandez une autre fois.</b></div>";
                        header('location:'.SITEURL);

                        ob_end_flush();
                    }

                }
            ?>

        </div>

</section>

<?php include('partials-front/footer.php'); ?>