<?php
include '../conn/conn.php';
$uid = require_login();

$sql = "SELECT * FROM orders ORDER BY C_ID DESC LIMIT 1";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($query);
$lest = (int)$result['C_ID'] + 1;

$gender = (int)($_POST['gender'] ?? 0);
$bank = (int)($_POST['bank'] ?? 0);
$orderIds = isset($_POST['check']) && is_array($_POST['check']) ? $_POST['check'] : [];

$updated = 0;
foreach ($orderIds as $rawId) {
    $num = (int)$rawId;
    $sqlsend = "UPDATE orders SET O_Status = 'รอการชำระ', Sn_id = $gender, Bk_id = $bank, C_ID = $lest
        WHERE O_ID = $num AND U_ID = $uid AND O_Status = 'ยืนยันการสั่งซื้อ'";
    if (mysqli_query($conn, $sqlsend)) {
        $updated += mysqli_affected_rows($conn);
    }
}

if ($updated > 0) {
    echo "<script type='text/javascript'>alert('สำเร็จ');</script>";
    echo "<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=../user/payment.php'>";
} else {
    echo "<script type='text/javascript'>alert('Error');</script>";
    echo "<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=../user/Market.php'>";
}
