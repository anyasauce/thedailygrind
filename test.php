<?php include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "Testing Area | Home";
include BASE_PATH . 'components/user/head.php';
?>

<body class="bg-light">
    <?php include BASE_PATH . 'components/user/header.php'; ?>

    <div class="container" style="margin-top: 200px; margin-bottom: 400px;">
        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#testModal">Test Button</button>
        <div class="modal fade" id="testModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white border-0">
                        <h5 class="modal-title fw-bold" id="exampleModalLabel">
                            <i class="bi bi-cup-hot-fill me-2"></i>Customer Order
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0" id="printSection">
                        <div class="receipt-header text-center py-4 bg-primary text-white">
                            <h4 class="mb-0 fw-bold">THE DAILY GRIND</h4>
                            <small>Premium Coffee Experience</small>
                        </div>

                        <div class="p-4">
                            <div class="bg-light p-3 rounded mb-4">
                                <div class="text-center mb-3">
                                    <h5 class="fw-bold mb-0">Josiah Danielle Gallenero</h5>
                                    <div class="badge bg-primary text-white my-2">ORDER #1234</div>
                                    <div class="small">05/16/2025 • 4 Items</div>
                                </div>

                                <div class="d-flex align-items-center my-3">
                                    <div class="flex-grow-1 border-bottom"></div>
                                    <div class="mx-3"><i class="bi bi-cup"></i></div>
                                    <div class="flex-grow-1 border-bottom"></div>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                                        <span class="fw-bold">Item 1</span>
                                        <span>×1</span>
                                    </div>
                                    <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                                        <span class="fw-bold">Item 2</span>
                                        <span>×1</span>
                                    </div>
                                    <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                                        <span class="fw-bold">Item 3</span>
                                        <span>×1</span>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <span class="fw-bold">Item 4</span>
                                        <span>×1</span>
                                    </div>
                                </div>

                                <div class="mt-4 mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="flex-grow-1 border-bottom"></div>
                                        <div class="mx-3"><i class="bi bi-credit-card"></i></div>
                                        <div class="flex-grow-1 border-bottom"></div>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2 mb-2">
                                        <span class="fw-bold">Payment Method:</span>
                                        <span>GCash / COD</span>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <span class="fw-bold">Delivery Method:</span>
                                        <span>Pickup / Delivery</span>
                                    </div>
                                </div>

                                <hr>

                                <div class="text-center mt-4">
                                    <p class="mb-1">Thanks for purchasing at</p>
                                    <h6 class="fw-bold">THE DAILY GRIND</h6>
                                    <small class="text-muted">Enjoy your coffee!</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-0 bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-dark" onclick="printDirectly()">
                            <i class="bi bi-printer-fill me-1"></i> Print
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <style type="text/css" media="print">
            body * {
                visibility: hidden;
            }
            #printSection, #printSection * {
                visibility: visible;
            }
            #printSection {
                position: absolute;
                left: 0;
                top: 0;
                width: 60mm;
                max-width: 60mm;
                font-size: 7px;
                text-align: center;
            }
            h4, h5, h6 {
                font-size: 8px; 
                margin: 1px 0;
            }
            .bg-primary {
                background-color: #6c63ff !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .badge {
                font-size: 7px;
                padding: 1px 3px;
            }
            p, small {
                font-size: 6px;
                margin: 0;
            }
            .d-flex {
                font-size: 7px;
                padding: 0px;
                margin: 0;
            }
            .card {
                padding: 5px;
                margin: 2px;
            }
            .receipt-header{
                display: none !important;
                visibility: hidden !important;
            }
        </style>

        <script>
            function printDirectly() {
                window.print();
            }
        </script>
    </div>
    <?php include BASE_PATH . 'components/user/footer.php'; ?>

</body>

</html>



