<?php 
include '../../conn/conn.php';
$sqlcheck = "SELECT P_Number From product WHERE P_Number ='".$_POST['P_Number']."'";
$querycheck = mysqli_query($conn,$sqlcheck);
$resultcheck = mysqli_fetch_array($querycheck);
if($resultcheck){
  echo "<script type='text/javascript'>alert('มีสินค้าชื่อนี้อยู่แล้ว');</script>";
  echo"<META HTTP-EQUIV ='Refresh' CONTENT = '2;URL= ./addProduct.php'>";
}
else{
if ($_POST['P_Status'] == 1){ // เช็คว่าเป็น สินค้าประเภทไหน 1 = ธรรมดา
$image = $_FILES['image']['name'];
$image1 = $_FILES['image1']['name'];
$image2 = $_FILES['image2']['name'];
$image3 = $_FILES['image3']['name'];
// Get text
$image_text = mysqli_real_escape_string($conn, $_POST['image_text']); //ฟังก์ชันสำหรับเลี่ยงการใช้ตัวอักขระพิเศษ
// image file directory 
$target = "../../photo/Order/".basename($image);
$sql ="INSERT INTO product(P_ID,P_Number, P_Name, P_Price, P_Detel,P_weight,P_Photo, P_Unit, P_Status, P_Group,P_Brand) 
VALUES ('".$_POST['P_ID']."','".$_POST['P_Number']."','".$_POST['P_Name']."','".$_POST['P_Price']."','$image_text','".$_POST['P_weight']."','$image','".$_POST['P_Unit']."','".$_POST['P_Status']."','".$_POST['P_Group']."','".$_POST['P_Brand']."')";
//execute query
mysqli_query($conn, $sql);
$target1 = "../../photo/Order/orderdetail/".basename($image1);
$target2 = "../../photo/Order/orderdetail/".basename($image2);
$target3 = "../../photo/Order/orderdetail/".basename($image3);
$sql2 ="INSERT INTO productdetail(P_Number, Pd_image1, Pd_image2, Pd_image3) VALUES ('".$_POST['P_Number']."','$image1','$image2','$image3')";
move_uploaded_file($_FILES['image1']['tmp_name'], $target1);
move_uploaded_file($_FILES['image2']['tmp_name'], $target2);
move_uploaded_file($_FILES['image3']['tmp_name'], $target3);
mysqli_query($conn, $sql2);

if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  echo" <center> <h1 color='green'> อัพโหลด สำเร็จ </h1> </center>";
  echo"<META HTTP-EQUIV ='Refresh' CONTENT = '2;URL= ./addProduct.php'>";
    
}else{
    $msg = "Failed to insert ";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '2;URL= ./addProduct.php'>";
}
} // if P_Status 
if ($_POST['P_Status'] == 2){ // 2 = PreOrder
$image = $_FILES['image']['name'];
$image1 = $_FILES['image1']['name'];
$image2 = $_FILES['image2']['name'];
$image3 = $_FILES['image3']['name'];
// Get text
$image_text = mysqli_real_escape_string($conn, $_POST['image_text']); //ฟังก์ชันสำหรับเลี่ยงการใช้ตัวอักขระพิเศษ
// image file directory 
$target = "../../photo/Order/".basename($image);
$sql ="INSERT INTO product(P_ID,P_Number, P_Name, P_Price, P_Detel,P_weight,P_Photo, P_Status, P_Group,P_Brand,P_Date,P_Comin) 
VALUES ('".$_POST['P_ID']."','".$_POST['P_Number']."','".$_POST['P_Name']."','".$_POST['P_Price']."','$image_text','".$_POST['P_weight']."','$image','".$_POST['P_Status']."','".$_POST['P_Group']."','".$_POST['P_Brand']."','".$_POST['Pre_Month']."','".$_POST['Pre_Comin']."')";
//execute query

mysqli_query($conn, $sql);
// Insert Photo detail Product
$target1 = "../../photo/Order/orderdetail/".basename($image1);
$target2 = "../../photo/Order/orderdetail/".basename($image2);
$target3 = "../../photo/Order/orderdetail/".basename($image3);
$sql2 ="INSERT INTO productdetail(P_Number, Pd_image1, Pd_image2, Pd_image3) VALUES ('".$_POST['P_Number']."','$image1','$image2','$image3')";
move_uploaded_file($_FILES['image1']['tmp_name'], $target1);
move_uploaded_file($_FILES['image2']['tmp_name'], $target2);
move_uploaded_file($_FILES['image3']['tmp_name'], $target3);
mysqli_query($conn, $sql2);
if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  echo" <center> <h1 color='green'> อัพโหลด สำเร็จ </h1> </center>";
  echo"<META HTTP-EQUIV ='Refresh' CONTENT = '2;URL= ./addPreProduct.php'>";

    
}else{
    $msg = "Failed to insert ";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '2;URL= ./addPreProduct.php'>";
}
} // $_POST Status == 2
}// else result check
?>