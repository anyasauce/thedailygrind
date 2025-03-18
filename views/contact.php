<!DOCTYPE html>
<html lang="en">
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
$pageTitle = "The Daily Grind | Contact";
include BASE_PATH . 'components/user/head.php';
?>

<body class="bg-light">
    <?php include BASE_PATH . 'components/user/header.php'; ?>

    <main>
        <section class="contact py-5 mt-5" id="contact" data-aos="fade-up" data-aos-duration="1000"
            data-aos-delay="100">
            <div class="container">
                <div class="section-title" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
                    <h2>Get In Touch</h2>
                    <p>Have questions? We're here to help you on your digital journey</p>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-left" data-aos-duration="1000"
                        data-aos-delay="100">
                        <form id="contactForm" class="contact-form">
                            <div class="row">
                                <div class="col-md-6 mb-3" data-aos="fade-up" data-aos-duration="1000"
                                    data-aos-delay="100">
                                    <input type="text" class="form-control" id="name" placeholder="Your Name" required>
                                </div>
                                <div class="col-md-6 mb-3" data-aos="fade-up" data-aos-duration="1000"
                                    data-aos-delay="200">
                                    <input type="email" class="form-control" placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="mb-3" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                                <input type="text" class="form-control" placeholder="Subject">
                            </div>
                            <div class="mb-3" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                                <textarea class="form-control" rows="5" placeholder="Your Message" required></textarea>
                            </div>
                            <button type="submit" id="submitContact" class="btn btn-primary rounded-pill px-4" data-aos="fade-up"
                                data-aos-duration="1000" data-aos-delay="500">Send Message</button>
                        </form>
                    </div>
                    <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
                        <div class="contact-info">
                            <div class="d-flex mb-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                                <div class="me-3">
                                    <i class="fas fa-map-marker-alt text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h5>Our Location</h5>
                                    <p>123 Digital Avenue, Iloilo City<br>Philippines, 5000</p>
                                </div>
                            </div>
                            <div class="d-flex mb-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                                <div class="me-3">
                                    <i class="fas fa-envelope text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h5>Email Us</h5>
                                    <p>info@thedailygrind.com</p>
                                </div>
                            </div>
                            <div class="d-flex" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                                <div class="me-3">
                                    <i class="fas fa-phone-alt text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h5>Call Us</h5>
                                    <p>+1 (555) 123-4567</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
        </section>
    </main>

    <?php include BASE_PATH . 'components/user/footer.php'; ?>

    <script>
        document.getElementById('submitContact').addEventListener('click', function (e){
            e.preventDefault();

            const name = document.getElementById('name').value;

            Swal.fire({
                title: "Message Sent! " + name,
                text: "Your message has been sent. We will get back to you soon!",
                icon: "success",
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>

</body>

</html>