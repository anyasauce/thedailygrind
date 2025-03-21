<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/user/user_session.php';

if (!isset($_SESSION['user']['order_id'])) {
    die("Order ID is missing.");
}

$order_id = $_SESSION['user']['order_id'];

$query = "SELECT * FROM orders WHERE order_id = $order_id";
$result = mysqli_query($conn, $query);
$order = mysqli_fetch_assoc($result);

if (!$order) {
    die("Order not found.");
}

$query = "SELECT oi.*, p.product_name, oi.addon_price 
          FROM order_items oi
          JOIN products p ON oi.product_id = p.product_id
          WHERE oi.order_id = $order_id";

$result = mysqli_query($conn, $query);

$orderItems = [];
$subtotal = 0; // Initialize subtotal
$addonTotal = 0; // Initialize addon total

while ($row = mysqli_fetch_assoc($result)) {
    $orderItems[] = $row;
    // Calculate subtotal (product price * quantity)
    $subtotal += $row['price'] * $row['quantity'];
    // Calculate addon total (addon price * quantity)
    if (!empty($row['addon_price'])) {
        $addonTotal += $row['addon_price'] * $row['quantity'];
    }
}

// Calculate tax (12% of subtotal + addonTotal)
$tax = ($subtotal + $addonTotal) * 0.12;

// Calculate total amount
$delivery_fee = $order['delivery_fee'];
$totalAmount = $subtotal + $addonTotal + $tax + $delivery_fee;

$fullName = $order['fullname'];
$orderId = $order['order_id'];
$orderDate = date('F j, Y, g:i a', strtotime($order['created_at']));
$paymentMethod = $order['payment_method'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Daily Grind | Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
        <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        .receipt-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .receipt-header {
            background-color: #6f4e37;
            color: white;
            padding: 25px 20px;
            text-align: center;
            position: relative;
        }

        .logo {
            background-color: white;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .logo img {
            max-width: 60px;
        }

        .receipt-header h2 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .receipt-header p {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .divider {
            height: 12px;
            background: repeating-linear-gradient(-45deg,
                    #f8f9fa,
                    #f8f9fa 4px,
                    white 4px,
                    white 8px);
            margin: 0;
            padding: 0;
        }

        .receipt-body {
            padding: 25px;
        }

        .customer-details {
            margin-bottom: 25px;
            border-left: 3px solid #6f4e37;
            padding-left: 15px;
        }

        .customer-details p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }

        .customer-details strong {
            font-weight: 500;
            color: #333;
        }

        .order-items {
            margin-bottom: 25px;
        }

        .order-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #6f4e37;
            display: flex;
            align-items: center;
        }

        .order-title i {
            margin-right: 10px;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .item-name {
            font-weight: 500;
            font-size: 15px;
        }

        .item-details {
            color: #777;
            font-size: 13px;
        }

        .item-price {
            font-weight: 600;
            font-size: 15px;
            text-align: right;
        }

        .receipt-breakdown {
            margin-bottom: 20px;
        }

        .breakdown-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
            color: #555;
        }

        .receipt-total {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-label {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .total-amount {
            font-size: 22px;
            font-weight: 700;
            color: #6f4e37;
        }

        .receipt-footer {
            text-align: center;
            padding: 20px 25px;
            border-top: 1px dashed #ddd;
        }

        .receipt-footer p {
            font-size: 13px;
            color: #777;
            margin-bottom: 8px;
        }

        .social-icons {
            margin-top: 15px;
        }

        .social-icons i {
            font-size: 18px;
            margin: 0 8px;
            color: #6f4e37;
            transition: all 0.3s ease;
        }

        .social-icons i:hover {
            transform: translateY(-3px);
            color: #8a6d4d;
        }

        .badge-special {
            background-color: #f8d7da;
            color: #721c24;
            font-size: 11px;
            padding: 3px 8px;
            border-radius: 12px;
            margin-left: 8px;
            font-weight: 500;
        }

        .addon-info {
            font-style: italic;
            font-size: 12px;
            color: #6c757d;
            margin-top: 3px;
        }

        @media print {
            body {
                background-color: white;
            }

            .receipt-container {
                box-shadow: none;
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>
    <div class="receipt-container" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
        <div class="receipt-header">
            <div class="logo">
                <img src="../assets/images/hero-img.png" alt="Coffee Shop Logo">
            </div>
            <h2>THEDAILYGRIND</h2>
            <p>Your coffee paradise</p>
        </div>

        <div class="divider"></div>

        <div class="receipt-body">
            <div class="customer-details">
                <p><strong>Customer:</strong> <?= $fullName ?></p>
                <p><strong>Order ID:</strong> <?= $orderId ?></p>
                <p><strong>Date:</strong> <?= $orderDate ?></p>
                <p><strong>Payment Method:</strong> <?= $paymentMethod ?></p>
            </div>

            <div class="order-items">
                <div class="order-title">
                    <i class="fas fa-coffee"></i> YOUR ORDER
                </div>

                <?php foreach ($orderItems as $item): ?>
                    <div class="item-row">
                        <div>
                            <div class="item-name"><?= $item['product_name'] ?></div>
                            <div class="item-details">
                                <?= $item['quantity'] ?> × ₱<?= number_format($item['price'], 2) ?>
                                <?php if (!empty($item['size'])): ?>
                                    <span> - <?= htmlspecialchars($item['size']) ?></span>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($item['addon'])): ?>
                                <div class="addon-info">
                                    + <?= htmlspecialchars($item['addon']) ?>
                                    (₱<?= number_format($item['addon_price'], 2) ?>)
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="item-price">
                            ₱<?= number_format($item['price'] * $item['quantity'], 2) ?>
                            <?php if (!empty($item['addon'])): ?>
                                <div class="addon-info text-end">
                                    +₱<?= number_format($item['addon_price'] * $item['quantity'], 2) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="receipt-breakdown">
                <div class="breakdown-row">
                    <span>Subtotal</span>
                    <span>₱<?= number_format($subtotal, 2) ?></span>
                </div>
                <?php if ($addonTotal > 0): ?>
                    <div class="breakdown-row">
                        <span>Addons</span>
                        <span>₱<?= number_format($addonTotal, 2) ?></span>
                    </div>
                <?php endif; ?>
                <div class="breakdown-row">
                    <span>Tax (12%)</span>
                    <span>₱<?= number_format($tax, 2) ?></span>
                </div>
                <div class="breakdown-row">
                    <span>Delivery Fee</span>
                    <span>₱<?= number_format($delivery_fee, 2) ?></span>
                </div>
            </div>

            <div class="receipt-total">
                <div class="total-label">TOTAL</div>
                <div class="total-amount">₱<?= number_format($totalAmount, 2) ?></div>
            </div>

            <div class="mt-3 text-center">
                <a href="cart.php" class="btn btn-outline-primary">Back to Cart</a>
            </div>
        </div>

        <div class="receipt-footer">
            <p>Thank you for choosing TheDailyGrind!</p>
            <p>Visit us again soon.</p>
            <div class="social-icons">
                <i class="fab fa-facebook"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-twitter"></i>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>