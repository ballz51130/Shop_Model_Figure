<?php
include '../conn/conn.php';
sec_session_start();

$username = isset($_POST['username']) ? (string)$_POST['username'] : '';
$password = isset($_POST['pass']) ? (string)$_POST['pass'] : '';

if ($username === '' || $password === '') {
    echo "<script type='text/javascript'>alert('ชื่อผู้ใช้ / รหัสผ่าน ให้ครบถ้วน');</script>";
    echo "<META HTTP-EQUIV='Refresh' CONTENT ='0;URL=login.php'>";
    exit;
}

$str_username = mysqli_real_escape_string($conn, $username);
$str_passMd5 = md5($password . 'harumyx');
$sql = "SELECT * FROM user WHERE U_UserName = '$str_username' AND U_Password = '$str_passMd5'";
$query = mysqli_query($conn, $sql);
$result = $query ? mysqli_fetch_array($query, MYSQLI_ASSOC) : null;

if (!$result) {
    echo "<script type='text/javascript'>alert('ชื่อผู้ใช้ / รหัสผ่านไม่ถูกต้อง');</script>";
    echo "<META HTTP-EQUIV='Refresh' CONTENT ='0;URL=login.php'>";
    exit;
}

// New session id on login prevents session fixation.
session_regenerate_id(true);
$_SESSION['User'] = (int)$result['U_ID'];
$_SESSION['role'] = $result['U_Status'];
$_SESSION['login'] = 1;

if ($result['U_Status'] === 'Admin') {
    header('Location: ../admin/Mainadmin.php');
    exit;
}

header('Location: ../index.php');
exit;
