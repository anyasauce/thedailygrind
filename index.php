<?php
include __DIR__ . '/config/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "The Daily Grind | Home";
include __DIR__ . '/components/user/head.php';
?>

<body class="bg-light">
    <?php include __DIR__ . '/components/user/header.php'; ?>

    <main>

        <section class="hero" id="home">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 hero-content" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        <h1 class="mb-4">Welcome to TheDailyGrind Coffee Shop</h1>
                        <p class="mb-4">Experience the finest coffee blends and a cozy atmosphere. We brew happiness in
                            every cup, offering you a delightful coffee journey every time you visit.</p>
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="<?= route('user', 'menu'); ?>" class="btn btn-primary btn-lg rounded-pill px-4">Order Now</a>
                            <a href="#features" class="btn btn-outline-dark btn-lg rounded-pill px-4">Learn More</a>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-left" data-aos-duration="5000" data-aos-delay="100">
                        <img src="assets/images/hero.png" alt="Coffee Cup" class="img-fluid hero-img">
                    </div>
                </div>
            </div>
            <div class="shape shape-2"></div>
        </section>

        <section id="about" class="py-5 bg-light" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
                        <img src="assets/images/logo.png" alt="About TheDailyGrind Coffee Shop"
                            class="img-fluid rounded">
                    </div>
                    <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="100">
                        <div class="section-title">
                            <h2 class="mb-4">About TheDailyGrind</h2>
                            <p>At TheDailyGrind Coffee Shop, we believe in brewing perfection. Our team is
                                passionate about providing the best coffee experience with quality beans, expert brewing
                                techniques, and a warm ambiance.</p>
                            <p>We are committed to delivering exceptional service and creating a welcoming space where
                                coffee lovers can unwind, connect, and savor every sip.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="features" id="features" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
            <div class="container">
                <div class="section-title">
                    <h2>Our Special Offerings</h2>
                    <p>Explore our delicious range of beverages and treats crafted to delight your taste buds.</p>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="200">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="bi bi-cup-fill"></i>
                            </div>
                            <h4>Signature Blends</h4>
                            <p>Indulge in our carefully curated coffee blends, crafted to deliver rich and bold flavors.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="bi bi-cup-hot-fill"></i>
                            </div>
                            <h4>Warm Atmosphere</h4>
                            <p>Relax in our cozy environment designed to make you feel right at home.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="400">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="bi bi-cookie"></i>
                            </div>
                            <h4>Delicious Treats</h4>
                            <p>Complement your coffee with our wide selection of freshly baked pastries and snacks.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="testimonials" id="testimonials" data-aos="fade-up" data-aos-duration="1000"
            data-aos-delay="100">
            <div class="container">
                <div class="section-title">
                    <h2>Our Happy Customers</h2>
                    <p>Discover why our customers love TheDailyGrind Coffee Shop.</p>
                </div>
                <div class="row testimonial-slider">
                    <div class="col-md-4 mb-4" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="200">
                        <div class="testimonial-card">
                            <div class="testimonial-text">
                                <p>The best coffee shop in town! The aroma, the taste, and the ambiance make it my go-to
                                    spot every morning.</p>
                            </div>
                            <div class="testimonial-author">
                                <img src="assets/images/picture.jpg" alt="Client 1">
                                <div class="author-info">
                                    <h5>John Doe</h5>
                                    <small>Regular Customer</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="300">
                        <div class="testimonial-card">
                            <div class="testimonial-text">
                                <p>Love the cozy vibes and the delicious lattes. The staff is always friendly and
                                    welcoming!</p>
                            </div>
                            <div class="testimonial-author">
                                <img src="assets/images/picture.jpg" alt="Client 2">
                                <div class="author-info">
                                    <h5>Michael Wayne</h5>
                                    <small>Coffee Enthusiast</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="400">
                        <div class="testimonial-card">
                            <div class="testimonial-text">
                                <p>The pastries are a must-try! Perfect pairing with their specialty brews.</p>
                            </div>
                            <div class="testimonial-author">
                                <img src="assets/images/picture.jpg" alt="Client 3">
                                <div class="author-info">
                                    <h5>David Brown</h5>
                                    <small>Food Blogger</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php include BASE_PATH . 'components/user/footer.php'; ?>
</body>

</html>