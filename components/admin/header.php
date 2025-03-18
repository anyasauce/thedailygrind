<header class="main-header">
    <div>
        <button id="sidebarCollapseBtn" class="btn btn-sm">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div class="header-actions">
        <div class="input-group search-bar">
            <span class="input-group-text bg-white border-end-0">
                <i class="fas fa-search"></i>
            </span>
            <input type="text" class="form-control border-start-0" placeholder="Search...">
        </div>

        <a href="#" class="position-relative text-decoration-none header-actions">
            <i class="fas fa-bell fs-4 bell-icon"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
        </a>

        <div class="header-icon darkmode-toggle">
            <input type="checkbox" class="darkmode-checkbox" id="darkModeToggle">
            <label for="darkModeToggle" class="darkmode-label">
                <i class="fas fa-sun"></i>
                <i class="fas fa-moon"></i>
                <div class="darkmode-ball"></div>
            </label>
        </div>
        <div class="dropdown profile-dropdown">
            <a href="#" class="dropdown-toggle d-flex align-items-center" id="profileDropdown" data-bs-toggle="dropdown"
                aria-expanded="false">
                <img src="../assets/images/picture.jpg" alt="Profile" class="me-2">
                <div class="name">
                    <span class="d-none d-md-inline-block"><?php echo $name;?></span>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li class="px-3 py-2">
                    <div class="role">
                        <div class="dropdown"><strong><?= $email ?></strong></div>
                        <small class="dropdown">Administrator</small>
                    </div>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user me-2"></i> My Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="../controllers/logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</header>