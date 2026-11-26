<?php
include '../conn/conn.php';
$uid = require_login();
$ID = (int)($_GET['ID'] ?? 0);

// Only the owner may delete, and only while the order is still a cart item.
$deleted = false;
if (user_owns_order($conn, $ID, $uid)) {
    $query = mysqli_query($conn, "DELETE FROM orders WHERE O_ID = $ID AND U_ID = $uid AND O_Status = 'ยืนยันการสั่งซื้อ'");
    if ($query && mysqli_affected_rows($conn) > 0) {
        mysqli_query($conn, "DELETE FROM orderdetail WHERE O_ID = $ID");
        $deleted = true;
    }
}

if ($deleted) {
    echo '<script type="text/javascript">alert("สำเร็จ");</script>';
} else {
    echo "<h1>Error</h1>";
}
echo "<META HTTP-EQUIV ='Refresh' CONTENT = '2;URL= ../user/Market.php'>";
