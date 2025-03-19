<?php

$fetch = mysqli_query($conn, "SELECT cart.id, cart.user_id, cart.product_id, cart.quantity, cart.size, products.product_name AS product_name, cart.price, products.image, products.status
    FROM cart
    JOIN products ON cart.product_id = products.product_id
    WHERE cart.user_id = '$user_id'");

while ($row = mysqli_fetch_assoc($fetch)) {
    $cart_items[] = [
        'id' => $row['id'],
        'product_id' => $row['product_id'],
        'user_id' => $row['user_id'],
        'image' => $row['image'],
        'product_name' => $row['product_name'],
        'price' => $row['price'],
        'quantity' => $row['quantity'],
        'size' => $row['size'],
        'status' => $row['status'],
    ];
    $subtotal += $row['price'] * $row['quantity'];
}

?>