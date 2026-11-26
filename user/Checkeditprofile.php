<?php
include '../conn/conn.php';
$sessionUserId = require_login();

// Users may only edit their own profile; admins may edit any user.
$u_id = is_admin() && isset($_POST['U_ID']) ? (int)$_POST['U_ID'] : $sessionUserId;
$redirect = is_admin() ? '../admin/ManageUser.php' : './EditUser.php';

$image = store_uploaded_image('image', '../photo/User');
if ($image === false) {
    echo '<script type="text/javascript">alert("ไฟล์รูปภาพไม่ถูกต้อง (jpg, png, gif, webp ไม่เกิน 5MB)");</script>';
    echo "<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=" . $redirect . "'>";
    exit;
}

$fields = [
    'U_UserName' => $_POST['U_UserName'] ?? '',
    'U_Name'     => $_POST['U_Name'] ?? '',
    'Home'       => $_POST['Home'] ?? '',
    'zip'        => $_POST['zip'] ?? '',
    'U_Phone'    => $_POST['U_Phone'] ?? '',
    'U_Email'    => $_POST['Email'] ?? '',
];
// Province == 0 means "unchanged" in the edit form.
if (($_POST['Province'] ?? '0') != 0) {
    $fields['T_District'] = $_POST['T_District'] ?? '';
    $fields['A_District'] = $_POST['A_District'] ?? '';
    $fields['Province']   = $_POST['Province'];
}
if ($image !== '') {
    $fields['U_Photo'] = $image;
}
if (($_POST['U_Password'] ?? '') !== '') {
    $fields['U_Password'] = md5($_POST['U_Password'] . 'harumyx');
}

$set = [];
foreach ($fields as $column => $value) {
    $set[] = $column . "='" . mysqli_real_escape_string($conn, (string)$value) . "'";
}
$sqledit = 'UPDATE user SET ' . implode(',', $set) . ' WHERE U_ID=' . $u_id;
$query = mysqli_query($conn, $sqledit);

if ($query) {
    echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
} else {
    echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
}
echo "<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=" . $redirect . "'>";
