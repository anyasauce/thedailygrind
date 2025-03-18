<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/user/user_session.php';

$cart_items = [];
$subtotal = 0;

$fetch = mysqli_query($conn, "SELECT cart.user_id, cart.product_id, cart.quantity, products.product_name AS product_name, products.price, products.image, products.status
          FROM cart
          JOIN products ON cart.product_id = products.product_id
          WHERE cart.user_id = '$user_id'");

while ($row = mysqli_fetch_assoc($fetch)) {
    $cart_items[] = [
        'product_id' => $row['product_id'],
        'user_id' => $row['user_id'],
        'image' => $row['image'],
        'product_name' => $row['product_name'],
        'price' => $row['price'],
        'quantity' => $row['quantity'],
        'status' => $row['status']
    ];
    $subtotal += $row['price'] * $row['quantity'];
}

?>

<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "The Daily Grind | Cart";
include BASE_PATH . 'components/user/head.php';
?>
<body class="bg-light">
    <?php include BASE_PATH . 'components/user/header.php';    ?>

    <div class="container py-5">
        <div class="row justify-content-center mb-4">
            <div class="col-md-8 text-center mt-5">
                <h2 class="display-6 fw-bold">Your Cart <i class="bi bi-cart3"></i></h2>
                <p class="text-muted">Review your items before checkout</p>
            </div>
        </div>

        <?php if (empty($cart_items)): ?>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-5">
                            <i class="bi bi-cart-x display-1 text-secondary mb-3"></i>
                            <h4>Your cart is empty</h4>
                            <p class="text-muted">Looks like you haven't added anything to your cart yet.</p>
                            <a href="menu.php" class="btn btn-primary px-4 py-2">Browse Menu</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-3">
                            <div class="progress" style="height: 4px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 5%" aria-valuenow="66"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <div class="text-success"><i class="bi bi-check-circle-fill"></i> Cart</div>
                                <div class="text-muted">Checkout</div>
                                <div class="text-muted">Confirmation</div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="mb-0">Cart Items (<?= count($cart_items) ?>)</h5>
                                </div>
                                <div class="col text-end">
                                    <a href="<?= route('user', 'menu'); ?>" class="btn btn-sm btn-outline-primary">Add More Items</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                <?php foreach ($cart_items as $item): ?>
                                    <li class="list-group-item py-3">
                                        <div class="row align-items-center">
                                            <div class="col-md-2 mb-2 mb-md-0">
                                                <img src="/thedailygrind/<?= htmlspecialchars($item['image']) ?>"
                                                    alt="<?= htmlspecialchars($item['product_name']) ?>" class="img-fluid rounded" width="100">
                                            </div>
                                            <div class="col-md-4 mb-2 mb-md-0">
                                                <h5 class="mb-1"><?= htmlspecialchars($item['product_name']) ?></h5>
                                                <span class="badge bg-success"><?= htmlspecialchars($item['status']) ?></span>
                                            </div>
                                            <div class="col-md-3 text-md-center mb-2 mb-md-0">
                                                <form action="<?= route('controllers', 'cart_process'); ?>" method="POST">
                                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['product_id']) ?>">
                                                    <div class="input-group input-group-sm" style="max-width: 120px;">
                                                        <button type="submit" name="decrease" class="btn btn-outline-secondary">-</button>
                                                        <input type="text" class="form-control text-center" name="quantity"
                                                            value="<?= isset($item['quantity']) ? htmlspecialchars($item['quantity']) : '1'; ?>" readonly>
                                                        <button type="submit" name="increase" class="btn btn-outline-secondary">+</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-2 text-md-end mb-2 mb-md-0">
                                                <span class="fw-bold">₱<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                                                <br>
                                                <small class="text-muted">₱<?= number_format($item['price'], 2) ?> each</small>
                                            </div>
                                            <div class="col-md-1 text-md-end">
                                                <form action="<?= route('controllers', 'cart_process'); ?>" method="POST">
                                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['product_id']) ?>">
                                                    <button type="submit" name="delete" class="btn btn-sm btn-outline-danger" title="Remove item">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">Order Summary</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span>₱<?= number_format($subtotal, 2) ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2 text-muted">
                                <span>Estimated Tax</span>
                                <span>Calculated at checkout</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2 text-muted">
                                <span>Delivery Fee</span>
                                <span>Calculated at checkout</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="fw-bold">Estimated Total</span>
                                <span class="fw-bold">₱<?= number_format($subtotal, 2) ?></span>
                            </div>

                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Enter coupon code">
                            </div>

                            <div class="d-grid gap-2">
                                <a href="checkout.php" class="btn btn-primary py-2">Proceed to Checkout</a>
                            </div>
                        </div>
                        <div class="card-footer bg-white py-3">
                            <div class="d-flex justify-content-between">
                                <small>Secure Payment</small>
                                <div>
                                    <i class="bi bi-credit-card me-2"></i>
                                    <i class="bi bi-paypal me-2"></i>
                                    <i class="bi bi-wallet2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php include BASE_PATH . 'components/user/footer.php'; ?>

</body>

</html>