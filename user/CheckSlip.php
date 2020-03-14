<?php 
include '../conn/conn.php';
session_start(); // คำสั่ง เปิดใช้งาน session
$image = $_FILES['image']['name'];
// Get text
$image_text = mysqli_real_escape_string($conn, $_POST['image_text']);
// image file directory
$target = "../photo/Slip/".basename($image);

for($i = 0; $i < count($_POST['check']); $i++){
  $num = $_POST['check'][$i];
  $product = $_POST['product'][$i];
  $unit = $_POST['unit'][$i];
  $status = $_POST['status'][$i];
if($status==1){
$sql2 = "SELECT P_Unit FROM product where P_Number = '".$product."'";
$query = $conn->query($sql2);
$result2 = $query->fetch_assoc();
// Update Stock 
if($result2['P_Unit'] >= $unit){
$unit = $result2['P_Unit'] - $unit;
$sql3 = "UPDATE product SET P_Unit = $unit WHERE P_Number='".$product."'";
$result3 = $conn->query($sql3);
$sql="INSERT INTO slip_tb(U_ID, O_ID, Sp_Frombank,  Sp_Tobank, Sp_LastNum,Sp_Price, Sp_Time, Sp_Date, Sp_Img) VALUES ('".$_SESSION['User']."','$num','".$_POST['FormBank']."','".$_POST['ToBank']."','".$_POST['Sp_LastNum']."','".$_POST['Sp_Price']."','".$_POST['time']."','".$_POST['date']."','$image')";
mysqli_query($conn, $sql);
$sql2 = "UPDATE `orders` SET `O_Status`= 'รอตรวจสอบ' WHERE O_ID ='".$num."' ";
mysqli_query($conn, $sql2);
if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  echo "<script type='text/javascript'>alert('สำเร็จ');</script>";
  echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./Market.php'>";
}else{
    echo "Failed to insert ";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./Market.php'>";
}

}

else{
echo "<script type='text/javascript'>alert('สินค้าหมดแล้ว');</script>";
echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./Market.php'>";
}
}

if($status==2){
}
$sql="INSERT INTO slip_tb(U_ID, O_ID, Sp_Frombank,  Sp_Tobank, Sp_LastNum,Sp_Price, Sp_Time, Sp_Date, Sp_Img) VALUES ('".$_SESSION['User']."','$num','".$_POST['FormBank']."','".$_POST['ToBank']."','".$_POST['Sp_LastNum']."','".$_POST['Sp_Price']."','".$_POST['time']."','".$_POST['date']."','$image')";
mysqli_query($conn, $sql);
$sql2 = "UPDATE `orders` SET `O_Status`= 'รอตรวจสอบ' WHERE O_ID ='".$num."' ";
mysqli_query($conn, $sql2);
if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  echo "<script type='text/javascript'>alert('สำเร็จ');</script>";
  echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./Market.php'>";
}else{
    echo "Failed to insert ";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./Market.php'>";
}
}

?>