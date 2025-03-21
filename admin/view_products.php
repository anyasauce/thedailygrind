<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/admin/admin_session.php';

$getProducts = mysqli_query($conn, "SELECT * FROM products ORDER BY product_id DESC");

if (!isset($_GET['category_id']) || !isset($_GET['category_name'])) {
    echo "<script>alert('Invalid category selection.'); window.location.href = 'admin_dashboard.php';</script>";
    exit;
}

$category_id = $_GET['category_id'];
$category_name = urldecode($_GET['category_name']);
?>

<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "The Daily Grind | Products";
include '../components/admin/head.php'; ?>

<body>
    <?php include '../components/admin/sidebar.php'; ?>

    <div class="sidebar-overlay"></div>

    <div id="content">
        <?php include '../components/admin/header.php'; ?>

        <section>
            <div class="container-fluid">
                <h2 class="my-4">Products in <?= htmlspecialchars($category_name); ?></h2>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#productModal">
                    Add Product
                </button>

                <div class="row">
                    <?php
                    $products = $conn->query("SELECT * FROM products WHERE category = '{$category_name}'");
                    $getSolds = $conn->query("
                        SELECT p.product_name, SUM(oi.quantity) AS total_solds 
                        FROM order_items oi
                        JOIN products p ON oi.product_id = p.product_id
                        JOIN orders o ON oi.order_id = o.order_id
                        WHERE o.status = 'Completed'
                        GROUP BY p.product_name
                    ");

                    if ($products->num_rows > 0):
                        while ($product = $products->fetch_assoc()):
                            ?>
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-lg border-0 rounded-3 overflow-hidden h-100">

                                <div class="mb-3 fw-bold text-success fs-6">
                                    <?php
                                        $total_solds = 0;

                                        while ($row = $getSolds->fetch_assoc()) {
                                            $total_solds += $row['total_solds'];
                                        }
                                        ?>
                                    Total Sold: <?= htmlspecialchars($total_solds); ?>
                                </div>

                                <div class="position-relative">
                                    <img src="/thedailygrind/<?= htmlspecialchars($product['image']); ?>"
                                        class="card-img-top object-fit-cover d-block mx-auto" alt="<?= htmlspecialchars($product['product_name']); ?>"
                                        style="height: 150px; width: 60%;">

                                    <span class="position-absolute top-0 end-0 badge <?= $product['status'] === 'Available' ? 'bg-success' : 'bg-danger' ?> m-2 px-2 py-1 rounded-pill fw-normal">
                                        <?= htmlspecialchars($product['status']); ?>
                                    </span>
                                </div>

                                <div class="card-body d-flex flex-column p-3">
                                    <h5 class="card-title fw-bold mb-2"><?= htmlspecialchars($product['product_name']); ?></h5>
                                    <p class="card-text text-muted small mb-3" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        <?= htmlspecialchars($product['description']); ?>
                                    </p>

                                    <div class="mb-3 fw-bold text-primary fs-5">
                                        ₱<?= htmlspecialchars($product['price']); ?>
                                    </div>

                                   

                                    <div class="mt-auto d-flex gap-2">
                                        <button type="button" class="btn btn-primary flex-grow-1" data-bs-toggle="modal"
                                                    data-bs-target="#editproductModal<?= $product['product_id']; ?>">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </button>

                                        <button type="button" class="btn btn-outline-danger flex-grow-1" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal<?= $product['product_id']; ?>">
                                            <i class="bi bi-trash me-1"></i> Delete
                                        </button>
                                    </div>

                                </div>
                            </div>
                            </div>

                            <div class="modal fade" id="editproductModal<?= $product['product_id']; ?>" tabindex="-1" aria-labelledby="editproductModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Product: <?= htmlspecialchars($product['product_name']); ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <form action="<?= route('controllers', 'product_controller'); ?>" method="POST" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">

                                                <div class="row g-3">
                                                    <div class="col-md-6 mb-3">
                                                    <label class="form-label">Product Name</label>
                                                    <input type="text" class="form-control" name="product_name" required value="<?= htmlspecialchars($product['product_name']); ?>">
                                                    </div>
                                                    
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Price</label>
                                                        <input type="number" class="form-control" name="price" required value="<?= htmlspecialchars($product['price']); ?>">
                                                    </div>
                                                    
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label">Description</label>
                                                        <textarea class="form-control" name="description" rows="3"
                                                            required><?= htmlspecialchars($product['description']); ?></textarea>
                                                    </div>
                                                    
                                                    <input type="hidden" name="category" value="<?= htmlspecialchars($category_name); ?>">
                                                    
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label">Status</label>
                                                        <select class="form-select" name="status" required>
                                                            <option value="Available" <?= ($product['status'] == 'Available') ? 'selected' : ''; ?>>Available</option>
                                                            <option value="Out of Stock" <?= ($product['status'] == 'Out of Stock') ? 'selected' : ''; ?>>Out of Stock</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label">Product Image</label>
                                                        <?php if (!empty($product['image'])): ?>
                                                            <div class="mb-2">
                                                                <img src="/thedailygrind/<?= htmlspecialchars($product['image']); ?>" alt="Product Image" width="150">
                                                            </div>
                                                        <?php endif; ?>
                                                        <input type="file" class="form-control" name="image">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" name="update_products" class="btn btn-success">Save Changes</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="deleteModal<?= $product['product_id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <form action="<?= route('controllers', 'product_controller'); ?>" method="POST">
                                            <div class="modal-body">
                                                Are you sure you want to delete
                                                <strong><?= htmlspecialchars($product['product_name']); ?></strong>?
                                            </div>

                                            <div class="modal-footer">
                                                <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
                                                <button type="submit" name="delete_products" class="btn btn-danger">Delete</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                    <?php
                        endwhile;
                    else:
                        ?>
                        <div class="col-12 text-center">
                            <p class="alert alert-warning">No products available in this category.</p>
                        </div>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </section>

        <?php include '../components/admin/footer.php'; ?>
    </div>

    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Product Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

                <form action="<?= route('controllers', 'product_controller'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row g-3">
    
                            <div class="col-md-6">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="product_name" id="product_name" required>
                            </div>
    
                            <div class="col-md-6">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" name="price" id="price" required>
                            </div>
    
                            <div class="col-md-12">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3"
                                    required></textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" id="status" required>
                                    <option value="Available">Available</option>
                                    <option value="Out of Stock">Out of Stock</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Product Image</label>
                                <input type="file" class="form-control" name="image" id="image">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="category" value="<?= htmlspecialchars($category_name); ?>">
                        <button type="submit" name="add_products" class="btn btn-success">Save Product</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>