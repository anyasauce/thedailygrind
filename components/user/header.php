<header>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?= route('user', 'home'); ?>">TheDailyGrind</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <?php
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $isLoggedIn = isset($_SESSION['user']['email']);
            ?>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= route('user', 'home'); ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= route('user', 'menu'); ?>">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= route('user', 'contact'); ?>">Contact</a>
                </li>
                <?php if ($isLoggedIn): ?>
                    <li class="nav-item">
                        <?php
                            $userID = $_SESSION['user']['user_id'];
                            $cartData = mysqli_query($conn, "SELECT COUNT(*) as cart_count FROM cart WHERE user_id = '$userID'");
                            $row = mysqli_fetch_assoc($cartData);
                            $cartCount = $row['cart_count'] ?? 0;
                        ?>
                        <a class="nav-link" href="<?= route('user', 'cart'); ?>">
                            Cart
                            <?php if ($cartCount > 0): ?>
                                <span><sup class="bg-danger p-1 text-white rounded-circle"><?= $cartCount ?></sup></span>
                            <?php endif; ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= route('user', 'profile'); ?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <?php
                            $getData = mysqli_query($conn, "SELECT COUNT(*) as order_count FROM orders WHERE status != 'Completed' AND status != 'Cancelled'");
                            $row = mysqli_fetch_assoc($getData);
                            $count = $row['order_count'] ?? 0;
                            ?>
                        <a class="nav-link" href="<?= route('user', 'orders'); ?>">
                            My Orders
                            <?php if ($count > 0): ?>
                                <span><sup class="bg-danger p-1 text-white rounded-circle"><?= $count ?></sup></span>
                            <?php endif; ?>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (!$isLoggedIn): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= route('user', 'login'); ?>">Sign in</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-primary rounded-pill px-4" href="<?= route('user', 'register'); ?>">Join Now!</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-danger rounded-pill px-4" href="<?= route('user', 'logout'); ?>">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>

            </div>
        </div>
    </nav>
</header>