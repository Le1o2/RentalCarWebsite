<?php

    header("content-type:text/html;charset=utf-8");
    $link = mysqli_connect('localhost','uts','internet','assignment1');
        if(!$link){
            die;
            echo "Error: Unable";
        }

    $id = $_GET['pid'];
    if(!$id){
        die;
        echo "error";
    }

$query_string = "select * from products where product_id = $id;";
$result = mysqli_query($link,$query_string);
$rows = mysqli_num_rows($result);

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <table>
        <tr>
            <th colspan="5">Product Details </th>
        </tr>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Unit Price</th>
            <th>Unit Quantity</th>
            <th>In Stock</th>
    </tr>

    <?php
        if($rows>0){
            while($row = mysqli_fetch_assoc($result)){
                echo"<tr>";
                echo"<td>".$row['product_id']."</td>";
                echo"<td>".$row['product_name']."</td>";
                echo"<td>".$row['unit_price']."</td>";
                echo"<td>".$row['unit_quantity']."</td>";
                echo"<td>".$row['in_stock']."</td>";
                $i_id = $row['product_id'];
                $i_name = $row['product_name'];
                $i_price = $row['unit_price'];
                $i_quantity = $row['unit_quantity'];
                echo"</tr>";
            }
        }
        mysqli_close($link); 

    ?>

    </table>

    <form name="quantity" id="shopcart" action="cart.php" method="POST" target="cart">
        <h> Quantity (Max 50):</h>
        <input type="number" id="a" name="i_qty">
        <input type="hidden" name="i_id" value="<?php echo "$i_id";?>"/>
        <input type="hidden" name="i_name" value="<?php echo "$i_name";?>"/>
        <input type="hidden" name="i_price" value="<?php echo "$i_price";?>"/>
        <input type="hidden" name="i_quantity" value="<?php echo "$i_quantity";?>"/>
        <input type="submit" id="shoppingQuantity" value="Add to Cart"
    </form>

</body>
</html>