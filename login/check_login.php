<?php
session_start();
include '../conn/conn.php';

$sql= " SELECT * FROM user WHERE U_UserName = '".$_POST['UserName']."' AND U_Password = '".$_POST['password']."'";
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_array($query,MYSQLI_ASSOC);

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
    if($result["U_Status"]=="User")
    {
        $_SESSION['login'] = 1;
        $_SESSION['User']= $result['U_ID'];
        header("location: ../index.php");
    }
}
?>