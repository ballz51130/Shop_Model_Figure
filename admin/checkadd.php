<?php 
include '../conn/conn.php';
$image = $_FILES['image']['name'];
// Get text
$image_text = mysqli_real_escape_string($conn, $_POST['image_text']);
// image file directory
$target = "../photo/Order/".basename($image);
$sql ="INSERT INTO `product`(`P_ID`,`P_Number`, `P_Name`, `P_Price`, `P_Detel`, `P_Photo`, `P_Unit`, `P_Status`, `P_Group`) 
VALUES ('".$_POST['P_ID']."','".$_POST['P_Number']."','".$_POST['P_Name']."','".$_POST['P_Price']."','$image_text','$image','".$_POST['P_Unit']."','".$_POST['P_Status']."','".$_POST['P_Group']."')";
// execute query
mysqli_query($conn, $sql);
if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  echo" <center> <h1 color='green'> อัพโหลด สำเร็จ </h1> </center>";
  echo"<META HTTP-EQUIV ='Refresh' CONTENT = '2;URL= ./addProduct.php'>";
    
}else{
    $msg = "Failed to insert ";
}
?>