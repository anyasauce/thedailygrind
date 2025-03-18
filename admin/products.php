<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/admin/admin_session.php';

$getProducts = mysqli_query($conn, "SELECT * FROM products ORDER BY product_id DESC");
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
                <h2 class="my-4">Product Management</h2>

                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#productModal">
                    Add Product
                </button>

                <div class="table-responsive">
                    <table id="productTable" class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($product = mysqli_fetch_assoc($getProducts)): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($product['product_id']); ?></td>
                                    <td><img src="/thedailygrind/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image" width="50"></td>
                                    <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                                    <td><?php echo htmlspecialchars($product['description']); ?></td>
                                    <td><?php echo htmlspecialchars($product['price']); ?></td>
                                    <td><?php echo htmlspecialchars($product['category']); ?></td>
                                    <td><?php echo htmlspecialchars($product['status']); ?></td>
                                    <td>
                                        <div class="text-nowrap">
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editproductModal<?php echo $product['product_id']; ?>">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal<?php echo $product['product_id']; ?>">
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Delete Product Modal -->
                                <div class="modal fade" id="deleteModal<?php echo $product['product_id']; ?>" tabindex="-1"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <form action="<?= route('controllers', 'product_controller'); ?>" method="POST">
                                                <div class="modal-body">
                                                    Are you sure you want to delete
                                                    <strong><?php echo htmlspecialchars($product['product_name']); ?></strong>?
                                                </div>

                                                <div class="modal-footer">
                                                    <input type="hidden" name="product_id"value="<?php echo $product['product_id']; ?>">
                                                    <button type="submit" name="delete_products" class="btn btn-danger">Delete</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="editproductModal<?php echo $product['product_id']; ?>" tabindex="-1" aria-labelledby="editproductModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editproductModalLabel">Edit Product for <?php echo htmlspecialchars($product['product_name']); ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="<?= route('controllers', 'product_controller'); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="row g-3">
                                                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

                                                        <div class="col-md-6">
                                                            <label class="form-label">Product Name</label>
                                                            <input type="text" class="form-control" name="product_name" id="product_name" required value="<?php echo htmlspecialchars($product['product_name']); ?>">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label">Price</label>
                                                            <input type="number" class="form-control" name="price" id="price" required value="<?php echo htmlspecialchars($product['price']); ?>">
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label class="form-label">Description</label>
                                                            <textarea class="form-control" name="description" id="description" rows="3" required><?php echo htmlspecialchars($product['description'] ?? ''); ?></textarea>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label">Category</label>
                                                            <select class="form-select" name="category" id="category" required>
                                                                <option value="" disabled>Select Category</option>
                                                                <option value="Hot Coffee" <?php echo ($product['category'] == 'Hot Coffee') ? 'selected' : ''; ?>>Hot Coffee</option>
                                                                <option value="Cold Coffee" <?php echo ($product['category'] == 'Cold Coffee') ? 'selected' : ''; ?>>Cold Coffee</option>
                                                                <option value="Hot Tea" <?php echo ($product['category'] == 'Hot Tea') ? 'selected' : ''; ?>>Hot Tea</option>
                                                                <option value="Breakfast" <?php echo ($product['category'] == 'Breakfast') ? 'selected' : ''; ?>>Breakfast</option>
                                                                <option value="Lunch" <?php echo ($product['category'] == 'Lunch') ? 'selected' : ''; ?>>Lunch</option>
                                                                <option value="Extra" <?php echo ($product['category'] == 'Extra') ? 'selected' : ''; ?>>Extra</option>
                                                            </select>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <label class="form-label">Status</label>
                                                            <select class="form-select" name="status" id="status" required>
                                                                <option value="Available" <?php echo ($product['status'] == 'Available') ? 'selected' : ''; ?>>Available</option>
                                                                <option value="Out of Stock" <?php echo ($product['status'] == 'Out of Stock') ? 'selected' : ''; ?>>Out of Stock
                                                                </option>
                                                            </select>
                                                        </div>
                                                        
                                                        <div class="col-md-12">
                                                            <label class="form-label">Product Image</label>
                                                            <?php if (!empty($product['image'])): ?>
                                                                <div class="mb-2">
                                                                    <img src="/thedailygrind/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image" width="150">
                                                                </div>
                                                            <?php endif; ?>
                                                            <input type="file" class="form-control" name="image" id="image">
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="update_products" class="btn btn-success">Save Product</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <?php include '../components/admin/footer.php'; ?>
    </div>

    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
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
                                <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Category</label>
                                <select class="form-select" name="category" id="category" required>
                                    <option value="" disabled selected>Select Category</option>
                                    <option value="Hot Coffee">Hot Coffee</option>
                                    <option value="Cold Coffee">Cold Coffee</option>
                                    <option value="Hot Tea">Hot Tea</option>
                                    <option value="Breakfast">Breakfast</option>
                                    <option value="Lunch">Lunch</option>
                                    <option value="Extra">Extra</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" id="status" required>
                                    <option value="Available">Available</option>
                                    <option value="Out of Stock">Out of Stock</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Product Image</label>
                                <input type="file" class="form-control" name="image" id="image">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="add_products" class="btn btn-success">Save Product</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#productTable').DataTable();
        });
    </script>
</body>

</html>