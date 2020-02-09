<?php 
include '../conn/conn.php';
$image = $_FILES['image']['name'];
// Get text
$image_text = mysqli_real_escape_string($conn, $_POST['image_text']);
// image file directory
$target = "../photo/User/".basename($image);
$sql ="INSERT INTO  user( U_UserName, U_Password, U_FName, U_LName, Home, T_District, A_District, Province, zip, U_Phone, U_Photo, U_Status, U_Email) VALUES 
        ('".$_POST['U_UserName']."','".$_POST['U_Password']."','".$_POST['U_FName']."','".$_POST['U_LName']."','".$_POST['Home']."','".$_POST['T_District']."','".$_POST['A_District']."','".$_POST['Province']."','".$_POST['zip']."','".$_POST['U_Phone']."','$image','user','".$_POST['Email']."') ";
        echo $sql;
$query = mysqli_query($conn,$sql);
if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    echo" <center> <h1 color='green'> อัพโหลด สำเร็จ </h1> </center>";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '2;URL= ./addUser.php'>";
      
  }else{
      $msg = "Failed to insert ";
  }
?>