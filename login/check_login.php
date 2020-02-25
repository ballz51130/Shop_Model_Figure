<?php
session_start();
include '../conn/conn.php';
$str_passMd5 = mysqli_real_escape_string($conn,$_POST['pass']);
$str_passMd5 =md5($str_passMd5.'harumyx');
$sql= " SELECT * FROM user WHERE U_UserName = '".$_POST['username']."' AND U_Password = '$str_passMd5'";
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
if( $_POST['username'] == "" || $_POST['pass'] == ""){
    echo "<center><h1>กรุณากรอก UserName และ Password ให้ครบถ้วน";
    echo "<META HTTP-EQUIV='Refresh' CONTENT ='2;URL=login.php'>";
}
else{
if(!$result)
{
    echo "<center><h1>Username OR Password ผิดพลาดโปรดใส่ใหม่อีกครั้ง</h1>";
    echo "<META HTTP-EQUIV='Refresh' CONTENT ='2;URL=login.php'>";
    exit;
}

else{

    if($result["U_Status"]=="Admin")
    {
        header("location: ../main/admin.php");
    }
    if($result["U_Status"]=="user")
    {
        $_SESSION['login'] = 1 ;
        $_SESSION['User']= $result['U_ID'];
        header("location: ../index.php");
    }
else{

    if($result["U_Status"]=="Admin")
    {
        header("location: ../main/admin.php");
    }
    if($result["U_Status"]=="User")
    {
        $_SESSION['login'] = 1 ;
        $_SESSION['User']= $result['U_ID'];
        header("location: ../index.php");
}
}
}
}
?>