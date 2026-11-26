<?php
include '../conn/conn.php';
require_admin();

$orderIds = isset($_POST['O_ID']) && is_array($_POST['O_ID']) ? $_POST['O_ID'] : [];
$emsCodes = isset($_POST['EMS']) && is_array($_POST['EMS']) ? $_POST['EMS'] : [];

$query = false;
foreach ($orderIds as $i => $rawId) {
    $O_ID = (int)$rawId;
    $EMS = mysqli_real_escape_string($conn, (string)($emsCodes[$i] ?? ''));
    $sql = "UPDATE orders SET O_Status='จัดส่งแล้ว', O_EMS='$EMS' WHERE O_ID = $O_ID";
    $query = mysqli_query($conn, $sql);
}

if ($query) {
    echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
} else {
    echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
}
echo "<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./Mainadmin.php'>";
