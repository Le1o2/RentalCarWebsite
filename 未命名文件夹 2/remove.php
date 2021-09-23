<?php
    session_start();
    $deleteId= $_REQUEST['id'];
        if(isset($deleteId)){
            unset($_SESSION['cart'][$deleteId]);
        }else{
            unset($_SESSION['cart']);
        }
    header("Location;cart.php");

?>