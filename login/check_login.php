<?php
session_start();
include '../conn/conn.php';
$str_passMd5 = mysqli_real_escape_string($conn,$_POST['pass']);
$str_passMd5 =md5($str_passMd5.'harumyx');
$sql= " SELECT * FROM user WHERE U_UserName = '".$_POST['username']."' AND U_Password = '$str_passMd5'";
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
if( $_POST['username'] == "" || $_POST['pass'] == ""){
    echo "<script type='text/javascript'>alert('ชื่อผู้ใช้ / รหัสผ่าน ให้ครบถ้วน');</script>";
    echo "<META HTTP-EQUIV='Refresh' CONTENT ='0;URL=login.php'>";
}
else{
if(!$result)
{
    echo "<script type='text/javascript'>alert('ชื่อผู้ใช้ / รหัสผ่านไม่ถูกต้อง');</script>";
    echo "<META HTTP-EQUIV='Refresh' CONTENT ='0;URL=login.php'>";
    exit;
}

else{

    if($result["U_Status"]=="Admin")
    {
        header("location: ../admin/Mainadmin.php");
        $_SESSION['User'] = $result['U_ID'];
        
    }
    if($result["U_Status"]=="user")
    {
        $_SESSION['login'] = 1 ;
        $_SESSION['User'] = $result['U_ID'];
        header("location: ../index.php");
    }

}
}
$mysqli->close();
?>