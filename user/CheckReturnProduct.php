<?php
include '../conn/conn.php';
$uid = require_login();

function return_finish($message)
{
    echo '<script type="text/javascript">alert("' . $message . '");</script>';
    echo "<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./Market.php'>";
    exit;
}

$o_id = (int)($_POST['O_ID'] ?? 0);
// Returns are only allowed on the user's own delivered orders.
$check = mysqli_query($conn, "SELECT 1 FROM orders WHERE O_ID = $o_id AND U_ID = $uid
    AND O_Status IN ('จัดส่งแล้ว', 'รับของแล้ว') LIMIT 1");
if (!$check || mysqli_num_rows($check) === 0) {
    return_finish('บันทึกไม่สำเร็จ');
}

$images = [];
foreach (['image1', 'image2', 'image3'] as $field) {
    $stored = store_uploaded_image($field, '../photo/ReProduct');
    if ($stored === false) {
        return_finish('ไฟล์รูปภาพไม่ถูกต้อง (jpg, png, gif, webp ไม่เกิน 5MB)');
    }
    $images[] = mysqli_real_escape_string($conn, $stored);
}

$re_feedback = mysqli_real_escape_string($conn, $_POST['Re_feedback'] ?? '');
$re_detail = mysqli_real_escape_string($conn, $_POST['Re_Detail'] ?? '');
$re_namebank = mysqli_real_escape_string($conn, $_POST['Re_NameBank'] ?? '');
$re_numberbank = mysqli_real_escape_string($conn, $_POST['Re_NumberBank'] ?? '');

$sql = "INSERT INTO returnorder(O_ID, Re_feedback, Re_Detail, Re_Status, Re_NameBank, Re_NumberBank, Re_Date)
    VALUES ('$o_id','$re_feedback','$re_detail','รอตรวจสอบ(สินค้า)','$re_namebank','$re_numberbank',NOW())";
$query = mysqli_query($conn, $sql);
$sql2 = "INSERT INTO returnorderdetail(O_ID, P1, P2, P3) VALUES ('$o_id','{$images[0]}','{$images[1]}','{$images[2]}')";
$query2 = $query ? mysqli_query($conn, $sql2) : false;
if ($query2) {
    mysqli_query($conn, "UPDATE orders SET O_Status='รอตรวจสอบ(สินค้า)' WHERE O_ID = $o_id AND U_ID = $uid");
}

return_finish($query && $query2 ? 'บันทึกสำเร็จ' : 'บันทึกไม่สำเร็จ');
