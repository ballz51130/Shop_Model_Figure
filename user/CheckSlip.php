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
$sql="INSERT INTO payment_tb(O_ID, Pay_Frombank,Pay_LastNum,Pay_Price, Pay_Time, Pay_Date, Pay_Img) VALUES ('$num','".$_POST['FormBank']."','".$_POST['Pay_LastNum']."','".$_POST['Pay_Price']."','".$_POST['time']."','".$_POST['date']."','$image')";
mysqli_query($conn, $sql);
$sql2 = "UPDATE orders SET O_Status= 'รอตรวจสอบ' WHERE O_ID ='".$num."' ";
mysqli_query($conn, $sql2);
if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  echo "<script type='text/javascript'>alert('สำเร็จ');</script>";
  echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./Market.php'>";
}else{
  echo "<script type='text/javascript'>alert('ไม่สำเร็จ');</script>";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./Market.php'>";
}

}

else{
echo "<script type='text/javascript'>alert('ขออภัยสินค้าหมดแล้ว');</script>";
echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./Market.php'>";
}

} // status = 1 

if($status==2){
$sql="INSERT INTO payment_tb(O_ID, Pay_Frombank,Pay_LastNum,Pay_Price, Pay_Time, Pay_Date, Pay_Img) VALUES ('$num','".$_POST['FormBank']."','".$_POST['Pay_LastNum']."','".$_POST['Pay_Price']."','".$_POST['time']."','".$_POST['date']."','$image')";
$queryinsertpre= mysqli_query($conn, $sql);
move_uploaded_file($_FILES['image']['tmp_name'], $target);
//echo $sql.'<br>';
$sql2 = "UPDATE orders SET O_Status= 'รอตรวจสอบ' WHERE O_ID ='".$num."' ";
//echo $sql2.'<br>';
$query = $conn->query($sql2);
$sqlnum = "SELECT P_Unit FROM product where P_Number = '".$product."'";
//echo $sqlnum.'<br>';
$querynum = $conn->query($sqlnum);
$result2 = $querynum->fetch_assoc();
 //Update Stock 
$unit = $result2['P_Unit'] + $unit;
$sql3 = "UPDATE product SET P_Unit = $unit WHERE P_Number='".$product."'";
mysqli_query($conn, $sql3);
//echo $sql3.'<br>';

if ($queryinsertpre) {
  echo "<script type='text/javascript'>alert('สำเร็จ');</script>";
  echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./Market.php'>";
}else{
  echo "<script type='text/javascript'>alert('ไม่สำเร็จ');</script>";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./Market.php'>";
}
}
}
