<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/user/user_session.php';

$isLoggedIn = isset($_SESSION['email']);

$getProducts = mysqli_query($conn, "SELECT p.* FROM products p
    JOIN category c ON p.category = c.category_name
    ORDER BY c.category_id, p.product_id");
$menuItems = [];

if ($getProducts->num_rows > 0) {
    while ($row = $getProducts->fetch_assoc()) {
        $category = strtolower(str_replace(' ', '_', $row['category']));
        $menuItems[$category][] = [
            'product_id' => $row['product_id'],
            'product_name' => $row['product_name'],
            'description' => $row['description'],
            'price' => $row['price'],
            'image' => $row['image']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
$pageTitle = "The Daily Grind | Menu";
include BASE_PATH . 'components/user/head.php';
?>

<body class="bg-light">
    <?php include BASE_PATH . 'components/user/header.php'; ?>

    <div class="container-fluid mt-5">
        <div class="row">
            <!-- Sidebar -->
            <aside id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse mt-3" data-aos="fade-right"
                data-aos-duration="1000" data-aos-delay="100">
                <div class="position-sticky">
                    <div class="sidebar-heading">CATEGORIES</div>
                    <?php foreach ($menuItems as $sectionId => $items): ?>
                        <a href="#<?= $sectionId ?>" class="sidebar-item">>
                            <?= ucfirst(str_replace('_', ' ', $sectionId)) ?></a>
                    <?php endforeach; ?>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 mt-5" data-aos="fade-left" data-aos-duration="1000"
                data-aos-delay="100">
                <h1 class="text-center mb-4">Menu</h1>

                <?php foreach ($menuItems as $sectionId => $items): ?>
                    <section id="<?= $sectionId ?>" class="mb-5">
                        <h2 class="text-start mb-4 border-bottom pb-2"><?= ucfirst(str_replace('_', ' ', $sectionId)) ?>
                        </h2>
                        <div class="row">
                            <?php foreach ($items as $item): ?>
                                <div class="col-6 col-md-4 col-lg-3 mb-4">
                                    <div data-bs-toggle="modal" data-bs-target="#productModal<?= $item['product_id']; ?>"
                                        class="d-flex justify-content-center align-items-center cursor-pointer" style="height: 170px;">
                                        <span class="position-relative">
                                            <img src="/thedailygrind/<?= htmlspecialchars($item['image']) ?>"
                                                alt="<?= htmlspecialchars($item['product_name']) ?>"
                                                class="img-fluid bg-primary p-2 rounded-circle"
                                                style="max-width: 150px; max-height: 150px; object-fit: cover;">
                                        </span>
                                    </div>
                                    <div class="text-center mt-2">
                                        <h3 class="fs-5"><?= $item['product_name'] ?></h3>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endforeach; ?>
            </main>
        </div>
    </div>

    <?php foreach ($menuItems as $sectionId => $items): ?>
        <?php foreach ($items as $item): ?>
            <?php if ($isLoggedIn): ?>
                <div class="modal fade" id="productModal<?= $item['product_id']; ?>" tabindex="-1"
                    aria-labelledby="productModalLabel<?= $item['product_id']; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-4 mb-3 mb-md-0">
                                            <img src="/thedailygrind/<?php echo $item['image']; ?>"
                                                alt="<?php echo $item['product_name']; ?>"
                                                class="img-fluid bg-primary p-3 rounded-circle">
                                        </div>
                                        <div class="col-md-8">
                                            <h2 class="mb-2"><?php echo $item['product_name']; ?></h2>
                                            <p class="text-muted small mb-4"><?php echo $item['description']; ?></p>
                                            <p class="text-primary fw-bold" id="priceDisplay<?= $item['product_id']; ?>">
                                                ₱<?= number_format($item['price'], 2) ?></p>
    
                                            <form action="<?= route('controllers', 'addtocart') ?>" method="post">
                                                <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                                <input type="hidden" name="size_price" id="sizePrice<?= $item['product_id']; ?>"
                                                    value="<?php echo $item['price']; ?>">
                                                <input type="hidden" name="size_selected" id="sizeSelected<?= $item['product_id']; ?>">
                                                <input type="hidden" id="totalPrice<?= $item['product_id']; ?>" name="total_price"
                                                    value="<?= $item['price']; ?>">
    
                                                <?php if (!in_array($sectionId, ['breakfast', 'lunch', 'extra'])): ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input size-radio" type="radio" name="size" value="12oz"
                                                            id="size12oz<?= $item['product_id'] ?>" data-price="0" required>
                                                        <label class="form-check-label" for="size12oz<?= $item['product_id'] ?>">
                                                            <span class="rounded-circle border border-secondary p-1">
                                                                <img src="../assets/images/size/s.png" alt="" style="width: 90px;" class="img-fluid">
                                                            </span>
                                                            Small<br>
                                                            <small class="text-muted">12 fl oz</small>
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input size-radio" type="radio" name="size" value="16oz"
                                                            id="size16oz<?= $item['product_id'] ?>" data-price="30" required>
                                                        <label class="form-check-label" for="size16oz<?= $item['product_id'] ?>">
                                                            <span class="rounded-circle border border-secondary p-1">
                                                                <img src="../assets/images/size/m.png" alt="" style="width: 90px;" class="img-fluid">
                                                            </span>
                                                            Medium<br>
                                                            <small class="text-muted">16 fl oz</small>
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input size-radio" type="radio" name="size" value="22oz"
                                                            id="size22oz<?= $item['product_id'] ?>" data-price="50" required>
                                                        <label class="form-check-label" for="size22oz<?= $item['product_id'] ?>">
                                                            <span class="rounded-circle border border-secondary p-1">
                                                                <img src="../assets/images/size/l.png" alt="" style="width: 90px;" class="img-fluid">
                                                            </span>
                                                            Large<br>
                                                            <small class="text-muted">22 fl oz</small>
                                                        </label>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="text-end mt-4">
                                                    <button type="submit" name="addtocart"
                                                        class="btn btn-success rounded-pill px-4 py-2">Add to Order</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <script>
                    document.querySelectorAll('input[name="size"]').forEach((radio) => {
                        radio.addEventListener("change", function () {
                            let basePrice = <?= $item['price']; ?>;
                            let addedPrice = parseInt(this.getAttribute("data-price"));
                            let finalPrice = basePrice + addedPrice;

                            document.getElementById("priceDisplay<?= $item['product_id']; ?>").innerText = "₱" + finalPrice.toFixed(2);
                            document.getElementById("sizePrice<?= $item['product_id']; ?>").value = finalPrice;
                            document.getElementById("sizeSelected<?= $item['product_id']; ?>").value = this.value;
                            document.getElementById("totalPrice<?= $item['product_id']; ?>").value = finalPrice;
                        });
                    });
                </script>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>

    <?php include BASE_PATH . 'components/user/footer.php'; ?>

    <style>
        .sidebar {
            background-color: #fff;
            border-right: 1px solid #e9ecef;
            padding: 20px;
        }

        .sidebar-heading {
            font-weight: bold;
            color: #333;
            margin: 20px 0 10px;
        }

        .sidebar-item {
            display: block;
            padding: 8px 0;
            color: #666;
            text-decoration: none;
            transition: padding-left 0.3s;
        }

        .sidebar-item:hover {
            color: #0d6efd;
            padding-left: 5px;
        }
    </style>

</body>

</html>