<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';

if (isset($_POST['add_products'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $image = '';

    if (!empty($_FILES['image']['name'])) {
        $category = isset($_POST['category']) ? $_POST['category'] : 'Uncategorized';

        $upload_root = $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/assets/images/uploads/';
        $category_folder = $upload_root . $category;

        if (!is_dir($category_folder)) {
            mkdir($category_folder, 0777, true);
        }

        $image_name = time() . '_' . basename($_FILES['image']['name']);
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = $category_folder . '/' . $image_name;

        if (move_uploaded_file($image_tmp, $image_path)) {
            $image = 'assets/images/uploads/' . $category . '/' . $image_name;
        } else {
            $_SESSION['message'] = "Image upload failed";
            $_SESSION['type'] = "error";
            ?>
            <script>
                location.href = "<?= route('admin', 'products'); ?>";
            </script>
            <?php
        }
    }

    $addProducts = mysqli_query($conn, "INSERT INTO products (product_name, price, description, category, status, image)
    VALUES ('$product_name', '$price', '$description', '$category', '$status', '$image')");

    if ($addProducts) {
        $_SESSION['message'] = "Product Added!";
        $_SESSION['type'] = "success";
        ?>
        <script>
            location.href="<?= route('admin', 'products'); ?>";
        </script>
        <?php
        exit();
    } else {
        $_SESSION['message'] = "Error updating product.";
        $_SESSION['type'] = "error";
        ?>
        <script>
            location.href = "<?= route('admin', 'products'); ?>";
        </script>
        <?php
    }
}

if (isset($_POST['update_products'])) {
    $product_id = $_POST['product_id'];
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $result = mysqli_query($conn, "SELECT image FROM products WHERE product_id = '$product_id'");
    $row = mysqli_fetch_assoc($result);
    $image = $row['image'];

    if (!empty($_FILES['image']['name'])) {
        if (!empty($image)) {
            $image_path = $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/' . $image;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        $category = isset($_POST['category']) ? $_POST['category'] : 'Uncategorized';
        $upload_root = $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/assets/images/uploads/';
        $category_folder = $upload_root . $category;

        if (!is_dir($category_folder)) {
            mkdir($category_folder, 0777, true);
        }

        $image_name = strtolower(str_replace(' ', '_', $product_name)) . '_' . time() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = $category_folder . '/' . $image_name;

        if (move_uploaded_file($image_tmp, $image_path)) {
            $image = 'assets/images/uploads/' . $category . '/' . $image_name;
        } else {
            $_SESSION['message'] = "Image upload failed";
            $_SESSION['type'] = "error";
            ?>
            <script>
                location.href = "<?= route('admin', 'products'); ?>";
            </script>
            <?php
            exit();
        }
    }

    $updateProducts = mysqli_query($conn, "UPDATE products SET
    product_name = '$product_name',
    price = '$price',
    description = '$description',
    category = '$category',
    status = '$status',
    image = '$image'
    WHERE product_id = '$product_id'");

    if ($updateProducts) {
        $_SESSION['message'] = "Product Updated!";
        $_SESSION['type'] = "success";
        ?>
        <script>
            location.href = "<?= route('admin', 'products'); ?>";
        </script>
        <?php
        exit();
    } else {
        $_SESSION['message'] = "Error updating product.";
        $_SESSION['type'] = "error";
        ?>
        <script>
            location.href = "<?= route('admin', 'products'); ?>";
        </script>
        <?php
    }
}

if(isset($_POST['delete_products'])){
    $product_id = $_POST['product_id'];

    $deleteProducts = mysqli_query($conn, "DELETE FROM products WHERE product_id = '$product_id'");
    if ($deleteProducts) {
        $_SESSION['message'] = "Product Deleted!";
        $_SESSION['type'] = "success";
        ?>
        <script>
            location.href = "<?= route('admin', 'products'); ?>";
        </script>
        <?php
        exit();
    } else {
        $_SESSION['message'] = "Error deleting product.";
        $_SESSION['type'] = "error";
        ?>
        <script>
            location.href = "<?= route('admin', 'products'); ?>";
        </script>
        <?php
    }
}

if(isset($_POST['add_category'])){
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);

    $addCategory = mysqli_query($conn, "INSERT INTO category (category_name) VALUES ('$category_name')");

    if($addCategory){
        $_SESSION['message'] = "Added Category!";
        $_SESSION['type'] = "success";
        ?>
        <script>
            location.href = "<?= route('admin', 'products'); ?>";
        </script>
        <?php
        exit();
    } else {
        $_SESSION['message'] = "Error adding category.";
        $_SESSION['type'] = "error";
        ?>
        <script>
            location.href = "<?= route('admin', 'products'); ?>";
        </script>
        <?php
    }

}

?>