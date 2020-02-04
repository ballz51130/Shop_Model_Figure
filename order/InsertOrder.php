<?php 
include '../conn/conn.php';
session_start();
$sql = "SELECT `P_Number`,`U_ID` FROM `orders` WHERE U_ID='".$_SESSION['User']."' AND P_Number = '".$_POST['P_Number']."'";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
// //print_r($sql);
// print_r($result);
// return false;
if($result > 0){
    echo "<H1>สินค้ามีอยู่ในกระกร้าอยู่แล้ว กรุณาไปตรวจสอบที่ตระกร้าสินค้า</H1>"; 
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '2;URL=../index.php'>";
}
else{


$sql2 = "INSERT INTO `orders`(`P_Number`, `U_ID`, `O_Unit`, `O_Status`) VALUES ('".$_POST['P_Number']."','".$_SESSION['User']."','".$_POST['quantity']."','รอการชำระ')";
$query2 = mysqli_query($conn, $sql2);
if($query2==TRUE)
{
    echo"ทำการสั่งซื้อสำเร็จ";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '2;URL=../index.php'>";
}
else
{
    echo "เกิดข้อผิดพลาด ";
      echo "<META HTTP-EQUIV='Refresh'CONTENT = '2;URL=../index.php'>";
}
}
mysqli_close($conn);

?>
