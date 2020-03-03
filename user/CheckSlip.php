<?php 
include '../conn/conn.php';
session_start(); // คำสั่ง เปิดใช้งาน session
$image = $_FILES['image']['name'];
// Get text
$image_text = mysqli_real_escape_string($conn, $_POST['image_text']);
// image file directory
$target = "../photo/Slip/".basename($image);
$sql="INSERT INTO slip_tb(U_ID, O_ID, Sp_Frombank,  Sp_Tobank, Sp_LastNum,Sp_Price, Sp_Time, Sp_Date, Sp_Img) VALUES ('".$_SESSION['User']."','".$_GET['O_ID']."','".$_POST['FormBank']."','".$_POST['ToBank']."','".$_POST['Sp_LastNum']."','".$_POST['Sp_Price']."','".$_POST['time']."','".$_POST['date']."','$image')";
mysqli_query($conn, $sql);
$sql2 = "UPDATE `orders` SET `O_Status`= 'รอตรวจสอบ' WHERE O_ID ='".$_GET['O_ID']."' ";
mysqli_query($conn, $sql2);
if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    echo "<script type='text/javascript'>alert('สำเร็จ');</script>";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./Market.php'>";
  }else{
      echo "Failed to insert ";
      echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./Market.php'>";
  }
?>