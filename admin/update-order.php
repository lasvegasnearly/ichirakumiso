
<?php include('./partials/menu.php'); ?>

<div class="container">
    <h1 class="alert alert-warning display-3 text-center">Modifier l'order</h1>
        <?php
        ob_start();
            if(isset($_GET['id']))
            {
                $id     = $_GET['id'];
                $query  = "SELECT * FROM tbl_order WHERE id= '$id' ";
                $result = mysqli_query($conn, $query);
                $count  = mysqli_num_rows($result);

                if($count==1)
                {
                    $row=mysqli_fetch_assoc($result);

                    $food             = $row['food'];
                    $price            = $row['price'];
                    $qty              = $row['quantity'];
                    $status           = $row['status'];
                    $customer_name    = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email   = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-order.php');
            }       
        ?>

    <form method="POST">
        <table class="table">
            <tr>
                <td>Plat :</td>
                <td><b> <?php echo $food; ?> </b></td>
            </tr>
            <tr>
                <td>Prix :</td>
                <td>
                    <b> $ <?php echo $price; ?></b>
                </td>
            </tr>
            <tr>
                <td>Quantité :</td>
                <td>
                    <input type="number" name="qty" class="form-control" value="<?php echo $qty; ?>">
                </td>
            </tr>
            <tr>
                <td>Statut</td>
                <td>
                    <select name="status" class="form-control">
                        <option <?php if($status=="Commandé"){echo "selected";} ?> value="Commandé">Commandé</option>
                        <option <?php if($status=="Entrain de livré"){echo "selected";} ?> value="Entrain de livré">Entrain de livré</option>
                        <option <?php if($status=="Livré"){echo "selected";} ?> value="Livré">Livré</option>
                        <option <?php if($status=="Annulé"){echo "selected";} ?> value="Annulé">Annulé</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Nom de client :</td>
                <td>
                    <input type="text" name="customer_name" class="form-control" value="<?php echo $customer_name; ?>">
                </td>
            </tr>
            <tr>
                <td>Contact de client :</td>
                <td>
                    <input type="text" name="customer_contact" class="form-control" value="<?php echo $customer_contact; ?>">
                </td>
            </tr>
            <tr>
                <td>E-mail de client :</td>
                <td>
                    <input type="text" name="customer_email" class="form-control" value="<?php echo $customer_email; ?>">
                </td>
            </tr>
            <tr>
                <td>Adresse de client :</td>
                <td>
                    <textarea name="customer_address" class="form-control" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                </td>
            </tr>
            <tr class = "text-right">
                <td colspan = "2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <input type="submit" name="submit" value="Modifier" class="btn btn-warning">
                </td>
            </tr>
        </table>
    </form>


        <?php 
            if(isset($_POST['submit']))
            {  
                $id     = htmlspecialchars($_POST['id']);
                $price  = htmlspecialchars($_POST['price']);
                $qty    = htmlspecialchars($_POST['qty']);
                $total  = $price * $qty;
                $status = htmlspecialchars($_POST['status']);


                $customer_name    = htmlspecialchars($_POST['customer_name']);
                $customer_contact = htmlspecialchars($_POST['customer_contact']);
                $customer_email   = htmlspecialchars($_POST['customer_email']);
                $customer_address = htmlspecialchars($_POST['customer_address']);
                $customer_address = str_replace("'","\'",$customer_address);

                $query = "UPDATE tbl_order SET 
                    quantity = $qty,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id= '$id'
                ";

                $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

        
                if($result == TRUE)
                {
                    $_SESSION['update'] = "<div class='alert alert-warning'>La commande a été modifier avec succès.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='alert alert-secondary'>La commande n'a pas modifié, quelque chose incorrect.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                    ob_end_flush();
                }
            }
        ?>

</div>


<?php include('./partials/footer.php'); ?>
