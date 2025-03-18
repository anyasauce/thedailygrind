<footer>
    <div class="container" data-aos="fade-up" data-aos-duration="1000"
            data-aos-delay="100">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0" >
                <div class="footer-about" >
                    <a href="#" class="footer-logo text-white text-decoration-none">TheDailyGrind</a>
                    <p>Brewing the finest coffee and serving delightful moments, one cup at a time. Visit us to
                        experience the perfect blend of taste and comfort.</p>
                    <div class="social-links">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 mb-4 mb-md-0">
                <div class="footer-links">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="menu.php">Menu</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="footer-newsletter">
                    <h5>Newsletter</h5>
                    <p>Subscribe to our newsletter for the latest brews, special offers, and coffee tips.</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Your Email Address" required id="subscribeEmail">
                        <button type="submit" id="subscribe">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <span id="year"></span> TheDailyGrind. All Rights Reserved.</p>
        </div>
    </div>
    <div class="back-to-top">
        <i class="bi bi-arrow-up"></i>
    </div>
</footer>
<script src="/thedailygrind/assets/vendor/bootstrap/bootstrap5.bundle.min.js"></script>
<script src="/thedailygrind/assets/vendor/aos/aos.min.js"></script>
<script src="/thedailygrind/assets/vendor/sweetalert2/sweetalert2.js"></script>
<script src="/thedailygrind/assets/js/landing/index.js"></script>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/components/sweetalert.php'; ?>

<script>
    document.getElementById('subscribe').addEventListener('click', function (e) {
        e.preventDefault();

        const storedValue = document.getElementById('subscribeEmail').value;

        Swal.fire({
            title: "Subscribed!",
            text: "Hi you Subsribe to The Daily Grind, Stay tuned for new update of our latest products!\n\n\nEmail: " + storedValue,
            icon: "success",
            showConfirmButton: true,
        });
    });
</script>