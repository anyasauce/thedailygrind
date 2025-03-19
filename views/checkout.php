<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/user/user_session.php';

$cart_items = [];
$subtotal = 0;
$tax = 0;
$delivery_fee = 50.00;
$total = 0;

$user_id = (int) $user_id;

include_once BASE_PATH . 'controllers/user/fetchCart.php';

$tax = $subtotal * 0.12;
$total = $subtotal + $tax + $delivery_fee;

if (empty($cart_items)) {
    ?>
    <script>
        location.href = "<?= route('user', 'cart'); ?>";
    </script>
    <?php
exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "The Daily Grind | Checkout";
include BASE_PATH . 'components/user/head.php';
?>

<body class="bg-light">
    <?php include BASE_PATH . 'components/user/header.php'; ?>

    <div class="container py-5" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
        <div class="row justify-content-center mb-4">
            <div class="col-md-10 text-center mt-5">
                <h2 class="display-6 fw-bold">Checkout <i class="bi bi-credit-card"></i></h2>
                <p class="text-muted">Complete your order</p>
            </div>
        </div>

        <form id="checkoutForm" action="<?= route('controllers', 'process_order') ?>" method="POST">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-3">
                            <div class="progress" style="height: 4px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 45%"
                                    aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <div class="text-success"><i class="bi bi-check-circle-fill"></i> Cart</div>
                                <div class="text-success"><i class="bi bi-check-circle-fill"></i> Checkout</div>
                                <div class="text-muted">Confirmation</div>
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Method -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">1. Delivery Method</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="card h-100 border p-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="deliveryMethod"
                                                id="delivery" value="delivery" checked>
                                            <label class="form-check-label" for="delivery">
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="bi bi-truck fs-4 me-2 text-primary"></i>
                                                    <h6 class="mb-0">Home Delivery</h6>
                                                </div>
                                                <p class="text-muted small mb-0">Get your coffee delivered to your
                                                    doorstep</p>
                                                <p class="fw-bold mt-2 mb-0">₱50.00</p>
                                                <small class="text-muted">Estimated delivery: 30-45 minutes</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card h-100 border p-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="deliveryMethod"
                                                id="pickup" value="pickup">
                                            <label class="form-check-label" for="pickup">
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="bi bi-shop fs-4 me-2 text-primary"></i>
                                                    <h6 class="mb-0">Store Pickup</h6>
                                                </div>
                                                <p class="text-muted small mb-0">Pick up your order from our store</p>
                                                <p class="fw-bold mt-2 mb-0">Free</p>
                                                <small class="text-muted">Ready for pickup: 15-20 minutes</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Billing Details -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">2. Billing Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="fullname" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="fullname" name="fullname" required value="<?= $user['fullname']; ?>">
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="<?= $_SESSION['user']['email'] ?>" required>
                                </div>
                                <div class="col-12">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                </div>
                                <div class="col-12">
                                    <label for="address" class="form-label">Delivery Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Street address" required>
                                </div>
                                <div class="col-md-5">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="region" class="form-label">Region/Province</label>
                                    <input type="text" class="form-control" id="region" name="region" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="zip" class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" id="zip" name="zip" required>
                                </div>
                                <div class="col-12">
                                    <label for="notes" class="form-label">Order Notes (Optional)</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3"
                                        placeholder="Special requests, delivery instructions, etc."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden fields for cart items and totals -->
                    <input type="hidden" name="cart_items" value="<?= htmlspecialchars(json_encode($cart_items)) ?>">
                    <input type="hidden" name="subtotal" value="<?= $subtotal ?>">
                    <input type="hidden" name="tax" value="<?= $tax ?>">
                    <input type="hidden" name="delivery_fee" value="<?= $delivery_fee ?>">
                    <input type="hidden" name="total" value="<?= $total ?>">

                    <!-- Payment Method -->
                    <div class="card border-0 shadow-sm" id="paymentMethodSection">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">3. Payment Method</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="card h-100 border p-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="paymentMethod" id="cod"
                                                value="cod" checked>
                                            <label class="form-check-label" for="cod">
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-cash-coin fs-4 me-2 text-success"></i>
                                                    <h6 class="mb-0">Cash on Delivery</h6>
                                                </div>
                                                <p class="text-muted small mt-2 mb-0">Pay when you receive your order
                                                </p>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card h-100 border p-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="paymentMethod"
                                                id="online" value="online">
                                            <label class="form-check-label" for="online">
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-credit-card fs-4 me-2 text-primary"></i>
                                                    <h6 class="mb-0">Online Payment</h6>
                                                </div>
                                                <p class="text-muted small mt-2 mb-0">Pay now with credit/debit card or
                                                    e-wallet</p>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Order Summary -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">Order Summary</h5>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                <?php foreach ($cart_items as $item): ?>
                                    <li class="list-group-item py-3">
                                        <div class="d-flex">
                                            <img src="/thedailygrind/<?= $item['image'] ?>" alt="<?= $item['product_name'] ?>"
                                                class="rounded" width="60" height="60" style="object-fit: cover;">
                                            <div class="ms-3">
                                                <h6 class="mb-0"><?= htmlspecialchars($item['product_name']) ?></h6>
                                                <small class="text-muted">Quantity: <?= $item['quantity'] ?></small>
                                                <p class="mb-0 fw-bold">
                                                    ₱<?= number_format($item['price'] * $item['quantity'], 2) ?></p>
                                                <p class="mt-2"><strong>Size:</strong> <?= htmlspecialchars($item['size']) ?></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="card-body border-top">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal</span>
                                    <span>₱<?= number_format($subtotal, 2) ?></span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Tax (12%)</span>
                                    <span>₱<?= number_format($tax, 2) ?></span>
                                </div>
                                <div class="d-flex justify-content-between mb-2" id="deliveryFeeSection">
                                    <span>Delivery Fee</span>
                                    <span id="deliveryFeeAmount">₱<?= number_format($delivery_fee, 2) ?></span>
                                </div>

                                <hr>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="fw-bold">Total</span>
                                    <span class="fw-bold fs-5" id="totalAmount">₱<?= number_format($total, 2) ?></span>
                                </div>

                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Promo code">
                                        <button class="btn btn-outline-primary" type="button">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white py-3">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary py-3 fw-bold" id="placeOrderBtn">Place
                                    Order</button>
                            </div>
                            <div class="text-center mt-3">
                                <a href="cart.php" class="text-decoration-none">
                                    <i class="bi bi-arrow-left"></i> Return to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php include BASE_PATH . 'components/user/footer.php'; ?>

    <div class="modal fade" id="loadingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="loadingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3 fw-bold">Processing your order...</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('checkoutForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
            loadingModal.show();

            setTimeout(() => {
                this.submit();
            }, 3000);
        });

        document.addEventListener("DOMContentLoaded", function () {
            const deliveryOption = document.getElementById("delivery");
            const pickupOption = document.getElementById("pickup");
            const paymentMethodSection = document.getElementById("paymentMethodSection");
            const deliveryFeeSection = document.getElementById("deliveryFeeSection");
            const deliveryFeeAmount = document.getElementById("deliveryFeeAmount");
            const totalAmount = document.getElementById("totalAmount");

            const baseTotal = <?= $total ?>;
            const deliveryFee = <?= $delivery_fee ?>;

            function toggleSections() {
                let newTotal = baseTotal;
                const deliveryFeeInput = document.querySelector('input[name="delivery_fee"]');
                const totalInput = document.querySelector('input[name="total"]');

                if (pickupOption.checked) {
                    paymentMethodSection.style.display = "none";
                    deliveryFeeSection.style.display = "none";
                    deliveryFeeAmount.textContent = "₱0.00";
                    deliveryFeeInput.value = 0;
                    newTotal = baseTotal - deliveryFee;
                } else {
                    paymentMethodSection.style.display = "block";
                    deliveryFeeSection.style.display = "flex";
                    deliveryFeeAmount.textContent = `₱${deliveryFee.toFixed(2)}`;
                    deliveryFeeInput.value = deliveryFee;
                    newTotal = baseTotal;
                }

                totalInput.value = newTotal;
                totalAmount.textContent = `₱${newTotal.toFixed(2)}`;
            }

            deliveryOption.addEventListener("change", toggleSections);
            pickupOption.addEventListener("change", toggleSections);

            toggleSections();
        });

    </script>
    

</body>

</html>