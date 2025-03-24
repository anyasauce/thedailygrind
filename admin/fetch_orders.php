<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/admin/admin_session.php';

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'pending';

$query = "
    SELECT 
        o.order_id AS 'Order ID',
        u.fullname AS 'Customer Name',
        u.email AS 'Customer Email',
        o.phone,
        GROUP_CONCAT(CONCAT(p.product_name, ' (x', oi.quantity, ')') SEPARATOR ', ') AS items,
        SUM(oi.quantity) AS total_items,
        o.address,
        o.total,
        o.tax,
        o.delivery_fee,
        o.payment_method,
        o.delivery_method,
        o.notes,
        o.status,
        o.created_at
    FROM orders o
    JOIN users u ON o.user_id = u.user_id
    JOIN order_items oi ON o.order_id = oi.order_id
    JOIN products p ON oi.product_id = p.product_id
";

switch ($tab) {
    case 'pending':
        $query .= " WHERE o.status = 'Pending'";
        break;
    case 'processing':
        $query .= " WHERE o.status = 'Processing'";
        break;
    case 'pickup':
        $query .= " WHERE o.delivery_method = 'pickup'";
        break;
    case 'delivery':
        $query .= " WHERE o.delivery_method = 'delivery'";
        break;
    case 'complete':
        $query .= " WHERE o.status = 'Completed'";
        break;
    case 'cancelled':
        $query .= " WHERE o.status = 'Cancelled'";
        break;
    default:
        $query .= " WHERE o.status = 'Pending'";
        break;
}

$query .= " GROUP BY o.order_id ORDER BY o.created_at DESC";

$getOrders = mysqli_query($conn, $query);

$html = '';
while ($order = mysqli_fetch_assoc($getOrders)) {
    $html .= "
        <tr>
            <td>{$order['Order ID']}</td>
            <td>{$order['Customer Name']}</td>
            <td>{$order['Customer Email']}</td>
            <td>
                <button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#orderModal{$order['Order ID']}'>View Details</button>
    ";

    if ($tab === 'processing') {
        $html .= "
            <button class='btn btn-dark btn-sm' data-bs-toggle='modal' data-bs-target='#printModal{$order['Order ID']}'>
                <i class='bi bi-printer-fill'></i> Print Order
            </button>
        ";
    }

    $html .= "</td></tr>";

    ob_start();
    include 'order_modal.php';
    $html .= ob_get_clean();

    if ($tab === 'processing') {
        ob_start();
        include 'print_modal.php';
        $html .= ob_get_clean();
    }
}

echo $html;
?>