<?php
include '../conn/conn.php';
$uid = require_login();
$quantity = (int)($_POST['quantity'] ?? 0);
$o_id = (int)($_POST['O_ID'] ?? 0);

// Quantity can only change while the order is still in the cart.
$query = false;
if ($quantity > 0) {
    $query = mysqli_query($conn, "UPDATE orderdetail
        INNER JOIN orders ON orders.O_ID = orderdetail.O_ID
        SET orderdetail.OD_Unit = $quantity
        WHERE orderdetail.O_ID = $o_id AND orders.U_ID = $uid AND orders.O_Status = 'ยืนยันการสั่งซื้อ'");
}

if ($query && mysqli_affected_rows($conn) > 0) {
    echo "<script type='text/javascript'>alert('สำเร็จ');</script>";
} else {
    echo "<script type='text/javascript'>alert('ERROR');</script>";
}
echo "<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./Market.php'>";
