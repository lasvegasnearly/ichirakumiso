
<?php include('./partials/menu.php'); ?>
    
    <h1 class="alert alert-info display-3 text-center">Gestion des ordres</h1>  
    <div class="container">
        <table class="table">               
            <tr>
                <th>Numéro de série:</th>
                <th>Plat :</th>
                <th>Prix :</th>
                <th>Quantité :</th>
                <th>Total :</th>
                <th>Statut :</th>
                <th>Date de commande :</th>
                <th>Nom de client :</th>
                <th>Contact de client :</th>
                <th>E-mail de client :</th>
                <th>Adresse de client :</th>
                <th>Actions :</th>
            </tr>
<?php 
    $query  = "SELECT * FROM tbl_order";
    $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
    $count  = mysqli_num_rows($result);

    if($count > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $id               = $row['id'];
            $food             = $row['food'];
            $price            = $row['price'];
            $quantity         = $row['quantity'];
            $order_date       = $row['order_date'];
            $total            = $row['total'];
            $status           = $row['status'];
            $customer_name    = $row['customer_name'];
            $customer_contact = $row['customer_contact'];
            $customer_email   = $row['customer_email'];
            $customer_address = $row['customer_address'];
?>

            <tr>
                <td><?= $id; ?></td>
                <td><?= $food; ?></td>
                <td><?= $price; ?></td>
                <td><?= $quantity; ?></td>
                <td><?= $total; ?></td>
                <td>
                    <?php 
                        if($status=="Commandé")
                        {
                            echo "<label>$status</label>";
                        }
                        elseif($status=="Entrain de livré")
                        {
                            echo "<label style='color: orange;'>$status</label>";
                        }
                        elseif($status=="Livré")
                        {
                            echo "<label style='color: green;'>$status</label>";
                        }
                        elseif($status=="Annulé")
                        {
                            echo "<label style='color: red;'>$status</label>";
                        }
                        ?>
                </td>
                <td><?= $order_date; ?></td>
                <td><?= $customer_name; ?></td>
                <td><?= $customer_contact; ?></td>
                <td><?= $customer_email?></td>
                <td><?= $customer_address?></td>
                <td>
                    <a href="<?= SITEURL; ?>admin/update-order.php?id=<?= $id; ?>" class="btn btn-warning">Modifier</a>                
                </td>
            </tr>

<?php            
        }
    }
    else 
    {
        echo("<td colspan='12' class='alert alert-dark text-center display-4'>Aucun orders diponible pour l'instant.</td>");
    }
?>              
        </table>
    </div>

<?php include('./partials/footer.php'); ?>