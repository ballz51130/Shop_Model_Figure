<?php 
include '../conn/conn.php';
$image = $_FILES['image']['name'];
$pass = md5($_POST['U_Password']."harumyx");
echo $pass;
// Get text
$image_text = mysqli_real_escape_string($conn, $_POST['image_text']);
// image file directory
$target = "../photo/User/".basename($image);

$sql ="INSERT INTO  user( U_UserName, U_Password, U_Name,Home, T_District, A_District, Province, zip, U_Phone, U_Photo, U_Status, U_Email) VALUES 
        ('".$_POST['U_UserName']."','$pass','".$_POST['U_Name']."','".$_POST['Home']."','".$_POST['T_District']."','".$_POST['A_District']."','".$_POST['Province']."','".$_POST['zip']."','".$_POST['U_Phone']."','$image','user','".$_POST['Email']."') ";
move_uploaded_file($_FILES['image']['tmp_name'], $target);
$query = mysqli_query($conn,$sql);
if ($query){
  echo "<script type='text/javascript'>alert('สำเร็จ');</script>";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ../login/login.php'>";
    
      
  }else{
    echo "<script type='text/javascript'>alert('ERROR');</script>";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ../login/login.php'>";
  }
?>