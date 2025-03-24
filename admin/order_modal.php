<?php
if (!isset($order)) {
    return;
}

$deliveryMethod = $order['delivery_method'];
$currentStatus = $order['status'];

$pickupStatuses = ['Pending', 'Processing', 'Ready for Pickup', 'Completed', 'Cancelled'];
$deliveryStatuses = ['Pending', 'Processing', 'On the Way', 'Completed', 'Cancelled'];

$statusOptions = ($deliveryMethod === 'pickup') ? $pickupStatuses : $deliveryStatuses;
?>

<div class="modal fade" id="orderModal<?php echo $order['Order ID']; ?>" tabindex="-1"
    aria-labelledby="orderModalLabel<?php echo $order['Order ID']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel<?php echo $order['Order ID']; ?>">Order Details -
                    #<?php echo $order['Order ID']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Customer Information</h6>
                        <p><strong>Name:</strong> <?php echo $order['Customer Name']; ?></p>
                        <p><strong>Email:</strong> <?php echo $order['Customer Email']; ?></p>
                        <p><strong>Phone:</strong> <?php echo $order['phone']; ?></p>
                        <p><strong>Address:</strong> <?php echo $order['address']; ?></p>

                        <form method="POST" action="<?= route('admin', 'updateOrderStatus') ?>">
                            <input type="hidden" name="order_id" value="<?php echo $order['Order ID']; ?>">
                        
                            <div class="form-group">
                                <label for="status fw-bold">Update Status:</label>
                                <select class="form-control" id="status<?php echo $order['Order ID']; ?>" name="status">
                                    <?php foreach ($statusOptions as $status): ?>
                                        <option value="<?php echo $status; ?>" <?php
                                           $validTransitions = [
                                               'Pending' => ['Processing'],
                                               'Processing' => ['Ready for Pickup', 'On the Way'],
                                               'Ready for Pickup' => ['Completed'],
                                               'On the Way' => ['Completed'],
                                               'Completed' => [],
                                               'Cancelled' => []
                                           ];
                                           if ($currentStatus !== $status && !in_array($status, $validTransitions[$currentStatus])) {
                                               echo 'disabled';
                                           }
                                           if ($currentStatus == $status) {
                                               echo ' selected style="font-weight: bold; background-color: #d1e7dd;"';
                                           }
                                           ?>>
                                            <?php echo $status; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        
                            <button type="submit" class="btn btn-success mt-2">Update Status</button>
                        </form>

                    </div>

                    <div class="col-md-6">
                        <h6>Order Information</h6>
                        <p><strong>Items:</strong> <?php echo $order['items']; ?></p>
                        <p><strong>Total:</strong> ₱<?php echo number_format($order['total'], 2); ?></p>
                        <p><strong>Tax:</strong> ₱<?php echo number_format($order['tax'], 2); ?></p>
                        <p><strong>Delivery Fee:</strong> ₱<?php echo number_format($order['delivery_fee'], 2); ?></p>
                        <p><strong>Payment Method:</strong> <?php echo $order['payment_method']; ?></p>
                        <p><strong>Delivery Method:</strong> <?php echo $order['delivery_method']; ?></p>
                        <p><strong>Notes:</strong> <?php echo $order['notes'] ? $order['notes'] : 'N/A'; ?></p>

                        <p><strong>Ordered At:</strong>
                            <?php echo date('F j, Y, g:i a', strtotime($order['created_at'])); ?></p>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>