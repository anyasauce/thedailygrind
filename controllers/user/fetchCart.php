<?php

$fetch = mysqli_query($conn, "SELECT cart.id, cart.user_id, cart.product_id, cart.quantity, cart.size, cart.addon, cart.addon_price, products.product_name AS product_name, cart.price, products.image, products.status
    FROM cart
    JOIN products ON cart.product_id = products.product_id
    WHERE cart.user_id = '$user_id'");

$cart_items = [];
$subtotal_items = 0; // Initialize subtotal for item prices
$subtotal_addons = 0; // Initialize subtotal for add-ons

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
        'addon' => $row['addon'],
        'addon_price' => $row['addon_price'],
        'status' => $row['status'],
    ];

    $subtotal_items += ($row['price'] * $row['quantity']);

    $subtotal_addons += ($row['addon_price'] * $row['quantity']);
}

$total_price = $subtotal_items + $subtotal_addons;

?>