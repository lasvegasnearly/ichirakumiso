<?php 
    if(!session_id()) session_start();
    //session_start();

    define('SITEURL','http://localhost/ichirakuMisoWebSite/');

    define('LOCALHOST','localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'ichirakumiso_orders');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
?>