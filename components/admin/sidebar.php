<?php
// Get current page filename
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- Sidebar -->
<aside id="sidebar">
    <div class="brand">
        <a href="<?= route('admin', 'dashboard') ?>">
            <i class="fas fa-coffee"></i>
            <span class="brand-text">TheDailyGrind</span>
        </a>
        <button id="toggleSidebar" class="btn btn-sm d-lg-none">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div class="menu-category">Main</div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'admin.php') ? 'active' : ''; ?>" href="<?= route('admin', 'dashboard') ?>">
                <i class="fas fa-home"></i>
                <span class="nav-text">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'analytics.php') ? 'active' : ''; ?>" href="<?= route('admin', key: 'analytics') ?>">
                <i class="fas fa-chart-bar"></i>
                <span class="nav-text">Analytics</span>
            </a>
        </li>
    </ul>

    <div class="menu-category">Management</div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'users.php') ? 'active' : ''; ?>" href="<?= route('admin', key: 'users') ?>">
                <i class="fas fa-users"></i>
                <span class="nav-text">Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'products.php') ? 'active' : ''; ?>" href="<?= route('admin', key: 'products') ?>">
                <i class="fas fa-file-alt"></i>
                <span class="nav-text">Products</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'orders.php') ? 'active' : ''; ?>" href="<?= route('admin', 'orders') ?>">
                <i class="fas fa-shopping-cart"></i>
                <span class="nav-text">Orders</span>
            </a>
        </li>
    </ul>
</aside>