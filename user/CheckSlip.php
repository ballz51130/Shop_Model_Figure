<?php
include '../conn/conn.php';
$uid = require_login();

function slip_finish($message)
{
    echo "<script type='text/javascript'>alert('" . $message . "');</script>";
    echo "<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./Market.php'>";
    exit;
}

$orderIds = isset($_POST['check']) && is_array($_POST['check']) ? $_POST['check'] : [];
if (count($orderIds) === 0) {
    slip_finish('ไม่สำเร็จ');
}

$image = store_uploaded_image('image', '../photo/Slip');
if ($image === false || $image === '') {
    slip_finish('ไฟล์สลิปไม่ถูกต้อง (jpg, png, gif, webp ไม่เกิน 5MB)');
}

$form_bank = mysqli_real_escape_string($conn, $_POST['FormBank'] ?? '');
$pay_lastnum = mysqli_real_escape_string($conn, $_POST['Pay_LastNum'] ?? '');
$pay_price = mysqli_real_escape_string($conn, $_POST['Pay_Price'] ?? '');
$pay_time = mysqli_real_escape_string($conn, $_POST['time'] ?? '');
$pay_date = mysqli_real_escape_string($conn, $_POST['date'] ?? '');
$imageSql = mysqli_real_escape_string($conn, $image);

$paid = 0;
$outOfStock = false;
foreach ($orderIds as $rawId) {
    $num = (int)$rawId;
    // Product, quantity and type come from the database, never from the form,
    // and only for the user's own orders that are still awaiting payment.
    $detailSql = "SELECT orderdetail.P_Number, orderdetail.OD_Unit, orderdetail.P_Status FROM orders
        INNER JOIN orderdetail ON orderdetail.O_ID = orders.O_ID
        WHERE orders.O_ID = $num AND orders.U_ID = $uid AND orders.O_Status = 'รอการชำระ' LIMIT 1";
    $detailQuery = mysqli_query($conn, $detailSql);
    $detail = $detailQuery ? mysqli_fetch_assoc($detailQuery) : null;
    if (!$detail) {
        continue;
    }
    $product = mysqli_real_escape_string($conn, $detail['P_Number']);
    $unit = (int)$detail['OD_Unit'];
    $status = (int)$detail['P_Status'];

    if ($status === 1) {
        // Atomic decrement: fails when stock is insufficient.
        mysqli_query($conn, "UPDATE product SET P_Unit = P_Unit - $unit WHERE P_Number = '$product' AND P_Unit >= $unit");
        if (mysqli_affected_rows($conn) < 1) {
            $outOfStock = true;
            continue;
        }
    } elseif ($status === 2) {
        mysqli_query($conn, "UPDATE product SET P_Unit = P_Unit + $unit WHERE P_Number = '$product'");
    } else {
        continue;
    }

    $sql = "INSERT INTO payment_tb(O_ID, Pay_Frombank, Pay_LastNum, Pay_Price, Pay_Time, Pay_Date, Pay_Img)
        VALUES ('$num','$form_bank','$pay_lastnum','$pay_price','$pay_time','$pay_date','$imageSql')";
    if (mysqli_query($conn, $sql)) {
        mysqli_query($conn, "UPDATE orders SET O_Status = 'รอตรวจสอบ' WHERE O_ID = $num AND U_ID = $uid");
        $paid++;
    }
}

if ($outOfStock && $paid === 0) {
    slip_finish('ขออภัยสินค้าหมดแล้ว');
}
slip_finish($paid > 0 ? 'สำเร็จ' : 'ไม่สำเร็จ');
