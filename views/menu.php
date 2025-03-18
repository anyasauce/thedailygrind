<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/user/user_session.php';

$isLoggedIn = isset($_SESSION['email']);

$query = "SELECT * FROM products";
$result = $conn->query($query);

$menuItems = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $category = strtolower(str_replace(' ', '_', $row['category']));
        $menuItems[$category][] = [
            'product_id' => $row['product_id'],
            'title' => $row['product_name'],
            'description' => $row['description'],
            'price' => $row['price'],
            'image' => $row['image']
        ];

    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<?php
$pageTitle = "The Daily Grind | Menu";
include BASE_PATH . 'components/user/head.php';
?>
<body class="bg-light">
    <?php include BASE_PATH . 'components/user/header.php';    ?>

    <div class="container-fluid mt-5">
        <div class="row">

            <!-- Sidebar -->
            <aside id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse mt-3" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
                <div class="position-sticky">
                    <div class="sidebar-heading">CATEGORIES</div>
                    <?php foreach ($menuItems as $sectionId => $items): ?>
                        <a href="#<?= $sectionId ?>" class="sidebar-item">> <?= ucfirst(str_replace('_', ' ', $sectionId)) ?></a>
                    <?php endforeach; ?>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 mt-5" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="100">
                <h1 class="text-center mb-4">Menu</h1>

                <?php foreach ($menuItems as $sectionId => $items): ?>
                    <section id="<?= $sectionId ?>" class="menu-section">
                        <h2 class="section-title text-start mb-4"><?= ucfirst(str_replace('_', ' ', $sectionId)) ?></h2>
                        <div class="row">
                            <?php foreach ($items as $item): ?>
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="menu-item">
                                        <div style="display: flex; justify-content: center; align-items: center; height: 170px;">
                                            <img src="/thedailygrind/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>"
                                                style="width: 150px; height: 150px; object-fit: cover; border-radius: 5px;">
                                        </div>

                                        <div class="menu-item-info">
                                            <h3 class="menu-item-title"><?= $item['title'] ?></h3>
                                            <p class="menu-item-description"><?= $item['description'] ?></p>
                                            <p class="menu-item-price">₱<?= number_format($item['price'], 2) ?></p>
                                            <?php if ($isLoggedIn): ?>
                                                <form action="<?= route('controllers', 'addtocart'); ?>" method="POST">
                                                    <input type="hidden" name="product_id" value="<?= isset($item['product_id']) ? $item['product_id'] : '' ?>">
                                                    <input type="hidden" name="product_name" value="<?= isset($item['product_name']) ? htmlspecialchars($item['product_name']) : '' ?>">
                                                    <button type="submit" name="addtocart" class="btn btn-primary mt-2">Add to Cart</button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endforeach; ?>
            </main>
        </div>
    </div>

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

        .menu-section {
            margin-bottom: 40px;
        }

        .menu-item {
            transition: transform 0.3s;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .menu-item img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .menu-item-info {
            padding: 15px;
        }

        .menu-item-title {
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 1.1rem;
        }

        .menu-item-description {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .menu-item-price {
            font-weight: bold;
            color: #0d6efd;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 30px;
            border-bottom: 2px solid #e9ecef;
        }

        .shopping-bag {
            color: #198754;
        }
    </style>

</body>
</html>
