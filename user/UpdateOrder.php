<?php
include '../conn/conn.php';
$uid = require_login();
$quantity = (int)($_POST['quantity'] ?? 0);
$o_id = (int)($_POST['O_ID'] ?? 0);

$query = false;
if ($quantity > 0 && user_owns_order($conn, $o_id, $uid)) {
    $query = mysqli_query($conn, "UPDATE orderdetail SET OD_Unit = $quantity WHERE O_ID = $o_id");
}

if ($query) {
    echo "<script type='text/javascript'>alert('สำเร็จ');</script>";
} else {
    echo "<script type='text/javascript'>alert('ERROR');</script>";
}
echo "<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./Market.php'>";
