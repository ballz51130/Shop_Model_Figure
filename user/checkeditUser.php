<?php 
include '../conn/conn.php';
session_start();
$image = $_FILES['image']['name'];
$pass = md5($_POST['U_Password']."harumyx");
// Get text
$image_text = mysqli_real_escape_string($conn, $_POST['image_text']);
// image file directory
if($_POST['U_Password'] != ''){
$sqledit = "UPDATE user SET U_UserName='".$_POST['U_UserName']."',U_Password='$pass',U_Name='".$_POST['U_Name']."',Home='".$_POST['Home']."',T_District='".$_POST['T_District']."',A_District='".$_POST['A_District']."',Province='".$_POST['Province']."',zip='".$_POST['zip']."',U_Phone='".$_POST['U_Phone']."',U_Photo='$image',U_Email='".$_POST['Email']."' WHERE U_ID = '".$_SESSION['User']."'";
 $query= mysqli_query($conn,$sqledit);
  if($query){
    echo "<script type='text/javascript'>alert('สำเร็จ');</script>";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ../login/login.php'>";
    
  }
  else{
    echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดขึ้น');</script>";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ../login/login.php'>";
    exit;
  }

}
if($_POST['U_Password'] == ''){
    $sqledit = "UPDATE user SET U_UserName='".$_POST['U_UserName']."',U_Name='".$_POST['U_Name']."',Home='".$_POST['Home']."',T_District='".$_POST['T_District']."',A_District='".$_POST['A_District']."',Province='".$_POST['Province']."',zip='".$_POST['zip']."',U_Phone='".$_POST['U_Phone']."',U_Photo='$image',U_Email='".$_POST['Email']."' WHERE U_ID = '".$_SESSION['User']."'";
    $query= mysqli_query($conn,$sqledit);
    if($query){
        echo "<script type='text/javascript'>alert('สำเร็จ');</script>";
        echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ../login/login.php'>";
       
      }
    else{
        echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดขึ้น');</script>";
        echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ../login/login.php'>";
        exit;
    }
}
?>