<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'config/routes.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Daily Grind | Register</title>
    <link rel="stylesheet" href="/thedailygrind/assets/vendor/bootstrap/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/thedailygrind/assets/vendor/bootstrap/bootstrap5.min.css">
    <link rel="stylesheet" href="/thedailygrind/assets/vendor/googlefont/googlefont.min.css">
    <link rel="stylesheet" href="/thedailygrind/assets/vendor/aos/aos.min.css">
    <link rel="stylesheet" href="/thedailygrind/assets/vendor/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="/thedailygrind/assets/css/auth/auth.css">
    <link rel="stylesheet" href="/thedailygrind/assets/css/landing/main.css">
</head>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/components/user/header.php'; ?>

    <div class="bg-glow glow-1"></div>
    <div class="bg-glow glow-2"></div>

    <div class="container login-container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-8" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="300">
                <div class="card shadow-lg p-4">
                    <div class="login-card-header" data-aos="fade-down" data-aos-duration="600" data-aos-delay="600">
                        <h2 class="text-center mb-0">Create an Account</h2>
                    </div>
                    <form action="<?= route('controllers', 'auth_controller') ?>" class="needs-validation" novalidate method="POST">
                        <div class="form-floating mb-4" data-aos="fade-up" data-aos-duration="600" data-aos-delay="700">
                            <input type="text" class="form-control" id="floatingFullname" name="fullname"
                                placeholder="Fullname" required>
                            <label for="floatingFullname"><i class="bi bi-person me-2"></i>Fullname</label>
                            <div class="invalid-feedback">
                                Please enter your fullname.
                            </div>
                        </div>

                        <div class="form-floating mb-4" data-aos="fade-up" data-aos-duration="600" data-aos-delay="800">
                            <input type="email" class="form-control" id="floatingEmail" name="email"
                                placeholder="name@example.com" required>
                            <label for="floatingEmail"><i class="bi bi-envelope me-2"></i>Email address</label>
                            <div class="invalid-feedback">
                                Please enter a valid email address.
                            </div>
                        </div>

                        <div class="form-floating mb-4 input-with-icon" data-aos="fade-up" data-aos-duration="600"
                            data-aos-delay="900">
                            <input type="password" class="form-control" id="floatingPassword" name="password"
                                placeholder="Password" required>
                            <label for="floatingPassword"><i class="bi bi-lock me-2"></i>Password</label>
                            <div class="input-icon" id="togglePassword">
                                <i class="bi bi-eye-slash"></i>
                            </div>
                            <div class="invalid-feedback">
                                Please enter your password.
                            </div>
                        </div>

                        <div class="mb-4" data-aos="fade-up" data-aos-duration="600" data-aos-delay="950">
                            <div class="fw-bold">
                                <label>What is <span id="num1"></span> + <span id="num2"></span>?</label>
                            </div>
                            <input type="number" id="captcha" class="form-control mt-3" placeholder="Enter the answer" required>
                            <div class="invalid-feedback">
                                Please solve the captcha.
                            </div>
                        </div>

                        <button type="submit" name="register" id="submitBtn" class="btn btn-primary w-100 p-2" data-aos="fade-up"
                            data-aos-duration="600" data-aos-delay="1000" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span class="btn-text">Sign Up</span>
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 d-flex flex-column justify-content-center align-items-center mb-4 mb-lg-0" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
                <div class="company-logo">
                    <img src="/thedailygrind/assets/images/auth.png" alt="Boadring House Logo" width="140" height="140">
                    <!-- <svg viewBox="0 0 140 140" xmlns="http://www.w3.org/2000/svg">
                        <rect x="15" y="50" width="110" height="75" rx="8" fill="#4f8df9" />
                        <path d="M70 15 L135 50 L5 50 Z" fill="#5f9bff" />
                        <rect x="55" y="75" width="30" height="50" rx="4" fill="#121212" />
                        <circle cx="65" cy="100" r="3" fill="#8c75ff" />
                        <rect x="30" y="70" width="15" height="25" rx="3" fill="#121212" />
                        <rect x="95" y="70" width="15" height="25" rx="3" fill="#121212" />
                        <rect x="33" y="73" width="9" height="3" rx="1" fill="rgba(255,255,255,0.3)" />
                        <rect x="98" y="73" width="9" height="3" rx="1" fill="rgba(255,255,255,0.3)" />
                        <circle cx="120" cy="40" r="8" fill="#8c75ff" />
                    </svg> -->
                </div>
                <div class="company-info">
                    <h1 class="company-name">TheDailyGrind</h1>
                    <p class="company-address">123 Digital Avenue, Iloilo City<br>Philippines, 5000</p>
                </div>
            </div>
        </div>
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
    </div>

    <script src="/thedailygrind/assets/vendor/bootstrap/bootstrap5.bundle.min.js"></script>
    <script src="/thedailygrind/assets/vendor/aos/aos.min.js"></script>
    <script src="/thedailygrind/assets/vendor/sweetalert2/sweetalert2.js"></script>
    <script src="/thedailygrind/assets/js/auth/auth.js"></script>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/components/sweetalert.php'; ?>

</body>

</html>