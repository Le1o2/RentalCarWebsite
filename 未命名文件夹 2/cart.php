<?php
    header("content-type:text/html;charset=utf-8");

    session_start();
    $cart = $_SESSION['cart'];
    $productId = $_REQUEST['i_id'];
    $productName = $_REQUEST['i_name'];
    $productPrice = $_REQUEST['i_price'];
    $productSpecifications= $_REQUEST['i_specifications'];
    $productQuantity = $_REQUEST['i_quantity'];

    if(empty($cart) && empty($productQuantity)){
        echo "<p>There are no items in the shopping cart</p>";
    }

    /*可以被改动*/
    if(!empty($productQuantity)){
        if(empty($cart)){
            $cart[$productId] = array("id" => $productId,"name" => $productName,"price" =>$productPrice,"specifications" =>$productSpecifications,"quantity" =>$productQuantity);
            $_SESSION['cart'] = $cart;
        }elseif(!array_key_exists($productId,$cart)){
            $cart[$productId] = array("id" => $productId,"name" => $productName,"price" =>$productPrice,"specifications" =>$productSpecifications,"quantity" =>$productQuantity);
            $_SESSION['cart'] = $cart;
        }elseif(!empty($productQuantity)){
            $cart[$productId]['quantity'] = $cart[$productId]['quantity'] + $productQuantity;
            $_SESSION['cart'] = $cart;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>
    <table>
    
        <tr>
            <th colspan="6">Shopping Cart</th>
        </tr>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>specifications</th>
            <th>Quantity</th>
            <th>Sub Total</th>
            <th>Delete items</th>
        </tr>

        <?php
            $total=0;
            if(isset($cart)){
                foreach($cart as $item){
                    echo"<tr>";
                    echo"<td>".$item['name']."</td>";
                    echo"<td>".$item['price']."</td>";
                    echo"<td>".$item['specifications']."</td>";
                    echo"<td>".$item['quantity']."</td>";
                    echo"<td>".($item['price'] *$item['quantity'])."</td>";
                    echo"<td><a href='remove.php?id={$item['id']}'>Delete</a></td>";
                    echo"</tr>";
                    $total += $i['price'] * $i['quantity'];
                }
            }
        ?>

        <tr>
            <td>Total</td>
            <td><?php echo "$total";?></td>
            <td><form action="remove.php"><input type="submit" value="Clear All"></form>></td>
            <td><form action="" target="details"><input type="submit" value="Check Out"></form>></td>
        </tr>
    </table>
</body>
</html>